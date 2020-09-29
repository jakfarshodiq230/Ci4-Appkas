<?php

namespace App\Controllers;

use App\Models\m_laporan;

class c_laporan extends BaseController
{
    protected $m_laporan;
    public function __construct()
    {
        $this->m_laporan = new m_laporan();
    }
    public function index()
    {
        $currentPage = $this->request->getVar('page_komik') ? $this->request->getVar('page_komik') : 1;
        $data = [
            'title' => 'Laporan | Musholla Attaubah',
            'tampil' => 'Login',
            'rekap' => $this->m_laporan->orderBy('created_at', 'DESC')->paginate(10, 'rekap'),
            'pager' => $this->m_laporan->pager,
            'currentPage' => $currentPage
            //'rekap' => $this->m_laporan,
        ];
        return view('Laporan/index.php', $data);
    }
}
