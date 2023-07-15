<?php

namespace App\Models;

use CodeIgniter\Model;

class MPenjualan extends Model
{
    function koderandom()
    {
        $kode = $this->db->table('tbl_penjualan')
            ->select('RIGHT(no_transaksi_penjualan,3) as iduser', false)
            ->orderBy('iduser', 'DESC')
            ->limit(1)
            ->get()->getRowArray();

        if (!empty($kode['iduser'])) {
            $no = $kode['iduser'] + 1;
        } else if (empty($kode['iduser'])) {
            $no = "1";
        }
        $huruf = "FK-PJ-";
        $batas = str_pad($no, 3, "000", STR_PAD_LEFT);
        $kodeu = $huruf . $batas;
        return $kodeu;
    }
    function getAllDataByPelanggan()
    {
        return $this->db
            ->table('tbl_penjualan')
            ->join('pelanggan', 'tbl_penjualan.kode_pelanggan = pelanggan.kodepelanggan')
            ->join('tbl_penjualan_detail', 'tbl_penjualan.no_transaksi_penjualan = tbl_penjualan_detail.no_pemesanan_detail')
            ->join('tbl_produk', 'tbl_produk.kode_produk = tbl_penjualan_detail.kode_produk_penjualan_detail')
            ->join('tbl_jenis_tenun', 'tbl_produk.kode_jenis_motif = tbl_jenis_tenun.kode_jenis')
            ->join('level_status', 'kode_status=status_pemesanan')
            ->get()->getResultArray();
    }
    public function getAllData()
    {
        return $this->db
            ->table('tbl_penjualan')
            ->join('tbl_penjualan_detail', 'tbl_penjualan.no_transaksi_penjualan = tbl_penjualan_detail.no_transaksi_penjualan_detail')
            ->join('pelanggan', 'tbl_penjualan.kode_pelanggan = pelanggan.kodepelanggan')
            ->join('tbl_produk', 'tbl_produk.kode_produk = tbl_penjualan_detail.kode_produk_penjualan_detail')
            ->join('tbl_jenis_tenun', 'tbl_produk.kode_jenis_motif = tbl_jenis_tenun.kode_jenis')
            ->get()->getResultArray();
    }

    function getDetailPemesanan()
    {
        $id = $this->koderandom();
        return $this->db
            ->table('tbl_penjualan_detail')
            ->join('tbl_produk', 'tbl_produk.kode_produk = tbl_penjualan_detail.kode_produk_penjualan_detail')
            ->join('tbl_jenis_tenun', 'tbl_produk.kode_jenis_motif = tbl_jenis_tenun.kode_jenis')
            ->where('no_transaksi_penjualan_detail', $id)->get()->getResultArray();
    }
    public function insert_data_temp($data)
    {
        return $this->db->table('tbl_penjualan_detail')->insert($data);
    }

    public function insert_data($data)
    {
        return $this->db->table('tbl_penjualan')->insert($data);
    }

    public function hapus($id)
    {
        return $this->db->table('tbl_penjualan')->delete(['kode_produksi' => $id]);
    }
    public function hapus_detail($id_detail)
    {
        return $this->db->table('tbl_penjualan_detail')->delete(['id' => $id_detail]);
    }
}
