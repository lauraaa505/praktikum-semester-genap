<?php
$murid = new mysqli('localhost','root','','PK2');
$query = "select * from absensi";
$result = $murid->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <table>
        <thead>
            <tr>
                <th>Id Absensi</th>
                <th>Id Karyawan</th>
                <th>Tanggal</th>
                <th>Jam Keluar</th>
                <th>Jam Masuk</th>
            </tr>
        </thead>
        <tbody>
            <?php
            while ($ikan = $result->fetch_assoc()):?>
                <tr>
                    <td><?php echo $ikan['id_absensi'];?></td>
                    <td><?=$ikan['id_karyawan'];?></td>
                    <td><?=$ikan['tanggal'];?></td>
                    <td><?=$ikan['jam_keluar'];?></td>
                    <td><?=$ikan['jam_masuk'];?></td>
                </tr>
            <?php endwhile;?>
        </tbody>
    </table>
</body>
</html>