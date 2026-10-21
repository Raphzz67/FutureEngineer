<?php
session_start();
require 'connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';
    $stmt = mysqli_prepare($conn, "SELECT id, password FROM users WHERE username = ?");
    mysqli_stmt_bind_param($stmt, "s", $username);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $user = mysqli_fetch_assoc($result);

    // PERBAIKAN: Verifikasi password
    if ($user && password_verify($password, $user['password'])) {
        session_regenerate_id(true);
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $username;
        header('Location: home.php');
        exit;
    } else {
        echo "❌ Login gagal: Username atau Password salah. <a href='belajar.html'>Coba lagi</a>";
    }
    
    mysqli_stmt_close($stmt);
}
mysqli_close($conn);
?>