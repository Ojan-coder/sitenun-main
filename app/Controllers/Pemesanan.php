<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\MPemesanan;
use App\Models\MProduk;


class Pemesanan extends BaseController
{
    public function index()
    {

        $produk = new MProduk();
        if ((session()->get('masuk') == TRUE) && (session()->get('status') == 'Y')) {
            if (session()->get('akses1') == '4') {
                $data = [
                    'isi' => 'Transaksi/Pemesanan/Data',
                    'dataproduk' => $produk->getAlldata()
                ];
                return view('Layout_pelanggan/Template', $data);
            } else {
                $data1 = [
                    'isi' => 'Transaksi/Pemesanan/Data'
                ];
                return view('Layout/Template', $data1);
            }
        } else {
            return view('errors/error_login.php');
        }
    }
    public function tambah()
    {
        $produk = new MProduk();
        $pemesanan = new MPemesanan();
        date_default_timezone_set('Asia/Jakarta');
        $date = date('Y-m-d');
        if ((session()->get('masuk') == TRUE) && (session()->get('status') == 'Y')) {
            if (session()->get('akses1') == '4') {
                $data = [
                    'no_pemesanan' => $pemesanan->koderandom(),
                    'tgl_pemesanan' => $date,
                    'dataproduk' => $produk->getAlldata(),
                    'isi' => 'Transaksi/Pemesanan/Add'
                ];
                return view('Layout_pelanggan/Template', $data);
            } else {
                $data = [
                    'produk' => $produk->getAlldata(),
                    'isi' => 'Transaksi/Pemesanan/Add'
                ];
                return view('Layout/Template', $data);
            }
        } else {
            return view('errors/erorr_pemesanan.php');
        }
    }

    public function simp_detail()
    {
        $pemesanan = new MPemesanan();
        $produk = new MProduk();
        date_default_timezone_set('Asia/Jakarta');
        $id = $this->request->getPost('kodebahanbaku');
        $jumlahbhnbaku = intval($this->request->getPost('jumlah1') - $this->request->getPost('jumlahbahanbaku'));
        
        $data = [
            'no_pemesanan_detail' => $pemesanan->koderandom(),
            'kode_produk_penjualan_detail' => $this->request->getPost('kode_produk'),
            'qty_produk_penjualan_detail' => $this->request->getPost('jumlahbahanbaku'),
            'harga_produk_penjualan_detail' => $this->request->getPost('harga'),
            'created_at' => date('Y-m-d H:i:s')
        ];
        $dataproduk = [
            'kode_produk' => $id,
            'jumlah_produk' => $jumlahbhnbaku
        ];
        // dd($dataupdate);
        
        $produk->update_data($produk, $id);

        $pemesanan->insert_data_temp($data);
        session()->setFlashdata('successbahanbaku', 'Data Bahan Baku Berhasil Ditambahkan');
    }
}
