<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0, maximum-scale=1.0"
    />
    <meta
        name="apple-mobile-web-app-status-bar-style"
        content="black-translucent"
    >
    <meta
        name="csrf-token"
        content="{{ csrf_token() }}"
    >
    <meta
        name="description"
        content="Зарабатывайте на майнинге вместе с allbtc pool. Allbtc poll - Высокий доход. Надежность. Эффективность."
    >
    <meta name="title" content="All-btc mining pool">
    <link rel="icon" href="/favicon.ico">
    <title>All-btc mining pool</title>
    @include('head.fonts')
    @vite(["resources/scss/app.scss", "resources/js/app.js"])
</head>
<body>
<div id="app">
</div>
</body>

@if(config('app.production_env'))
    @include('metrics')
@endif
</html>

