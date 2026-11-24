<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('judul', 'Beranda') — {{ $site['nama_perusahaan'] ?? 'PT Sahen Indonesia Teknik' }}</title>
    <meta name="description" content="@yield('deskripsi', $site['deskripsi_singkat'] ?? '')">
    <link rel="icon" href="{{ asset('images/favicon.png') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    <div class="topbar">
        <div class="wrap">
            <span>{{ $site['bidang'] ?? '' }}</span>
            <span>Telp. {{ $site['telepon'] ?? '' }} &nbsp;|&nbsp; WA {{ $site['whatsapp'] ?? '' }} &nbsp;|&nbsp; {{ $site['email'] ?? '' }}</span>
        </div>
    </div>
    <header class="header">
        <div class="wrap">
            <a class="brand" href="{{ route('home') }}">
                <img src="{{ asset('images/logo-sm.png') }}" alt="Logo {{ $site['nama_perusahaan'] ?? '' }}">
                <span><strong>{{ $site['nama_perusahaan'] ?? 'PT Sahen Indonesia Teknik' }}</strong><small>{{ $site['tagline'] ?? '' }}</small></span>
            </a>
            <button class="nav-toggle" aria-label="Menu" onclick="document.getElementById('nav').classList.toggle('buka')">☰</button>
            <nav class="nav" id="nav">
                <a href="{{ route('home') }}" class="{{ request()->is('/') ? 'aktif' : '' }}">Beranda</a>
                <a href="{{ route('tentang') }}" class="{{ request()->is('tentang-kami') ? 'aktif' : '' }}">Tentang Kami</a>
                <a href="{{ route('layanan') }}" class="{{ request()->is('layanan') ? 'aktif' : '' }}">Layanan</a>
                <a href="{{ route('portofolio') }}" class="{{ request()->is('portofolio*') ? 'aktif' : '' }}">Portofolio</a>
                <a href="{{ route('kontak') }}" class="{{ request()->is('kontak') ? 'aktif' : '' }}">Kontak</a>
                <a href="{{ route('kontak') }}" class="btn btn-primary btn-sm">Minta Penawaran</a>
            </nav>
        </div>
    </header>

    <main>
        @yield('konten')
    </main>

    <section class="cta">
        <div class="wrap">
            <div>
                <h2>Siap membangun proyek Anda berikutnya?</h2>
                <p>Konsultasikan kebutuhan konstruksi, mechanical electrical, atau pembuatan mesin Anda bersama tim kami.</p>
            </div>
            <a href="{{ route('kontak') }}" class="btn btn-primary">Hubungi Kami</a>
        </div>
    </section>

    <footer class="footer">
        <div class="wrap">
            <div>
                <div class="logo-footer"><img src="{{ asset('images/logo-sm.png') }}" alt="Logo"></div>
                <p>{{ $site['deskripsi_singkat'] ?? '' }}</p>
            </div>
            <div>
                <h4>Navigasi</h4>
                <a href="{{ route('home') }}">Beranda</a>
                <a href="{{ route('tentang') }}">Tentang Kami</a>
                <a href="{{ route('layanan') }}">Layanan</a>
                <a href="{{ route('portofolio') }}">Portofolio</a>
                <a href="{{ route('kontak') }}">Kontak</a>
            </div>
            <div>
                <h4>Layanan</h4>
                <a href="{{ route('layanan') }}">Building</a>
                <a href="{{ route('layanan') }}">Civil Construction</a>
                <a href="{{ route('layanan') }}">Mechanical Electrical</a>
                <a href="{{ route('layanan') }}">Machine Maker</a>
                <a href="{{ route('layanan') }}">General Contractor</a>
            </div>
            <div>
                <h4>Kontak</h4>
                <p>{{ $site['alamat'] ?? '' }}</p>
                <a href="tel:{{ $site['telepon'] ?? '' }}">Telp/Fax. {{ $site['telepon'] ?? '' }}</a>
                <a href="https://wa.me/62{{ ltrim(str_replace(' ', '', $site['whatsapp'] ?? ''), '0') }}">WhatsApp {{ $site['whatsapp'] ?? '' }}</a>
                <a href="mailto:{{ $site['email'] ?? '' }}">{{ $site['email'] ?? '' }}</a>
            </div>
        </div>
        <div class="copy">&copy; {{ date('Y') }} {{ $site['nama_perusahaan'] ?? 'PT Sahen Indonesia Teknik' }}. {{ $site['tagline'] ?? '' }}.</div>
    </footer>
</body>
</html>
