<?php
include "../config_produk.php";
$produk = $_GET['produkId'];
$query = "DELETE FROM produk WHERE produkId = $produk";
$murid->query($query);

header("location:http://localhost:8080/?halaman=buku-list");
?>