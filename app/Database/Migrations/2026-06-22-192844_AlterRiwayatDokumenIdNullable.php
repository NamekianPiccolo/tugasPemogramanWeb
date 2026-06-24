<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AlterRiwayatDokumenIdNullable extends Migration
{
    public function up()
    {
        // 1. Hapus constraint lama
        $this->db->query('ALTER TABLE riwayat DROP FOREIGN KEY riwayat_dokumen_id_foreign');
        
        // 2. Ubah kolom menjadi nullable
        $this->db->query('ALTER TABLE riwayat MODIFY dokumen_id INT(11) UNSIGNED NULL');
        
        // 3. Tambahkan constraint baru (ON DELETE SET NULL)
        $this->db->query('ALTER TABLE riwayat ADD CONSTRAINT riwayat_dokumen_id_foreign FOREIGN KEY (dokumen_id) REFERENCES dokumen(id) ON DELETE SET NULL ON UPDATE CASCADE');
    }

    public function down()
    {
        // Kembalikan ke CASCADE (jika diperlukan)
        $this->db->query('ALTER TABLE riwayat DROP FOREIGN KEY riwayat_dokumen_id_foreign');
        $this->db->query('ALTER TABLE riwayat MODIFY dokumen_id INT(11) UNSIGNED NOT NULL');
        $this->db->query('ALTER TABLE riwayat ADD CONSTRAINT riwayat_dokumen_id_foreign FOREIGN KEY (dokumen_id) REFERENCES dokumen(id) ON DELETE CASCADE ON UPDATE CASCADE');
    }
}
