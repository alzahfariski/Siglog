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
                                    <b>{{ $gudang->nama_gudang }}</b>
                                    <small class="float-right">Tanggal gudang ditambahkan :
                                        {{ $gudang->created_at->format('Y-m-d') }}</small>
                                </h4>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Id gudang</th>
                                            <th>Nama gudang</th>
                                            <th>Keterangan</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>{{ $gudang->id_gudang }}</td>
                                            <td>{{ $gudang->nama_gudang }}</td>
                                            <td>{{ $gudang->keterangan }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4 invoice-col">
                                Lokasi :
                                <address>
                                    <strong>{{ $gudang->lokasi->nama_jalan }}</strong><br>
                                    {{ $gudang->lokasi->alamat }}<br>
                                </address>
                            </div>
                            <div class="col-sm-4 invoice-col">
                                Keterangan :
                                <address>
                                    <strong>{{ $gudang->lokasi->keterangan }}</strong><br>
                                    {{ $gudang->lokasi->kategori }}<br>
                                </address>
                            </div>
                            <div class="col-sm-4 invoice-col">
                                koordinat :
                                <address>
                                    longitude: {{ $gudang->lokasi->longitude }}<br>
                                    latitude: {{ $gudang->lokasi->latitude }}<br>
                                </address>
                            </div>
                        </div>
                        <div class="row no-print">
                            <div class="col-12">
                                <button type="button" class="btn btn-primary float-right" style="margin-right: 5px;">
                                    <i class="fas fa-download"></i> Generate PDF
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
