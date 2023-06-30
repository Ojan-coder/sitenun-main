<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Bahanbaku extends BaseController
{
    public function index()
    {
        if ((session()->get('masuk') == TRUE) && (session()->get('status') == 'Y')) {
            $data = [
                'isi' => 'Master/Bahanbaku/Data'
            ];
            return view('Layout/Template', $data);
        } else {
            return view('errors/error_login.php');
        }
    }
}
