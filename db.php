<?php
$servername = "localhost";  // Ganti dengan alamat server database Anda
$username = "root";         // Ganti dengan username database Anda
$password = "";             // Ganti dengan password database Anda
$dbname = "user_auth";

// Membuat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Memeriksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
?>
