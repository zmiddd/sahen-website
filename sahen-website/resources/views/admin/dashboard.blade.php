@extends('layouts.admin')
@section('judul', 'Dashboard')
@section('konten')
<div class="konten-head">
    <div><h1>Dashboard</h1><p>Ringkasan konten website {{ $site['nama_perusahaan'] ?? '' }}</p></div>
    <a href="{{ route('admin.proyek.create') }}" class="btn btn-primary btn-sm">+ Tambah Proyek</a>
</div>
<div class="tile-grid">
    <div class="tile"><div class="ikon">@include('partials.ikon', ['nama' => 'civil'])</div><div><b>{{ $jumlahProyek }}</b><span>Proyek portofolio</span></div></div>
    <div class="tile"><div class="ikon">@include('partials.ikon', ['nama' => 'gear'])</div><div><b>{{ $jumlahLayanan }}</b><span>Layanan</span></div></div>
    <div class="tile"><div class="ikon">@include('partials.ikon', ['nama' => 'users'])</div><div><b>{{ $jumlahKlien }}</b><span>Klien</span></div></div>
    <div class="tile gold"><div class="ikon">@include('partials.ikon', ['nama' => 'mail'])</div><div><b>{{ $pesanBaru }}</b><span>Pesan belum dibaca</span></div></div>
</div>
<div class="grid-2" style="align-items:start">
    <div class="panel">
        <h2>Pesan Terbaru</h2>
        <table class="tabel">
            <thead><tr><th>Pengirim</th><th>Subjek</th><th>Status</th></tr></thead>
            <tbody>
            @forelse ($pesanTerbaru as $m)
            <tr><td>{{ $m->nama }}<br><small style="color:var(--muted)">{{ $m->email }}</small></td><td>{{ $m->subjek }}</td><td><span class="status {{ $m->dibaca ? 'dibaca' : 'baru' }}">{{ $m->dibaca ? 'Dibaca' : 'Baru' }}</span></td></tr>
            @empty
            <tr><td colspan="3">Belum ada pesan masuk.</td></tr>
            @endforelse
            </tbody>
        </table>
    </div>
    <div class="panel">
        <h2>Proyek Terakhir Ditambahkan</h2>
        <table class="tabel">
            <thead><tr><th>Proyek</th><th>Kategori</th><th>Tahun</th></tr></thead>
            <tbody>
            @foreach ($proyekTerbaru as $p)
            <tr><td>{{ $p->judul }}</td><td>{{ $p->kategori }}</td><td>{{ $p->tahun }}</td></tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
