<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="/favicon.ico">

    @routes
    @vite([ "resources/scss/app.scss", "resources/js/app.js" ])
    @inertiaHead
</head>
<body>
@inertia
</body>
</html>

