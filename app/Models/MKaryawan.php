<?php

namespace App\Models;

use CodeIgniter\Model;

class MKaryawan extends Model
{
    function koderandom()
    {
        $kode = $this->db->table('tbl_karyawan')
            ->select('RIGHT(kodekaryawan,3) as iduser', false)
            ->orderBy('iduser', 'DESC')
            ->limit(1)
            ->get()->getRowArray();

        if (!empty($kode['iduser'])) {
            $no = $kode['iduser'] + 1;
        } else if (empty($kode['iduser'])) {
            $no = "1";
        }
        $huruf = "USR-";
        $batas = str_pad($no, 3, "000", STR_PAD_LEFT);
        $kodeu = $huruf . $batas;
        return $kodeu;
    }
    function getAlldata()
    {
        return $this->db
        ->table('tbl_karyawan')
        ->get()
        ->getResultArray();
    }
    
    function getAllDataKota()
    {
        return $this->db->table('kota')->get()->getResultArray();
    }
    public function detail($id)
    {
        return $this->db
            ->table('tbl_karyawan')
            ->where('kodekaryawan', $id)->get()->getRowArray();
    }
    public function insert_data($data)
    {
        return $this->db->table('tbl_karyawan')->insert($data);
    }
    function update_data($data, $id)
    {
        return $this->db->table('tbl_karyawan')->update($data, ['kodekaryawan' => $id]);
    }
    public function hapus($id)
    {
        return $this->db->table('tbl_karyawan')->delete(['kodekaryawan' => $id]);
    }
}
