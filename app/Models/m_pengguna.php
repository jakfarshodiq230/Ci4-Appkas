<?php

namespace App\Models;

use CodeIgniter\Model;

class m_pengguna extends Model
{
    protected $table      = 'pengguna';
    protected $useTimestamps = true;
    protected $primaryKey = 'id_user';
    protected $allowedFields = ['id_user', 'nama', 'username', 'password', 'kd_provinsi', 'kd_kabupaten', 'kd_kecamatan', 'kd_desa', 'foto'];

    public function getJoin()
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('pengguna');
        $builder->select('pengguna.`nama` as nama_pengguna,wilayah_provinsi.`nama` as nama_provinsi,username,id_user');
        $builder->join('wilayah_provinsi', ' wilayah_provinsi.`id`=pengguna.`kd_provinsi`');
        $builder->orderBy('nama_pengguna', 'ASC');
        $query = $builder->get();
        return $query;
    }

    //searchi
    public function  search($cari)
    {
        return $this->table('pengguna')->like('nama', $cari)->orLike('username', $cari);
    }
    public function getKeluar($slug = false)
    {
        if ($slug == false) {
            $db      = \Config\Database::connect();
            $builder = $db->table('pengguna');
            $builder->select('pengguna.`nama` as nama_pengguna,wilayah_provinsi.`nama` as nama_provinsi,username,id_user,foto');
            $builder->join('wilayah_provinsi', ' wilayah_provinsi.`id`=pengguna.`kd_provinsi`');
            $builder->orderBy('nama_pengguna', 'ASC');
            $query = $builder->get();
            return $query;
            //return $this->findAll();
        }
        $db      = \Config\Database::connect();
        $builder = $db->table('pengguna');
        $builder->select('pengguna.kd_provinsi,pengguna.kd_kabupaten,pengguna.kd_kecamatan,pengguna.kd_desa,
        pengguna.`nama` as nama_pengguna,wilayah_provinsi.`nama` as nama_provinsi,wilayah_kabupaten.`nama` as nama_kabupaten,
        wilayah_kecamatan.`nama` as nama_kecamatan,wilayah_desa.`nama` as nama_kelurahan,username,password,id_user,foto,created_at');
        $builder->join('wilayah_provinsi', ' wilayah_provinsi.`id`=pengguna.`kd_provinsi`');
        $builder->join('wilayah_kabupaten', ' wilayah_kabupaten.`id`=pengguna.`kd_kabupaten`');
        $builder->join('wilayah_kecamatan', ' wilayah_kecamatan.`id`=pengguna.`kd_kecamatan`');
        $builder->join('wilayah_desa', ' wilayah_desa.`id`=pengguna.`kd_desa`');
        $builder->where('id_user', $slug);
        $query = $builder->get()->getRowArray();
        return $query;
        //return $this->where(['id_user' => $slug])->first();
    }
    public function get_idotomatis()
    {
        $q = $this->db->query("SELECT MAX(RIGHT(id_user,4)) AS kd_max FROM pengguna ");
        $kd = "";
        if ($q) {
            foreach ($q->getresult() as $k) {
                $tmp = ((int)$k->kd_max) + 1;
                $kd = sprintf("%04s", $tmp);
            }
        } else {
            $kd = "0001";
        }
        date_default_timezone_set('Asia/Jakarta');
        return date('dmY') . $kd;
    }
    public function getProvinsi()
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('wilayah_provinsi');
        $builder->select('*');
        $builder->orderBy('nama', 'ASC');
        $query = $builder->get();
        return $query;
    }
    public function getKabupaten1()
    {
        $db2      = \Config\Database::connect();
        $builder2 = $db2->table('wilayah_kabupaten');
        $builder2->select('*');
        $builder2->orderBy('nama', 'ASC');
        $hasil = $builder2->get();
        return $hasil;
    }
    public function getKabupaten($id)
    {
        $db2      = \Config\Database::connect();
        $builder2 = $db2->table('wilayah_kabupaten');
        $builder2->select('*');
        $builder2->where('provinsi_id', $id);
        $builder2->orderBy('nama', 'ASC');
        $hasil = $builder2->get();
        return $hasil->getresult();
    }
    public function getKecamatan1()
    {
        $db3      = \Config\Database::connect();
        $builder3 = $db3->table('wilayah_kecamatan');
        $builder3->select('*');
        $builder3->orderBy('nama', 'ASC');
        $hasil3 = $builder3->get();
        return $hasil3;
    }
    public function getKecamatan($id_kecamatan)
    {
        $db3      = \Config\Database::connect();
        $builder3 = $db3->table('wilayah_kecamatan');
        $builder3->select('*');
        $builder3->where('kabupaten_id', $id_kecamatan);
        $builder3->orderBy('nama', 'ASC');
        $hasil3 = $builder3->get();
        return $hasil3->getresult();
    }
    public function getKelurahan1()
    {
        $db4      = \Config\Database::connect();
        $builder4 = $db4->table('wilayah_desa');
        $builder4->select('*');
        $builder4->orderBy('nama', 'ASC');
        $hasil4 = $builder4->get();
        return $hasil4;
    }
    public function getKelurahan($id_kecamatan)
    {
        $db4      = \Config\Database::connect();
        $builder4 = $db4->table('wilayah_desa');
        $builder4->select('*');
        $builder4->where('kecamatan_id', $id_kecamatan);
        $builder4->orderBy('nama', 'ASC');
        $hasil4 = $builder4->get();
        return $hasil4->getresult();
    }
}
