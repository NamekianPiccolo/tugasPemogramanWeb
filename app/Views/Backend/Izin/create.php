<?= view('Backend/Template/header') ?>
<?= view('Backend/Template/sidebar') ?>
 
<div class="mb-8 flex items-center justify-between">
    <div>
        <h1 class="text-3xl font-bold text-white tracking-wide">Ajukan Izin Akses</h1>
        <p class="text-gray-300 mt-2">Isi formulir di bawah untuk meminta akses ke dokumen tertentu.</p>
    </div>
    <a href="<?= base_url('karyawan/izin') ?>" class="text-gray-400 hover:text-white transition-colors">
        <i class="fas fa-arrow-left mr-2"></i> Kembali
    </a>
</div>
 
<div class="bg-white/10 backdrop-blur-lg border border-white/20 rounded-3xl shadow-2xl p-8 max-w-2xl">
    <form action="<?= base_url('karyawan/izin/store') ?>" method="POST" class="space-y-6">
        <?= csrf_field() ?>
        
        <div class="space-y-2">
            <label class="text-xs font-bold text-gray-400 uppercase tracking-widest ml-1">Pilih Dokumen</label>
            <select name="dokumen_id" class="w-full bg-black/20 border border-white/10 p-4 rounded-xl text-white focus:ring-2 focus:ring-brand-500 outline-none transition-all" required>
                <option value="" disabled selected>-- Pilih Dokumen --</option>
                <?php foreach ($dokumen as $d) : ?>
                    <option value="<?= $d['id'] ?>"><?= esc($d['judul']) ?></option>
                <?php endforeach; ?>
            </select>
        </div>
 
        <div class="space-y-2">
            <label class="text-xs font-bold text-gray-400 uppercase tracking-widest ml-1">Alasan Pengajuan</label>
            <textarea name="pesan" rows="4" placeholder="Jelaskan mengapa Anda membutuhkan akses ke dokumen ini..." class="w-full bg-black/20 border border-white/10 p-4 rounded-xl text-white focus:ring-2 focus:ring-brand-500 outline-none transition-all" required></textarea>
        </div>
 
        <button type="submit" class="w-full bg-brand-500 hover:bg-brand-600 text-white font-bold py-4 rounded-xl shadow-lg shadow-brand-500/20 transition-all transform hover:-translate-y-1">
            Kirim Pengajuan
        </button>
    </form>
</div>
 
<?= view('Backend/Template/footer') ?>
