<?php
    include "../config_produk.php";

    if (isset($_POST['namaProduk'])) {
        $nama = $_POST['namaProduk'];
        $harga = $_POST['harga'];
        $stok = $_POST['stok'];
    
        // jalankan query
        $hasil = $murid->query("INSERT INTO produk (namaProduk, harga, stok)VALUES('$nama', '$harga', '$stok')");
    }
    
    ?>
    
    <!DOCTYPE html>
    <html lang="en">
    
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Tambah data buku</title>
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
                    <input type="teks" class="form-control" id="namaProduk" placeholder="name@example.com"
                        name="namaProduk">
                    <label for="floatingInput" name="i">Nama Produk</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="number" class="form-control" id="harga" placeholder="" name="harga" value="<?=$ikan['harga']?>">
                    <label for="floatingInput" name="i">Harga</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="number" class="form-control" id="stok" placeholder="" name="stok" value="<?=$ikan['stok']?>">
                    <label for="floatingInput" name="i">Stok</label>
                </div>
                <button class="btn btn-primary">Simpan</button>
                <a href="http://localhost:8080/?halaman=buku-list" class="btn-success">Back</a>
            </form>
        </div>
        <!-- akhir form jabatan -->
    
        <script src="../assets/boostrap.js"></script>
    </body>
    
    </html>