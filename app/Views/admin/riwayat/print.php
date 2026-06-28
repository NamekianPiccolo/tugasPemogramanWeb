<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Laporan Riwayat Aktivitas' ?></title>
    <!-- Font Kalam & Inter untuk keseimbangan estetika formal dan tulisan tangan -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&family=Kalam:wght@400;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --txt-dark: #1e293b;
            --border-color: #cbd5e1;
        }
        * {
            box-sizing: border-box;
            font-family: 'Inter', sans-serif;
        }
        body {
            margin: 0;
            padding: 30px;
            background-color: #ffffff;
            color: var(--txt-dark);
            font-size: 13px;
        }
        .header-laporan {
            text-align: center;
            margin-bottom: 25px;
            position: relative;
        }
        .header-laporan h1 {
            font-family: 'Inter', sans-serif;
            font-weight: 700;
            font-size: 20px;
            margin: 0 0 5px 0;
            color: #1e293b;
            letter-spacing: 0.5px;
        }
        .header-laporan p {
            margin: 0;
            font-size: 13px;
            color: #64748b;
        }
        .divider {
            border-bottom: 3px double var(--txt-dark);
            margin: 15px 0 20px 0;
        }
        .meta-info {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
            font-size: 12px;
            background-color: #f8fafc;
            padding: 12px 15px;
            border-radius: 6px;
            border: 1px solid #e2e8f0;
        }
        .meta-info table {
            border-collapse: collapse;
        }
        .meta-info td {
            padding: 3px 8px;
            vertical-align: top;
        }
        .meta-info td.label {
            font-weight: 600;
            color: #475569;
        }
        .table-data {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
        }
        .table-data th, .table-data td {
            border: 1px solid var(--border-color);
            padding: 10px 12px;
            text-align: left;
        }
        .table-data th {
            background-color: #f1f5f9;
            font-weight: 700;
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        .table-data tr:nth-child(even) {
            background-color: #f8fafc;
        }
        .badge {
            display: inline-block;
            padding: 3px 8px;
            font-size: 10px;
            font-weight: 700;
            text-transform: uppercase;
            border-radius: 4px;
            font-family: 'Inter', sans-serif;
        }
        .badge-tambah { background-color: #d1fae5; color: #065f46; border: 1px solid #a7f3d0; }
        .badge-edit { background-color: #fef3c7; color: #92400e; border: 1px solid #fde68a; }
        .badge-hapus { background-color: #fee2e2; color: #991b1b; border: 1px solid #fca5a5; }
        .badge-login { background-color: #ede9fe; color: #5b21b6; border: 1px solid #ddd6fe; }
        .badge-lainnya { background-color: #f1f5f9; color: #475569; border: 1px solid #e2e8f0; }

        .signature-section {
            display: flex;
            justify-content: flex-end;
            margin-top: 50px;
            page-break-inside: avoid;
        }
        .signature-box {
            text-align: center;
            width: 250px;
        }
        .signature-space {
            height: 70px;
        }
        .signature-name {
            font-weight: 700;
            text-decoration: underline;
        }

        /* Floating action panel - hidden during printing */
        .actions-panel {
            position: fixed;
            bottom: 20px;
            right: 20px;
            background: #ffffff;
            padding: 10px 15px;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
            border: 2px solid #3d405b;
            display: flex;
            gap: 10px;
            z-index: 1000;
        }
        .btn {
            padding: 8px 15px;
            font-size: 12px;
            font-weight: 600;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 5px;
            transition: all 0.2s;
        }
        .btn-primary {
            background-color: #84a98c;
            color: #ffffff;
            border: 1px solid #3d405b;
        }
        .btn-primary:hover { background-color: #73967b; }
        .btn-secondary {
            background-color: #ffffff;
            color: #3d405b;
            border: 1px solid #cbd5e1;
        }
        .btn-secondary:hover { background-color: #f1f5f9; }

        /* Media Print overrides */
        @media print {
            body {
                padding: 0;
                font-size: 11px;
            }
            .actions-panel {
                display: none;
            }
            .meta-info {
                background-color: transparent !important;
                border: 1px solid #cbd5e1;
            }
            .table-data th {
                background-color: #e2e8f0 !important;
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }
            .badge-tambah { background-color: transparent !important; color: #065f46 !important; border: 1px solid #065f46 !important; }
            .badge-edit { background-color: transparent !important; color: #92400e !important; border: 1px solid #92400e !important; }
            .badge-hapus { background-color: transparent !important; color: #991b1b !important; border: 1px solid #991b1b !important; }
            .badge-login { background-color: transparent !important; color: #5b21b6 !important; border: 1px solid #5b21b6 !important; }
            .badge-lainnya { background-color: transparent !important; color: #475569 !important; border: 1px solid #475569 !important; }
        }
    </style>
</head>
<body>

    <!-- Tombol Aksi Melayang (Hanya muncul di layar) -->
    <div class="actions-panel">
        <button onclick="window.print()" class="btn btn-primary">
            <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path></svg>
            Cetak Laporan
        </button>
        <button onclick="window.close()" class="btn btn-secondary">
            Tutup Halaman
        </button>
    </div>

    <!-- Header Laporan -->
    <div class="header-laporan">
        <h1>LAPORAN RIWAYAT AKTIVITAS SISTEM</h1>
        <p>Sistem Manajemen Arsip Dokumen Digital - Workspace DMS</p>
        <p style="font-size: 11px; margin-top: 5px;">Alamat Kantor Pusat / Unit Kerja Administrasi Dokumen</p>
    </div>

    <div class="divider"></div>

    <!-- Informasi Laporan -->
    <div class="meta-info">
        <table>
            <tr>
                <td class="label">Jenis Laporan</td>
                <td>:</td>
                <td>Log Audit Trail (Riwayat Aktivitas)</td>
            </tr>
            <tr>
                <td class="label">Kategori Filter</td>
                <td>:</td>
                <td>
                    <?php 
                    $filters = [];
                    if (empty($filter_aksi)) {
                        $filters[] = 'Semua Aktivitas';
                    } else {
                        $filters[] = 'Aktivitas: ' . ucfirst($filter_aksi);
                    }
                    if (!empty($filter_tanggal)) {
                        $filters[] = 'Tanggal: ' . date('d-m-Y', strtotime($filter_tanggal));
                    }
                    if (!empty($filter_search)) {
                        $filters[] = 'Pencarian: "' . esc($filter_search) . '"';
                    }
                    echo implode(', ', $filters);
                    ?>
                </td>
            </tr>
            <tr>
                <td class="label">Urutan</td>
                <td>:</td>
                <td>
                    <?= ($sort_order ?? 'DESC') === 'ASC' ? 'Terlama (Ascending)' : 'Terbaru (Descending)' ?>
                </td>
            </tr>
        </table>
        <table>
            <tr>
                <td class="label">Dicetak Oleh</td>
                <td>:</td>
                <td><?= esc(session()->get('nama_lengkap') ?? 'Administrator') ?></td>
            </tr>
            <tr>
                <td class="label">Tanggal Cetak</td>
                <td>:</td>
                <td><?= date('d-m-Y H:i:s') ?> WIB</td>
            </tr>
        </table>
    </div>

    <!-- Tabel Data Riwayat -->
    <table class="table-data">
        <thead>
            <tr>
                <th style="width: 5%; text-align: center;">No</th>
                <th style="width: 15%;">Waktu</th>
                <th style="width: 15%;">Operator (User)</th>
                <th style="width: 15%;">Kategori Aksi</th>
                <th style="width: 25%;">Dokumen Terkait</th>
                <th style="width: 25%;">Keterangan</th>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($riwayat)): ?>
                <tr>
                    <td colspan="6" style="text-align: center; padding: 20px; font-style: italic;">Tidak ada data log riwayat aktivitas yang ditemukan.</td>
                </tr>
            <?php else: ?>
                <?php 
                $no = 1;
                foreach ($riwayat as $r): 
                    $aksi = strtolower($r['aksi']);
                    if (strpos($aksi, 'tambah') !== false || strpos($aksi, 'buat') !== false || strpos($aksi, 'upload') !== false) {
                        $badgeClass = 'badge-tambah'; $aksiTag = 'Tambah';
                    } elseif (strpos($aksi, 'hapus') !== false) {
                        $badgeClass = 'badge-hapus'; $aksiTag = 'Hapus';
                    } elseif (strpos($aksi, 'ubah') !== false || strpos($aksi, 'edit') !== false || strpos($aksi, 'revisi') !== false) {
                        $badgeClass = 'badge-edit'; $aksiTag = 'Edit';
                    } elseif (strpos($aksi, 'login') !== false || strpos($aksi, 'logout') !== false) {
                        $badgeClass = 'badge-login'; $aksiTag = 'Sesi';
                    } else {
                        $badgeClass = 'badge-lainnya'; $aksiTag = 'Lainnya';
                    }
                ?>
                    <tr>
                        <td style="text-align: center;"><?= $no++ ?></td>
                        <td><?= date('d-m-Y H:i', strtotime($r['created_at'])) ?> WIB</td>
                        <td>
                            <strong><?= esc($r['username'] ?? 'Sistem') ?></strong>
                            <?php if (!empty($r['nama_lengkap'])): ?>
                                <br><span style="font-size: 10px; color: #64748b;"><?= esc($r['nama_lengkap']) ?></span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <span class="badge <?= $badgeClass ?>"><?= $aksiTag ?></span>
                            <br><span style="font-size: 11px; color: #475569;"><?= esc($r['aksi']) ?></span>
                        </td>
                        <td><?= esc($r['judul'] ?? 'Dokumen Dihapus / Tidak Ada') ?></td>
                        <td style="font-style: italic; color: #475569;">"<?= esc($r['keterangan']) ?>"</td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>

    <!-- Tanda Tangan / Persetujuan -->
    <div class="signature-section">
        <div class="signature-box">
            <p>Kota Jambi, <?= date('d F Y') ?></p>
            <p>Petugas Penanggung Jawab,</p>
            <div class="signature-space"></div>
            <p class="signature-name"><?= esc(session()->get('nama_lengkap') ?? 'Administrator') ?></p>
            <p style="font-size: 10px; color: #64748b; margin-top: 2px;">NIP / ID: Admin-<?= esc(session()->get('id') ?? '000') ?></p>
        </div>
    </div>

    <!-- Pemicu Cetak Otomatis -->
    <script>
        window.addEventListener('DOMContentLoaded', () => {
            // Memberikan jeda singkat agar font dan layout ter-render sempurna
            setTimeout(() => {
                window.print();
            }, 600);
        });
    </script>
</body>
</html>
