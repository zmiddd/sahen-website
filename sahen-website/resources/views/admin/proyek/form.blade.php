@extends('layouts.admin')
@section('judul', $proyek->id ? 'Ubah Proyek' : 'Tambah Proyek')
@section('konten')
<div class="konten-head">
    <div><h1>{{ $proyek->id ? 'Ubah Proyek' : 'Tambah Proyek' }}</h1><p>Lengkapi informasi proyek untuk ditampilkan pada halaman portofolio.</p></div>
    <a href="{{ route('admin.proyek.index') }}" class="btn btn-ghost btn-sm">&larr; Kembali</a>
</div>
<form class="panel" method="POST" action="{{ $proyek->id ? route('admin.proyek.update', $proyek->id) : route('admin.proyek.store') }}" enctype="multipart/form-data">
    @csrf
    @if ($proyek->id) @method('PUT') @endif
    @if ($errors->any())
    <div class="alert alert-error">Mohon periksa kembali isian formulir.</div>
    @endif
    <div class="form-grid">
        <div class="full">
            <label for="judul">Judul Proyek</label>
            <input type="text" id="judul" name="judul" value="{{ old('judul', $proyek->judul) }}" required>
        </div>
        <div>
            <label for="klien">Klien</label>
            <input type="text" id="klien" name="klien" value="{{ old('klien', $proyek->klien) }}">
        </div>
        <div>
            <label for="lokasi">Lokasi</label>
            <input type="text" id="lokasi" name="lokasi" value="{{ old('lokasi', $proyek->lokasi) }}">
        </div>
        <div>
            <label for="kategori">Kategori</label>
            <select id="kategori" name="kategori">
                @foreach (['Building', 'Civil Construction', 'Mechanical Electrical', 'Machine Maker', 'General Contractor'] as $k)
                <option value="{{ $k }}" {{ old('kategori', $proyek->kategori) === $k ? 'selected' : '' }}>{{ $k }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label for="tahun">Tahun</label>
            <input type="number" id="tahun" name="tahun" min="2000" max="2100" value="{{ old('tahun', $proyek->tahun) }}">
        </div>
        <div class="full">
            <label for="deskripsi">Deskripsi Pekerjaan</label>
            <textarea id="deskripsi" name="deskripsi">{{ old('deskripsi', $proyek->deskripsi) }}</textarea>
        </div>
        <div>
            <label for="gambar">Foto Proyek</label>
            <input type="file" id="gambar" name="gambar" accept="image/*">
            <p class="hint">JPG/PNG maks. 2 MB. Kosongkan jika tidak ingin mengganti foto.</p>
            @if ($proyek->gambar)<img src="{{ asset($proyek->gambar) }}" alt="" style="height:90px;border-radius:8px;margin-top:.5rem">@endif
        </div>
        <div>
            <label>Tampilkan di Beranda</label>
            <label style="display:flex;gap:.5rem;align-items:center;font-weight:500;margin-top:.4rem"><input type="checkbox" name="unggulan" value="1" {{ old('unggulan', $proyek->unggulan) ? 'checked' : '' }}> Jadikan proyek unggulan</label>
        </div>
    </div>
    <button type="submit" class="btn btn-navy" style="margin-top:1.5rem">Simpan Proyek</button>
</form>
@endsection
