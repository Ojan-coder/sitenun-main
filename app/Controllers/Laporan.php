<?php

namespace App\Controllers;

use App\Models\MProduk;


class Laporan extends BaseController
{
    public function index()
    {
    }
    public function LaporanProduk()
    {

        if ((session()->get('masuk') == TRUE) && (session()->get('status') == 'Y')) {
            $data = [
                'isi' => 'Laporan/Produk/Data'
            ];
            return view('Layout/Template', $data);
        } else {
            return view('errors/error_login.php');
        }
    }
}
