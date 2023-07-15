<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\MPenjualan;
use App\Models\MProduk;

class Penjualan extends BaseController
{
    public function index()
    {
        $pesanan = new MPenjualan();
        if ((session()->get('masuk') == TRUE) && (session()->get('status') == 'Y') && session()->get('akses1') == '1') {
            $data1 = [
                'isi' => 'Transaksi/Penjualan/Data',
                'datapesanan' => $pesanan->getAllData()
            ];
            return view('Layout/Template', $data1);
        } else {
            return view('errors/error_login.php');
        }
    }
    public function tambah()
    {
        $penjualan = new MPenjualan();
        $produk = new MProduk();
        date_default_timezone_set('Asia/Jakarta');
        $date = date('Y-m-d');
        if ((session()->get('masuk') == TRUE) && (session()->get('status') == 'Y') && session()->get('akses1') == '1') {
            $data = [
                'no_pemesanan' => $penjualan->koderandom(),
                'tgl_pemesanan' => $date,
                'dataproduk' => $produk->getAlldata(),
                'detailpesanan' => $penjualan->getDetailPemesanan(),
                'isi' => 'Transaksi/Penjualan/Add'
            ];
            return view('Layout/Template', $data);
        } else {
            return view('errors/erorr_pemesanan.php');
        }
    }
}
