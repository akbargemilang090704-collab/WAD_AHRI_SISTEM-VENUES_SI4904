<div class="row g-3">
    <div class="col-md-6">
        <label class="form-label">Nama</label>
        <input type="text" name="nama" value="{{ old('nama', $instruktur->nama) }}" class="form-control @error('nama') is-invalid @enderror">
        @error('nama')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-6">
        <label class="form-label">No. Lisensi</label>
        <input type="text" name="no_lisensi" value="{{ old('no_lisensi', $instruktur->no_lisensi) }}" class="form-control @error('no_lisensi') is-invalid @enderror">
        @error('no_lisensi')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-6">
        <label class="form-label">Keahlian</label>
        <input type="text" name="keahlian" value="{{ old('keahlian', $instruktur->keahlian) }}" class="form-control @error('keahlian') is-invalid @enderror">
        @error('keahlian')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-6">
        <label class="form-label">Telepon</label>
        <input type="text" name="telepon" value="{{ old('telepon', $instruktur->telepon) }}" class="form-control @error('telepon') is-invalid @enderror">
        @error('telepon')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-6">
        <label class="form-label">Status</label>
        <select name="status" class="form-select @error('status') is-invalid @enderror">
            @foreach (['Aktif', 'Nonaktif'] as $o)
                <option value="{{ $o }}" @selected(old('status', $instruktur->status ?? 'Aktif') == $o)>{{ $o }}</option>
            @endforeach
        </select>
        @error('status')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
</div>