<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

use App\Models\UserModel;

class AuthController extends BaseController
{
    public function index()
    {
        return view('Auth/index');
    }
    public function login()
    {
        $username = $this->request->getPost('username');
        $password = $this->request->getVar('password');
        $UserModel = new Usermodel;
        $userData = $UserModel->where('username', $username)->first();

        if (!$userData) {
            return redirect()->to(base_url('/'))->withInput()->with('error', 'Invalid username or password');
        } else {
            if (password_verify($password, $userData['password'])) {
                session()->set('username', $userData['username']);
                session()->set('role', $userData['role']);
                switch ($userData['role']) {
                    case 'area':
                        return redirect()->to(base_url('/area'));
                        break;
                    case 'kepala area':
                        return redirect()->to(base_url('/kepalaarea'));
                        break;
                    case 'monitoring':
                        return redirect()->to(base_url('/monitoring'));
                        break;


                    default:
                        return redirect()->to(base_url('/login'))->withInput()->with('error', 'Invalid username or password');
                        break;
                }
            }
        }
    }
    public function logout()
    {
        session()->destroy();
        return redirect()->to(base_url('/login'));
    }
}
