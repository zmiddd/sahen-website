@extends('layouts.admin')
@section('judul', 'Pesan Masuk')
@section('konten')
<div class="konten-head">
    <div><h1>Pesan Masuk</h1><p>Pesan yang dikirim pengunjung melalui formulir kontak</p></div>
</div>
@forelse ($pesan as $m)
<div class="panel">
    <div style="display:flex;justify-content:space-between;gap:1rem;flex-wrap:wrap;align-items:center">
        <div>
            <span class="status {{ $m->dibaca ? 'dibaca' : 'baru' }}">{{ $m->dibaca ? 'Dibaca' : 'Baru' }}</span>
            <b style="margin-left:.5rem">{{ $m->subjek }}</b>
            <div style="color:var(--muted);font-size:.88rem">{{ $m->nama }} &middot; {{ $m->email }} @if ($m->telepon) &middot; {{ $m->telepon }} @endif &middot; {{ $m->created_at }}</div>
        </div>
        <div class="aksi-tabel">
            @if (! $m->dibaca)
            <form method="POST" action="{{ route('admin.pesan.baca', $m->id) }}">@csrf @method('PATCH')<button class="btn btn-ghost btn-sm">Tandai Dibaca</button></form>
            @endif
            <a href="mailto:{{ $m->email }}?subject=Re: {{ $m->subjek }}" class="btn btn-navy btn-sm">Balas</a>
            <form method="POST" action="{{ route('admin.pesan.destroy', $m->id) }}" onsubmit="return confirm('Hapus pesan ini?')">@csrf @method('DELETE')<button class="btn btn-danger btn-sm">Hapus</button></form>
        </div>
    </div>
    <div class="pesan-isi" style="margin-top:.8rem">{{ $m->isi }}</div>
</div>
@empty
<div class="panel">Belum ada pesan masuk.</div>
@endforelse
@endsection
