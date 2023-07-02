<?php

namespace App\Models;

use CodeIgniter\Model;

class MJenisMotif extends Model
{
    function koderandom()
    {
        $kode = $this->db->table('tbl_jenis_tenun')
            ->select('RIGHT(kode_jenis,2) as iduser', false)
            ->orderBy('iduser', 'DESC')
            ->limit(1)
            ->get()->getRowArray();

        if (!empty($kode['iduser'])) {
            $no = $kode['iduser'] + 1;
        } else if (empty($kode['iduser'])) {
            $no = "1";
        }
        $huruf = "JT-";
        $batas = str_pad($no, 2, "00", STR_PAD_LEFT);
        $kodeu = $huruf . $batas;
        return $kodeu;
    }

    function getAlldata()
    {
        return $this->db->table('tbl_jenis_tenun')->get()->getResultArray();
    }

    public function detail($id)
    {
        return $this->db
            ->table('tbl_jenis_tenun')
            ->where('kode_jenis', $id)->get()->getRowArray();
    }

    public function insert_data($data)
    {
        return $this->db->table('tbl_jenis_tenun')->insert($data);
    }
    function update_data($data, $id)
    {
        return $this->db->table('tbl_jenis_tenun')->update($data, ['kode_jenis' => $id]);
    }
    public function hapus($id)
    {
        return $this->db->table('tbl_jenis_tenun')->delete(['kode_jenis' => $id]);
    }
}
