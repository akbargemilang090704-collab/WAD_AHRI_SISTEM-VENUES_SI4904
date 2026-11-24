<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sistem Rental Alat Olahraga</title>
    <style>
        :root {
            color-scheme: light;
            font-family: Arial, Helvetica, sans-serif;
            color: #252a2e;
            background: #f6f7f8;
        }

        * { box-sizing: border-box; }

        body {
            margin: 0;
            min-height: 100vh;
            padding: 46px 24px;
        }

        main {
            width: min(1015px, 100%);
            margin: 0 auto;
        }

        .page-heading {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
            margin-bottom: 24px;
        }

        h1 {
            margin: 0;
            font-size: clamp(22px, 3vw, 29px);
            font-weight: 600;
        }

        button, .button {
            border: 0;
            border-radius: 5px;
            color: white;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font: inherit;
            font-size: 14px;
            line-height: 1.2;
            padding: 9px 13px;
            text-decoration: none;
        }

        .primary { background: #0d6efd; }
        .primary:hover { background: #0b5ed7; }
        .edit { background: #ffc107; color: #202124; }
        .delete { background: #dc3545; }
        .secondary { background: #6c757d; }

        .table-card {
            overflow-x: auto;
            padding: 14px;
            border: 1px solid #d9dcdf;
            border-radius: 6px;
            background: white;
            box-shadow: 0 2px 4px rgb(0 0 0 / 8%);
        }

        table {
            width: 100%;
            min-width: 650px;
            border-collapse: collapse;
            font-size: 14px;
        }

        th, td {
            border: 1px solid #d9dcdf;
            padding: 10px 8px;
            text-align: left;
        }

        th {
            background: #212529;
            color: white;
            font-weight: 700;
        }

        tbody tr:nth-child(odd) { background: #f1f1f1; }
        .badge {
            display: inline-block;
            border-radius: 6px;
            padding: 4px 8px;
            font-size: 12px;
            font-weight: 700;
        }

        .badge-ready { background: #ffc107; color: #212529; }
        .badge-damaged { background: #dc3545; color: white; }
        .actions { display: flex; gap: 5px; }
        .actions form { margin: 0; }

        .notice {
            margin-bottom: 16px;
            border: 1px solid #badbcc;
            border-radius: 5px;
            background: #d1e7dd;
            color: #0f5132;
            padding: 12px 14px;
        }

        .empty-state {
            padding: 24px;
            color: #62676c;
            text-align: center;
        }

        dialog {
            width: min(460px, calc(100% - 32px));
            border: 0;
            border-radius: 8px;
            padding: 24px;
            box-shadow: 0 12px 40px rgb(0 0 0 / 25%);
        }

        dialog::backdrop { background: rgb(20 24 28 / 48%); }
        dialog h2 { margin: 0 0 20px; font-size: 21px; }
        .field { margin-bottom: 15px; }
        .field label { display: block; margin-bottom: 6px; font-size: 14px; font-weight: 600; }
        .field input, .field select {
            width: 100%;
            border: 1px solid #ced4da;
            border-radius: 5px;
            background: white;
            font: inherit;
            padding: 10px;
        }

        .field input:focus, .field select:focus {
            border-color: #86b7fe;
            outline: 3px solid rgb(13 110 253 / 18%);
        }

        .field-error { margin-top: 5px; color: #b02a37; font-size: 13px; }
        .dialog-actions { display: flex; justify-content: flex-end; gap: 8px; margin-top: 20px; }

        @media (max-width: 600px) {
            body { padding: 28px 14px; }
            .page-heading { align-items: flex-start; }
            .page-heading .primary { white-space: nowrap; }
        }
    </style>
</head>
<body>
<main>
    <div class="page-heading">
        <h1>Sistem Rental Alat Olahraga (Individu B)</h1>
        <button class="primary" type="button" id="add-alat">+ Tambah Alat Baru</button>
    </div>

    @if (session('status'))
        <div class="notice" role="status">{{ session('status') }}</div>
    @endif

    @if ($errors->any())
        <div class="notice" role="alert" style="border-color: #f1aeb5; background: #f8d7da; color: #842029;">
            Periksa kembali data yang dimasukkan.
        </div>
    @endif

    <section class="table-card" aria-label="Daftar alat olahraga">
        @if ($alatOlahragas->isEmpty())
            <div class="empty-state">Belum ada alat olahraga. Pilih â€œTambah Alat Baruâ€ untuk mulai mengisi inventaris.</div>
        @else
            <table>
                <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Nama Alat</th>
                    <th scope="col">Kondisi</th>
                    <th scope="col">Tarif Sewa</th>
                    <th scope="col">Aksi</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($alatOlahragas as $alat)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $alat->nama_alat }}</td>
                        <td>
                            <span class="badge {{ $alat->kondisi === 'Layak Pakai' ? 'badge-ready' : 'badge-damaged' }}">
                                {{ $alat->kondisi }}
                            </span>
                        </td>
                        <td>Rp {{ number_format($alat->tarif, 0, ',', '.') }} / hari</td>
                        <td>
                            <div class="actions">
                                <button
                                    class="edit edit-alat"
                                    type="button"
                                    data-id="{{ $alat->id }}"
                                    data-name="{{ $alat->nama_alat }}"
                                    data-condition="{{ $alat->kondisi }}"
                                    data-rate="{{ $alat->tarif }}"
                                    data-update-url="{{ route('alat-olahraga.update', $alat) }}"
                                >Edit</button>
                                <form action="{{ route('alat-olahraga.destroy', $alat) }}" method="POST" onsubmit="return confirm('Hapus alat olahraga ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="delete" type="submit">Hapus</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @endif
    </section>
</main>

<dialog id="alat-dialog">
    <form id="alat-form" action="{{ route('alat-olahraga.store') }}" method="POST">
        @csrf
        <input type="hidden" name="_method" id="form-method" value="PUT" disabled>
        <input type="hidden" name="record_id" id="record-id" value="{{ old('record_id') }}">
        <h2 id="dialog-title">Tambah Alat Baru</h2>

        <div class="field">
            <label for="nama_alat">Nama Alat</label>
            <input id="nama_alat" name="nama_alat" type="text" value="{{ old('nama_alat') }}" maxlength="255" required>
            @error('nama_alat') <div class="field-error">{{ $message }}</div> @enderror
        </div>

        <div class="field">
            <label for="kondisi">Kondisi</label>
            <select id="kondisi" name="kondisi" required>
                <option value="">Pilih kondisi</option>
                @foreach ($kondisis as $kondisi)
                    <option value="{{ $kondisi }}" @selected(old('kondisi') === $kondisi)>{{ $kondisi }}</option>
                @endforeach
            </select>
            @error('kondisi') <div class="field-error">{{ $message }}</div> @enderror
        </div>

        <div class="field">
            <label for="tarif">Tarif Sewa per Hari (Rp)</label>
            <input id="tarif" name="tarif" type="number" min="0" step="1" value="{{ old('tarif') }}" required>
            @error('tarif') <div class="field-error">{{ $message }}</div> @enderror
        </div>

        <div class="dialog-actions">
            <button class="secondary" type="button" id="close-dialog">Batal</button>
            <button class="primary" type="submit" id="submit-label">Simpan</button>
        </div>
    </form>
</dialog>

<script>
    const dialog = document.getElementById('alat-dialog');
    const form = document.getElementById('alat-form');
    const methodField = document.getElementById('form-method');
    const recordId = document.getElementById('record-id');
    const dialogTitle = document.getElementById('dialog-title');
    const submitLabel = document.getElementById('submit-label');
    const updateUrlTemplate = @json(route('alat-olahraga.update', '__ID__'));

    function openCreateDialog() {
        form.reset();
        form.action = @json(route('alat-olahraga.store'));
        methodField.disabled = true;
        recordId.value = '';
        dialogTitle.textContent = 'Tambah Alat Baru';
        submitLabel.textContent = 'Simpan';
        dialog.showModal();
    }

    document.getElementById('add-alat').addEventListener('click', openCreateDialog);
    document.getElementById('close-dialog').addEventListener('click', () => dialog.close());

    document.querySelectorAll('.edit-alat').forEach((button) => {
        button.addEventListener('click', () => {
            form.reset();
            form.action = button.dataset.updateUrl;
            methodField.disabled = false;
            recordId.value = button.dataset.id;
            document.getElementById('nama_alat').value = button.dataset.name;
            document.getElementById('kondisi').value = button.dataset.condition;
            document.getElementById('tarif').value = button.dataset.rate;
            dialogTitle.textContent = 'Edit Alat Olahraga';
            submitLabel.textContent = 'Simpan Perubahan';
            dialog.showModal();
        });
    });

    @if ($errors->any())
        const failedRecordId = @json(old('record_id'));
        if (failedRecordId) {
            form.action = updateUrlTemplate.replace('__ID__', encodeURIComponent(failedRecordId));
            methodField.disabled = false;
            dialogTitle.textContent = 'Edit Alat Olahraga';
            submitLabel.textContent = 'Simpan Perubahan';
        }
        dialog.showModal();
    @endif
</script>
</body>
</html>

