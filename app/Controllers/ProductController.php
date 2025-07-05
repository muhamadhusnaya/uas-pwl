<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class ProductController extends BaseController
{
    public function produk()
    {
        return view('produk');
    }
    public function keranjang()
    {
        return view('keranjang');
    }
}
