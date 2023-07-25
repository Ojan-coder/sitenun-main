<?php

namespace App\Controllers;

use App\Models\MLaporan;
use App\Models\MProduk;


class Laporan extends BaseController
{
    public function index()
    {
        if ((session()->get('masuk') == TRUE) && (session()->get('status') == 'Y') && (session()->get('akses1') == '1') || (session()->get('akses1') == '2')) {
            $data = [
                'isi' => 'Laporan/Data'
            ];
            return view('Layout/Template', $data);
        } else {
            return view('errors/error_login.php');
        }
    }

    function cetak()
    {
        $laporan = new MLaporan();
        $jenis = $this->request->getPost('cbjenislaporan');
        // 1 = Material
        if ($jenis == '1') {
            $data = [
                'data' => $laporan->getmaterial(),
            ];
            return view('Laporan/Laporanmaterial', $data);
            // 
        } else if ($jenis == '2') {
            $data = [
                'data' => $laporan->getproduk(),
            ];
            return view('Laporan/Laporanproduk', $data);
        } else if ($jenis == '3') {
            $data = [
                'data' => $laporan->getpelanggan(),
            ];
            return view('Laporan/Laporanpelanggan', $data);
        } else if ($jenis == '4') {
            $tglawal = $this->request->getPost('tglawal');
            $tglakhir = $this->request->getPost('tglakhir');
            $data = [
                'tglawal' => $tglawal,
                'tglakhir' => $tglakhir,
                'data' => $laporan->getpembelianbahanbaku($tglawal, $tglakhir),
            ];
            return view('Laporan/Laporanpembelianbahanbaku', $data);
        } else if ($jenis == '5') {
            $tglawal = $this->request->getPost('tglawal');
            $tglakhir = $this->request->getPost('tglakhir');
            $data = [
                'tglawal' => $tglawal,
                'tglakhir' => $tglakhir,
                'data' => $laporan->getpemesanan($tglawal, $tglakhir),
            ];
            return view('Laporan/Laporanpemesanan', $data);
        } else if ($jenis == '6') {
            $tglawal = $this->request->getPost('tglawal');
            $tglakhir = $this->request->getPost('tglakhir');
            $data = [
                'tglawal' => $tglawal,
                'tglakhir' => $tglakhir,
                'data' => $laporan->getpenjualan($tglawal, $tglakhir),
            ];
            return view('Laporan/Laporanpenjualan', $data);
        } else if ($jenis == '7') {
            $tglawal = $this->request->getPost('tglawal');
            $tglakhir = $this->request->getPost('tglakhir');
            $data = [
                'tglawal' => $tglawal,
                'tglakhir' => $tglakhir,
                'data' => $laporan->getkaryawan(),
            ];
            return view('Laporan/Laporankaryawan', $data);
        } else if ($jenis == '8') {
            $tglawal = $this->request->getPost('tglawal');
            $tglakhir = $this->request->getPost('tglakhir');
            $data = [
                'tglawal' => $tglawal,
                'tglakhir' => $tglakhir,
                'data' => $laporan->getProduksi($tglawal, $tglakhir),
            ];
            return view('Laporan/Laporanproduksi', $data);
        }
    }

    public function CetakFaktur()
    {
        $laporan = new MLaporan();
        $request = \Config\Services::request();
        $kode = $request->uri->getSegment(3);
        $kodepelanggan = $request->uri->getSegment(4);
        $tgl = $request->uri->getSegment(5);
        // dd($kode);
        $data = [
            'kode' => $kode,
            'tgl' => $tgl,
            'kodepelanggan' => $kodepelanggan,
            'detail' => $laporan->getDetailPemesanan($kode),
            'pelanggan' => $laporan->detailpelanggan($kodepelanggan),
        ];
        return view('Laporan/Faktur', $data);
    }
    public function BahanBakuFaktur()
    {
        $laporan = new MLaporan();
        $request = \Config\Services::request();
        $kode = $request->uri->getSegment(3);

        $data = [
            'kode'=>$kode,
            'data' => $laporan->getDetailFakturPembelianBahanBaku($kode),
        ];
        return view('Laporan/Laporanpembelianbahanbaku_faktur', $data);
    }
    public function CetakFakturPenjualan()
    {
        $laporan = new MLaporan();
        $request = \Config\Services::request();
        $kode = $request->uri->getSegment(3);
        $kodepelanggan = $request->uri->getSegment(4);
        // dd($kode);
        $data = [
            'kode' => $kode,
            'kodepelanggan' => $kodepelanggan,
            'detail' => $laporan->getDetailPenjualan($kode),
            'pelanggan' => $laporan->detailpelanggan($kodepelanggan),
        ];
        return view('Laporan/Fakturpenjualan', $data);
    }
}
