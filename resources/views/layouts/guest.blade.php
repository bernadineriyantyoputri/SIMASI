<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Login | SIMASI</title>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Global CSS -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    <!-- Breeze Assets -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="auth-bg">
    @yield('content')
</body>
</html>
