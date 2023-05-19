@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-12 mb-2">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-tambah">
                <i class="fas fa-plus"></i> Tambah User</button>
        </div>
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Tabel Data User</h3>
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
                                <th>Nama</th>
                                <th>username</th>
                                <th>role</th>
                                <th style="width: 40px">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($user as $u)
                                <tr>
                                    <td>{{ $u->id_user }}</td>
                                    <td>{{ $u->nama }}</td>
                                    <td>{{ $u->username }}</td>
                                    <td>{{ $u->role }}</td>
                                    <td class="project-actions text-right">
                                        <a class="btn btn-info btn-sm"data-toggle="modal"
                                            data-target="#modal-edit-{{ $u->id_user }}">
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
            <form action="{{ route('user.store') }}" method="POST">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Tambah User</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="nama">Nama User</label>
                            <input type="text" placeholder="masukan nama user" class="form-control" name="nama">
                        </div>
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" placeholder="masukan Username" class="form-control" name="username">
                        </div>
                        <div class="form-group">
                            <label for="role">Role</label>
                            <select class="form-control select2" style="width: 100%;" name="role">
                                <option value="admin">admin</option>
                                <option value="personel">personel</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" placeholder="masukan Password" class="form-control" name="password">
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
    @foreach ($user as $u)
        <div class="modal fade" id="modal-edit-{{ $u->id_user }}">
            <div class="modal-dialog">
                <form action="{{ route('user.update', $u->id_user) }}" method="POST">
                    @method('put')
                    @csrf
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Edit User</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <input type="text" hidden value="{{ $u->id_user }}">
                            <div class="form-group">
                                <label for="nama">Nama User</label>
                                <input type="text" value="{{ $u->nama }}" class="form-control" name="nama">
                            </div>
                            <div class="form-group">
                                <label for="username">username</label>
                                <input type="username" value="{{ $u->username }}" class="form-control"
                                    name="username">
                            </div>
                            <div class="form-group">
                                <label for="password">password</label>
                                <input type="password" value="{{ $u->password }}" class="form-control"
                                    name="password">
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
@endsection
