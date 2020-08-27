<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link media="all" type="text/css" rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.min.css">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.min.js" charset="utf-8"></script>

    <style>
        html,
        body {
            font-size: 16px;
        }

        main {
            margin-top: 3rem;
        }

        footer {
            margin-top: 3rem;
            margin-bottom: 1rem;
        }
    </style>
</head>
<body>
    <main class="ui container main">
        @yield('content')

        <footer>
            v{{ env('APP_VERSION') }}
        </footer>
    </main>
</body>
</html>
