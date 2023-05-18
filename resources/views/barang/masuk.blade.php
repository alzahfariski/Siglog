@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-12 mb-2">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-tambah">
                <i class="fas fa-plus"></i> Tambah barang masuk</button>
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
                                <th>Nama Barang</th>
                                <th>Jumlah Masuk</th>
                                <th>Pemasok</th>
                                <th>Tgl</th>
                                <th style="width: 40px">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($masuk as $m)
                                <tr>
                                    <td>{{ $m->id_masuk }}</td>
                                    <td>{{ $m->barang->nama_barang }}</td>
                                    <td>{{ $m->jumlah_masuk }}</td>
                                    <td>{{ $m->pemasok->nama_pemasok }}</td>
                                    <td>{{ $m->created_at->format('Y-m-d') }}</td>
                                    <td class="project-actions text-right">
                                        <a class="btn btn-primary btn-sm" href="{{ route('masuk.view', $m->id_masuk) }}">
                                            <i class="fas fa-folder">
                                            </i>
                                            View
                                        </a>
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
    {{-- MODAL ADD --}}
    <div class="modal fade" id="modal-tambah">
        <div class="modal-dialog">
            <form action="{{ route('masuk.store') }}" method="POST">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Tambah Barang Masuk</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="id_barang">Nama Barang</label>
                            <select class="form-control select2" style="width: 100%;" name="id_barang">
                                @foreach ($barang as $b)
                                    <option value="{{ $b->id_barang }}">
                                        {{ $b->nama_barang }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="id_pemasok">Nama pemasok</label>
                            <select class="form-control select2" style="width: 100%;" name="id_pemasok">
                                @foreach ($pemasok as $p)
                                    <option value="{{ $p->id_pemasok }}">
                                        {{ $p->nama_pemasok }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="nama_barang">Jumlah Barang</label>
                            <input type="number" placeholder="masukan nama barang" class="form-control"
                                name="jumlah_masuk">
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
