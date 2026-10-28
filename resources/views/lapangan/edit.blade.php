<!DOCTYPE html>
<html>
<head>
    <title>Edit Lapangan</title>
</head>
<body>
    <h1>Edit Data Lapangan</h1>

    <form action="{{ route('lapangan.update', $lapangan->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div>
            <label>Nama Lapangan:</label><br>
            <input type="text" name="nama_lapangan" value="{{ $lapangan->nama_lapangan }}" required>
        </div>
        <br>
        <div>
            <label>Jenis:</label><br>
            <input type="text" name="jenis" value="{{ $lapangan->jenis }}" required>
        </div>
        <br>
        <div>
            <label>Harga / Jam:</label><br>
            <input type="number" name="harga" value="{{ $lapangan->harga }}" required>
        </div>
        <br>
        <div>
            <label>Deskripsi:</label><br>
            <textarea name="deskripsi">{{ $lapangan->deskripsi }}</textarea>
        </div>
        <br>
        <button type="submit">Update Data</button>
        <a href="{{ route('lapangan.index') }}">Kembali</a>
    </form>
</body>
</html>