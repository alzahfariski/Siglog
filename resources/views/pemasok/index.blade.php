@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-12 mb-2">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-tambah">
                <i class="fas fa-plus"></i> Tambah Pemasok</button>
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
                                <th>Nama Pemasok</th>
                                <th>No Telp</th>
                                <th>email</th>
                                <th style="width: 40px">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pemasok as $p)
                                <tr>
                                    <td>{{ $p->id_pemasok }}</td>
                                    <td>{{ $p->nama_pemasok }}</td>
                                    <td>{{ $p->no_telp }}</td>
                                    <td>{{ $p->email }}</td>
                                    <td class="project-actions text-right">
                                        <a class="btn btn-info btn-sm" data-toggle="modal"
                                            data-target="#modal-edit-{{ $p->id_pemasok }}">
                                            <i class="fas fa-pencil-alt">
                                            </i>
                                            Edit
                                        </a>
                                        <a class="btn btn-danger btn-sm" data-toggle="modal"
                                            data-target="#modal-delete-{{ $p->id_pemsok }}">
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
            <form action="{{ route('pemasok.store') }}" method="POST">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Tambah Pemasok</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="nama_pemasok">Nama Pemasok</label>
                            <input type="text" placeholder="masukan nama pemasok" class="form-control"
                                name="nama_pemasok">
                        </div>
                        <div class="form-group">
                            <label for="email">Email pemasok</label>
                            <input type="email" placeholder="masukan email" class="form-control" name="email">
                        </div>
                        <div class="form-group">
                            <label for="no_telp">No Telp</label>
                            <input type="number" placeholder="masukan nomer telp" class="form-control" name="no_telp">
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
    @foreach ($pemasok as $p)
        <div class="modal fade" id="modal-edit-{{ $p->id_pemasok }}">
            <div class="modal-dialog">
                <form action="{{ route('pemasok.update', $p->id_pemasok) }}" method="POST">
                    @method('put')
                    @csrf
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Edit Pemasok</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <input type="text" hidden value="{{ $p->id_pemasok }}">
                            <div class="form-group">
                                <label for="nama_pemasok">Nama Pemasok</label>
                                <input type="text" value="{{ $p->nama_pemasok }}" class="form-control"
                                    name="nama_pemasok">
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" value="{{ $p->email }}" class="form-control" name="email">
                            </div>
                            <div class="form-group">
                                <label for="no_telp">Email</label>
                                <input type="number" value="{{ $p->no_telp }}" class="form-control" name="no_telp">
                            </div>

                        </div>
                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button class="btn btn-primary" type="submit" name="submit" value="save">Simpan</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    @endforeach
    {{-- modal delete --}}
    @foreach ($pemasok as $p)
        <div class="modal fade" id="modal-delete-{{ $p->id_pemsok }}">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-danger">
                        <h4 class="modal-title">Hapus Pemasok</h4>
                    </div>
                    <div class="modal-body">
                        <p>Anda yakin ingin menghapus?</p>
                        <hr>
                        <h4>Keterangan Hapus :</h4>
                        <p>Menghapus data Pemasok juga akan menghapus data Barang Masuk</p>
                        <hr>
                        <p>Gunakan aksi edit jika hanya ingin merubah data Pemasok</p>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <div>
                            <form action="{{ route('pemasok.destroy', $p->id_pemasok) }}" method="POST">
                                @csrf
                                @method('delete')
                                <input type="submit" name="submit" value="Hapus" class="btn btn-danger">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection
