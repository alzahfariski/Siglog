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
                                            <th>Penerima</th>
                                            <th>Jumlah Keluar</th>
                                            <th>Penyimpanan</th>
                                            <th>Lokasi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($terima as $k)
                                            <tr>
                                                <td>{{ $k->barang->nama_barang }}</td>
                                                <td>{{ $k->barang->jenis->nama_jenis }}</td>
                                                <td>{{ $k->user->nama }}</td>
                                                <td>{{ $k->jumlah_keluar }} {{ $k->barang->jenis->nama_satuan }}</td>
                                                <td>{{ $k->barang->lokasi->nama_gudang }}</td>
                                                <td>{{ $k->barang->lokasi->nama_jalan }}</td>
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
