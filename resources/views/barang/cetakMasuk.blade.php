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
                                    <b>{{ $masuk->barang->nama_barang }}</b>
                                </h4>
                                <h5 class="text-center">
                                    <small>Tanggal masuk :
                                        {{ $masuk->created_at->format('d-m-Y') }}</small>
                                </h5>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Nama Barang</th>
                                            <th>Jenis</th>
                                            <th>penyimpanan</th>
                                            <th>Jumlah masuk</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>{{ $masuk->barang->nama_barang }}</td>
                                            <td>{{ $masuk->barang->jenis->nama_jenis }}</td>
                                            <td>{{ $masuk->barang->gudang->nama_gudang }}</td>
                                            <td>{{ $masuk->jumlah_masuk }} {{ $masuk->barang->jenis->nama_satuan }}</td>
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
                            <div class="col-sm-4 invoice-col">
                                Pemasok :
                                <address>
                                    <strong>{{ $masuk->pemasok->nama_pemasok }}</strong><br>
                                </address>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
