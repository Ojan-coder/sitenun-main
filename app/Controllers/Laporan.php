<?php

namespace App\Controllers;

use App\Models\MProduk;


class Laporan extends BaseController
{
    public function index()
    {
        if ((session()->get('masuk') == TRUE) && (session()->get('status') == 'Y') && (session()->get('akses1') == '1')) {
            $data = [
                'isi' => 'Laporan/Data'
            ];
            return view('Layout/Template', $data);
        } else {
            return view('errors/error_login.php');
        }
    }
    public function LaporanProduk()
    {
    }
}
