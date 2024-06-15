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

// Set default tanggal jika tidak ada filter
$start_date = $_GET['start_date'] ?? date('Y-m-d');
$end_date = $_GET['end_date'] ?? date('Y-m-d');

// Query untuk mengambil data dari tabel tbl_berita dengan filter tanggal
$query = "SELECT * FROM tbl_berita 
          WHERE status = 0 
          AND DATE(twu) BETWEEN '$start_date' AND '$end_date'
          ORDER BY no_id DESC";
$tampil = mysqli_query($koneksi, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Data Dokumen</title>
  <link rel="stylesheet" href="styles.css">
  <link rel="stylesheet" href="data.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
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
                <ul class="nav">
                    <li style="margin:0;padding:0;"><a class="text-white me-3" href="home.php">Home</a></li>
                    <li style="margin:0;padding:0;"><a class="text-white me-3" href="input.php">Input Masuk</a></li>
                    <li style="margin:0;padding:0;"><a class="text-white me-3" href="input_keluar.php">Input Keluar</a></li>
                    <li style="margin:0;padding:0;"><a class="text-white me-3" href="data.php">Dokumen Masuk</a></li>
                    <li style="margin:0;padding:0;"><a class="text-white me-3" href="data_keluar.php">Dokumen Keluar</a></li>
                    <li style="margin:0;padding:0;"><a class="text-white me-3" href="register.php">Pengguna</a></li>
                    <li style="margin:0;padding:0;"><a class="text-white me-3" href="report.php">Laporan Masuk</a></li>
                    <li style="margin:0;padding:0;"><a class="text-white me-3" href="report_keluar.php">Laporan Keluar</a></li>
                    <li style="margin:0;padding:0;"><a class="text-white me-3" href="logout.php">Logout</a></li>
                </ul>
            </nav>
    </div>
  </header>

  <main>
  <section id="data-dokumen">
    <div class="container">
     <h2>Laporan Masuk</h2>
     
     <!-- Form Filter Tanggal -->
     <form method="GET" class="d-flex row gap-3" action="report.php">
        <label class="col-md align-self-center text-end" for="start_date">Dari Tanggal:</label>
        <input class="col-md" type="date" class="form-control" id="start_date" name="start_date" value="<?= htmlspecialchars($start_date) ?>">
        <label class="col-md align-self-center text-end" for="end_date">Sampai Tanggal:</label>
        <input class="col-md" type="date" class="form-control" id="end_date" name="end_date" value="<?= htmlspecialchars($end_date) ?>">
        <button class="btn btn-primary col-md" type="submit">Filter</button>
        <a href="pdf.php?start_date=<?= urlencode($start_date) ?>&end_date=<?= urlencode($end_date) ?>" class="btn btn-primary col-md" target="_blank">Download PDF</a>
        </form>
      <br>
     
     <!-- Tombol Download PDF -->
     
     <?php
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
        ?>
    </div>
  </section>
  </main>

  <footer>
    <div class="container">
      <p>@puskodaltnial - <?=date('Y') ?> </p>
    </div>
  </footer>
  
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz4fnFO9gyb4NjsG6F7lRGuvAN/jDuoSiG6jowMk5igKJAq3GQ5r7LoFo2" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-q2i2UQ4MtPSzK/8a7TP5Qf28DFEzDA+S3+L5D+z6u3ZftOF/4M76t21CA8V04Yx7" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.4/font/bootstrap-icons.min.js"></script>
</body>
</html>
