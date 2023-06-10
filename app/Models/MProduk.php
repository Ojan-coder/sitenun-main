<?php

namespace App\Models;

use CodeIgniter\Model;

class MProduk extends Model
{
    function koderandom()
    {
        $kode = $this->db->table('produk')
            ->select('RIGHT(kodeproduk,2) as iduser', false)
            ->orderBy('iduser', 'DESC')
            ->limit(1)
            ->get()->getRowArray();

        if (!empty($kode['iduser'])) {
            $no = $kode['iduser'] + 1;
        } else if (empty($kode['iduser'])) {
            $no = "1";
        }
        $huruf = "PR-";
        $batas = str_pad($no, 2, "00", STR_PAD_LEFT);
        $kodeu = $huruf . $batas;
        return $kodeu;
    }

    function getAlldata()
    {
        return $this->db->table('produk')->get()->getResultArray();
    }

    public function detail($id)
    {
        return $this->db
            ->table('produk')
            ->where('kodeproduk', $id)->get()->getRowArray();
    }

    public function insert_data($data)
    {
        return $this->db->table('produk')->insert($data);
    }
    function update_data($data, $id)
    {
        return $this->db->table('produk')->update($data, ['kodeproduk' => $id]);
    }
    public function hapus($id)
    {
        return $this->db->table('produk')->delete(['kodeproduk' => $id]);
    }
}
// return $this->db
//             ->table($table)
//             ->select('*')
//             ->join('jenistransaksi', 'd_jenistransaksi=kodejenis')
//             ->where($table . '.d_nisnsiswa', $id)
//             ->where('d_tgltransaksi', $date)
//             ->get()->getResultArray();