@php
    $fields = ['kode_mk' => 'Kode MK', 'nama_mk' => 'Nama Mata Kuliah', 'sks' => 'SKS', 'semester' => 'Semester'];
@endphp
@foreach ($fields as $name => $label)
    <div class="mb-3">
        <label class="form-label">{{ $label }}</label>
        <input type="{{ in_array($name, ['sks', 'semester']) ? 'number' : 'text' }}" name="{{ $name }}"
            value="{{ old($name, $matakuliah->$name) }}" class="form-control @error($name) is-invalid @enderror">
        @error($name)
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
@endforeach
<div class="mb-3">
    <label class="form-label">Dosen Pengampu</label>
    <select name="dosen_id" class="form-select @error('dosen_id') is-invalid @enderror">
        <option value="">-- Tanpa dosen --</option>
        @foreach ($dosens as $d)
            <option value="{{ $d->id }}" @selected((string) old('dosen_id', $matakuliah->dosen_id) === (string) $d->id)>
                {{ $d->name }}
            </option>
        @endforeach
    </select>
    @error('dosen_id')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>
<button type="submit" class="btn btn-primary">Simpan</button>
<a href="{{ route('matakuliah.index') }}" class="btn btn-link">Batal</a>
