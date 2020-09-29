<?php

namespace App\Models;

use CodeIgniter\Model;

class m_user extends Model
{
    protected $table      = 'pengguna';
    protected $useTimestamps = true;
    protected $allowedFields = ['username', 'password'];

    public function cek_login($username, $password)
    {
        return $this->db->table('pengguna')
            ->get()->getRowArray();
    }
}
