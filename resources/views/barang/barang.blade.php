@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-12 mb-2">
            @can('admin')
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-tambah">
                    <i class="fas fa-plus"></i> Tambah Barang</button>

                <a href="{{ route('barang.cetak') }}" target="_blank" type="button" class="btn btn-secondary">
                    <i class="fas fa-print"></i> Print data Barang
                </a>
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
                                <th>Nama Barang</th>
                                <th>Jenis</th>
                                <th>Jumlah</th>
                                <th>Satuan</th>
                                <th>Penyimpanan</th>
                                <th style="width: 40px">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $nomor = 1 + ($barang->currentPage() - 1) * $barang->perPage();
                            @endphp
                            @foreach ($barang as $b)
                                <tr>
                                    <td>{{ $nomor++ }}</td>
                                    <td>{{ $b->nama_barang }}</td>
                                    <td>{{ $b->jenis->nama_jenis }}</td>
                                    <td>{{ $b->jumlah }}</td>
                                    <td>{{ $b->jenis->nama_satuan }}</td>
                                    <td><span class="tag">{{ $b->gudang->nama_gudang }}</span></td>
                                    <td class="project-actions text-right">
                                        <a class="btn btn-primary btn-sm" href="{{ route('barang.view', $b->id_barang) }}">
                                            <i class="fas fa-folder">
                                            </i>
                                            View
                                        </a>
                                        @can('admin')
                                            <a class="btn btn-info btn-sm" data-toggle="modal"
                                                data-target="#modal-edit-{{ $b->id_barang }}">
                                                <i class="fas fa-pencil-alt">
                                                </i>
                                                Edit
                                            </a>
                                            <a class="btn btn-danger btn-sm" data-toggle="modal"
                                                data-target="#modal-delete-{{ $b->id_barang }}">
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
                    {!! $barang->appends(Request::except('page'))->render() !!}
                </div>
            </div>
        </div>
    </div>
    {{-- modal add --}}
    <div class="modal fade" id="modal-tambah">
        <div class="modal-dialog">
            <form action="{{ route('barang.store') }}" method="POST">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Tambah Barang</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="nama_barang">Nama Barang</label>
                            <input type="text" placeholder="masukan nama barang" class="form-control" name="nama_barang"
                                required>
                        </div>
                        <div class="form-group">
                            <label for="id_jenis">Nama Jenis</label>
                            <select class="form-control select2" style="width: 100%;" name="id_jenis">
                                @foreach ($jenis as $j)
                                    <option value="{{ $j->id_jenis }}">{{ $j->nama_jenis }}</option>
                                @endforeach
                            </select>
                        </div>
                        <label for="id_gudang">Gudang</label>
                        <select class="form-control select2" style="width: 100%;" name="id_gudang">
                            @foreach ($gudang as $g)
                                <option value="{{ $g->id_gudang }}">{{ $g->nama_gudang }}</option>
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
    {{-- modal update --}}
    @foreach ($barang as $b)
        <div class="modal fade" id="modal-edit-{{ $b->id_barang }}">
            <div class="modal-dialog">
                <form action="{{ route('barang.update', $b->id_barang) }}" method="POST">
                    @method('put')
                    @csrf
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Edit Barang</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <input type="text" hidden value="{{ $b->id_barang }}">
                            <div class="form-group">
                                <label for="nama_barang">Nama Barang</label>
                                <input type="text" value="{{ $b->nama_barang }}" class="form-control"
                                    name="nama_barang">
                            </div>
                            <div class="form-group">
                                <label for="nama_barang">Nama Jenis</label>
                                <select class="form-control select2" style="width: 100%;" name="id_jenis">
                                    @foreach ($jenis as $j)
                                        <option value="{{ $j->id_jenis }}"
                                            @if ($j->id_jenis == $b->jenis->id_jenis) selected @endif>
                                            {{ $j->nama_jenis }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="nama_barang">Gudang</label>
                                <select class="form-control select2" style="width: 100%;" name="id_gudang">
                                    @foreach ($gudang as $g)
                                        <option value="{{ $g->id_gudang }}"
                                            @if ($g->id_gudang == $b->gudang->id_gudang) selected @endif>
                                            {{ $g->nama_gudang }}

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
    @foreach ($barang as $b)
        <div class="modal fade" id="modal-delete-{{ $b->id_barang }}">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-danger">
                        <h4 class="modal-title">Hapus Barang</h4>

                    </div>
                    <div class="modal-body">
                        <p>Anda yakin ingin menghapus?</p>
                        <hr>
                        <h4>Keterangan Hapus :</h4>
                        <p>Menghapus Barang akan juga menghapus <br> data Barang Masuk dan Barang Keluar</p>
                        <hr>
                        <p>Gunakan aksi edit jika hanya ingin merubah data Barang</p>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <form action="{{ route('barang.destroy', $b->id_barang) }}" method="POST">
                            @csrf
                            @method('delete')
                            <input type="submit" name="submit" value="Hapus" class="btn btn-danger">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection
