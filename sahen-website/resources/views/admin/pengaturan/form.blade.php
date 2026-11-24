@extends('layouts.admin')
@section('judul', 'Profil Perusahaan')
@section('konten')
<div class="konten-head">
    <div><h1>Profil Perusahaan</h1><p>Informasi yang ditampilkan pada halaman Beranda, Tentang Kami, dan Kontak</p></div>
</div>
<form method="POST" action="{{ route('admin.pengaturan.update') }}">
    @csrf @method('PUT')
    <div class="panel">
        <h2>Identitas</h2>
        <div class="form-grid">
            <div><label for="nama_perusahaan">Nama Perusahaan</label><input type="text" id="nama_perusahaan" name="nama_perusahaan" value="{{ $pengaturan['nama_perusahaan'] ?? '' }}"></div>
            <div><label for="singkatan">Singkatan</label><input type="text" id="singkatan" name="singkatan" value="{{ $pengaturan['singkatan'] ?? '' }}"></div>
            <div><label for="tagline">Tagline</label><input type="text" id="tagline" name="tagline" value="{{ $pengaturan['tagline'] ?? '' }}"></div>
            <div><label for="tahun_berdiri">Tahun Berdiri</label><input type="text" id="tahun_berdiri" name="tahun_berdiri" value="{{ $pengaturan['tahun_berdiri'] ?? '' }}"></div>
            <div class="full"><label for="bidang">Bidang Usaha</label><input type="text" id="bidang" name="bidang" value="{{ $pengaturan['bidang'] ?? '' }}"></div>
            <div class="full"><label for="deskripsi_singkat">Deskripsi Singkat</label><textarea id="deskripsi_singkat" name="deskripsi_singkat" style="min-height:90px">{{ $pengaturan['deskripsi_singkat'] ?? '' }}</textarea></div>
        </div>
    </div>
    <div class="panel">
        <h2>Tentang, Visi, Misi &amp; Nilai</h2>
        <div class="form-grid">
            <div class="full"><label for="tentang">Tentang Perusahaan</label><textarea id="tentang" name="tentang">{{ $pengaturan['tentang'] ?? '' }}</textarea><p class="hint">Pisahkan paragraf dengan baris kosong.</p></div>
            <div class="full"><label for="sambutan_direktur">Sambutan Direktur</label><textarea id="sambutan_direktur" name="sambutan_direktur" style="min-height:90px">{{ $pengaturan['sambutan_direktur'] ?? '' }}</textarea></div>
            <div class="full"><label for="visi">Visi</label><input type="text" id="visi" name="visi" value="{{ $pengaturan['visi'] ?? '' }}"></div>
            <div class="full"><label for="misi">Misi</label><textarea id="misi" name="misi" style="min-height:80px">{{ $pengaturan['misi'] ?? '' }}</textarea><p class="hint">Pisahkan setiap butir misi dengan tanda |</p></div>
            <div class="full"><label for="nilai">Nilai Perusahaan</label><textarea id="nilai" name="nilai">{{ $pengaturan['nilai'] ?? '' }}</textarea><p class="hint">Format: Judul::Deskripsi, pisahkan antar nilai dengan tanda |</p></div>
            <div class="full"><label for="legalitas">Legalitas</label><textarea id="legalitas" name="legalitas" style="min-height:90px">{{ $pengaturan['legalitas'] ?? '' }}</textarea><p class="hint">Pisahkan setiap dokumen dengan tanda |</p></div>
        </div>
    </div>
    <div class="panel">
        <h2>Kontak</h2>
        <div class="form-grid">
            <div class="full"><label for="alamat">Alamat</label><input type="text" id="alamat" name="alamat" value="{{ $pengaturan['alamat'] ?? '' }}"></div>
            <div><label for="telepon">Telepon / Fax</label><input type="text" id="telepon" name="telepon" value="{{ $pengaturan['telepon'] ?? '' }}"></div>
            <div><label for="whatsapp">WhatsApp</label><input type="text" id="whatsapp" name="whatsapp" value="{{ $pengaturan['whatsapp'] ?? '' }}"></div>
            <div><label for="email">Email</label><input type="text" id="email" name="email" value="{{ $pengaturan['email'] ?? '' }}"></div>
            <div><label for="jam_kerja">Jam Operasional</label><input type="text" id="jam_kerja" name="jam_kerja" value="{{ $pengaturan['jam_kerja'] ?? '' }}"></div>
            <div class="full"><label for="maps_embed">URL Google Maps (embed)</label><input type="text" id="maps_embed" name="maps_embed" value="{{ $pengaturan['maps_embed'] ?? '' }}"></div>
        </div>
    </div>
    <button type="submit" class="btn btn-navy">Simpan Perubahan</button>
</form>
@endsection
