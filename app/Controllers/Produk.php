<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\MProduk;
use Dompdf\Dompdf;

use function PHPUnit\Framework\isEmpty;

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
        date_default_timezone_set('Asia/Jakarta');
        $date = date('Y-m-d:H:i:s');
        if (!$valid) {
            session()->setFlashdata('errors', \Config\Services::validation()->getErrors());
            return redirect()->to(base_url('/Admin/Produk/Tambah'));
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
                    'gambarproduk' => $img,
                    'created_at' => $date
                ];
                $image->move(ROOTPATH . 'public/fotoproduk/', $img);
                $produk = new MProduk();
                $produk->insert_data($data);
            } else {
                $data = [
                    'kodeproduk' => $produk->koderandom(),
                    'namaproduk' => $this->request->getPost('namaproduk'),
                    'hargaproduk' => $this->request->getPost('harga'),
                    'jumlahproduk' => $this->request->getPost('jumlah'),
                    'deskripsiproduk' => $this->request->getPost('deskripsi'),
                    'created_at' => $date
                ];
                $produk = new MProduk();
                $produk->insert_data($data);
            }
            session()->setFlashdata('success', 'Data Produk Berhasil Ditambahkan');
            return redirect()->to(base_url('/Admin/Produk'));
        }
    }

    public function edit($id)
    {
        $produk = new MProduk();
        $request = \Config\Services::request();
        // $id = $request->uri->getSegment(3);
        $data = [
            // 'kodeproduk'=>$id,
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
        date_default_timezone_set('Asia/Jakarta');
        $date = date('Y-m-d:H:i:s');
        $kodeproduk = $this->request->getPost('kodeproduk');
        $produk = new MProduk();
        if (!$valid) {
            session()->setFlashdata('errors', \Config\Services::validation()->getErrors());
            return redirect()->to(base_url('/Admin/Produk/edit/') . $kodeproduk);
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
                    'gambarproduk' => $img,
                    'updated_at' => $date
                ];
                $gambar = $this->request->getPost('foto');
                if ($gambar == isEmpty() || $gambar == '') {
                    $image->move(ROOTPATH . 'public/fotoproduk/', $img);
                } else {
                    unlink('fotoproduk/' . $gambar);
                    $image->move(ROOTPATH . 'public/fotoproduk/', $img);
                }
                $produk = new MProduk();
                $produk->update_data($data, $kodeproduk);
            } else {
                $data = [
                    'namaproduk' => $this->request->getPost('namaproduk'),
                    'hargaproduk' => $this->request->getPost('harga'),
                    'jumlahproduk' => $this->request->getPost('jumlah'),
                    'deskripsiproduk' => $this->request->getPost('deskripsi'),
                    'updated_at' => $date
                ];
                $produk = new MProduk();
                $produk->update_data($data, $kodeproduk);
            }
            session()->setFlashdata('success', 'Data Produk Berhasil Di Update');
            return redirect()->to(base_url('/Admin/Produk'));
        }
    }

    public function delete()
    {
        $id = $this->request->getPost('iduser');
        $foto = $this->request->getPost('foto');
        $usr = new MProduk();
        unlink('fotoproduk/' . $foto);
        $usr->hapus($id);
        session()->setFlashdata('success', 'Data Produk Berhasil Di Hapus !!');
        return redirect()->to(base_url('/Admin/Produk'));
    }

    public function laporan()
    {
    }
}
