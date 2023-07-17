<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\MPemesanan;
use App\Models\MProduk;


class Pemesanan extends BaseController
{
    public function index()
    {
        $pesanan = new MPemesanan();
        if ((session()->get('masuk') == TRUE) && (session()->get('status') == 'Y')) {
            if (session()->get('akses1') == '4') {
                $data = [
                    'isi' => 'Transaksi/Pemesanan/Data',
                    'datapesanan' => $pesanan->getAllDataByPelanggan(),
                    'datastatus' => $pesanan->getstatus()
                ];
                return view('Layout_pelanggan/Template', $data);
            } else {
                $data1 = [
                    'isi' => 'Transaksi/Pemesanan/Data',
                    'datapesanan' => $pesanan->getAllData(),
                    'datastatus' => $pesanan->getstatus()
                ];
                return view('Layout/Template', $data1);
            }
        } else {
            return view('errors/error_login.php');
        }
    }
    public function tambah()
    {
        $produk = new MProduk();
        $pemesanan = new MPemesanan();
        date_default_timezone_set('Asia/Jakarta');
        $date = date('Y-m-d');
        if ((session()->get('masuk') == TRUE) && (session()->get('status') == 'Y')) {
            if (session()->get('akses1') == '4') {
                $data = [
                    'no_pemesanan' => $pemesanan->koderandom(),
                    'tgl_pemesanan' => $date,
                    'dataproduk' => $produk->getAlldata(),
                    'detailpesanan' => $pemesanan->getDetailPemesanan(),
                    'isi' => 'Transaksi/Pemesanan/Add'
                ];
                return view('Layout_pelanggan/Template', $data);
            } else {
                $data = [
                    'no_pemesanan' => $pemesanan->koderandom(),
                    'tgl_pemesanan' => $date,
                    'dataproduk' => $produk->getAlldata(),
                    'detailpesanan' => $pemesanan->getDetailPemesanan(),
                    'isi' => 'Transaksi/Pemesanan/Add'
                ];
                return view('Layout/Template', $data);
            }
        } else {
            return view('errors/erorr_pemesanan.php');
        }
    }

    public function simp_detail()
    {
        $pemesanan = new MPemesanan();
        $produk = new MProduk();
        date_default_timezone_set('Asia/Jakarta');
        $id = $this->request->getPost('kodeproduk');
        $harga = $this->request->getPost('harga');
        $jumlahbhnbaku = intval($this->request->getPost('jumlah1') - $this->request->getPost('jumlahbahanbaku'));
        // dd($jumlahbhnbaku);
        $data = [
            'no_pemesanan_detail' => $pemesanan->koderandom(),
            'kode_produk_penjualan_detail' => $id,
            'qty_produk_penjualan_detail' => $this->request->getPost('jumlahbahanbaku'),
            'harga_produk_penjualan_detail' => $harga,
            'created_at' => date('Y-m-d H:i:s')
        ];
        // dd($data);
        $pemesanan->insert_data_temp($data);
        $dataproduk = [
            'kode_produk' => $id,
            'jumlah_produk' => $jumlahbhnbaku
        ];
        // dd($dataproduk);
        $produk->update_data($dataproduk, $id);
        session()->setFlashdata('success', 'Data Bahan Baku Berhasil Ditambahkan');
    }

    function bayarsisa()
    {
        date_default_timezone_set('Asia/Jakarta');
        $date = date('Y-m-d:H:i:s');
        $image = $this->request->getFile('gambar');
        $img = $image->getName();
        $pemesanan = new MPemesanan();
        $id = $this->request->getPost('kodepemesanan');
        if ($image->isValid()) {
            $data = [
                'bayar_sisa' => $this->request->getPost('bayar_sisa'),
                'bukti_sisa' => $img,
                'status_pemesanan' => '3',
                'updated_at' => $date,
            ];
            $image->move(ROOTPATH . 'public/fotobukti2/', $img);
            $pemesanan->update_data($data, $id);
        }
        session()->setFlashdata('delete', 'Data Produk Berhasil Di Hapus !!');
        return redirect()->to(base_url('/Pemesanan'));
    }

    function gantistatus()
    {
        date_default_timezone_set('Asia/Jakarta');
        $date = date('Y-m-d:H:i:s');
        $pemesanan = new MPemesanan();
        $request = \Config\Services::request();
        $status = $request->uri->getSegment(3);
        $kode = $request->uri->getSegment(4);
        // dd($status);
        if ($status == '1') {
            $data = [
                'status_pemesanan' => '2',
            ];
            $pemesanan->update_data($data, $kode);
            session()->setFlashdata('delete', 'Data Produk Berhasil Di Ganti !!');
        } else if ($status == '3' || $status == '2') {
            $data = [
                'status_pemesanan' => '5',
            ];
            $pemesanan->update_data($data, $kode);
            session()->setFlashdata('delete', 'Data Produk Berhasil Di Ganti !!');
        }
        return redirect()->to(base_url('/Pemesanan'));
    }

    function add()
    {
        $pesanan = new MPemesanan();
        date_default_timezone_set('Asia/Jakarta');
        $date = date('Y-m-d:H:i:s');
        $tgl = date('Y-m-d');
        $image = $this->request->getFile('gambar');
        $img = $image->getName();
        if ($image->isValid()) {
            $dataproduksi = [
                'kode_pemesanan' => $pesanan->koderandom(),
                'tgl_pemesanan' => $tgl,
                'kode_pelanggan' => session()->get('kode_user'),
                'dp_pemesanan' => $this->request->getPost('bayardp'),
                'status_pemesanan' => '1',
                'bukti_dp' => $img,
                'created_at' => $date
            ];
            $pesanan->insert_data($dataproduksi);
            $image->move(ROOTPATH . 'public/fotobukti/', $img);
            session()->setFlashdata('success', 'Data Pesanan Berhasil Ditambahkan');
            return redirect()->to(base_url('/Pemesanan/tambah'));
        } else {
            session()->setFlashdata('delete', 'Bukti Transfer Harus Di-lampirkan');
            return redirect()->to(base_url('/Pemesanan/tambah'));
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

        $usr = new MPemesanan();
        $usr->hapus_detail($id, $id_detail);
        session()->setFlashdata('delete', 'Data Produk Berhasil Di Hapus !!');
        return redirect()->to(base_url('/Pemesanan/tambah'));
    }
}
