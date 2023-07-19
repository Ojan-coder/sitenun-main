<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\MBahanbaku;
use App\Models\MProduk;
use App\Models\MProduksi;

class Produksi extends BaseController
{
    public function index()
    {
        $Produksi = new MProduksi();
        if ((session()->get('masuk') == TRUE) && (session()->get('status') == 'Y' && session()->get('akses1') == '1' || session()->get('akses1') == '3')) {
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
        $produk = new MProduk();
        $bahan = new MBahanbaku();
        $produksi = new MProduksi();
        if ((session()->get('masuk') == TRUE) && (session()->get('status') == 'Y')) {
            $data = [
                'isi' => 'Transaksi/Produksi/Add',
                'produk' => $produk->getAlldata(),
                'bahanbaku' => $bahan->getAlldata(),
                'detailbahanbaku' => $produksi->getDataTableDetail(),
            ];
            return view('Layout/Template', $data);
        } else {
            return view('errors/error_login.php');
        }
    }

    public function simp_detail()
    {
        $spp = new MProduksi();
        date_default_timezone_set('Asia/Jakarta');
        $id = $this->request->getPost('kodebahanbaku');
        $jumlahbhnbaku = intval($this->request->getPost('jumlah1') - $this->request->getPost('jumlahbahanbaku'));
        // dd([$id,$jumlahbhnbaku]);
        $data = [
            'kode_produksi_detail' => $spp->koderandom(),
            'kode_bahan_baku_detail' => $this->request->getPost('kodebahanbaku'),
            'qty_bahan_baku_produksi' => $this->request->getPost('jumlahbahanbaku'),
            'created_at' => date('Y-m-d H:i:s')
        ];
        $dataupdate = [
            'kode_bahan_baku' => $id,
            'jumlah_bahan_baku' => $jumlahbhnbaku
        ];
        // dd($dataupdate);
        $bahanbaku = new MBahanbaku();
        $bahanbaku->update_data($dataupdate, $id);

        $mhs = new MProduksi();
        $mhs->insert_data_temp($data);
        session()->setFlashdata('successbahanbaku', 'Data Bahan Baku Berhasil Ditambahkan');
    }

    function add()
    {
        $valid = $this->validate([
            'jumlahbaru' => [
                'label'  => 'Jumlah Bahan Baku',
                'rules'   => 'required|',
                'errors' => [
                    'required' => '{field} Wajib Diisi'
                ],
            ]
        ]);
        $jumlahlama = $this->request->getPost('jumlahlama');
        $jumlahbaru = $this->request->getPost('jumlahbaru');
        $kodeproduk = $this->request->getPost('kodeproduk');
        $jumlah = intval($jumlahlama + $jumlahbaru);
        $produksi = new MProduksi();
        $produk = new MProduk();
        date_default_timezone_set('Asia/Jakarta');
        $date = date('Y-m-d:H:i:s');
        if (!$valid) {
            session()->setFlashdata('errors', \Config\Services::validation()->getErrors());
            return redirect()->to(base_url('/Admin/Produksi/Tambah'));
        } else {

            $dataproduk = [
                'jumlah_produk' => $jumlah,
                'updated_at'=>$date
            ];
            // dd($dataproduk);
            $produk->update_data($dataproduk,$kodeproduk);

            $dataproduksi = [
                'kode_produksi' => $produksi->koderandom(),
                'kode_produk' => $kodeproduk,
                'jumlah_produksi' => $jumlahbaru,
                'created_at' => $date
            ];
            $produksi->insert_data($dataproduksi);

            session()->setFlashdata('success', 'Data Produksi Berhasil Ditambahkan');
            return redirect()->to(base_url('/Admin/Produksi'));
        }
    }

    public function delete_bahanbaku()
    {
        $request = \Config\Services::request();
        $id = $request->uri->getSegment(3);
        $id_detail = $request->uri->getSegment(6);
        $stokdipakai = $request->uri->getSegment(4);
        $stokskrng = $request->uri->getSegment(5);

        $jumlahbhnbaku = intval($stokdipakai + $stokskrng);
        $dataupdate = [
            'jumlah_bahan_baku' => $jumlahbhnbaku
        ];
        // dd([$dataupdate,$id_detail]);
        $bahanbaku = new MBahanbaku();
        $bahanbaku->update_data($dataupdate, $id);

        $usr = new MProduksi();
        $usr->hapus_detail($id, $id_detail);
        session()->setFlashdata('deletebahanbaku', 'Data Bahan Baku Berhasil Di Hapus !!');
        return redirect()->to(base_url('/Admin/Produksi/Tambah'));
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
