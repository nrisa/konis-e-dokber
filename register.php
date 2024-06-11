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

// Create - Registrasi
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
}

// Update
if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $user_name = $_POST['user_name'];
    $name = $_POST['name'];
    $password = $_POST['password'];
    
    $sql = "UPDATE users SET user_name='$user_name', name='$name', password='$password' WHERE id=$id";
    if ($koneksi->query($sql) === TRUE) {
        echo "<script>alert('Update berhasil');</script>";
    } else {
        echo "<script>alert('Update gagal: " . $koneksi->error . "');</script>";
    }
}

// Delete
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $sql = "DELETE FROM users WHERE id=$id";
    if ($koneksi->query($sql) === TRUE) {
        echo "<script>alert('Hapus berhasil');</script>";
    } else {
        echo "<script>alert('Hapus gagal: " . $koneksi->error . "');</script>";
    }
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Register & Manage Users</title>
  <link rel="stylesheet" href="styles.css"> <!-- Hubungkan file CSS eksternal -->
  <link rel="stylesheet" href="data.css"> <!-- Hubungkan file CSS eksternal -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <header>
        <div class="container">
            <h1>e-Dokber</h1>
            <nav>
                <ul class="nav">
                    <li style="margin:0;padding:0;"><a class="text-white me-5" href="home.php">Home</a></li>
                    <li style="margin:0;padding:0;"><a class="text-white me-5" href="input.php">Input Dokumen</a></li>
                    <li style="margin:0;padding:0;"><a class="text-white me-5" href="data.php">Dokumen Masuk</a></li>
                    <li style="margin:0;padding:0;"><a class="text-white me-5" href="data_keluar.php">Dokumen Keluar</a></li>
                    <li style="margin:0;padding:0;"><a class="text-white me-5" href="register.php">Pengguna</a></li>
                    <li style="margin:0;padding:0;"><a class="text-white me-5" href="report.php">Laporan Masuk</a></li>
                    <li style="margin:0;padding:0;"><a class="text-white me-5" href="report_keluar.php">Laporan Keluar</a></li>
                    <li style="margin:0;padding:0;"><a class="text-white me-5" href="logout.php">Logout</a></li>
                </ul>
            </nav>
        </div>
    </header>
    <br><br>
    <div class="container">
        <!-- Form Pendaftaran -->
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
        <br>
        
        <!-- Tabel Pengguna -->
        <h2>Manage Users</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>Username</th>
                    <th>Name</th>
                    <th>Password</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $result = $koneksi->query("SELECT * FROM users");
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                        <td>{$row['user_name']}</td>
                        <td>{$row['name']}</td>
                        <td>{$row['password']}</td>
                        <td>
                            <!-- <button class='btn btn-success' data-bs-toggle='modal' data-bs-target='#editModal-{$row['id']}'>Edit</button> -->
                            <a href='?delete={$row['id']}' class='btn btn-danger'>Delete</a>
                        </td>
                    </tr>";
                }
                ?>
            </tbody>
        </table>

        <!-- Modals for each user -->
        <?php
        $result->data_seek(0); // Kembali ke awal result set
        while ($row = $result->fetch_assoc()) {
            echo "<div class='modal fade' id='editModal-{$row['id']}' tabindex='-1' aria-labelledby='editModalLabel-{$row['id']}' aria-hidden='true'>
                <div class='modal-dialog'>
                    <div class='modal-content'>
                        <div class='modal-header'>
                            <h5 class='modal-title' id='editModalLabel-{$row['id']}'>Edit User</h5>
                            <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                        </div>
                        <div class='modal-body'>
                            <form method='POST'>
                                <input type='hidden' name='id' value='{$row['id']}'>
                                <div class='mb-3'>
                                    <label for='modal_user_name-{$row['id']}' class='form-label'>Username</label>
                                    <input type='text' class='form-control' id='modal_user_name-{$row['id']}' name='user_name' value='{$row['user_name']}' required>
                                </div>
                                <div class='mb-3'>
                                    <label for='modal_name-{$row['id']}' class='form-label'>Name</label>
                                    <input type='text' class='form-control' id='modal_name-{$row['id']}' name='name' value='{$row['name']}' required>
                                </div>
                                <div class='mb-3'>
                                    <label for='modal_password-{$row['id']}' class='form-label'>Password</label>
                                    <input type='password' class='form-control' id='modal_password-{$row['id']}' name='password' value='{$row['password']}' required>
                                </div>
                                <button type='submit' class='btn btn-primary' name='update'>Update</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>";
        }
        ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz4fnFO9gyb4NjsG6F7lRGuvAN/jDuoSiG6jowMk5igKJAq3GQ5r7LoFo2" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-q2i2UQ4MtPSzK/8a7TP5Qf28DFEzDA+S3+L5D+z6u3ZftOF/4M76t21CA8V04Yx7" crossorigin="anonymous"></script>
</body>
</html>

<?php
$koneksi->close();
?>
