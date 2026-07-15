# 📁 Sistem Informasi Arsip Dokumen Digital

<div align="center">

![CodeIgniter](https://img.shields.io/badge/CodeIgniter-4.7.2-EF4223?style=for-the-badge&logo=codeigniter&logoColor=white)
![PHP](https://img.shields.io/badge/PHP-8.2.12-777BB4?style=for-the-badge&logo=php&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-8.0-4479A1?style=for-the-badge&logo=mysql&logoColor=white)
![TailwindCSS](https://img.shields.io/badge/Tailwind_CSS-3.x-06B6D4?style=for-the-badge&logo=tailwind-css&logoColor=white)

**Sistem pengelolaan arsip dokumen digital berbasis web menggunakan CodeIgniter 4**

[🔗 Repository](https://github.com/NamekianPiccolo/tugasPemogramanWeb) · [🐛 Laporkan Bug](https://github.com/NamekianPiccolo/tugasPemogramanWeb/issues) · [📧 Kontak](mailto:rangga.rpo@bsi.ac.id)

</div>

---

## 📋 Daftar Isi

- [Tentang Proyek](#-tentang-proyek)
- [Fitur Sistem](#-fitur-sistem)
- [Teknologi](#-teknologi)
- [Persyaratan Sistem](#-persyaratan-sistem)
- [Instalasi dengan Laragon](#-instalasi-dengan-laragon-rekomendasi)
- [Instalasi dengan XAMPP](#-instalasi-dengan-xampp)
- [Instalasi dengan Docker](#-instalasi-dengan-docker)
- [Konfigurasi Database](#-konfigurasi-database)
- [Akun Login](#-akun-login)
- [Struktur Database](#-struktur-database)
- [Tim Pengembang](#-tim-pengembang)

---

## 🗂️ Tentang Proyek

Sistem Informasi Arsip Dokumen Digital adalah aplikasi web yang dibangun untuk memudahkan pengelolaan, pendistribusian, dan pengarsipan dokumen dalam suatu organisasi. Sistem ini memiliki dua peran pengguna: **Admin** dan **Karyawan**, masing-masing dengan hak akses yang berbeda.

Sistem ini dikembangkan sebagai **Final Project** mata kuliah **Web Programming** — Kelas 15.4A.31, Universitas Bina Sarana Informatika (BSI).

---

## ✨ Fitur Sistem

### 🛡️ Admin
| Fitur | Deskripsi |
|---|---|
| **Dashboard** | Statistik jumlah dokumen, peminjaman aktif, dan permohonan pending |
| **Kelola Dokumen** | Tambah, edit, hapus dokumen + upload file (PDF, DOCX, dll) |
| **Kelola Kategori** | Manajemen kategori pengelompokan dokumen |
| **Kelola Unit** | Manajemen unit/divisi pemilik dokumen |
| **Kelola Pengguna** | Manajemen akun karyawan |
| **Persetujuan Izin** | Setujui/tolak permohonan akses dokumen dari karyawan |
| **Distribusi Dokumen** | Catat dan kelola transaksi peminjaman dokumen |
| **Review Revisi** | Tinjau dan setujui/tolak usulan perubahan dokumen |
| **Riwayat Aktivitas** | Audit trail semua aktivitas sistem + cetak laporan |

### 👤 Karyawan
| Fitur | Deskripsi |
|---|---|
| **Lihat Dokumen** | Jelajahi dan cari dokumen yang tersedia |
| **Ajukan Izin Akses** | Kirim permohonan izin untuk meminjam dokumen |
| **Cek Status Izin** | Pantau status permohonan izin yang diajukan |
| **Kembalikan Dokumen** | Tandai dokumen sebagai sudah dikembalikan |
| **Ajukan Revisi** | Upload draf perubahan dokumen untuk ditinjau admin |
| **Riwayat Revisi** | Lihat histori pengajuan revisi yang pernah dilakukan |

---

## 🛠️ Teknologi

| Komponen | Teknologi | Versi |
|---|---|---|
| Backend Framework | CodeIgniter 4 | 4.7.2 |
| Bahasa Pemrograman | PHP | 8.2.12 |
| Database | MySQL / MariaDB | 8.0+ |
| CSS Framework | Tailwind CSS | 3.x |
| Package Manager (PHP) | Composer | 2.4.1 |
| Package Manager (JS) | npm | - |
| Web Server | Apache (Laragon) | - |

---

## ⚙️ Persyaratan Sistem

Pastikan sistem Anda memenuhi persyaratan berikut sebelum instalasi:

- **PHP** >= 8.2 dengan ekstensi:
  - `intl`, `mbstring`, `json`, `openssl`
  - `curl`, `gd`, `mysqli`, `pdo_mysql`
- **MySQL** / MariaDB >= 5.7
- **Composer** >= 2.x
- **Web Server**: Apache / Nginx / Laragon / XAMPP

---

## 🟢 Instalasi dengan Laragon (Rekomendasi)

Laragon adalah cara termudah untuk menjalankan proyek ini di Windows.

### Langkah 1 — Clone Repository

Buka terminal di dalam folder `www` Laragon, lalu jalankan:

```bash
git clone https://github.com/NamekianPiccolo/tugasPemogramanWeb.git
cd tugasPemogramanWeb
```

Atau download ZIP dari GitHub dan ekstrak ke `C:\laragon\www\tugasPemogramanWeb`.

---

### Langkah 2 — Install Dependensi PHP

```bash
composer install
```

> Jika Composer belum terinstall, unduh di [getcomposer.org](https://getcomposer.org/download/)

---

### Langkah 3 — Konfigurasi File `.env`

Salin file contoh environment:

```bash
copy .env.example .env
```

Buka file `.env` dan sesuaikan konfigurasi database:

```ini
CI_ENVIRONMENT = development
app_baseURL    = 'http://localhost:8080/'

database.default.hostname = localhost
database.default.database = apa
database.default.username = root
database.default.password =
database.default.DBDriver = MySQLi
database.default.port     = 3306
```

> **Catatan:** Jika menggunakan Laragon dengan virtual host, ubah `app_baseURL` menjadi `http://tugaspemorananweb.test/`

---

### Langkah 4 — Import Database

1. Buka **phpMyAdmin** di browser: `http://localhost/phpmyadmin`
2. Klik **"New"** → buat database baru bernama **`apa`**
3. Pilih database `apa` → klik tab **"Import"**
4. Klik **"Choose File"** → pilih file `database/apa.sql`
5. Klik **"Go"** / **"Import"**

Atau via terminal MySQL:

```bash
mysql -u root -p apa < database/apa.sql
```

---

### Langkah 5 — Jalankan Aplikasi

**Cara 1 — Via Laragon (Rekomendasi):**

Pastikan Apache dan MySQL di Laragon sudah **Start**, lalu buka browser:

```
http://tugasPemogramanWeb.test/
```

**Cara 2 — Via PHP Built-in Server:**

```bash
php spark serve
```

Buka browser dan akses:

```
http://localhost:8080
```

---

## 🔵 Instalasi dengan XAMPP

### Langkah 1 — Persiapan Folder

Salin/clone folder project ke dalam direktori htdocs XAMPP:

```
C:\xampp\htdocs\tugasPemogramanWeb\
```

### Langkah 2 — Install Dependensi

Buka Command Prompt di folder project:

```bash
composer install
```

### Langkah 3 — Konfigurasi `.env`

```bash
copy .env.example .env
```

Edit `.env`:

```ini
CI_ENVIRONMENT = development
app_baseURL    = 'http://localhost/tugasPemogramanWeb/public/'

database.default.hostname = localhost
database.default.database = apa
database.default.username = root
database.default.password =
database.default.DBDriver = MySQLi
database.default.port     = 3306
```

### Langkah 4 — Import Database

1. Jalankan **Apache** dan **MySQL** di XAMPP Control Panel
2. Buka `http://localhost/phpmyadmin`
3. Buat database baru → nama: `apa`
4. Import file `database/apa.sql`

### Langkah 5 — Akses Aplikasi

```
http://localhost/tugasPemogramanWeb/public/
```

---

## 🐳 Instalasi dengan Docker

Jika ingin menjalankan menggunakan Docker (tanpa instalasi PHP lokal):

### Prasyarat

- [Docker Desktop](https://www.docker.com/products/docker-desktop)
- [Docker Compose](https://docs.docker.com/compose/install/)

### Langkah 1 — Clone & Setup

```bash
git clone https://github.com/NamekianPiccolo/tugasPemogramanWeb.git
cd tugasPemogramanWeb
copy .env.example .env
```

Edit `.env` untuk konfigurasi Docker:

```ini
CI_ENVIRONMENT = development
app_baseURL = 'http://localhost:8081/'

database.default.hostname = db
database.default.database = ci4_database
database.default.username = ci4_user
database.default.password = ci4_password
database.default.DBDriver = MySQLi
database.default.port     = 3306
```

### Langkah 2 — Build & Jalankan

```bash
docker-compose up -d --build
```

> Docker akan otomatis: install Composer, compile Tailwind CSS, jalankan migrasi, dan seed database.

### Langkah 3 — Akses Aplikasi

```
http://localhost:8081
```

### Perintah Docker Berguna

```bash
# Lihat status container
docker ps

# Jalankan migrasi manual
docker exec -it tugas_web_app php spark migrate

# Seed database manual
docker exec -it tugas_web_app php spark db:seed MainSeeder

# Masuk ke shell container
docker exec -it tugas_web_app bash

# Hentikan semua container
docker-compose down

# Hentikan + hapus data database
docker-compose down -v
```

---

## 🗄️ Konfigurasi Database

### Detail Koneksi Default

| Parameter | Nilai |
|---|---|
| Host | `localhost` |
| Database | `apa` |
| Username | `root` |
| Password | *(kosong)* |
| Port | `3306` |
| Driver | `MySQLi` |

### Struktur Tabel

| Tabel | Deskripsi |
|---|---|
| `users` | Data pengguna (Admin & Karyawan) |
| `dokumen` | Data arsip dokumen digital |
| `kategori` | Kategori pengelompokan dokumen |
| `unit` | Unit/divisi pemilik dokumen |
| `distribusi` | Transaksi peminjaman dokumen |
| `izin` | Permohonan izin akses dokumen |
| `revisi` | Usulan perubahan/revisi dokumen |
| `riwayat` | Log aktivitas / audit trail |

---

## 🔐 Akun Login

### Admin

| Username | Password | Role |
|---|---|---|
| `admin` | `admin123` | Admin |
| `NamekianP` | *(pribadi)* | Admin |

### Karyawan

| Username | Password | Role |
|---|---|---|
| `petugas` | `petugas123` | Karyawan |
| `farel` | `farel123` | Karyawan |

---

## 🗂️ Struktur Direktori

```
tugasPemogramanWeb/
├── app/
│   ├── Controllers/        ← Logic aplikasi (Admin, Auth, Dokumen, dll)
│   ├── Models/             ← Model database (UserModel, DokumenModel, dll)
│   ├── Views/
│   │   └── admin/          ← Template halaman (dashboard, dokumen, izin, dll)
│   ├── Database/
│   │   ├── Migrations/     ← Struktur tabel database
│   │   └── Seeds/          ← Data awal (MainSeeder, dll)
│   └── Config/             ← Konfigurasi CI4
├── database/
│   └── apa.sql             ← File export database MySQL
├── public/
│   ├── uploads/            ← File dokumen yang diupload
│   └── assets/             ← CSS, JS, gambar statis
├── src/                    ← Source Tailwind CSS
├── .env.example            ← Template konfigurasi environment
├── composer.json           ← Dependensi PHP
├── package.json            ← Dependensi Node.js (Tailwind)
├── generate_class_diagram.py ← Script PlantUML class diagram
├── class_diagram.png       ← Diagram kelas sistem
└── README.md               ← Dokumentasi ini
```

---

## 🔄 Alur Penggunaan Sistem

```
Karyawan                                Admin
   │                                      │
   ├─ Login                               ├─ Login
   ├─ Lihat daftar dokumen                ├─ Kelola dokumen (CRUD + upload)
   ├─ Ajukan izin akses ──────────────►  ├─ Setujui / Tolak izin
   │                        ◄──────────── ├─ Buat catatan distribusi
   ├─ Pinjam & baca dokumen               │
   ├─ Ajukan revisi dokumen ──────────►  ├─ Review revisi (Setujui/Tolak)
   ├─ Kembalikan dokumen                  ├─ Lihat riwayat aktivitas
   └─ Logout                              └─ Logout
```

---

## 👥 Tim Pengembang

**Kelompok 2 — Kelas 15.4A.31**
Universitas Bina Sarana Informatika (BSI)
Mata Kuliah: Web Programming · Tahun 2026

| No | Nama | NIM |
|---|---|---|
| 1 | Andre Saputra | 15240242 |
| 2 | Fetresia VC Saragih | 15240294 |
| 3 | Dheo Bagas Saputra | 15240298 |
| 4 | Ilham Fauzi | 15241096 |

---

## 📄 Lisensi

Proyek ini dibuat untuk keperluan akademik.
Dosen Pengampu: [rangga.rpo@bsi.ac.id](mailto:rangga.rpo@bsi.ac.id)

---

<div align="center">
  Dibuat dengan ❤️ menggunakan <strong>CodeIgniter 4</strong> + <strong>Tailwind CSS</strong>
  <br>
  © 2026 Kelompok 2 — Web Programming 15.4A.31
</div>