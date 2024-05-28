<?php
    include("Koneksi.php");
    $id = $_GET['id'];
    $sql = "DELETE FROM data_pendaftaran where id = $id";
    if(mysqli_query($con,$sql)){
        ?>
        <script>
            document.location.href = "Tabel.php"
        </script>
        <?php
    }else{
        echo "Data gagal dihapus ".$sql. " ". mysqli_error($con);
    }
?>