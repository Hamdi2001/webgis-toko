<?php

namespace App\Controllers;

use App\Models\LoginAdminModel;

class Login extends BaseController
{
     protected $adminModel;

    public function __construct()
    {
       $this->adminModel = new LoginAdminModel(); 
    }

    public function index() 
    {
        return view('admin_pages/login_viewadmin');
    }

    public function login()
    {

        // Ambil data dari form login
        $username = $this->request->getPost('inputUsername');
        $password = $this->request->getPost('inputPassword');

        // Periksa kredensial pengguna
        $userModel = new LoginAdminModel();
        $user = $userModel->where('username_admin', $username)->first();

        if ($user == null || !password_verify($password, $user['password_admin'])) {
            session()->setFlashdata('error', 'Login Gagal! Username atau Password salah.');
            return redirect()->to('login');
        } else {
            // Set session untuk pengguna yang berhasil login
            session()->set([
                'id' => $user['id'],
                'username_admin' => $user['username_admin'],
                'nama_admin' => $user['nama_admin'],
                'logged_in' => true
            ]);

            // // Redirect ke halaman beranda sesuai peran pengguna
            // if ($user == 'hamdikirito') {
            //     return redirect()->to('admin_pages/home');
            // } 
            // else {
            //     return redirect()->to('');
            // }
        }
    }
}
