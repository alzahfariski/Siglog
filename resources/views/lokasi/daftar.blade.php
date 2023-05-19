@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-12 mb-2">
            <a href="{{ route('lokasi.create') }}">
                <button type="button" class="btn btn-primary"><i class="fas fa-plus"></i> Tambah Lokasi</button>
            </a>
        </div>
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Tabel data barang</h3>
                    <div class="card-tools">
                        <div class="input-group input-group-sm" style="width: 150px;">
                            <input type="text" name="table_search" class="form-control float-right" placeholder="Search">
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-default">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nama jalan</th>
                                <th>Alamat</th>
                                <th>kategori</th>
                                <th style="width: 40px">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($lokasi as $l)
                                <tr>
                                    <td>{{ $l->id_lokasi }}</td>
                                    <td>{{ $l->nama_jalan }}</td>
                                    <td>{{ $l->alamat }}</td>
                                    <td>{{ $l->kategori }}</td>
                                    <td class="project-actions text-right">
                                        <a class="btn btn-primary btn-sm" href="{{ route('lokasi.view', $l->id_lokasi) }}">
                                            <i class="fas fa-folder">
                                            </i>
                                            View
                                        </a>
                                        <a class="btn btn-info btn-sm" href="{{ route('lokasi.edit', $l->id_lokasi) }}">
                                            <i class="fas fa-pencil-alt">
                                            </i>
                                            Edit
                                        </a>
                                        <a class="btn btn-danger btn-sm" href="#">
                                            <i class="fas fa-trash">
                                            </i>
                                            Delete
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>

        </div>
    </div>
@endsection
