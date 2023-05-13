@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-12 mb-2">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-tambah">
                <i class="fas fa-plus"></i> Tambah jenis</button>
        </div>
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Tabel data jenis</h3>
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
                                <th>Nama jenis</th>
                                <th>Nama Stauan</th>
                                <th style="width: 40px">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($jenis as $j)
                                <tr>
                                    <td>{{ $j->id_jenis }}</td>
                                    <td>{{ $j->nama_jenis }}</td>
                                    <td>{{ $j->nama_satuan }}</td>
                                    <td class="project-actions text-right">
                                        <a class="btn btn-info btn-sm" href="#">
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

    <div class="modal fade" id="modal-tambah">
        <div class="modal-dialog">
            <form action="{{ route('jenis.store') }}" method="POST">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Tambah Jenis Barang</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="nama_barang">Nama Jenis</label>
                            <input type="text" placeholder="masukan nama barang" class="form-control" name="nama_jenis">
                        </div>
                        <div class="form-group">
                            <label for="nama_barang">Nama Satuan</label>
                            <input type="text" placeholder="masukan nama barang" class="form-control" name="nama_satuan">
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" name="submit" value="save" class="btn btn-primary">Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
