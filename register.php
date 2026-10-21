<?php
require 'connect.php';

// Tampilkan pesan + tombol di sampingnya
function tampilPesan($teks, $tombolLabel, $tombolLink) {
    echo '
    <div style="display:flex; align-items:center; gap:12px; font-family:sans-serif; padding:20px;">
        <span>' . $teks . '</span>
        <a href="' . $tombolLink . '" style="padding:8px 16px; background:crimson; color:white; border-radius:8px; text-decoration:none; font-weight:600;">'
            . $tombolLabel . '</a>
    </div>';
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: register.html');
    exit;
}

$username   = trim($_POST['username'] ?? '');
$password   = $_POST['password'] ?? '';
$konfirmasi = $_POST['konfirmasi'] ?? '';

if ($username === '' || $password === '') {
    tampilPesan("❌ Username dan Password tidak boleh kosong!", "Kembali", "register.html");
    exit;
}
if (!preg_match('/^[a-zA-Z0-9_]{3,50}$/', $username)) {
    tampilPesan("❌ Username hanya boleh huruf, angka, underscore (3-50 karakter).", "Kembali", "register.html");
    exit;
}
if (strlen($password) < 8) {
    tampilPesan("❌ Password minimal 8 karakter.", "Kembali", "register.html");
    exit;
}
if ($password !== $konfirmasi) {
    tampilPesan("❌ Konfirmasi password tidak cocok.", "Kembali", "register.html");
    exit;
}

$hashed_password = password_hash($password, PASSWORD_DEFAULT);

try {
    $stmt = mysqli_prepare($conn, "INSERT INTO users (username, password) VALUES (?, ?)");
    mysqli_stmt_bind_param($stmt, "ss", $username, $hashed_password);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    tampilPesan("✅ Registrasi berhasil!", "Ke Halaman Login", "belajar.html");

} catch (mysqli_sql_exception $e) {
    if ($e->getCode() == 1062) {
        tampilPesan("❌ Username telah digunakan, gunakan username lain", "Kembali ke Register", "register.html");
    } else {
        // Pesan umum untuk user, detail error cukup dicatat di log server
        error_log($e->getMessage());
        tampilPesan("❌ Terjadi kesalahan saat menyimpan data.", "Kembali", "register.html");
    }
}

mysqli_close($conn);
?>