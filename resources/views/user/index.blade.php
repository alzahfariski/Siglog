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
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Pangkat</th>
                                <th>NRP</th>
                                <th>Jabatan</th>
                                <th>role</th>
                                <th style="width: 40px">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $nomor = 1 + ($user->currentPage() - 1) * $user->perPage();
                            @endphp
                            @foreach ($user as $u)
                                <tr>
                                    <td>{{ $nomor++ }}</td>
                                    <td>{{ $u->nama }}</td>
                                    <td>{{ $u->email }}</td>
                                    <td>{{ $u->pangkat }}</td>
                                    <td>{{ $u->nrp }}</td>
                                    <td>{{ $u->jabatan }}</td>
                                    <td>{{ $u->role }}</td>
                                    <td class="project-actions text-right">
                                        <a class="btn btn-info btn-sm" data-toggle="modal"
                                            data-target="#modal-edit-{{ $u->id_user }}">
                                            <i class="fas fa-pencil-alt">
                                            </i>
                                            Edit
                                        </a>
                                        <a class="btn btn-danger btn-sm" data-toggle="modal"
                                            data-target="#modal-delete-{{ $u->id_user }}">
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
                <div class="card-footer clearfix">
                    {{-- {{ $lokasi->links() }} --}}
                    {!! $user->appends(Request::except('page'))->render() !!}
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
                            <input type="text" placeholder="masukan nama user" class="form-control" name="nama"
                                required value='{{ old('nama') }}'>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="text" placeholder="masukan Email"
                                class="form-control @error('email') is-invalid @enderror" name="email" required
                                value='{{ old('email') }}'>
                            @error('email')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="pangkat">Pangkat</label>
                            <input type="text" placeholder="masukan pangkat" class="form-control" name="pangkat" required
                                value='{{ old('pangkat') }}'>
                        </div>
                        <div class="form-group">
                            <label for="nrp">NRP</label>
                            <input type="text" placeholder="masukan NRP" class="form-control" name="nrp" required
                                value='{{ old('nrp') }}'>
                        </div>
                        <div class="form-group">
                            <label for="jabatan">Jabatan</label>
                            <input type="text" placeholder="masukan jabatan" class="form-control" name="jabatan" required
                                value='{{ old('jabatan') }}'>
                        </div>
                        <div class="form-group">
                            <label for="role">Role</label>
                            <select class="form-control select2" style="width: 100%;" name="role">
                                <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>admin</option>
                                <option value="personel" {{ old('role') == 'personel' ? 'selected' : '' }}>personel
                                </option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" placeholder="masukan Password" class="form-control" name="password"
                                required value='{{ old('password') }}'>
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
                                <label for="email">email</label>
                                <input type="email" value="{{ $u->email }}" class="form-control" name="email">
                            </div>
                            <div class="form-group">
                                <label for="nrp">nrp</label>
                                <input type="nrp" value="{{ $u->nrp }}" class="form-control" name="nrp">
                            </div>
                            <div class="form-group">
                                <label for="jabatan">jabatan</label>
                                <input type="jabatan" value="{{ $u->jabatan }}" class="form-control" name="jabatan">
                            </div>
                            <div class="form-group">
                                <label for="role">Role</label>
                                <select class="form-control select2" style="width: 100%;" name="role">
                                    <option {{ old('role', $u->role) == 'admin' ? 'selected' : '' }}>admin</option>
                                    <option {{ old('role', $u->role) == 'personel' ? 'selected' : '' }}>personel</option>
                                </select>
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
    {{-- modal delete --}}
    @foreach ($user as $u)
        <div class="modal fade" id="modal-delete-{{ $u->id_user }}">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-danger">
                        <h4 class="modal-title">Hapus User</h4>
                    </div>
                    <div class="modal-body">
                        <p>Anda yakin ingin menghapus?</p>
                        <hr>
                        <h4>Keterangan Hapus :</h4>
                        <p>Menghapus data User juga akan menghapus data Barang Keluar</p>
                        <hr>
                        <p>Gunakan aksi edit jika hanya ingin merubah data User</p>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <div>
                            <form action="{{ route('user.destroy', $u->id_user) }}" method="POST">
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
@push('script')
    @if ($errors->any())
        <script>
            $('#modal-tambah').modal('show');
        </script>
    @endif
@endpush
