<?php

namespace App\Models;

use CodeIgniter\Model;

class MBahanbaku extends Model
{
    function koderandom()
    {
        $kode = $this->db->table('tbl_bahan_baku')
            ->select('RIGHT(kode_bahan_baku,2) as iduser', false)
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
        return $this->db->table('tbl_bahan_baku')->get()->getResultArray();
    }

    public function detail($id)
    {
        return $this->db
            ->table('tbl_bahan_baku')
            ->where('kode_bahan_baku', $id)->get()->getRowArray();
    }

    public function insert_data($data)
    {
        return $this->db->table('tbl_bahan_baku')->insert($data);
    }
    function update_data($dataudpate, $id)
    {
        return $this->db->table('tbl_bahan_baku')->update($dataudpate, ['kode_bahan_baku' => $id]);
    }
    public function hapus($id)
    {
        return $this->db->table('tbl_bahan_baku')->delete(['kode_bahan_baku' => $id]);
    }
}
