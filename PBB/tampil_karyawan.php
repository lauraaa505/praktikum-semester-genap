<?php 
// membuat koneksi ke database mysql
$murid = new mysqli('localhost','root','','PK2',);
if($murid->connect_error){
    die("Koneksi gagal: ".$murid->connect_error);
    // fungsi die untuk mematikan proses php
}
$query = "select * from karyawan";
// jalankan query
$result = $murid->query($query);
$res = $murid->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<br>
    <table>
        <thead>
            <tr>
                <th>Id Karyawan</th>
                <th>Nama Lengkap</th>
                <th>Tanggal Lahir</th>
                <th>Jenis Kelamin</th>
                <th>Id Jabatan</th>
            </tr>
        </thead>
        <tbody>
            <?php
                while ($ikan = $result->fetch_assoc()){
                    echo "<tr>
                            <td>".$ikan['id_karyawan']."</td>
                            <td>".$ikan['nama']."</td>
                            <td>".$ikan['tanggal_lahir']."</td>
                            <td>".$ikan['jenis_kelamin']."</td>
                            <td>".$ikan['id_jabatan']."</td>
                        </tr>
                    ";
                }
            ?>
        </tbody>
    </table>
    <br><br>
    <table>
        <thead>
            <tr>
                <th>Id Karyawan</th>
                <th>Nama Lengkap</th>
                <th>Tanggal Lahir</th>
                <th>Jenis Kelamin</th>
                <th>Id Jabatan</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            while ($ikan = $res->fetch_assoc()):?>
                <tr>
                    <td><?php echo $ikan['id_karyawan'];?></td>
                    <td><?=$ikan['nama'];?></td>
                    <td><?=$ikan['tanggal_lahir'];?></td>
                    <td><?=$ikan['jenis_kelamin'];?></td>
                    <td><?=$ikan['id_jabatan'];?></td>
                </tr>
            <?php endwhile;?>
        </tbody>
    </table>
</body>
</html>