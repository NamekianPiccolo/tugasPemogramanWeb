<?php

namespace App\Controllers;
use App\Controllers\BaseController;
class DashboardController extends BaseController
{
 
    public function index(): string
    {
        helper(['form']);
        return view('DashboardView');
    }
    public function create(){
        $user = new \App\Entitiasfses\User();
        // ngebungkus yang dikirim usernya 
        
        if($user->fill($this->request->getPost())){
            return $this->response->setJson([
                'status'=> 'success',
                'message' => "Data berhasil Ditambahkan"
            ]);
        }else {
            
            return $this->response->setJson([
                'status'=> 'error',
                'message' => "Data Gagal Ditambahkan"
            ]);
        }
       
    }
}



