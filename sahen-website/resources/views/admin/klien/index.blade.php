@extends('layouts.admin')
@section('judul', 'Klien')
@section('konten')
<div class="konten-head">
    <div><h1>Klien</h1><p>Logo klien yang ditampilkan pada beranda</p></div>
    <a href="{{ route('admin.klien.create') }}" class="btn btn-primary btn-sm">+ Tambah Klien</a>
</div>
<div class="panel">
    <table class="tabel">
        <thead><tr><th>Urutan</th><th>Logo</th><th>Nama</th><th>Aksi</th></tr></thead>
        <tbody>
        @foreach ($klien as $k)
        <tr>
            <td>{{ $k->urutan }}</td>
            <td>@if ($k->logo)<img class="logo" src="{{ asset($k->logo) }}" alt="">@endif</td>
            <td><b>{{ $k->nama }}</b></td>
            <td class="aksi-tabel">
                <a href="{{ route('admin.klien.edit', $k->id) }}" class="btn btn-ghost btn-sm">Ubah</a>
                <form method="POST" action="{{ route('admin.klien.destroy', $k->id) }}" onsubmit="return confirm('Hapus klien ini?')">
                    @csrf @method('DELETE')
                    <button class="btn btn-danger btn-sm">Hapus</button>
                </form>
            </td>
        </tr>
        @endforeach
        </tbody>
    </table>
</div>
@endsection
