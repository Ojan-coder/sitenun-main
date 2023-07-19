<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\MPelanggan;
use App\Models\MPenjualan;
use App\Models\MProduk;


class Penjualan extends BaseController
{
    public function index()
    {
        $pesanan = new MPenjualan();
        if ((session()->get('masuk') == TRUE) && (session()->get('status') == 'Y') && session()->get('akses1') == '1') {
            $data1 = [
                'isi' => 'Transaksi/Penjualan/Data',
                'datapesanan' => $pesanan->getAllData()
            ];
            return view('Layout/Template', $data1);
        } else {
            return view('errors/error_login.php');
        }
    }
    public function tambah()
    {
        $penjualan = new MPenjualan();
        $produk = new MProduk();
        $pelanggan = new MPelanggan();
        date_default_timezone_set('Asia/Jakarta');
        $date = date('Y-m-d');
        if ((session()->get('masuk') == TRUE) && (session()->get('status') == 'Y') && session()->get('akses1') == '1') {
            $data = [
                'no_pemesanan' => $penjualan->koderandom(),
                'tgl_pemesanan' => $date,
                'dataproduk' => $produk->getAlldata(),
                'datapelanggan' => $pelanggan->getAlldata(),
                'detailpesanan' => $penjualan->getDetailPemesanan(),
                'isi' => 'Transaksi/Penjualan/Add'
            ];
            return view('Layout/Template', $data);
        } else {
            return view('errors/erorr_pemesanan.php');
        }
    }

    function add()
    {
        $pesanan = new MPenjualan();
        date_default_timezone_set('Asia/Jakarta');
        $date = date('Y-m-d:H:i:s');
        $tgl = date('Y-m-d');
        $dataproduksi = [
            'no_transaksi_penjualan' => $pesanan->koderandom(),
            'tgl_penjualan' => $tgl,
            'kode_pelanggan' => $this->request->getPost('kodepelanggan'),
            'total_harga_penjualan' => $this->request->getPost('totalbayar'),
            'created_at' => $date
        ];
        $pesanan->insert_data($dataproduksi);
        session()->setFlashdata('success', 'Data Pesanan Berhasil Ditambahkan');
        return redirect()->to(base_url('/Penjualan'));
    }


    public function simp_detail()
    {
        $pemesanan = new MPenjualan();
        $produk = new MProduk();
        date_default_timezone_set('Asia/Jakarta');
        $id = $this->request->getPost('kodeproduk');
        $harga = $this->request->getPost('harga');
        $jumlahstok = $this->request->getPost('jumlah1');
        $jumlahbeli = $this->request->getPost('jumlahbahanbaku');
        $jumlahbhnbaku = intval($jumlahstok - $jumlahbeli);
        // dd($jumlahbhnbaku);
        if ($jumlahstok < $jumlahbeli) {
            session()->setFlashdata('delete', 'Stok Produk Tidak Mencukupi');
        } else {
            $data = [
                'no_transaksi_penjualan_detail' => $pemesanan->koderandom(),
                'kode_produk_penjualan_detail' => $id,
                'qty_produk_penjualan_detail' => $this->request->getPost('jumlahbahanbaku'),
                'harga_produk_penjualan_detail' => $harga,
                'created_at' => date('Y-m-d H:i:s')
            ];

            $pemesanan->insert_data_temp($data);
            $dataproduk = [
                'kode_produk' => $id,
                'jumlah_produk' => $jumlahbhnbaku
            ];
            $produk->update_data($dataproduk, $id);
            session()->setFlashdata('success', 'Data Penjualan Berhasil Ditambahkan');
        }
    }
    public function delete_bahanbaku()
    {
        $request = \Config\Services::request();
        $id = $request->uri->getSegment(3);
        $id_detail = $request->uri->getSegment(6);
        $stokdipakai = $request->uri->getSegment(4);
        $stokskrng = $request->uri->getSegment(5);

        $jumlahbhnbaku = intval($stokdipakai + $stokskrng);
        $dataupdate = [
            'jumlah_produk' => $jumlahbhnbaku
        ];
        // dd([$dataupdate,$id_detail]);
        $bahanbaku = new MProduk();
        $bahanbaku->update_data($dataupdate, $id);

        $usr = new MPenjualan();
        $usr->hapus_detail($id_detail);
        session()->setFlashdata('delete', 'Data Produk Berhasil Di Hapus !!');
        return redirect()->to(base_url('/Penjualan/tambah'));
    }
}
