<div class="row g-3">
<div class="col-md-6"><label class="form-label">Username</label><input type="text" name="username" value="{{ old('username', $user->username) }}" class="form-control @error('username') is-invalid @enderror">@error('username')<div class="invalid-feedback">{{ $message }}</div>@enderror</div>
<div class="col-md-6"><label class="form-label">Nama</label><input type="text" name="nama" value="{{ old('nama', $user->nama) }}" class="form-control @error('nama') is-invalid @enderror">@error('nama')<div class="invalid-feedback">{{ $message }}</div>@enderror</div>
<div class="col-md-6"><label class="form-label">Password @if($user->exists)<small class="text-muted">(kosongkan jika tidak diubah)</small>@endif</label><input type="password" name="password" class="form-control @error('password') is-invalid @enderror">@error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror</div>
<div class="col-md-6"><label class="form-label">Konfirmasi Password</label><input type="password" name="password_confirmation" class="form-control"></div>
<div class="col-md-6"><label class="form-label">Role</label>
<select name="role" class="form-select @error('role') is-invalid @enderror">
@foreach (['admin' => 'Admin', 'user' => 'User'] as $val => $label)
<option value="{{ $val }}" @selected(old('role', $user->role ?? 'user') === $val)>{{ $label }}</option>
@endforeach
</select>@error('role')<div class="invalid-feedback">{{ $message }}</div>@enderror</div></div>
