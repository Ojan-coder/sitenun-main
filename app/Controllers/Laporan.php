<?php

namespace App\Controllers;

use App\Models\MLaporan;
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
    public function CetakFaktur()
    {
        $laporan = new MLaporan();
        $request = \Config\Services::request();
        $kode = $request->uri->getSegment(3);
        $kodepelanggan = $request->uri->getSegment(4);
        // dd($kode);
        $data = [
            'kode'=>$kode,
            'kodepelanggan'=>$kodepelanggan,
            'detail' => $laporan->getDetailPemesanan($kode),
            'pelanggan' => $laporan->detailpelanggan($kodepelanggan),
        ];
        return view('Laporan/Faktur', $data);
    }
}
