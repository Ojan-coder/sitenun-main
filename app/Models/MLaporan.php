<?php

namespace App\Models;

use CodeIgniter\Model;

class MLaporan extends Model
{
    function getmaterial()
    {
        return $this->db
            ->table('tbl_bahan_baku')
            ->get()->getResultArray();
    }

    function getproduk()
    {
        return $this->db
            ->table('tbl_produk')
            ->join('tbl_jenis_tenun', 'tbl_jenis_tenun.kode_jenis=tbl_produk.kode_jenis_motif')
            ->get()->getResultArray();
    }
    function getpelanggan()
    {
        return $this->db
            ->table('pelanggan')
            ->get()
            ->getResultArray();
    }
    function getpembelianbahanbaku($tglawal, $tglakhir)
    {
        return $this->db->table('tbl_bahan_baku_masuk')
            ->join('tbl_detail_bahan_baku_masuk', 'tbl_bahan_baku_masuk.kode_bahan_baku_masuk=tbl_detail_bahan_baku_masuk.kode_bahan_baku_masuk_detail')
            ->join('tbl_bahan_baku', 'tbl_detail_bahan_baku_masuk.kode_bahan_baku_detail=tbl_bahan_baku.kode_bahan_baku')
            ->where('tgl_bahan_baku_masuk >=', $tglawal)
            ->where('tgl_bahan_baku_masuk <=', $tglakhir)
            ->get()->getResultArray();
    }
    function getpemesanan($tglawal, $tglakhir)
    {
        return $this->db
            ->table('tbl_pemesanan')
            ->join('pelanggan', 'tbl_pemesanan.kode_pelanggan = pelanggan.kodepelanggan')
            ->join('tbl_penjualan_detail', 'tbl_pemesanan.kode_pemesanan = tbl_penjualan_detail.no_pemesanan_detail')
            ->join('tbl_produk', 'tbl_produk.kode_produk = tbl_penjualan_detail.kode_produk_penjualan_detail')
            ->join('tbl_jenis_tenun', 'tbl_produk.kode_jenis_motif = tbl_jenis_tenun.kode_jenis')
            ->join('level_status', 'kode_status=status_pemesanan')
            ->where('tgl_pemesanan >=', $tglawal)
            ->where('tgl_pemesanan <=', $tglakhir)
            ->get()->getResultArray();
    }

    function getpenjualan($tglawal, $tglakhir)
    {
        return $this->db
            ->table('tbl_penjualan')
            ->join('tbl_penjualan_detail', 'tbl_penjualan.no_transaksi_penjualan = tbl_penjualan_detail.no_transaksi_penjualan_detail')
            ->join('pelanggan', 'tbl_penjualan.kode_pelanggan = pelanggan.kodepelanggan')
            ->join('tbl_produk', 'tbl_produk.kode_produk = tbl_penjualan_detail.kode_produk_penjualan_detail')
            ->join('tbl_jenis_tenun', 'tbl_produk.kode_jenis_motif = tbl_jenis_tenun.kode_jenis')
            ->where('tgl_penjualan >=',$tglawal)
            ->where('tgl_penjualan <=',$tglakhir)
            ->get()->getResultArray();
    }

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
            ->join('tbl_penjualan_detail', 'tbl_pemesanan.kode_pemesanan=tbl_penjualan_detail.no_pemesanan_detail')
            ->join('tbl_produk', 'tbl_produk.kode_produk = tbl_penjualan_detail.kode_produk_penjualan_detail')
            ->join('tbl_jenis_tenun', 'tbl_produk.kode_jenis_motif = tbl_jenis_tenun.kode_jenis')
            ->where('no_pemesanan_detail', $id)->get()->getResultArray();
    }

    function getDetailPenjualan($id)
    {
        return $this->db
            ->table('tbl_penjualan')
            ->join('tbl_penjualan_detail', 'tbl_penjualan.no_transaksi_penjualan=tbl_penjualan_detail.no_transaksi_penjualan_detail')
            ->join('tbl_produk', 'tbl_produk.kode_produk = tbl_penjualan_detail.kode_produk_penjualan_detail')
            ->join('tbl_jenis_tenun', 'tbl_produk.kode_jenis_motif = tbl_jenis_tenun.kode_jenis')
            ->where('no_transaksi_penjualan_detail', $id)->get()->getResultArray();
    }
}
