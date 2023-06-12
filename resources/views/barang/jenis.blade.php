@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-12 mb-2">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-tambah">
                <i class="fas fa-plus"></i> Tambah jenis barang</button>

            <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#modal-excell">
                <i class="fas fa-file-excel"></i> upload data excel </button>

        </div>
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Tabel data jenis barang</h3>
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
                                <th>Nama jenis</th>
                                <th>Nama Satuan</th>
                                <th style="width: 40px">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $nomor = 1 + ($jenis->currentPage() - 1) * $jenis->perPage();
                            @endphp
                            @foreach ($jenis as $j)
                                <tr>
                                    <td>{{ $nomor++ }}</td>
                                    <td>{{ $j->nama_jenis }}</td>
                                    <td>{{ $j->nama_satuan }}</td>
                                    <td class="project-actions text-right">
                                        <a class="btn btn-info btn-sm" data-toggle="modal"
                                            data-target="#modal-edit-{{ $j->id_jenis }}">
                                            <i class="fas fa-pencil-alt">
                                            </i>
                                            Edit
                                        </a>
                                        <a class="btn btn-danger btn-sm" data-toggle="modal"
                                            data-target="#modal-delete-{{ $j->id_jenis }}">
                                            <i class="fas fa-trash">
                                            </i>
                                            Hapus
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="card-footer clearfix">
                    {{-- {{ $lokasi->links() }} --}}
                    {!! $jenis->appends(Request::except('page'))->render() !!}
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
                            <input type="text" placeholder="masukan nama barang"
                                class="form-control @error('nama_jenis') is-invalid @enderror" name="nama_jenis" required>
                        </div>
                        <div class="form-group">
                            <label for="nama_barang">Nama Satuan</label>
                            <input type="text" placeholder="masukan nama barang" class="form-control" name="nama_satuan"
                                required>
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
    @foreach ($jenis as $j)
        <div class="modal fade" id="modal-edit-{{ $j->id_jenis }}">
            <div class="modal-dialog">
                <form action="{{ route('jenis.update', $j->id_jenis) }}" method="POST">
                    @method('put')
                    @csrf
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Edit Jenis</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <input type="text" hidden value="{{ $j->id_jenis }}">
                            <div class="form-group">
                                <label for="nama_jenis">Nama Jenis</label>
                                <input type="text" value="{{ $j->nama_jenis }}" class="form-control" name="nama_jenis">
                            </div>
                            <div class="form-group">
                                <label for="nama_satuan">Nama Satuan</label>
                                <input type="text" value="{{ $j->nama_satuan }}" class="form-control"
                                    name="nama_satuan">
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
    @foreach ($jenis as $j)
        <div class="modal fade" id="modal-delete-{{ $j->id_jenis }}">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-danger">
                        <h4 class="modal-title">Hapus Jenis</h4>

                    </div>
                    <div class="modal-body">
                        <p>Anda yakin ingin menghapus?</p>
                        <hr>
                        <h4>Keterangan Hapus :</h4>
                        <p>Menghapus Jenis akan juga menghapus data Barang</p>
                        <hr>
                        <p>Gunakan aksi Update jika hanya ingin merubah data Jenis</p>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <form action="{{ route('jenis.destroy', $j->id_jenis) }}" method="POST">
                            @csrf
                            @method('delete')
                            <input type="submit" name="submit" value="Hapus" class="btn btn-danger">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
    {{-- modal import excell --}}
    <div class="modal fade" id="modal-excell">
        <div class="modal-dialog">
            <form action="{{ route('jenis.import') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Tambah Data melalui file excell</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="merek">File Excell</label>
                            <input type="file" class="form-control" name="file">
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" name="submit" class="btn btn-primary">Upload</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
@push('script')
    @if ($errors->any())
        <script>
            $('#modal-tambah').modal('show');
        </script>
    @endif
@endpush
