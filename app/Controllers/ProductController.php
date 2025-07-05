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
    
    public function keranjang()
    {
        return view('admin/keranjang');
    }
}
