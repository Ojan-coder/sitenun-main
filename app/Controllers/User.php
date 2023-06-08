<?php

namespace App\Controllers;

use App\Models\MUser;

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
        if ((session()->get('masuk') == TRUE) && (session()->get('status') == 'Y')) {
            $data = [
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
        $pas = $this->request->getVar('pass');
            $pw = password_hash($pas, PASSWORD_BCRYPT);
            $data = [
                'username' => $this->request->getPost('username'),
                'namauser' => $this->request->getPost('nama'),
                'password' => $pw,
                'status' => 'T'
            ];
            $user->insert_data($data);
            session()->setFlashdata('success', 'Data User Berhasil Ditambahkan');
            return redirect()->to('User');
        // $valid = $this->validate([
        //     'username' => [
        //         'label'  => 'Username',
        //         'rules'   => 'required|is_unique[user.username]',
        //         'errors' => [
        //             'required' => '{field} Wajib Diisi',
        //             'is_unique' => '{field} Username Sudah Terdaftar'
        //         ],
        //     ],
        //     'nama' => [
        //         'label'  => 'Nama Lengkap',
        //         'rules'   => 'required',
        //         'errors' => [
        //             'required' => '{field} Wajib Diisi'
        //         ],
        //     ],
        //     'pass' => [
        //         'label'  => 'Password',
        //         'rules'   => 'required|min_length[8]',
        //         'errors' => [
        //             'required' => '{field} Wajib Diisi',
        //             'min_length' => 'Password Minimal Character 8'
        //         ],
        //     ]
        // ]);

        // if (!$valid) {
        //     session()->setFlashdata('errors', \Config\Services::validation()->getErrors());
        //     return redirect()->to('User');
        // } else {
            
        // }
    }
    public function edit()
    {
    }
    public function update()
    {
    }
    public function delete()
    {
    }
}
