<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css') {{-- calling tailwind --}}
    <link rel="stylesheet" href="/css/style.css"> {{-- custom css file --}}
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'> {{-- box icons --}}
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script> {{-- alpine js --}}
</head>

<body class="min-h-screen min-w-screen bg-gray-50">
    <x-messages /> {{-- for our custom alert messages --}}
