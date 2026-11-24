@extends('layouts.admin')
@section('judul', 'Layanan')
@section('konten')
<div class="konten-head">
    <div><h1>Layanan</h1><p>Daftar lini layanan yang ditampilkan di website</p></div>
    <a href="{{ route('admin.layanan.create') }}" class="btn btn-primary btn-sm">+ Tambah Layanan</a>
</div>
<div class="panel">
    <table class="tabel">
        <thead><tr><th>Urutan</th><th>Nama</th><th>Deskripsi</th><th>Aksi</th></tr></thead>
        <tbody>
        @foreach ($layanan as $l)
        <tr>
            <td>{{ $l->urutan }}</td>
            <td><b>{{ $l->nama }}</b></td>
            <td style="color:var(--muted)">{{ $l->deskripsi }}</td>
            <td class="aksi-tabel">
                <a href="{{ route('admin.layanan.edit', $l->id) }}" class="btn btn-ghost btn-sm">Ubah</a>
                <form method="POST" action="{{ route('admin.layanan.destroy', $l->id) }}" onsubmit="return confirm('Hapus layanan ini?')">
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
