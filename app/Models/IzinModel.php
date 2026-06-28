<?php

namespace App\Models;

use CodeIgniter\Model;

/**
 * Model IzinModel
 *
 * Mengelola data perizinan akses dokumen yang diajukan oleh karyawan di database.
 * Menyimpan tautan user_id, dokumen_id, status persetujuan, pesan permohonan, dan tanggal pengajuan.
 */
class IzinModel extends Model
{
    /**
     * Nama tabel di database.
     * 
     * @var string
     */
    protected $table            = 'izin';

    /**
     * Kunci primer (primary key) tabel.
     * 
     * @var string
     */
    protected $primaryKey       = 'id';

    /**
     * Mengatur apakah primary key bertipe Auto-Increment.
     * 
     * @var bool
     */
    protected $useAutoIncrement = true;

    /**
     * Format pengembalian data dari model (array).
     * 
     * @var string
     */
    protected $returnType       = 'array';

    /**
     * Mengaktifkan/menonaktifkan soft deletes.
     * 
     * @var bool
     */
    protected $useSoftDeletes   = false;

    /**
     * Mengaktifkan perlindungan field.
     * 
     * @var bool
     */
    protected $protectFields    = true;

    /**
     * Kolom-kolom tabel yang diizinkan untuk diisi secara massal.
     * 
     * @var array
     */
    protected $allowedFields    = ['user_id', 'dokumen_id', 'pesan', 'status_izin', 'tgl_pengajuan', 'pesan_admin'];

    /**
     * Mengatur pemuatan otomatis stempel waktu (timestamps).
     * 
     * @var bool
     */
    protected $useTimestamps = true;

    /**
     * Format penyimpanan tanggal stempel waktu.
     * 
     * @var string
     */
    protected $dateFormat    = 'datetime';

    /**
     * Nama kolom created_at di tabel.
     * 
     * @var string
     */
    protected $createdField  = 'created_at';

    /**
     * Nama kolom updated_at di tabel.
     * 
     * @var string
     */
    protected $updatedField  = 'updated_at';
}
