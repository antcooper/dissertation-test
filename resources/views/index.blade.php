<html>
    <head>
        <link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet">

        <link rel="stylesheet" href="/vendor/leaflet/leaflet.css" />
        <script src="/vendor/leaflet/leaflet.js"></script>
        <script src="/vendor/leaflet-gpx/gpx.js"></script>
    </head>
    <body>
        <main class="container mx-auto">
            <div class="bg-gray-500 h-full w-full" id="map"></div>
        </main>

    <script>
        var mapboxKey = "pk.eyJ1IjoiYW50Y29vcGVyIiwiYSI6ImNrZDI4M2MzODFhenYyc3B2bWg1czdjejEifQ.3AA2uanY2OasIC5oQcPOvw";

        function display_gpx(mapid) 
        {
            var map = L.map(mapid);
            
            var terrainLayer = L.tileLayer('https://api.mapbox.com/styles/v1/mapbox/outdoors-v9/tiles/256/{z}/{x}/{y}?access_token='+mapboxKey, {
              attribution: 'Map data &copy; <a href="http://openstreetmap.org">OpenStreetMap</a> contributors, <a href="http://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="http://mapbox.com">Mapbox</a>',
              maxZoom: 22,
              id: 'mapbox.outdoors',
              accessToken: mapboxKey
            }).addTo(map);

            var satLayer = L.tileLayer('https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token='+mapboxKey, {
              attribution: 'Map data &copy; <a href="http://openstreetmap.org">OpenStreetMap</a> contributors, <a href="http://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="http://mapbox.com">Mapbox</a>',
              maxZoom: 22,
              id: 'mapbox.satellite',
              accessToken: mapboxKey
            });

            var baseMaps = {
                "Terrain": terrainLayer,
                "Satellite": satLayer
            };

            var control = L.control.layers(baseMaps, null, {collapsed: false}).addTo(map);
            L.control.scale().addTo(map);

            new L.GPX('{{ url('/samples/source/original_coledale.gpx') }}', {
                async: true,
                marker_options: {
                    startIconUrl: '{{ url('/vendor/leaflet-gpx/pin-icon-start.png') }}',
                    endIconUrl:   '{{ url('/vendor/leaflet-gpx/pin-icon-end.png') }}',
                    shadowUrl:    '{{ url('/vendor/leaflet-gpx/pin-shadow.png') }}',
                },
                polyline_options: {
                    color: 'green',
                    weight: 2,
                }
            }).on('loaded', function(e) {
                var gpx = e.target;
                control.addOverlay(gpx, 'Original');
            }).addTo(map);


            new L.GPX('{{ url('/samples/output/short-route.gpx') }}', {
                async: true,
                marker_options: {
                    startIconUrl: '{{ url('/vendor/leaflet-gpx/pin-icon-start.png') }}',
                    endIconUrl:   '{{ url('/vendor/leaflet-gpx/pin-icon-end.png') }}',
                    shadowUrl:    '{{ url('/vendor/leaflet-gpx/pin-shadow.png') }}',
                },
                polyline_options: {
                    color: 'blue',
                    weight: 2,
                }
            }).on('loaded', function(e) {
                var gpx = e.target;
                control.addOverlay(gpx, 'Watermarked');
                map.fitBounds(gpx.getBounds());
            }).addTo(map);

          }

          display_gpx('map');
    </script>      
    </body>
</html>