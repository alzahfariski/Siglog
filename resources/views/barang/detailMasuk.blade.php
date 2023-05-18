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
                                    <b>{{ $masuk->barang->nama_barang }}</b>
                                    <small class="float-right">Tanggal barang Masuk :
                                        {{ $masuk->created_at->format('Y-m-d') }}</small>
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
                                            <th>Jumlah Masuk</th>
                                            <th>Pemasok</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>{{ $masuk->id_masuk }}</td>
                                            <td>{{ $masuk->barang->nama_barang }}</td>
                                            <td>{{ $masuk->jumlah_masuk }}</td>
                                            <td>{{ $masuk->pemasok->nama_pemasok }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4 invoice-col">
                                Penyimpanan :
                                <address>
                                    <strong>{{ $masuk->barang->gudang->nama_gudang }}</strong><br>
                                    {{ $masuk->barang->gudang->keterangan }}<br>
                                </address>
                            </div>
                            <div class="col-sm-4 invoice-col">
                                Lokasi :
                                <address>
                                    <strong>{{ $masuk->barang->gudang->lokasi->nama_jalan }}</strong><br>
                                    {{ $masuk->barang->gudang->lokasi->alamat }}<br>
                                </address>
                            </div>
                        </div>
                        <div class="row no-print">
                            <div class="col-12">
                                <a href="{{ route('masuk.cetakMasuk', $masuk->id_masuk) }}" target="_blank">
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
