<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "test_db";

// Koneksi ke database
$koneksi = new mysqli($servername, $username, $password, $dbname);

// Periksa koneksi
if ($koneksi->connect_error) {
    die("Koneksi gagal: " . $koneksi->connect_error);
}

$uploadOk = 1;
$file_upload = "";

// Jika ada file yang diunggah
if (!empty($_FILES["file_upload"]["name"])) {
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["file_upload"]["name"]);
    $fileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Periksa apakah file sudah ada
    if (file_exists($target_file)) {
        // Tambahkan timestamp atau string unik pada nama file untuk menghindari duplikasi
        $file_info = pathinfo($target_file);
        $new_filename = $file_info['filename'] . '_' . time() . '.' . $file_info['extension'];
        $target_file = $target_dir . $new_filename;
    }

    // Periksa ukuran file
    if ($_FILES["file_upload"]["size"] > 10000000) {
        echo "<script>
                alert('Maaf, file Anda terlalu besar.');
                window.location='input.php';
              </script>";
        $uploadOk = 0;
    }

    // Hanya izinkan format file tertentu
    if ($fileType != "pdf" && $fileType != "doc" && $fileType != "docx") {
        echo "<script>
                alert('Maaf, hanya file PDF, DOC, dan DOCX yang diizinkan.');
                window.location='input.php';
              </script>";
        $uploadOk = 0;
    }

    // Jika semua ok, coba upload file
    if ($uploadOk == 1) {
        if (move_uploaded_file($_FILES["file_upload"]["tmp_name"], $target_file)) {
            $file_upload = basename($target_file);
        } else {
            echo "<script>
                    alert('Maaf, ada kesalahan dalam mengupload file Anda.');
                    window.location='input.php';
                  </script>";
            $uploadOk = 0;
        }
    }
} else {
    // Jika tidak ada file yang diunggah, gunakan file yang sudah ada (untuk update)
    if (isset($_GET['id']) && !empty($_GET['id'])) {
        $id = $_GET['id'];
        $sql = "SELECT file_upload FROM tbl_berita WHERE no_id = $id";
        $result = $koneksi->query($sql);
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $file_upload = $row['file_upload'];
        }
    }
}

if ($uploadOk == 1) {
    // Simpan informasi file ke database
    $nomor_agenda = $_POST['nomor_agenda'];
    $dari = $_POST['dari'];
    $kepada = $_POST['kepada'];
    $tembusan = $_POST['tembusan'];
    $klasifikasi = $_POST['klasifikasi'];
    $nomor_surat = $_POST['nomor_surat'];
    $twu = $_POST['twu'];
    $isi = $_POST['isi'];
    $status = $_POST['status'];
    $disposisi = $_POST['disposisi'];

    if (isset($_GET['id']) && !empty($_GET['id'])) {
        $id = $_GET['id'];
        $sql = "UPDATE tbl_berita SET 
                nomor_agenda = '$nomor_agenda', 
                dari = '$dari', 
                kepada = '$kepada', 
                tembusan = '$tembusan', 
                klasifikasi = '$klasifikasi', 
                nomor_surat = '$nomor_surat', 
                twu = '$twu', 
                isi = '$isi', 
                disposisi = '$disposisi', 
                file_upload = '$file_upload'
                fstatus = '$status'
                WHERE no_id = $id";
    } else {
        $sql = "INSERT INTO tbl_berita (nomor_agenda, dari, kepada, tembusan, klasifikasi, nomor_surat, twu, isi, status, disposisi, file_upload) 
                VALUES ('$nomor_agenda', '$dari', '$kepada', '$tembusan', '$klasifikasi', '$nomor_surat', '$twu', '$isi', '$status', '$disposisi', '$file_upload')";
    }

    if ($koneksi->query($sql) === TRUE) {
        echo "<script>alert('Data berhasil diunggah.'); window.location='input.php';</script>";
    } else {
        echo "Error: " . $sql . "<br>" . $koneksi->error;
    }
}

// Tutup koneksi
$koneksi->close();
?>
