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
        $jumlahstok = $this->request->getPost('jumlah1');
        $jumlahdibeli = $this->request->getPost('jumlahbahanbaku');
        $jumlahbhnbaku = intval($jumlahstok - $jumlahdibeli);
        // dd($jumlahbhnbaku);\
        $valid = $this->validate([
            'jumlahbahanbaku' => [
                'label'  => 'Jumlah Produk',
                'rules'   => 'required',
                'errors' => [
                    'required' => '{field} Wajib Diisi'
                ],
            ]
        ]);

        if (!$valid) {
            session()->setFlashdata('errors', \Config\Services::validation()->getErrors());
            return redirect()->to(base_url('Pemesanan/Tambah'));
        } else {
            if ($jumlahdibeli > $jumlahstok) {
                session()->setFlashdata('delete', 'Stok Produk Tidak Mencukupi');
            } elseif ($jumlahdibeli == 0) {
                session()->setFlashdata('qty', 'Masukkan Jumlah Produk Yang Ingin Di beli !! ');
            } else {
                $data = [
                    'no_pemesanan_detail' => $pemesanan->koderandom(),
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
                session()->setFlashdata('success', 'Data Pesanan Berhasil Ditambahkan');
                return redirect()->to(base_url('Pemesanan/Tambah'));
            }
        }
    }

    function simp_detail_home()
    {
        $request = \Config\Services::request();
        $id = $request->uri->getSegment(3);
        $produk = new MProduk();
        $pemesanan = new MPemesanan();
        date_default_timezone_set('Asia/Jakarta');
        $id = $this->request->getPost('kodeproduk');
        $harga = $this->request->getPost('harga');
        $jumlahstok = $this->request->getPost('jumlahproduk');
        $jumlahdibeli = $this->request->getPost('jumlahbeli');
        $jumlahbhnbaku = intval($jumlahstok - $jumlahdibeli);
        $date = date('Y-m-d');
        if ((session()->get('masuk') == TRUE) && (session()->get('status') == 'Y')) {
            $data = [
                'no_pemesanan_detail' => $pemesanan->koderandom(),
                'kode_produk_penjualan_detail' => $id,
                'qty_produk_penjualan_detail' => $this->request->getPost('jumlahbeli'),
                'harga_produk_penjualan_detail' => $harga,
                'created_at' => date('Y-m-d H:i:s')
            ];
            $pemesanan->insert_data_temp($data);
            $dataproduk = [
                'kode_produk' => $id,
                'jumlah_produk' => $jumlahbhnbaku
            ];
            $produk->update_data($dataproduk, $id);
            session()->setFlashdata('success', 'Data Pesanan Berhasil Ditambahkan');
            return redirect()->to(base_url('Pemesanan/Tambah'));
        } else {
            return view('errors/erorr_pemesanan.php');
        }
    }

    function prosesbayar()
    {
        date_default_timezone_set('Asia/Jakarta');
        $date = date('Y-m-d:H:i:s');

        $id = $this->request->getPost('kodepesanan');
        $bayardp = $this->request->getPost('buktidp');
        $bayarsisa = $this->request->getPost('buktisisa');
        $pemesanan = new MPemesanan();
        $image = $this->request->getFile('gambar');
        $valid = $this->validate([
            'gambar' => [
                'label'  => 'Bukti Pembayaran',
                'rules'   => 'ext_in[gambar,jpg,jpeg,png]|mime_in[gambar,image/png,image/jpeg,image/jpg]',
                'errors' => [
                    'ext_in' => 'Format {field} Harus JPEG,JPG,PNG',
                    'mime_in' => 'Format {field} Harus JPEG,JPG,PNG',
                ],
            ]
        ]);

        if (!$valid) {
            session()->setFlashdata('errors', \Config\Services::validation()->getErrors());
            return redirect()->to(base_url('Pemesanan/bayar/' . $id));
        } else {
            $img = $image->getName();
            if ($bayardp == NULL && $bayarsisa == NULL) {
                if ($image->isValid()) {
                    $data = [
                        // 'bayar_sisa' => $this->request->getPost('bayardp'),
                        'bukti_dp' => $img,
                        'dp_pemesanan' => $this->request->getPost('bayardp'),
                        'status_pemesanan' => '2',
                        'updated_at' => $date,
                    ];
                    // dd($data,$id);
                    $image->move(ROOTPATH . 'public/fotobukti/', $img);
                    $pemesanan->update_data($data, $id);
                    session()->setFlashdata('success', 'Data Pembayaran 1 Berhasil Di Lakukan !!');
                    return redirect()->to(base_url('/Pemesanan'));
                } else {
                    session()->setFlashdata('delete', 'Bukti Transfer Belum Di Upload !!');
                }
            } else if ($bayardp != NULL && $bayarsisa == NULL) {
                if ($image->isValid()) {
                    $data = [
                        // 'bayar_sisa' => $this->request->getPost('bayardp'),
                        'bukti_sisa' => $img,
                        'bayar_sisa' => $this->request->getPost('bayardp'),
                        'status_pemesanan' => '3',
                        'updated_at' => $date,
                    ];
                    $image->move(ROOTPATH . 'public/fotobukti2/', $img);
                    $pemesanan->update_data($data, $id);
                    session()->setFlashdata('success', 'Data Pembayaran 2 Berhasil Di Lakukan !!');
                    return redirect()->to(base_url('/Pemesanan'));
                } else {
                    session()->setFlashdata('delete', 'Bukti Transfer Belum Di Upload !!');
                }
            }
        }
    }

    // function bayarsisa()
    // {
    //     date_default_timezone_set('Asia/Jakarta');
    //     $date = date('Y-m-d:H:i:s');
    //     $request = \Config\Services::request();
    //     $id = $request->uri->getSegment(3);
    //     // dd($id);
    //     $pemesanan = new MPemesanan();
    //     $image = $this->request->getFile('gambar');
    //     $img = $image->getName();
    //     if ($image->isValid()) {
    //         $data = [
    //             // 'bayar_sisa' => $this->request->getPost('bayardp'),
    //             'bukti_sisa' => $img,
    //             'bayar_sisa' => $this->request->getPost('bayardp'),
    //             'status_pemesanan' => '3',
    //             'updated_at' => $date,
    //         ];
    //         $image->move(ROOTPATH . 'public/fotobukti2/', $img);
    //         $pemesanan->update_data($data, $id);
    //     }
    //     session()->setFlashdata('delete', 'Data Produk Berhasil Di Hapus !!');
    //     return redirect()->to(base_url('/Pemesanan'));
    // }

    function bayar()
    {
        date_default_timezone_set('Asia/Jakarta');
        $date = date('Y-m-d:H:i:s');
        $request = \Config\Services::request();
        $id = $request->uri->getSegment(3);
        // dd($id);
        $pemesanan = new MPemesanan();


        $data = [
            'detail' => $pemesanan->detail($id),
            'no_pemesanan' => $id,
            'tgl_pemesanan' => $date,
            'detailpesanan' => $pemesanan->getDetailBayar($id),
            'isi' => 'Transaksi/Pemesanan/Bayar'
        ];
        return view('Layout_pelanggan/Template', $data);
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
            session()->setFlashdata('success', 'Data Produk Berhasil Di Ganti !!');
        } else if ($status == '3' || $status == '2') {
            $data = [
                'status_pemesanan' => '5',
            ];
            $pemesanan->update_data($data, $kode);
            session()->setFlashdata('success', 'Data Produk Berhasil Di Ganti !!');
        } else if ($status == '5') {
            $data = [
                'status_pemesanan' => '6',
            ];
            $pemesanan->update_data($data, $kode);
            session()->setFlashdata('success', 'Data Produk Sudah Di Ambil Pelanggan !!');
        }
        return redirect()->to(base_url('/Pemesanan'));
    }

    function add()
    {
        $pesanan = new MPemesanan();
        date_default_timezone_set('Asia/Jakarta');
        $date = date('Y-m-d:H:i:s');
        $tgl = date('Y-m-d');
        // $image = $this->request->getFile('gambar');
        // $img = $image->getName();
        $dataproduksi = [
            'kode_pemesanan' => $pesanan->koderandom(),
            'tgl_pemesanan' => $tgl,
            'kode_pelanggan' => session()->get('kode_user'),
            'status_pemesanan' => '1',
            'created_at' => $date
        ];
        $pesanan->insert_data($dataproduksi);
        // $image->move(ROOTPATH . 'public/fotobukti/', $img);
        session()->setFlashdata('success', 'Data Pesanan Berhasil Ditambahkan');
        return redirect()->to(base_url('/Pemesanan'));
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
