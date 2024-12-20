<?php
session_start();

// Jika pengguna belum login, alihkan ke halaman login
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

echo "<h2>Selamat datang, " . $_SESSION['email'] . "!</h2>";
echo "<p>Ini adalah halaman dashboard yang hanya dapat diakses setelah login.</p>";

// Tambahkan tautan untuk logout
echo "<a href='logout.php'>Logout</a>";
?>
