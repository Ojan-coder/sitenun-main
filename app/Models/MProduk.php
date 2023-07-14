<?php

namespace App\Models;

use CodeIgniter\Model;

class MProduk extends Model
{
    function koderandom()
    {
        $kode = $this->db->table('tbl_produk')
            ->select('RIGHT(kode_produk,2) as iduser', false)
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
            ->table('tbl_produk')
            ->join('tbl_jenis_tenun', 'tbl_jenis_tenun.kode_jenis=tbl_produk.kode_jenis_motif')
            ->get()->getResultArray();
    }

    public function detail($id)
    {
        return $this->db
            ->table('tbl_produk')
            ->join('tbl_jenis_tenun', 'tbl_jenis_tenun.kode_jenis=tbl_produk.kode_jenis_motif')
            ->where('kode_produk', $id)->get()->getRowArray();
    }
    public function insert_data($data)
    {
        return $this->db->table('tbl_produk')->insert($data);
    }
    function update_data($data, $id)
    {
        return $this->db->table('tbl_produk')->update($data, ['kode_produk' => $id]);
    }
    public function hapus($id)
    {
        return $this->db->table('tbl_produk')->delete(['kode_produk' => $id]);
    }
}
