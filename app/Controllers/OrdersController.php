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

    public function __construct()
    {
        $this->client = new Client();
        $this->transaction = new OrdersModel();
        $this->transaction_detail = new OrderItemsModel();
        $this->session = session();
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
        $cart = $this->session->get('cart') ?? [];

        if (empty($cart)) {
            session()->setFlashdata('error', 'Keranjang kosong.');
            return redirect()->to('keranjang');
        }

        // Process order logic here
        // ...

        // Clear cart after successful order
        $this->session->remove('cart');
        session()->setFlashdata('success', 'Pesanan berhasil diproses.');
        return redirect()->to('keranjang');
    }
}
