<?php

namespace App\Models;

use CodeIgniter\Model;

class MBahanbakumasuk extends Model
{
    function koderandom()
    {
        $kode = $this->db->table('tbl_bahan_baku_masuk')
            ->select('RIGHT(kode_bahan_baku_masuk,2) as iduser', false)
            ->orderBy('iduser', 'DESC')
            ->limit(1)
            ->get()->getRowArray();

        if (!empty($kode['iduser'])) {
            $no = $kode['iduser'] + 1;
        } else if (empty($kode['iduser'])) {
            $no = "1";
        }
        $huruf = "BB-";
        $batas = str_pad($no, 2, "00", STR_PAD_LEFT);
        $kodeu = $huruf . $batas;
        return $kodeu;
    }

    function getAlldata()
    {
        return $this->db->table('tbl_bahan_baku_masuk')->get()->getResultArray();
    }

    public function detail($id)
    {
        return $this->db
            ->table('tbl_bahan_baku_masuk')
            ->where('kode_bahan_baku_masuk', $id)->get()->getRowArray();
    }

    public function insert_data_temp($data)
    {
        return $this->db->table('tbl_detail_bahan_baku_masuk')->insert($data);
    }

    public function insert_data($data)
    {
        return $this->db->table('tbl_bahan_baku_masuk')->insert($data);
    }
    function update_data($dataudpate, $id)
    {
        return $this->db->table('tbl_bahan_baku_masuk')->update($dataudpate, ['kode_bahan_baku_masuk' => $id]);
    }
    public function hapus($id)
    {
        return $this->db->table('tbl_bahan_baku_masuk')->delete(['kode_bahan_baku_masuk' => $id]);
    }
}
