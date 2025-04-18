<?php
include "../config_pelanggan.php";
$pelanggan = $_GET['pelangganId'];
$query = "DELETE FROM pelanggan WHERE pelangganId = $pelanggan";
$murid->query($query);

header("location:http://localhost:8080/?halaman=pelanggan-list");
?>