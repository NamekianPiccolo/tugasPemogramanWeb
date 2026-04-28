<?= view('Backend/Template/header') ?>
<?= view('Backend/Template/sidebar') ?>
 
<div class="mb-8">
    <h1 class="text-3xl font-bold text-white tracking-wide">Dashboard Karyawan</h1>
    <p class="text-gray-300 mt-2">Selamat datang di sistem manajemen arsip dokumen.</p>
</div>
 
<div class="grid grid-cols-1 md:grid-cols-2 gap-8">
    <div class="bg-white/10 backdrop-blur-lg border border-white/20 rounded-2xl p-8 shadow-2xl">
        <h2 class="text-xl font-bold text-white mb-4">Akses Cepat</h2>
        <div class="grid grid-cols-2 gap-4">
            <a href="<?= base_url('karyawan/dokumen') ?>" class="bg-brand-500/20 border border-brand-500/30 p-6 rounded-xl hover:bg-brand-500/30 transition duration-300 flex flex-col items-center">
                <i class="fas fa-file-alt text-3xl text-brand-400 mb-3"></i>
                <span class="text-white font-semibold">Lihat Dokumen</span>
            </a>
            <div class="bg-blue-500/20 border border-blue-500/30 p-6 rounded-xl hover:bg-blue-500/30 transition duration-300 flex flex-col items-center opacity-50 cursor-not-allowed">
                <i class="fas fa-key text-3xl text-blue-400 mb-3"></i>
                <span class="text-white font-semibold">Izin Akses</span>
            </div>
        </div>
    </div>
 
    <div class="bg-white/10 backdrop-blur-lg border border-white/20 rounded-2xl p-8 shadow-2xl">
        <h2 class="text-xl font-bold text-white mb-4">Informasi Akun</h2>
        <div class="space-y-4">
            <div>
                <p class="text-gray-400 text-xs uppercase tracking-widest">Nama Lengkap</p>
                <p class="text-white text-lg font-medium"><?= esc(session()->get('nama_lengkap')) ?></p>
            </div>
            <div>
                <p class="text-gray-400 text-xs uppercase tracking-widest">Username</p>
                <p class="text-white text-lg font-medium"><?= esc(session()->get('username')) ?></p>
            </div>
            <div>
                <p class="text-gray-400 text-xs uppercase tracking-widest">Role</p>
                <span class="bg-brand-500/20 text-brand-400 border border-brand-500/30 px-3 py-1 rounded-full text-xs font-bold uppercase">
                    <?= esc(session()->get('role')) ?>
                </span>
            </div>
        </div>
    </div>
</div>
 
<?= view('Backend/Template/footer') ?>
