


@extends('layouts.app')

@section('title', 'Compare routes')

@section('content')
<div class="flex my-6">
    <div class="border overflow-scroll px-6 w-1/2" style="height:400px;">
        <h3 class="text-xl mb-2">Source</h3>
        <pre class="text-blue-800">{{ file_get_contents(public_path($source)) }}</pre>
    </div>
    <div class="border overflow-y-scroll px-6 w-1/2" style="height:400px;" src="">
        <h3 class="text-xl mb-2">Output</h3>
        <pre class="text-blue-800">{{ file_get_contents(public_path($output)) }}</pre>
    </div>
</div>

<div class="flex my-6">
    <div class="border overflow-scroll px-6 w-1/2" style="height:400px;">
        <h3 class="text-xl mb-2">Blind</h3>
        <pre>{{ print_r($blind) }}</pre>
    </div>
    <div class="border overflow-y-scroll px-6 w-1/2" style="height:400px;" src="">
        <h3 class="text-xl mb-2">Non Blind</h3>
        <pre>{{ print_r($nonBlind) }}</pre>
    </div>
</div>


<div class="bg-gray-500 h-full w-full" id="map"></div>

<script>
    var mapboxKey = "pk.eyJ1IjoiYW50Y29vcGVyIiwiYSI6ImNqNDdmMzdpNDA0bWozM21saWgzb3U4ODcifQ.8xMHBxB3T04FZkgNuOZd6g";

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

        new L.GPX('{{ url($source) }}', {
            async: true,
            marker_options: {
                startIconUrl: '{{ url('/vendor/leaflet-gpx/pin-icon-start.png') }}',
                endIconUrl:   '{{ url('/vendor/leaflet-gpx/pin-icon-end.png') }}',
                shadowUrl:    '{{ url('/vendor/leaflet-gpx/pin-shadow.png') }}',
            },
            polyline_options: {
                color: 'blue',
                weight: 4,
            }
        }).on('loaded', function(e) {
            var gpx = e.target;
            control.addOverlay(gpx, 'Original (Blue)');
        }).addTo(map);

        new L.GPX('{{ url($output) }}', {
            async: true,
            marker_options: {
                startIconUrl: '{{ url('/vendor/leaflet-gpx/pin-icon-start.png') }}',
                endIconUrl:   '{{ url('/vendor/leaflet-gpx/pin-icon-end.png') }}',
                shadowUrl:    '{{ url('/vendor/leaflet-gpx/pin-shadow.png') }}',
            },
            polyline_options: {
                color: 'red',
                weight: 4,
            }
        }).on('loaded', function(e) {
            var gpx = e.target;
            control.addOverlay(gpx, 'Output (Red)');
            map.fitBounds(gpx.getBounds());
        }).addTo(map);
      }

      display_gpx('map');
</script>      
@endsection
