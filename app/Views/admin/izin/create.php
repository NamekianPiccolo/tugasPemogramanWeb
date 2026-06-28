<?= $this->extend('admin/layout') ?>
<?= $this->section('content') ?>

<style>
    .fl-group {
        position: relative
    }

    .fl-input {
        display: block;
        width: 100%;
        height: 56px;
        padding: 20px 16px 6px 46px;
        font-size: 13.5px;
        color: var(--txt);
        background: rgba(255, 252, 242, 0.6);
        border: 1.5px solid rgba(61, 64, 91, 0.16);
        border-radius: 10px;
        outline: none;
        transition: border-color .2s ease, box-shadow .2s ease, background .2s ease;
        appearance: none;
        line-height: 1
    }

    textarea.fl-input {
        height: auto;
        padding-top: 26px;
        padding-bottom: 10px;
        resize: none;
        line-height: 1.55
    }

    .fl-input::placeholder {
        color: transparent;
        user-select: none
    }

    .fl-label {
        position: absolute;
        left: 46px;
        top: 50%;
        transform: translateY(-50%);
        font-size: 13px;
        color: rgba(138, 129, 124, .85);
        pointer-events: none;
        transition: all .2s cubic-bezier(.4, 0, .2, 1);
        transform-origin: left center;
        white-space: nowrap
    }

    .fl-group.is-textarea .fl-label {
        top: 18px;
        transform: none
    }

    .fl-input:focus~.fl-label,
    .fl-input:not(:placeholder-shown)~.fl-label {
        top: 10px;
        transform: translateY(0) scale(.73);
        color: var(--primary);
        font-family: 'Kalam', cursive;
        font-weight: 700;
        letter-spacing: .3px
    }

    .fl-group.is-textarea .fl-input:focus~.fl-label,
    .fl-group.is-textarea .fl-input:not(:placeholder-shown)~.fl-label {
        top: 8px;
        transform: scale(.73);
        transform-origin: left top;
        color: var(--primary);
        font-family: 'Kalam', cursive;
        font-weight: 700
    }

    .fl-input:focus {
        border-color: var(--primary);
        background: #fff;
        box-shadow: 0 0 0 3px rgba(132, 169, 140, .16), 0 1px 3px rgba(61, 64, 91, .06)
    }

    .fl-icon {
        position: absolute;
        left: 15px;
        top: 50%;
        transform: translateY(-50%);
        width: 17px;
        height: 17px;
        color: rgba(181, 176, 161, .9);
        pointer-events: none;
        transition: color .2s ease;
        z-index: 2
    }

    .fl-group.is-textarea .fl-icon {
        top: 18px;
        transform: none
    }

    .fl-group:focus-within .fl-icon {
        color: var(--primary)
    }

    select.fl-input {
        cursor: pointer;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke='%23b5b0a1'%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' stroke-width='2.2' d='M19 9l-7 7-7-7'/%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: right 14px center;
        background-size: 14px;
        padding-right: 42px !important
    }

    select.fl-input~.fl-label {
        top: 10px;
        transform: translateY(0) scale(.73);
        font-family: 'Kalam', cursive;
        font-weight: 700;
        color: rgba(138, 129, 124, .8)
    }

    select.fl-input:focus~.fl-label {
        color: var(--primary)
    }

    .sec-sep {
        display: flex;
        align-items: center;
        gap: 8px;
        margin-bottom: 20px
    }

    .sec-sep-line {
        width: 3px;
        height: 14px;
        border-radius: 2px;
        flex-shrink: 0;
        background: var(--secondary)
    }

    .sec-sep span {
        font-family: 'Kalam', cursive;
        font-size: 11px;
        font-weight: 700;
        letter-spacing: 1.8px;
        text-transform: uppercase;
        color: var(--muted);
        white-space: nowrap
    }

    .sec-sep::after {
        content: '';
        flex: 1;
        height: 1px;
        background: linear-gradient(to right, rgba(61, 64, 91, .1), transparent)
    }

    .static-card {
        transition: box-shadow .2s ease !important
    }

    .static-card:hover {
        transform: none !important;
        box-shadow: 3px 3px 0px rgba(61, 64, 91, .15) !important
    }

    .btn-save {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        width: 100%;
        padding: 13px;
        font-family: 'Kalam', cursive;
        font-size: 14px;
        font-weight: 700;
        letter-spacing: .5px;
        border-radius: 11px;
        cursor: pointer;
        background: var(--primary);
        color: #fffcf2;
        border: 2px solid var(--txt);
        box-shadow: 3px 3px 0 var(--txt);
        transition: all .18s ease
    }

    .btn-save:hover {
        transform: translate(-1px, -1px);
        box-shadow: 4px 4px 0 var(--txt)
    }

    .btn-cancel {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 100%;
        padding: 10px;
        font-family: 'Kalam', cursive;
        font-size: 13px;
        font-weight: 700;
        border-radius: 11px;
        cursor: pointer;
        background: transparent;
        color: var(--muted);
        border: 1.5px solid rgba(61, 64, 91, .15);
        transition: all .18s ease
    }

    .btn-cancel:hover {
        border-color: var(--txt);
        color: var(--txt)
    }

    .req {
        color: var(--secondary);
        margin-left: 1px
    }
</style>

<!-- Header -->
<div class="mb-5 page-intro flex items-center justify-between">
    <div>
        <div class="flex items-center gap-2 mb-1">
            <div class="w-1 h-4 rounded-full" style="background:linear-gradient(180deg,#F59E0B,#EC4899)"></div>
            <span class="text-[9px] font-bold uppercase tracking-widest" style="color:rgba(245,158,11,.6)">Access Control</span>
        </div>
        <h1 class="text-xl font-bold grad-violet mb-0.5">Ajukan Izin Akses Berkas</h1>
        <p class="text-xs" style="color:var(--muted)">Pilih dokumen yang ingin diakses dan berikan alasan pengajuan izin Anda.</p>
    </div>
    <a href="<?= base_url('karyawan/izin') ?>" class="btn-cancel shrink-0 px-4 py-2 text-xs" style="width:auto;border-radius:8px">← Kembali</a>
</div>

<?php if (session()->getFlashdata('error')): ?>
    <div class="mb-4 px-4 py-3 rounded-xl flex items-center gap-2.5 text-xs" style="background:rgba(224,122,95,.1);border:1.5px solid rgba(224,122,95,.25);color:var(--txt)">
        <svg class="w-4 h-4 shrink-0" style="color:var(--secondary)" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z" />
        </svg>
        <span class="font-kalam font-bold"><?= session()->getFlashdata('error') ?></span>
    </div>
<?php endif; ?>

<form action="<?= base_url('karyawan/izin/store') ?>" method="POST">
    <?= csrf_field() ?>
    <div class="grid gap-5" style="grid-template-columns:3fr 2fr;align-items:start">

        <!-- Left -->
        <div class="glass-card static-card" style="padding:28px 32px;border-radius:14px">
            <div class="sec-sep">
                <div class="sec-sep-line"></div><span>Detail Pengajuan</span>
            </div>

            <div class="fl-group mb-4">
                <select name="dokumen_id" id="dokumen_id" class="fl-input" required>
                    <option value="" disabled selected></option>
                    <?php foreach ($dokumen as $d): ?>
                        <option value="<?= $d['id'] ?>"><?= esc($d['judul']) ?></option>
                    <?php endforeach; ?>
                </select>
                <label for="dokumen_id" class="fl-label">Pilih Dokumen yang Ingin Diakses <span class="req">*</span></label>
                <svg class="fl-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
            </div>

            <div class="fl-group is-textarea">
                <textarea name="pesan" id="pesan" rows="5" placeholder="Alasan Pengajuan" class="fl-input" required maxlength="200"></textarea>
                <label for="pesan" class="fl-label">Alasan / Pesan Pengajuan <span class="req">*</span></label>
                <svg class="fl-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
                </svg>
            </div>
            <div class="text-right mt-1.5">
                <span id="pesanCounter" class="text-[10px] font-bold font-kalam" style="color:var(--muted)">0 / 200 karakter</span>
            </div>
        </div>

        <!-- Right -->
        <div class="flex flex-col gap-4">
            <div class="glass-card static-card p-5" style="border-radius:14px">
                <div class="sec-sep">
                    <div class="sec-sep-line" style="background:var(--primary)"></div><span>Info Pengajuan</span>
                </div>
                <div class="space-y-3 text-xs" style="color:var(--muted);line-height:1.7">
                    <p>🔐 Pengajuan izin akan ditinjau oleh admin sebelum disetujui.</p>
                    <p>📝 Berikan alasan yang jelas agar proses persetujuan lebih cepat.</p>
                    <p>⏳ Anda dapat memantau status pengajuan di halaman Izin Akses.</p>
                </div>
            </div>
            <div class="flex flex-col gap-2.5">
                <button type="submit" class="btn-save">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" />
                    </svg>
                    Kirim Pengajuan
                </button>
                <a href="<?= base_url('karyawan/izin') ?>" class="btn-cancel">Batal</a>
            </div>
        </div>
    </div>
</form>

<script>
    (() => {
        gsap.fromTo('.page-intro', {
            y: -14,
            opacity: 0
        }, {
            y: 0,
            opacity: 1,
            duration: .38,
            ease: 'power3.out'
        });
        gsap.fromTo('.glass-card', {
            y: 18,
            opacity: 0
        }, {
            y: 0,
            opacity: 1,
            duration: .42,
            stagger: .06,
            ease: 'power3.out',
            delay: .05
        });

        const pesanInput = document.getElementById('pesan');
        if (pesanInput) {
            pesanInput.addEventListener('input', () => {
                const count = pesanInput.value.length;
                const counter = document.getElementById('pesanCounter');
                if (counter) counter.textContent = `${count} / 200 karakter`;
            });
        }
    })();
</script>
<?= $this->endSection() ?>