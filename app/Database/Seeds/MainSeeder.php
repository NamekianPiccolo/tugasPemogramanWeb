<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class MainSeeder extends Seeder
{
    public function run()
    {
        // 1. Seed Users (Admin)
        $usersData = [
            [
                'username'   => 'admin',
                'nama_lengkap' => 'Administrator Utama',
                'email'      => 'admin@example.com',
                'password'   => password_hash('admin123', PASSWORD_DEFAULT),
                'role'       => 'admin',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'username'   => 'petugas',
                'nama_lengkap' => 'Petugas Arsip',
                'email'      => 'petugas@example.com',
                'password'   => password_hash('petugas123', PASSWORD_DEFAULT),
                'role'       => 'karyawan',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]
        ];
        $this->db->table('users')->insertBatch($usersData);

        // 2. Seed Kategori Dokumen
        $kategoriData = [
            ['nama_kategori' => 'Surat Keputusan (SK)', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
            ['nama_kategori' => 'Surat Masuk', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
            ['nama_kategori' => 'Surat Keluar', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
            ['nama_kategori' => 'Laporan Keuangan', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
        ];
        $this->db->table('kategori')->insertBatch($kategoriData);

        // 3. Seed Unit / Bagian
        $unitData = [
            ['nama_unit' => 'Rektorat', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
            ['nama_unit' => 'Keuangan', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
            ['nama_unit' => 'Akademik', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
            ['nama_unit' => 'Kemahasiswaan', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
        ];
        $this->db->table('unit')->insertBatch($unitData);

        // 4. Seed Dokumen (Contoh Dummy Data 1 Dokumen)
        $dokumenData = [
            [
                'judul'        => 'SK Pengangkatan Pegawai 2026',
                'deskripsi'    => 'Dokumen SK Pengangkatan pegawai baru tahun 2026',
                'tanggal'      => date('Y-m-d'),
                'file_dokumen' => 'sk_pegawai_2026.pdf',
                'kategori_id'  => 1, // Surat Keputusan (SK)
                'unit_id'      => 2, // Keuangan
                'created_at'   => date('Y-m-d H:i:s'),
                'updated_at'   => date('Y-m-d H:i:s'),
            ]
        ];
        $this->db->table('dokumen')->insertBatch($dokumenData);

        // 5. Seed Distribusi Dokumen
        $distribusiData = [
            [
                'dokumen_id'      => 1,
                'peminjam'        => 'Budi Santoso',
                'tanggal_pinjam'  => date('Y-m-d'),
                'tanggal_kembali' => null,
                'status'          => 'Dipinjam',
                'created_at'      => date('Y-m-d H:i:s'),
                'updated_at'      => date('Y-m-d H:i:s'),
            ]
        ];
        $this->db->table('distribusi')->insertBatch($distribusiData);

        // 6. Seed Riwayat Aktivitas
        $riwayatData = [
            [
                'dokumen_id'  => 1,
                'user_id'     => 1, // admin
                'aksi'        => 'Upload',
                'keterangan'  => 'Admin mengunggah dokumen SK Pengangkatan',
                'created_at'  => date('Y-m-d H:i:s'),
            ]
        ];
        $this->db->table('riwayat')->insertBatch($riwayatData);
    }
}
