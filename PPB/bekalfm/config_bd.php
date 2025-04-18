<?php
$murid = new mysqli('localhost', 'root', '', 'Aplikasi');
$query = "select * from books";
$result = $murid->query($query);
?>