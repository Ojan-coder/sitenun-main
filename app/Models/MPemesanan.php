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
            ->join('tbl_produk', 'tbl_produk.kode_produk = tbl_penjualan_detail.kode_produk_penjualan_detail')
            ->join('tbl_jenis_tenun', 'tbl_produk.kode_jenis_motif = tbl_jenis_tenun.kode_jenis')
            ->where('no_pemesanan_detail', $id)->get()->getResultArray();
    }
    public function insert_data_temp($data)
    {
        return $this->db->table('tbl_penjualan_detail')->insert($data);
    }

    public function insert_data($data)
    {
        return $this->db->table('tbl_pemesanan')->insert($data);
    }

    public function hapus($id)
    {
        return $this->db->table('tbl_pemesanan')->delete(['kode_produksi' => $id]);
    }
    public function hapus_detail($id, $id_detail)
    {
        return $this->db->table('tbl_penjualan_detail')->delete(['id' => $id_detail]);
    }
}
