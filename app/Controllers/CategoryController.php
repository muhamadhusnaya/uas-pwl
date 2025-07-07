<?php

namespace App\Controllers;

use App\Models\CategoryModel;
use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class CategoryController extends BaseController
{
    protected $categories;
    public function __construct()
    {
        $this->categories = new CategoryModel();
    }

    public function index()
    {
        $dataKategori = [
            'kategori' => $this->categories->findAll(),
        ];
        return view('admin/kategori', $dataKategori);
    }

    public function store()
    {
        $rules = [
            'category_type' => 'required|min_length[2]|max_length[255]',
            'slug' => 'required|min_length[3]|max_length[50]|is_unique[categories.slug]',
            'image' => 'uploaded[image]|max_size[image,2048]|is_image[image]|mime_in[image,image/jpg,image/jpeg,image/png]'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $dataForm = [
            'category_type' => $this->request->getPost('category_type'),
            'slug' => $this->request->getPost('slug'),
            'created_at' => date("Y-m-d H:i:s")
        ];

        $dataFoto = $this->request->getFile('image');

        if ($dataFoto->isValid()) {
            $fileName = $dataFoto->getRandomName();
            $dataForm['image'] = $fileName;
            $dataFoto->move('img/kategori/', $fileName);
        }
        // Simpan kategori ke database
        $this->categories->insert($dataForm);

        return redirect()->to('/admin/kategori')->with('success', 'Kategori berhasil ditambahkan');
    }

    public function edit($id)
    {
        // Untuk validasi slug saat edit, perlu aturan khusus agar tidak mengecek dirinya sendiri
        $rules = [
            'category_type' => 'required|min_length[2]|max_length[255]',
            'slug' => "required|min_length[3]|max_length[50]|is_unique[categories.slug,id,{$id}]", // Aturan is_unique yang benar untuk update
            'image' => 'max_size[image,2048]|is_image[image]|mime_in[image,image/jpg,image/jpeg,image/png]' // 'uploaded' bersifat opsional saat edit
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $dataForm = [
            'category_type' => $this->request->getPost('category_type'),
            'slug' => $this->request->getPost('slug'),
            'updated_at' => date("Y-m-d H:i:s")
        ];

        $dataFoto = $this->request->getFile('image');
        if ($dataFoto->isValid() && !$dataFoto->hasMoved()) {
            $dataKategori = $this->categories->find($id);

            // PERBAIKAN: Gunakan 'image' (tunggal)
            if (!empty($dataKategori['image']) && file_exists("/img/kategori/" . $dataKategori['image'])) {
                unlink("img/kategori/" . $dataKategori['image']);
            }

            $fileName = $dataFoto->getRandomName();
            // PERBAIKAN: Gunakan 'image' (tunggal)
            $dataForm['image'] = $fileName;
            $dataFoto->move('img/kategori/', $fileName);
        }

        // Update kategori di database
        $this->categories->update($id, $dataForm);
        return redirect()->to('/admin/kategori')->with('success', 'Kategori berhasil diperbarui');
    }

    public function delete($id)
    {
        $dataKategori = $this->categories->find($id);
        if (!empty($dataKategori['image']) && file_exists("img/kategori/" . $dataKategori['image'])) {
            unlink("img/kategori/" . $dataKategori['image']);
        }

        $this->categories->delete($id);

        return redirect()->to('/admin/kategori')->with('success', 'Kategori berhasil dihapus');
    }
}
