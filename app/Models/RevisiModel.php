<?php
 
namespace App\Models;
 
use CodeIgniter\Model;
 
class RevisiModel extends Model
{
    protected $table            = 'revisi';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'dokumen_id', 'user_id', 'judul', 'deskripsi', 'tanggal', 
        'kategori_id', 'unit_id', 'file_dokumen', 'status_revisi', 'pesan_admin'
    ];
 
    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
}
