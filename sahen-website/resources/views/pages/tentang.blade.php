@extends('layouts.public')
@section('judul', 'Tentang Kami')
@section('konten')
<section class="detail-hero">
    <div class="wrap">
        <div class="crumb">Beranda &rsaquo; Tentang Kami</div>
        <h1>Tentang {{ $site['nama_perusahaan'] ?? '' }}</h1>
        <p style="color:var(--muted);max-width:720px">{{ $site['bidang'] ?? '' }} &mdash; berdiri sejak {{ $site['tahun_berdiri'] ?? '' }}, berkedudukan di Krembung, Sidoarjo, Jawa Timur.</p>
    </div>
</section>

<section class="section">
    <div class="wrap">
        <div class="grid-2">
            <div>
                <div class="label" style="color:var(--teal);font-weight:700;letter-spacing:.12em;text-transform:uppercase;font-size:.8rem">Profil Perusahaan</div>
                <h2>Membangun Masa Depan Bersama</h2>
                @foreach (explode("\n\n", $site['tentang'] ?? '') as $par)
                <p>{{ $par }}</p>
                @endforeach
            </div>
            <div class="tentang-foto"><img src="{{ asset('images/proyek/proyek-18.jpg') }}" alt="Pabrik yang dibangun SITE"></div>
        </div>
    </div>
</section>

<section class="section alt">
    <div class="wrap">
        <div class="grid-2" style="align-items:stretch">
            <div class="kotak">
                <h3>Visi</h3>
                <p style="font-size:1.1rem;font-weight:600;color:var(--navy-dark)">{{ $site['visi'] ?? '' }}</p>
            </div>
            <div class="kotak">
                <h3>Misi</h3>
                <ol style="margin:0;padding-left:1.2rem">
                    @foreach (explode('|', $site['misi'] ?? '') as $m)
                    <li style="margin:.4rem 0">{{ $m }}</li>
                    @endforeach
                </ol>
            </div>
        </div>
    </div>
</section>

<section class="section">
    <div class="wrap">
        <div class="section-head">
            <div class="label">Nilai Perusahaan</div>
            <h2>Empat Prinsip yang Kami Pegang Teguh</h2>
            <p>Pedoman kami dalam mencapai standar proses dan pelaksanaan jasa serta perdagangan.</p>
        </div>
        <div class="grid-4">
            @foreach (explode('|', $site['nilai'] ?? '') as $n)
            <div class="kartu nilai">
                <div class="ikon" style="margin-inline:auto">@include('partials.ikon', ['nama' => 'helmet'])</div>
                <b>{{ explode('::', $n)[0] }}</b>
                <p>{{ explode('::', $n)[1] ?? '' }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>

<section class="section alt">
    <div class="wrap">
        <div class="grid-2">
            <blockquote class="kutip">
                {{ $site['sambutan_direktur'] ?? '' }}
                <footer>Direktur {{ $site['nama_perusahaan'] ?? '' }}</footer>
            </blockquote>
            <div>
                <h2>Legalitas Perusahaan</h2>
                <p style="color:var(--muted)">SITE berbadan hukum perseroan terbatas dan memiliki perizinan yang lengkap untuk menjalankan usaha jasa konstruksi.</p>
                <ul class="cek">
                    @foreach (explode('|', $site['legalitas'] ?? '') as $l)
                    <li>{{ $l }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</section>
@endsection
