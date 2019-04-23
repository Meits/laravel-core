<!DOCTYPE html>
<html>
<head>

    <title>{{$title}}</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="{{$description}}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="{{ asset('favicon.ico') }}">
    <!--Styles-->
    <link href='https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Material+Icons' rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" type="text/css" rel="stylesheet" media="screen, projection"/>

    {!! $headScripts !!}

</head>
<body>
<div id="app">
    <v-app light>
        <v-container>
            <!--Header -->
            <header class="">
                @include('public::layouts.parts.header')
            </header>
        @yield('content')
        <!--Footer -->
            <footer class="">
                @include('public::layouts.parts.footer')
            </footer>
            <div class="hidden" style="display: none;">
                @include('public::layouts.parts.hidden')
            </div>
        </v-container>
    </v-app>
</div>
<!--Scripts-->
<script>
    window.Laravel = {!! json_encode([
               'csrfToken' => csrf_token(),
           ]) !!};
</script>
<script src="{{ asset('js/app.js') }}" defer></script>

{!! $bodyScripts !!}
</body>
</html>