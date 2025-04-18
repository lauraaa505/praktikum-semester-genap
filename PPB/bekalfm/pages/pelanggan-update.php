<?php 
include "../config_pelanggan.php";

$pelanggan = $_GET['pelangganId'];

// print_r($ikan);

if (isset($_POST['namaPelanggan'])) {
    $nama = $_POST['namaPelanggan'];
    $alamat = $_POST['alamat'];
    $no = $_POST['nomorTelepon'];
    

    $query = "UPDATE pelanggan SET namaPelanggan='$nama', alamat='$alamat', nomorTelepon='$no' WHERE pelangganId=$pelanggan ";
    $hasil = $murid->query($query);
}
$result_pelanggan = $murid->query("select * from pelanggan where pelangganId = $pelanggan");
$ikan = $result_pelanggan->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Pelanggan</title>
    <link rel="stylesheet" href="../assets/boostrap.css">
</head>

<body>
    <!-- form tambah buku -->
    <div class="container">
        <h3>Data Pelanggan</h3>
    <?php if (isset($hasil)): ?>
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong>Berhasil boy!</strong> keren nieh
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>
        <form action="" method="post">
            <div class="form-floating mb-3">
                <input type="teks" class="form-control" id="kode_buku" placeholder="name@example.com"
                    name="namaPelanggan" value="<?=$ikan['namaPelanggan']?>">
                <label for="floatingInput">Kode buku</label>
            </div>
            <div class="form-floating mb-3">
                <input type="teks" class="form-control" id="judul" placeholder="name@example.com"
                    name="alamat" value="<?=$ikan['alamat']?>">
                <label for="floatingInput">Judul</label>
            </div>
            <div class="form-floating mb-3">
                <input type="teks" class="form-control" id="pengarang" placeholder="name@example.com"
                    name="nomorTelepon" value="<?=$ikan['nomorTelepon']?>">
                <label for="floatingInput">Pengarang</label>
            </div>
            <button class="btn btn-primary">Simpan</button>
            <a href="http://localhost:8080/?halaman=pelanggan-list" class="btn-success">Back</a>
        </form>
    </div>
    <!-- akhir form jabatan -->


    <script src="../assets/boostrap.js"></script>
</body>

</html>