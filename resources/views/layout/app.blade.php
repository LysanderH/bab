<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <title>
        @isset($title)
            {{ $title }} -
        @endisset
        {{ env('APP_NAME') }}
    </title>

    @yield('styles')
</head>

<body>
    @yield('content')
</body>

@yield('scripts')

</html>
