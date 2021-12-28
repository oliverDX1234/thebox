<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        {{-- <link href="https://cdn.jsdelivr.net/npm/remixicon@v2.4.0/fonts/remixicon.css" rel="stylesheet"> --}}

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    </head>
    <body class="antialiased">
    @if (Auth::check())
        <script>
            window.Laravel = {!!json_encode([
            'isLoggedin' => true,
            'user' => Auth::user()
        ])!!}
        </script>
    @else
        <script>
            window.Laravel = {!!json_encode([
            'isLoggedin' => false
        ])!!}
        </script>
    @endif
        <div id="app">
        </div>
        <script src="{{ mix("js/app.js") }}" ></script>
    </body>
</html>
