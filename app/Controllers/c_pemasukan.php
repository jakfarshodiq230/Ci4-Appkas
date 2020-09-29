<?php

namespace App\Controllers;

use  App\Models\m_pemasukan;
use CodeIgniter\Validation\Rules;

class c_pemasukan extends BaseController
{
    protected $m_pemasukan;

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
            //ambil halaman url utuk hitungan halaman
            $currentPage = $this->request->getVar('page_komik') ? $this->request->getVar('page_komik') : 1;
            //$komik = $this->komikModel->findAll();
            // sercing data
            $cari = $this->request->getVar('cari');
            if ($cari) {
                $komik_cari =  $this->m_pemasukan->search($cari);
            } else {
                //cari tidak ada
                $komik_cari = $this->m_pemasukan->where('jenis_transaksi', 'pemasukan'); //menampilkan dengan kondisi
            }
            $data = [
                'title' => 'Daftar Pemasukan | Musholla At-Taubah',
                //'komik' => $this->m_keluar->getKeluar(),
                //membuat pagination
                'komik' => $komik_cari->paginate(10, 'komik'),
                'pager' => $this->m_pemasukan->pager,
                'currentPage' => $currentPage
            ];


            return view('Pemasukan/index', $data);
        }
    }

    public function detail($slug)
    {
        $komik = $this->m_pemasukan->getKeluar($slug);
        $data = [
            'title' => 'Detail Pemasukan | Musholla At-Taubah',
            'komik' => $komik
        ];

        //jika komik tidak ada di lebel
        if (empty($data['komik'])) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Judul Komik' . $slug . 'tidak ditemukan');
        };
        return view('Pemasukan/detail', $data);
    }
    public function create()
    {

        $data = [
            'title' => 'Tambah Data Pemasukan | Musholla At-Taubah',
            'kode_otomatis' => $this->m_pemasukan->get_idotomatis(),
            'validation' => \Config\Services::validation() //membuat validasi
        ];
        return view('Pemasukan/create', $data);
    }
    public function save()
    {
        //validasi input
        if (!$this->validate([
            'rincian_transaksi' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'rincian harus diisi'
                    // 'is_unique' => '{field} komik sudah terdaftar'
                ]
            ],
            'jumlah' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'jumlah harus diisi'
                    // 'is_unique' => '{field} komik sudah terdaftar'
                ]
            ],
            'kuitansi' => [
                'rules' => 'max_size[kuitansi,1024]|is_image[kuitansi]|mime_in[kuitansi,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    //'uploaded' => 'Pilih Gambar sampul terlebih dahulu',
                    'max_size' => 'Ukuan gambar terlalu besar',
                    'is_image' => 'Yang anda pilih bukan gambar',
                    'mime_in' => 'Yang anda pilih bukan gambar'
                ]
            ]
        ])) {
            //$validation = \Config\Services::validation();
            //dd($validation);
            //$data['validation'] = $validation;
            //return redirect()->to('/Komik/create')->withInput()->with('validation', $validation);
            return redirect()->to('/c_pemasukan/create')->withInput();
        }

        //ambil gambar
        $fileSampul = $this->request->getFile('kuitansi');
        //cek upload file
        if ($fileSampul->getError() == 4) {
            $namaSampul = 'default.jpg';
        } else {
            // membuat nama random
            $namaSampul = $fileSampul->getRandomName();
            //pindahkan file ke folder img
            $fileSampul->move('img', $namaSampul);

            //ambil nama file
            //$namaSampul = $fileSampul->getName();
        }


        //membuat sepasi menjadi tanda '-'
        //$slug = url_title($this->request->getVar('jenis_transaksi'), '-', true);
        $this->m_pemasukan->insert([
            'id_transaksi' => $this->m_pemasukan->get_idotomatis(),
            'rincian_transaksi' => $this->request->getVar('rincian_transaksi'),
            // //'slug' => $slug,
            'jumlah' => $this->request->getVar('jumlah'),
            'jenis_transaksi' => $this->request->getVar('jenis_transaksi'),
            'struk' => $namaSampul
        ]);
        //dd($this->request->getVar());
        session()->setFlashdata('pesan', 'Data Berhasil Ditambahkan');
        return redirect()->to('/c_pemasukan/create');
    }

    public function delete($id = null)
    {
        //menampilkan nama file sesuai id
        $komik = $this->m_pemasukan->where('id_transaksi', $id)->first();
        //cek file gambar defauld.jpg
        if ($komik['struk'] != 'default.jpg') {
            //hapus gambar di folder
            unlink("img/" . $komik['struk']);
        }

        $this->m_pemasukan->where('id_transaksi', $id)->delete();
        session()->setFlashdata('pesan', 'Data Berhasil Dihapus');
        return redirect()->to('/c_pemasukan');
    }
    public function edit($slug)
    {
        //$komik = $this->komikModel->findAll();
        $data = [
            'title' => 'Edit Data Pemasukan | Musholla At-Taubah',
            'validation' => \Config\Services::validation(),
            'komik' =>  $this->m_pemasukan->getKeluar($slug)
        ];


        return view('Pemasukan/edit', $data);
    }
    public function update($id)
    {
        $fileSampul = $this->request->getFile('kuitansi');
        //cek gambar update
        if ($fileSampul->getError() == 4) {
            $namaSampul = $this->request->getVar('file_nama_lama');
        } else {
            //generate nama random
            $namaSampul = $fileSampul->getRandomName();
            //pindahkan gambar
            $fileSampul->move('img', $namaSampul);
            //hapus file lama
            //unlink('img/' . $this->request->getVar('file_nama_lama'));
        }

        $this->m_pemasukan->update(['id_transaksi' => $id], [
            'rincian_transaksi' => $this->request->getVar('rincian_transaksi'),
            // //'slug' => $slug,
            'jumlah' => $this->request->getVar('jumlah'),
            'jenis_transaksi' => $this->request->getVar('jenis_transaksi'),
            'struk' => $namaSampul
        ]);
        //dd($this->request->getVar());
        session()->setFlashdata('pesan', 'Data Berhasil Diubah');
        return redirect()->to('/c_pemasukan');
    }
}
