<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Halaman Beranda</title>
  <link rel="stylesheet" href="styles.css"> <!-- Hubungkan file CSS eksternal -->

  <style>
    /* CSS untuk memberikan background gambar yang disamarkan dengan warna gelap pada elemen <div> */
    #container-background {
      position: relative; /* Agar pseudo-element bisa diposisikan relatif ke elemen ini */
      height: 100vh; /* Pastikan elemen <div> memiliki tinggi yang sesuai */
      width: 100%; /* Pastikan elemen <div> memiliki lebar yang sesuai */
      overflow: hidden; /* Sembunyikan konten yang meluap */
    }

    #container-background::before {
      content: ""; /* Pseudo-element membutuhkan konten, meskipun kosong */
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background-image: url('gambar/kri.jpg'); /* Ganti dengan path gambar Anda */
      background-size: cover; /* Sesuaikan ukuran gambar agar menutupi elemen */
      background-position: center; /* Posisikan gambar di tengah */
      background-repeat: no-repeat; /* Hindari pengulangan gambar */
      opacity: 0.9; /* Atur transparansi gambar, bisa disesuaikan sesuai kebutuhan */
      z-index: -2; /* Pastikan pseudo-element berada di belakang konten */
    }

    #container-background::after {
      content: ""; /* Pseudo-element membutuhkan konten, meskipun kosong */
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background-color: rgba(0, 0, 0, 0.5); /* Warna gelap dengan transparansi */
      z-index: -1; /* Pastikan pseudo-element berada di belakang konten tetapi di depan gambar */
    }

    .container {
      position: relative; /* Agar konten tetap di atas pseudo-element */
      z-index: 1;
      color: white; /* Warna teks putih untuk kontras dengan background gelap */
    }

    .text-justify {
      text-align: justify; /* Membuat teks menjadi rata kanan dan kiri */
      font-size: 18px;
      font-family: "Arial", sans-serif;
    }

    #container-background {
      text-align: center; /* Membuat teks dan elemen di dalamnya menjadi rata tengah */
      font-family: "Arial", sans-serif; /* Menggunakan serif font untuk tampilan yang lebih elegan */
    }

  </style>

</head>
<body>
  <header>
    <div class="container">
      <h1>e-Dokber</h1>
      <nav>
        
        
        <ul>
          <li><a href="home.php">Home</a></li>
          <li><a href="input.php">Input Dokumen</a></li>
          <li><a href="data.php">Dokumen Masuk</a></li>
          <li><a href="data_keluar.php">Dokumen Keluar</a></li>
          <li class="nav-item"><a class="nav-link" href="register.php">Pengguna</a></li>
          <li class="nav-item"><a class="nav-link" href="report.php">Laporan Masuk</a></li>
          <li class="nav-item"><a class="nav-link" href="report_keluar.php">Laporan Keluar</a></li>
          <li><a href="logout.php">Logout</a></li>
        </ul>
      </nav>
    </div>
  </header>

  <main id="main-background">
    <section id="home">
      <div id="container-background" class="container">
        <div style="margin-bottom: 20px; text-align: center;"><h2>Selamat datang di Aplikasi e-Dokber</h2></div>
        <div class="text-justify">
        <p>Aplikasi Elektronik Dokumen Berita (e-Dokber) adalah solusi digital yang diciptakan oleh Si Komlek Puskodal TNI AL untuk mengelola dokumen berita dengan efisien. e-Dokber memungkinkan pengguna untuk dengan mudah menyimpan, mencari, dan berbagi informasi penting. Diharapkan dapat meningkatkan produktivitas dan keamanan dalam operasional Si Komlek Puskodal TNI AL.</p>
        </div>
        <!-- Highlight fitur atau berita terbaru -->
      </div>
    </section>
  </main>

  <footer>
    <div class="container">
      <p>@puskodaltnial - <?=date('Y') ?> </p>
    </div>
  </footer>
</body>
</html>
