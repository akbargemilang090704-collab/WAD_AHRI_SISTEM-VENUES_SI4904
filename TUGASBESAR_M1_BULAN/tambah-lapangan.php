<?php
include "koneksi.php";

$pesan = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $namalapangan = $_POST["namalapangan"];
    $area = $_POST["area"];
    $jenisolahraga = $_POST["jenisolahraga"];
    $jenisrumputlantai = $_POST["jenisrumputlantai"];
    $ukuranlapangan = $_POST["ukuranlapangan"];
    $statusfisik = $_POST["statusfisik"];

    $sql = "INSERT INTO lapangan 
            (nama_lapangan, area, jenis_olahraga, jenis_rumput_lantai, ukuran_lapangan, status_fisik)
            VALUES 
            ('$namalapangan', '$area', '$jenisolahraga', '$jenisrumputlantai', '$ukuranlapangan', '$statusfisik')";

    if (mysqli_query($koneksi, $sql) ) {
        header("Location: index.php");
        exit;
    } else {
        $pesan = "Data gagal disimpan";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Tambah Lapangan</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

<div class="container">

    <h2>Tambah Lapangan</h2>

    <form method="POST" action="">

        <label>Nama Lapangan</label>
        <input type="text" name="namalapangan" required>

        <label>Area</label>
        <select name="area" required>
            <option value="">Pilih Area</option>
            <option value="Indoor">Indoor</option>
            <option value="Outdoor">Outdoor</option>
        </select>

        <label>Jenis Olahraga</label>
        <select name="jenisolahraga" required>
            <option value="">Pilih Jenis Olahraga</option>
            <option value="Futsal">Futsal</option>
            <option value="Basket">Basket</option>
            <option value="Badminton">Badminton</option>
            <option value="Voli">Voli</option>
            <option value="Tenis">Tenis</option>
        </select>

        <label>Jenis Rumput/Lantai</label>
        <select name="jenisrumputlantai" required>
            <option value="">Pilih Jenis Rumput/Lantai</option>
            <option value="Rumput Sintetis">Rumput Sintetis</option>
            <option value="Vinyl">Vinyl</option>
            <option value="Parquet">Parquet</option>
            <option value="Beton">Beton</option>
            <option value="Semen">Semen</option>
        </select>

        <label>Ukuran Lapangan</label>
        <select name="ukuranlapangan" required>
            <option value="">Pilih Ukuran Lapangan</option>
            <option value="25 x 15 m">25 x 15 m</option>
            <option value="28 x 15 m">28 x 15 m</option>
            <option value="13,4 x 6,1 m">13,4 x 6,1 m</option>
            <option value="18 x 9 m">18 x 9 m</option>
            <option value="23,77 x 10,97 m">23,77 x 10,97 m</option>
        </select>

        <label>Status Fisik</label>
        <select name="statusfisik" required>
            <option value="">Pilih Status Fisik</option>
            <option value="Baik">Baik</option>
            <option value="Perlu Perawatan">Perlu Perawatan</option>
            <option value="Rusak">Rusak</option>
        </select>

        <button type="reset">Batal</button>
        <button type="submit">Simpan</button>

    </form>

</div>

</body>
</html>