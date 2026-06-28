<?= $this->extend('admin/layout') ?>
<?= $this->section('content') ?>

<style>
/* ══════════════════════════════════════════
   FLOATING LABEL INPUT — 100% ZOOM OPTIMIZED
   ══════════════════════════════════════════ */

/* Wrapper */
.fl-group { position: relative; }

/* Input base */
.fl-input {
    display: block;
    width: 100%;
    height: 56px;
    padding: 20px 16px 6px 46px;
    font-size: 13.5px;
    
    color: var(--txt);
    background: rgba(255,252,242,0.6);
    border: 1.5px solid rgba(61,64,91,0.16);
    border-radius: 10px;
    outline: none;
    transition: border-color 0.2s ease, box-shadow 0.2s ease, background 0.2s ease;
    appearance: none;
    line-height: 1;
}
textarea.fl-input {
    height: auto;
    padding-top: 26px;
    padding-bottom: 10px;
    resize: none;
    line-height: 1.55;
}
.fl-input::placeholder { color: transparent; user-select: none; }

/* Label */
.fl-label {
    position: absolute;
    left: 46px;
    top: 50%;
    transform: translateY(-50%);
    font-size: 13px;
    
    color: rgba(138,129,124,0.85);
    pointer-events: none;
    transition: all 0.2s cubic-bezier(0.4,0,0.2,1);
    transform-origin: left center;
    white-space: nowrap;
}
.fl-group.is-textarea .fl-label {
    top: 18px;
    transform: none;
}

/* Floated state: focus or has value */
.fl-input:focus ~ .fl-label,
.fl-input:not(:placeholder-shown) ~ .fl-label {
    top: 10px;
    transform: translateY(0) scale(0.73);
    color: var(--primary);
    font-family: 'Kalam', cursive;
    font-weight: 700;
    letter-spacing: 0.3px;
}
.fl-group.is-textarea .fl-input:focus ~ .fl-label,
.fl-group.is-textarea .fl-input:not(:placeholder-shown) ~ .fl-label {
    top: 8px;
    transform: scale(0.73);
    transform-origin: left top;
    color: var(--primary);
    font-family: 'Kalam', cursive;
    font-weight: 700;
}

/* Focus styles */
.fl-input:focus {
    border-color: var(--txt);
    background: var(--bg);
    box-shadow: 4px 4px 0px rgba(61,64,91,0.15);
}

/* Icon */
.fl-icon {
    position: absolute;
    left: 15px;
    top: 50%;
    transform: translateY(-50%);
    width: 17px; height: 17px;
    color: rgba(181,176,161,0.9);
    pointer-events: none;
    transition: color 0.2s ease;
    z-index: 2;
}
.fl-group.is-textarea .fl-icon { top: 18px; transform: none; }
.fl-group:focus-within .fl-icon { color: var(--primary); }

/* Select */
select.fl-input {
    cursor: pointer;
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke='%23b5b0a1'%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' stroke-width='2.2' d='M19 9l-7 7-7-7'/%3E%3C/svg%3E");
    background-repeat: no-repeat;
    background-position: right 14px center;
    background-size: 14px;
    padding-right: 42px !important;
}
/* Select & date labels always float (value always set) */
select.fl-input ~ .fl-label,
input[type="date"].fl-input ~ .fl-label {
    top: 10px;
    transform: translateY(0) scale(0.73);
    font-family: 'Kalam', cursive;
    font-weight: 700;
    color: rgba(138,129,124,0.8);
}
select.fl-input:focus ~ .fl-label,
input[type="date"].fl-input:focus ~ .fl-label { color: var(--primary); }

/* ══ Upload Zone ══ */
.upload-zone {
    border: 1.5px dashed rgba(61,64,91,0.2);
    border-radius: 12px;
    padding: 28px 20px;
    text-align: center;
    cursor: pointer;
    transition: all 0.22s ease;
    background: rgba(255,252,242,0.4);
    position: relative;
}
.upload-zone:hover, .upload-zone.drag-over {
    border-color: var(--primary);
    border-style: solid;
    background: rgba(132,169,140,0.05);
}
.upload-zone input[type="file"] {
    position: absolute; inset: 0; opacity: 0;
    cursor: pointer; width: 100%; height: 100%;
}
.upload-ring {
    width: 52px; height: 52px; margin: 0 auto 12px;
    border-radius: 50%;
    background: rgba(132,169,140,0.1);
    border: 1.5px dashed rgba(132,169,140,0.35);
    display: flex; align-items: center; justify-content: center;
    transition: all 0.22s ease;
}
.upload-zone:hover .upload-ring, .upload-zone.drag-over .upload-ring {
    border-color: var(--primary); border-style: solid;
    background: rgba(132,169,140,0.15);
    transform: scale(1.06);
}
.file-pill {
    display: none; align-items: center; gap: 7px;
    margin-top: 12px; padding: 6px 14px;
    border-radius: 100px;
    background: rgba(132,169,140,0.1);
    border: 1.5px solid rgba(132,169,140,0.35);
    font-size: 11px; font-family: 'Kalam', cursive; font-weight: 700;
    color: var(--txt); max-width: 100%;
    animation: pop-in 0.28s cubic-bezier(0.34,1.56,0.64,1);
}
.file-pill.on { display: inline-flex; }
.file-pill span { overflow: hidden; text-overflow: ellipsis; white-space: nowrap; max-width: 180px; }
@keyframes pop-in {
    from { opacity: 0; transform: scale(0.85) translateY(4px); }
    to   { opacity: 1; transform: scale(1)    translateY(0);    }
}

/* ══ Section sep ══ */
.sec-sep {
    display: flex; align-items: center; gap: 8px; margin-bottom: 20px;
}
.sec-sep-line {
    width: 3px; height: 14px; border-radius: 2px; flex-shrink: 0;
    background: var(--secondary);
}
.sec-sep span {
    font-family: 'Kalam', cursive; font-size: 11px; font-weight: 700;
    letter-spacing: 1.8px; text-transform: uppercase; color: var(--muted);
}
.sec-sep::after {
    content: ''; flex: 1; height: 1px;
    background: linear-gradient(to right, rgba(61,64,91,0.1), transparent);
}

/* ══ Tip row ══ */
.tip-row {
    display: flex; align-items: flex-start; gap: 10px;
    padding: 10px 12px; border-radius: 9px;
    background: rgba(255,252,242,0.6);
    border: 1px solid rgba(61,64,91,0.08);
}
.tip-row-icon {
    width: 28px; height: 28px; border-radius: 7px; flex-shrink: 0;
    display: flex; align-items: center; justify-content: center;
}

/* ══ Buttons ══ */
.btn-upload {
    display: flex; align-items: center; justify-content: center; gap: 8px;
    width: 100%; padding: 13px;
    font-family: 'Kalam', cursive; font-size: 14px; font-weight: 700;
    letter-spacing: 0.5px;
    border-radius: 11px; cursor: pointer;
    background: var(--primary);
    color: #fffcf2;
    border: 2px solid var(--txt);
    box-shadow: 3px 3px 0 var(--txt);
    transition: all 0.18s ease;
}
.btn-upload:hover {
    transform: translate(-1px,-1px);
    box-shadow: 4px 4px 0 var(--txt);
}
.btn-cancel {
    display: flex; align-items: center; justify-content: center;
    width: 100%; padding: 10px;
    font-family: 'Kalam', cursive; font-size: 13px; font-weight: 700;
    border-radius: 11px; cursor: pointer;
    background: transparent; color: var(--muted);
    border: 1.5px solid rgba(61,64,91,0.15);
    transition: all 0.18s ease;
}
.btn-cancel:hover { border-color: var(--txt); color: var(--txt); }

/* ══ Panel: disable glass-card hover effect ══ */
.static-card { transition: box-shadow 0.2s ease !important; }
.static-card:hover { transform: none !important; box-shadow: 3px 3px 0px rgba(61,64,91,0.15) !important; }

/* ══ Required star ══ */
.req { color: var(--secondary); margin-left: 1px; }
</style>

<!-- ── Page header ── -->
<div class="mb-5 page-intro flex items-center justify-between">
    <div>
        <div class="flex items-center gap-2 mb-1">
            <div class="w-1 h-4 rounded-full" style="background:linear-gradient(180deg,#8B5CF6,#06B6D4)"></div>
            <span class="text-[9px] font-bold uppercase tracking-widest" style="color:rgba(139,92,246,.6)">Vault Digital</span>
        </div>
        <h1 class="text-xl font-bold grad-violet mb-0.5">Unggah Dokumen Baru</h1>
        <p class="text-xs" style="color:var(--muted)">Tambahkan dokumen baru ke dalam sistem arsip digital terpusat.</p>
    </div>
    <a href="<?= base_url('admin/dokumen') ?>"
       class="btn-cancel shrink-0 px-4 py-2 text-xs" style="width:auto; border-radius:8px">
        ← Kembali
    </a>
</div>

<?php if (session()->getFlashdata('error')): ?>
<div class="mb-4 px-4 py-3 rounded-xl flex items-center gap-2.5 text-xs"
     style="background:rgba(224,122,95,0.1);border:1.5px solid rgba(224,122,95,0.25);color:var(--txt)">
    <svg class="w-4 h-4 shrink-0" style="color:var(--secondary)" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M12 9v2m0 4h.01M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z"/>
    </svg>
    <span class="font-kalam font-bold"><?= session()->getFlashdata('error') ?></span>
</div>
<?php endif; ?>

<!-- ══════════════ MAIN LAYOUT ══════════════ -->
<form action="<?= base_url('admin/dokumen/store') ?>" method="POST" enctype="multipart/form-data">
    <?= csrf_field() ?>

    <!-- 5 col grid: left=3, right=2  -->
    <div class="grid gap-5" style="grid-template-columns: 1fr; align-items: start">

        <!-- ════ LEFT PANEL — Form fields ════ -->
        <div class="glass-card static-card" style="padding: 28px 32px; border-radius: 14px">

            <div class="sec-sep"><div class="sec-sep-line"></div><span>Informasi Dokumen</span></div>

            <!-- Judul -->
            <div class="fl-group mb-4">
                <input type="text" name="judul" id="judul"
                       value="<?= old('judul') ?>"
                       placeholder="Judul Dokumen"
                       class="fl-input" required>
                <label for="judul" class="fl-label">Judul Dokumen <span class="req">*</span></label>
                <svg class="fl-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                          d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                </svg>
            </div>

            <!-- Kategori + Unit (side by side) -->
            <div class="grid grid-cols-2 gap-4 mb-4">
                <div class="fl-group">
                    <select name="kategori_id" id="kategori_id" class="fl-input" required>
                        <option value="" disabled <?= !old('kategori_id') ? 'selected' : '' ?>></option>
                        <?php foreach ($kategori as $k): ?>
                        <option value="<?= $k['id'] ?>" <?= old('kategori_id') == $k['id'] ? 'selected' : '' ?>>
                            <?= esc($k['nama_kategori']) ?>
                        </option>
                        <?php endforeach; ?>
                    </select>
                    <label for="kategori_id" class="fl-label">Kategori <span class="req">*</span></label>
                    <svg class="fl-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                              d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A2 2 0 013 12V7a4 4 0 014-4z"/>
                    </svg>
                </div>

                <div class="fl-group">
                    <select name="unit_id" id="unit_id" class="fl-input" required>
                        <option value="" disabled <?= !old('unit_id') ? 'selected' : '' ?>></option>
                        <?php foreach ($unit as $u): ?>
                        <option value="<?= $u['id'] ?>" <?= old('unit_id') == $u['id'] ? 'selected' : '' ?>>
                            <?= esc($u['nama_unit']) ?>
                        </option>
                        <?php endforeach; ?>
                    </select>
                    <label for="unit_id" class="fl-label">Unit Kerja <span class="req">*</span></label>
                    <svg class="fl-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                              d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                    </svg>
                </div>
            </div>

            <!-- Tanggal -->
            <div class="fl-group mb-4">
                <input type="date" name="tanggal" id="tanggal"
                       value="<?= old('tanggal', date('Y-m-d')) ?>"
                       class="fl-input" required>
                <label for="tanggal" class="fl-label">Tanggal Dokumen <span class="req">*</span></label>
                <svg class="fl-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                          d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                </svg>
            </div>

            <!-- Deskripsi -->
            <div class="fl-group is-textarea">
                <textarea name="deskripsi" id="deskripsi" rows="5"
                          placeholder="Deskripsi Dokumen"
                          class="fl-input"><?= old('deskripsi') ?></textarea>
                <label for="deskripsi" class="fl-label">Deskripsi</label>
                <svg class="fl-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                          d="M4 6h16M4 10h16M4 14h10"/>
                </svg>
            </div>
        </div><!-- /left -->

        <!-- ════ RIGHT PANEL ════ -->
        <div class="flex flex-col gap-4">

            <!-- Upload card -->
            <div class="glass-card static-card" style="padding: 24px; border-radius: 14px">
                <div class="sec-sep"><div class="sec-sep-line" style="background:var(--primary)"></div><span>File Dokumen</span></div>

                <div class="upload-zone" id="uploadZone">
                    <input type="file" name="file_dokumen" id="file_dokumen"
                           accept=".pdf,.doc,.docx,.xls,.xlsx,.csv" required>
                    <div class="upload-ring" id="uploadRing">
                        <svg class="w-6 h-6" style="color:var(--dim)" fill="none" stroke="currentColor" viewBox="0 0 24 24" id="uploadIcon">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.7"
                                  d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/>
                        </svg>
                    </div>
                    <p class="text-sm font-bold font-kalam mb-0.5" style="color:var(--txt)">Seret file ke sini</p>
                    <p class="text-[10px]" style="color:var(--muted)">
                        atau <span class="fon                    <div class="file-pill" id="filePill">
                        <svg class="w-3 h-3 shrink-0" style="color:var(--primary)" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/>
                        </svg>
                        <span id="fileName">—</span>
                    </div>
                </div>

                <!-- File Preview Container (PDF & Word DOCX) -->
                <div id="pdfPreviewContainer" style="display:none; margin-top: 15px; border: 1.5px solid rgba(61,64,91,0.15); border-radius: 10px; overflow: hidden; height: 650px; position: relative; animation: pop-in 0.28s cubic-bezier(0.34,1.56,0.64,1);">
                    <div style="display: flex; justify-content: space-between; align-items: center; background: #f2e8cf; padding: 6px 12px; border-bottom: 1.5px solid rgba(61,64,91,0.15); z-index: 10; position: relative;">
                        <span id="previewTitle" style="font-family: 'Kalam', cursive; font-size: 11px; font-weight: 700; color: var(--txt);">Pratinjau File</span>
                        <button type="button" id="removePdfPreview" style="color: var(--secondary); font-size: 10px; font-weight: bold; cursor: pointer; border: none; background: transparent;">Hapus</button>
                    </div>
                    <!-- Frame untuk PDF -->
                    <iframe id="pdfPreviewFrame" src="" style="width: 100%; height: calc(100% - 30px); border: none; display: none;"></iframe>
                    <!-- Container untuk merender DOCX -->
                    <div id="docxPreviewDiv" style="width: 100%; height: calc(100% - 30px); overflow: auto; background: white; padding: 15px; display: none;"></div>
                </div>

                <!-- Tips -->
                <div class="mt-4 space-y-2">
                    <div class="tip-row">
                        <div class="tip-row-icon" style="background:rgba(132,169,140,0.12)">
                            <svg class="w-3.5 h-3.5" style="color:var(--primary)" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                        </div>
                        <div>
                            <p class="text-[10px] font-bold font-kalam uppercase tracking-wide" style="color:var(--txt)">Format Didukung</p>
                            <p class="text-[10px] leading-relaxed" style="color:var(--muted)">PDF, Word, Excel, CSV · Maks 10 MB per file</p>
                        </div>
                    </div>
                    <div class="tip-row">
                        <div class="tip-row-icon" style="background:rgba(224,122,95,0.1)">
                            <svg class="w-3.5 h-3.5" style="color:var(--secondary)" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                            </svg>
                        </div>
                        <div>
                            <p class="text-[10px] font-bold font-kalam uppercase tracking-wide" style="color:var(--txt)">Akses Terkontrol</p>
                            <p class="text-[10px] leading-relaxed" style="color:var(--muted)">Dokumen hanya dapat diakses sesuai izin yang berlaku.</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Action buttons -->
            <div class="flex flex-col gap-2.5  ">
                <button type="submit" class="btn-upload mb-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2"
                              d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/>
                    </svg>
                    Unggah Dokumen
                </button>
                <a href="<?= base_url('admin/dokumen') ?>" class="btn-cancel">
                    Batal
                </a>
            </div>
        </div><!-- /right -->

    </div>
</form>

<script>
(() => {
    const parseCSVToHTML = (csvText) => {
        const lines = csvText.split(/\r?\n/).filter(line => line.trim() !== '');
        if (lines.length === 0) return '<p class="text-xs text-gray-500 text-center">Berkas CSV kosong.</p>';
        
        let html = '<div class="overflow-x-auto" style="max-height: 550px;"><table style="width: 100%; border-collapse: collapse; font-family: sans-serif; font-size: 11px; color: var(--txt); border: 2.5px solid var(--txt); box-shadow: 3px 3px 0 var(--txt);">';
        
        lines.forEach((line, index) => {
            const matches = line.match(/(".*?"|[^",\s]+)(?=\s*,|\s*$)/g) || line.split(',');
            const cells = matches.map(cell => cell.replace(/^"|"$/g, '').trim());
            
            const cellTag = index === 0 ? 'th' : 'td';
            const cellStyle = index === 0 
                ? 'background: var(--primary); color: #fffcf2; font-weight: bold; border: 1.5px solid var(--txt); padding: 8px 10px; text-align: left; position: sticky; top: 0;' 
                : 'border: 1.5px solid var(--txt); padding: 8px 10px; background: ' + (index % 2 === 0 ? '#f2e8cf' : '#fffcf2') + ';';
                
            html += '<tr>';
            cells.forEach(cell => {
                html += `<${cellTag} style="${cellStyle}">${cell}</${cellTag}>`;
            });
            html += '</tr>';
        });
        
        html += '</table></div>';
        return html;
    };
    gsap.fromTo('.page-intro',  { y:-14, opacity:0 }, { y:0, opacity:1, duration:.38, ease:'power3.out' });
    gsap.fromTo('.glass-card',  { y:18,  opacity:0 }, { y:0, opacity:1, duration:.42, stagger:.06, ease:'power3.out', delay:.05 });

    /* File upload */
    const zone   = document.getElementById('uploadZone');
    const input  = document.getElementById('file_dokumen');
    const pill   = document.getElementById('filePill');
    const nameEl = document.getElementById('fileName');
    const ring   = document.getElementById('uploadRing');
    const icon   = document.getElementById('uploadIcon');

    /* Preview elements */
    const previewContainer = document.getElementById('pdfPreviewContainer');
    const previewFrame = document.getElementById('pdfPreviewFrame');
    const docxPreviewDiv = document.getElementById('docxPreviewDiv');
    const removePreviewBtn = document.getElementById('removePdfPreview');
    const previewTitle = document.getElementById('previewTitle');

    const setFile = file => {
        nameEl.textContent = file.name;
        pill.classList.add('on');
        ring.style.cssText += ';border-color:var(--primary);border-style:solid;background:rgba(132,169,140,0.15)';
        icon.style.color = 'var(--primary)';

        const isPdf = file.type === 'application/pdf' || file.name.toLowerCase().endsWith('.pdf');
        const isDocx = file.name.toLowerCase().endsWith('.docx');
        const isCsv = file.name.toLowerCase().endsWith('.csv');

        // Reset previous preview content
        previewFrame.src = '';
        previewFrame.style.display = 'none';
        docxPreviewDiv.innerHTML = '';
        docxPreviewDiv.style.display = 'none';
        previewContainer.style.display = 'none';

        if (isPdf) {
            const objectUrl = URL.createObjectURL(file);
            previewFrame.src = objectUrl;
            previewFrame.style.display = 'block';
            if (previewTitle) previewTitle.textContent = "Pratinjau PDF";
            previewContainer.style.display = 'block';
        } else if (isDocx) {
            if (previewTitle) previewTitle.textContent = "Pratinjau Word (DOCX)";
            previewContainer.style.display = 'block';
            docxPreviewDiv.style.display = 'block';
            docxPreviewDiv.innerHTML = '<p class="text-xs text-gray-500 font-bold p-4 text-center">Memuat pratinjau dokumen...</p>';
            
            if (typeof docx !== 'undefined') {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const arrayBuffer = e.target.result;
                    docx.renderAsync(arrayBuffer, docxPreviewDiv)
                        .catch(err => {
                            docxPreviewDiv.innerHTML = '<p class="text-xs text-red-500 font-bold p-4 text-center">Gagal merender DOCX: ' + err.message + '</p>';
                        });
                };
                reader.readAsArrayBuffer(file);
            } else {
                docxPreviewDiv.innerHTML = '<p class="text-xs text-amber-600 font-bold p-4 text-center">Sistem pratinjau Word sedang dimuat...</p>';
            }
        } else if (isCsv) {
            if (previewTitle) previewTitle.textContent = "Pratinjau CSV";
            previewContainer.style.display = 'block';
            docxPreviewDiv.style.display = 'block';
            docxPreviewDiv.innerHTML = '<p class="text-xs text-gray-500 font-bold p-4 text-center">Memuat data CSV...</p>';

            const reader = new FileReader();
            reader.onload = function(e) {
                const text = e.target.result;
                docxPreviewDiv.innerHTML = parseCSVToHTML(text);
            };
            reader.readAsText(file);
        }
    };

    if (removePreviewBtn) {
        removePreviewBtn.addEventListener('click', () => {
            input.value = '';
            pill.classList.remove('on');
            ring.style.cssText = '';
            icon.style.color = 'rgba(181,176,161,0.9)';
            previewFrame.src = '';
            previewFrame.style.display = 'none';
            docxPreviewDiv.innerHTML = '';
            docxPreviewDiv.style.display = 'none';
            previewContainer.style.display = 'none';
        });
    }

    input.addEventListener('change', () => {
        if (input.files[0]) setFile(input.files[0]);
    });
    zone.addEventListener('dragover',  e => { e.preventDefault(); zone.classList.add('drag-over'); });
    zone.addEventListener('dragleave', () => zone.classList.remove('drag-over'));
    zone.addEventListener('drop', e => {
        e.preventDefault(); zone.classList.remove('drag-over');
        if (e.dataTransfer.files[0]) { input.files = e.dataTransfer.files; setFile(e.dataTransfer.files[0]); }
    });
})();
</script>
<?= $this->endSection() ?>

