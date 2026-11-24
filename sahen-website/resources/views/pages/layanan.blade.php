@extends('layouts.public')
@section('judul', 'Layanan')
@section('konten')
<section class="detail-hero">
    <div class="wrap">
        <div class="crumb">Beranda &rsaquo; Layanan</div>
        <h1>Layanan Kami</h1>
        <p style="color:var(--muted);max-width:720px">Berawal dari bisnis konstruksi, SITE berkembang menjadi tiga lini bisnis: kontraktor, supplier, dan properti.</p>
    </div>
</section>
<section class="section">
    <div class="wrap">
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
            <div class="label">Alur Kerja</div>
            <h2>Bagaimana Kami Bekerja</h2>
        </div>
        <div class="grid-4">
            <div class="kartu nilai"><b>1. Konsultasi</b><p>Kami mendengarkan kebutuhan dan menyurvei lokasi proyek Anda.</p></div>
            <div class="kartu nilai"><b>2. Perencanaan</b><p>Penyusunan desain, RAB, dan jadwal pelaksanaan yang transparan.</p></div>
            <div class="kartu nilai"><b>3. Pelaksanaan</b><p>Pengerjaan oleh tim profesional dengan standar K3 dan mutu.</p></div>
            <div class="kartu nilai"><b>4. Serah Terima</b><p>Pemeriksaan bersama, serah terima, dan layanan purna jual.</p></div>
        </div>
    </div>
</section>
@endsection
