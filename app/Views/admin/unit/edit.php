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
</style>

<div class="mb-5 page-intro flex items-center justify-between">
    <div>
        <div class="flex items-center gap-2 mb-1">
            <div class="w-1 h-4 rounded-full" style="background:linear-gradient(180deg,#8B5CF6,#10B981)"></div>
            <span class="text-[9px] font-bold uppercase tracking-widest" style="color:rgba(139,92,246,.6)">Struktur Organisasi</span>
        </div>
        <h1 class="text-xl font-bold grad-violet mb-0.5">Edit Unit Kerja</h1>
        <p class="text-xs" style="color:var(--muted)">Perbarui nama atau informasi unit kerja yang sudah ada.</p>
    </div>
    <a href="<?= base_url('admin/unit') ?>" class="btn-cancel shrink-0 px-4 py-2 text-xs" style="width:auto;border-radius:8px">← Kembali</a>
</div>

<form action="<?= base_url('admin/unit/update/' . $unit['id']) ?>" method="POST">
    <?= csrf_field() ?>
    <div class="grid gap-5" style="grid-template-columns:3fr 2fr;align-items:start">
        <div class="glass-card static-card" style="padding:28px 32px;border-radius:14px">
            <div class="sec-sep"><div class="sec-sep-line"></div><span>Detail Unit</span></div>
            <div class="fl-group">
                <input type="text" name="nama_unit" id="nama_unit"
                       value="<?= old('nama_unit', $unit['nama_unit']) ?>"
                       placeholder="Nama Unit / Divisi" class="fl-input" required>
                <label for="nama_unit" class="fl-label">Nama Unit / Divisi <span style="color:var(--secondary)">*</span></label>
                <svg class="fl-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
            </div>
        </div>
        <div class="flex flex-col gap-4">
            <div class="glass-card static-card p-5" style="border-radius:14px">
                <div class="sec-sep"><div class="sec-sep-line" style="background:var(--primary)"></div><span>Tips</span></div>
                <div class="space-y-2 text-xs" style="color:var(--muted);line-height:1.7">
                    <p>🏢 Perubahan nama unit akan langsung berlaku untuk semua dokumen yang terdaftar di unit ini.</p>
                </div>
            </div>
            <div class="flex flex-col gap-2.5">
                <button type="submit" class="btn-save">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2" d="M5 13l4 4L19 7"/></svg>
                    Perbarui Unit
                </button>
                <a href="<?= base_url('admin/unit') ?>" class="btn-cancel">Batal</a>
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
