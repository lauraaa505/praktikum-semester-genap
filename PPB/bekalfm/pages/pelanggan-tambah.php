<?php
include "../config_pelanggan.php";

if (isset($_POST['namaPelanggan'])) {
    $nama = $_POST['namaPelanggan'];
    $alamat = $_POST['alamat'];
    $no = $_POST['nomorTelepon'];
    // jalankan query
    $hasil = $murid->query("INSERT INTO pelanggan (namaPelanggan, alamat, nomorTelepon)VALUES('$nama', '$alamat', '$no')");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah data pelanggan</title>
    <link rel="stylesheet" href="../assets/boostrap.css">
</head>

<body>
    <!-- form tambah jabatan -->
    <div class="container">
    <?php if (isset($hasil)): ?>
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong>Berhasil boy!</strong> keren nieh
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <?php endif; ?>
        <form action="" method="post">
            <div class="form-floating mb-3">
                <input type="teks" class="form-control" id="kode_buku" placeholder="name@example.com"
                    name="namaPelanggan">
                <label for="floatingInput">Nama Pelanggan</label>
            </div>
            <form action="" method="post">
            <div class="form-floating mb-3">
                <input type="teks" class="form-control" id="judul" placeholder="name@example.com"
                    name="alamat">
                <label for="floatingInput">Alamat</label>
            </div>
            <form action="" method="post">
            <div class="form-floating mb-3">
                <input type="teks" class="form-control" id="pengarang" placeholder="name@example.com"
                    name="nomorTelepon">
                <label for="floatingInput">No HP</label>
            </div>
            <button class="btn btn-primary">Simpan</button>
            <a href="http://localhost:8080/?halaman=pelanggan-list" class="btn-success">Back</a>
        </form>
    </div>
    <!-- akhir form jabatan -->

    <script src="../assets/boostrap.js"></script>
</body>

</html>