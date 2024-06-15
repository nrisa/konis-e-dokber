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

// Uji jika klik tombol hapus
if (isset($_GET['hal']) && $_GET['hal'] == "hapus") {
    $id = $_GET['id'];
    $hapus = mysqli_query($koneksi, "DELETE FROM tbl_berita WHERE no_id='$id'");
    if ($hapus) {
        echo "<script>
                alert('Hapus Data Sukses!');
                document.location='data.php';
              </script>";
    } else {
        echo "<script>
                alert('Hapus Data Gagal!');
                document.location='data.php';
              </script>";
    }
}

// Uji jika klik tombol cari
$cari = "";
if (isset($_POST['bcari'])) {
    $cari = $_POST['tcari'];
}

// Uji jika klik tombol reset
if (isset($_POST['breset'])) {
    $cari = "";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Data Dokumen</title>
  <link rel="stylesheet" href="styles.css"> <!-- Hubungkan file CSS eksternal -->
  <link rel="stylesheet" href="data.css"> <!-- Hubungkan file CSS eksternal -->

  <style>
  .table-responsive {
    width: 100% !important;
    overflow-x: scroll;
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
          <li><a href="input.php">Input Masuk</a></li>
          <li><a href="input_keluar.php">Input Keluar</a></li>
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

  <main>
  <section id="data-dokumen">
    <div class="container">
     <!-- Form untuk tombol Cari dan Reset -->
     <div class="search-container">
        <form method="POST">
          <input type="text" name="tcari" value="<?= htmlspecialchars($cari) ?>" class="form-control" placeholder="Masukkan kata kunci!">
          <button class="btn btn-primary" name="bcari" type="submit">Cari</button>
          <button class="btn btn-danger" name="breset" type="submit">Reset</button>
        </form>
     </div>

     <h2>Dokumen Keluar</h2>
     <?php
        // Query untuk mengambil data dari tabel tbl_berita dengan filter pencarian dan status = 1
        $query = "SELECT * FROM tbl_berita 
                  WHERE status = 1 
                  AND (nomor_agenda LIKE '%$cari%' 
                  OR dari LIKE '%$cari%' 
                  OR kepada LIKE '%$cari%' 
                  OR tembusan LIKE '%$cari%' 
                  OR klasifikasi LIKE '%$cari%' 
                  OR nomor_surat LIKE '%$cari%' 
                  OR twu LIKE '%$cari%' 
                  OR isi LIKE '%$cari%') 
                  ORDER BY no_id DESC";
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
                    <th>Aksi</th>
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
                        <td>
                            <a href='input.php?hal=edit&id={$data['no_id']}' class='btn btn-success'>Edit</a>
                            <a href='data.php?hal=hapus&id={$data['no_id']}' class='btn btn-danger' onclick='return confirm(\"Apakah anda yakin ingin menghapus data ini?\")'>Hapus</a>
                        </td>
                      </tr>";
                $no++;
            }
            echo "</table>";
            echo "</div>";
        } else {
            echo "<p>Data tidak ditemukan!</p>";
        }

        // Tutup koneksi
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
