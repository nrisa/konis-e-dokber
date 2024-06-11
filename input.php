<?php
// Koneksi ke database
$koneksi = new mysqli("localhost", "root", "", "test_db");

// Cek koneksi
if ($koneksi->connect_error) {
    die("Koneksi database gagal: " . $koneksi->connect_error);
}

// Inisialisasi variabel
$id = "";
$nomor_agenda = "";
$dari = "";
$kepada = "";
$tembusan = "";
$klasifikasi = "";
$nomor_surat = "";
$twu = "";
$isi = "";
$disposisi = "";
$file_upload = "";

// Cek apakah ID diberikan dan data untuk edit
if (isset($_GET['hal']) && $_GET['hal'] == "edit") {
    $id = $_GET['id'];

    // Mengambil data dari database
    $query = "SELECT * FROM tbl_berita WHERE no_id = $id";
    $result = $koneksi->query($query);

    // Cek apakah data ditemukan
    if ($result->num_rows > 0) {
        $data = $result->fetch_assoc();
        $nomor_agenda = $data['nomor_agenda'];
        $dari = $data['dari'];
        $kepada = $data['kepada'];
        $tembusan = $data['tembusan'];
        $klasifikasi = $data['klasifikasi'];
        $nomor_surat = $data['nomor_surat'];
        $twu = $data['twu'];
        $isi = $data['isi'];
        $disposisi = $data['disposisi'];
        $file_upload = $data['file_upload'];
    } else {
        echo "Data tidak ditemukan!";
        exit;
    }
}

// Proses simpan atau update data
if (isset($_POST['bsimpan'])) {
    $nomor_agenda = $_POST['nomor_agenda'];
    $dari = $_POST['dari'];
    $kepada = $_POST['kepada'];
    $tembusan = $_POST['tembusan'];
    $klasifikasi = $_POST['klasifikasi'];
    $nomor_surat = $_POST['nomor_surat'];
    $twu = $_POST['twu'];
    $isi = $_POST['isi'];
    $disposisi = $_POST['disposisi'];

    if ($id) {
        // Update data
        $query_update = "UPDATE tbl_berita SET
            nomor_agenda = '$nomor_agenda',
            dari = '$dari',
            kepada = '$kepada',
            tembusan = '$tembusan',
            klasifikasi = '$klasifikasi',
            nomor_surat = '$nomor_surat',
            twu = '$twu',
            isi = '$isi'
            disposisi = '$disposisi'
            WHERE no_id = $id";

        if ($koneksi->query($query_update) === TRUE) {
            echo "<script>alert('Data berhasil diperbarui.'); window.location='data.php';</script>";
        } else {
            echo "Error: " . $query_update . "<br>" . $koneksi->error;
        }
    } else {
        // Insert data baru
        $query_insert = "INSERT INTO tbl_berita (nomor_agenda, dari, kepada, tembusan, klasifikasi, nomor_surat, twu, isi, disposisi, file_upload)
            VALUES ('$nomor_agenda', '$dari', '$kepada', '$tembusan', '$klasifikasi', '$nomor_surat', '$twu', '$isi', '$disposisi', '$file_upload')";

        if ($koneksi->query($query_insert) === TRUE) {
            echo "<script>alert('Data berhasil disimpan.'); window.location='data.php';</script>";
        } else {
            echo "Error: " . $query_insert . "<br>" . $koneksi->error;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Halaman Beranda</title>
  <link rel="stylesheet" href="styles.css"> <!-- Hubungkan file CSS eksternal -->
  <link rel="stylesheet" href="input.css"> <!-- Hubungkan file CSS eksternal -->
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

  <main>
  <section id="input-dokumen">
      <div class="container">
        <h2>Input Dokumen Berita</h2>
        <!-- Form untuk mengunggah dokumen -->
        <?php if ($id): ?>
          <form action="upload.php?id=<?= $id ?>" method="post" enctype="multipart/form-data">
        <?php else: ?>
          <form action="upload.php" method="post" enctype="multipart/form-data">
        <?php endif; ?>
          <div>
            <label for="nomor_agenda">Nomor Agenda:</label>
            <input type="text" id="nomor_agenda" name="nomor_agenda" value="<?= $nomor_agenda ?>" required>
          </div>
          <div>
            <label for="dari">Dari:</label>
            <input type="text" id="dari" name="dari" value="<?= $dari ?>" required>
          </div>
          <div>
            <label for="kepada">Kepada:</label>
            <input type="text" id="kepada" name="kepada" value="<?= $kepada ?>" required>
          </div>
          <div>
            <label for="tembusan">Tembusan:</label>
            <input type="text" id="tembusan" name="tembusan" value="<?= $tembusan ?>" required>
          </div>
          <div>
            <label for="klasifikasi">Klasifikasi:</label>
            <input type="text" id="klasifikasi" name="klasifikasi" value="<?= $klasifikasi ?>" required>
          </div>
          <div>
            <label for="nomor_surat">Nomor Dokumen:</label>
            <input type="text" id="nomor_surat" name="nomor_surat" value="<?= $nomor_surat ?>" required>
          </div>
          <div>
            <label for="twu">TWU:</label>
            <input type="text" id="twu" name="twu" value="<?= $twu ?>" required>
          </div>
          <div>
            <label for="isi">Isi:</label>
            <input type="text" id="isi" name="isi" value="<?= $isi ?>" required>
          </div>
          <div>
            <label for="disposisi">Disposisi:</label>
            <input type="text" id="disposisi" name="disposisi" value="<?= $disposisi ?>" required>
          </div>
          <?php if (!$id) { ?>
          <div>
            <label for="file_upload">Upload File:</label>
            <input type="file" id="file_upload" name="file_upload" required>
          </div>
          <?php } else { ?>
          <div>
            <label for="file_upload">Upload File:</label>
            <input type="file" id="file_upload" name="file_upload">
            <p>File saat ini: <a href="uploads/<?= $file_upload ?>" target="_blank"><?= $file_upload ?></a></p>
          </div>
          <?php } ?>
          <div>
          <button type="submit" name="bsimpan">Simpan</button>
          <button type="button" name="bbatal" onclick="window.location.href='input.php'">Batal</button>
          </div>
        </form>
      </div>
    </section>
  </main>

  <footer>
    <div class="container">
      <p>@puskodaltnial - <?= date('Y') ?> </p>
    </div>
  </footer>
</body>
</html>
