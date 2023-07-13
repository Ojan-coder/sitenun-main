<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\MProduksi;


class Produksi extends BaseController
{
    public function index()
    {
        $Produksi = new MProduksi();
        if ((session()->get('masuk') == TRUE) && (session()->get('status') == 'Y' && session()->get('akses1') == '1')) {
            $data = [
                'data' => $Produksi->getAllData(),
                'isi' => 'Transaksi/Produksi/Data'
            ];
            return view('Layout/Template', $data);
        } else {
            return view('errors/error_login.php');
        }
    }
    public function tambah()
    {
        if ((session()->get('masuk') == TRUE) && (session()->get('status') == 'Y')) {
            $data = [
                'isi' => 'Transaksi/Produksi/Add'
            ];
            return view('Layout/Template', $data);
        } else {
            return view('errors/error_login.php');
        }
    }

    function add()
    {
        $valid = $this->validate([
            'nama' => [
                'label'  => 'Nama Bahan Baku',
                'rules'   => 'required',
                'errors' => [
                    'required' => '{field} Wajib Diisi'
                ],
            ],
            'jumlah' => [
                'label'  => 'Jumlah Bahan Baku',
                'rules'   => 'required|',
                'errors' => [
                    'required' => '{field} Wajib Diisi'
                ],
            ]
        ]);

        $Produksi = new MProduksi();
        date_default_timezone_set('Asia/Jakarta');
        $date = date('Y-m-d:H:i:s');
        if (!$valid) {
            session()->setFlashdata('errors', \Config\Services::validation()->getErrors());
            return redirect()->to(base_url('/Admin/Produksi/Tambah'));
        } else {
            $data = [
                'kode_bahan_baku' => $Produksi->koderandom(),
                'nama_bahan_baku' => $this->request->getPost('nama'),
                'satuan_bahan_baku' => $this->request->getPost('cbsatuan'),
                'jumlah_bahan_baku' => $this->request->getPost('jumlah'),
                'created_at' => $date
            ];
            $Produksi = new MProduksi();
            $Produksi->insert_data($data);

            session()->setFlashdata('success', 'Data Bahan Baku Berhasil Ditambahkan');
            return redirect()->to(base_url('/Admin/Produksi'));
        }
    }

    public function delete()
    {
        $id = $this->request->getPost('iduser');
        $usr = new MProduksi();
        $usr->hapus($id);
        session()->setFlashdata('success', 'Data Bahan Baku Berhasil Di Hapus !!');
        return redirect()->to(base_url('/Admin/Produksi'));
    }
}
