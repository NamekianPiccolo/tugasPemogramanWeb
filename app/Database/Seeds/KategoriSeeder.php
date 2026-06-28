<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class KategoriSeeder extends Seeder
{
    public function run()
    {
        // Disable FK checks to allow truncate
        $this->db->query('SET FOREIGN_KEY_CHECKS=0');
        $this->db->table('kategori')->truncate();
        $this->db->query('SET FOREIGN_KEY_CHECKS=1');

        $kategoriData = [
            [
                'nama_kategori' => 'Surat Keputusan (SK)',
                'created_at' => date('Y-m-d H:i:s', strtotime('-15 days')),
                'updated_at' => date('Y-m-d H:i:s', strtotime('-15 days'))
            ],
            [
                'nama_kategori' => 'SOP (Standard Operating Procedure)',
                'created_at' => date('Y-m-d H:i:s', strtotime('-12 days')),
                'updated_at' => date('Y-m-d H:i:s', strtotime('-12 days'))
            ],
            [
                'nama_kategori' => 'Surat Masuk',
                'created_at' => date('Y-m-d H:i:s', strtotime('-9 days')),
                'updated_at' => date('Y-m-d H:i:s', strtotime('-9 days'))
            ],
            [
                'nama_kategori' => 'Surat Keluar',
                'created_at' => date('Y-m-d H:i:s', strtotime('-6 days')),
                'updated_at' => date('Y-m-d H:i:s', strtotime('-6 days'))
            ],
            [
                'nama_kategori' => 'Laporan',
                'created_at' => date('Y-m-d H:i:s', strtotime('-4 days')),
                'updated_at' => date('Y-m-d H:i:s', strtotime('-4 days'))
            ],
            [
                'nama_kategori' => 'Proposal',
                'created_at' => date('Y-m-d H:i:s', strtotime('-2 days')),
                'updated_at' => date('Y-m-d H:i:s', strtotime('-2 days'))
            ],
            [
                'nama_kategori' => 'Formulir',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
        ];

        // Insert using Query Builder
        $this->db->table('kategori')->insertBatch($kategoriData);
    }
}
