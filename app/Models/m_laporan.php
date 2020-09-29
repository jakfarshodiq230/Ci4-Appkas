<?php

namespace App\Models;

use App\Controllers\c_laporan;
use CodeIgniter\Model;

class m_laporan extends Model
{
    protected $table      = 'transaksi_kas'; //nama tabel
    protected $useTimestamps = true;
    protected $allowedFields = ['id_transaksi', 'rincian_transaksi', 'jumlah', 'harga', 'total', 'struk', 'jenis_transaksi']; //atribut tabel
    protected $primaryKey = 'id_transaksi';
}
