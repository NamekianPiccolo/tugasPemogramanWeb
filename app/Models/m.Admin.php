<?php
namespace App\Models;

use CodeIgniter\Model;

/**
 * Model M_Admin
 *
 * Mengelola data administrator sistem (Legacy) di database.
 * Menyediakan method untuk seleksi, penambahan, pembaruan data admin, dan penomoran otomatis.
 */
class M_Admin extends Model
{
    /**
     * Nama tabel administrator.
     * 
     * @var string
     */
    protected $table = 'tbl_admin';

    /**
     * Mengambil data admin dari database, dengan penyaringan opsional ($where).
     * Hasil diurutkan berdasarkan nama_admin secara menanjak (ASC).
     *
     * @param array|bool $where Array berisi filter klausa WHERE (misal: ['id_admin' => 1]) atau false
     * @return \CodeIgniter\Database\ResultInterface Objek hasil query database
     */
    public function getDataAdmin($where = false)
    {
        if ($where === false) {
            // Mengambil semua data admin jika tidak ada filter
            $builder = $this->db->table($this->table);
            $builder->select('*');
            $builder->orderBy('nama_admin', 'ASC');
            return $query = $builder->get();
        } else {
            // Mengambil data admin berdasarkan kondisi filter
            $builder = $this->db->table($this->table);
            $builder->select('*');
            $builder->where($where);
            $builder->orderBy('nama_admin', 'ASC');
            return $query = $builder->get();
        }
    }

    /**
     * Menyimpan data administrator baru ke database.
     *
     * @param array $data Data administrator baru
     * @return bool|\CodeIgniter\Database\ResultInterface
     */
    public function saveDataAdmin($data)
    {
        $builder = $this->db->table($this->table);
        return $builder->insert($data);
    }

    /**
     * Memperbarui data administrator berdasarkan filter kondisi tertentu.
     *
     * @param array $data Data baru yang akan disimpan
     * @param array $where Kondisi penyaringan data (WHERE)
     * @return bool|\CodeIgniter\Database\ResultInterface
     */
    public function updateDataAdmin($data, $where)
    {
        $builder = $this->db->table($this->table);
        $builder->where($where);
        return $builder->update($data);
    }

    /**
     * Mendapatkan ID administrator terakhir untuk penomoran otomatis (Auto-Number).
     *
     * @return \CodeIgniter\Database\ResultInterface Objek hasil query data ID admin terakhir
     */
    public function autoNumber()
    {
        $builder = $this->db->table($this->table);
        $builder->select("id_admin");
        $builder->orderBy("id_admin", "DESC");
        $builder->limit(1);
        return $query = $builder->get();
    }
}
?>  