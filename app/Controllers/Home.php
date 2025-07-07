<?php

namespace App\Controllers;

use App\Models\ProductModel;

class Home extends BaseController
{
    protected $product;

    public function __construct()
    {
        $this->product = new ProductModel();
    }


    public function index(): string
    {
        return view('admin/dashboard');
    }

    public function home(): string
    {
        $dataProduk = [
            'produk' => $this->product->getProductWithCategories(),
        ];
        return view('user/home', $dataProduk);
    }

}
