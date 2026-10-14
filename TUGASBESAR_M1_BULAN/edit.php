<?php
include "koneksi.php";

$id = $_GET["id"];

$data = mysqli_query($koneksi, "SELECT * FROM lapangan WHERE id_lapangan='$id'");
$row = mysqli_fetch_assoc($data);

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $namalapangan = $_POST["namalapangan"];
    $area = $_POST["area"];
    $jenisolahraga = $_POST["jenisolahraga"];
    $jenisrumputlantai = $_POST["jenisrumputlantai"];
    $ukuranlapangan = $_POST["ukuranlapangan"];
    $statusfisik = $_POST["statusfisik"];

    $sql = "UPDATE lapangan SET
            nama_lapangan='$namalapangan',
            area='$area',
            jenis_olahraga='$jenisolahraga',
            jenis_rumput_lantai='$jenisrumputlantai',
            ukuran_lapangan='$ukuranlapangan',
            status_fisik='$statusfisik'
            WHERE id_lapangan='$id'";

    mysqli_query($koneksi, $sql);

    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Lapangan</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

<div class="container">

    <h2>Edit Lapangan</h2>

    <form method="POST">

        <label>Nama Lapangan</label>
        <input type="text" name="namalapangan"
               value="<?php echo $row['nama_lapangan']; ?>" required>

        <label>Area</label>
        <select name="area" required>
            <option value="Indoor" <?php if ($row['area']=="Indoor") echo "selected"; ?>>Indoor</option>
            <option value="Outdoor" <?php if ($row['area']=="Outdoor") echo "selected"; ?>>Outdoor</option>
        </select>

        <label>Jenis Olahraga</label>
        <select name="jenisolahraga" required>
            <option value="Futsal" <?php if ($row['jenis_olahraga']=="Futsal") echo "selected"; ?>>Futsal</option>
            <option value="Basket" <?php if ($row['jenis_olahraga']=="Basket") echo "selected"; ?>>Basket</option>
            <option value="Badminton" <?php if ($row['jenis_olahraga']=="Badminton") echo "selected"; ?>>Badminton</option>
            <option value="Voli" <?php if ($row['jenis_olahraga']=="Voli") echo "selected"; ?>>Voli</option>
            <option value="Tenis" <?php if ($row['jenis_olahraga']=="Tenis") echo "selected"; ?>>Tenis</option>
        </select>

        <label>Jenis Rumput/Lantai</label>
        <select name="jenisrumputlantai" required>
            <option value="Rumput Sintetis" <?php if ($row['jenis_rumput_lantai']=="Rumput Sintetis") echo "selected"; ?>>Rumput Sintetis</option>
            <option value="Vinyl" <?php if ($row['jenis_rumput_lantai']=="Vinyl") echo "selected"; ?>>Vinyl</option>
            <option value="Parquet" <?php if ($row['jenis_rumput_lantai']=="Parquet") echo "selected"; ?>>Parquet</option>
            <option value="Beton" <?php if ($row['jenis_rumput_lantai']=="Beton") echo "selected"; ?>>Beton</option>
            <option value="Semen" <?php if ($row['jenis_rumput_lantai']=="Semen") echo "selected"; ?>>Semen</option>
        </select>

        <label>Ukuran Lapangan</label>
        <select name="ukuranlapangan" required>
            <option value="25 x 15 m" <?php if ($row['ukuran_lapangan']=="25 x 15 m") echo "selected"; ?>>25 x 15 m</option>
            <option value="28 x 15 m" <?php if ($row['ukuran_lapangan']=="28 x 15 m") echo "selected"; ?>>28 x 15 m</option>
            <option value="13,4 x 6,1 m" <?php if ($row['ukuran_lapangan']=="13,4 x 6,1 m") echo "selected"; ?>>13,4 x 6,1 m</option>
            <option value="18 x 9 m" <?php if ($row['ukuran_lapangan']=="18 x 9 m") echo "selected"; ?>>18 x 9 m</option>
            <option value="23,77 x 10,97 m" <?php if ($row['ukuran_lapangan']=="23,77 x 10,97 m") echo "selected"; ?>>23,77 x 10,97 m</option>
        </select>

        <label>Status Fisik</label>
        <select name="statusfisik" required>
            <option value="Baik" <?php if ($row['status_fisik']=="Baik") echo "selected"; ?>>Baik</option>
            <option value="Perlu Perawatan" <?php if ($row['status_fisik']=="Perlu Perawatan") echo "selected"; ?>>Perlu Perawatan</option>
            <option value="Rusak" <?php if ($row['status_fisik']=="Rusak") echo "selected"; ?>>Rusak</option>
        </select>

        <button type="submit">Simpan Perubahan</button>

    </form>

</div>

</body>
</html>