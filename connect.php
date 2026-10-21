<?php
$conn = mysqli_connect("localhost", "root", "", "ClientServer");
if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>