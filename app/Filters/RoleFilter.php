<?php
 
namespace App\Filters;
 
use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
 
class RoleFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $role = session()->get('role');
        
        if (!$role) {
            return redirect()->to('/login')->with('error', 'Role tidak ditemukan');
        }
 
        // arguments are the allowed roles for this route
        if ($arguments && !in_array($role, $arguments)) {
            return redirect()->to('/login')->with('error', 'Anda tidak memiliki akses ke halaman ini');
        }
    }
 
    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do something here
    }
}
