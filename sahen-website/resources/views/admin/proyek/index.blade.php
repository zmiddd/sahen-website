@extends('layouts.admin')
@section('judul', 'Portofolio Proyek')
@section('konten')
<div class="konten-head">
    <div><h1>Portofolio Proyek</h1><p>{{ count($proyek) }} proyek tersimpan</p></div>
    <a href="{{ route('admin.proyek.create') }}" class="btn btn-primary btn-sm">+ Tambah Proyek</a>
</div>
<div class="panel">
    <table class="tabel">
        <thead><tr><th>Gambar</th><th>Judul</th><th>Klien</th><th>Kategori</th><th>Tahun</th><th>Unggulan</th><th>Aksi</th></tr></thead>
        <tbody>
        @foreach ($proyek as $p)
        <tr>
            <td><img class="thumb" src="{{ asset($p->gambar) }}" alt=""></td>
            <td><b>{{ $p->judul }}</b><br><small style="color:var(--muted)">{{ $p->lokasi }}</small></td>
            <td>{{ $p->klien }}</td>
            <td><span class="badge">{{ $p->kategori }}</span></td>
            <td>{{ $p->tahun }}</td>
            <td>{{ $p->unggulan ? 'Ya' : '-' }}</td>
            <td class="aksi-tabel">
                <a href="{{ route('admin.proyek.edit', $p->id) }}" class="btn btn-ghost btn-sm">Ubah</a>
                <form method="POST" action="{{ route('admin.proyek.destroy', $p->id) }}" onsubmit="return confirm('Hapus proyek ini?')">
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
