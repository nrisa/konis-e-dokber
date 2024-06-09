<?php
$servername = "localhost";
$username = "root";
$password = ""; // Sesuaikan dengan password MySQL Anda
$dbname = "test_db";

// Membuat koneksi
$koneksi = new mysqli($servername, $username, $password, $dbname);

// Periksa koneksi
if ($koneksi->connect_error) {
    die("Koneksi gagal: " . $koneksi->connect_error);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Data Dokumen</title>
  <link rel="stylesheet" href="styles.css">
  <link rel="stylesheet" href="data.css">
  <style>
  .table-responsive {
    width: 100% !important;
    overflow-x: scroll;
  }
  .btn-primary {
    background-color: #2885a7;
  }
  .btn-primary:hover {
    background-color: #214f88;
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
          <li><a href="register.php">Register</a></li>
          <li><a href="logout.php">Logout</a></li>
        </ul>
      </nav>
    </div>
  </header>

  <main>
  <section id="data-dokumen">
    <div class="container">
     <h2>Laporan Keluar</h2>
     <a href="pdf_keluar.php" class="btn btn-primary" target="_blank">Download PDF</a>
     <?php
        // Query untuk mengambil data dari tabel tbl_berita dengan filter pencarian dan status = 0
        $query = "SELECT * FROM tbl_berita WHERE status = 1 ORDER BY no_id DESC";
        $tampil = mysqli_query($koneksi, $query);

        if (mysqli_num_rows($tampil) > 0) {
            echo "<div class='table-responsive'>";
            echo "<table border='1'>";
            echo "<tr>
                    <th>No</th>
                    <th>Nomor Agenda</th>
                    <th>Dari</th>
                    <th>Kepada</th>
                    <th>Tembusan</th>
                    <th>Klasifikasi</th>
                    <th>Nomor Dokumen</th>
                    <th>TWU</th>
                    <th>Isi</th>
                    <th>Disposisi</th>
                    <th>File Upload</th>
                  </tr>";
            $no = 1;
            while ($data = mysqli_fetch_array($tampil)) {
                echo "<tr>
                        <td>{$no}</td>
                        <td>{$data['nomor_agenda']}</td>
                        <td>{$data['dari']}</td>
                        <td>{$data['kepada']}</td>
                        <td>{$data['tembusan']}</td>
                        <td>{$data['klasifikasi']}</td>
                        <td>{$data['nomor_surat']}</td>
                        <td>{$data['twu']}</td>
                        <td>{$data['isi']}</td>
                        <td>{$data['disposisi']}</td>
                        <td>";
                if (empty($data['file_upload'])) {
                    echo "Masih kosong";
                } else {
                    echo "<a href='uploads/{$data['file_upload']}' target='_blank'>Lihat File</a>";
                }
                echo "</td>
                      </tr>";
                $no++;
            }
            echo "</table>";
            echo "</div>";
        } else {
            echo "<p>Data tidak ditemukan!</p>";
        }
        $koneksi->close();
        ?>
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
