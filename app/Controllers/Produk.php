<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\MProduk;

class Produk extends BaseController
{
    public function index()
    {
        $produk = new MProduk();
        if ((session()->get('masuk') == TRUE) && (session()->get('status') == 'Y')) {
            $data = [
                'data' => $produk->getAllData(),
                'isi' => 'Master/Produk/Data'
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
                'isi' => 'Master/Produk/Add'
            ];
            return view('Layout/Template', $data);
        } else {
            return view('errors/error_login.php');
        }
    }
}
