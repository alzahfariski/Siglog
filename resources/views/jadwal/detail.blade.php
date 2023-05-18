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
                                    <b>{{ $jadwal->nama_jadwal }}</b>
                                    <small class="float-right">Tanggal jadwal ditambahkan :
                                        {{ $jadwal->created_at->format('Y-m-d') }}</small>
                                </h4>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Id jadwal</th>
                                            <th>Nama jadwal</th>
                                            <th>Jumlah</th>
                                            <th>Tanggal Jadwal</th>
                                        </tr>
                                    </thead>
                                    @php
                                        $tanggal = \Carbon\Carbon::parse($jadwal->tgl_jadwal);
                                    @endphp
                                    <tbody>
                                        <tr>
                                            <td>{{ $jadwal->id_jadwal }}</td>
                                            <td>{{ $jadwal->nama_jadwal }}</td>
                                            <td>{{ $jadwal->jumlah }}</td>
                                            <td>{{ $tanggal->format('d-m-Y') }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4 invoice-col">
                                Keterangan :
                                <address>
                                    <strong>{{ $jadwal->keterangan }}</strong><br>
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
