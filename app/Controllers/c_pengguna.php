<?php

namespace App\Controllers;

use  App\Models\m_pengguna;
use CodeIgniter\Validation\Rules;

class c_pengguna extends BaseController
{
    protected $m_pengguna;

    public function __construct()
    {
        $this->m_pengguna = new m_pengguna();
    }

    public function index()
    {
        if (session()->get('username') == '') {
            return redirect()->to(base_url('/'));
        } else {
            //ambil halaman url utuk hitungan halaman
            $currentPage = $this->request->getVar('page_orang') ? $this->request->getVar('page_orang') : 1;
            //$komik = $this->komikModel->findAll();
            // sercing data
            $cari = $this->request->getVar('cari');
            if ($cari) {
                $Orang_cari =  $this->m_pengguna->search($cari);
            } else {
                //cari tidak ada
                $Orang_cari = $this->m_pengguna;
            }
            $data = [
                'title' => 'Daftar Pengguna | Belajar Ci4',
                //'komik' => $this->komikModel->getKomik()
                //membuat pagination
                'data_join' => $this->m_pengguna->getJoin(),
                'pengguna' => $Orang_cari->paginate(10, 'pengguna'),
                'pager' => $this->m_pengguna->pager,
                'currentPage' => $currentPage
            ];


            return view('Pengguna/index', $data);
        }
    }
    public function create()
    {

        $data = [
            'title' => 'Tambah Data Pengguna | Musholla At-Taubah',
            'kode_otomatis' => $this->m_pengguna->get_idotomatis(),
            'wilayah_provinsi' => $this->m_pengguna->getProvinsi(),
            'validation' => \Config\Services::validation() //membuat validasi
        ];
        return view('Pengguna/create', $data);
    }
    function get_kabupaten()
    {
        $id = $this->request->getPost('id');
        $data = $this->m_pengguna->getKabupaten($id);
        echo json_encode($data);
    }

    function get_kecamatan()
    {
        $id = $this->request->getPost('id_kecamatan');
        $data = $this->m_pengguna->getKecamatan($id);
        echo json_encode($data);
    }

    function get_kelurahan()
    {
        $id = $this->request->getPost('id_kelurahan');
        $data = $this->m_pengguna->getKelurahan($id);
        echo json_encode($data);
    }

    public function save()
    {
        //validasi input
        if (!$this->validate([
            'nama' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'nama harus diisi'
                    // 'is_unique' => '{field} komik sudah terdaftar'
                ]
            ],
            'provinsi' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'provinsi harus diisi'
                    // 'is_unique' => '{field} komik sudah terdaftar'
                ]
            ],
            'kecamatan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'kecamatan harus diisi'
                    // 'is_unique' => '{field} komik sudah terdaftar'
                ]
            ],
            'kabupaten' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'kabupaten harus diisi'
                    // 'is_unique' => '{field} komik sudah terdaftar'
                ]
            ],
            'kelurahan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'kelurahan harus diisi'
                    // 'is_unique' => '{field} komik sudah terdaftar'
                ]
            ],
            'foto' => [
                'rules' => 'max_size[foto,1024]|is_image[foto]|mime_in[foto,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    //'uploaded' => 'Pilih Gambar sampul terlebih dahulu',
                    'max_size' => 'Ukuan gambar terlalu besar',
                    'is_image' => 'Yang anda pilih bukan gambar',
                    'mime_in' => 'Yang anda pilih bukan gambar'
                ]
            ]
        ])) {
            return redirect()->to('/c_pengguna/create')->withInput();
        }

        //ambil gambar
        $fileSampul = $this->request->getFile('foto');
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
        $konver = $this->request->getVar('password');
        $this->m_pengguna->insert([
            'id_user' => $this->m_pengguna->get_idotomatis(),
            'nama' => $this->request->getVar('nama'),
            'kd_provinsi' => $this->request->getVar('provinsi'),
            'kd_kabupaten' => $this->request->getVar('kabupaten'),
            'kd_kecamatan' => $this->request->getVar('kecamatan'),
            'kd_desa' => $this->request->getVar('kelurahan'),
            'username' => $this->request->getVar('username'),
            'password' => md5($konver),
            'foto' => $namaSampul
        ]);
        //dd($this->request->getVar());
        session()->setFlashdata('pesan', 'Data Berhasil Ditambahkan');
        return redirect()->to('/c_pengguna');
    }
    public function edit($slug)
    {
        //$komik = $this->komikModel->findAll();

        $data = [
            'title' => 'Edit Data Pemasukan | Musholla At-Taubah',
            'validation' => \Config\Services::validation(),
            'komik' =>  $this->m_pengguna->getKeluar($slug),
            'wilayah_provinsi' => $this->m_pengguna->getProvinsi(),
            'wilayah_kabupaten' => $this->m_pengguna->getKabupaten1(),
            'wilayah_kecamatan' => $this->m_pengguna->getKecamatan1(),
            'wilayah_kelurahan' => $this->m_pengguna->getKelurahan1(),
        ];
        return view('Pengguna/edit', $data);
    }

    public function update($id)
    {
        $fileSampul = $this->request->getFile('foto');
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

        $this->m_pengguna->update(['id_user' => $id], [
            //'id_user' => $this->m_pengguna->get_idotomatis(),
            'nama' => $this->request->getVar('nama'),
            'kd_provinsi' => $this->request->getVar('provinsi'),
            'kd_kabupaten' => $this->request->getVar('kabupaten'),
            'kd_kecamatan' => $this->request->getVar('kecamatan'),
            'kd_desa' => $this->request->getVar('kelurahan'),
            'username' => $this->request->getVar('username'),
            //'password' => md5($konver),
            'foto' => $namaSampul
        ]);
        //dd($this->request->getVar());
        session()->setFlashdata('pesan', 'Data Berhasil Diubah');
        return redirect()->to('/c_pengguna');
    }
    public function detail($slug)
    {
        $komik = $this->m_pengguna->getKeluar($slug);
        $data = [
            'title' => 'Detail Pengguna | Musholla At-Taubah',
            'komik' => $komik
        ];

        //jika komik tidak ada di lebel
        if (empty($data['komik'])) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Judul Komik' . $slug . 'tidak ditemukan');
        };
        return view('Pengguna/detail', $data);
    }
    public function delete($id = null)
    {
        //menampilkan nama file sesuai id
        $komik = $this->m_pengguna->where('id_user', $id)->first();
        //cek file gambar defauld.jpg
        if ($komik['foto'] != 'default.jpg') {
            //hapus gambar di folder
            unlink("img/" . $komik['foto']);
        }

        $this->m_pengguna->where('id_user', $id)->delete();
        session()->setFlashdata('pesan', 'Data Berhasil Dihapus');
        return redirect()->to('/c_pengguna');
    }
}
