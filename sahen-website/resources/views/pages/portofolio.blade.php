@extends('layouts.public')
@section('judul', 'Portofolio')
@section('konten')
<section class="detail-hero">
    <div class="wrap">
        <div class="crumb">Beranda &rsaquo; Portofolio</div>
        <h1>Portofolio Proyek</h1>
        <p style="color:var(--muted);max-width:720px">Rekam jejak pekerjaan {{ $site['nama_perusahaan'] ?? '' }} di berbagai sektor industri, pendidikan, perumahan, dan infrastruktur publik.</p>
    </div>
</section>
<section class="section">
    <div class="wrap">
        <div class="filter">
            <a href="{{ route('portofolio') }}" class="{{ $kategori ? '' : 'aktif' }}">Semua</a>
            @foreach ($daftarKategori as $k)
            <a href="{{ route('portofolio', ['kategori' => $k]) }}" class="{{ $kategori === $k ? 'aktif' : '' }}">{{ $k }}</a>
            @endforeach
        </div>
        <div class="proyek-grid">
            @forelse ($proyek as $p)
            <article class="proyek">
                <div class="foto"><img src="{{ asset($p->gambar) }}" alt="{{ $p->judul }}"></div>
                <div class="isi">
                    <span class="badge {{ $p->unggulan ? 'gold' : '' }}">{{ $p->unggulan ? 'Unggulan · ' : '' }}{{ $p->kategori }}</span>
                    <h3><a href="{{ route('portofolio.detail', $p->slug) }}">{{ $p->judul }}</a></h3>
                    <div class="meta">{{ $p->klien }} &middot; {{ $p->lokasi }} &middot; {{ $p->tahun }}</div>
                </div>
            </article>
            @empty
            <p>Belum ada proyek pada kategori ini.</p>
            @endforelse
        </div>
    </div>
</section>
@endsection
