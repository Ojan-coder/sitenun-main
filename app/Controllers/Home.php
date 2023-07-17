<?php

namespace App\Controllers;

use App\Models\MPemesanan;
use App\Models\MProduk;


class Home extends BaseController
{
    public function index()
    {
        $produk = new MProduk();
        $session = session();
        // $session->destroy();
        $data = [
            'isi' => 'Home',
            'produk' => $produk->getAlldata()
        ];
        return view('Layout_pelanggan/Template', $data);
        // return view('Home', $data);
    }
    public function home()
    {
        $pesanan = new MPemesanan();

        if ((session()->get('masuk') == TRUE) && (session()->get('status') == 'Y') && (session()->get('akses1') == '1')  || (session()->get('akses1') == '2') || (session()->get('akses1') == '3')) {
            $data = [
                'isi' => 'Beranda'
            ];
            return view('Layout/Template', $data);
        } elseif ((session()->get('masuk') == TRUE) && (session()->get('status') == 'Y') && (session()->get('akses1') == '4')) {
            $data = [
                'isi' => 'BerandaPelanggan',
                'datapesanan' => $pesanan->getAllDataByPelanggan()
            ];
            return view('Layout_pelanggan/Template', $data);
        } else {
            return view('errors/error_login.php');
        }
    }
    // public function pelanggan()
    // {

    //     if ((session()->get('masuk') == TRUE) && (session()->get('status') == 'Y')) {
    //         $data = [
    //             'isi' => 'BerandaPelanggan'
    //         ];
    //         return view('Layout/Template', $data);
    //     } else {
    //         return view('errors/error_login.php');
    //     }
    // }
}
