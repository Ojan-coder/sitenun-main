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
            return redirect()->to(base_url());
        } else {
            if ($ceklogin == NULL) {
                $session_login = [
                    'error_login' => 'Username / Password Tidak Valid !',
                ];
                session()->setFlashdata($session_login);
                return redirect()->to(base_url());
            } else {
                $pass = $ceklogin['password'];
                $veryfi = password_verify($password, $pass);
                if ($veryfi) {
                    session()->set('iduser', $ceklogin['iduser']);
                    session()->set('nama', $ceklogin['namauser']);
                    session()->set('namaadmin', $ceklogin['username']);
                    session()->set('status', $ceklogin['status']);
                    session()->set('akses1', $ceklogin['akses']);
                    session()->set('masuk', TRUE);
                    return redirect()->to(base_url('/Beranda'));
                } else {
                    $session_login = [
                        'error_login' => 'Password Tidak Valid !',
                    ];
                    session()->setFlashdata($session_login);
                    return redirect()->to(base_url());
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
