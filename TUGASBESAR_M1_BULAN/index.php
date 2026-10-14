<?php
include "koneksi.php";

$data = mysqli_query($koneksi, "SELECT * FROM lapangan");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Master Data Lapangan dan Area</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

<div class="container">

    <h2>Master Data Lapangan dan Area</h2>

    <a href="tambah-lapangan.php">+ Tambah Lapangan</a>

    <br><br>

    <table border="1" cellpadding="8">
        <tr>
            <th>Nama Lapangan</th>
            <th>Area</th>
            <th>Jenis Olahraga</th>
            <th>Jenis Rumput/Lantai</th>
            <th>Ukuran</th>
            <th>Status Fisik</th>
            <th>Aksi</th>
        </tr>

        <?php while ($row = mysqli_fetch_assoc($data)) { ?>

        <tr>
            <td><?php echo $row["nama_lapangan"]; ?></td>
            <td><?php echo $row["area"]; ?></td>
            <td><?php echo $row["jenis_olahraga"]; ?></td>
            <td><?php echo $row["jenis_rumput_lantai"]; ?></td>
            <td><?php echo $row["ukuran_lapangan"]; ?></td>
            <td><?php echo $row["status_fisik"]; ?></td>
            <td>
                <a href="edit.php?id=<?php echo $row["id_lapangan"]; ?>">Edit</a>
                |
                <a href="hapus.php?id=<?php echo $row["id_lapangan"]; ?>">Hapus</a>
            </td>
        </tr>

        <?php } ?>

    </table>

</div>

</body>
</html>