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
                                            <th>Jumlah</th>
                                            <th>Satuan</th>
                                            <th>Lokasi</th>
                                        </tr>
                                    </thead>
                                    @php
                                        $nomor = 1;
                                    @endphp
                                    @foreach ($barang as $b)
                                        <tbody>
                                            <tr>
                                                <td>{{ $nomor++ }}</td>
                                                <td>{{ $b->nama_barang }}</td>
                                                <td>{{ $b->jenis->nama_jenis }}</td>
                                                <td>{{ $b->lokasi->nama_gudang }}</td>
                                                <td>{{ $b->jumlah }}</td>
                                                <td>{{ $b->jenis->nama_satuan }}</td>
                                                <td>{{ $b->lokasi->nama_jalan }}</td>
                                            </tr>
                                        </tbody>
                                    @endforeach
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
