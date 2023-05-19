@extends('layouts.app')
@section('content')
    <section class="content">
        <div class="row">
            <div class="col-md-6">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Lokasi</h3>
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
                        <div class="form-group">
                            <label for="longitude">Longitude</label>
                            <input type="text" name="longitude" id="longitude" class="form-control"
                                value="{{ $lokasi->longitude }}">
                        </div>
                        <div class="form-group">
                            <label for="latitude">Latitude</label>
                            <input type="text" name="latitude" id="latitude" class="form-control"
                                value="{{ $lokasi->latitude }}">
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
