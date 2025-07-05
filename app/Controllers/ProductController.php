<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class ProductController extends BaseController
{
    public function produk()
    {
        return view('admin/produk');
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
