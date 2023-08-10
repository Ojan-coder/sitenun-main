<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\MKaryawan;
use App\Models\MUser;

class Karyawan extends BaseController
{
    public function index()
    {
        $pelanggan = new MKaryawan();
        if ((session()->get('masuk') == TRUE) && (session()->get('status') == 'Y')) {
            $data = [
                'data' => $pelanggan->getAllData(),
                'isi' => 'Master/Karyawan/Data'
            ];
            return view('Layout/Template', $data);
        } else {
            return view('errors/error_login.php');
        }
    }

    public function tambah()
    {
        $pelanggan = new MKaryawan();
        $user = new MUser();
        if ((session()->get('masuk') == TRUE) && (session()->get('status') == 'Y')) {
            $data = [
                'level' => $user->getDataLevel(),
                'isi' => 'Master/Karyawan/Add'
            ];
            return view('Layout/Template', $data);
        } else {
            return view('errors/error_login.php');
        }
    }

    public function add()
    {
        $valid = $this->validate([
            'namapelanggan' => [
                'label'  => 'Nama Pelanggan',
                'rules'   => 'required',
                'errors' => [
                    'required' => '{field} Wajib Diisi'
                ],
            ],
            'alamat' => [
                'label'  => 'Alamat Pelanggan',
                'rules'   => 'required',
                'errors' => [
                    'required' => '{field} Wajib Diisi'
                ],
            ],
            'notelp' => [
                'label'  => 'No.Telp / Handphone',
                'rules'   => 'required|max_length[12]',
                'errors' => [
                    'required' => '{field} Wajib Diisi',
                    'max_length' => 'Maximal 12 Character'
                ],
            ],
            'username' => [
                'label'  => 'Username',
                'rules'   => 'required|is_unique[user.username]',
                'errors' => [
                    'required' => '{field} Wajib Diisi',
                    'is_unique' => '{field} Sudah Terpakai !'
                ],
            ],
            'password' => [
                'label'  => 'Password',
                'rules'   => 'required|min_length[8]',
                'errors' => [
                    'required' => '{field} Wajib Diisi',
                    'min_length' => '{field} Maximal 8 Character'
                ],
            ]
        ]);

        $pelanggan = new MKaryawan();
        $user = new MUser();
        date_default_timezone_set('Asia/Jakarta');
        $date = date('Y-m-d:H:i:s');
        if (!$valid) {
            session()->setFlashdata('errors', \Config\Services::validation()->getErrors());
            return redirect()->to(base_url('Karyawan/Tambah'));
        } else {
            $pass = "pelanggan123";
            $pw = password_hash($pass, PASSWORD_BCRYPT);
            $data1 = [
                'username' => $this->request->getPost('username'),
                'kode_user' => $pelanggan->koderandom(),
                'fullname' => $this->request->getPost('namapelanggan'),
                'level_user' => $this->request->getPost('cblevel'),
                'status' => 'Y',
                'password' => $pw,
                'created_at' => $date
            ];
            $user->insert_data($data1);
            $data = [
                'kodekaryawan' => $pelanggan->koderandom(),
                'namalengkap' => $this->request->getPost('namapelanggan'),
                'tgl_lahir' => $this->request->getPost('tgllahir'),
                'kodejenkel' => $this->request->getPost('cbjenkel'),
                'alamat' => $this->request->getPost('alamat'),
                'nohp' => $this->request->getPost('notelp'),
                'created_at' => $date
            ];
            $pelanggan->insert_data($data);

            session()->setFlashdata('success', 'Data Berhasil di Tambahkan');
            // session()->setFlashdata('successakun', 'Registrasi Berhasil, Password anda : pelanggan123');
            return redirect()->to(base_url('Karyawan'));
        }
    }

    public function edit()
    {
        $pelanggan = new MKaryawan();
        $user = new MUser();
        $request = \Config\Services::request();
        $id = $request->uri->getSegment(3);
        // dd($id);
        $data = [
            'isi' => 'Master/Karyawan/Edit',
            'data' => $pelanggan->detail($id),
            'datauser' => $user->detail($id),
        ];
        return view('Layout/Template', $data);
    }

    public function update()
    {
        $id = $this->request->getPost('kodepelanggan');
        $pelanggan = new MKaryawan();
        $user = new MUser();
        date_default_timezone_set('Asia/Jakarta');
        $date = date('Y-m-d:H:i:s');
        $pas = $this->request->getVar('passwordbaru');
        $pw = password_hash($pas, PASSWORD_BCRYPT);

        $valid = $this->validate([
            'namapelanggan' => [
                'label'  => 'Nama Pelanggan',
                'rules'   => 'required',
                'errors' => [
                    'required' => '{field} Wajib Diisi'
                ],
            ],
            'alamat' => [
                'label'  => 'Alamat Pelanggan',
                'rules'   => 'required',
                'errors' => [
                    'required' => '{field} Wajib Diisi'
                ],
            ],
            'notelp' => [
                'label'  => 'No.Telp / Handphone',
                'rules'   => 'required|max_length[12]',
                'errors' => [
                    'required' => '{field} Wajib Diisi',
                    'max_length' => 'Maximal 12 Character'
                ],
            ]
        ]);

        if (!$valid) {
            session()->setFlashdata('errors', \Config\Services::validation()->getErrors());
            return redirect()->to('Karyawan/Tambah');
        } else {
            $data = [
                'namalengkap' => $this->request->getPost('namapelanggan'),
                'tgl_lahir' => $this->request->getPost('tgllahir'),
                'kodejenkel' => $this->request->getPost('cbjenkel'),
                'alamat' => $this->request->getPost('alamat'),
                'nohp' => $this->request->getPost('notelp'),
                'updated_at' => $date
            ];

            $pelanggan->update_data($data, $id);


            if ($this->request->getPost('passwordbaru') != NULL || $this->request->getPost('passwordbaru') != '') {
                $datauser = [
                    'username' => $this->request->getPost('username'),
                    'password' => $pw
                ];
                $user->update_data($datauser, $id);
            } else {
                $datauser = [
                    'username' => $this->request->getPost('username')
                ];
                $user->update_data($datauser, $id);
            }

            session()->setFlashdata('success', 'Data Pelanggan Berhasil Di Update');
            return redirect()->to('Karyawan');
        }
    }


    public function delete()
    {
        $id = $this->request->getPost('iduser');
        $pelanggan = new MKaryawan();
        $pelanggan->hapus($id);
        session()->setFlashdata('success', 'Data Pelanggan Berhasil Di Hapus !!');
        return redirect()->to('Pelanggan');
    }
}
