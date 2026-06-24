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
select.fl-input{cursor:pointer;background-image:url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke='%23b5b0a1'%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' stroke-width='2.2' d='M19 9l-7 7-7-7'/%3E%3C/svg%3E");background-repeat:no-repeat;background-position:right 14px center;background-size:14px;padding-right:42px!important}
select.fl-input~.fl-label{top:10px;transform:translateY(0) scale(.73);font-family:'Kalam',cursive;font-weight:700;color:rgba(138,129,124,.8)}
select.fl-input:focus~.fl-label{color:var(--primary)}
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
/* Password toggle */
.pwd-wrap{position:relative}
.pwd-toggle{position:absolute;right:14px;top:50%;transform:translateY(-50%);cursor:pointer;color:rgba(181,176,161,.9);border:none;background:transparent;padding:0;line-height:0;transition:color .15s ease}
.pwd-toggle:hover{color:var(--primary)}
/* Error list */
.err-list li{display:flex;align-items:flex-start;gap:6px;font-size:12px;color:var(--txt)}
</style>

<!-- Header -->
<div class="mb-5 page-intro flex items-center justify-between">
    <div>
        <div class="flex items-center gap-2 mb-1">
            <div class="w-1 h-4 rounded-full" style="background:linear-gradient(180deg,#06B6D4,#EC4899)"></div>
            <span class="text-[9px] font-bold uppercase tracking-widest" style="color:rgba(6,182,212,.6)">Akses & Identitas</span>
        </div>
        <h1 class="text-xl font-bold grad-violet mb-0.5">Tambah Pengguna Baru</h1>
        <p class="text-xs" style="color:var(--muted)">Buat akun baru untuk admin atau karyawan yang akan menggunakan sistem.</p>
    </div>
    <a href="<?= base_url('admin/user') ?>" class="btn-cancel shrink-0 px-4 py-2 text-xs" style="width:auto;border-radius:8px">← Kembali</a>
</div>

<?php if (session()->has('errors')): ?>
<div class="mb-4 px-4 py-3 rounded-xl" style="background:rgba(224,122,95,.08);border:1.5px solid rgba(224,122,95,.25)">
    <p class="text-[10px] font-bold font-kalam uppercase tracking-widest mb-2" style="color:var(--secondary)">Validasi Gagal</p>
    <ul class="err-list space-y-1">
        <?php foreach (session('errors') as $e): ?>
        <li><span style="color:var(--secondary);margin-top:1px">•</span><span><?= esc($e) ?></span></li>
        <?php endforeach; ?>
    </ul>
</div>
<?php endif; ?>

<form action="<?= base_url('admin/user/store') ?>" method="POST">
    <?= csrf_field() ?>
    <div class="grid gap-5" style="grid-template-columns:3fr 2fr;align-items:start">

        <!-- Left -->
        <div class="glass-card static-card" style="padding:28px 32px;border-radius:14px">
            <div class="sec-sep"><div class="sec-sep-line"></div><span>Identitas Pengguna</span></div>

            <!-- Nama + Username -->
            <div class="grid grid-cols-2 gap-4 mb-4">
                <div class="fl-group">
                    <input type="text" name="nama_lengkap" id="nama_lengkap" value="<?= old('nama_lengkap') ?>" placeholder="Nama Lengkap" class="fl-input" required>
                    <label for="nama_lengkap" class="fl-label">Nama Lengkap <span class="req">*</span></label>
                    <svg class="fl-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                </div>
                <div class="fl-group">
                    <input type="text" name="username" id="username" value="<?= old('username') ?>" placeholder="Username" class="fl-input" required>
                    <label for="username" class="fl-label">Username <span class="req">*</span></label>
                    <svg class="fl-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
            </div>

            <!-- Email -->
            <div class="fl-group mb-4">
                <input type="email" name="email" id="email" value="<?= old('email') ?>" placeholder="Email" class="fl-input" required>
                <label for="email" class="fl-label">Email <span class="req">*</span></label>
                <svg class="fl-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
            </div>

            <!-- Password + Role -->
            <div class="grid grid-cols-2 gap-4">
                <div class="fl-group pwd-wrap">
                    <input type="password" name="password" id="password" placeholder="Password" class="fl-input" required style="padding-right:44px!important">
                    <label for="password" class="fl-label">Password <span class="req">*</span></label>
                    <svg class="fl-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                    <button type="button" class="pwd-toggle" id="pwdToggle" title="Tampilkan password">
                        <svg id="eyeIcon" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                    </button>
                </div>
                <div class="fl-group">
                    <select name="role" id="role" class="fl-input" required>
                        <option value="" disabled <?= !old('role') ? 'selected' : '' ?>></option>
                        <option value="admin" <?= old('role')==='admin'?'selected':'' ?>>Admin</option>
                        <option value="karyawan" <?= old('role')==='karyawan'?'selected':'' ?>>Karyawan</option>
                    </select>
                    <label for="role" class="fl-label">Role <span class="req">*</span></label>
                    <svg class="fl-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                </div>
            </div>
        </div>

        <!-- Right -->
        <div class="flex flex-col gap-4">
            <div class="glass-card static-card p-5" style="border-radius:14px">
                <div class="sec-sep"><div class="sec-sep-line" style="background:var(--primary)"></div><span>Panduan Akun</span></div>
                <div class="space-y-3 text-xs" style="color:var(--muted);line-height:1.7">
                    <p>👤 <strong style="color:var(--txt)">Admin</strong> — Memiliki akses penuh ke seluruh fitur sistem termasuk manajemen pengguna.</p>
                    <p>👷 <strong style="color:var(--txt)">Karyawan</strong> — Hanya dapat melihat dokumen yang diizinkan dan mengajukan permohonan akses.</p>
                    <p>🔒 Password minimal 6 karakter. Pengguna dapat mengubahnya setelah login.</p>
                </div>
            </div>
            <div class="flex flex-col gap-2.5">
                <button type="submit" class="btn-save mb-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/></svg>
                    Buat Akun
                </button>
                <a href="<?= base_url('admin/user') ?>" class="btn-cancel">Batal</a>
            </div>
        </div>
    </div>
</form>

<script>
(() => {
    gsap.fromTo('.page-intro',{y:-14,opacity:0},{y:0,opacity:1,duration:.38,ease:'power3.out'});
    gsap.fromTo('.glass-card',{y:18,opacity:0},{y:0,opacity:1,duration:.42,stagger:.06,ease:'power3.out',delay:.05});

    // Password toggle
    const pwdField  = document.getElementById('password');
    const pwdToggle = document.getElementById('pwdToggle');
    const eyeIcon   = document.getElementById('eyeIcon');
    const eyeSlash  = `<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/>`;
    const eyeOpen   = `<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>`;
    let visible = false;
    pwdToggle.addEventListener('click', () => {
        visible = !visible;
        pwdField.type = visible ? 'text' : 'password';
        eyeIcon.innerHTML = visible ? eyeSlash : eyeOpen;
    });
})();
</script>
<?= $this->endSection() ?>
