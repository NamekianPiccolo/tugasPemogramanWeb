<?php

namespace App\Models;

use CodeIgniter\Model;

/**
 * Model UnitModel
 *
 * Mengelola data unit kerja / departemen organisasi di database.
 */
class UnitModel extends Model
{
    /**
     * Nama tabel di database.
     * 
     * @var string
     */
    protected $table            = 'unit';

    /**
     * Kunci primer (primary key) tabel.
     * 
     * @var string
     */
    protected $primaryKey       = 'id';

    /**
     * Format pengembalian data hasil query (array).
     * 
     * @var string
     */
    protected $returnType       = 'array';

    /**
     * Kolom-kolom yang diizinkan diisi secara massal.
     * 
     * @var array
     */
    protected $allowedFields    = ['nama_unit'];

    /**
     * Mengatur pengisian kolom created_at dan updated_at secara otomatis.
     * 
     * @var bool
     */
    protected $useTimestamps    = true;
}
