<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    {{-- <link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet"> --}}
</head>
<body>
    <div class="container">
        @yield('content')
    </div>
</body>
</html>
