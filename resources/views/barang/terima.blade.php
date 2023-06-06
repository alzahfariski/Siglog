@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-12 mb-2">
            <a href="{{ route('terima.cetak') }}" target="_blank" type="button" class="btn btn-secondary">
                <i class="fas fa-print"></i> Print Barang Diterima </a>
        </div>
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Tabel data barang diterima</h3>
                    <div class="card-tools">
                        <form method="GET">
                            <div class="input-group input-group-sm" style="width: 150px;">
                                <input type="text" name="search" class="form-control float-right" placeholder="Search"
                                    value="{{ $search }}">
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-default">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Barang</th>
                                <th>Jumlah Keluar</th>
                                <th>Penerima</th>
                                <th>Tanggal</th>
                                <th style="width: 40px">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $nomor = 1 + ($terima->currentPage() - 1) * $terima->perPage();
                            @endphp
                            @foreach ($terima as $k)
                                <tr>
                                    <td>{{ $nomor++ }}</td>
                                    <td>{{ $k->barang->nama_barang }}</td>
                                    <td>{{ $k->jumlah_keluar }}</td>
                                    <td>{{ $k->user->nama }}</td>
                                    <td>{{ $k->created_at->format('Y-m-d') }}</td>
                                    <td class="project-actions text-right">
                                        <a class="btn btn-primary btn-sm" href="{{ route('terima.view', $k->id_keluar) }}">
                                            <i class="fas fa-folder">
                                            </i>
                                            View
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="card-footer clearfix">
                    {{-- {{ $lokasi->links() }} --}}
                    {!! $terima->appends(Request::except('page'))->render() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
