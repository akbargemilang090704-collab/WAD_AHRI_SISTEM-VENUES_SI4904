<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Lapangan</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 40px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 10px; text-align: left; }
        th { background-color: #f4f4f4; }
    </style>
</head>
<body>

    <h1>Daftar Lapangan</h1>
    <p>Berikut adalah data lapangan yang tersedia:</p>
    <a href="/lapangan/create">+ Tambah Lapangan Baru</a>


    <table border="1" cellpadding="10" cellspacing="0">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Lapangan</th>
                <th>Jenis</th>
                <th>Harga / Jam</th>
                <th>Deskripsi</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($lapangans as $key => $lapangan)
            <tr>
                <td>{{ $key + 1 }}</td>
                <td>{{ $lapangan->nama_lapangan }}</td>
                <td>{{ $lapangan->jenis }}</td>
                <td>Rp {{ number_format($lapangan->harga, 0, ',', '.') }}</td>
                <td>{{ $lapangan->deskripsi }}</td>
                <td>
                    <a href="{{ route('lapangan.edit', $lapangan->id) }}">Edit</a>
                    <form action="{{ route('lapangan.destroy', $lapangan->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('Yakin mau hapus data ini?')">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

</body>
</html>