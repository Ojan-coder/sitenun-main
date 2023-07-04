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
        $bahan = new MBahanbaku();
        $produk = new MProduk();
        if ((session()->get('masuk') == TRUE) && (session()->get('status') == 'Y')) {
            $data = [
                'isi' => 'Master/Produk/Add',
                'jenismotif' => $motif->getAlldata(),
                'bahanbaku' => $bahan->getAlldata(),
                'detailbahanbaku' => $produk->getDataTableDetail(),

            ];
            return view('Layout/Template', $data);
        } else {
            return view('errors/error_login.php');
        }
    }
    public function simp_detail()
    {
        $spp = new MProduk();
        date_default_timezone_set('Asia/Jakarta');
        $id = $this->request->getPost('kodebahanbaku');
        $jumlahbhnbaku = intval($this->request->getPost('jumlah1') - $this->request->getPost('jumlahbahanbaku'));
        // dd([$id,$jumlahbhnbaku]);
        $data = [
            'kode_produksi_detail' => $spp->koderandom(),
            'kode_bahan_baku_detail' => $this->request->getPost('kodebahanbaku'),
            'qty_bahan_baku_keluar_detail' => $this->request->getPost('jumlahbahanbaku'),
            'created_at' => date('Y-m-d H:i:s')
        ];
        $dataupdate = [
            'kode_bahan_baku' => $id,
            'jumlah_bahan_baku' => $jumlahbhnbaku
        ];
        // dd($dataupdate);
        $bahanbaku = new MBahanbaku();
        $bahanbaku->update_data($dataupdate, $id);

        $mhs = new MProduk();
        $mhs->insert_data_temp($data);
        session()->setFlashdata('successbahanbaku', 'Data Bahan Baku Berhasil Ditambahkan');
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
                    'kode_produksi' => $produk->koderandom(),
                    'kode_jenis_motif' => $this->request->getPost('kodejenis'),
                    'harga_produk' => $this->request->getPost('harga'),
                    'satuan_produk' => 'Meter',
                    'jumlah_produk' => $this->request->getPost('jumlah'),
                    'gambarproduk' => $img,
                    'created_at' => $date
                ];
                $image->move(ROOTPATH . 'public/fotoproduk/', $img);
                $produk = new MProduk();
                $produk->insert_data($data);
            } else {
                $data = [
                    'kode_produksi' => $produk->koderandom(),
                    'kode_jenis_motif' => $this->request->getPost('kodejenis'),
                    'harga_produk' => $this->request->getPost('harga'),
                    'satuan_produk' => 'Meter',
                    'jumlah_produk' => $this->request->getPost('jumlah'),
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
        $qtyupdate = intval($this->request->getPost('jumlahsisa') + $this->request->getPost('jumlahtambah'));
        // dd($qtyupdate);
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
                    'jumlahproduk' => $qtyupdate,
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
                $produk = new MProduk();
                $produk->update_data($data, $kodeproduk);
            } else {
                $data = [
                    'namaproduk' => $this->request->getPost('namaproduk'),
                    'hargaproduk' => $this->request->getPost('harga'),
                    'jumlahproduk' => $qtyupdate,
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

    public function delete_bahanbaku()
    {
        $request = \Config\Services::request();
        $id = $request->uri->getSegment(3);
        $id_detail = $request->uri->getSegment(6);
        $stokdipakai = $request->uri->getSegment(4);
        $stokskrng = $request->uri->getSegment(5);

        $jumlahbhnbaku = intval($stokdipakai + $stokskrng);
        $dataupdate = [
            'jumlah_bahan_baku' => $jumlahbhnbaku
        ];
        // dd([$dataupdate,$id_detail]);
        $bahanbaku = new MBahanbaku();
        $bahanbaku->update_data($dataupdate, $id);

        $usr = new MProduk();
        $usr->hapus_detail($id, $id_detail);
        session()->setFlashdata('deletebahanbaku', 'Data Produk Berhasil Di Hapus !!');
        return redirect()->to(base_url('/Admin/Produk/Tambah'));
    }

    public function laporan()
    {
    }
}
