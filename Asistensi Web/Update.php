<?php
include("Koneksi.php");

if (isset($_POST['id']) && isset($_POST['nama_lengkap']) && isset($_POST['nama_panggilan']) && isset($_POST['ttl']) && 
    isset($_POST['jenis_kelamin']) && isset($_POST['notel']) && isset($_POST['jurusan']) && isset($_POST['agama']) && 
    isset($_POST['hobi']) && isset($_POST['motivasi']) && isset($_POST['foto'])) {

    $id = $_POST['id'];
    $nama_Lengkap = $_POST['nama_lengkap'];
    $nama_Panggilan = $_POST['nama_panggilan'];
    $ttl = $_POST['ttl'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $notel = $_POST['notel'];
    $jurusan = $_POST['jurusan'];
    $agama = $_POST['agama'];
    $hobi = implode(', ', $_POST['hobi']);
    $motivasi = $_POST['motivasi'];

    if ($_FILES['foto']['error'] === 4) {
        $sql = "UPDATE data_pendaftaran SET 
                nama_lengkap = '$namaLengkap', 
                nama_panggilan = '$namaPanggilan', 
                ttl = '$ttl', 
                jenis_kelamin = '$jenis_kelamin', 
                notel = '$notel', 
                jurusan = '$jurusan', 
                agama = '$agama', 
                hobi = '$hobi', 
                motivasi = '$motivasi' 
                WHERE id = '$id'";
    } else {
        $fileName = $_FILES['foto']['name'];
        $fileSize = $_FILES['foto']['size'];
        $tmpname = $_FILES['foto']['tmp_name'];
        $validImageExtension = ['jpg', 'jpeg', 'png'];
        $imageExtension = explode('.', $fileName);
        $imageExtension = strtolower(end($imageExtension));

        if (!in_array($imageExtension, $validImageExtension)) {
            echo "<script> alert('Invalid input!'); </script>";
            exit;
        } else if ($fileSize > 10000000) {
            echo "<script> alert('Gambar melebihi batas inputan!'); </script>";
            exit;
        } else {
            $newImageName = uniqid();
            $newImageName .= '.' . $imageExtension;
            move_uploaded_file($tmpname, 'yunita13/' . $newImageName);

            $sql = "UPDATE data_pendaftaran SET 
                    nama_lengkap = '$nama_Lengkap', 
                    nama_panggilan = '$nama_Panggilan', 
                    ttl = '$ttl', 
                    jenis_kelamin = '$jenis_kelamin', 
                    notel = '$notel', 
                    jurusan = '$jurusan', 
                    agama = '$agama', 
                    hobi = '$hobies', 
                    motivasi = '$alasan', 
                    foto = '$newImageName' 
                    WHERE id = '$id'";
        }
    }

    if (mysqli_query($con, $sql)) {
        echo "<script> 
                alert('Berhasil mengupload form!');
                document.location.href ='Tabel.php';
              </script>";
    } else {
        echo "<script> alert('Database query Gagal!'); </script>";
    }
} else {
    echo "<script> alert('Mohon jangan kosongkan!'); </script>";
}
?>