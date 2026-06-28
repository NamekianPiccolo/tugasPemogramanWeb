<?php

namespace App\Models;

use CodeIgniter\Model;

/**
 * Model KategoriModel
 *
 * Mengelola data kategori pengelompokan dokumen di database.
 */
class KategoriModel extends Model
{
    /**
     * Nama tabel di database.
     * 
     * @var string
     */
    protected $table            = 'kategori';

    /**
     * Kunci primer (primary key) tabel.
     * 
     * @var string
     */
    protected $primaryKey       = 'id';

    /**
     * Format data kembalian (array).
     * 
     * @var string
     */
    protected $returnType       = 'array';

    /**
     * Kolom-kolom yang diizinkan untuk diisi secara massal.
     * 
     * @var array
     */
    protected $allowedFields    = ['nama_kategori'];

    /**
     * Mengatur pemuatan otomatis stempel waktu created_at & updated_at.
     * 
     * @var bool
     */
    protected $useTimestamps    = true;
}
