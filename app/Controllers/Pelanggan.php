<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\MPelanggan;
use App\Models\MUser;

class Pelanggan extends BaseController
{
    public function index()
    {
        $pelanggan = new MPelanggan();
        if ((session()->get('masuk') == TRUE) && (session()->get('status') == 'Y')) {
            $data = [
                'data' => $pelanggan->getAllData(),
                'isi' => 'Master/Pelanggan/Data'
            ];
            return view('Layout/Template', $data);
        } else {
            return view('errors/error_login.php');
        }
    }

    public function tambah()
    {
        $pelanggan = new MPelanggan();
        if ((session()->get('masuk') == TRUE) && (session()->get('status') == 'Y')) {
            $data = [
                'isi' => 'Master/Pelanggan/Add'
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
                'rules'   => 'required|max_length[8]',
                'errors' => [
                    'required' => '{field} Wajib Diisi',
                    'max_length' => '{field} Maximal 8 Character'
                ],
            ]
        ]);

        $pelanggan = new MPelanggan();
        $user = new MUser();
        date_default_timezone_set('Asia/Jakarta');
        $date = date('Y-m-d:H:i:s');
        if (!$valid) {
            session()->setFlashdata('errors', \Config\Services::validation()->getErrors());
            return redirect()->to(base_url('Pelanggan/Tambah'));
        } else {
            $data = [
                'kodepelanggan' => $pelanggan->koderandom(),
                'namapelanggan' => $this->request->getPost('namapelanggan'),
                'tgl_lahir' => $this->request->getPost('tgllahir'),
                'kodejenkel' => $this->request->getPost('cbjenkel'),
                'alamat' => $this->request->getPost('alamat'),
                'notelp' => $this->request->getPost('notelp'),
                'created_at' => $date
            ];
            $pelanggan->insert_data($data);
            $pass = "pelanggan123";
            $pw = password_hash($pass, PASSWORD_BCRYPT);
            $data1 = [
                'username' => $this->request->getPost('username'),
                'fullname' => $this->request->getPost('namapelanggan'),
                'level_user' => '4',
                'status' => 'Y',
                'password' => $pw,
                'created_at' => $date
            ];
            $user->insert_data($data1);
            session()->setFlashdata('success', 'Data Berhasil di Tambahkan');
            session()->setFlashdata('successakun', 'Registrasi Berhasil, Password anda : pelanggan123');
            return redirect()->to(base_url('Pelanggan'));
        }
    }

    public function addregister()
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
                'rules'   => 'required|max_length[8]',
                'errors' => [
                    'required' => '{field} Wajib Diisi',
                    'max_length' => '{field} Maximal 8 Character'
                ],
            ]
        ]);

        $pelanggan = new MPelanggan();
        $user = new MUser();
        date_default_timezone_set('Asia/Jakarta');
        $date = date('Y-m-d:H:i:s');
        if (!$valid) {
            session()->setFlashdata('errors', \Config\Services::validation()->getErrors());
            return redirect()->to(base_url('Pelanggan/Register'));
        } else {
            $pass = $this->request->getVar('password');
            $pw = password_hash($pass, PASSWORD_BCRYPT);
            $data1 = [
                'kode_user' => $pelanggan->koderandom(),
                'username' => $this->request->getPost('username'),
                'fullname' => $this->request->getPost('namapelanggan'),
                'level_user' => '4',
                'status' => 'Y',
                'password' => $pw,
                'created_at' => $date
            ];
            $user->insert_data($data1);
            $data = [
                'kodepelanggan' => $pelanggan->koderandom(),
                'namapelanggan' => $this->request->getPost('namapelanggan'),
                'tgl_lahir' => $this->request->getPost('tgllahir'),
                'kodejenkel' => $this->request->getPost('cbjenkel'),
                'alamat' => $this->request->getPost('alamat'),
                'notelp' => $this->request->getPost('notelp'),
                'created_at' => $date
            ];
            $pelanggan->insert_data($data);

            session()->setFlashdata('success', 'Data Berhasil di Tambahkan');
            session()->setFlashdata('successakun', 'Registrasi Berhasil, Silahkan Login !');
            return redirect()->to(base_url('Pelanggan/Register'));
        }
    }

    public function edit()
    {
        $pelanggan = new MPelanggan();
        $request = \Config\Services::request();
        $id = $request->uri->getSegment(3);
        $data = [
            'isi' => 'Master/Pelanggan/Edit',
            'data' => $pelanggan->detail($id)
        ];
        return view('Layout/Template', $data);
    }

    public function update()
    {
        $id = $this->request->getPost('kodepelanggan');
        $pelanggan = new MPelanggan();
        date_default_timezone_set('Asia/Jakarta');
        $date = date('Y-m-d:H:i:s');

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
            return redirect()->to('Pelanggan/Tambah');
        } else {
            $data = [
                'namapelanggan' => $this->request->getPost('namapelanggan'),
                'tgl_lahir' => $this->request->getPost('tgllahir'),
                'kodejenkel' => $this->request->getPost('cbjenkel'),
                'alamat' => $this->request->getPost('alamat'),
                'notelp' => $this->request->getPost('notelp'),
                'updated_at' => $date
            ];

            $pelanggan->update_data($data, $id);
            session()->setFlashdata('success', 'Data Pelanggan Berhasil Di Update');
            return redirect()->to('Pelanggan');
        }
    }


    public function delete()
    {
        $id = $this->request->getPost('iduser');
        $pelanggan = new MPelanggan();
        $pelanggan->hapus($id);
        session()->setFlashdata('success', 'Data Pelanggan Berhasil Di Hapus !!');
        return redirect()->to('Pelanggan');
    }

    public function register()
    {
        return view('Master/Pelanggan/Register');
    }
}
