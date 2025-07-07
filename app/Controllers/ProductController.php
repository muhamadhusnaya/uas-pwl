<?php

namespace App\Controllers;

use App\Models\ProductModel;
use App\Models\CategoryModel;
use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class ProductController extends BaseController
{
    protected $product;
    protected $category;

    public function __construct()
    {
        $this->product = new ProductModel();
        $this->category = new CategoryModel();
    }

    public function produk()
    {
        $dataProduk = [
            'produk' => $this->product->getProductWithCategories(),
            'categories' => $this->category->findAll(),
        ];
        return view('admin/produk', $dataProduk);
    }

    public function store()
    {
        $rules = [
            'name' => 'required|min_length[3]|max_length[50]',
            'price' => 'required|numeric',
            'stock' => 'required|numeric',
            'category_id' => 'required|is_not_unique[categories.id]',
            'image' => [
                'label' => 'Image',
                'rules' => 'uploaded[image]|is_image[image]|max_size[image,2048]|ext_in[image,jpg,jpeg,png,gif]',
            ],
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $dataForm = [
            'name' => $this->request->getPost('name'),
            'price' => $this->request->getPost('price'),
            'stock' => $this->request->getPost('stock'),
            'category_id' => $this->request->getPost('category_id'),
            'created_at' => date("Y-m-d H:i:s")
        ];

        $dataFoto = $this->request->getFile('image');

        if ($dataFoto->isValid()) {
            $fileName = $dataFoto->getRandomName();
            $dataForm['images'] = $fileName;
            $dataFoto->move('img/produk', $fileName);
        }
        
        $this->product->insert($dataForm);

        return redirect('admin/produk')->with('success', 'Data Berhasil Ditambah');
    }

    public function update($id)
    {
        $rules = [
            'name' => 'required|min_length[3]|max_length[50]',
            'price' => 'required|numeric',
            'stok' => 'required|numeric',
            'category_id' => 'required|is_not_unique[categories.id]',
            'status' => 'permit_empty|in_list[1]',
        ];

        if ($this->request->getPost('check') == 1) {
            $rules['image'] = [
                'label' => 'Image',
                'rules' => 'uploaded[image]|is_image[image]|max_size[image,2048]|ext_in[image,jpg,jpeg,png,gif]',
            ];
        }

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $dataProduk = $this->product->find($id);
        $dataForm = [
            'name' => $this->request->getPost('name'),
            'price' => $this->request->getPost('price'),
            'stok' => $this->request->getPost('stok'),
            'category_id' => $this->request->getPost('category_id'),
            'updated_at' => date("Y-m-d H:i:s")
        ];

        if ($this->request->getPost('check') == 1) {
            // Hapus gambar lama jika ada
            if (!empty($dataProduk['images']) && file_exists("img/" . $dataProduk['images'])) {
                unlink("img/" . $dataProduk['images']);
            }

            // 4. KONSISTENSI NAMA FILE
            $dataFoto = $this->request->getFile('image');

            if ($dataFoto->isValid() && !$dataFoto->hasMoved()) {
                $fileName = $dataFoto->getRandomName();
                $dataFoto->move('img/', $fileName);
                $dataForm['images'] = $fileName;
            }
        }

        $this->product->update($id, $dataForm);
        return redirect('admin/produk')->with('success', 'Data Berhasil Diubah');
    }

    public function delete($id)
    {
        $dataProduk = $this->product->find($id);

        if ($dataProduk['images'] != '' and file_exists("img/" . $dataProduk['images'] . "")) {
            unlink("img/" . $dataProduk['images']);
        }

        $this->product->delete($id);

        return redirect('admin/produk')->with('success', 'Data Berhasil Dihapus');
    }
    
    public function order()
    {
        return view('admin/order');
    }
    
    public function keranjang(): string
    {
        return view('user/keranjang');
    }
}
