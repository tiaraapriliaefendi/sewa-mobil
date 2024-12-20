<?php
session_start();
include('rental mobi');

// Memeriksa apakah form telah disubmit
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Mengambil data dari form
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Menyiapkan query untuk mengambil data pengguna berdasarkan email
    $query = "SELECT id_pelanggan, email, password FROM Pelanggan WHERE email = ?";
    
    // Mempersiapkan statement SQL
    if ($stmt = $conn->prepare($query)) {
        // Mengikat parameter email
        $stmt->bind_param('s', $email);
        
        // Menjalankan query
        $stmt->execute();
        
        // Menyimpan hasil query
        $stmt->store_result();
        
        // Mengecek apakah ada pengguna dengan email tersebut
        if ($stmt->num_rows > 0) {
            // Mengikat hasil query ke variabel
            $stmt->bind_result($user_id, $db_email, $db_password);
            $stmt->fetch();
            
            // Memeriksa apakah password yang dimasukkan cocok
            if (password_verify($password, $db_password)) {
                // Menyimpan ID pengguna dalam sesi
                $_SESSION['user_id'] = $user_id;
                $_SESSION['email'] = $db_email;
                
                // Mengalihkan ke halaman dashboard setelah login sukses
                header('Location: dashboard.php');
                exit();
            } else {
                echo "Password salah!";
            }
        } else {
            echo "Pengguna dengan email ini tidak ditemukan!";
        }
        
        // Menutup statement
        $stmt->close();
    }
}

// Menutup koneksi
$conn->close();
?>
<?php
// Mulai sesi untuk memeriksa status login
session_start();

// Jika pengguna sudah login, alihkan ke halaman dashboard
if (isset($_SESSION['user_id'])) {
    header('Location: dashboard.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Sewa Mobil</title>
</head>
<body>
    <h2>Login to Sewa Mobil</h2>
    
    <!-- Form Login -->
    <form action="login_process.php" method="POST">
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br>

        <button type="submit">Login</button>
    </form>

    <!-- Tautan untuk mendaftar jika belum memiliki akun -->
    <p>Belum punya akun? <a href="register.php">Daftar disini</a></p>

</body>
</html>
