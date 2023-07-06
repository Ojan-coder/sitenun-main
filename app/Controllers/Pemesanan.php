<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\MProduk;


class Pemesanan extends BaseController
{
    public function index()
    {
        if ((session()->get('masuk') == TRUE) && (session()->get('status') == 'Y')) {
            if (session()->get('akses1') == '4') {
                $data = [
                    'isi' => 'Transaksi/Pemesanan/Data'
                ];
                return view('Layout_pelanggan/Template', $data);
            } else {
                $data = [
                    'isi' => 'Transaksi/Pemesanan/Data'
                ];
                return view('Layout/Template', $data);
            }
        } else {
            return view('errors/error_login.php');
        }
    }
    public function tambah()
    {
        $produk = new MProduk();
        if ((session()->get('masuk') == TRUE) && (session()->get('status') == 'Y')) {
            if (session()->get('akses1') == '4') {
                $data = [
                    'produk' => $produk->getAlldata(),
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
}
