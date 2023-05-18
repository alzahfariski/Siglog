@extends('layouts.app')
@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="invoice p-3 mb-3">
                        <div class="row">
                            <div class="col-12">
                                <h4>
                                    <b>{{ $lokasi->nama_jalan }}</b>
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
                                            <th>Id lokasi</th>
                                            <th>Nama lokasi</th>
                                            <th>Alamat</th>
                                            <th>Latitude</th>
                                            <th>Longitude</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>{{ $lokasi->id_lokasi }}</td>
                                            <td>{{ $lokasi->nama_jalan }}</td>
                                            <td>{{ $lokasi->alamat }}</td>
                                            <td>{{ $lokasi->latitude }}</td>
                                            <td>{{ $lokasi->longitude }} </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4 invoice-col">
                                keterangan :
                                <address>
                                    {{ $lokasi->keterangan }}
                                </address>
                            </div>
                            <div class="col-sm-4 invoice-col">
                                kategori :
                                <address>
                                    <strong>{{ $lokasi->kategori }}</strong>
                                </address>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
