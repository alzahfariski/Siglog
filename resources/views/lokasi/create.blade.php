@extends('layouts.app')
@section('content')
    <section class="content">
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
                    <div class="card-body">
                        <div id='map' style='width: 100%; height: 590px;'></div>
                    </div>

                </div>

            </div>
            <div class="col-md-6">
                <div class="card card-secondary">
                    <div class="card-header">
                        <h3 class="card-title">Lokasi</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('lokasi.store') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="longitude">Longitude</label>
                                <input type="text" name="longitude" id="longitude" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="latitude">Latitude</label>
                                <input type="text" name="latitude" id="latitude" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="nama_jalan">Nama Jalan</label>
                                <input type="text" id="nama_jalan" name="nama_jalan" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="alamat">Alamat</label>
                                <textarea id="alamat" name="alamat" class="form-control" rows="4"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="kategori">Kategori</label>
                                <select id="kategori" name="kategori" class="form-control custom-select">
                                    <option>Bagian Logistik</option>
                                    <option>Bagian SDM</option>
                                    <option>Satuan Lalu Lintas</option>
                                    <option>Satuan Samapta</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="keterangan">Keterangan</label>
                                <input type="text" name="keterangan" id="keterangan" class="form-control">
                            </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 mb-4">
                <a href="{{ route('lokasi.index') }}" class="btn btn-secondary">Kembali</a>
                <button type="submit" name="submit" value="save" class="btn btn-primary float-right">Simpan</button>
            </div>
        </div>
        </form>
    </section>
@endsection
@push('script')
    <script>
        mapboxgl.accessToken = 'pk.eyJ1IjoiYWx6YWgiLCJhIjoiY2xobjhpaDJpMGw2ODNxcXJxYWFxamF4ayJ9.lwwpWmV4b5BeJ2b8ivZfeQ';
        const map = new mapboxgl.Map({
            container: 'map', // container ID
            style: 'mapbox://styles/mapbox/streets-v12', // style URL
            center: [102.2521195394366, -3.7894423262683987], // starting position [lng, lat]
            zoom: 16, // starting zoom
        });
    </script>
@endpush
