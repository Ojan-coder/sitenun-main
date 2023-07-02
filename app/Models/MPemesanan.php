<?php

namespace App\Models;

use CodeIgniter\Model;

class MPemesanan extends Model
{
    public function getAllData(){
        return $this->db->table('tbl_pemesanan')->get()->getResultArray();
    }
}
