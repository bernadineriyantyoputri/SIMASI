<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
</head>

<body class="min-h-screen flex flex-col bg-gray-100">

@if (Route::currentRouteName() === 'admin.dashboard')

    @include('layouts.partials.topbar')

    <main class="flex-1 pt-24 p-6">
        @yield('content')
    </main>

    @include('layouts.partials.footer')

@elseif (request()->is('admin*'))

    <div class="flex flex-1">

        @include('layouts.partials.sidebar')

        <div class="flex-1 md:ml-64 flex flex-col">

            @include('layouts.partials.topbar')

            <main class="flex-1 p-6 pt-24">
                @yield('content')
            </main>

        </div>
    </div>

    @include('layouts.partials.footer')

@else

    @include('layouts.partials.user_navbar')

    <main class="flex-1 px-4 pt-20 pb-20">
        @yield('content')
    </main>

    @include('layouts.partials.user_buttomnavbar')

@endif

</body>
</html>
