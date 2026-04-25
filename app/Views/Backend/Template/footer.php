        </div> <!-- End Content Area -->

        <!-- Footer -->
        <footer class="py-6 px-8 border-t border-white/5 bg-[#0f172a]/20 text-center text-sm text-gray-400 mt-auto">
            &copy; <?= date('Y') ?> Arsip Digital System. Desain Parallax Modern.
        </footer>
    </main> <!-- End Main Content Wrapper -->

    <!-- SweetAlert2 (for beautiful alerts) -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        // Auto-show sweetalert if there is flashdata
        <?php if(session()->getFlashdata('success')): ?>
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: '<?= session()->getFlashdata('success') ?>',
            background: 'rgba(15, 23, 42, 0.9)',
            color: '#fff',
            confirmButtonColor: '#10b981'
        });
        <?php endif; ?>
        
        <?php if(session()->getFlashdata('error')): ?>
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: '<?= session()->getFlashdata('error') ?>',
            background: 'rgba(15, 23, 42, 0.9)',
            color: '#fff',
            confirmButtonColor: '#ef4444'
        });
        <?php endif; ?>
    </script>
</body>
</html>