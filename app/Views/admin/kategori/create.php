<?= $this->extend('admin/layout') ?>
<?= $this->section('content') ?>

<style>
.fl-group{position:relative}
.fl-input{display:block;width:100%;height:56px;padding:20px 16px 6px 46px;font-size:13.5px;color:var(--txt);background:rgba(255,252,242,0.6);border:1.5px solid rgba(61,64,91,0.16);border-radius:10px;outline:none;transition:border-color .2s ease,box-shadow .2s ease,background .2s ease;appearance:none;line-height:1}
.fl-input::placeholder{color:transparent;user-select:none}
.fl-label{position:absolute;left:46px;top:50%;transform:translateY(-50%);font-size:13px;color:rgba(138,129,124,.85);pointer-events:none;transition:all .2s cubic-bezier(.4,0,.2,1);transform-origin:left center;white-space:nowrap}
.fl-input:focus~.fl-label,.fl-input:not(:placeholder-shown)~.fl-label{top:10px;transform:translateY(0) scale(.73);color:var(--primary);font-family:'Kalam',cursive;font-weight:700;letter-spacing:.3px}
.fl-input:focus{border-color:var(--primary);background:#fff;box-shadow:0 0 0 3px rgba(132,169,140,.16),0 1px 3px rgba(61,64,91,.06)}
.fl-icon{position:absolute;left:15px;top:50%;transform:translateY(-50%);width:17px;height:17px;color:rgba(181,176,161,.9);pointer-events:none;transition:color .2s ease;z-index:2}
.fl-group:focus-within .fl-icon{color:var(--primary)}
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
            <div class="w-1 h-4 rounded-full" style="background:linear-gradient(180deg,#06B6D4,#10B981)"></div>
            <span class="text-[9px] font-bold uppercase tracking-widest" style="color:rgba(6,182,212,.6)">Sistem Klasifikasi</span>
        </div>
        <h1 class="text-xl font-bold grad-violet mb-0.5">Tambah Kategori</h1>
        <p class="text-xs" style="color:var(--muted)">Buat kategori baru untuk mengorganisir dokumen dalam sistem arsip.</p>
    </div>
    <a href="<?= base_url('admin/kategori') ?>" class="btn-cancel shrink-0 px-4 py-2 text-xs" style="width:auto;border-radius:8px">← Kembali</a>
</div>

<form action="<?= base_url('admin/kategori/store') ?>" method="POST">
    <?= csrf_field() ?>
    <div class="grid gap-5" style="grid-template-columns:3fr 2fr;align-items:start">

        <!-- Left -->
        <div class="glass-card static-card" style="padding:28px 32px;border-radius:14px">
            <div class="sec-sep"><div class="sec-sep-line"></div><span>Detail Kategori</span></div>

            <div class="fl-group">
                <input type="text" name="nama_kategori" id="nama_kategori"
                       value="<?= old('nama_kategori') ?>"
                       placeholder="Nama Kategori"
                       class="fl-input" required>
                <label for="nama_kategori" class="fl-label">Nama Kategori <span class="req">*</span></label>
                <svg class="fl-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A2 2 0 013 12V7a4 4 0 014-4z"/></svg>
            </div>
        </div>

        <!-- Right -->
        <div class="flex flex-col gap-4">
            <div class="glass-card static-card p-5" style="border-radius:14px">
                <div class="sec-sep"><div class="sec-sep-line" style="background:var(--primary)"></div><span>Tips</span></div>
                <div class="space-y-3 text-xs" style="color:var(--muted);line-height:1.7">
                    <p>🏷️ Gunakan nama yang spesifik dan mudah dipahami, misalnya "SOP Operasional" atau "Dokumen Keuangan".</p>
                    <p>📁 Kategori membantu pengguna menemukan dokumen dengan lebih cepat.</p>
                </div>
            </div>
            <div class="flex flex-col gap-2.5">
                <button type="submit" class="btn-save mb-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2" d="M5 13l4 4L19 7"/></svg>
                    Simpan Kategori
                </button>
                <a href="<?= base_url('admin/kategori') ?>" class="btn-cancel">Batal</a>
            </div>
        </div>
    </div>
</form>

<script>
(() => {
    gsap.fromTo('.page-intro',{y:-14,opacity:0},{y:0,opacity:1,duration:.38,ease:'power3.out'});
    gsap.fromTo('.glass-card',{y:18,opacity:0},{y:0,opacity:1,duration:.42,stagger:.06,ease:'power3.out',delay:.05});
})();
</script>
<?= $this->endSection() ?>
