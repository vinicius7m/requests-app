<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Solicitações Internas</title>
    @vite('resources/css/app.css', 'resources/js/app.js')

    @livewireStyles
</head>
<body class="p-6">

    {{ $slot }}

    @if (session('success'))
        <div class="bg-green-100 text-green-700 p-2 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div
        x-data="{ show: false, message: '' }"
        x-on:toast.window="
            message = $event.detail.message;
            show = true;
            type = $event.detail.type || 'success'
            setTimeout(() => show = false, 3000);
        "
        x-show="show"
        x-transition
        class="fixed top-5 right-5 bg-green-600 text-white px-4 py-2 rounded shadow z-50"
        style="display: none"
    >
        <span x-text="message"></span>
    </div>


    @livewireScripts
</body>
</html>
