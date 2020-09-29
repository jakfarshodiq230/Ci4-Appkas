<?php

namespace App\Models;

use App\Controllers\c_pemasukan;
use CodeIgniter\Model;

class m_pemasukan extends Model
{
    protected $table      = 'transaksi_kas'; //nama tabel
    protected $useTimestamps = true;
    protected $allowedFields = ['id_transaksi', 'rincian_transaksi', 'jumlah', 'harga', 'total', 'struk', 'jenis_transaksi']; //atribut tabel
    protected $primaryKey = 'id_transaksi';
    public function getKeluar($slug = false)
    {
        if ($slug == false) {
            return $this->findAll();
        }
        return $this->where(['id_transaksi' => $slug])->first();
    }

    public function get_idotomatis()
    {
        $q = $this->db->query("SELECT MAX(RIGHT(id_transaksi,4)) AS kd_max FROM transaksi_kas ");
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

    //searchi
    public function  search($cari)
    {
        // $builder = $this->table('komik');
        // $builder->like('judul', $cari);
        // return $builder;
        //query searcing
        return $this->table('komik')->like('jenis_transaksi', $cari)->orLike('id_transaksi', $cari);
    }
    public function countRow()
    {
        //query count
        return $this->table('komik')->countAllResults();
    }
    public function countFiled()
    {
        //query coun
        return $this->table('komik')->countAllResults();
    }
}
