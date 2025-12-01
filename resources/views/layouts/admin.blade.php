<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard UKM</title>

    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

</head>
<body class="bg-gray-100">

<div class="flex">

    {{-- SIDEBAR --}}
    @include('components.sidebar_admin')

    {{-- MAIN CONTENT --}}
    <main class="flex-1 ml-64">

        {{-- NAVBAR --}}
        @include('components.navbar_admin')

        {{-- PAGE CONTENT --}}
        <div class="p-6">
            @yield('content')
        </div>

    </main>

</div>

</body>
</html>
