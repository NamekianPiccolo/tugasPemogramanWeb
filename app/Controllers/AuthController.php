<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\UserModel;

class AuthController extends BaseController
{
    public function index()
    {
        if (session()->get('isLoggedIn')) {
            $redirectPath = (session()->get('role') === 'admin') ? '/admin/dashboard' : '/karyawan/dashboard';
            return redirect()->to($redirectPath);
        }
        return view("auth/login");
    }

    public function process()
    {
        $loginType = null;
        try {
            $users = new UserModel();
            $username = $this->request->getPost('username');
            $password = $this->request->getPost('password');
            $loginType = $this->request->getPost('login_type');
            
            $dataUser = $users->where('username', $username)->first();
    
            if ($dataUser) {
                if (password_verify($password, $dataUser['password'])) {
                    session()->set([
                        'id'           => $dataUser['id'],
                        'username'     => $dataUser['username'],
                        'nama_lengkap' => $dataUser['nama_lengkap'],
                        'email'        => $dataUser['email'],
                        'role'         => $dataUser['role'],
                        'isLoggedIn'   => true
                    ]);
                    $redirectPath = ($dataUser['role'] === 'admin') ? '/admin/dashboard' : '/karyawan/dashboard';
                    return redirect()->to($redirectPath);
                } else {
                    session()->setFlashdata('login_type', $loginType);
                    session()->setFlashdata('error', 'Password salah');
                    return redirect()->back();
                }
            } else {
                session()->setFlashdata('login_type', $loginType);
                session()->setFlashdata('error', 'Username tidak ditemukan');
                return redirect()->back();
            }
        } catch (\Exception $e) {
            session()->setFlashdata('login_type', $loginType);
            session()->setFlashdata('error', 'Terjadi kesalahan sistem: ' . $e->getMessage());
            return redirect()->back();
        }
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/');
    }
}
