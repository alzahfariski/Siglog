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

        .mapboxgl-popup {
            max-width: 200px;
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
                <button type="button" class="btn btn-primary"><i class="fas fa-list"></i> Daftar Lokasi</button>
            </a>
        </div>
    </div>

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
                                            'title': '{{ $l->nama_jalan }}'
                                        }
                                    },
                                @endforeach
                            ]
                        }
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
                }
            );
        });
    </script>
@endpush
