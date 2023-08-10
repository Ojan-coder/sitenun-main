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
            ->join('tbl_karyawan','kodekaryawan=kode_user','LEFT')
            ->join('pelanggan','kodepelanggan=kode_user','LEFT')
            ->where('kode_user', $id)->get()->getRowArray();
    }
    public function insert_data($data)
    {
        return $this->db->table('user')->insert($data);
    }
    function update_data($data, $id)
    {
        return $this->db->table('user')->update($data, ['kode_user' => $id]);
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