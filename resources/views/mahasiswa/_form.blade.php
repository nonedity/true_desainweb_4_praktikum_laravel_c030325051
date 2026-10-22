@php
    $fields = ['nim' => 'NIM', 'nama' => 'Nama', 'email' => 'Email', 'prodi' => 'Prodi', 'semester' => 'Semester'];
@endphp
@foreach ($fields as $name => $label)
    <div class="mb-3">
        <label class="form-label">{{ $label }}</label>
        <input type="{{ $name === 'email' ? 'email' : ($name === 'semester' ? 'number' : 'text') }}"
            name="{{ $name }}" value="{{ old($name, $mahasiswa->$name) }}"
            class="form-control @error($name) is-invalid @enderror">
        @error($name)
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
@endforeach
<button type="submit" class="btn btn-primary">Simpan</button>
<a href="{{ route('mahasiswa.index') }}" class="btn btn-link">Batal</a>
