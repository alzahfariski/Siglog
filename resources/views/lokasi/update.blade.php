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
                        <p class="card-text"><i class="fas fa-circle"></i>&nbsp;&nbsp;Klik pada peta untuk mendapatkan
                            koordinat
                        </p>
                        <div id='map' style='width: 100%; height: 520px;'></div>
                        <pre id="info"></pre>
                    </div>
                </div>

            </div>
            <div class="col-md-6">
                <div class="card card-secondary">
                    <div class="card-header">
                        <h3 class="card-title">Koordinat</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('lokasi.update', $lokasi->id_lokasi) }}" method="POST">
                            @csrf
                            @method('put')
                            <div class="form-group">
                                <label for="longitude">Longitude</label>
                                <input type="text" name="longitude" id="lng" class="form-control"
                                    value="{{ $lokasi->longitude }}">
                            </div>
                            <div class="form-group">
                                <label for="latitude">Latitude</label>
                                <input type="text" name="latitude" id="lat" class="form-control"
                                    value="{{ $lokasi->latitude }}">
                            </div>
                            <div class="form-group">
                                <label for="nama_jalan">Nama Jalan</label>
                                <input type="text" id="id_lokasi" name="id_lokasi" hidden
                                    value="{{ $lokasi->id_lokasi }}">
                                <input type="text" id="nama_jalan" name="nama_jalan" class="form-control"
                                    value="{{ $lokasi->nama_jalan }}">
                            </div>
                            <div class="form-group">
                                <label for="alamat">Alamat</label>
                                <textarea id="alamat" name="alamat" class="form-control" rows="4">{{ $lokasi->alamat }}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="kategori">Kategori</label>
                                <select id="kategori" name="kategori" class="form-control custom-select">
                                    <option {{ old('kategori', $lokasi->kategori) == 'Bagian Logistik' ? 'selected' : '' }}>
                                        Bagian Logistik</option>
                                    <option {{ old('kategori', $lokasi->kategori) == 'Bagian SDM' ? 'selected' : '' }}>
                                        Bagian SDM</option>
                                    <option
                                        {{ old('kategori', $lokasi->kategori) == 'Satuan Lalu Lintas' ? 'selected' : '' }}>
                                        Satuan Lalu Lintas</option>
                                    <option {{ old('kategori', $lokasi->kategori) == 'Satuan Samapta' ? 'selected' : '' }}>
                                        Satuan Samapta</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="keterangan">Keterangan</label>
                                <input type="text" name="keterangan" id="keterangan" class="form-control"
                                    value="{{ $lokasi->keterangan }}">
                            </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 mb-4">
                <a href="{{ route('lokasi.daftar') }}" class="btn btn-secondary">Cancel</a>
                <button type="submit" name="submit" value="save" class="btn btn-primary float-right">Simpan</button>
            </div>
        </div>
        </form>
    </section>
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

        let lng;
        let lat;

        const marker = new mapboxgl.Marker({
            'color': '#314ccd'
        });

        map.on('click', (event) => {
            marker.setLngLat(event.lngLat).addTo(map);

            lng = event.lngLat.lng;
            lat = event.lngLat.lat;
            document.getElementById("lng").value = lng;
            document.getElementById("lat").value = lat;
        });
    </script>
@endpush
