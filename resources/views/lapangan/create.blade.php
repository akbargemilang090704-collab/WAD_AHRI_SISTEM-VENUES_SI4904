<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Lapangan</title>
</head>
<body>
    <h1>Tambah Data Lapangan</h1>

    <form action="/lapangan" method="POST">
        @csrf <!-- Wajib ada di Laravel agar formnya aman -->

        <div>
            <label>Nama Lapangan:</label><br>
            <input type="text" name="nama_lapangan" required>
        </div>
        <br>
        <div>
            <label>Jenis:</label><br>
            <input type="text" name="jenis" required>
        </div>
        <br>
        <div>
            <label>Harga / Jam:</label><br>
            <input type="number" name="harga" required>
        </div>
        <br>
        <div>
            <label>Deskripsi:</label><br>
            <textarea name="deskripsi"></textarea>
        </div>
        <br>
        <button type="submit">Simpan Data</button>
    </form>

    <br>
    <a href="/lapangan">Kembali ke Daftar Lapangan</a>
</body>
</html>