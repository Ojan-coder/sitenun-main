<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\MJenisMotif;

class JenisMotif extends BaseController
{
    public function index()
    {
        $JenisMotif = new MJenisMotif();
        if ((session()->get('masuk') == TRUE) && (session()->get('status') == 'Y')) {
            $data = [
                'data' => $JenisMotif->getAllData(),
                'isi' => 'Master/JenisMotif/Data'
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
                'isi' => 'Master/JenisMotif/Add'
            ];
            return view('Layout/Template', $data);
        } else {
            return view('errors/error_login.php');
        }
    }

    public function add()
    {
        $valid = $this->validate([
            'jenismotif' => [
                'label'  => 'Jenis Motif',
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
            ]
        ]);

        $JenisMotif = new MJenisMotif();
        date_default_timezone_set('Asia/Jakarta');
        $date = date('Y-m-d:H:i:s');
        if (!$valid) {
            session()->setFlashdata('errors', \Config\Services::validation()->getErrors());
            return redirect()->to(base_url('/Admin/JenisMotif/Tambah'));
        } else {
            $data = [
                'kode_jenis' => $JenisMotif->koderandom(),
                'jenis_motif' => $this->request->getPost('jenismotif'),
                'deskripsi' => $this->request->getPost('deskripsi'),
                'created_at' => $date
            ];
            $JenisMotif = new MJenisMotif();
            $JenisMotif->insert_data($data);
            session()->setFlashdata('success', 'Data Jenis Motif Berhasil Ditambahkan');
            return redirect()->to(base_url('/Admin/JenisMotif'));
        }
    }

    public function edit($id)
    {
        $JenisMotif = new MJenisMotif();
        $request = \Config\Services::request();
        // $id = $request->uri->getSegment(3);
        $data = [
            // 'kodeproduk'=>$id,
            'isi' => 'Master/JenisMotif/Edit',
            'data' => $JenisMotif->detail($id)
        ];
        return view('Layout/Template', $data);
    }

    public function update()
    {
        $valid = $this->validate([
            'namaproduk' => [
                'label'  => 'Nama JenisMotif',
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
                'label'  => 'Harga JenisMotif',
                'rules'   => 'required|',
                'errors' => [
                    'required' => '{field} Wajib Diisi'
                ],
            ],
            'jumlah' => [
                'label'  => 'Jumlah JenisMotif',
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
        $JenisMotif = new MJenisMotif();
        if (!$valid) {
            session()->setFlashdata('errors', \Config\Services::validation()->getErrors());
            return redirect()->to(base_url('/Admin/JenisMotif/edit/') . $kodeproduk);
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
                if ($gambar == NULL || $gambar == '') {
                    $image->move(ROOTPATH . 'public/fotoproduk/', $img);
                } else {
                    unlink('fotoproduk/' . $gambar);
                    $image->move(ROOTPATH . 'public/fotoproduk/', $img);
                }
                $JenisMotif = new MJenisMotif();
                $JenisMotif->update_data($data, $kodeproduk);
            } else {
                $data = [
                    'namaproduk' => $this->request->getPost('namaproduk'),
                    'hargaproduk' => $this->request->getPost('harga'),
                    'jumlahproduk' => $this->request->getPost('jumlah'),
                    'deskripsiproduk' => $this->request->getPost('deskripsi'),
                    'updated_at' => $date
                ];
                $JenisMotif = new MJenisMotif();
                $JenisMotif->update_data($data, $kodeproduk);
            }
            session()->setFlashdata('success', 'Data JenisMotif Berhasil Di Update');
            return redirect()->to(base_url('/Admin/JenisMotif'));
        }
    }

    public function delete()
    {
        $id = $this->request->getPost('iduser');
        $usr = new MJenisMotif();
        $usr->hapus($id);
        session()->setFlashdata('success', 'Data Jenis Motif Berhasil Di Hapus !!');
        return redirect()->to(base_url('/Admin/JenisMotif'));
    }

    public function laporan()
    {
    }
}
