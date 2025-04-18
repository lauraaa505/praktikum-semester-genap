<div id="konten-utama">
    <div class="container-fluid">
        <div class="header d-flex w-100 py-3">
            <h5 class="h4 fw-bold text-black-50 text-uppercase">Data Barang</h5>
        </div><!-- Akhir header -->
        <?php
        include "config_produk.php";
        ?>

        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=, initial-scale=1.0">
            <title>Aplikasi</title>
            <link rel="stylesheet" href="../assets/boostrap.css">
        </head>

        <body>
            <div class="container mt-3">
                <table class="table table-sm table-bordered table table-striped">
                    <thead>
                        <tr>
                            <th>Produk ID</th>
                            <th>Nama Produk</th>
                            <th>Harga</th>
                            <th>Stok</th>
                            <th>#</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <?php
                            $no = 1;
                            while ($data = $result->fetch_assoc()):
                                ?>
                            <tr>
                                <td><?= $data['produkId'] ?></td>
                                <td><?= $data['namaProduk'] ?></td>
                                <td><?= $data['harga'] ?></td>
                                <td><?= $data['stok'] ?></td>
                                <td>
                                    <a
                                        href="http://localhost:8080/pages/buku-update.php?produkId=<?= $data['produkId'] ?>">Edit</a>
                                    <a class="btn btn-danger btn-sm"
                                        href="http://localhost:8080/pages/buku-hapus.php?produkId=<?= $data['produkId'] ?>">Hapus</a>
                                    <a class="btn btn-danger btn-sm"
                                        href="http://localhost:8080/pages/buku-tambah.php?produkId=<?= $data['produkId'] ?>">Tambah</a>
                                </td>
                            </tr>
                            <?php $no++; endwhile; ?>
                        </tr>
                    </tbody>
                </table>
            </div>
        </body>

        </html>