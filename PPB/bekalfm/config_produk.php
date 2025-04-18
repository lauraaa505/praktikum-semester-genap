<?php
$murid = new mysqli('localhost', 'root', '', 'ikan');
$query = "select * from produk";
$result = $murid->query($query);
?>