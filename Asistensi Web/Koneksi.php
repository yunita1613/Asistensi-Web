<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "AsistensiWeb"; // Ganti dengan nama database Anda

// Membuat koneksi
$con = mysqli_connect($servername, $username, $password, $dbname);

// Mengecek koneksi
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
