<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/siimple@3.3.1/dist/siimple.min.css">
</head>
<body>
    <div class="siimple-content siimple-content--large">
        @yield('content')

        <footer class="siimple--mt-5">
            v{{ env('APP_VERSION') }}
        </footer>
    </div>
</body>
</html>
