<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Modern App</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;600;700&display=swap" rel="stylesheet">
    
    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
        .glass-effect {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
        }
    </style>
</head>
<body class="bg-slate-50 text-slate-900">

    <div class="min-h-screen flex flex-col items-center justify-center p-6">
        
        <div class="fixed top-0 -left-4 w-72 h-72 bg-purple-300 rounded-full mix-blend-multiply filter blur-xl opacity-70 animate-blob"></div>
        <div class="fixed top-0 -right-4 w-72 h-72 bg-yellow-200 rounded-full mix-blend-multiply filter blur-xl opacity-70 animate-blob animation-delay-2000"></div>
        <div class="fixed -bottom-8 left-20 w-72 h-72 bg-pink-300 rounded-full mix-blend-multiply filter blur-xl opacity-70 animate-blob animation-delay-4000"></div>

        <div class="relative w-full max-w-md">
            <div class="glass-effect rounded-3xl shadow-2xl border border-white p-10">
                
                <div class="text-center mb-10">
                    <div class="inline-flex items-center justify-center w-16 h-16 bg-gradient-to-tr from-indigo-600 to-purple-500 rounded-2xl shadow-lg mb-4 transform -rotate-6">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4  4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
                        </svg>
                    </div>
                    <h1 class="text-3xl font-extrabold tracking-tight text-slate-800">Masuk Kembali</h1>
                    <p class="text-slate-500 mt-2">Selamat datang! Silakan isi detail Anda.</p>
                </div>

                <?php if(session()->getFlashdata('error')): ?>
                    <div class="mb-6 p-4 bg-red-50 border border-red-100 rounded-xl flex items-center gap-3 text-red-600">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                        </svg>
                        <span class="text-sm font-medium"><?= session()->getFlashdata('error') ?></span>
                    </div>
                <?php endif; ?>

                <form action="<?= base_url('login/auth') ?>" method="POST" class="space-y-6">
                    <?= csrf_field() ?>

                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-2 ml-1">Email</label>
                        <input type="email" name="email" required
                            class="w-full px-5 py-4 bg-slate-100/50 border border-slate-200 rounded-2xl focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 focus:bg-white outline-none transition-all duration-300 placeholder:text-slate-400"
                            placeholder="nama@email.com">
                    </div>

                    <div>
                        <div class="flex justify-between items-center mb-2 ml-1">
                            <label class="text-sm font-semibold text-slate-700">Password</label>
                            <a href="#" class="text-xs font-bold text-indigo-600 hover:text-indigo-800 transition">Lupa?</a>
                        </div>
                        <input type="password" name="password" required
                            class="w-full px-5 py-4 bg-slate-100/50 border border-slate-200 rounded-2xl focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 focus:bg-white outline-none transition-all duration-300 placeholder:text-slate-400"
                            placeholder="••••••••">
                    </div>

                    <div class="flex items-center ml-1">
                        <input type="checkbox" id="remember" class="w-4 h-4 text-indigo-600 border-slate-300 rounded focus:ring-indigo-500">
                        <label for="remember" class="ml-2 text-sm text-slate-600 cursor-pointer">Ingat saya untuk 30 hari</label>
                    </div>

                    <button type="submit" 
                        class="w-full bg-slate-900 hover:bg-indigo-600 text-white font-bold py-4 rounded-2xl shadow-xl shadow-slate-200 transition-all duration-500 transform active:scale-[0.98]">
                        Masuk ke Akun
                    </button>
                </form>

                <div class="mt-10 text-center">
                    <p class="text-sm text-slate-500">
                        Belum punya akun? 
                        <a href="#" class="text-indigo-600 font-bold hover:text-indigo-800 transition underline underline-offset-4">Daftar sekarang</a>
                    </p>
                </div>
            </div>

            <div class="mt-8 text-center text-slate-400 text-xs tracking-widest uppercase">
                &copy; 2026 Modern App Inc.
            </div>
        </div>
    </div>

</body>
</html>