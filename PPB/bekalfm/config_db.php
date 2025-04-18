<?php
$murid = new mysqli('localhost', 'root', '', 'ikan');
$query = "select * from petugas";
$result = $murid->query($query);
?>