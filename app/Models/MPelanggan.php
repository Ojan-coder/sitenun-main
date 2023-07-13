<?php

namespace App\Models;

use CodeIgniter\Model;

class MPelanggan extends Model
{
    function koderandom()
    {
        $kode = $this->db->table('pelanggan')
            ->select('RIGHT(kodepelanggan,2) as iduser', false)
            ->orderBy('iduser', 'DESC')
            ->limit(1)
            ->get()->getRowArray();

        if (!empty($kode['iduser'])) {
            $no = $kode['iduser'] + 1;
        } else if (empty($kode['iduser'])) {
            $no = "1";
        }
        $huruf = "PR-";
        $batas = str_pad($no, 2, "00", STR_PAD_LEFT);
        $kodeu = $huruf . $batas;
        return $kodeu;
    }
    function getAlldata()
    {
        return $this->db
        ->table('pelanggan')
        ->join('tbl_jeniskelamin','kodejenkel=kode_jenkel')
        ->get()
        ->getResultArray();
    }
    function getAllJenkel()
    {
        return $this->db->table('tbl_jeniskelamin')->get()->getResultArray();
    }
    function getAllDataKota()
    {
        return $this->db->table('kota')->get()->getResultArray();
    }
    public function detail($id)
    {
        return $this->db
            ->table('pelanggan')
            ->where('kodepelanggan', $id)->get()->getRowArray();
    }
    public function insert_data($data)
    {
        return $this->db->table('pelanggan')->insert($data);
    }
    function update_data($data, $id)
    {
        return $this->db->table('pelanggan')->update($data, ['kodepelanggan' => $id]);
    }
    public function hapus($id)
    {
        return $this->db->table('pelanggan')->delete(['kodepelanggan' => $id]);
    }
}
