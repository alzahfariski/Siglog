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
                                    <b>{{ $terima->barang->nama_barang }}</b>
                                    <small class="float-right">Tanggal barang keluar :
                                        {{ $terima->created_at->format('Y-m-d') }}</small>
                                </h4>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Id barang</th>
                                            <th>Nama Barang</th>
                                            <th>Jumlah keluar</th>
                                            <th>Penerima</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>{{ $terima->id_keluar }}</td>
                                            <td>{{ $terima->barang->nama_barang }}</td>
                                            <td>{{ $terima->jumlah_keluar }}</td>
                                            <td>{{ $terima->user->nama }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4 invoice-col">
                                Dari Penyimpanan:
                                <address>
                                    <strong>{{ $terima->barang->lokasi->nama_gudang }}</strong><br>
                                    {{ $terima->barang->lokasi->keterangan }}<br>
                                </address>
                            </div>
                            <div class="col-sm-4 invoice-col">
                                Penerima :
                                <address>
                                    <strong>{{ $terima->user->nama }}</strong>
                                </address>
                            </div>
                        </div>
                        <div class="row no-print">
                            <div class="col-12">
                                <a href="{{ route('terima.cetakTerima', $terima->id_keluar) }}" target="_blank">
                                    <button type="button" class="btn btn-primary float-right" style="margin-right: 5px;">
                                        <i class="fas fa-download"></i> Cetak PDF
                                    </button>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
