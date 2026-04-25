<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="<?= base_url('css/output.css') ?>">
  <style>
    body { font-family: 'Poppins', sans-serif; }
    
    /* CSS Custom untuk pergeseran panel */
    .container-box.active .sign-in { transform: translateX(100%); opacity: 0; z-index: 1; }
    .container-box.active .sign-up { transform: translateX(100%); opacity: 1; z-index: 5; animation: move 0.6s; }
    .container-box.active .overlay-container { transform: translateX(-100%); }
    .container-box.active .overlay { transform: translateX(50%); }
    .container-box.active .overlay-left { transform: translateX(0); }
    .container-box.active .overlay-right { transform: translateX(20%); }

    @keyframes move {
      0%, 49.99% { opacity: 0; z-index: 1; }
      50%, 100% { opacity: 1; z-index: 5; }
    }
  </style>
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center p-4 overflow-hidden relative">

  <div class="absolute -top-24 -left-24 w-96 h-96 bg-[#0F6E56]/20 rounded-full blur-3xl animate-pulse"></div>
  <div class="absolute -bottom-24 -right-24 w-96 h-96 bg-[#1D9E75]/20 rounded-full blur-3xl animate-pulse"></div>

  <div id="mainContainer" class="container-box relative bg-white w-full max-w-[850px] min-h-[550px] rounded-[2.5rem] shadow-[0_30px_90px_-15px_rgba(0,0,0,0.15)] overflow-hidden flex transition-all duration-700 ease-in-out">
    
    <div class="sign-up absolute top-0 left-0 w-1/2 h-full flex flex-col items-center justify-center p-12 transition-all duration-700 ease-in-out opacity-0 z-[1]">
      <form class="w-full space-y-4">
        <h2 class="text-3xl font-bold text-[#085041] mb-2">Buat Akun</h2>
        <input type="text" placeholder="Nama Lengkap" class="w-full bg-gray-100 p-4 rounded-xl outline-none focus:ring-2 focus:ring-[#1D9E75]">
        <input type="email" placeholder="Email" class="w-full bg-gray-100 p-4 rounded-xl outline-none focus:ring-2 focus:ring-[#1D9E75]">
        <input type="password" placeholder="Password" class="w-full bg-gray-100 p-4 rounded-xl outline-none focus:ring-2 focus:ring-[#1D9E75]">
        <button class="w-full bg-[#0F6E56] text-white font-semibold py-4 rounded-xl shadow-lg hover:bg-[#085041] transition-all transform hover:-translate-y-1">Daftar</button>
      </form>
    </div>

    <div class="sign-in absolute top-0 left-0 w-1/2 h-full flex flex-col items-center justify-center p-12 transition-all duration-700 ease-in-out z-[2]">
      <form action="<?= base_url('login') ?>" method="post" class="w-full space-y-4">
        <?php if(session()->getFlashdata('error')): ?>
          <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-2 rounded relative text-sm text-center">
            <?= session()->getFlashdata('error') ?>
          </div>
        <?php endif; ?>
        <h2 class="text-3xl font-bold text-[#085041] mb-2">Masuk</h2>
        <input type="text" name="username" placeholder="Username" class="w-full bg-gray-100 p-4 rounded-xl outline-none focus:ring-2 focus:ring-[#1D9E75]" required>
        <input type="password" name="password" placeholder="Password" class="w-full bg-gray-100 p-4 rounded-xl outline-none focus:ring-2 focus:ring-[#1D9E75]" required>
        <a href="#" class="text-xs text-gray-400 hover:text-[#1D9E75]">Lupa password?</a>
        <button type="submit" class="w-full bg-[#0F6E56] text-white font-semibold py-4 rounded-xl shadow-lg hover:bg-[#085041] transition-all transform hover:-translate-y-1">Masuk</button>
      </form>
    </div>

    <div class="overlay-container absolute top-0 left-1/2 w-1/2 h-full overflow-hidden transition-all duration-700 ease-in-out z-[100]">
      <div class="overlay bg-gradient-to-br from-[#085041] via-[#0F6E56] to-[#1D9E75] text-white relative -left-full h-full w-[200%] transform translate-x-0 transition-all duration-700 ease-in-out">
        
        <div class="overlay-left absolute top-0 flex flex-col items-center justify-center p-12 text-center w-1/2 h-full transform -translate-x-[20%] transition-all duration-700 ease-in-out">
          <h2 class="text-3xl font-bold mb-4">Sudah punya akun?</h2>
          <p class="mb-8 text-sm opacity-90 leading-relaxed">Silakan masuk untuk tetap terhubung dengan dashboard pribadi Anda.</p>
          <button id="signInBtn" class="border-2 border-white px-10 py-3 rounded-full font-semibold hover:bg-white hover:text-[#0F6E56] transition-all">Masuk Ke Sini</button>
        </div>

        <div class="overlay-right absolute top-0 right-0 flex flex-col items-center justify-center p-12 text-center w-1/2 h-full transform translate-x-0 transition-all duration-700 ease-in-out">
          <h2 class="text-3xl font-bold mb-4">Halo, Kawan!</h2>
          <p class="mb-8 text-sm opacity-90 leading-relaxed">Daftarkan diri Anda dan mulai petualangan baru bersama kami sekarang juga.</p>
          <button id="signUpBtn" class="border-2 border-white px-10 py-3 rounded-full font-semibold hover:bg-white hover:text-[#0F6E56] transition-all">Daftar Akun</button>
        </div>

      </div>
    </div>

  </div>

  <script>
    const container = document.getElementById('mainContainer');
    const signUpBtn = document.getElementById('signUpBtn');
    const signInBtn = document.getElementById('signInBtn');

    signUpBtn.addEventListener('click', () => {
      container.classList.add('active');
    });

    signInBtn.addEventListener('click', () => {
      container.classList.remove('active');
    });
  </script>
</body>
</html>