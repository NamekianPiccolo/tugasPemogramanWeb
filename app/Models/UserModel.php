<?php

namespace App\Models;

use CodeIgniter\Model;

/**
 * Model UserModel
 *
 * Mengelola data pengguna sistem (Admin & Karyawan) di database.
 * Menyimpan data kredensial akun seperti username, password terenkripsi, email, nama lengkap, dan peran (role).
 */
class UserModel extends Model
{
    /**
     * Nama tabel di database.
     * 
     * @var string
     */
    protected $table            = 'users';

    /**
     * Kunci primer (primary key) tabel.
     * 
     * @var string
     */
    protected $primaryKey       = 'id';

    /**
     * Format pengembalian data dari model (array).
     * 
     * @var string
     */
    protected $returnType       = 'array';

    /**
     * Kolom-kolom tabel yang diizinkan untuk diisi/diperbarui secara massal.
     * 
     * @var array
     */
    protected $allowedFields    = ['username', 'nama_lengkap', 'email', 'password', 'role'];

    /**
     * Mengatur stempel waktu otomatis created_at & updated_at.
     * 
     * @var bool
     */
    protected $useTimestamps    = true;
}
