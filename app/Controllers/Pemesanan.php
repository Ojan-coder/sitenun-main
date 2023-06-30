<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Pemesanan extends BaseController
{
    public function index()
    {
        if ((session()->get('masuk') == TRUE) && (session()->get('status') == 'Y')) {
            $data = [
                'isi' => 'Transaksi/Pemesanan/Data'
            ];
            return view('Layout/Template', $data);
        } else {
            return view('errors/error_login.php');
        }
    }
    public function tambah()
    {
        if ((session()->get('masuk') == TRUE) && (session()->get('status') == 'Y')) {
            echo "hello";
        } else {
            return view('errors/erorr_pemesanan.php');
        }
    }
}
