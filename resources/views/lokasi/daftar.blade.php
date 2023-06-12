@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-12 mb-2">
            @can('admin')
                <a href="{{ route('lokasi.create') }}">
                    <button type="button" class="btn btn-primary"><i class="fas fa-plus"></i> Tambah Gudang</button>
                </a>
            @endcan
        </div>
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Tabel data Gudang</h3>
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
                                <th>NO</th>
                                <th>Nama Gudang</th>
                                <th>Nama Lokasi</th>
                                <th>Keterangan</th>
                                <th>kategori</th>
                                <th style="width: 40px">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $nomor = 1 + ($lokasi->currentPage() - 1) * $lokasi->perPage();
                            @endphp
                            @foreach ($lokasi as $l)
                                <tr>
                                    <td>{{ $nomor++ }}</td>
                                    <td>{{ $l->nama_gudang }}</td>
                                    <td>{{ $l->nama_jalan }}</td>
                                    <td>{{ $l->keterangan }}</td>
                                    <td>{{ $l->kategori }}</td>
                                    <td class="project-actions text-right">
                                        <a class="btn btn-primary btn-sm" href="{{ route('lokasi.view', $l->id_lokasi) }}">
                                            <i class="fas fa-folder">
                                            </i>
                                            Detail
                                        </a>
                                        @can('admin')
                                            <a class="btn btn-info btn-sm" href="{{ route('lokasi.edit', $l->id_lokasi) }}">
                                                <i class="fas fa-pencil-alt">
                                                </i>
                                                Edit
                                            </a>
                                            <a class="btn btn-danger btn-sm"data-toggle="modal"
                                                data-target="#modal-delete-{{ $l->id_lokasi }}">
                                                <i class="fas fa-trash">
                                                </i>
                                                Hapus
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
                    {!! $lokasi->appends(Request::except('page'))->render() !!}
                </div>
            </div>
        </div>
    </div>
    {{-- modal delete --}}
    @foreach ($lokasi as $l)
        <div class="modal fade" id="modal-delete-{{ $l->id_lokasi }}">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-danger">
                        <h4 class="modal-title">Hapus Lokasi</h4>
                    </div>
                    <div class="modal-body">
                        <p>Anda yakin ingin menghapus?</p>
                        <hr>
                        <h4>Keterangan Hapus :</h4>
                        <p>Menghapus data juga akan menghapus Barang yang tersimpan di Gudang</p>
                        <hr>
                        <p>Gunakan aksi Update jika hanya ingin merubah data Gudang</p>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <div>
                            <form action="{{ route('lokasi.destroy', $l->id_lokasi) }}" method="POST">
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
