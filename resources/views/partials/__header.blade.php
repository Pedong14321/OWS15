<!doctype html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    {{-- calling tailwind --}}
    @vite('resources/css/app.css')
    {{-- my custom css file --}}
    <link rel="stylesheet" href="/css/style.css">
    {{-- local material icons --}}
    <link rel="stylesheet" href="/css/material-icons.css">
    {{-- box icons --}}
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    {{-- alpine js --}}
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    {{-- flowbite --}}
    <script type="text/javascript" src="/js/flowbite.min.js"></script>
</head>

<body class="min-h-screen min-w-screen p-0 m-0 bg-gray-50">
    <x-messages /> {{-- for our custom alert messages --}}
