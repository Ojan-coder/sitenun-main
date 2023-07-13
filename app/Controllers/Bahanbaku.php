<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\MBahanbaku;
use App\Models\MBahanbakumasuk;

class Bahanbaku extends BaseController
{
    public function index()
    {
        $bahanbaku = new MBahanbaku();
        if ((session()->get('masuk') == TRUE) && (session()->get('status') == 'Y')) {
            $data = [
                'isi' => 'Master/Bahanbaku/Data',
                'data' => $bahanbaku->getAlldata()
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
                'isi' => 'Master/Bahanbaku/Add'
            ];
            return view('Layout/Template', $data);
        } else {
            return view('errors/error_login.php');
        }
    }

    public function add()
    {
        $valid = $this->validate([
            'nama' => [
                'label'  => 'Nama Bahan Baku',
                'rules'   => 'required',
                'errors' => [
                    'required' => '{field} Wajib Diisi !'
                ],
            ]
        ]);

        $bahanbaku = new MBahanbaku();
        date_default_timezone_set('Asia/Jakarta');
        $date = date('Y-m-d:H:i:s');
        if (!$valid) {
            session()->setFlashdata('errors', \Config\Services::validation()->getErrors());
            return redirect()->to(base_url('/Admin/Bahanbaku-Tambah'));
        } else {
            $data = [
                'kode_bahan_baku' => $bahanbaku->koderandom(),
                'nama_bahan_baku' => $this->request->getPost('nama'),
                'satuan_bahan_baku' => $this->request->getPost('cbsatuan'),
                'created_at' => $date
            ];
            $bahanbaku = new MBahanbaku();
            $bahanbaku->insert_data($data);
            session()->setFlashdata('success', 'Data Bahan Baku Berhasil Ditambahkan');
            return redirect()->to(base_url('/Admin/Bahanbaku'));
        }
    }
    public function delete()
    {
        $id = $this->request->getPost('iduser');
        $pelanggan = new MBahanbaku();
        $pelanggan->hapus($id);
        session()->setFlashdata('success', 'Data Bahan Baku Berhasil Di Hapus !!');
        return redirect()->to(base_url('Admin/Bahanbaku'));
    }

    public function beli()
    {
        $bahanbaku = new MBahanbaku();
        if ((session()->get('masuk') == TRUE) && (session()->get('status') == 'Y')) {
            $data = [
                'isi' => 'Transaksi/Pembelian/Data',
                'data' => $bahanbaku->getAlldata()
            ];
            return view('Layout/Template', $data);
        } else {
            return view('errors/error_login.php');
        }
    }

    public function simp_detail()
    {
        $spp = new MBahanbakumasuk();
        date_default_timezone_set('Asia/Jakarta');
        $id = $this->request->getPost('kodebahanbaku');
        $jumlahbhnbaku = intval($this->request->getPost('jumlah1') - $this->request->getPost('jumlahbahanbaku'));
        // dd([$id,$jumlahbhnbaku]);
        $data = [
            'kode_produksi_detail' => $spp->koderandom(),
            'kode_bahan_baku_detail' => $this->request->getPost('kodebahanbaku'),
            'qty_bahan_baku_keluar_detail' => $this->request->getPost('jumlahbahanbaku'),
            'created_at' => date('Y-m-d H:i:s')
        ];
        $dataupdate = [
            'kode_bahan_baku' => $id,
            'jumlah_bahan_baku' => $jumlahbhnbaku
        ];
        // dd($dataupdate);
        $bahanbaku = new MBahanbaku();
        $bahanbaku->update_data($dataupdate, $id);

        $mhs = new MBahanbakumasuk();
        $mhs->insert_data_temp($data);
        session()->setFlashdata('successbahanbaku', 'Data Bahan Baku Berhasil Ditambahkan');
    }
}
