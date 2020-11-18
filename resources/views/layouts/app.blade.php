<html>
    <head>
        <title>Watermark - @yield('title')</title>
        <link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet">

        <link rel="stylesheet" href="/vendor/leaflet/leaflet.css" />
        <script src="/vendor/leaflet/leaflet.js"></script>
        <script src="/vendor/leaflet-gpx/gpx.js"></script>
    </head>
    <body>
        <main class="container mx-auto my-8">
            <h1 class="text-2xl mb-6">@yield('title')</h1>

            @yield('content')
        </main>
    </body>
</html>