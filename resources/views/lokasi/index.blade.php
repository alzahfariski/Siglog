@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-12">
            <a href="{{ route('lokasi.create') }}">
                <button type="button" class="btn btn-primary"><i class="fas fa-plus"></i> Tambah Lokasi</button>
            </a>
            <a href="{{ route('lokasi.daftar') }}">
                <button type="button" class="btn btn-primary"><i class="fas fa-list"></i> Daftar Lokasi</button>
            </a>
        </div>
    </div>
    {{-- <div class="border border-dark m-2">
        <div class="row">
            <div class="col-12">
                <div id='map' style='width: 100%; height: 500px;'></div>
            </div>
        </div>
    </div> --}}
@endsection
@push('script')
    {{-- <script>
        mapboxgl.accessToken = 'pk.eyJ1IjoiYWx6YWgiLCJhIjoiY2xobjhpaDJpMGw2ODNxcXJxYWFxamF4ayJ9.lwwpWmV4b5BeJ2b8ivZfeQ';
        const map = new mapboxgl.Map({
            container: 'map', // container ID
            style: 'mapbox://styles/mapbox/streets-v12', // style URL
            center: [102.2521195394366, -3.7894423262683987], // starting position [lng, lat]
            zoom: 16, // starting zoom
        });
    </script> --}}
@endpush
