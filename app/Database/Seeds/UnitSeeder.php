<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UnitSeeder extends Seeder
{
    public function run()
    {
        // Disable FK checks to allow truncate
        $this->db->query('SET FOREIGN_KEY_CHECKS=0');
        $this->db->table('unit')->truncate();
        $this->db->query('SET FOREIGN_KEY_CHECKS=1');

        $unitData = [
            [
                'nama_unit' => 'HRD / Personalia',
                'created_at' => date('Y-m-d H:i:s', strtotime('-10 days')),
                'updated_at' => date('Y-m-d H:i:s', strtotime('-10 days'))
            ],
            [
                'nama_unit' => 'Finance / Keuangan',
                'created_at' => date('Y-m-d H:i:s', strtotime('-8 days')),
                'updated_at' => date('Y-m-d H:i:s', strtotime('-8 days'))
            ],
            [
                'nama_unit' => 'IT / Teknologi',
                'created_at' => date('Y-m-d H:i:s', strtotime('-6 days')),
                'updated_at' => date('Y-m-d H:i:s', strtotime('-6 days'))
            ],
            [
                'nama_unit' => 'Marketing / Pemasaran',
                'created_at' => date('Y-m-d H:i:s', strtotime('-4 days')),
                'updated_at' => date('Y-m-d H:i:s', strtotime('-4 days'))
            ],
            [
                'nama_unit' => 'Operations / Operasional',
                'created_at' => date('Y-m-d H:i:s', strtotime('-2 days')),
                'updated_at' => date('Y-m-d H:i:s', strtotime('-2 days'))
            ],
            [
                'nama_unit' => 'Legal / Hukum',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
        ];

        // Insert using Query Builder
        $this->db->table('unit')->insertBatch($unitData);
    }
}
