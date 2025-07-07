<?php

namespace App\Controllers;

use App\Models\UsersModel;
use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class AuthController extends BaseController
{
    protected $user;

    public function __construct()
    {
        $this->user = new UsersModel();
    }

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

    public function login()
    {
        if ($this->request->getPost()) {
            $rules = [
                'email-username' => 'required|min_length[3]',
                'password' => 'required|min_length[6]',
            ];

            if ($this->validate($rules)) {
                $emailOrUsername = $this->request->getVar('email-username');
                $password = $this->request->getVar('password');

                // Cari user berdasarkan email atau username
                $dataUser = $this->user->where('username', $emailOrUsername)
                    ->orWhere('email', $emailOrUsername)
                    ->first();

                if ($dataUser) {
                    if (password_verify($password, $dataUser['password'])) {
                        // Set session data
                        session()->set([
                            'user_id' => $dataUser['id'],
                            'username' => $dataUser['username'],
                            'email' => $dataUser['email'],
                            'role' => $dataUser['role'],
                            'isLoggedIn' => TRUE
                        ]);

                        // Redirect berdasarkan role
                        if ($dataUser['role'] === 'admin') {
                            return redirect()->to(base_url('admin/dashboard'));
                        } else {
                            // Role guest atau user biasa
                            return redirect()->to(base_url('/'));
                        }
                    } else {
                        session()->setFlashdata('failed', 'Password salah');
                        return redirect()->back();
                    }
                } else {
                    session()->setFlashdata('failed', 'Email/Username tidak ditemukan');
                    return redirect()->back();
                }
            } else {
                session()->setFlashdata('failed', $this->validator->listErrors());
                return redirect()->back();
            }
        }

        return view('login');
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to(base_url('/login-user'));
    }
}