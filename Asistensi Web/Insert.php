<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require("Koneksi.php"); // Pastikan file Koneksi.php mendefinisikan variabel $conn dengan benar

if (isset($_POST['submit'])) {
    $nama_Lengkap = $_POST['nama_lengkap'];
    $nama_Panggilan = $_POST['nama_panggilan'];
    $ttl = $_POST['ttl'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $notel = $_POST['notel'];
    $jurusan = $_POST['jurusan'];
    $agama = $_POST['agama'];
    $hobi = $_POST['hobi'];
    $motivasi = $_POST['motivasi'];

    if ($_FILES['foto']['error'] === 4) {
        echo "<script>alert('Gambar tidak ada!');</script>";
    } else {
        $fileName = $_FILES['foto']['name'];
        $fileSize = $_FILES['foto']['size'];
        $tmpname = $_FILES['foto']['tmp_name'];
        $validImageExtension = ['jpg', 'jpeg', 'png'];
        $imageExtension = explode('.', $fileName);
        $imageExtension = strtolower(end($imageExtension));

        if (!in_array($imageExtension, $validImageExtension)) {
            echo "<script>alert('Invalid input!');</script>";
        } else if ($fileSize > 10000000) {
            echo "<script>alert('Gambar melebihi batas inputan!');</script>";
        } else {
            $newImageName = uniqid();
            $newImageName .= '.' . $imageExtension;
            move_uploaded_file($tmpname, 'yunita13.jpg' . $newImageName); // Pastikan folder 'uploads' ada dan writable
            $q = "INSERT INTO data_pendaftaran (nama_lengkap, nama_panggilan, ttl, jenis_kelamin, notel, jurusan, agama, hobi, motivasi, foto) VALUES ('$nama_Lengkap', '$nama_Panggilan', '$ttl', '$jenis_kelamin', '$notel', '$jurusan', '$agama', '$hobi', '$motivasi', '$newImageName')";

            if (mysqli_query($con, $q)) { // Gunakan variabel $conn yang benar
                echo "<script>
                        alert('Berhasil mengupload form!');
                        document.location.href = 'Tabel.php';
                      </script>";
            } else {
                echo "<script>alert('Database query failed!');</script>";
            }
        }
    }
}
?>
