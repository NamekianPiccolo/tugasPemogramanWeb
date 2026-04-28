<?= view('Backend/Template/header') ?>
<?= view('Backend/Template/sidebar') ?>

<div class="mb-8">
    <h1 class="text-3xl font-bold text-white tracking-wide">Catat Distribusi Baru</h1>
    <p class="text-gray-300 mt-2">Silakan isi form di bawah ini untuk mencatat sirkulasi peminjaman dokumen.</p>
</div>

<div class="max-w-4xl bg-white/10 backdrop-blur-lg border border-white/20 rounded-2xl shadow-2xl p-8">
    <form action="<?= base_url(session()->get('role') . '/distribusi/store') ?>" method="post" class="grid grid-cols-1 md:grid-cols-2 gap-6">
        
        <div class="md:col-span-2">
            <label class="block text-gray-300 text-sm font-semibold mb-2">Pilih Dokumen</label>
            <select name="dokumen_id" class="w-full bg-[#0f172a]/80 border border-white/10 rounded-xl px-4 py-3 text-white focus:outline-none focus:ring-2 focus:ring-brand-500 transition-all" required>
                <option value="" class="bg-gray-900 text-gray-400">-- Pilih Dokumen --</option>
                <?php foreach($dokumen as $d): ?>
                    <option value="<?= $d['id'] ?>" class="bg-gray-800 text-white" <?= (isset($selected_dokumen) && $selected_dokumen == $d['id']) ? 'selected' : '' ?>><?= esc($d['judul']) ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="md:col-span-2">
            <label class="block text-gray-300 text-sm font-semibold mb-2">Peminjam / Tujuan Distribusi</label>
            <input type="text" name="peminjam" class="w-full bg-[#0f172a]/50 border border-white/10 rounded-xl px-4 py-3 text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-brand-500 transition-all" required>
        </div>

        <div>
            <label class="block text-gray-300 text-sm font-semibold mb-2">Tanggal Pinjam / Distribusi</label>
            <input type="date" name="tanggal_pinjam" value="<?= date('Y-m-d') ?>" class="w-full bg-[#0f172a]/50 border border-white/10 rounded-xl px-4 py-3 text-white focus:outline-none focus:ring-2 focus:ring-brand-500 transition-all" required>
        </div>

        <div>
            <label class="block text-gray-300 text-sm font-semibold mb-2">Tanggal Kembali (Opsional)</label>
            <input type="date" name="tanggal_kembali" class="w-full bg-[#0f172a]/50 border border-white/10 rounded-xl px-4 py-3 text-white focus:outline-none focus:ring-2 focus:ring-brand-500 transition-all">
        </div>

        <div class="md:col-span-2">
            <label class="block text-gray-300 text-sm font-semibold mb-2">Status</label>
            <select name="status" class="w-full bg-[#0f172a]/80 border border-white/10 rounded-xl px-4 py-3 text-white focus:outline-none focus:ring-2 focus:ring-brand-500 transition-all" required>
                <option value="Dipinjam" class="bg-gray-800">Dipinjam</option>
                <option value="Dikembalikan" class="bg-gray-800">Dikembalikan</option>
                <option value="Selesai" class="bg-gray-800">Selesai (Hak Milik)</option>
            </select>
        </div>
        
        <div class="md:col-span-2 flex gap-4 pt-4 border-t border-white/10">
            <button type="submit" class="bg-brand-500 hover:bg-brand-600 text-white px-6 py-3 rounded-xl font-medium shadow-lg shadow-brand-500/30 transition-all">
                Simpan Data
            </button>
            <a href="<?= base_url(session()->get('role') . '/distribusi') ?>" class="bg-white/10 hover:bg-white/20 text-white px-6 py-3 rounded-xl font-medium transition-all">
                Batal
            </a>
        </div>
    </form>
</div>

<?= view('Backend/Template/footer') ?>
