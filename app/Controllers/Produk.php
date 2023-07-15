<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\MBahanbaku;
use App\Models\MProduk;
use App\Models\MJenisMotif;
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
        $motif = new MJenisMotif();
        if ((session()->get('masuk') == TRUE) && (session()->get('status') == 'Y')) {
            $data = [
                'isi' => 'Master/Produk/Add',
                'jenismotif' => $motif->getAlldata()

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
            ]
        ]);

        $produk = new MProduk();
        date_default_timezone_set('Asia/Jakarta');
        $date = date('Y-m-d:H:i:s');
        if (!$valid) {
            session()->setFlashdata('errors', \Config\Services::validation()->getErrors());
            return redirect()->to(base_url('/Admin/Produk/Tambah'));
        } else {
            $data = [
                'kode_produk' => $produk->koderandom(),
                'nama_produk' => $this->request->getPost('namaproduk'),
                'kode_jenis_motif' => $this->request->getPost('kodejenis'),
                'harga_produk' => $this->request->getPost('harga'),
                'jumlah_produk' => $this->request->getPost('jumlah'),
                'created_at' => $date
            ];
            $produk = new MProduk();
            $produk->insert_data($data);
            session()->setFlashdata('success', 'Data Produk Berhasil Ditambahkan');
            return redirect()->to(base_url('/Admin/Produk'));
        }
    }

    public function edit($id)
    {
        $produk = new MProduk();
        $motif = new MJenisMotif();
        $request = \Config\Services::request();
        $data = [
            'isi' => 'Master/Produk/Edit',
            'jenismotif' => $motif->getAlldata(),
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
            ]
        ]);
        date_default_timezone_set('Asia/Jakarta');
        $date = date('Y-m-d:H:i:s');
        $kodeproduk = $this->request->getPost('kodeproduk');
        $produk = new MProduk();
        $qtyupdate = intval($this->request->getPost('jumlahsisa') + $this->request->getPost('jumlahtambah'));
        // dd($qtyupdate);
        if (!$valid) {
            session()->setFlashdata('errors', \Config\Services::validation()->getErrors());
            return redirect()->to(base_url('/Produk/edit/') . $kodeproduk);
        } else {

            $data = [
                'kode_jenis_motif' => $this->request->getPost('kodejenis'),
                'nama_produk' => $this->request->getPost('namaproduk'),
                'harga_produk' => $this->request->getPost('harga'),
                'updated_at' => $date
            ];
            $produk = new MProduk();
            $produk->update_data($data, $kodeproduk);
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
}
