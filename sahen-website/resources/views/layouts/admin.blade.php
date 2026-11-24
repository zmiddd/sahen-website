<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('judul', 'Dashboard') — CMS Admin SITE</title>
    <link rel="icon" href="{{ asset('images/favicon.png') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
<div class="admin">
    <aside class="sidebar">
        <a class="brand" href="{{ route('admin.dashboard') }}">
            <img src="{{ asset('images/logo-sm.png') }}" alt="Logo">
            <span><strong>CMS Admin</strong><small style="color:#9fb7cf">{{ $site['singkatan'] ?? 'SITE' }} Website</small></span>
        </a>
        <nav>
            <a href="{{ route('admin.dashboard') }}" class="{{ request()->is('admin') ? 'aktif' : '' }}">@include('partials.ikon', ['nama' => 'dashboard']) Dashboard</a>
            <a href="{{ route('admin.proyek.index') }}" class="{{ request()->is('admin/proyek*') ? 'aktif' : '' }}">@include('partials.ikon', ['nama' => 'civil']) Portofolio Proyek</a>
            <a href="{{ route('admin.layanan.index') }}" class="{{ request()->is('admin/layanan*') ? 'aktif' : '' }}">@include('partials.ikon', ['nama' => 'gear']) Layanan</a>
            <a href="{{ route('admin.klien.index') }}" class="{{ request()->is('admin/klien*') ? 'aktif' : '' }}">@include('partials.ikon', ['nama' => 'users']) Klien</a>
            <a href="{{ route('admin.pesan.index') }}" class="{{ request()->is('admin/pesan*') ? 'aktif' : '' }}">@include('partials.ikon', ['nama' => 'mail']) Pesan Masuk</a>
            <a href="{{ route('admin.pengaturan.edit') }}" class="{{ request()->is('admin/pengaturan*') ? 'aktif' : '' }}">@include('partials.ikon', ['nama' => 'settings']) Profil Perusahaan</a>
            <a href="{{ route('home') }}" target="_blank">@include('partials.ikon', ['nama' => 'building']) Lihat Website</a>
        </nav>
        <form method="POST" action="{{ route('admin.logout') }}">
            @csrf
            <button type="submit" class="btn btn-outline btn-sm">Keluar</button>
        </form>
    </aside>
    <main class="konten">
        @if (session('sukses'))
        <div class="alert alert-sukses">{{ session('sukses') }}</div>
        @endif
        @yield('konten')
    </main>
</div>
</body>
</html>
