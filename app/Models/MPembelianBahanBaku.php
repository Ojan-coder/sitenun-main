<?php

namespace App\Models;

use CodeIgniter\Model;

class MPembelianBahanBaku extends Model
{
    function koderandom()
    {
        $kode = $this->db->table('tbl_bahan_baku_masuk')
            ->select('RIGHT(kode_bahan_baku_masuk,3) as iduser', false)
            ->orderBy('iduser', 'DESC')
            ->limit(1)
            ->get()->getRowArray();

        if (!empty($kode['iduser'])) {
            $no = $kode['iduser'] + 1;
        } else if (empty($kode['iduser'])) {
            $no = "1";
        }
        $huruf = "FK-BM-";
        $batas = str_pad($no, 3, "000", STR_PAD_LEFT);
        $kodeu = $huruf . $batas;
        return $kodeu;
    }

    function getDataTableDetail()
    {
        $id = $this->koderandom();
        // $id="PR-02";
        return $this->db
            ->table('tbl_detail_bahan_baku_masuk')
            ->join('tbl_bahan_baku', 'tbl_bahan_baku.kode_bahan_baku = tbl_detail_bahan_baku_masuk.kode_bahan_baku_detail')
            ->where('kode_bahan_baku_masuk_detail', $id)->get()->getResultArray();
    }

    function getAlldata()
    {
        return $this->db->table('tbl_bahan_baku_masuk')
            ->join('tbl_detail_bahan_baku_masuk', 'tbl_bahan_baku_masuk.kode_bahan_baku_masuk=tbl_detail_bahan_baku_masuk.kode_bahan_baku_masuk_detail')
            ->join('tbl_bahan_baku', 'tbl_detail_bahan_baku_masuk.kode_bahan_baku_detail=tbl_bahan_baku.kode_bahan_baku')
            ->groupBy('kode_bahan_baku_masuk')
            ->get()->getResultArray();
    }

    function getDetail($id)
    {
        return $this->db->table('tbl_detail_bahan_baku_masuk')
            ->join('tbl_bahan_baku', 'tbl_detail_bahan_baku_masuk.kode_bahan_baku_detail=tbl_bahan_baku.kode_bahan_baku')
            ->where('kode_bahan_baku_masuk_detail',$id)
            ->get()->getResultArray();
    }

    public function insert_data_temp($data)
    {
        return $this->db->table('tbl_detail_bahan_baku_masuk')->insert($data);
    }

    public function insert_data($data)
    {
        return $this->db->table('tbl_bahan_baku_masuk')->insert($data);
    }
    public function hapus($id)
    {
        return $this->db->table('tbl_bahan_baku_masuk')->delete(['kode_bahan_baku_masuk' => $id]);
    }
    public function hapus_detail_semua($id_detail)
    {
        return $this->db->table('tbl_detail_bahan_baku_masuk')->delete(['kode_bahan_baku_masuk_detail' => $id_detail]);
    }
    public function hapus_detail($id_detail)
    {
        return $this->db->table('tbl_detail_bahan_baku_masuk')->delete(['id' => $id_detail]);
    }
}
