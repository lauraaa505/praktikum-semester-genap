<?php 
// membuat koneksi ke database mysql
$murid = new mysqli('localhost','root','','sekolah',);
if($murid->connect_error){
    die("Koneksi gagal: ".$murid->connect_error);
    // fungsi die untuk mematikan proses php
}