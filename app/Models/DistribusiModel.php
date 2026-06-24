<?php

namespace App\Models;

use CodeIgniter\Model;

class DistribusiModel extends Model
{
    protected $table            = 'distribusi';
    protected $primaryKey       = 'id';
    protected $returnType       = 'array';
    protected $allowedFields    = ['dokumen_id', 'user_id', 'tanggal_pinjam', 'tanggal_kembali', 'status'];
    protected $useTimestamps    = true;
}
