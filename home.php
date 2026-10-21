<?php
session_start();

// Jika belum login, tendang kembali ke halaman login
if (!isset($_SESSION['user_id'])) {
    header('Location: belajar.html');
    exit;
}

$username = htmlspecialchars($_SESSION['username']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="desain.css">
    <title>Home - Landing Page</title>
</head>
<body>
    <nav class="wrapper">
        <div class="brand">
            <div class="firstname">wiwok detok</div>
            <div class="lastname">tutorial</div>
        </div>
        <ul class="navigation">
            <li><a href="home.php" class="active">home</a></li>
            <li><a href="testing.jpeg">belajar</a></li>
            <li><a href="https://youtu.be/dQw4w9WgXcQ?si=FaQMZMPNFydd0mNg">tentang</a></li>
            <li><a href="/">kontak</a></li>
            
            <!-- Tulisan Welcome + Tombol Logout -->
            <li class="welcome-text">Welcome, <?php echo $username; ?>!</li>
            <li><a href="logout.php" class="logout-btn">Logout</a></li>
            
            <li><img src="tes.jpg" alt="profil"></li>
        </ul>
    </nav>

    <main class="hero">
        <div class="login-box" style="text-align: center; background: rgba(0,0,0,0.75); backdrop-filter: blur(10px); border: 1px solid rgba(255,255,255,0.2); border-radius: 12px; padding: 40px; max-width: 400px; margin: auto;">
    <h2 style="color: #ffffff;">Selamat Datang!</h2>
    <p style="color: #ffffff;">Halo, <b style="color: crimson;"><?php echo $username; ?></b>!</p>
    <p style="color: #ffffff;">Anda berhasil login ke sistem.</p>
    <br>
    <a href="logout.php" style="display: block; padding: 12px; background: crimson; color: white; border-radius: 8px; text-decoration: none; text-align: center; font-weight: 600;">Logout</a>
</div>
    </main>
</body>
</html>