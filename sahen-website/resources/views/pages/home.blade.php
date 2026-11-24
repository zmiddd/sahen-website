@extends('layouts.public')
@section('judul', 'Beranda')
@section('konten')
<section class="hero">
    <div class="wrap">
        <div>
            <span class="eyebrow">Berpengalaman sejak {{ $site['tahun_berdiri'] ?? '2006' }}</span>
            <h1>Mitra Konstruksi &amp; Rekayasa Terpercaya untuk Industri Anda</h1>
            <p>{{ $site['deskripsi_singkat'] ?? '' }}</p>
            <div class="aksi">
                <a href="{{ route('portofolio') }}" class="btn btn-primary">Lihat Portofolio</a>
                <a href="{{ route('kontak') }}" class="btn btn-outline">Hubungi Kami</a>
            </div>
        </div>
        <div class="hero-card">
            <h3>Lingkup Layanan</h3>
            <ul>
                @foreach ($layanan as $item)
                <li>{{ $item->nama }}</li>
                @endforeach
            </ul>
        </div>
    </div>
</section>

<section class="stats">
    <div class="wrap">
        <div class="stat"><b>{{ date('Y') - (int) ($site['tahun_berdiri'] ?? 2006) }}+</b><span>Tahun pengalaman</span></div>
        <div class="stat"><b>{{ $jumlahProyek }}+</b><span>Proyek diselesaikan</span></div>
        <div class="stat"><b>{{ $jumlahKlien }}+</b><span>Klien &amp; mitra</span></div>
        <div class="stat"><b>{{ count($layanan) }}</b><span>Lini layanan</span></div>
    </div>
</section>

<section class="section">
    <div class="wrap">
        <div class="section-head">
            <div class="label">Layanan Kami</div>
            <h2>Solusi Konstruksi Terpadu dari Hulu ke Hilir</h2>
            <p>Dari bangunan gedung hingga pembuatan mesin produksi, kami menangani proyek Anda dengan standar profesionalisme tinggi.</p>
        </div>
        <div class="grid-3">
            @foreach ($layanan as $item)
            <div class="kartu">
                <div class="ikon">@include('partials.ikon', ['nama' => $item->ikon])</div>
                <h3>{{ $item->nama }}</h3>
                <p>{{ $item->deskripsi }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>

<section class="section alt">
    <div class="wrap">
        <div class="section-head">
            <div class="label">Portofolio</div>
            <h2>Proyek Unggulan</h2>
            <p>Sebagian rekam jejak pekerjaan yang telah kami selesaikan untuk klien industri, pendidikan, dan pemerintah.</p>
        </div>
        <div class="proyek-grid">
            @foreach ($proyekUnggulan as $p)
            <article class="proyek">
                <div class="foto"><img src="{{ asset($p->gambar) }}" alt="{{ $p->judul }}"></div>
                <div class="isi">
                    <span class="badge">{{ $p->kategori }}</span>
                    <h3><a href="{{ route('portofolio.detail', $p->slug) }}">{{ $p->judul }}</a></h3>
                    <div class="meta">{{ $p->klien }} &middot; {{ $p->lokasi }} &middot; {{ $p->tahun }}</div>
                </div>
            </article>
            @endforeach
        </div>
        <p style="text-align:center;margin-top:2rem"><a href="{{ route('portofolio') }}" class="btn btn-navy">Lihat Semua Proyek</a></p>
    </div>
</section>

<section class="section">
    <div class="wrap">
        <div class="grid-2">
            <div class="tentang-foto"><img src="{{ asset('images/proyek/proyek-19.jpg') }}" alt="Proyek pabrik"></div>
            <div>
                <div class="label" style="color:var(--teal);font-weight:700;letter-spacing:.12em;text-transform:uppercase;font-size:.8rem">Tentang Kami</div>
                <h2>{{ $site['nama_perusahaan'] ?? '' }}</h2>
                <p>{{ $site['sambutan_direktur'] ?? '' }}</p>
                <ul class="cek">
                    @foreach (explode('|', $site['nilai'] ?? '') as $n)
                    <li><b>{{ explode('::', $n)[0] }}</b></li>
                    @endforeach
                </ul>
                <a href="{{ route('tentang') }}" class="btn btn-ghost">Selengkapnya</a>
            </div>
        </div>
    </div>
</section>

<section class="section alt">
    <div class="wrap">
        <div class="section-head">
            <div class="label">Klien Kami</div>
            <h2>Dipercaya oleh Berbagai Perusahaan</h2>
        </div>
        <div class="klien-grid">
            @foreach ($klien as $k)
            <div><img src="{{ asset($k->logo) }}" alt="{{ $k->nama }}" title="{{ $k->nama }}"></div>
            @endforeach
        </div>
    </div>
</section>
@endsection
