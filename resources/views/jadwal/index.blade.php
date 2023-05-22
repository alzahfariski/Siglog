@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-12 mb-2">
            @can('admin')
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-tambah">
                    <i class="fas fa-plus"></i> Tambah jadwal</button>
            @endcan

        </div>
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Tabel data jadwal</h3>
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
                                <th>ID</th>
                                <th>Nama Permintaan</th>
                                <th>Tgl jadwal</th>
                                <th>Tgl selesai</th>
                                <th>Jumlah</th>
                                <th style="width: 40px">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($jadwal as $j)
                                @php
                                    $tanggal = \Carbon\Carbon::parse($j->tgl_jadwal);
                                @endphp
                                <tr>
                                    <td>{{ $j->id_jadwal }}</td>
                                    <td>{{ $j->nama_jadwal }}</td>
                                    <td>{{ $j->created_at->format('Y-m-d') }}</td>
                                    <td>{{ $tanggal->format('Y-m-d') }}</td>
                                    <td>{{ $j->jumlah }}</td>
                                    <td class="project-actions text-right">
                                        <a class="btn btn-primary btn-sm" href="{{ route('jadwal.view', $j->id_jadwal) }}">
                                            <i class="fas fa-folder">
                                            </i>
                                            View
                                        </a>
                                        @can('admin')
                                            <a class="btn btn-info btn-sm" data-toggle="modal"
                                                data-target="#modal-edit-{{ $j->id_jadwal }}">
                                                <i class="fas fa-pencil-alt">
                                                </i>
                                                Edit
                                            </a>
                                            <a class="btn btn-danger btn-sm" data-toggle="modal"
                                                data-target="#modal-delete-{{ $j->id_jadwal }}">
                                                <i class="fas fa-trash">
                                                </i>
                                                Delete
                                            </a>
                                        @endcan
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="card-footer clearfix">
                    {{-- {{ $lokasi->links() }} --}}
                    {!! $jadwal->appends(Request::except('page'))->render() !!}
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modal-tambah">
        <div class="modal-dialog">
            <form action="{{ route('jadwal.store') }}" method="POST">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Tambah Jadwal</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="nama_jadwal">Nama jadwal</label>
                            <input type="text" placeholder="masukan nama jadwal" class="form-control" name="nama_jadwal">
                        </div>
                        <div class="form-group">
                            <label for="keterangan">keterangan</label>
                            <input type="text" placeholder="masukan keterangan" class="form-control" name="keterangan">
                        </div>
                        <div class="form-group">
                            <label for="jumlah">Jumlah</label>
                            <input type="text" placeholder="masukan jumlah" class="form-control" name="jumlah">
                        </div>
                        <div class="form-group">
                            <label for="tgl_jadwal">tanggal</label>
                            <input type="date" placeholder="masukan tanggal" class="form-control" name="tgl_jadwal">
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
    @foreach ($jadwal as $j)
        <div class="modal fade" id="modal-edit-{{ $j->id_jadwal }}">
            <div class="modal-dialog">
                <form action="{{ route('jadwal.update', $j->id_jadwal) }}" method="POST">
                    @method('put')
                    @csrf
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Edit Jadwal</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <input type="text" hidden value="{{ $j->id_jadwal }}">
                            <div class="form-group">
                                <label for="nama_jadwal">Nama Jenis</label>
                                <input type="text" value="{{ $j->nama_jadwal }}" class="form-control"
                                    name="nama_jadwal">
                            </div>
                            <div class="form-group">
                                <label for="keterangan">keterangan</label>
                                <input type="text" value="{{ $j->keterangan }}" class="form-control"
                                    name="keterangan">
                            </div>
                            <div class="form-group">
                                <label for="jumlah">Jumlah</label>
                                <input type="number" value="{{ $j->jumlah }}" class="form-control" name="jumlah">
                            </div>
                            <div class="form-group">
                                <label for="tgl_jadwal">tanggal</label>
                                <input type="date" value="{{ $j->tgl_jadwal }}" class="form-control"
                                    name="tgl_jadwal">
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
    @foreach ($jadwal as $j)
        {{-- modal delete --}}
        <div class="modal fade" id="modal-delete-{{ $j->id_jadwal }}">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-danger">
                        <h4 class="modal-title">Hapus Jadwal</h4>
                    </div>
                    <div class="modal-body">
                        <p>Anda yakin ingin menghapus?</p>
                        <hr>
                        <p>Gunakan aksi edit jika hanya ingin merubah data Jadwal</p>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <div>
                            <form action="{{ route('jadwal.destroy', $j->id_jadwal) }}" method="POST">
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
