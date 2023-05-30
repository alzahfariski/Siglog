@extends('cetak.app')
@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="invoice p-3 mb-3">
                        <div class="row">
                            <div class="col-12 table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Barang</th>
                                            <th>Jenis</th>
                                            <th>penyimpanan</th>
                                            <th>Jumlah masuk</th>
                                            <th>Lokasi</th>
                                            <th>Pemasok</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $nomor = 1;
                                        @endphp
                                        @foreach ($masuk as $m)
                                            <tr>
                                                <td>{{ $nomor++ }}</td>
                                                <td>{{ $m->barang->nama_barang }}</td>
                                                <td>{{ $m->barang->jenis->nama_jenis }}</td>
                                                <td>{{ $m->barang->lokasi->nama_gudang }}</td>
                                                <td>{{ $m->jumlah_masuk }} {{ $m->barang->jenis->nama_satuan }}</td>
                                                <td>{{ $m->barang->lokasi->nama_jalan }}</td>
                                                <td>{{ $m->pemasok }}</td>
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
