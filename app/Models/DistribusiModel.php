<?php

namespace App\Models;

use CodeIgniter\Model;

/**
 * Model DistribusiModel
 *
 * Mengurusi manipulasi data transaksi distribusi (peminjaman) dokumen di database.
 * Menyimpan informasi kaitan dokumen_id, user_id, tanggal pinjam, tenggat pengembalian, dan status saat ini.
 */
class DistribusiModel extends Model
{
    /**
     * Nama tabel di database.
     * 
     * @var string
     */
    protected $table            = 'distribusi';

    /**
     * Kunci primer (primary key) tabel.
     * 
     * @var string
     */
    protected $primaryKey       = 'id';

    /**
     * Format pengembalian data dari model (array/objek/entitas).
     * 
     * @var string
     */
    protected $returnType       = 'array';

    /**
     * Kolom-kolom yang diizinkan untuk diisi/diperbarui secara massal (mass assignment).
     * 
     * @var array
     */
    protected $allowedFields    = ['dokumen_id', 'user_id', 'tanggal_pinjam', 'tanggal_kembali', 'status'];

    /**
     * Mengatur apakah model otomatis mengisi kolom created_at dan updated_at.
     * 
     * @var bool
     */
    protected $useTimestamps    = true;
}
