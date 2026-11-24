@extends('layouts.admin')
@section('judul', $klien->id ? 'Ubah Klien' : 'Tambah Klien')
@section('konten')
<div class="konten-head">
    <div><h1>{{ $klien->id ? 'Ubah Klien' : 'Tambah Klien' }}</h1></div>
    <a href="{{ route('admin.klien.index') }}" class="btn btn-ghost btn-sm">&larr; Kembali</a>
</div>
<form class="panel" method="POST" action="{{ $klien->id ? route('admin.klien.update', $klien->id) : route('admin.klien.store') }}" enctype="multipart/form-data">
    @csrf
    @if ($klien->id) @method('PUT') @endif
    <div class="form-grid">
        <div>
            <label for="nama">Nama Klien</label>
            <input type="text" id="nama" name="nama" value="{{ old('nama', $klien->nama) }}" required>
        </div>
        <div>
            <label for="urutan">Urutan Tampil</label>
            <input type="number" id="urutan" name="urutan" min="0" value="{{ old('urutan', $klien->urutan ?? 0) }}">
        </div>
        <div class="full">
            <label for="logo">Logo</label>
            <input type="file" id="logo" name="logo" accept="image/*">
            <p class="hint">PNG dengan latar transparan/putih, maks. 1 MB.</p>
            @if ($klien->logo)<img src="{{ asset($klien->logo) }}" alt="" style="height:50px;margin-top:.5rem">@endif
        </div>
    </div>
    <button type="submit" class="btn btn-navy" style="margin-top:1.5rem">Simpan Klien</button>
</form>
@endsection
