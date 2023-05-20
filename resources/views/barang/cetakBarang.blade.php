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
                                            <th>Nama Barang</th>
                                            <th>Jenis</th>
                                            <th>penyimpanan</th>
                                            <th>Jumlah</th>
                                            <th>Satuan</th>
                                            <th>Penyimpanan</th>
                                            <th>Lokasi</th>
                                        </tr>
                                    </thead>
                                    @foreach ($barang as $b)
                                        <tbody>
                                            <tr>
                                                <td>{{ $b->nama_barang }}</td>
                                                <td>{{ $b->jenis->nama_jenis }}</td>
                                                <td>{{ $b->gudang->nama_gudang }}</td>
                                                <td>{{ $b->jumlah }}</td>
                                                <td>{{ $b->jenis->nama_satuan }}</td>
                                                <td>{{ $b->gudang->nama_gudang }}</td>
                                                <td>{{ $b->gudang->lokasi->nama_jalan }}</td>
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
