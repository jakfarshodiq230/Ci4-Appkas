<?php

namespace App\Models;

use CodeIgniter\Model;

class m_pengeluaran extends Model
{
    protected $table      = 'transaksi_kas';
    protected $useTimestamps = true;
    protected $primaryKey = 'id_transaksi';
    protected $allowedFields = ['id_transaksi', 'rincian_transaksi', 'jumlah', 'harga', 'total', 'struk', 'jenis_transaksi'];
    //searchi
    public function  search($cari)
    {
        // $builder = $this->table('komik');
        // $builder->like('judul', $cari);
        // return $builder;

        return $this->table('transaksi_kas')->like('rincian_transaksi', $cari)->orLike('id_transaksi', $cari);
    }
    public function getKeluar($slug = false)
    {
        if ($slug == false) {
            return $this->findAll();
        }
        return $this->where(['id_transaksi' => $slug])->first();
    }
}
