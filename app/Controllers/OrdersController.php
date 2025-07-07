<?php

namespace App\Controllers;

use Config\Services;
use GuzzleHttp\Client;
use App\Models\OrdersModel;
use App\Models\ProductModel;
use App\Models\OrderItemsModel;
use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class OrdersController extends BaseController
{
    protected $client;
    protected $transaction;
    protected $transaction_detail;
    protected $session;
    protected $apiXendit;

    public function __construct()
    {
        helper('number');
        
        $this->client = new Client();
        $this->transaction = new OrdersModel();
        $this->transaction_detail = new OrderItemsModel();
        $this->session = session();
        $this->apiXendit = env('XENDIT_SECRET_KEY');
    }

    public function index()
    {
        $dataOrder = [
            'order' => $this->transaction_detail->getOrderItemsWithProductDetails(),
        ];

        return view('admin/order', $dataOrder);
    }

    public function keranjang()
    {
        $cart = $this->session->get('cart') ?? [];
        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'] * $item['qty'];
        }

        $data['items'] = $cart;
        $data['total'] = $total;
        return view('user/keranjang', $data);
    }

    public function cart_add()
    {
        $id = $this->request->getPost('id');
        $name = $this->request->getPost('name');
        $price = $this->request->getPost('price');
        $image = $this->request->getPost('image');

        // Validasi input
        if (!$id || !$name || !$price) {
            session()->setFlashdata('error', 'Data produk tidak lengkap.');
            return redirect()->back();
        }

        // Ambil cart dari session
        $cart = $this->session->get('cart') ?? [];

        // Cek apakah produk sudah ada di cart
        $found = false;
        foreach ($cart as &$item) {
            if ($item['id'] == $id) {
                $item['qty']++;
                $found = true;
                break;
            }
        }

        // Jika produk belum ada, tambahkan baru
        if (!$found) {
            $cart[] = [
                'id' => $id,
                'name' => $name,
                'qty' => 1,
                'price' => $price,
                'image' => $image
            ];
        }

        // Simpan cart ke session
        $this->session->set('cart', $cart);

        session()->setFlashdata('success', 'Produk berhasil ditambahkan ke keranjang.');
        return redirect()->to('keranjang');
    }

    public function cart_update()
    {
        $id = $this->request->getPost('id');
        $qty = $this->request->getPost('qty');

        if (!$id || !$qty || $qty < 1) {
            session()->setFlashdata('error', 'Data tidak valid.');
            return redirect()->back();
        }

        $cart = $this->session->get('cart') ?? [];

        foreach ($cart as &$item) {
            if ($item['id'] == $id) {
                $item['qty'] = $qty;
                break;
            }
        }

        $this->session->set('cart', $cart);
        session()->setFlashdata('success', 'Keranjang berhasil diupdate.');
        return redirect()->to('keranjang');
    }

    public function cart_remove($id)
    {
        $cart = $this->session->get('cart') ?? [];

        foreach ($cart as $key => $item) {
            if ($item['id'] == $id) {
                unset($cart[$key]);
                break;
            }
        }

        // Reindex array
        $cart = array_values($cart);
        $this->session->set('cart', $cart);

        session()->setFlashdata('success', 'Produk berhasil dihapus dari keranjang.');
        return redirect()->to('keranjang');
    }

    public function cart_clear()
    {
        $this->session->remove('cart');
        session()->setFlashdata('success', 'Keranjang berhasil dikosongkan.');
        return redirect()->to('keranjang');
    }

    public function process_order()
    {
        // 1. Ambil semua data yang dibutuhkan
        $cart = $this->session->get('cart') ?? [];
        $customerName = $this->request->getPost('username');
        $shippingAddress = $this->request->getPost('shipping_address');
        $userId = session()->get('user_id');
        $email = session()->get('email');
        $phoneNumber = session()->get('phone_number');

        // 2. Validasi data penting sebelum memproses
        if (empty($cart)) {
            session()->setFlashdata('error', 'Keranjang belanja Anda masih kosong.');
            return redirect()->to('keranjang');
        }

        if (empty($customerName) || empty($shippingAddress) || empty($email) || empty($userId)) {
            session()->setFlashdata('error', 'Data pelanggan tidak lengkap. Pastikan nama, alamat, dan email terisi dan Anda sudah login.');
            return redirect()->back(); // Kembali ke halaman sebelumnya (form checkout)
        }

        // 3. Siapkan item dan total
        $grandTotal = 0;
        $items = [];
        foreach ($cart as $item) {
            $subtotal = $item['price'] * $item['qty'];
            $grandTotal += $subtotal;
            $items[] = [
                'name' => $item['name'],
                'quantity' => (int)$item['qty'],
                'price' => (int)$item['price'],
            ];
        }

        $orderNumber = 'INV-' . time();

        // 4. Bangun data customer dengan aman
        $customerData = [
            'given_names' => $customerName,
            'email' => $email,
            'addresses' => [
                [
                    'country' => 'ID',
                    'street_line1' => $shippingAddress,
                ]
            ]
        ];

        // Hanya tambahkan nomor HP jika ada nilainya
        if (!empty($phoneNumber)) {
            $customerData['mobile_number'] = $phoneNumber;
        }

        // 5. Siapkan payload lengkap untuk Xendit
        $xenditPayload = [
            'external_id' => $orderNumber,
            'amount' => $grandTotal,
            'payer_email' => $email,
            'description' => 'Invoice for order ' . $orderNumber,
            'items' => $items,
            'customer' => $customerData,
            'success_redirect_url' => base_url('order/success'),
            'failure_redirect_url' => base_url('order/failed'),
        ];

        // Tips Debugging: Jika masih error, hapus tanda komentar di bawah ini
        // untuk melihat data apa yang sebenarnya Anda kirim.
        // dd($xenditPayload);

        try {
            $response = $this->client->request('POST', 'https://api.xendit.co/v2/invoices', [
                'auth' => [$this->apiXendit, ''],
                'json' => $xenditPayload
            ]);

            $xenditResponse = json_decode($response->getBody()->getContents(), true);

            // Lanjutkan menyimpan ke database
            $orderData = [
                'order_number' => $orderNumber,
                'user_id' => $userId,
                'customer_name' => $customerName,
                'shipping_address' => $shippingAddress,
                'grand_total' => $grandTotal,
                'external_id' => $xenditResponse['id'],
                'payment_status' => 'pending',
                'invoice_url' => $xenditResponse['invoice_url'],
            ];

            $orderId = $this->transaction->insert($orderData);

            foreach ($cart as $item) {
                $orderItemData = [
                    'order_id' => $orderId,
                    'product_id' => $item['id'],
                    'quantity' => $item['qty'],
                    'price' => $item['price'],
                    'subtotal' => $item['price'] * $item['qty'],
                ];
                $this->transaction_detail->insert($orderItemData);
            }

            $this->session->remove('cart');
            return redirect()->to($xenditResponse['invoice_url']);
        } catch (\Exception $e) {
            // Tampilkan pesan error yang lebih detail saat development
            session()->setFlashdata('error', 'Gagal memproses pesanan: ' . $e->getMessage());
            return redirect()->to('keranjang');
        }
    }
}
