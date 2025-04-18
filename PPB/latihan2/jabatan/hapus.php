<?php
$con = new mysqli("localhost", "root", "", "PK2");
if ($con->connect_error) {
    die("Koneksi gagal: " . $con->connect_error);
}
$id_jabatan = $_GET['id_jabatan'];
$query ="DELETE FROM jabatan WHERE id_jabatan = $id_jabatan";
$con->query($query);

header("location:http://localhost:8080/PPB/latihan2/jabatan/tampilkan.php");
?>