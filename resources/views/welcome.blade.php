<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @if (Auth::check())
        <script>
            window.Laravel = {!! json_encode([
    'isLoggedIn' => true,
    'viewIsLoaded' => true,
    'user' => Auth::user(),
]) !!}
        </script>
    @else
        <script>
            window.Laravel = {!! json_encode([
    'isLoggedIn' => false,
]) !!}
        </script>
    @endif

    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
</head>

<body class="antialiased">


    <div id="app">
    </div>
    <script src="{{ mix('js/app.js') }}"></script>
</body>

</html>
