<?php

namespace App\Controllers;

use App\Models\m_user;

class c_user extends BaseController
{
    protected $m_user;
    public function __construct()
    {
        helper('form');
        $this->m_user = new m_user();
    }
    public function index()
    {
        $data = [
            'title' => 'Login | Belajar Ci4',
            'tampil' => 'Login',
        ];
        return view('login', $data);
    }
    public function cek_login()
    {

        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        $cek = $this->m_user->cek_login($username, $password);

        //dd($cek);
        if (($cek['username'] == $username) && ($cek['password'] == md5($password))) {
            session()->set('username', $cek['username']);
            session()->setFlashdata('sukses', 'Datang Disistem Kas');
            return redirect()->to(base_url('/Pages'));
        } else {
            session()->setFlashdata('gagal', 'Username atau Password Salah');
            return redirect()->to('/');
        }
    }
    public function logout()
    {
        session_destroy();
        session()->setFlashdata('sukses', 'Anda Berhasil Logout');
        return redirect()->to('/');
    }
}
