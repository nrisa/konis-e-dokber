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

if (isset($_POST['login'])) {
    $user_name = $_POST['user_name'];
    $password = $_POST['password'];
    
    $sql = "SELECT * FROM users WHERE user_name='$user_name' AND password='$password'";
    $result = $koneksi->query($sql);
    
    if ($result->num_rows > 0) {
        // Set cookies
        setcookie("user_name", $user_name, time() + (86400 * 30), "/"); // 86400 = 1 day
        header("Location: home.php");
        exit();
    } else {
        echo "<script>alert('Login gagal: Username atau password salah');</script>";
    }
    $koneksi->close();
}
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  </head>
  <body>
    <div class="container d-flex justify-content-center align-items-center" style="height: 100vh">
        <div class="card w-75 shadow-lg">
            <div class="row">
                <div class="col" style="background-color: black;">
                    <img src="gambar/logo.png" class="w-100" >
                </div>
                <div class="col p-5">
                    <h2>Login</h2>
                    <form method="POST">
                        <div class="mb-3">
                        <label for="user_name" class="form-label">Username</label>
                        <input type="text" class="form-control" id="user_name" name="user_name" required>
                        </div>
                        <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                        <button type="submit" class="btn btn-primary" name="login">Login</button>
                    </form>                 
                </div>
            </div>
        </div>
    </div>
  </body>
</html>