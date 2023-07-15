<?php

namespace App\Models;

use CodeIgniter\Model;

class MProduksi extends Model
{
    function koderandom()
    {
        $kode = $this->db->table('tbl_produksi')
            ->select('RIGHT(kode_produksi,2) as iduser', false)
            ->orderBy('iduser', 'DESC')
            ->limit(1)
            ->get()->getRowArray();

        if (!empty($kode['iduser'])) {
            $no = $kode['iduser'] + 1;
        } else if (empty($kode['iduser'])) {
            $no = "1";
        }
        $huruf = "PS-";
        $batas = str_pad($no, 2, "00", STR_PAD_LEFT);
        $kodeu = $huruf . $batas;
        return $kodeu;
    }

    function getAlldata()
    {
        return $this->db->table('tbl_produksi')
            ->join('tbl_produk', 'tbl_produksi.kode_produk=tbl_produk.kode_produk')
            ->join('tbl_jenis_tenun', 'tbl_jenis_tenun.kode_jenis=tbl_produk.kode_jenis_motif')
            ->get()->getResultArray();
    }

    function getDataTableDetail()
    {
        $id = $this->koderandom();
        // $id="PR-02";
        return $this->db
            ->table('tbl_produksi_detail')
            ->join('tbl_bahan_baku', 'tbl_bahan_baku.kode_bahan_baku = tbl_produksi_detail.kode_bahan_baku_detail')
            ->where('kode_produksi_detail', $id)->get()->getResultArray();
    }


    public function insert_data_temp($data)
    {
        return $this->db->table('tbl_produksi_detail')->insert($data);
    }

    public function insert_data($data)
    {
        return $this->db->table('tbl_produksi')->insert($data);
    }
    function update_data($data, $id)
    {
        return $this->db->table('tbl_produksi')->update($data, ['kode_produksi' => $id]);
    }
    public function hapus($id)
    {
        return $this->db->table('tbl_produksi')->delete(['kode_produksi' => $id]);
    }
    public function hapus_detail($id, $id_detail)
    {
        return $this->db->table('tbl_produksi_detail')->delete(['id' => $id_detail]);
    }
}
