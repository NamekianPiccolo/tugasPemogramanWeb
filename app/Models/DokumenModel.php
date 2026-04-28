<?php

namespace App\Models;

use CodeIgniter\Model;

class DokumenModel extends Model
{
    protected $table            = 'dokumen';
    protected $primaryKey       = 'id';
    protected $returnType       = 'array';
    protected $allowedFields    = ['judul', 'deskripsi', 'tanggal', 'file_dokumen', 'kategori_id', 'unit_id', 'ukuran_file', 'ekstensi_file'];
    protected $useTimestamps    = true;
}
