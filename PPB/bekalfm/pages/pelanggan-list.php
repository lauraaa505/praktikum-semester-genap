<div id="konten-utama">
    <div class="container-fluid">
        <div class="header d-flex w-100 py-3">
            <h5 class="h4 fw-bold text-black-50 text-uppercase">Data pelanggan</h5>
        </div><!-- Akhir header -->
        <!-- isi halaman  -->
        <?php
        include "config_pelanggan.php";
        ?>
        <div class="container mt-3">
            <table class="table table-sm table-bordered table table-striped">
                <thead>
                    <tr>
                        <th>Pelanggan ID</th>
                        <th>Nama Pelanggan</th>
                        <th>Alamat</th>
                        <th>No HP</th>
                        <th>#</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <?php
                        $no = 1;
                        while ($data = $result_pelanggan->fetch_assoc()):
                            ?>
                        <tr>
                            <td><?= $data['pelangganId'] ?></td>
                            <td><?= $data['namaPelanggan'] ?></td>
                            <td><?= $data['alamat'] ?></td>
                            <td><?= $data['nomorTelepon'] ?></td>
                            <td>
                                <a
                                    href="http://localhost:8080/pages/pelanggan-update.php?pelangganId=<?= $data['pelangganId'] ?>">Edit</a>
                                <a class="btn btn-danger btn-sm"
                                    href="http://localhost:8080/pages/pelanggan-hapus.php?pelangganId=<?= $data['pelangganId'] ?>">Hapus</a>
                                <a class="btn btn-danger btn-sm"
                                    href="http://localhost:8080/pages/pelanggan-tambah.php?pelangganId=<?= $data['pelangganId'] ?>">Tambah</a>
                            </td>
                        </tr>
                        <?php $no++; endwhile; ?>
                    </tr>
                </tbody>
            </table>
        </div>
        <!-- akhir halaman -->
    </div>
</div>