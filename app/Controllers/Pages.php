<?php

namespace App\Controllers;

use  App\Models\m_pemasukan;

class Pages extends BaseController
{
    protected $M_transaksi_kas;

    public function __construct()
    {
        $this->m_pemasukan = new m_pemasukan();
    }

    public function index()
    {
        if (session()->get('username') == '') {
            session()->setFlashdata('gagal', 'Anda Belum Login');
            return redirect()->to(base_url('/'));
        } else {
            $komik = $this->m_pemasukan->countRow();
            $countFiled = $this->m_pemasukan->countFiled();
            $data = [
                'title' => 'Home | Belajar Ci4',
                'tes' => ['satu', 'dua', 'tiga'],
                'isi_data' => $komik,
                'jumlah_perfiled' => $countFiled
            ];
            return view('Pages/Home', $data);
        }
    }
}
