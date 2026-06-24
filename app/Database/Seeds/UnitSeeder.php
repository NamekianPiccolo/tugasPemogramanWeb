<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UnitSeeder extends Seeder
{
    public function run()
    {
        $unitData = [
            ['nama_unit' => 'HRD / Personalia', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
            ['nama_unit' => 'Finance / Keuangan', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
            ['nama_unit' => 'IT / Teknologi', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
            ['nama_unit' => 'Marketing / Pemasaran', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
            ['nama_unit' => 'Operations / Operasional', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
            ['nama_unit' => 'Legal / Hukum', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
        ];

        // Insert using Query Builder
        $this->db->table('unit')->insertBatch($unitData);
    }
}
