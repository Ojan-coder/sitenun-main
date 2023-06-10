<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\MProduk;
use Dompdf\Dompdf;

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
    public function add()
    {
        $valid = $this->validate([
            'namaproduk' => [
                'label'  => 'Nama Produk',
                'rules'   => 'required',
                'errors' => [
                    'required' => '{field} Wajib Diisi'
                ],
            ],
            'deskripsi' => [
                'label'  => 'Deskripsi',
                'rules'   => 'required|',
                'errors' => [
                    'required' => '{field} Wajib Diisi'
                ],
            ],
            'harga' => [
                'label'  => 'Harga Produk',
                'rules'   => 'required|',
                'errors' => [
                    'required' => '{field} Wajib Diisi'
                ],
            ],
            'jumlah' => [
                'label'  => 'Jumlah Produk',
                'rules'   => 'required|',
                'errors' => [
                    'required' => '{field} Wajib Diisi'
                ],
            ],
            'gambar' => [
                'label'  => 'Upload Formulir',
                'rules'   => 'max_size[gambar,2048]|ext_in[gambar,jpg,jpeg,png]',
                'errors' => [
                    'max_size' => 'Ukuran gambar Formulir Maximal 2 MB',
                    'ext_in' => 'Gambar Formulir Yang Di Upload Harus JPG,JPEG,PNG',
                ],
            ]
        ]);

        $produk = new MProduk();
        if (!$valid) {
            session()->setFlashdata('errors', \Config\Services::validation()->getErrors());
            return redirect()->to('Produk/Tambah');
        } else {
            $image = $this->request->getFile('gambar');
            $img = $image->getName();
            if ($image->isValid()) {
                $data = [
                    'kodeproduk' => $produk->koderandom(),
                    'namaproduk' => $this->request->getPost('namaproduk'),
                    'hargaproduk' => $this->request->getPost('harga'),
                    'jumlahproduk' => $this->request->getPost('jumlah'),
                    'deskripsiproduk' => $this->request->getPost('deskripsi'),
                    'gambarproduk' => $img
                ];
                $image->move(ROOTPATH . 'public/produk/', $img);
                $produk = new MProduk();
                $produk->insert_data($data);
            } else {
                $data = [
                    'kodeproduk' => $produk->koderandom(),
                    'namaproduk' => $this->request->getPost('namaproduk'),
                    'hargaproduk' => $this->request->getPost('harga'),
                    'jumlahproduk' => $this->request->getPost('jumlah'),
                    'deskripsiproduk' => $this->request->getPost('deskripsi'),
                ];
                $produk = new MProduk();
                $produk->insert_data($data);
            }
            session()->setFlashdata('success', 'Data Produk Berhasil Ditambahkan');
            return redirect()->to('Produk');
        }
    }

    public function edit()
    {
        $produk = new MProduk();
        $request = \Config\Services::request();
        $id = $request->uri->getSegment(3);
        $data = [
            'isi' => 'Master/Produk/Edit',
            'data' => $produk->detail($id)
        ];
        return view('Layout/Template', $data);
    }

    public function update()
    {
        $valid = $this->validate([
            'namaproduk' => [
                'label'  => 'Nama Produk',
                'rules'   => 'required',
                'errors' => [
                    'required' => '{field} Wajib Diisi'
                ],
            ],
            'deskripsi' => [
                'label'  => 'Deskripsi',
                'rules'   => 'required|',
                'errors' => [
                    'required' => '{field} Wajib Diisi'
                ],
            ],
            'harga' => [
                'label'  => 'Harga Produk',
                'rules'   => 'required|',
                'errors' => [
                    'required' => '{field} Wajib Diisi'
                ],
            ],
            'jumlah' => [
                'label'  => 'Jumlah Produk',
                'rules'   => 'required|',
                'errors' => [
                    'required' => '{field} Wajib Diisi'
                ],
            ],
            'gambar' => [
                'label'  => 'Upload Formulir',
                'rules'   => 'max_size[gambar,2048]|ext_in[gambar,jpg,jpeg,png]',
                'errors' => [
                    'max_size' => 'Ukuran gambar Formulir Maximal 2 MB',
                    'ext_in' => 'Gambar Formulir Yang Di Upload Harus JPG,JPEG,PNG',
                ],
            ]
        ]);
        $kodeproduk = $this->request->getPost('kodeproduk');
        $produk = new MProduk();
        if (!$valid) {
            session()->setFlashdata('errors', \Config\Services::validation()->getErrors());
            return redirect()->to('Produk/edit/'.$kodeproduk);
        } else {
            $kodeproduk = $this->request->getPost('kodeproduk');
            $image = $this->request->getFile('gambar');
            $img = $image->getName();
            if ($image->isValid()) {
                $data = [
                    'namaproduk' => $this->request->getPost('namaproduk'),
                    'hargaproduk' => $this->request->getPost('harga'),
                    'jumlahproduk' => $this->request->getPost('jumlah'),
                    'deskripsiproduk' => $this->request->getPost('deskripsi'),
                    'gambarproduk' => $img
                ];
                $image->move(ROOTPATH . 'public/produk/', $img);
                $produk = new MProduk();
                $produk->update_data($data, $kodeproduk);
            } else {
                $data = [
                    'namaproduk' => $this->request->getPost('namaproduk'),
                    'hargaproduk' => $this->request->getPost('harga'),
                    'jumlahproduk' => $this->request->getPost('jumlah'),
                    'deskripsiproduk' => $this->request->getPost('deskripsi'),
                ];
                $produk = new MProduk();
                $produk->update_data($data, $kodeproduk);
            }
            session()->setFlashdata('success', 'Data Produk Berhasil Di Update');
            return redirect()->to('Produk');
        }
    }

    public function delete()
    {
        $id = $this->request->getPost('iduser');
        $usr = new MProduk();
        $usr->hapus($id);
        session()->setFlashdata('success', 'Data Produk Berhasil Di Hapus !!');
        return redirect()->to('Produk');
    }

    public function laporan(){
        
    }
}
