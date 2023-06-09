<?php

namespace App\Models;

use CodeIgniter\Model;

class MPelanggan extends Model
{
    function getAlldata()
    {
        $this->db->table('pelanggan')->get();
    }
    function getAllDataKota()
    {
        return $this->db->table('kota')->get()->getResultArray();
    }
}
