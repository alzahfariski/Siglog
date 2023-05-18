@extends('cetak.app')
@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="invoice p-3 mb-3">
                        <div class="row">
                            <div class="col-12">
                                <h4 class="text-center">
                                    <b>{{ $jadwal->nama_jadwal }}</b>
                                </h4>
                                <h5 class="text-center">
                                    <small>Tanggal jadwal ditambahkan :
                                        {{ $jadwal->created_at->format('d-m-Y') }}</small>
                                </h5>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Nama Jadwal</th>
                                            <th>Jumlah</th>
                                            <th>Tanggal Jadwal</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>{{ $jadwal->nama_jadwal }}</td>
                                            <td>{{ $jadwal->jumlah }}</td>
                                            <td>{{ $jadwal->tgl_jadwal }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4 invoice-col">
                                Keterangan :
                                <address>
                                    <strong>{{ $jadwal->keterangan }}</strong>
                                </address>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
