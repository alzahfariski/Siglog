@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-12 mb-2">
            @can('admin')
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-tambah">
                    <i class="fas fa-plus"></i> Tambah Gudang</button>
            @endcan
        </div>
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Tabel data barang</h3>
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
                                <th>Nama Gudang</th>
                                <th>Keterangan</th>
                                <th>lokasi</th>
                                <th style="width: 40px">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $nomor = 1 + ($gudang->currentPage() - 1) * $gudang->perPage();
                            @endphp
                            @foreach ($gudang as $g)
                                <tr>
                                    <td>{{ $nomor++ }}</td>
                                    <td>{{ $g->nama_gudang }}</td>
                                    <td>{{ $g->keterangan }}</td>
                                    <td>{{ $g->lokasi->nama_jalan }}</td>
                                    <td class="project-actions text-right">
                                        <a class="btn btn-primary btn-sm" href="{{ route('gudang.view', $g->id_gudang) }}">
                                            <i class="fas fa-folder">
                                            </i>
                                            View
                                        </a>
                                        @can('admin')
                                            <a class="btn btn-info btn-sm" data-toggle="modal"
                                                data-target="#modal-edit-{{ $g->id_gudang }}">
                                                <i class="fas fa-pencil-alt">
                                                </i>
                                                Edit
                                            </a>
                                            <a class="btn btn-danger btn-sm" data-toggle="modal"
                                                data-target="#modal-delete-{{ $g->id_gudang }}">
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
                    {!! $gudang->appends(Request::except('page'))->render() !!}
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modal-tambah">
        <div class="modal-dialog">
            <form action="{{ route('gudang.store') }}" method="POST">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Tambah Gudang</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="nama_gudang">Nama Gudang</label>
                            <input type="text" placeholder="masukan nama gudang" class="form-control" name="nama_gudang">
                        </div>
                        <div class="form-group">
                            <label for="keterangan">Keterangan</label>
                            <input type="text" placeholder="masukan keterangan gudang" class="form-control"
                                name="keterangan">
                        </div>
                        <label for="id_lokasi">Lokasi Gudang</label>
                        <select class="form-control select2" style="width: 100%;" name="id_lokasi">
                            @foreach ($lokasi as $l)
                                <option value="{{ $l->id_lokasi }}">{{ $l->nama_jalan }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button class="btn btn-primary" type="submit" name="submit" value="save">Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    @foreach ($gudang as $g)
        <div class="modal fade" id="modal-edit-{{ $g->id_gudang }}">
            <div class="modal-dialog">
                <form action="{{ route('gudang.update', $g->id_gudang) }}" method="POST">
                    @method('put')
                    @csrf
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Edit Gudang</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <input type="text" hidden value="{{ $g->id_gudang }}">
                            <div class="form-group">
                                <label for="nama_gudang">Nama Gudang</label>
                                <input type="text" value="{{ $g->nama_gudang }}" class="form-control"
                                    name="nama_gudang">
                            </div>
                            <div class="form-group">
                                <label for="keterangan">Keterangan</label>
                                <input type="text" value="{{ $g->keterangan }}" class="form-control"
                                    name="keterangan">
                            </div>
                            <div class="form-group">
                                <label for="id_lokasi">Lokasi</label>
                                <select class="form-control select2" style="width: 100%;" name="id_lokasi">
                                    @foreach ($lokasi as $l)
                                        <option value="{{ $l->id_lokasi }}"
                                            @if ($l->id_lokasi == $g->Lokasi->id_lokasi) selected @endif>
                                            {{ $l->nama_jalan }}
                                        </option>
                                    @endforeach
                                </select>
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
    @foreach ($gudang as $g)
        <div class="modal fade" id="modal-delete-{{ $g->id_gudang }}">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-danger">
                        <h4 class="modal-title">Hapus Gudang</h4>

                    </div>
                    <div class="modal-body">
                        <p>Anda yakin ingin menghapus?</p>
                        <hr>
                        <h4>Keterangan Hapus :</h4>
                        <p>Menghapus data Gudang juga akan menghapus data Barang</p>
                        <hr>
                        <p>Gunakan aksi edit jika hanya ingin merubah data Gudang</p>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <div>
                            <form action="{{ route('gudang.destroy', $g->id_gudang) }}" method="POST">
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
