<?php

namespace App\Controllers;

use App\Models\MUser;
use App\Models\Mkaryawan;

class User extends BaseController
{
    public function index()
    {
        $user = new MUser();
        if ((session()->get('masuk') == TRUE) && (session()->get('status') == 'Y')) {
            $data = [
                'judul' => 'Tambah User',
                'submenu' => 'User',
                'data' => $user->getAllData(),
                'isi' => 'Master/User/Data'
            ];
            return view('Layout/Template', $data);
        } else {
            return view('errors/error_login.php');
        }
    }
    public function tambah()
    {
        $user = new MUser();
        if ((session()->get('masuk') == TRUE) && (session()->get('status') == 'Y')) {
            $data = [
                'level' => $user->getDataLevel(),
                'isi' => 'Master/User/Add'
            ];
            return view('Layout/Template', $data);
        } else {
            return view('errors/error_login.php');
        }
    }
    public function add()
    {
        $user = new MUser();
        $pegawai = new Mkaryawan();
        date_default_timezone_set('Asia/Jakarta');
        $date = date('Y-m-d:H:i:s');
        $valid = $this->validate([
            'username' => [
                'label'  => 'Username',
                'rules'   => 'required|is_unique[user.username]',
                'errors' => [
                    'required' => '{field} Wajib Diisi',
                    'is_unique' => '{field} Username Sudah Terdaftar'
                ],
            ],
            'nama' => [
                'label'  => 'Nama Lengkap',
                'rules'   => 'required',
                'errors' => [
                    'required' => '{field} Wajib Diisi'
                ],
            ],
            'alamat' => [
                'label'  => 'Alamat',
                'rules'   => 'required',
                'errors' => [
                    'required' => '{field} Wajib Diisi'
                ],
            ],
            'nohp' => [
                'label'  => 'No.Hp',
                'rules'   => 'required|max_length[12]',
                'errors' => [
                    'required' => '{field} Wajib Diisi',
                    'max_length' => '{field} Maximal 12 Karakter'
                ],
            ],
            'pass' => [
                'label'  => 'Password',
                'rules'   => 'required|min_length[8]',
                'errors' => [
                    'required' => '{field} Wajib Diisi',
                    'min_length' => 'Password Minimal Character 8'
                ],
            ]
        ]);

        if (!$valid) {
            session()->setFlashdata('errors', \Config\Services::validation()->getErrors());
            return redirect()->to(base_url('Admin/User-Tambah'));
        } else {

            $pas = $this->request->getVar('pass');
            $pw = password_hash($pas, PASSWORD_BCRYPT);
            $data = [
                'kode_user' => $pegawai->koderandom(),
                'username' => $this->request->getPost('username'),
                'fullname' => $this->request->getPost('nama'),
                'level_user' => $this->request->getPost('cbakses'),
                'password' => $pw,
                'created_at' => $date,
                'status' => 'Y'
            ];
            $user->insert_data($data);

            $datapegawai = [
                'kode_pegawai' => $pegawai->koderandom(),
                'nama_lengkap' => $this->request->getPost('nama'),
                'tgl_lahir' => $this->request->getPost('tgl'),
                'jenis_kelamin' => $this->request->getPost('cbjenkel'),
                'alamat' => $this->request->getPost('alamat'),
                'nohp' => $this->request->getPost('nohp'),
                'created_at' => $date,
            ];
            $pegawai->insert_data($datapegawai);
            session()->setFlashdata('success', 'Data Pegawai Berhasil Ditambahkan');
            return redirect()->to(base_url('Admin/User'));
        }
    }

    public function edit()
    {
        $user = new MUser();
        $request = \Config\Services::request();
        $id = $request->uri->getSegment(3);
        // dd($user->detail($id));
        $data = [
            'level' => $user->getDataLevel(),
            'isi' => 'Master/User/Edit',
            'data' => $user->detail($id)
        ];
        return view('Layout/Template', $data);
    }

    public function update()
    {
        date_default_timezone_set('Asia/Jakarta');
        $date = date('Y-m-d:H:i:s');
        $pass = $this->request->getVar('pass');
        $kode = $this->request->getPost('kodepegawai');
        $id = $this->request->getPost('iduser');
        $user = new MUser();
        $pegawai = new Mkaryawan();
        if (empty($pass)) {
            $valid = $this->validate([
                'username' => [
                    'label'  => 'Username',
                    'rules'   => 'required',
                    'errors' => [
                        'required' => '{field} Wajib Diisi'
                    ],
                ],
                'nama' => [
                    'label'  => 'Nama Lengkap',
                    'rules'   => 'required',
                    'errors' => [
                        'required' => '{field} Wajib Diisi'
                    ],
                ],
                'alamat' => [
                    'label'  => 'Alamat',
                    'rules'   => 'required',
                    'errors' => [
                        'required' => '{field} Wajib Diisi'
                    ],
                ],
                'nohp' => [
                    'label'  => 'No.Hp',
                    'rules'   => 'required|max_length[12]',
                    'errors' => [
                        'required' => '{field} Wajib Diisi',
                        'max_length' => '{field} Maximal 12 Karakter'
                    ],
                ]
            ]);
        } else {
            $valid = $this->validate([
                'username' => [
                    'label'  => 'Username',
                    'rules'   => 'required',
                    'errors' => [
                        'required' => '{field} Wajib Diisi'
                    ],
                ],
                'nama' => [
                    'label'  => 'Nama Lengkap',
                    'rules'   => 'required',
                    'errors' => [
                        'required' => '{field} Wajib Diisi'
                    ],
                ],
                'alamat' => [
                    'label'  => 'Alamat',
                    'rules'   => 'required',
                    'errors' => [
                        'required' => '{field} Wajib Diisi'
                    ],
                ],
                'nohp' => [
                    'label'  => 'No.Hp',
                    'rules'   => 'required|max_length[12]',
                    'errors' => [
                        'required' => '{field} Wajib Diisi',
                        'max_length' => '{field} Maximal 12 Karakter'
                    ],
                ],
                'pass' => [
                    'label'  => 'Password',
                    'rules'   => 'required|min_length[8]',
                    'errors' => [
                        'required' => '{field} Wajib Diisi',
                        'min_length' => 'Password Minimal Character 8'
                    ],
                ],
                'pass' => [
                    'label'  => 'Password',
                    'rules'   => 'required|min_length[8]',
                    'errors' => [
                        'required' => '{field} Wajib Diisi',
                        'min_length' => 'Password Minimal Character 8'
                    ],
                ]
            ]);
        }


        if (!$valid) {

            session()->setFlashdata('errors', \Config\Services::validation()->getErrors());
            return redirect()->to('User/edit/' . $id);
        } else {
            if (empty($pass)) {

                $pw = password_hash($pass, PASSWORD_BCRYPT);
                $data = [
                    'username' => $this->request->getPost('username'),
                    'fullname' => $this->request->getPost('nama'),
                    'level_user' => $this->request->getPost('cbakses'),
                    'status' => $this->request->getPost('cbstatus'),
                    'updated_at' => $date
                ];
                $user->update_data($data, $id);
                $datapegawai = [
                    'nama_lengkap' => $this->request->getPost('nama'),
                    'tgl_lahir' => $this->request->getPost('tgl'),
                    'jenis_kelamin' => $this->request->getPost('cbjenkel'),
                    'alamat' => $this->request->getPost('alamat'),
                    'nohp' => $this->request->getPost('nohp'),
                    'updated_at' => $date,
                ];
                $pegawai->update_data($datapegawai, $kode);
            } else {

                $pw = password_hash($pass, PASSWORD_BCRYPT);
                $data = [
                    'username' => $this->request->getPost('username'),
                    'fullname' => $this->request->getPost('nama'),
                    'level_user' => $this->request->getPost('cbakses'),
                    'status' => $this->request->getPost('cbstatus'),
                    'password' => $pw,
                    'updated_at' => $date
                ];
                $user->update_data($data, $id);
                $datapegawai = [
                    'nama_lengkap' => $this->request->getPost('nama'),
                    'tgl_lahir' => $this->request->getPost('tgl'),
                    'jenis_kelamin' => $this->request->getPost('cbjenkel'),
                    'alamat' => $this->request->getPost('alamat'),
                    'nohp' => $this->request->getPost('nohp'),
                    'updated_at' => $date,
                ];
                $pegawai->update_data($datapegawai, $kode);
            }

            session()->setFlashdata('success', 'Data Pegawai Berhasil Di Update !!');
            return redirect()->to(base_url('Admin/User'));
        }
    }

    public function changestatusy()
    {
        date_default_timezone_set('Asia/Jakarta');
        $date = date('Y-m-d:H:i:s');
        $id = $this->request->getPost('idusery');
        $data = [
            'status' => 'N',
            'updated_at' => $date
        ];
        $user = new MUser();
        $user->update_data($data, $id);
        session()->setFlashdata('success', 'Data User Di-Aktifkan !!');
        return redirect()->to(base_url('Admin/User'));
    }


    public function changestatusn()
    {
        date_default_timezone_set('Asia/Jakarta');
        $date = date('Y-m-d:H:i:s');
        $id = $this->request->getPost('idusern');
        $data = [
            'status' => 'Y',
            'updated_at' => $date
        ];
        $user = new MUser();
        $user->update_data($data, $id);
        session()->setFlashdata('success', 'Data User Di Non-Aktifkan !!');
        return redirect()->to(base_url('Admin/User'));
    }


    public function delete()
    {
        $id = $this->request->getPost('iduser');
        $usr = new MUser();
        $usr->hapus($id);
        session()->setFlashdata('success', 'Data User Berhasil Di Hapus !!');
        return redirect()->to(base_url('Admin/User'));
    }
}
