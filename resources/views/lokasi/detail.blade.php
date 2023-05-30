@extends('layouts.app')
@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Peta</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <style>
                            #marker {
                                background-image: url('/img/mbgreen.png');
                                background-repeat: no-repeat;
                                width: 28px;
                                height: 28px;
                                cursor: pointer;
                            }
                        </style>
                        <div class="card-body">
                            <div id='map' style='width: 100%; height: 450px;'></div>
                        </div>

                    </div>

                </div>
                <div class="col-md-6">
                    <div class="invoice p-3 mb-3">
                        <div class="row">
                            <div class="col-12">
                                <h4>
                                    <b>{{ $lokasi->nama_gudang }}</b><br><br>
                                    <small class="float-right">Tanggal lokasi ditambahkan :
                                        {{ $lokasi->created_at->format('Y-m-d') }}</small>
                                </h4>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Id Gudang</th>
                                            <th>Nama lokasi</th>
                                            <th>Kategori</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>{{ $lokasi->id_lokasi }}</td>
                                            <td>{{ $lokasi->nama_jalan }}</td>
                                            <td>{{ $lokasi->kategori }}</td>

                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4 invoice-col">
                                <b>keterangan :</b>
                                <address>
                                    {{ $lokasi->keterangan }}
                                </address>
                            </div>
                            <div class="col-sm-4 invoice-col">
                                <b>alamat :</b>
                                <address>
                                    {{ $lokasi->alamat }}
                                </address>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4 invoice-col">
                                <b>Latitude:</b>
                                <address>
                                    {{ $lokasi->latitude }}
                                </address>
                            </div>
                            <div class="col-sm-4 invoice-col">
                                <b>Longitude :</b>
                                <address>
                                    {{ $lokasi->longitude }}
                                </address>
                            </div>
                        </div>
                    </div>
                    <a href="{{ route('lokasi.daftar') }}" class="btn btn-secondary float-right">Kembali</a>
                </div>
            </div>
        </div>
    </section>
@endsection
@push('script')
    <script>
        mapboxgl.accessToken = '{{ env('MAPBOX_KEY') }}';
        const map = new mapboxgl.Map({
            container: 'map', // container ID
            style: 'mapbox://styles/mapbox/streets-v12', // style URL
            center: [{{ $lokasi->longitude }}, {{ $lokasi->latitude }}], // starting position [lng, lat]
            zoom: 16, // starting zoom
        });
        map.addControl(new mapboxgl.NavigationControl())
        const el = document.createElement('div');
        el.id = 'marker';
        const monument = [{{ $lokasi->longitude }}, {{ $lokasi->latitude }}];
        new mapboxgl.Marker(el)
            .setLngLat(monument)
            .addTo(map);
    </script>
@endpush
