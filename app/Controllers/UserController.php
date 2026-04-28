<?php
 
namespace App\Controllers;
 
use App\Controllers\BaseController;
use App\Models\UserModel;
 
class UserController extends BaseController
{
    protected $userModel;
 
    public function __construct()
    {
        $this->userModel = new UserModel();
    }
 
    public function index()
    {
        $data = [
            'title' => 'Manajemen User',
            'users' => $this->userModel->findAll()
        ];
        return view('Backend/User/index', $data);
    }
 
    public function create()
    {
        $data = [
            'title' => 'Tambah User'
        ];
        return view('Backend/User/create', $data);
    }
 
    public function store()
    {
        $rules = [
            'username'     => 'required|min_length[3]|max_length[100]|is_unique[users.username]',
            'nama_lengkap' => 'required',
            'email'        => 'required|valid_email|is_unique[users.email]',
            'password'     => 'required|min_length[6]',
            'role'         => 'required'
        ];
 
        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
 
        $this->userModel->save([
            'username'     => $this->request->getPost('username'),
            'nama_lengkap' => $this->request->getPost('nama_lengkap'),
            'email'        => $this->request->getPost('email'),
            'password'     => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'role'         => $this->request->getPost('role'),
        ]);
 
        return redirect()->to('/admin/user')->with('success', 'User berhasil ditambahkan');
    }
 
    public function edit($id)
    {
        $user = $this->userModel->find($id);
        if (!$user) {
            return redirect()->to('/admin/user')->with('error', 'User tidak ditemukan');
        }
 
        $data = [
            'title' => 'Edit User',
            'user'  => $user
        ];
        return view('Backend/User/edit', $data);
    }
 
    public function update($id)
    {
        $user = $this->userModel->find($id);
        
        $rules = [
            'username'     => "required|min_length[3]|max_length[100]|is_unique[users.username,id,{$id}]",
            'nama_lengkap' => 'required',
            'email'        => "required|valid_email|is_unique[users.email,id,{$id}]",
            'role'         => 'required'
        ];
 
        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
 
        $updateData = [
            'id'           => $id,
            'username'     => $this->request->getPost('username'),
            'nama_lengkap' => $this->request->getPost('nama_lengkap'),
            'email'        => $this->request->getPost('email'),
            'role'         => $this->request->getPost('role'),
        ];
 
        if ($this->request->getPost('password')) {
            $updateData['password'] = password_hash($this->request->getPost('password'), PASSWORD_DEFAULT);
        }
 
        $this->userModel->save($updateData);
 
        return redirect()->to('/admin/user')->with('success', 'User berhasil diperbarui');
    }
 
    public function delete($id)
    {
        $this->userModel->delete($id);
        return redirect()->to('/admin/user')->with('success', 'User berhasil dihapus');
    }
}
