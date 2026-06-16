<?php

namespace App\Controllers;

class Auth extends BaseController
{
    public function login()
    {
        // Jika sudah login, redirect ke dashboard
        if (session()->get('logged_in')) {
            return redirect()->to('/home/dashboard');
        }
        return view('v_login');
    }

    public function doLogin()
    {
        $session = session();
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        // Default admin account
        if ($username == 'admin' && $password == 'admin123') {
            $session->set([
                'logged_in' => true,
                'username' => 'admin',
                'role' => 'admin'
            ]);
            return redirect()->to('/home/dashboard');
        }

        $session->setFlashdata('error', 'Username atau Password salah!');
        return redirect()->to('/auth/login');
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/');
    }
}