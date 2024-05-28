<?php
require("Koneksi.php"); // Pastikan file Koneksi.php menginisialisasi variabel $conn dengan benar
$q = "SELECT * FROM data_pendaftaran"; // Perbaiki nama tabel
$hasil = mysqli_query($con, $q);

if (!$hasil) {
    die("Query error: " . mysqli_error($con));
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tabel</title>
</head>
<body>
    <table border="1" cellspacing="0" cellpadding="10">
        <tr>
            <td colspan="12">
                <a href="Main.php">Tambah data!</a>
            </td>
        </tr>
        <tr>
            <td>ID</td>
            <td>Nama_lengkap</td>
            <td>Nama_panggilan</td>
            <td>Tanggal_Lahir</td>
            <td>Jenis_kelamin</td>
            <td>Nomor_telepon</td>
            <td>Jurusan</td>
            <td>Agama</td>
            <td>Hobi</td>
            <td>Motivasi</td>
            <td>Foto 3x4</td>
            <td colspan="2">Aksi</td>
        </tr>
        <?php
        $i = 1;
        while ($row = mysqli_fetch_assoc($hasil)) :
        ?>
        <tr>
            <td><?= $i++; ?></td>
            <td><?= htmlspecialchars($row['nama_lengkap']) ?></td>
            <td><?= htmlspecialchars($row['nama_panggilan']) ?></td>
            <td><?= htmlspecialchars($row['ttl']) ?></td>
            <td><?= htmlspecialchars($row['jenis_kelamin']) ?></td>
            <td><?= htmlspecialchars($row['notel']) ?></td>
            <td><?= htmlspecialchars($row['jurusan']) ?></td>
            <td><?= htmlspecialchars($row['agama']) ?></td>
            <td><?= htmlspecialchars($row['hobi']) ?></td>
            <td><?= htmlspecialchars($row['motivasi']) ?></td>
            <td><img src="web/<?= htmlspecialchars($row['foto']); ?>" width="200" alt=""></td>
            <td><a href="Delete.php?id=<?= $row['id']; ?>" class="btn btn-danger" onclick="return confirm('Apakah Anda ingin benar-benar menghapus?')">Hapus</a></td>
            <td><a href="Edit.php?id=<?= $row['id']; ?>" class="btn btn-primary">Edit</a></td>
        </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>
