<?php
 
namespace App\Models;
 
use CodeIgniter\Model;
 
/**
 * Model RevisiModel
 *
 * Mengelola data draf usulan perubahan (revisi) dokumen yang diajukan karyawan di database.
 * Menyimpan informasi meta draf baru (judul, deskripsi, tanggal, kategori, unit, file) beserta status review dari admin.
 */
class RevisiModel extends Model
{
    /**
     * Nama tabel di database.
     * 
     * @var string
     */
    protected $table            = 'revisi';

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
    protected $allowedFields    = [
        'dokumen_id', 'user_id', 'judul', 'deskripsi', 'tanggal', 
        'kategori_id', 'unit_id', 'file_dokumen', 'status_revisi', 'pesan_admin', 'pesan_revisi'
    ];
 
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
