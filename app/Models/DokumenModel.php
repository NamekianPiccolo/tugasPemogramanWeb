<?php

namespace App\Models;

use CodeIgniter\Model;

/**
 * Model DokumenModel
 *
 * Mengurusi manipulasi data meta dokumen digital di database.
 * Menyimpan informasi judul, deskripsi, tanggal berkas, nama file fisik, kategori, dan unit kerja terkait.
 */
class DokumenModel extends Model
{
    /**
     * Nama tabel di database.
     * 
     * @var string
     */
    protected $table            = 'dokumen';

    /**
     * Kunci primer (primary key) tabel.
     * 
     * @var string
     */
    protected $primaryKey       = 'id';

    /**
     * Format pengembalian data dari query model (array).
     * 
     * @var string
     */
    protected $returnType       = 'array';

    /**
     * Kolom-kolom tabel yang diizinkan untuk diisi/diperbarui secara massal.
     * 
     * @var array
     */
    protected $allowedFields    = ['judul', 'deskripsi', 'tanggal', 'file_dokumen', 'kategori_id', 'unit_id', 'ukuran_file', 'ekstensi_file'];

    /**
     * Mengatur apakah model otomatis mengisi kolom created_at dan updated_at.
     * 
     * @var bool
     */
    protected $useTimestamps    = true;

    /**
     * Mengambil semua dokumen dengan urutan alfabet (judul) ascending.
     *
     * @param int $limit
     * @param int $offset
     * @return array
     */
    public function findAll(int $limit = null, int $offset = 0)
    {
        $this->orderBy($this->table . '.judul', 'ASC');
        return parent::findAll($limit, $offset);
    }
}
