<?php
session_start();

// Hapus semua data session
$_SESSION = array();
session_unset();
session_destroy();

// Redirect ke halaman login
header('Location: belajar.html');
exit;
?>