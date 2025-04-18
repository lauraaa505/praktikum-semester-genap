<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Toko bheka</title>
    <link rel="stylesheet" href="assets/boostrap.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="assets/main.css">
</head>

<body class=" bg-body-tertiary">
    <div id="main" class="d-flex">
        <?php
        // masukkan file sidebar
        include "template/sidebar.php";
        // tampilkan konten sesuai request
        $halaman = isset($_GET['halaman'])?$_GET['halaman']:"dasboard";
        // muat file halaman
        if(file_exists("pages/$halaman.php")){
            include "pages/$halaman.php";
        }else{
            include "pages/404.php";
        }
       
        
        ?>
    </div>
</body>

</html>