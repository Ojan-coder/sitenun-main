<?php

namespace App\Models;

use CodeIgniter\Model;

class MUser extends Model
{
    function getAlldata()
    {
        return $this->db
        ->table('user')
        ->orderBy('username','ASC')
        ->get()
        ->getResultArray();
    }
    function getDataLevel(){
        return $this->db->table('level_user')->get()->getResultArray();
    }
    public function detail($id)
    {
        return $this->db
            ->table('user')
            ->where('iduser', $id)->get()->getRowArray();
    }
    public function insert_data($data)
    {
        return $this->db->table('user')->insert($data);
    }
    function update_data($data, $id)
    {
        return $this->db->table('user')->update($data, ['iduser' => $id]);
    }
    public function hapus($id)
    {
        return $this->db->table('user')->delete(['iduser' => $id]);
    }

    public function ceklogin($username)
    {
        return $this->db->table('user')
            ->where(array('username' => $username))
            ->get()->getRowArray();
    }
}