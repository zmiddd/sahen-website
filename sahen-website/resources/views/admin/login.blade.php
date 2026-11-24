<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin — PT Sahen Indonesia Teknik</title>
    <link rel="icon" href="{{ asset('images/favicon.png') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
<div class="login-wrap">
    <form class="login-box" method="POST" action="{{ route('admin.login.post') }}">
        @csrf
        <img src="{{ asset('images/logo.png') }}" alt="Logo">
        <h1>Masuk ke CMS Admin</h1>
        <p class="sub">Kelola konten website PT Sahen Indonesia Teknik</p>
        @if ($errors->first('email'))
        <div class="alert alert-error">{{ $errors->first('email') }}</div>
        @endif
        <label for="email">Email</label>
        <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus>
        <label for="password">Kata Sandi</label>
        <input type="password" id="password" name="password" required>
        <label style="display:flex;gap:.5rem;align-items:center;font-weight:500"><input type="checkbox" name="ingat" value="1"> Ingat saya</label>
        <button type="submit" class="btn btn-navy">Masuk</button>
        <p class="sub" style="margin-top:1rem"><a href="{{ route('home') }}">&larr; Kembali ke website</a></p>
    </form>
</div>
</body>
</html>
