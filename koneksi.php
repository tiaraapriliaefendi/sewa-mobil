<?php
// Konfigurasi koneksi database
$host = 'localhost'; // Host MySQL, biasanya localhost
$username = 'root';  // Username database (default: root)
$password = '';      // Password database (default: kosong)
$dbname = 'rental mobi'; // Nama database yang digunakan

// Membuat koneksi ke MySQL
$conn = new mysqli($host, $username, $password, $dbname);

// Memeriksa apakah koneksi berhasil
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
} else {
    echo "Koneksi berhasil!";
}

// Menutup koneksi (biasanya dilakukan setelah selesai menggunakan database)
$conn->close();
?>
