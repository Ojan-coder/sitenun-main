<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\MBahanbaku;
use App\Models\MPembelianBahanBaku;


class PembelianBahanBaku extends BaseController
{
    public function index()
    {
        $pembelian = new MPembelianBahanBaku();
        if ((session()->get('masuk') == TRUE) && (session()->get('status') == 'Y' && session()->get('akses1') == '1' || session()->get('akses1') == '3')) {
            $data = [
                'data' => $pembelian->getAllData(),
                'isi' => 'Transaksi/Pembelian/Data'
            ];
            return view('Layout/Template', $data);
        } else {
            return view('errors/error_login.php');
        }
    }
    public function tambah()
    {
        date_default_timezone_set('Asia/Jakarta');
        $tgl = date('Y-m-d');
        $bahanbaku = new MBahanbaku();
        $pembelian = new MPembelianBahanBaku();
        if ((session()->get('masuk') == TRUE) && (session()->get('status') == 'Y' && session()->get('akses1') == '1'|| session()->get('akses1') == '3')) {
            $data = [
                'kodepembelian' => $pembelian->koderandom(),
                'tanggalpembelian' => $tgl,
                'bahanbaku' => $bahanbaku->getAllData(),
                'detailbahanbaku' => $pembelian->getDataTableDetail(),
                'isi' => 'Transaksi/Pembelian/Add'
            ];
            return view('Layout/Template', $data);
        } else {
            return view('errors/error_login.php');
        }
    }

    public function detail()
    {
        $pembelian = new MPembelianBahanBaku();
        $request = \Config\Services::request();
        $id = $request->uri->getSegment(3);
        $data = [
            'kode'=>$id,
            'isi' => 'Transaksi/Pembelian/Detail',
            'data' => $pembelian->getDetail($id)
        ];
        // dd($id);
        return view('Layout/Template', $data);
    }

    public function simp_detail()
    {
        $spp = new MPembelianBahanBaku();
        date_default_timezone_set('Asia/Jakarta');
        $id = $this->request->getPost('kodebahanbaku');
        $jumlahbhnbaku = intval($this->request->getPost('jumlah1') + $this->request->getPost('jumlahbahanbaku'));
        // dd([$id,$jumlahbhnbaku]);
        $data = [
            'kode_bahan_baku_masuk_detail' => $spp->koderandom(),
            'kode_bahan_baku_detail' => $this->request->getPost('kodebahanbaku'),
            'qty_bahan_baku_masuk_detail' => $this->request->getPost('jumlahbahanbaku'),
            'harga_bahan_baku_masuk_detail' => $this->request->getPost('harga'),
            'created_at' => date('Y-m-d H:i:s')
        ];
        $dataupdate = [
            'kode_bahan_baku' => $id,
            'jumlah_bahan_baku' => $jumlahbhnbaku,
            'harga_bahan_baku' => $this->request->getPost('harga'),
        ];
        // dd($dataupdate);
        $bahanbaku = new MBahanbaku();
        $bahanbaku->update_data($dataupdate, $id);

        $mhs = new MPembelianBahanBaku();
        $mhs->insert_data_temp($data);
        session()->setFlashdata('successbahanbaku', 'Data Pembelian Bahan Baku Berhasil Ditambahkan');
    }

    public function add()
    {
        $pembelian = new MPembelianBahanBaku();
        date_default_timezone_set('Asia/Jakarta');
        $date = date('Y-m-d:H:i:s');
        $tgl = date('Y-m-d');

        $data = [
            'kode_bahan_baku_masuk' => $pembelian->koderandom(),
            'tgl_bahan_baku_masuk' => $tgl,
            'total_harga_bahan_baku_masuk' => $this->request->getPost('total'),
            'created_at' => $date
        ];
        // dd($data);
        $pembelian->insert_data($data);

        session()->setFlashdata('success', 'Data Pembelian Bahan Baku Berhasil Ditambahkan');
        return redirect()->to(base_url('/Admin/PembelianBahanBaku'));
    }

    public function delete_bahanbaku()
    {
        $request = \Config\Services::request();
        $id = $request->uri->getSegment(3);
        $stokdipakai = $request->uri->getSegment(4);
        $stokskrng = $request->uri->getSegment(5);
        $id_detail = $request->uri->getSegment(6);

        $jumlahbhnbaku = intval($stokskrng - $stokdipakai);
        $dataupdate = [
            'jumlah_bahan_baku' => $jumlahbhnbaku
        ];

        $bahanbaku = new MBahanbaku();
        $bahanbaku->update_data($dataupdate, $id);

        $usr = new MPembelianBahanBaku();
        $usr->hapus_detail($id_detail);
        // dd($usr->hapus_detail($id_detail));
        session()->setFlashdata('deletebahanbaku', 'Data Pembelian Bahan Baku Berhasil Di Hapus !!');
        return redirect()->to(base_url('/Admin/PembelianBahanBaku/Bahanbaku-Tambah'));
    }

    // public function delete()
    // {
    //     $request = \Config\Services::request();
    //     $id = $request->uri->getSegment(3);
    //     $stokdipakai = $request->uri->getSegment(4);
    //     $stokskrng = $this->request->getPost('skrng');
    //     $id_detail = $request->uri->getSegment(6);

    //     $jumlahbhnbaku = intval($stokskrng - $stokdipakai);
    //     $dataupdate = [
    //         'jumlah_bahan_baku' => $jumlahbhnbaku
    //     ];

    //     $bahanbaku = new MBahanbaku();
    //     $bahanbaku->update_data($dataupdate, $id);

    //     $usr = new MPembelianBahanBaku();
    //     $usr->hapus_detail($id_detail);
    //     // dd($usr->hapus_detail($id_detail));
    //     session()->setFlashdata('deletebahanbaku', 'Data Pembelian Bahan Baku Berhasil Di Hapus !!');
    //     return redirect()->to(base_url('/Admin/PembelianBahanBaku/Bahanbaku-Tambah'));
    // }
}
