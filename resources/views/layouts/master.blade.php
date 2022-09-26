<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Sardar Pharma</title>

    @include("layouts.frontend.style")

</head>

<body class="antialiased">
    @include("layouts.frontend.navbar")
    <main>
        @yield("content")
    </main>
    <!-- footer section -->
    @include("layouts.frontend.footer")

    @include("layouts.frontend.script")
</body>

</html>