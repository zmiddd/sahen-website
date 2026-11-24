@extends('layouts.public')
@section('judul', $proyek->judul)
@section('konten')
<section class="detail-hero">
    <div class="wrap">
        <div class="crumb">Beranda &rsaquo; <a href="{{ route('portofolio') }}">Portofolio</a> &rsaquo; {{ $proyek->kategori }}</div>
        <span class="badge">{{ $proyek->kategori }}</span>
        <h1 style="margin-top:.5rem">{{ $proyek->judul }}</h1>
    </div>
</section>
<section class="section">
    <div class="wrap">
        <div class="detail-grid">
            <div>
                <div class="foto"><img src="{{ asset($proyek->gambar) }}" alt="{{ $proyek->judul }}"></div>
                <h2 style="margin-top:1.5rem">Deskripsi Pekerjaan</h2>
                <p>{{ $proyek->deskripsi }}</p>
            </div>
            <aside>
                <div class="panel">
                    <h2>Informasi Proyek</h2>
                    <ul class="info-list">
                        <li><span>Klien</span><b>{{ $proyek->klien }}</b></li>
                        <li><span>Lokasi</span><b>{{ $proyek->lokasi }}</b></li>
                        <li><span>Kategori</span><b>{{ $proyek->kategori }}</b></li>
                        <li><span>Tahun</span><b>{{ $proyek->tahun }}</b></li>
                    </ul>
                    <a href="{{ route('kontak') }}" class="btn btn-primary" style="width:100%;justify-content:center;margin-top:1rem">Konsultasikan Proyek Serupa</a>
                </div>
            </aside>
        </div>
        @if (count($terkait))
        <h2 style="margin-top:3rem">Proyek Terkait</h2>
        <div class="proyek-grid">
            @foreach ($terkait as $p)
            <article class="proyek">
                <div class="foto"><img src="{{ asset($p->gambar) }}" alt="{{ $p->judul }}"></div>
                <div class="isi">
                    <span class="badge">{{ $p->kategori }}</span>
                    <h3><a href="{{ route('portofolio.detail', $p->slug) }}">{{ $p->judul }}</a></h3>
                    <div class="meta">{{ $p->klien }} &middot; {{ $p->tahun }}</div>
                </div>
            </article>
            @endforeach
        </div>
        @endif
    </div>
</section>
@endsection
