<?php
session_start();
if (!isset($_SESSION['petugasId'])) {
    header("Location: http://localhost:8080/login.php");
    exit;
}

$petugas_id = $_SESSION["petugasId"];
$nama_petugas = $_SESSION["namaPetugas"];

$daftar_pelanggan = [];
include "config_pelanggan.php";
while ($pelanggan = $result_pelanggan->fetch_assoc()) {
    $daftar_pelanggan[] = [
        "id" => $pelanggan['pelangganId'],
        "nama" => $pelanggan['namaPelanggan'],
    ];
}
// ambil data
$daftar_produk = [];
include "config_produk.php";
while ($produk = $result->fetch_assoc()) {
    $daftar_produk [] = [
        "id" => $produk['produkId'],
        "nama" => $produk['namaProduk'],
        "harga" => $produk['harga'],
        "stok" => $produk['stok']
    ];
}
// proses transaksi
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $pelanggan_id = $_POST['pelangganId'];
    $keranjang = json_decode($_POST['keranjang'], true);
    $uang_dibayar = (float) $_POST['uang_dibayar'];
    $total_belanja = 0;

    // hitung total
    foreach ($keranjang as $item) {
        $total_belanja += $item['subtotal'];
    }

    //simpan penjualan
    $tanggal = date('Y-m-d');
    $query_penjualan = "INSERT INTO penjualan (tanggalPenjualan, totalHarga, pelangganId, petugasId) VALUES ('$tanggal', $total_belanja, $pelanggan_id, $petugas_id)";
    if ($murid->query($query_penjualan)) {
        $penjualan_id = $murid->insert_id;
//simpan dan kurangi stok
        foreach ($keranjang as $item) {
            $nama_produk = $murid->real_escape_string($item['namaProduk']);
            $query_produk_id = "SELECT produkId FROM produk WHERE namaProduk = '$nama_produk'";
            $hasil_produk_id = $murid->query($query_produk_id);
            $produk_id = $hasil_produk_id->fetch_assoc()['produkId'];
            $jumlah = $item['jumlah'];
            $subtotal = $item['subtotal'];

// Simpan detail
            $query_detail = "INSERT INTO detail_penjualan (penjualanId, produkId, jumlahProduk, subtotal) 
                         VALUES ($penjualan_id, $produk_id, $jumlah, $subtotal)";
            $murid->query($query_detail);

        }
        $kembalian = $uang_dibayar - $total_belanja;
        echo "<script>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                html: 'Transaksi disimpan.<br>Kembalian: Rp ' + $kembalian.toLocaleString(),
                confirmButtonText: 'Oke',
                confirmButtonColor: '#0984e3'
            }).then(() => {
                window.location='index.php?halaman=transaksi';
            });
        </script>";

    } else {
        echo "<script>
            Swal.fire({
                icon: 'error',
                title: 'Gagal!',
                text: 'Gagal menyimpan transaksi.',
                confirmButtonText: 'Oke',
                confirmButtonColor: '#0984e3'
            });
        </script>";
    }
}

?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaksi</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f1f5f9;
            margin: 0;

        }

        .container {
            max-width: 900px;
            margin: 0 auto;
        }

        .header {
            background: #fff;
            padding: 15px 25px;
            border-radius: 12px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .header h2 {
            font-size: 22px;
            color: #2d3436;
            margin: 0;
        }

        .header p {
            color: #636e72;
            margin: 0;
        }

        .transaksi-box {
            background: #fff;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .transaksi-box h3 {
            font-size: 24px;
            color: #2d3436;
            margin: 0 0 20px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            color: #636e72;
            margin-bottom: 5px;
        }

        .form-group select,
        .form-group input {
            width: 100%;
            padding: 10px;
            border: 1px solid #dfe4ea;
            border-radius: 6px;
            box-sizing: border-box;
            font-size: 14px;
        }

        .form-group input:focus,
        .form-group select:focus {
            border-color: #0984e3;
            outline: none;
        }

        .form-row {
            display: flex;
            gap: 15px;
            margin-bottom: 20px;
        }

        .form-row .form-group {
            flex: 1;
        }

        .btn {
            padding: 10px 20px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 14px;
        }

        .btn-tambah {
            background: #0984e3;
            color: #fff;
            margin-bottom: 10px;
        }

        .btn-tambah:hover {
            background: #0870c1;
        }

        .btn-simpan {
            background: #00b894;
            color: #fff;

        }

        .btn-simpan:hover {
            background: #009e7d;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th,
        td {
            padding: 12px;
            text-align: left;
            border: 1px solid #dfe4ea;
        }

        th {
            background: #f8fafc;
            color: #2d3436;
        }

        td {
            background: #fff;
        }

        tr:hover td {
            background: #f1f5f9;
        }

        .btn-hapus {
            color: #d63031;
            text-decoration: none;
        }

        .btn-hapus:hover {
            text-decoration: underline;
        }

        .text-right {
            text-align: right;
        }

        .text-center {
            text-align: center;
        }

        .payment-box {
            margin: 20px 0;
        }

        .payment-box p {
            margin: 10px 0 0;
            color: #636e72;
        }

        .payment-box span {
            font-weight: bold;
            color: #2d3436;
        }

        .text-green {
            color: #00b894;
        }

        .text-red {
            color: #d63031;
        }
    </style>
</head>
<body>
    <div id="konten-utama">
        <div class="container-fluid">
            <div class="d-flex w-100 py-3">
                <h5 class="h4 fw-bold text-black-50 text-uppercase">Form Transaksi</h5>
            </div><!-- Akhir header -->
            <div class="container">
                <div class="header">
                    <h2>Transaksi</h2>
                    <p>Petugas: <span> <?= htmlspecialchars($nama_petugas) ?></span></p>
                </div>

                <div class="transaksi-box">
                    <h3>Transaksi Baru</h3>
                    <form id="formTransaksi" method="POST" action="">
                        <!-- Pilih Pelanggan -->
                        <div class="form-group">
                            <label for="pelanggan_id">Pelanggan</label>
                            <select id="pelanggan_id" name="pelangganId">
                                <option value="">Pilih Pelanggan</option>
                                <?php foreach ($daftar_pelanggan as $pelanggan): ?>
                                    <option value="<?= $pelanggan['id'] ?>"><?= htmlspecialchars($pelanggan['nama']) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <!-- Pilih Produk -->
                        <div class="form-row">
                            <div class="form-group">
                                <label for="produk">Produk</label>
                                <input type="text" id="produk" name="produk" list="list_produk"
                                    placeholder="Ketik nama produk">
                                <datalist id="list_produk"></datalist>
                            </div>
                            <div class="form-group">
                                <label for="jumlah">Jumlah</label>
                                <input type="number" id="jumlah" name="jumlah" value="1" min="1">
                            </div>
                        </div>

                        <button type="button" id="tambahKeranjang" class="btn btn-tambah">Tambah</button>

                        <!-- Tabel Keranjang -->
                        <table>
                            <thead>
                                <tr>
                                    <th>Produk</th>
                                    <th class="text-right">Harga</th>
                                    <th class="text-center">Jumlah</th>
                                    <th class="text-right">Subtotal</th>
                                    <th class="text-center">Hapus</th>
                                </tr>
                            </thead>
                            <tbody id="keranjangItems"></tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="3" class="text-right">Total:</td>
                                    <td class="text-right" id="totalBelanja">Rp 0</td>
                                    <td></td>
                                </tr>
                            </tfoot>
                        </table>

<!-- Pembayaran -->
                        <div class="payment-box">
                            <div class="form-group">
                                <label for="uang_dibayar">Uang Dibayar (Rp)</label>
                                <input type="number" id="uang_dibayar" name="uang_dibayar" min="0"
                                    placeholder="Masukkan jumlah">
                            </div>
                            <p>Kembalian: <span id="kembalian">Rp 0</span></p>
                        </div>

<!-- Input tersembunyi -->
                        <input type="hidden" id="dataKeranjang" name="keranjang">

                        <!-- Tombol Simpan -->
                        <div class="text-right">
                            <button type="submit" id="simpanTransaksi" class="btn btn-simpan">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
            <script>
                // Data dari PHP
                let daftar_produk = <?= json_encode($daftar_produk) ?>;

                // Elemen DOM
                const produkInput = document.getElementById('produk');
                const jumlahInput = document.getElementById('jumlah');
                const listProduk = document.getElementById('list_produk');
                const keranjangItems = document.getElementById('keranjangItems');
                const totalBelanja = document.getElementById('totalBelanja');
                const dataKeranjang = document.getElementById('dataKeranjang');
                const uangDibayarInput = document.getElementById('uang_dibayar');
                const kembalianText = document.getElementById('kembalian');

                let keranjang = [];
                let total = 0;

                produkInput.oninput = function ()
                let input = this.value.toLowerCase();
                let filterProduk = daftar_produk.filter(produk =>
                    produk.nama.toLowerCase().includes(input)
                );
                if (filterProduk.length > 0) {
                    filterProduk = filterProduk.slice(0, 5);
                    listProduk.innerHTML = filterProduk.map(produk =>
                        `<option value="${produk.nama}" 
                             data-harga="${produk.harga}" 
                             data-stok="${produk.stok}">
                        ${produk.nama} - Rp ${Number(produk.harga).toLocaleString()} (Stok: ${produk.stok})
                    </option>`
                    ).join("");
                } else {
                    listProduk.innerHTML = "";
                };

                // tambah keranjang 
                document.getElementById('tambahKeranjang').addEventListener('click', () => {
                    const namaProduk = produkInput.value;
                    if(!namaProduk) {
                        Swal.fire({
                                icon: 'warning',
                                title: 'Produk kosong!',
                                text: 'Pilih produk .',
                                confirmButtonText: 'OKE',
                                confirmButtonColor: '#0984e3'
                            });
                            return;
                    }

                    const produkTerpilih = daftar_produk.find(produk => produk.nama === namaProduk);
                    if(!produkTerpilih) {
                        Swal.fire({
                            icon: 'warning',
                            title: 'Produk Salah!',
                            text: 'Pilih produk dari daftar.',
                            confirmButtonText: 'OKE',
                            confirmButtonColor: '#0984e3'
                        });
                        return;
                    }

                const harga = parseFloat(produkTerpilih.harga);
                    const jumlah = parseInt(jumlahInput.value);
                    const subtotal = harga * jumlah;

                    const itemAda = keranjang.find(item => item.namaProduk === namaProduk);
                    if(itemAda) {
                        itemAda.jumlah += jumlah;
                        itemAda.subtotal += subtotal;
                    } else {
                        keranjang.push({ namaProduk, harga, jumlah, subtotal });
                    }
                tampilKeranjang = ();
                    produkInput.value = '';
                    jumlahInput.value = 1;
                });

                // Hitung kembalian
                uangDibayarInput.oninput = function () {
                    const uang_dibayar = parseFloat(this.value) || 0;
                    const kembalian = uang_dibayar - total;

                    if (uang_dibayar >= total && total > 0) {
                        kembalianText.textContent = `Rp ${kembalian.toLocaleString()}`;
                        kembalianText.classList.remove('text-red');
                        kembalianText.classList.add('text-green');
                    } else {
                        kembalianText.textContent = uang_dibayar > 0 ? `Uang kurang!` : `Rp 0`;
                        kembalianText.classList.remove('text-green');
                        kembalianText.classList.add('text-red');
                    }
                };

                function tampilKeranjang() {
                    keranjangItems.innerHTML = '';
                    total = 0;

                    keranjang.forEach((item, index) => {
                        total += item.subtotal;

                        keranjangItems.innerHTML += `
                    <tr>
                        <td>${item.nama_produk}</td>
                        <td class="text-right">Rp ${item.harga.toLocaleString()}</td>
                        <td class="text-center">${item.jumlah}</td>
                        <td class="text-right">Rp ${item.subtotal.toLocaleString()}</td>
                        <td class="text-center">
                            <button onclick="hapusItem(${index})" class="btn-hapus">Hapus</button>
                        </td>
                    </tr>
                    `;
                    });
                    totalBelanja.textContent = `Rp ${total.toLocaleString()}`;
                    dataKeranjang.value = JSON.stringify(keranjang);
                    uangDibayarInput.value = '';
                    kembalianText.textContent = `Rp 0`;
                    kembalianText.classList.remove('text-green', 'text-red');
                }
                function hapusItem(index) {
                    keranjang.splice(index, 1);
                    tampilKeranjang();
                }
            </script>
</body>

</html>