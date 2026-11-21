<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Iniciar sesión') · Blog SDS26</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=poppins:300,400,500,600,700,800,900&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-white font-sans text-sds-ink antialiased">
    @yield('content')

    {{-- Conserva la posición de la página al enviar formularios marcados con data-keep-scroll --}}
    <script>
    (function () {
        var key = 'scroll:' + location.pathname;

        document.addEventListener('submit', function (e) {
            var form = e.target;
            if (form.hasAttribute && form.hasAttribute('data-keep-scroll') && !e.defaultPrevented) {
                try { sessionStorage.setItem(key, String(window.scrollY)); } catch (_) {}
            }
        });

        document.addEventListener('DOMContentLoaded', function () {
            try {
                var y = sessionStorage.getItem(key);
                if (y !== null) {
                    sessionStorage.removeItem(key);
                    window.scrollTo(0, parseInt(y, 10) || 0);
                }
            } catch (_) {}
        });
    })();
    </script>
</body>
</html>
