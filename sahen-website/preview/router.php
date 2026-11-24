<?php
/**
 * Server pratinjau tanpa Laravel (untuk dokumentasi/screenshot).
 * Jalankan:  php -S localhost:8080 -t public preview/router.php
 * Data diambil dari database/data/konten.json (sama dengan seeder).
 */
require __DIR__.'/blade.php';

$root = dirname(__DIR__);
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
if ($uri !== '/' && is_file($root.'/public'.$uri)) {
    return false; // berkas statis
}

$data = json_decode(file_get_contents($root.'/database/data/konten.json'), true);
$site = $data['settings'];
$slug = fn ($s) => trim(preg_replace('/[^a-z0-9]+/', '-', strtolower($s)), '-');
$obj = fn (array $a, int $id) => (object) ($a + ['id' => $id]);

$layanan = []; foreach ($data['layanan'] as $i => $l) { $layanan[] = $obj($l, $i + 1); }
$proyek = []; foreach ($data['proyek'] as $i => $p) { $p['slug'] = $slug($p['judul']); $p['gambar'] = 'images/proyek/'.$p['gambar']; $proyek[] = $obj($p, $i + 1); }
$klien = []; foreach ($data['klien'] as $i => $k) { $klien[] = $obj(['nama' => $k, 'logo' => sprintf('images/klien/klien-%02d.png', $i + 1), 'urutan' => $i + 1], $i + 1); }
$pesan = [
    $obj(['nama' => 'Budi Santoso', 'email' => 'budi@contohpabrik.co.id', 'telepon' => '0812 3456 7890', 'subjek' => 'Penawaran pembangunan gudang', 'isi' => "Selamat pagi, kami berencana membangun gudang 1.200 m2 di kawasan Ngoro. Mohon informasi estimasi biaya dan jadwal survei.", 'dibaca' => false, 'created_at' => '2026-03-02 09:15'], 1),
    $obj(['nama' => 'Siti Rahma', 'email' => 'siti@sekolahcontoh.sch.id', 'telepon' => '0813 9876 5432', 'subjek' => 'Renovasi gedung sekolah', 'isi' => "Kami membutuhkan penawaran renovasi gedung sekolah dua lantai. Apakah bisa dijadwalkan pertemuan minggu depan?", 'dibaca' => true, 'created_at' => '2026-02-27 14:40'], 2),
    $obj(['nama' => 'Andi Wijaya', 'email' => 'andi@industri-contoh.com', 'telepon' => null, 'subjek' => 'Instalasi conveyor', 'isi' => "Butuh fabrikasi conveyor untuk lini pengemasan. Mohon dihubungi.", 'dibaca' => true, 'created_at' => '2026-02-20 11:05'], 3),
];
usort($proyek, fn ($a, $b) => [$b->unggulan, $b->tahun] <=> [$a->unggulan, $a->tahun]);
$unggulan = array_slice(array_values(array_filter($proyek, fn ($p) => $p->unggulan)), 0, 6);
$kategori = array_values(array_unique(array_map(fn ($p) => $p->kategori, $proyek))); sort($kategori);

$blade = new MiniBlade($root.'/resources/views');
$base = ['site' => $site, 'errors' => new PreviewErrors()];
$path = trim($uri, '/');

try {
    if ($path === '') {
        echo $blade->render('pages.home', $base + ['layanan' => $layanan, 'proyekUnggulan' => $unggulan, 'klien' => $klien, 'jumlahProyek' => count($proyek), 'jumlahKlien' => count($klien)]);
    } elseif ($path === 'tentang-kami') {
        echo $blade->render('pages.tentang', $base);
    } elseif ($path === 'layanan') {
        echo $blade->render('pages.layanan', $base + ['layanan' => $layanan]);
    } elseif ($path === 'portofolio') {
        $k = $_GET['kategori'] ?? null;
        $list = $k ? array_values(array_filter($proyek, fn ($p) => $p->kategori === $k)) : $proyek;
        echo $blade->render('pages.portofolio', $base + ['proyek' => $list, 'daftarKategori' => $kategori, 'kategori' => $k]);
    } elseif (preg_match('#^portofolio/(.+)$#', $path, $m)) {
        $p = current(array_filter($proyek, fn ($x) => $x->slug === $m[1])) ?: $proyek[0];
        $terkait = array_slice(array_values(array_filter($proyek, fn ($x) => $x->kategori === $p->kategori && $x->id !== $p->id)), 0, 3);
        echo $blade->render('pages.portofolio-detail', $base + ['proyek' => $p, 'terkait' => $terkait]);
    } elseif ($path === 'kontak') {
        echo $blade->render('pages.kontak', $base);
    } elseif ($path === 'admin/login') {
        echo $blade->render('admin.login', $base);
    } elseif ($path === 'admin') {
        echo $blade->render('admin.dashboard', $base + ['jumlahProyek' => count($proyek), 'jumlahLayanan' => count($layanan), 'jumlahKlien' => count($klien), 'pesanBaru' => 1, 'pesanTerbaru' => $pesan, 'proyekTerbaru' => array_slice($proyek, 0, 5)]);
    } elseif ($path === 'admin/proyek') {
        echo $blade->render('admin.proyek.index', $base + ['proyek' => $proyek]);
    } elseif ($path === 'admin/proyek/create') {
        echo $blade->render('admin.proyek.form', $base + ['proyek' => (object) ['id' => null, 'judul' => '', 'klien' => '', 'lokasi' => '', 'kategori' => 'Building', 'tahun' => '', 'deskripsi' => '', 'gambar' => null, 'unggulan' => false]]);
    } elseif (preg_match('#^admin/proyek/(\d+)/edit$#', $path, $m)) {
        echo $blade->render('admin.proyek.form', $base + ['proyek' => $proyek[(int) $m[1] - 1] ?? $proyek[0]]);
    } elseif ($path === 'admin/layanan') {
        echo $blade->render('admin.layanan.index', $base + ['layanan' => $layanan]);
    } elseif ($path === 'admin/layanan/create') {
        echo $blade->render('admin.layanan.form', $base + ['layanan' => (object) ['id' => null, 'nama' => '', 'ikon' => 'building', 'deskripsi' => '', 'urutan' => 0]]);
    } elseif ($path === 'admin/klien') {
        echo $blade->render('admin.klien.index', $base + ['klien' => $klien]);
    } elseif ($path === 'admin/klien/create') {
        echo $blade->render('admin.klien.form', $base + ['klien' => (object) ['id' => null, 'nama' => '', 'logo' => null, 'urutan' => 0]]);
    } elseif ($path === 'admin/pesan') {
        echo $blade->render('admin.pesan.index', $base + ['pesan' => $pesan]);
    } elseif ($path === 'admin/pengaturan') {
        echo $blade->render('admin.pengaturan.form', $base + ['pengaturan' => $site]);
    } else {
        http_response_code(404);
        echo '<h1>404 — Halaman tidak ditemukan</h1>';
    }
} catch (Throwable $e) {
    http_response_code(500);
    echo '<pre>'.e($e->getMessage())."\n".e($e->getTraceAsString()).'</pre>';
}
