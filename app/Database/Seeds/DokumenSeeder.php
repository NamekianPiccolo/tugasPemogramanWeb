<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class DokumenSeeder extends Seeder
{
    public function run()
    {
        $kategori = $this->db->table('kategori')->get()->getResultArray();
        $unit = $this->db->table('unit')->get()->getResultArray();

        if (empty($kategori) || empty($unit)) {
            echo "Pastikan Anda sudah menjalankan KategoriSeeder dan UnitSeeder terlebih dahulu.\n";
            return;
        }

        // Disable FK checks to allow truncate
        $this->db->query('SET FOREIGN_KEY_CHECKS=0');

        // Hapus data yang terkait dengan dokumen agar bersih (menghindari error foreign key jika ada)
        $this->db->table('riwayat')->truncate();
        $this->db->table('izin')->truncate();
        $this->db->table('distribusi')->truncate();
        $this->db->table('revisi')->truncate();
        $this->db->table('dokumen')->truncate();

        // Enable FK checks again
        $this->db->query('SET FOREIGN_KEY_CHECKS=1');

        $faker = \Faker\Factory::create('id_ID');
        $dokumenData = [];

        // Daftar judul dan deskripsi yang masuk akal
        $judulList = [
            'Laporan Pencapaian Target Q1 2026',
            'Surat Keputusan Pengangkatan Karyawan Tetap',
            'SOP Penggunaan Inventaris Kantor',
            'Proposal Kegiatan Ulang Tahun Perusahaan',
            'Laporan Keuangan Bulanan Mei',
            'Surat Edaran Libur Nasional',
            'Formulir Pengajuan Cuti Tahunan',
            'Dokumentasi Sistem Keamanan Jaringan',
            'Laporan Audit Internal Tahunan',
            'Proposal Anggaran Kuartal ke-3'
        ];

        $descList = [
            'Dokumen ini berisi detail mengenai pencapaian dan rekapitulasi data selama periode yang ditentukan. Harap dibaca dengan teliti.',
            'Merupakan dokumen resmi yang disahkan oleh pimpinan perusahaan mengenai kebijakan dan regulasi terbaru.',
            'Panduan lengkap mengenai tata cara dan prosedur standar operasi yang harus dipatuhi oleh seluruh karyawan divisi terkait.',
            'Rencana anggaran dan kegiatan yang akan dilaksanakan dalam waktu dekat. Membutuhkan persetujuan dari dewan direksi.',
            'Arsip penting yang merangkum segala aktivitas operasional maupun finansial bulan lalu untuk evaluasi kinerja.'
        ];

        for ($i = 0; $i < 10; $i++) {
            $kat = $kategori[array_rand($kategori)];
            $un = $unit[array_rand($unit)];
            
            $dokumenData[] = [
                'judul'        => $judulList[$i % count($judulList)],
                'deskripsi'    => $descList[array_rand($descList)],
                'tanggal'      => $faker->dateTimeBetween('-1 year', 'now')->format('Y-m-d'),
                'file_dokumen' => 'dummy_dokumen_' . ($i + 1) . '.pdf',
                'kategori_id'  => $kat['id'],
                'unit_id'      => $un['id'],
                'created_at'   => date('Y-m-d H:i:s'),
                'updated_at'   => date('Y-m-d H:i:s'),
            ];
        }

        $this->db->table('dokumen')->insertBatch($dokumenData);
    }
}
