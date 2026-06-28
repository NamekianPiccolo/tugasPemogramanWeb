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

        // Scan folder public/uploads untuk mencari file dokumen
        $uploadDir = FCPATH . 'uploads';
        $scannedFiles = [];
        $allowedExtensions = ['pdf', 'doc', 'docx', 'xls', 'xlsx', 'csv', 'ppt', 'pptx', 'txt'];

        if (is_dir($uploadDir)) {
            $files = scandir($uploadDir);
            foreach ($files as $file) {
                if ($file !== '.' && $file !== '..' && is_file($uploadDir . DIRECTORY_SEPARATOR . $file)) {
                    $ext = strtolower(pathinfo($file, PATHINFO_EXTENSION));
                    if (in_array($ext, $allowedExtensions)) {
                        $scannedFiles[] = $file;
                    }
                }
            }
        }

        if (empty($scannedFiles)) {
            echo "Tidak ditemukan file dokumen di folder uploads. Menghasilkan data dummy default.\n";
            $scannedFiles = [
                'sk_pegawai_2026.pdf'
            ];
        }

        $professionalTitles = [
            'Laporan Pencapaian Target Q1 2026',
            'Surat Keputusan Pengangkatan Karyawan Tetap',
            'SOP Penggunaan Inventaris Kantor',
            'Proposal Kegiatan Ulang Tahun Perusahaan',
            'Laporan Keuangan Bulanan Mei',
            'Surat Edaran Libur Nasional',
            'Formulir Pengajuan Cuti Tahunan',
            'Dokumentasi Sistem Keamanan Jaringan',
            'Laporan Audit Internal Tahunan',
            'Proposal Anggaran Kuartal ke-3',
            'Analisis Kinerja Operasional Perusahaan',
            'Rencana Aksi Strategis IT 2026',
            'Kebijakan Keamanan Data Pengguna',
            'Panduan Kerja Work from Home',
            'Formulir Klaim Karyawan',
            'Laporan Penjualan Kuartalan',
            'Memorandum Kesepahaman Kerja Sama',
            'Surat Panggilan Wawancara Kerja',
            'SOP Mitigasi Bencana Kantor',
            'Laporan Tahunan CSR Perusahaan'
        ];

        $descList = [
            'Dokumen ini berisi detail mengenai pencapaian dan rekapitulasi data selama periode yang ditentukan. Harap dibaca dengan teliti.',
            'Merupakan dokumen resmi yang disahkan oleh pimpinan perusahaan mengenai kebijakan dan regulasi terbaru.',
            'Panduan lengkap mengenai tata cara dan prosedur standar operasi yang harus dipatuhi oleh seluruh karyawan divisi terkait.',
            'Rencana anggaran dan kegiatan yang akan dilaksanakan dalam waktu dekat. Membutuhkan persetujuan dari dewan direksi.',
            'Arsip penting yang merangkum segala aktivitas operasional maupun finansial bulan lalu untuk evaluasi kinerja.'
        ];

        $dokumenData = [];
        $index = 0;

        foreach ($scannedFiles as $file) {
            $filePath = $uploadDir . DIRECTORY_SEPARATOR . $file;
            $ext = strtolower(pathinfo($file, PATHINFO_EXTENSION));
            
            // Dapatkan ukuran file dan waktu modifikasi jika ada
            $fileSize = file_exists($filePath) ? filesize($filePath) : null;
            $fileTime = file_exists($filePath) ? filemtime($filePath) : time();
            $tanggal = date('Y-m-d', $fileTime);

            // Menentukan judul dokumen
            // Jika nama file diawali dengan pola timestamp/angka acak (misal 1777299014_88913c5d120f294fefc8.pdf)
            if (preg_match('/^\d+_[a-f0-9]/i', $file)) {
                $judul = $professionalTitles[$index % count($professionalTitles)];
            } else {
                $cleanName = pathinfo($file, PATHINFO_FILENAME);
                $cleanName = str_replace(['_', '-'], ' ', $cleanName);
                $judul = ucwords($cleanName);
            }

            // Pemetaan kategori secara pintar berdasarkan judul/nama file / ekstensi
            $kategoriId = null;
            $lowerJudul = strtolower($judul);
            $lowerFile = strtolower($file);

            if (strpos($lowerJudul, 'keputusan') !== false || strpos($lowerJudul, 'sk') !== false || strpos($lowerFile, 'sk') !== false) {
                foreach ($kategori as $kat) {
                    if (stripos($kat['nama_kategori'], 'SK') !== false || stripos($kat['nama_kategori'], 'Keputusan') !== false) {
                        $kategoriId = $kat['id'];
                        break;
                    }
                }
            } elseif (strpos($lowerJudul, 'sop') !== false || strpos($lowerFile, 'sop') !== false) {
                foreach ($kategori as $kat) {
                    if (stripos($kat['nama_kategori'], 'SOP') !== false || stripos($kat['nama_kategori'], 'Procedure') !== false) {
                        $kategoriId = $kat['id'];
                        break;
                    }
                }
            } elseif (strpos($lowerJudul, 'laporan') !== false || strpos($lowerFile, 'laporan') !== false || in_array($ext, ['csv', 'xls', 'xlsx'])) {
                foreach ($kategori as $kat) {
                    if (stripos($kat['nama_kategori'], 'Laporan') !== false) {
                        $kategoriId = $kat['id'];
                        break;
                    }
                }
            } elseif (strpos($lowerJudul, 'proposal') !== false || strpos($lowerFile, 'proposal') !== false) {
                foreach ($kategori as $kat) {
                    if (stripos($kat['nama_kategori'], 'Proposal') !== false) {
                        $kategoriId = $kat['id'];
                        break;
                    }
                }
            } elseif (strpos($lowerJudul, 'formulir') !== false || strpos($lowerFile, 'formulir') !== false) {
                foreach ($kategori as $kat) {
                    if (stripos($kat['nama_kategori'], 'Formulir') !== false) {
                        $kategoriId = $kat['id'];
                        break;
                    }
                }
            }

            // Jika tidak cocok, pilih kategori secara acak
            if ($kategoriId === null) {
                $kategoriId = $kategori[array_rand($kategori)]['id'];
            }

            // Pilih unit secara acak
            $un = $unit[array_rand($unit)];

            $dokumenData[] = [
                'judul'         => $judul,
                'deskripsi'     => $descList[array_rand($descList)],
                'tanggal'       => $tanggal,
                'file_dokumen'  => $file,
                'kategori_id'   => $kategoriId,
                'unit_id'       => $un['id'],
                'ukuran_file'   => $fileSize,
                'ekstensi_file' => $ext,
                'created_at'    => date('Y-m-d H:i:s', $fileTime),
                'updated_at'    => date('Y-m-d H:i:s', $fileTime),
            ];

            $index++;
        }

        $this->db->table('dokumen')->insertBatch($dokumenData);
        echo "Berhasil melakukan seeding untuk " . count($dokumenData) . " dokumen dari folder uploads.\n";
    }
}

