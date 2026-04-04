<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Arsip Digital | Kelompok 6</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        :root {
            --primary-dark: #1e293b;
            --accent-color: #3b82f6;
            --bg-light: #f8fafc;
        }

        body { 
            font-family: 'Inter', sans-serif; 
            background-color: var(--bg-light);
            color: #334155;
        }

        /* Sidebar Styling */
        .sidebar { 
            min-height: 100vh; 
            background: var(--primary-dark); 
            width: 260px; 
            position: fixed;
            transition: all 0.3s;
            z-index: 1000;
        }

        .sidebar .nav-link {
            color: #94a3b8;
            padding: 12px 20px;
            margin: 4px 15px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            font-weight: 500;
        }

        .sidebar .nav-link:hover, .sidebar .nav-link.active {
            background: rgba(59, 130, 246, 0.1);
            color: #fff;
        }

        .sidebar .nav-link i { width: 25px; font-size: 1.1rem; }

        /* Content Area */
        .main-content { margin-left: 260px; padding: 40px; }

        /* Card Customization */
        .card-stats {
            border: none;
            border-radius: 16px;
            box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1);
            transition: transform 0.2s;
        }

        .card-stats:hover { transform: translateY(-5px); }

        .table-container {
            background: white;
            border-radius: 16px;
            padding: 25px;
            box-shadow: 0 10px 15px -3px rgba(0,0,0,0.05);
        }

        .btn-primary {
            background-color: var(--accent-color);
            border: none;
            padding: 10px 20px;
            border-radius: 8px;
            font-weight: 600;
        }

        .badge-status { padding: 6px 12px; border-radius: 20px; font-weight: 600; font-size: 0.75rem; }
    </style>
</head>
<body>
<div id="pesanRespon"></div>
    <div class="sidebar d-flex flex-column p-3 shadow">
        <div class="d-flex align-items-center mb-4 px-3">
            <div class="bg-primary p-2 rounded-3 me-2">
                <i class="fas fa-box-archive text-white"></i>
            </div>
            <span class="fs-5 fw-bold text-white">Arsip Kel 6</span>
        </div>
        
        <ul class="nav nav-pills flex-column mb-auto" id="menuTab">
            <li class="nav-item">
                <a href="#dash" class="nav-link active" data-bs-toggle="tab">
                    <i class="fas fa-gauge-high"></i> Dashboard 
                </a>
            </li>
            <li>
                <a href="#docs" class="nav-link" data-bs-toggle="tab">
                    <i class="fas fa-file-lines"></i> Data Dokumen [cite: 6]
                </a>
            </li>
            <li>
                <a href="#units" class="nav-link" data-bs-toggle="tab">
                    <i class="fas fa-building-user"></i> Unit / Bagian [cite: 11]
                </a>
            </li>
            <li>
                <a href="#history" class="nav-link" data-bs-toggle="tab">
                    <i class="fas fa-clock-rotate-left"></i> Riwayat [cite: 17]
                </a>
            </li>
        </ul>
        
        <div class="mt-auto px-3 py-2 bg-dark rounded-3">
            <small class="text-muted d-block small">Logged in as:</small>
            <span class="text-white fw-semibold small">Admin Utama [cite: 5]</span>
        </div>
    </div>

    <div class="main-content">
        <div class="tab-content">
            
            <div class="tab-pane fade show active" id="dash">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2 class="fw-bold">Ringkasan Sistem </h2>
                    <span class="text-muted">Kamis, 2 April 2026</span>
                </div>

                <div class="row g-4 mb-5">
                    <div class="col-md-4">
                        <div class="card card-stats p-4 bg-white border-start border-primary border-5">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <p class="text-muted mb-1">Total Arsip</p>
                                    <h3 class="fw-bold mb-0">1,250</h3>
                                </div>
                                <i class="fas fa-file-pdf fa-2x text-primary opacity-25"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card card-stats p-4 bg-white border-start border-success border-5">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <p class="text-muted mb-1">Unit Kerja</p>
                                    <h3 class="fw-bold mb-0">12</h3>
                                </div>
                                <i class="fas fa-users fa-2x text-success opacity-25"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card card-stats p-4 bg-white border-start border-warning border-5">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <p class="text-muted mb-1">Distribusi Aktif</p>
                                    <h3 class="fw-bold mb-0">45</h3>
                                </div>
                                <i class="fas fa-share-nodes fa-2x text-warning opacity-25"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="table-container">
                    <h5 class="fw-bold mb-4">Aktivitas Terakhir [cite: 18]</h5>
                    <div class="table-responsive">
                        <table class="table align-middle">
                            <thead class="text-muted small text-uppercase">
                                <tr>
                                    <th>Dokumen</th>
                                    <th>Unit Pemilik</th>
                                    <th>Waktu</th>
                                    <th>Status Transaksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="fw-semibold">Laporan Keuangan Q1.pdf</td>
                                    <td>Bagian Keuangan [cite: 12]</td>
                                    <td>10 Menit yang lalu</td>
                                    <td><span class="badge bg-success-subtle text-success badge-status">Berhasil Diunggah [cite: 13]</span></td>
                                </tr>
                                <tr>
                                    <td class="fw-semibold">SK Direksi No. 04.doc</td>
                                    <td>Sekretariat [cite: 12]</td>
                                    <td>1 Jam yang lalu</td>
                                    <td><span class="badge bg-primary-subtle text-primary badge-status">Didistribusikan [cite: 15]</span></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="tab-pane fade" id="docs">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2 class="fw-bold">Manajemen Dokumen [cite: 6]</h2>
                    <button class="btn btn-primary shadow" data-bs-toggle="modal" data-bs-target="#modalAddDoc">
                        <i class="fas fa-plus me-2"></i>Tambah Dokumen [cite: 14]
                    </button>
                </div>

                <div class="table-container">
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <input type="text" class="form-control" placeholder="Cari dokumen...">
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th>Judul [cite: 7]</th>
                                    <th>Tanggal [cite: 7]</th>
                                    <th>Kategori [cite: 10]</th>
                                    <th>Unit [cite: 12]</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="fw-bold">SOP Operasional IT</td>
                                    <td>25 Mar 2026 [cite: 7]</td>
                                    <td><span class="badge bg-secondary">Teknis</span></td>
                                    <td>Unit IT</td>
                                    <td>
                                        <button class="btn btn-sm btn-light text-primary"><i class="fas fa-edit"></i></button>
                                        <button class="btn btn-sm btn-light text-danger"><i class="fas fa-trash"></i></button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="tab-pane fade" id="units">
                <h2 class="fw-bold mb-4">Unit Kerja [cite: 11]</h2>
                <div class="row g-4">
                    <div class="col-md-4">
                        <div class="card p-3 shadow-sm border-0 text-center">
                            <i class="fas fa-building-columns fa-3x text-primary mb-3"></i>
                            <h5 class="fw-bold">Bagian SDM</h5>
                            <p class="text-muted small">Total 150 Dokumen</p>
                            <button class="btn btn-sm btn-outline-primary">Lihat Detail [cite: 12]</button>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

<div class="modal fade" id="modalAddDoc" tabindex="-1">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content border-0 shadow">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title fw-bold">Unggah Dokumen Digital [cite: 13]</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
               <?= form_open_multipart("Create") ?> 
               <form id="FormData">
                <?= csrf_field() ?>.
                    <div class="modal-body p-4">
                        <div class="row g-3">
                            <div class="col-12">
                                <label class="form-label fw-semibold">Judul Dokumen [cite: 7]</label>
                                <input type="text" class="form-control p-2" placeholder="Masukkan judul..." required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Kategori [cite: 10]</label>
                                <select class="form-select p-2">
                                    <option>Internal</option>
                                    <option>Eksternal</option>
                                    <option>Rahasia</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Unit Pemilik [cite: 12]</label>
                                <select class="form-select p-2">
                                    <option>Bagian Keuangan</option>
                                    <option>Bagian SDM</option>
                                    <option>Unit IT</option>
                                </select>
                            </div>
                            <div class="col-12">
                                <label class="form-label fw-semibold">Deskripsi [cite: 7]</label>
                                <textarea class="form-control" rows="3"></textarea>
                            </div>
                            
                        </div>
                    </div>
                    <div class="modal-footer border-0">
                        <button type="button" class="btn btn-light px-4" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary px-4">Simpan Arsip [cite: 5]</button>
                    </div>
                </form>
                <?= form_close() ?>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
<script>
    // const form = document.getElementById('formData');
    // form.addEventListener('submit',function(e) {
    //     const formData = new FormData(form);
    //     fetch('/', {
    //     method: "POST",
    //     body: formData
    //     })
    //     .then(response => response.json())
    //     .then(hasil => {
    //                 if(hasil.success) {
    //                     document.getElementById("pesanRespon").innerHTML = '<div style ="color: red;"> $hasil.message</div>';
                
    //                     console.log("data gagal ditambahkaan")
    //                     form.reset
    //                 } else if(hasil.error){
    //                     document.getElementById("pesanRespon").innerHTML = '<div style ="color: red;"> $hasil.message</div>';
                
    //                     console.log("data gagal ditambahkaan")
    //                     form.reset
    //                 } else {
    //                     console.log('error');
    //                 }
    //             })
    //     })

</script>
</html>