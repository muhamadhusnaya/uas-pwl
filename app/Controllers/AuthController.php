<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class AuthController extends BaseController
{
    public function viewLoginAdmin()
    {
        return view('admin/login_admin');
    }

    public function viewLoginUser()
    {
        return view('user/login_user');
    }

    public function viewRegisterUser()
    {
        return view('user/register_user');
    }
}