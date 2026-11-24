<div class="row g-3">
    <div class="col-md-6">
        <label class="form-label">Kode</label>
        <input type="text" name="kode" value="{{ old('kode', $lapangan->kode) }}"
               class="form-control @error('kode') is-invalid @enderror">
        @error('kode')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-6">
        <label class="form-label">Nama</label>
        <input type="text" name="nama" value="{{ old('nama', $lapangan->nama) }}"
               class="form-control @error('nama') is-invalid @enderror">
        @error('nama')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-6">
        <label class="form-label">Jenis Olahraga</label>
        <input type="text" name="jenis_olahraga" value="{{ old('jenis_olahraga', $lapangan->jenis_olahraga) }}"
               class="form-control @error('jenis_olahraga') is-invalid @enderror">
        @error('jenis_olahraga')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-6">
        <label class="form-label">Jenis Permukaan</label>
        <input type="text" name="jenis_permukaan" value="{{ old('jenis_permukaan', $lapangan->jenis_permukaan) }}"
               class="form-control @error('jenis_permukaan') is-invalid @enderror">
        @error('jenis_permukaan')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-6">
        <label class="form-label">Ukuran</label>
        <input type="text" name="ukuran" value="{{ old('ukuran', $lapangan->ukuran) }}"
               class="form-control @error('ukuran') is-invalid @enderror">
        @error('ukuran')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-6">
        <label class="form-label">Status Fisik</label>
        <select name="status_fisik" class="form-select @error('status_fisik') is-invalid @enderror">
            @foreach (['Baik', 'Perlu Perawatan', 'Rusak'] as $o)
                <option value="{{ $o }}" @selected(old('status_fisik', $lapangan->status_fisik ?? 'Baik') == $o)>
                    {{ $o }}
                </option>
            @endforeach
        </select>
        @error('status_fisik')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
</div>