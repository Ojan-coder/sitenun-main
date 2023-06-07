<?php

namespace App\Controllers;

class User extends BaseController
{
    public function index()
    {
        if ((session()->get('masuk') == TRUE) && (session()->get('status') == 'Y')) {
            $data = [
                'judul' => 'Tambah User',
                'submenu' => 'User',
                'isi' => 'Master/User/Data'
            ];
            return view('Layout/Template', $data);
        } else {
            return view('errors/error_login.php');
        }
    }
}
