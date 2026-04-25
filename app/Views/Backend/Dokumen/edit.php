<?= view('Backend/Template/header') ?>
<?= view('Backend/Template/sidebar') ?>

<div class="mb-8">
    <h1 class="text-3xl font-bold text-white tracking-wide">Edit Dokumen</h1>
    <p class="text-gray-300 mt-2">Ubah informasi dokumen arsip Anda.</p>
</div>

<div class="max-w-4xl bg-white/10 backdrop-blur-lg border border-white/20 rounded-2xl shadow-2xl p-8">
    <form action="<?= base_url('admin/dokumen/update/' . $dokumen['id']) ?>" method="post" enctype="multipart/form-data" class="grid grid-cols-1 md:grid-cols-2 gap-6">
        
        <div class="md:col-span-2">
            <label class="block text-gray-300 text-sm font-semibold mb-2">Judul Dokumen</label>
            <input type="text" name="judul" value="<?= esc($dokumen['judul']) ?>" class="w-full bg-[#0f172a]/50 border border-white/10 rounded-xl px-4 py-3 text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-brand-500 transition-all" required>
        </div>

        <div>
            <label class="block text-gray-300 text-sm font-semibold mb-2">Kategori Dokumen</label>
            <select name="kategori_id" class="w-full bg-[#0f172a]/80 border border-white/10 rounded-xl px-4 py-3 text-white focus:outline-none focus:ring-2 focus:ring-brand-500 transition-all" required>
                <option value="" class="bg-gray-900 text-gray-400">-- Pilih Kategori --</option>
                <?php foreach($kategori as $k): ?>
                    <option value="<?= $k['id'] ?>" class="bg-gray-800 text-white" <?= $k['id'] == $dokumen['kategori_id'] ? 'selected' : '' ?>><?= esc($k['nama_kategori']) ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div>
            <label class="block text-gray-300 text-sm font-semibold mb-2">Unit / Bagian</label>
            <select name="unit_id" class="w-full bg-[#0f172a]/80 border border-white/10 rounded-xl px-4 py-3 text-white focus:outline-none focus:ring-2 focus:ring-brand-500 transition-all" required>
                <option value="" class="bg-gray-900 text-gray-400">-- Pilih Unit --</option>
                <?php foreach($unit as $u): ?>
                    <option value="<?= $u['id'] ?>" class="bg-gray-800 text-white" <?= $u['id'] == $dokumen['unit_id'] ? 'selected' : '' ?>><?= esc($u['nama_unit']) ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div>
            <label class="block text-gray-300 text-sm font-semibold mb-2">Tanggal Dokumen</label>
            <input type="date" name="tanggal" value="<?= esc($dokumen['tanggal']) ?>" class="w-full bg-[#0f172a]/50 border border-white/10 rounded-xl px-4 py-3 text-white focus:outline-none focus:ring-2 focus:ring-brand-500 transition-all" required>
        </div>

        <div>
            <label class="block text-gray-300 text-sm font-semibold mb-2">Ganti File Dokumen (Biarkan kosong jika tidak diubah)</label>
            <input type="file" name="file_dokumen" class="w-full bg-[#0f172a]/50 border border-white/10 rounded-xl px-4 py-2.5 text-gray-300 focus:outline-none focus:ring-2 focus:ring-brand-500 transition-all file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-brand-500/20 file:text-brand-400 hover:file:bg-brand-500/30">
            <?php if($dokumen['file_dokumen']): ?>
                <p class="text-xs text-brand-400 mt-2"><i class="fas fa-check-circle"></i> File saat ini: <?= esc($dokumen['file_dokumen']) ?></p>
            <?php endif; ?>
        </div>

        <div class="md:col-span-2">
            <label class="block text-gray-300 text-sm font-semibold mb-2">Deskripsi (Opsional)</label>
            <textarea name="deskripsi" rows="3" class="w-full bg-[#0f172a]/50 border border-white/10 rounded-xl px-4 py-3 text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-brand-500 transition-all"><?= esc($dokumen['deskripsi']) ?></textarea>
        </div>
        
        <div class="md:col-span-2 flex gap-4 pt-4 border-t border-white/10">
            <button type="submit" class="bg-brand-500 hover:bg-brand-600 text-white px-6 py-3 rounded-xl font-medium shadow-lg shadow-brand-500/30 transition-all">
                Simpan Perubahan
            </button>
            <a href="<?= base_url('admin/dokumen') ?>" class="bg-white/10 hover:bg-white/20 text-white px-6 py-3 rounded-xl font-medium transition-all">
                Batal
            </a>
        </div>
    </form>
</div>

<?= view('Backend/Template/footer') ?>
