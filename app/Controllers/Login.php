<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\MUser;

class Login extends BaseController
{
    public function __construct()
    {
        helper('form');
    }
    public function index()
    {
        return view('Login/VLogin');
    }
    public function register()
    {
        return view('Login/Register');
    }
    public function ceklogin()
    {
        $m_user = new MUser();
        $validation = \Config\Services::validation();

        $username = $this->request->getPost('username');
        $password = $this->request->getVar('pass');
        $ceklogin = $m_user->ceklogin($username);
        $valid = $this->validate([
            'username' => [
                'label'  => 'Username',
                'rules'   => 'required',
                'errors' => [
                    'required' => '{field} Harus Diisi !'
                ],
            ],
            'pass' => [
                'label'  => 'Password',
                'rules'   => 'required',
                'errors' => [
                    'required' => '{field} Harus Diisi !'
                ],
            ]
        ]);

        if (!$valid) {
            $session_error = [
                'error_username' => $validation->getError('username'),
                'error_pass' => $validation->getError('pass')
            ];
            session()->setFlashdata($session_error);
            return redirect()->to(base_url('admin'));
        } else {
            if ($ceklogin == NULL) {
                $session_login = [
                    'error_login' => 'Username / Password Tidak Valid !',
                ];
                session()->setFlashdata($session_login);
                return redirect()->to(base_url('admin'));
            } else {
                $pass = $ceklogin['password'];
                $veryfi = password_verify($password, $pass);
                if ($veryfi) {
                    session()->set('iduser', $ceklogin['iduser']);
                    session()->set('nama', $ceklogin['fullname']);
                    session()->set('username', $ceklogin['username']);
                    session()->set('status', $ceklogin['status']);
                    session()->set('akses1', $ceklogin['level_user']);
                    session()->set('masuk', TRUE);
                    if (session()->get('akses1') == '4') {
                        return redirect()->to(base_url('/Pelanggan/Beranda'));
                    } else {
                        return redirect()->to(base_url('/Admin/Beranda'));
                    }
                } else {
                    $session_login = [
                        'error_login' => 'Password Tidak Valid !',
                    ];
                    session()->setFlashdata($session_login);
                    return redirect()->to(base_url('admin'));
                }
            }
        }
    }

    public function Logout()
    {
        $session = session();
        $session->destroy();
        return redirect()->to(base_url());
    }
}
