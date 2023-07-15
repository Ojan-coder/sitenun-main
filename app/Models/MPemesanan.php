<?php

namespace App\Models;

use CodeIgniter\Model;

class MPemesanan extends Model
{
    function koderandom()
    {
        $kode = $this->db->table('tbl_pemesanan')
            ->select('RIGHT(kode_pemesanan,3) as iduser', false)
            ->orderBy('iduser', 'DESC')
            ->limit(1)
            ->get()->getRowArray();

        if (!empty($kode['iduser'])) {
            $no = $kode['iduser'] + 1;
        } else if (empty($kode['iduser'])) {
            $no = "1";
        }
        $huruf = "FK-PO-";
        $batas = str_pad($no, 3, "000", STR_PAD_LEFT);
        $kodeu = $huruf . $batas;
        return $kodeu;
    }
    public function getAllData()
    {
        return $this->db->table('tbl_pemesanan')->get()->getResultArray();
    }

    function getDetailPemesanan()
    {
        $id = $this->koderandom();
        return $this->db
            ->table('tbl_penjualan_detail')
            ->join('tbl_produk', 'tbl_bahan_baku.kode_bahan_baku = tbl_penjualan_detail.kode_produk_penjualan')
            ->where('no_pemesanan_detail', $id)->get()->getResultArray();
    }
}
