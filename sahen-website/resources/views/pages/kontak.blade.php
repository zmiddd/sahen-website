@extends('layouts.public')
@section('judul', 'Kontak')
@section('konten')
<section class="detail-hero">
    <div class="wrap">
        <div class="crumb">Beranda &rsaquo; Kontak</div>
        <h1>Hubungi Kami</h1>
        <p style="color:var(--muted);max-width:720px">Untuk informasi lebih lanjut dan kerja sama, jangan ragu untuk menghubungi kami. Kami siap memberikan solusi terbaik bagi kebutuhan konstruksi Anda.</p>
    </div>
</section>
<section class="section">
    <div class="wrap">
        <div class="kontak-grid">
            <div class="kontak-info">
                <div>@include('partials.ikon', ['nama' => 'pin'])<div><b>Alamat Kantor</b>{{ $site['alamat'] ?? '' }}</div></div>
                <div>@include('partials.ikon', ['nama' => 'phone'])<div><b>Telepon / Fax</b>{{ $site['telepon'] ?? '' }}</div></div>
                <div>@include('partials.ikon', ['nama' => 'whatsapp'])<div><b>WhatsApp</b>{{ $site['whatsapp'] ?? '' }}</div></div>
                <div>@include('partials.ikon', ['nama' => 'mail'])<div><b>Email</b>{{ $site['email'] ?? '' }}</div></div>
                <div>@include('partials.ikon', ['nama' => 'clock'])<div><b>Jam Operasional</b>{{ $site['jam_kerja'] ?? '' }}</div></div>
            </div>
            <form class="form" method="POST" action="{{ route('kontak.kirim') }}">
                @csrf
                <h2 style="font-size:1.3rem">Kirim Pesan</h2>
                @if (session('sukses'))
                <div class="alert alert-sukses">{{ session('sukses') }}</div>
                @endif
                @if ($errors->any())
                <div class="alert alert-error">Mohon periksa kembali isian formulir Anda.</div>
                @endif
                <div class="form-row">
                    <div>
                        <label for="nama">Nama Lengkap</label>
                        <input type="text" id="nama" name="nama" value="{{ old('nama') }}" required>
                        @if ($errors->first('nama'))<div class="error">{{ $errors->first('nama') }}</div>@endif
                    </div>
                    <div>
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" value="{{ old('email') }}" required>
                        @if ($errors->first('email'))<div class="error">{{ $errors->first('email') }}</div>@endif
                    </div>
                </div>
                <div class="form-row">
                    <div>
                        <label for="telepon">Telepon / WhatsApp</label>
                        <input type="text" id="telepon" name="telepon" value="{{ old('telepon') }}">
                    </div>
                    <div>
                        <label for="subjek">Subjek</label>
                        <input type="text" id="subjek" name="subjek" value="{{ old('subjek') }}" required>
                        @if ($errors->first('subjek'))<div class="error">{{ $errors->first('subjek') }}</div>@endif
                    </div>
                </div>
                <label for="isi">Pesan</label>
                <textarea id="isi" name="isi" required>{{ old('isi') }}</textarea>
                @if ($errors->first('isi'))<div class="error">{{ $errors->first('isi') }}</div>@endif
                <input type="text" name="website" class="honey" tabindex="-1" autocomplete="off">
                <button type="submit" class="btn btn-navy" style="margin-top:1.2rem">Kirim Pesan</button>
            </form>
        </div>
        <div class="peta">
            <iframe src="{{ $site['maps_embed'] ?? '' }}" loading="lazy" title="Lokasi kantor"></iframe>
        </div>
    </div>
</section>
@endsection
