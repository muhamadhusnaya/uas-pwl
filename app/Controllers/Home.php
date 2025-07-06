<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index(): string
    {
        return view('admin/dashboard');
    }

    public function home(): string
    {
        return view('user/home');
    }

}
