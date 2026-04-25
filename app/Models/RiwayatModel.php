<?php

namespace App\Models;

use CodeIgniter\Model;

class RiwayatModel extends Model
{
    protected $table            = 'riwayat';
    protected $primaryKey       = 'id';
    protected $returnType       = 'array';
    protected $allowedFields    = ['dokumen_id', 'user_id', 'aksi', 'keterangan'];
    protected $useTimestamps    = true; 
    protected $createdField     = 'created_at';
    protected $updatedField     = ''; // Karena tabel riwayat hanya insert, tidak pernah di-update
}
