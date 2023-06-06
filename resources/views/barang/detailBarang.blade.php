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
                                    <b>{{ $barang->nama_barang }}</b>
                                    <small class="float-right">Tanggal barang ditambahkan :
                                        {{ $barang->created_at->format('Y-m-d') }}</small>
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
                                            <th>Jenis</th>
                                            <th>penyimpanan</th>
                                            <th>Jumlah barang</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>{{ $barang->id_barang }}</td>
                                            <td>{{ $barang->nama_barang }}</td>
                                            <td>{{ $barang->jenis->nama_jenis }}</td>
                                            <td>{{ $barang->lokasi->nama_gudang }}</td>
                                            <td>{{ $barang->jumlah }} {{ $barang->jenis->nama_satuan }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="invoice p-3 mb-3">

                        @can('admin')
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
                                                <th>Nama Barang</th>
                                                <th>Jenis</th>
                                                <th>penyimpanan</th>
                                                <th>Jumlah barang</th>
                                                <th>tanggal diserahkan</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($keluar as $k)
                                                <tr>
                                                    <td>{{ $k->barang->nama_barang }}</td>
                                                    <td>{{ $k->barang->jenis->nama_jenis }}</td>
                                                    <td>{{ $k->barang->lokasi->nama_gudang }}</td>
                                                    <td>{{ $k->jumlah_keluar }} {{ $barang->jenis->nama_satuan }}</td>
                                                    <td>{{ $k->created_at->format('Y-m-d') }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        @endcan
                        @can('personel')
                            <div class="row mt-2">
                                <div class="col-12">
                                    <h6>
                                        Riwayat barang dterima
                                    </h6>
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
                                                <th>Jumlah barang</th>
                                                <th>tanggal diterima</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($terima as $k)
                                                <tr>
                                                    <td>{{ $k->barang->nama_barang }}</td>
                                                    <td>{{ $k->barang->jenis->nama_jenis }}</td>
                                                    <td>{{ $k->barang->lokasi->nama_gudang }}</td>
                                                    <td>{{ $k->jumlah_keluar }} {{ $barang->jenis->nama_satuan }}</td>
                                                    <td>{{ $k->created_at->format('Y-m-d') }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        @endcan
                    </div>
                    @can('admin')
                        <div class="row no-print mb-3">
                            <div class="col-12">
                                <a href="{{ route('barang.cetakDetail', $barang->id_barang) }}" target="_blank">
                                    <button type="button" class="btn btn-primary float-right" style="margin-right: 5px;">
                                        <i class="fas fa-download"></i> Cetak PDF
                                    </button>
                                </a>
                            </div>
                        </div>
                    @endcan
                </div>
            </div>
        </div>
    </section>
@endsection
