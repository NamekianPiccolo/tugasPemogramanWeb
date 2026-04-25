<?= view('Backend/Template/header') ?>
<?= view('Backend/Template/sidebar') ?>

<div class="mb-8">
    <h1 class="text-3xl font-bold text-white tracking-wide">Tambah Unit Baru</h1>
    <p class="text-gray-300 mt-2">Silakan isi form di bawah ini untuk menambahkan unit kerja.</p>
</div>

<div class="max-w-2xl bg-white/10 backdrop-blur-lg border border-white/20 rounded-2xl shadow-2xl p-8">
    <form action="<?= base_url('admin/unit/store') ?>" method="post">
        <div class="mb-6">
            <label class="block text-gray-300 text-sm font-semibold mb-2">Nama Unit / Bagian</label>
            <input type="text" name="nama_unit" class="w-full bg-[#0f172a]/50 border border-white/10 rounded-xl px-4 py-3 text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-brand-500 focus:border-transparent transition-all" placeholder="Misal: Keuangan" required autofocus>
        </div>
        
        <div class="flex gap-4 pt-4 border-t border-white/10">
            <button type="submit" class="bg-brand-500 hover:bg-brand-600 text-white px-6 py-3 rounded-xl font-medium shadow-lg shadow-brand-500/30 transition-all">
                Simpan Data
            </button>
            <a href="<?= base_url('admin/unit') ?>" class="bg-white/10 hover:bg-white/20 text-white px-6 py-3 rounded-xl font-medium transition-all">
                Batal
            </a>
        </div>
    </form>
</div>

<?= view('Backend/Template/footer') ?>
