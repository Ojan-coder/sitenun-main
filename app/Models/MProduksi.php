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
        ->join('tbl_produk','tbl_produksi.kode_produk=tbl_produk.kode_produk')
        ->get()->getResultArray();
    }

    public function detail($id)
    {
        return $this->db
            ->table('tbl_produksi')
            ->where('kode_produksi', $id)->get()->getRowArray();
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
}
