<?php
// Hapus cookies
setcookie("user_name", "", time() - 3600, "/");
header("Location: index.php");
exit();
?>
