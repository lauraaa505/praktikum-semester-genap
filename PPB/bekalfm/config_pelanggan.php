<?php
$murid = new mysqli('localhost', 'root', '', 'ikan');
$query = "select * from pelanggan";
$result_pelanggan = $murid->query($query);
?>