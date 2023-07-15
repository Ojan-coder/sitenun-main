<?php

namespace App\Models;

use CodeIgniter\Model;

class MLaporan extends Model
{
    function detailpelanggan($id)
    {
        return $this->db
            ->table('pelanggan')
            ->where('kodepelanggan', $id)->get()->getRowArray();
    }
    function getDetailPemesanan($id)
    {
        return $this->db
            ->table('tbl_pemesanan')
            ->join('tbl_penjualan_detail','tbl_pemesanan.kode_pemesanan=tbl_penjualan_detail.no_pemesanan_detail')
            ->join('tbl_produk', 'tbl_produk.kode_produk = tbl_penjualan_detail.kode_produk_penjualan_detail')
            ->join('tbl_jenis_tenun', 'tbl_produk.kode_jenis_motif = tbl_jenis_tenun.kode_jenis')
            ->where('no_pemesanan_detail', $id)->get()->getResultArray();
    }
}
