<?= $this->extend('admin/layout') ?>
<?= $this->section('content') ?>
<?php $role = session()->get('role') ?? 'admin'; ?>

<style>
.fl-group{position:relative}
.fl-input{display:block;width:100%;height:56px;padding:20px 16px 6px 46px;font-size:13.5px;color:var(--txt);background:rgba(255,252,242,0.6);border:1.5px solid rgba(61,64,91,0.16);border-radius:10px;outline:none;transition:border-color .2s ease,box-shadow .2s ease,background .2s ease;appearance:none;line-height:1}
textarea.fl-input{height:auto;padding-top:26px;padding-bottom:10px;resize:none;line-height:1.55}
.fl-input::placeholder{color:transparent;user-select:none}
.fl-label{position:absolute;left:46px;top:50%;transform:translateY(-50%);font-size:13px;color:rgba(138,129,124,.85);pointer-events:none;transition:all .2s cubic-bezier(.4,0,.2,1);transform-origin:left center;white-space:nowrap}
.fl-group.is-textarea .fl-label{top:18px;transform:none}
.fl-input:focus~.fl-label,.fl-input:not(:placeholder-shown)~.fl-label{top:10px;transform:translateY(0) scale(.73);color:var(--primary);font-family:'Kalam',cursive;font-weight:700;letter-spacing:.3px}
.fl-group.is-textarea .fl-input:focus~.fl-label,.fl-group.is-textarea .fl-input:not(:placeholder-shown)~.fl-label{top:8px;transform:scale(.73);transform-origin:left top;color:var(--primary);font-family:'Kalam',cursive;font-weight:700}
.fl-input:focus{border-color:var(--txt);background:#fffcf2;box-shadow:4px 4px 0px rgba(61,64,91,.15)}
.fl-icon{position:absolute;left:15px;top:50%;transform:translateY(-50%);width:17px;height:17px;color:rgba(181,176,161,.9);pointer-events:none;transition:color .2s ease;z-index:2}
.fl-group.is-textarea .fl-icon{top:18px;transform:none}
.fl-group:focus-within .fl-icon{color:var(--primary)}
select.fl-input{cursor:pointer;background-image:url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke='%23b5b0a1'%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' stroke-width='2.2' d='M19 9l-7 7-7-7'/%3E%3C/svg%3E");background-repeat:no-repeat;background-position:right 14px center;background-size:14px;padding-right:42px!important}
select.fl-input~.fl-label,input[type="date"].fl-input~.fl-label{top:10px;transform:translateY(0) scale(.73);font-family:'Kalam',cursive;font-weight:700;color:rgba(138,129,124,.8)}
select.fl-input:focus~.fl-label,input[type="date"].fl-input:focus~.fl-label{color:var(--primary)}
/* Upload zone */
.upload-zone{border:1.5px dashed rgba(61,64,91,.2);border-radius:12px;padding:24px 20px;text-align:center;cursor:pointer;transition:all .22s ease;background:rgba(255,252,242,.4);position:relative}
.upload-zone:hover,.upload-zone.drag-over{border-color:var(--primary);border-style:solid;background:rgba(132,169,140,.05)}
.upload-zone input[type="file"]{position:absolute;inset:0;opacity:0;cursor:pointer;width:100%;height:100%}
.upload-ring{width:46px;height:46px;margin:0 auto 10px;border-radius:50%;background:rgba(132,169,140,.1);border:1.5px dashed rgba(132,169,140,.35);display:flex;align-items:center;justify-content:center;transition:all .22s ease}
.upload-zone:hover .upload-ring,.upload-zone.drag-over .upload-ring{border-color:var(--primary);border-style:solid;background:rgba(132,169,140,.15);transform:scale(1.06)}
.file-pill{display:none;align-items:center;gap:7px;margin-top:10px;padding:6px 14px;border-radius:100px;background:rgba(132,169,140,.1);border:1.5px solid rgba(132,169,140,.35);font-size:11px;font-family:'Kalam',cursive;font-weight:700;color:var(--txt)}
.file-pill.on{display:inline-flex}
.file-pill span{overflow:hidden;text-overflow:ellipsis;white-space:nowrap;max-width:180px}
.current-file{display:flex;align-items:center;gap:8px;padding:8px 12px;border-radius:9px;background:rgba(132,169,140,.08);border:1.5px solid rgba(132,169,140,.25);margin-bottom:10px;font-size:11px;font-family:'Kalam',cursive;font-weight:700;color:var(--txt)}
/* Section sep */
.sec-sep{display:flex;align-items:center;gap:8px;margin-bottom:20px}
.sec-sep-line{width:3px;height:14px;border-radius:2px;flex-shrink:0;background:var(--secondary)}
.sec-sep span{font-family:'Kalam',cursive;font-size:11px;font-weight:700;letter-spacing:1.8px;text-transform:uppercase;color:var(--muted);white-space:nowrap}
.sec-sep::after{content:'';flex:1;height:1px;background:linear-gradient(to right,rgba(61,64,91,.1),transparent)}
.static-card{transition:box-shadow .2s ease!important}.static-card:hover{transform:none!important;box-shadow:3px 3px 0px rgba(61,64,91,.15)!important}
.btn-save{display:flex;align-items:center;justify-content:center;gap:8px;width:100%;padding:13px;font-family:'Kalam',cursive;font-size:14px;font-weight:700;letter-spacing:.5px;border-radius:11px;cursor:pointer;background:var(--primary);color:#fffcf2;border:2px solid var(--txt);box-shadow:3px 3px 0 var(--txt);transition:all .18s ease}
.btn-save:hover{transform:translate(-1px,-1px);box-shadow:4px 4px 0 var(--txt)}
.btn-cancel{display:flex;align-items:center;justify-content:center;width:100%;padding:10px;font-family:'Kalam',cursive;font-size:13px;font-weight:700;border-radius:11px;cursor:pointer;background:transparent;color:var(--muted);border:1.5px solid rgba(61,64,91,.15);transition:all .18s ease}
.btn-cancel:hover{border-color:var(--txt);color:var(--txt)}
.req{color:var(--secondary);margin-left:1px}
</style>

<!-- Header -->
<div class="mb-5 page-intro flex items-center justify-between">
    <div>
        <div class="flex items-center gap-2 mb-1">
            <div class="w-1 h-4 rounded-full" style="background:linear-gradient(180deg,#8B5CF6,#06B6D4)"></div>
            <span class="text-[9px] font-bold uppercase tracking-widest" style="color:rgba(139,92,246,.6)">Vault Digital</span>
        </div>
        <h1 class="text-xl font-bold grad-violet mb-0.5">Edit Dokumen</h1>
        <p class="text-xs" style="color:var(--muted)">Perbarui metadata atau file dokumen yang sudah ada dalam sistem arsip.</p>
    </div>
    <a href="<?= base_url("$role/dokumen") ?>" class="btn-cancel shrink-0 px-4 py-2 text-xs" style="width:auto;border-radius:8px">← Kembali</a>
</div>

<?php if (session()->getFlashdata('error')): ?>
<div class="mb-4 px-4 py-3 rounded-xl flex items-center gap-2.5 text-xs" style="background:rgba(224,122,95,.1);border:1.5px solid rgba(224,122,95,.25);color:var(--txt)">
    <svg class="w-4 h-4 shrink-0" style="color:var(--secondary)" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z"/></svg>
    <span class="font-kalam font-bold"><?= session()->getFlashdata('error') ?></span>
</div>
<?php endif; ?>

<form action="<?= base_url("$role/dokumen/update/" . $dokumen['id']) ?>" method="POST" enctype="multipart/form-data">
    <?= csrf_field() ?>
    <input type="hidden" name="file_lama" value="<?= esc($dokumen['file_dokumen']) ?>">
    <input type="hidden" name="dokumen_id" value="<?= esc($dokumen['id']) ?>">

    <div class="grid gap-5" style="grid-template-columns:3fr 2fr;align-items:start">

        <!-- Left -->
        <div class="glass-card static-card" style="padding:28px 32px;border-radius:14px">
            <div class="sec-sep"><div class="sec-sep-line"></div><span>Informasi Dokumen</span></div>

            <div class="fl-group mb-4">
                <input type="text" name="judul" id="judul" value="<?= old('judul', $dokumen['judul']) ?>" placeholder="Judul Dokumen" class="fl-input" required>
                <label for="judul" class="fl-label">Judul Dokumen <span class="req">*</span></label>
                <svg class="fl-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
            </div>

            <?php if ($role === 'admin'): ?>
            <div class="grid grid-cols-2 gap-4 mb-4">
                <div class="fl-group">
                    <select name="kategori_id" id="kategori_id" class="fl-input">
                        <?php foreach ($kategori as $k): ?>
                        <option value="<?= $k['id'] ?>" <?= $dokumen['kategori_id'] == $k['id'] ? 'selected' : '' ?>><?= esc($k['nama_kategori']) ?></option>
                        <?php endforeach; ?>
                    </select>
                    <label for="kategori_id" class="fl-label">Kategori</label>
                    <svg class="fl-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A2 2 0 013 12V7a4 4 0 014-4z"/></svg>
                </div>
                <div class="fl-group">
                    <select name="unit_id" id="unit_id" class="fl-input">
                        <?php foreach ($unit as $u): ?>
                        <option value="<?= $u['id'] ?>" <?= $dokumen['unit_id'] == $u['id'] ? 'selected' : '' ?>><?= esc($u['nama_unit']) ?></option>
                        <?php endforeach; ?>
                    </select>
                    <label for="unit_id" class="fl-label">Unit Kerja</label>
                    <svg class="fl-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                </div>
            </div>

            <div class="fl-group mb-4">
                <input type="date" name="tanggal" id="tanggal" value="<?= old('tanggal', $dokumen['tanggal']) ?>" class="fl-input">
                <label for="tanggal" class="fl-label">Tanggal Dokumen</label>
                <svg class="fl-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
            </div>
            <?php else: ?>
            <input type="hidden" name="kategori_id" value="<?= esc($dokumen['kategori_id']) ?>">
            <input type="hidden" name="unit_id" value="<?= esc($dokumen['unit_id']) ?>">
            <input type="hidden" name="tanggal" value="<?= esc($dokumen['tanggal']) ?>">
            <?php endif; ?>

            <div class="fl-group is-textarea">
                <textarea name="deskripsi" id="deskripsi" rows="4" placeholder="Deskripsi Dokumen" class="fl-input"><?= old('deskripsi', $dokumen['deskripsi']) ?></textarea>
                <label for="deskripsi" class="fl-label">Deskripsi</label>
                <svg class="fl-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M4 6h16M4 10h16M4 14h10"/></svg>
            </div>
        </div>

        <!-- Right -->
        <div class="flex flex-col gap-4">
            <div class="glass-card static-card p-5" style="border-radius:14px">
                <div class="sec-sep"><div class="sec-sep-line" style="background:var(--primary)"></div><span>Ganti File</span></div>

                <?php if (!empty($dokumen['file_dokumen'])): ?>
                <div class="current-file">
                    <svg class="w-4 h-4 shrink-0" style="color:var(--primary)" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    <div><p class="text-[9px] uppercase tracking-widest" style="color:var(--muted)">File Saat Ini</p><p class="text-[11px]"><?= esc($dokumen['file_dokumen']) ?></p></div>
                </div>
                <?php endif; ?>

                <div class="upload-zone" id="uploadZone">
                    <input type="file" name="file_dokumen" id="file_dokumen" accept=".pdf,.doc,.docx,.xls,.xlsx,.csv" id="fileInput">
                    <div class="upload-ring" id="uploadRing">
                        <svg class="w-5 h-5" style="color:var(--dim)" fill="none" stroke="currentColor" viewBox="0 0 24 24" id="uploadIcon">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.7" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/>
                        </svg>
                    </div>
                    <p class="text-xs font-bold font-kalam mb-0.5" style="color:var(--txt)">Ganti file dokumen</p>
                    <p class="text-[10px]" style="color:var(--muted)">Kosongkan jika tidak ingin mengganti file</p>
                    <div class="file-pill" id="filePill">
                        <svg class="w-3 h-3 shrink-0" style="color:var(--primary)" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                        <span id="fileName">—</span>
                    </div>
                </div>

                <!-- PDF Preview Container -->
                <div id="pdfPreviewContainer" style="display:none; margin-top: 15px; border: 1.5px solid rgba(61,64,91,0.15); border-radius: 10px; overflow: hidden; height: 350px; position: relative; animation: pop-in 0.28s cubic-bezier(0.34,1.56,0.64,1);">
                    <div style="display: flex; justify-content: space-between; align-items: center; background: #f2e8cf; padding: 6px 12px; border-bottom: 1.5px solid rgba(61,64,91,0.15);">
                        <span id="previewTitle" style="font-family: 'Kalam', cursive; font-size: 11px; font-weight: 700; color: var(--txt);">Pratinjau PDF</span>
                        <button type="button" id="removePdfPreview" style="color: var(--secondary); font-size: 10px; font-weight: bold; cursor: pointer; border: none; background: transparent; display: none;">Batal</button>
                    </div>
                    <iframe id="pdfPreviewFrame" src="" style="width: 100%; height: calc(100% - 30px); border: none;"></iframe>
                </div>
                <p class="text-[9px] mt-2 font-kalam uppercase tracking-widest text-center" style="color:var(--dim)">PDF · DOC · XLS · CSV — max 10 MB</p>
            </div>

            <div class="flex flex-col gap-2.5">
                <button type="submit" class="btn-save">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"/></svg>
                    Perbarui Dokumen
                </button>
                <a href="<?= base_url("$role/dokumen") ?>" class="btn-cancel">Batal</a>
            </div>
        </div>
    </div>
</form>

<script>
(() => {
    gsap.fromTo('.page-intro',{y:-14,opacity:0},{y:0,opacity:1,duration:.38,ease:'power3.out'});
    gsap.fromTo('.glass-card',{y:18,opacity:0},{y:0,opacity:1,duration:.42,stagger:.06,ease:'power3.out',delay:.05});

    const zone=document.getElementById('uploadZone'),input=document.getElementById('file_dokumen'),pill=document.getElementById('filePill'),nameEl=document.getElementById('fileName'),ring=document.getElementById('uploadRing'),icon=document.getElementById('uploadIcon');

    /* PDF Preview elements */
    const previewContainer = document.getElementById('pdfPreviewContainer');
    const previewFrame = document.getElementById('pdfPreviewFrame');
    const removePreviewBtn = document.getElementById('removePdfPreview');
    const previewTitle = document.getElementById('previewTitle');

    // Define current file details
    const currentFileName = "<?= esc($dokumen['file_dokumen']) ?>";
    const currentFileUrl = "<?= base_url('uploads/' . $dokumen['file_dokumen']) ?>";

    const loadCurrentFilePreview = () => {
        if (currentFileName && currentFileName.toLowerCase().endsWith('.pdf')) {
            previewFrame.src = currentFileUrl;
            previewTitle.textContent = "Pratinjau File Saat Ini";
            previewContainer.style.display = 'block';
            removePreviewBtn.style.display = 'none';
        } else {
            previewFrame.src = '';
            previewContainer.style.display = 'none';
            removePreviewBtn.style.display = 'none';
        }
    };

    // Load initial preview if it exists
    loadCurrentFilePreview();

    const setFile = file => {
        nameEl.textContent = file.name;
        pill.classList.add('on');
        ring.style.cssText += ';border-color:var(--primary);border-style:solid;background:rgba(132,169,140,.15)';
        icon.style.color = 'var(--primary)';

        // Show PDF preview if it is a PDF
        if (file.type === 'application/pdf' || file.name.toLowerCase().endsWith('.pdf')) {
            const objectUrl = URL.createObjectURL(file);
            previewFrame.src = objectUrl;
            previewTitle.textContent = "Pratinjau PDF Baru";
            previewContainer.style.display = 'block';
            removePreviewBtn.style.display = 'block';
        } else {
            previewFrame.src = '';
            previewContainer.style.display = 'none';
            removePreviewBtn.style.display = 'none';
        }
    };

    if (removePreviewBtn) {
        removePreviewBtn.addEventListener('click', () => {
            input.value = '';
            pill.classList.remove('on');
            ring.style.cssText = '';
            icon.style.color = 'rgba(181,176,161,0.9)';
            
            // Revert back to the current file preview
            loadCurrentFilePreview();
        });
    }

    input.addEventListener('change', () => {
        if (input.files[0]) setFile(input.files[0]);
    });
    zone.addEventListener('dragover', e => { e.preventDefault(); zone.classList.add('drag-over'); });
    zone.addEventListener('dragleave', () => zone.classList.remove('drag-over'));
    zone.addEventListener('drop', e => {
        e.preventDefault(); zone.classList.remove('drag-over');
        if (e.dataTransfer.files[0]) {
            input.files = e.dataTransfer.files;
            setFile(e.dataTransfer.files[0]);
        }
    });
})();
</script>
<?= $this->endSection() ?>
