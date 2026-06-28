<?php

namespace App\Models;

use CodeIgniter\Model;

/**
 * Model RiwayatModel
 *
 * Mengurusi pencatatan data log audit trail (aktivitas riwayat sistem) di database.
 * Menyimpan informasi dokumen_id, user_id (pelaku), aksi yang dilakukan, dan keterangan detail.
 */
class RiwayatModel extends Model
{
    /**
     * Nama tabel di database.
     * 
     * @var string
     */
    protected $table            = 'riwayat';

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
     * Kolom-kolom tabel yang diizinkan untuk diisi secara massal.
     * 
     * @var array
     */
    protected $allowedFields    = ['dokumen_id', 'user_id', 'aksi', 'keterangan'];

    /**
     * Mengatur pemuatan stempel waktu otomatis.
     * 
     * @var bool
     */
    protected $useTimestamps    = true; 

    /**
     * Kolom pencatatan waktu pembutan data log.
     * 
     * @var string
     */
    protected $createdField     = 'created_at';

    /**
     * Dikosongkan karena log bersifat read-only / write-once (tidak pernah diperbarui setelah diinsert).
     * 
     * @var string
     */
    protected $updatedField     = '';
}
