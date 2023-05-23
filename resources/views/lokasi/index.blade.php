@extends('layouts.app')
@section('content')
    <style>
        #marker {
            background-image: url('/img/mbgreen.png');
            background-repeat: no-repeat;
            width: 28px;
            height: 28px;
            cursor: pointer;
        }
    </style>
    <div class="row">
        <div class="col-12">
            @can('admin')
                <a href="{{ route('lokasi.create') }}">
                    <button type="button" class="btn btn-primary"><i class="fas fa-plus"></i> Tambah Lokasi</button>
                </a>
            @endcan

            <a href="{{ route('lokasi.daftar') }}">
                <button type="button" class="btn btn-info"><i class="fas fa-list"></i> Daftar Lokasi</button>
            </a>
        </div>
    </div>
    <style>
        .mapboxgl-popup {
            max-width: 400px;
            font: 12px/20px 'Helvetica Neue', Arial, Helvetica, sans-serif;
        }
    </style>

    <div class="border border-dark m-2">
        <div class="row">
            <div class="col-12">
                <div id='map' style='width: 100%; height: 500px;'></div>
            </div>
        </div>
    </div>
@endsection
@push('script')
    <script>
        mapboxgl.accessToken = '{{ env('MAPBOX_KEY') }}';
        const map = new mapboxgl.Map({
            container: 'map', // container ID
            style: 'mapbox://styles/mapbox/streets-v12', // style URL
            center: [102.2521195394366, -3.7894423262683987], // starting position [lng, lat]
            zoom: 16, // starting zoom
        });

        map.addControl(new mapboxgl.NavigationControl())

        map.on('load', () => {
            // Add an image to use as a custom marker
            map.loadImage(
                '/img/mbgreen.png',
                (error, image) => {
                    if (error) throw error;
                    map.addImage('custom-marker', image);
                    // Add a GeoJSON source with 2 points
                    map.addSource('points', {
                        'type': 'geojson',
                        'data': {
                            'type': 'FeatureCollection',
                            'features': [
                                @foreach ($lokasi as $l)
                                    {
                                        // feature for Mapbox DC
                                        'type': 'Feature',
                                        'geometry': {
                                            'type': 'Point',
                                            'coordinates': [
                                                {{ $l->longitude }}, {{ $l->latitude }}
                                            ]
                                        },
                                        'properties': {
                                            'title': '{{ $l->nama_jalan }}',
                                            'des': '<b>{{ $l->nama_jalan }}</b><br>{{ $l->kategori }}<br>{{ $l->keterangan }}'
                                        }
                                    },
                                @endforeach
                            ]
                        }
                    });
                    map.on('mouseenter', 'points', () => {
                        map.getCanvas().style.cursor = 'pointer';
                    });
                    // Change it back to a pointer when it leaves.
                    map.on('mouseleave', 'points', () => {
                        map.getCanvas().style.cursor = '';
                    });

                    // Add a symbol layer
                    map.addLayer({
                        'id': 'points',
                        'type': 'symbol',
                        'source': 'points',
                        'layout': {
                            'icon-image': 'custom-marker',
                            // get the title name from the source's "title" property
                            'text-field': ['get', 'title'],
                            'text-font': [
                                'Open Sans Semibold',
                                'Arial Unicode MS Bold'
                            ],
                            'text-offset': [0, 1.25],
                            'text-anchor': 'top'
                        }
                    });
                    map.on('click', 'points', function(e) {
                        // Copy coordinates array.
                        const coordinates = e.features[0].geometry.coordinates.slice();
                        const description = e.features[0].properties.des;
                        // Ensure that if the map is zoomed out such that multiple
                        // copies of the feature are visible, the popup appears
                        // over the copy being pointed to.
                        while (Math.abs(e.lngLat.lng - coordinates[0]) > 180) {
                            coordinates[0] += e.lngLat.lng > coordinates[0] ? 360 : -360;
                        }

                        var popup = new mapboxgl.Popup()
                            .setLngLat(coordinates)
                            .setHTML(description)
                            .addTo(map);

                    });
                }
            );
        });
    </script>
@endpush
