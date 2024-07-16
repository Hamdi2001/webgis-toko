<?php

namespace App\Controllers;

use App\Models\LoginAdminModel;

class Login extends BaseController
{
    protected $adminModel, $session;

    public function __construct()
    {
       $this->adminModel = new LoginAdminModel(); 
       $this->session = \Config\Services::session();
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

        if ($user && $password === $user['password_admin']) {
            $datasession = [
                'user_id' => $user['id'],
                'username_admin' => $user['username_admin'],
                'password_admin' => $user['password_admin'],
                'nama_admin' => $user['nama_admin'],
                'level' => $user['level'],
                'logged_in' => true
            ];
            $this->session->set($datasession);
            if ($user['level'] == 1) {
                return redirect()->to('Pages');
            }else{
                return redirect()->to('/toko');
            }
            
        } else {
            $error = "Username atau Password salah";
            session()->setFlashdata('error', $error);
            return redirect()->to('/Login');
        }
    }

    public function logout()
    {
        session()->remove('id');
        session()->remove('username_admin');
        session()->remove('password_admin');
        session()->remove('nama_admin');
        session()->remove('level');
        session()->remove('logged_in');
        session()->setFlashdata('pesan', 'Logout Sukses!');
        return redirect()->to('admin');
    }
}
