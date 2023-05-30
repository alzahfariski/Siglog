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
                                    <b>{{ $keluar->barang->nama_barang }}</b>
                                </h4>
                                <h5 class="text-center">
                                    <small>Tanggal keluar :
                                        {{ $keluar->created_at->format('d-m-Y') }}</small>
                                </h5>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Barang</th>
                                            <th>Jenis</th>
                                            <th>Penerima</th>
                                            <th>Jumlah Keluar</th>
                                        </tr>
                                    </thead>
                                    @php
                                        $nomor = 1;
                                    @endphp
                                    <tbody>
                                        <tr>
                                            <td>{{ $nomor++ }}</td>
                                            <td>{{ $keluar->barang->nama_barang }}</td>
                                            <td>{{ $keluar->barang->jenis->nama_jenis }}</td>
                                            <td>{{ $keluar->user->nama }}</td>
                                            <td>{{ $keluar->jumlah_keluar }} {{ $keluar->barang->jenis->nama_satuan }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4 invoice-col">
                                Dari Penyimpanan :
                                <address>
                                    <strong>{{ $keluar->barang->lokasi->nama_gudang }}</strong><br>
                                    {{ $keluar->barang->lokasi->keterangan }}<br>
                                </address>
                            </div>
                            <div class="col-sm-4 invoice-col">
                                Lokasi :
                                <address>
                                    <strong>{{ $keluar->barang->lokasi->nama_jalan }}</strong><br>
                                    {{ $keluar->barang->lokasi->alamat }}<br>
                                </address>
                            </div>
                            <div class="col-sm-4 invoice-col">
                                Penerima :
                                <address>
                                    <strong>{{ $keluar->user->nama }}</strong><br>
                                </address>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
