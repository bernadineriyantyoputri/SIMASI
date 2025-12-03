<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Tailwind -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100">

{{-- ========================================= --}}
{{-- =============== ADMIN MODE =============== --}}
{{-- ========================================= --}}
@if (request()->is('admin*'))

    <div class="flex">

        {{-- SIDEBAR ADMIN --}}
        @include('layouts.partials.sidebar')

        <main class="flex-1 md:ml-64">

            {{-- TOPBAR ADMIN --}}
            @include('layouts.partials.topbar')

            {{-- CONTENT ADMIN --}}
            <div class="p-6 pt-24">
                @yield('content')
            </div>

        </main>

    </div>

{{-- ========================================= --}}
{{-- ================ USER MODE ============== --}}
{{-- ========================================= --}}
@else

    {{-- NAVBAR USER --}}
    @include('layouts.partials.user_navbar')


    <main class="pt-20 pb-20 px-4">
        @yield('content')
    </main>

    {{-- FOOTER USER --}}
    @include('layouts.partials.user_buttomnavbar')

@endif

</body>
</html>
