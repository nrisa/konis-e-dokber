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

if (isset($_POST['register'])) {
    $user_name = $_POST['user_name'];
    $name = $_POST['name'];
    $password = $_POST['password'];
    
    $sql = "INSERT INTO users (user_name, name, password) VALUES ('$user_name', '$name', '$password')";
    if ($koneksi->query($sql) === TRUE) {
        echo "<script>alert('Registrasi berhasil');</script>";
    } else {
        echo "<script>alert('Registrasi gagal: " . $koneksi->error . "');</script>";
    }
    $koneksi->close();
}
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="styles.css"> <!-- Hubungkan file CSS eksternal -->
  <link rel="stylesheet" href="data.css"> <!-- Hubungkan file CSS eksternal -->

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
  nav, ul {
    margin: 0 !important;
    padding: 0 !important;
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
  <br><br>
    <div class="container">
      <h2>Register</h2>
      <form method="POST">
        <div class="mb-3">
          <label for="user_name" class="form-label">Username</label>
          <input type="text" class="form-control" id="user_name" name="user_name" required>
        </div>
        <div class="mb-3">
          <label for="name" class="form-label">Name</label>
          <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <div class="mb-3">
          <label for="password" class="form-label">Password</label>
          <input type="password" class="form-control" id="password" name="password" required>
        </div>
        <button type="submit" class="btn btn-primary" name="register">Register</button>
      </form>
    </div>
  </body>
</html>
