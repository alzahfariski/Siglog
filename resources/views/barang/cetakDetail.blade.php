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
                                    <b>{{ $barang->nama_barang }}</b>
                                </h4>
                                <h5 class="text-center">
                                    <small>Tanggal barang ditambahkan :
                                        {{ $barang->created_at->format('d-m-Y') }}</small>
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
                                            <th>penyimpanan</th>
                                            <th>Jumlah barang</th>
                                        </tr>
                                    </thead>
                                    @php
                                        $nomor = 1;
                                        $nomorm = 1;
                                        $nomork = 1;
                                    @endphp
                                    <tbody>
                                        <tr>
                                            <td>{{ $nomor++ }}</td>
                                            <td>{{ $barang->nama_barang }}</td>
                                            <td>{{ $barang->jenis->nama_jenis }}</td>
                                            <td>{{ $barang->lokasi->nama_gudang }}</td>
                                            <td>{{ $barang->jumlah }} {{ $barang->jenis->nama_satuan }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-12">
                                <h6>
                                    Riwayat barang diterima
                                </h6>
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
                                            <th>penyimpanan</th>
                                            <th>Jumlah barang</th>
                                            <th>tanggal diterima</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($masuk as $m)
                                            <tr>
                                                <td>{{ $nomorm++ }}</td>
                                                <td>{{ $m->barang->nama_barang }}</td>
                                                <td>{{ $m->barang->jenis->nama_jenis }}</td>
                                                <td>{{ $m->barang->lokasi->nama_gudang }}</td>
                                                <td>{{ $m->jumlah_masuk }} {{ $barang->jenis->nama_satuan }}</td>
                                                <td>{{ $m->created_at->format('Y-m-d') }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-12">
                                <h6>
                                    Riwayat penyerahan barang
                                </h6>
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
                                            <th>penyimpanan</th>
                                            <th>Jumlah barang</th>
                                            <th>tanggal serahkan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($keluar as $k)
                                            <tr>
                                                <td>{{ $nomork++ }}</td>
                                                <td>{{ $k->barang->nama_barang }}</td>
                                                <td>{{ $k->barang->jenis->nama_jenis }}</td>
                                                <td>{{ $k->barang->lokasi->nama_gudang }}</td>
                                                <td>{{ $k->barang->jumlah }} {{ $barang->jenis->nama_satuan }}</td>
                                                <td>{{ $k->created_at->format('Y-m-d') }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
