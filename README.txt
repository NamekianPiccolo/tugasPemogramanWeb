================================================================
README - SISTEM INFORMASI ARSIP DOKUMEN DIGITAL
================================================================
Mata Kuliah  : Web Programming
Kelas        : 15.4A.31
Dosen        : rangga.rpo@bsi.ac.id
================================================================

NAMA PROJECT
------------
Sistem Informasi Arsip Dokumen Digital Berbasis Web
(Menggunakan CodeIgniter 4)

================================================================
REPOSITORY GITHUB
================================================================
  Link : https://github.com/NamekianPiccolo/tugasPemogramanWeb

================================================================
NAMA KELOMPOK DAN ANGGOTA
================================================================
Kelompok     : Kelompok 2

Anggota:
  1. Andre Saputra          - NIM: 15240242
  2. Fetresia VC Saragih    - NIM: 15240294
  3. Dheo Bagas Saputra     - NIM: 15240298
  4. Ilham Fauzi            - NIM: 15241096

================================================================
NAMA DATABASE
================================================================
Nama Database : apa

================================================================
AKUN LOGIN SISTEM
================================================================

>> AKUN ADMIN:
   Username : admin
   Password : admin123

>> AKUN ADMIN (alternatif):
   Username : NamekianP
   Password : [sesuai yang didaftarkan]

>> AKUN KARYAWAN:
   Username : petugas
   Password : petugas123

>> AKUN KARYAWAN (alternatif):
   Username : farel
   Password : farel123

================================================================
SPESIFIKASI TEKNIS (YANG DIGUNAKAN SAAT PENGEMBANGAN)
================================================================

  Framework      : CodeIgniter 4 versi 4.7.2
  PHP            : PHP 8.2.12 (ZTS Visual C++ 2019 x64)
  Composer       : Composer versi 2.4.1
  Database       : MySQL / MariaDB (port 3306)
  Web Server     : Apache via Laragon

  Ekstensi PHP yang wajib aktif:
    - intl
    - mbstring
    - json
    - openssl
    - curl
    - gd
    - mysqli / mysqlnd
    - pdo_mysql

  Dependensi Composer (composer.json):
    - php                    : ^8.2
    - codeigniter4/framework : ^4.7
    - fakerphp/faker         : ^1.9  (dev, untuk seeder)
    - phpunit/phpunit        : ^10.5 (dev, untuk testing)

================================================================
CARA MENJALANKAN PROJECT
================================================================

1. PERSYARATAN SISTEM:
   - PHP >= 8.2
   - MySQL / MariaDB
   - Composer >= 2.x
   - Web Server (Apache/Nginx) atau Laragon

2. LANGKAH INSTALASI:
   a. Ekstrak folder project ke dalam htdocs / www Laragon
   b. Import file database ke MySQL:
        File : database/apa.sql
        Cara : Buka phpMyAdmin > Import > pilih file apa.sql
   c. Salin file .env.example menjadi .env :
        copy .env.example .env
   d. Sesuaikan konfigurasi database di file .env :
        database.default.hostname = localhost
        database.default.database = apa
        database.default.username = root
        database.default.password =
        database.default.port     = 3306
   e. Install dependensi Composer :
        composer install
   f. Akses via browser :
        - Via Laragon   : http://tugasPemogramanWeb.test/
        - Via php spark : php spark serve
          lalu buka     : http://localhost:8080

3. FOLDER UPLOAD:
   - File dokumen tersimpan di: public/uploads/
   - Pastikan folder uploads/ sudah ada dan bisa ditulis (writable)
   - Di Windows, tidak perlu chmod. Di Linux: chmod 775 public/uploads

================================================================
FITUR SISTEM
================================================================

ADMIN:
  - Login & Logout
  - Dashboard statistik dokumen
  - Kelola Data Dokumen (tambah, edit, hapus, upload file)
  - Kelola Kategori Dokumen
  - Kelola Unit / Divisi
  - Kelola Data Pengguna (Karyawan)
  - Manajemen Persetujuan Izin Akses Dokumen
  - Manajemen Distribusi / Peminjaman Dokumen
  - Review & Persetujuan Revisi Dokumen
  - Riwayat Aktivitas (Audit Trail) + Cetak Laporan

KARYAWAN:
  - Login & Logout
  - Melihat & Mencari Daftar Dokumen
  - Mengajukan Izin Akses Dokumen
  - Mengecek Status Izin
  - Meminjam & Mengembalikan Dokumen
  - Mengajukan Revisi / Perubahan Dokumen
  - Melihat Riwayat Pengajuan Revisi

================================================================
TEKNOLOGI YANG DIGUNAKAN
================================================================
  - Backend    : CodeIgniter 4.7.2 (PHP 8.2.12)
  - Database   : MySQL / MariaDB
  - Frontend   : HTML5, CSS3, JavaScript
  - Styling    : Tailwind CSS
  - Build Tool : Node.js + npm (Tailwind)
  - Server     : Apache (Laragon) / PHP Built-in Server

================================================================
CATATAN TAMBAHAN
================================================================
  - Pastikan ekstensi PHP: intl, mbstring, json, mysqlnd aktif
  - Jika menggunakan XAMPP/Laragon, aktifkan mod_rewrite Apache
  - File .env wajib dikonfigurasi ulang sebelum menjalankan project
  - Folder public/uploads/ berisi file dokumen yang diupload
  - Jalankan "composer install" jika folder vendor/ tidak ada

================================================================
