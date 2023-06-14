<?php

namespace App\Controllers;
use App\Models\MProduk;
class Home extends BaseController
{
    public function index()
    {
        $produk = new MProduk();
        $session = session();
        // $session->destroy();
        $data['produk'] = $produk->getAlldata();
        return view('Home',$data);
    }
    public function home()
    {
        
        if ((session()->get('masuk') == TRUE) && (session()->get('status') == 'Y')) {
            $data = [
                'isi' => 'Beranda'
            ];
            return view('Layout/Template', $data);
        } else {
            return view('errors/error_login.php');
        }
    }
}
