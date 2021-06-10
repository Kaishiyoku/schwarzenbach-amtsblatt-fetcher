<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,600;0,700;0,800;1,300;1,400;1,600;1,700;1,800&display=swap" rel="stylesheet">

    <!-- Stylesheets -->
    <link media="all" type="text/css" rel="stylesheet" href="{{ url('/css/app.css') }}">
</head>
<body class="bg-gray-100 py-12">
    <main class="container px-4 lg:px-20 mx-auto">
        @yield('content')
    </main>

    <footer class="container px-4 lg:px-20 mx-auto m-12">
        v{{ env('APP_VERSION') }}
    </footer>
</body>
</html>
