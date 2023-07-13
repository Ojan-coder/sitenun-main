<?php

namespace App\Models;

use CodeIgniter\Model;

class MPegawai extends Model
{
    function koderandom()
    {
        $kode = $this->db->table('tbl_pegawai')
            ->select('RIGHT(kode_pegawai,2) as iduser', false)
            ->orderBy('iduser', 'DESC')
            ->limit(1)
            ->get()->getRowArray();

        if (!empty($kode['iduser'])) {
            $no = $kode['iduser'] + 1;
        } else if (empty($kode['iduser'])) {
            $no = "1";
        }
        $huruf = "PG-";
        $batas = str_pad($no, 2, "00", STR_PAD_LEFT);
        $kodeu = $huruf . $batas;
        return $kodeu;
    }
    function getAlldata()
    {
        return $this->db
        ->table('tbl_pegawai')
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
            ->table('tbl_pegawai')
            ->where('kode_pegawai', $id)->get()->getRowArray();
    }
    public function insert_data($data)
    {
        return $this->db->table('tbl_pegawai')->insert($data);
    }
    function update_data($data, $id)
    {
        return $this->db->table('tbl_pegawai')->update($data, ['kode_pegawai' => $id]);
    }
    public function hapus($id)
    {
        return $this->db->table('tbl_pegawai')->delete(['kode_pegawai' => $id]);
    }
}
