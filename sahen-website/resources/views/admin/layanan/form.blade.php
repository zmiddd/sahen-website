@extends('layouts.admin')
@section('judul', $layanan->id ? 'Ubah Layanan' : 'Tambah Layanan')
@section('konten')
<div class="konten-head">
    <div><h1>{{ $layanan->id ? 'Ubah Layanan' : 'Tambah Layanan' }}</h1></div>
    <a href="{{ route('admin.layanan.index') }}" class="btn btn-ghost btn-sm">&larr; Kembali</a>
</div>
<form class="panel" method="POST" action="{{ $layanan->id ? route('admin.layanan.update', $layanan->id) : route('admin.layanan.store') }}">
    @csrf
    @if ($layanan->id) @method('PUT') @endif
    <div class="form-grid">
        <div>
            <label for="nama">Nama Layanan</label>
            <input type="text" id="nama" name="nama" value="{{ old('nama', $layanan->nama) }}" required>
        </div>
        <div>
            <label for="ikon">Ikon</label>
            <select id="ikon" name="ikon">
                @foreach (['building' => 'Gedung', 'civil' => 'Konstruksi Sipil', 'bolt' => 'Listrik', 'gear' => 'Mesin', 'helmet' => 'Helm Proyek', 'box' => 'Kotak / Supplier'] as $kode => $label)
                <option value="{{ $kode }}" {{ old('ikon', $layanan->ikon) === $kode ? 'selected' : '' }}>{{ $label }}</option>
                @endforeach
            </select>
        </div>
        <div class="full">
            <label for="deskripsi">Deskripsi</label>
            <textarea id="deskripsi" name="deskripsi" required>{{ old('deskripsi', $layanan->deskripsi) }}</textarea>
        </div>
        <div>
            <label for="urutan">Urutan Tampil</label>
            <input type="number" id="urutan" name="urutan" min="0" value="{{ old('urutan', $layanan->urutan ?? 0) }}">
        </div>
    </div>
    <button type="submit" class="btn btn-navy" style="margin-top:1.5rem">Simpan Layanan</button>
</form>
@endsection
