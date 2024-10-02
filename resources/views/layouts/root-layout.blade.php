<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>{{config('app.name')}} | {{$title ?? config('app.description')}}</title>

  <meta name="description" content="{{config('app.description')}}">
  <meta name="author" content="{{ config('app.creator') }}">
  <link rel="apple-touch-icon" sizes="180x180" href="/images/apple-touch-icon.png">
  <link rel="icon" type="image/png" sizes="32x32" href="/images/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="16x16" href="/images/favicon-16x16.png">
  <link rel="manifest" href="/images/site.webmanifest">
  <link rel="mask-icon" href="/images/safari-pinned-tab.svg" color="#5bbad5">
  <link rel="shortcut icon" href="/images/favicon.ico">
  <meta name="msapplication-TileColor" content="#da532c">
  <meta name="msapplication-config" content="/images/browserconfig.xml">
  <meta name="theme-color" content="#ffffff">
  @vite('resources/css/app.css')
  <script src="//unpkg.com/alpinejs" defer></script>
</head>
<body class="bg-gray-100 flex flex-col min-h-screen">
    <x-header />
    @if(request()->is('/'))
    <x-hero />
    <x-top-banner />
    @endif
    <main class="flex-1 container mx-auto p-4 mt-4">
    <x-toaster timeout="3000" />
        {{$slot}}
    </main>
    <x-footer />
    <script src="{{ asset('js/script.js') }}"></script>
</body>
</html>