<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class HomeController extends BaseController
{
    public function index()
    {
        return view("home");
    }
    public function belajar_segment($nama, $nim, $kelas)
    {
       $data['nama'] = $nama;
        $data['nim'] = $nim;
        $data['kelas'] = $kelas;
        return view('segment_view', $data);
    }
}

