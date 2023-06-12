@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-12 mb-2">
            @can('admin')
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-tambah">
                    <i class="fas fa-plus"></i> Tambah Barang</button>

                {{-- <a href="{{ route('barang.cetak') }}" target="_blank" type="button" class="btn btn-secondary">
                    <i class="fas fa-print"></i> Print data Barang
                </a> --}}

                <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#modal-print">
                    <i class="fas fa-print"></i> Print data Barang </button>

                <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#modal-excell">
                    <i class="fas fa-file-excel"></i> upload data excel </button>
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
                                    <td><span class="tag">{{ $b->lokasi->nama_gudang }}</span></td>
                                    <td class="project-actions text-right">
                                        <a class="btn btn-primary btn-sm" href="{{ route('barang.view', $b->id_barang) }}">
                                            <i class="fas fa-folder">
                                            </i>
                                            Detail
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
                            <input type="text" placeholder="masukan nama barang"
                                class="form-control @error('nama_barang') is-invalid @enderror" name="nama_barang" required>
                        </div>
                        <div class="form-group">
                            <label for="id_jenis">Nama Jenis</label>
                            <select class="form-control select2" style="width: 100%;" name="id_jenis">
                                @foreach ($jenis as $j)
                                    <option value="{{ $j->id_jenis }}">{{ $j->nama_jenis }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="id_lokasi">Penyimpanan</label>
                            <select class="form-control select2" style="width: 100%;" name="id_lokasi">
                                @foreach ($lokasi as $g)
                                    <option value="{{ $g->id_lokasi }}">{{ $g->nama_gudang }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="jumlah">Jumlah Barang</label>
                            <input type="number" placeholder="masukan nama barang" class="form-control" name="jumlah"
                                required>
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
                                <select class="form-control select2" style="width: 100%;" name="id_lokasi">
                                    @foreach ($lokasi as $g)
                                        <option value="{{ $g->id_lokasi }}"
                                            @if ($g->id_lokasi == $b->lokasi->id_lokasi) selected @endif>
                                            {{ $g->nama_gudang }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="jumlah">Jumlah Barang</label>
                                <input type="number" value="{{ $b->jumlah }}" class="form-control" name="jumlah">
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
                        <p>Menghapus Barang akan juga menghapus <br> Pengelolaan data Barang diterima dan Penyerahan Barang
                        </p>
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
    {{-- modal import excell --}}
    <div class="modal fade" id="modal-excell">
        <div class="modal-dialog">
            <form action="{{ route('barang.import') }}" method="POST" enctype="multipart/form-data">
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

    {{-- Print Modal --}}
    <div class="modal fade" id="modal-print">
        <div class="modal-dialog">
            <form action="{{ route('barang.cetak') }}" method="GET">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Print Data Barang</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="id_lokasi">Nama Gudang</label>
                            <select name="id_lokasi" id="id_lokasi" class="form-control">
                                <option value="">Semua Data</option>
                                @foreach ($nama_gudang as $index => $gudang)
                                    <option value="{{ $index }}">{{ $gudang }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="bulan">Bulan</label>
                            <select name="bulan" id="bulan" class="form-control">
                                @foreach ($bulan as $index => $bln)
                                    <option value="{{ $index }}">{{ $bln }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="tahun">Tahun</label>
                            <select name="tahun" id="tahun" class="form-control">
                                <option value="">Semua Tahun</option>
                                @foreach ($years as $year)
                                    <option value="{{ $year }}">{{ $year }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="id_jenis">Nama Jenis</label>
                            <select name="id_jenis" id="id_jenis" class="form-control">
                                <option value="">Semua Data</option>
                                @foreach ($nama_jenis as $index => $jns)
                                    <option value="{{ $index }}">{{ $jns }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Print</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
@push('script')
    @if ($massege = Session::get('nope'))
        <script>
            const message = @json(session('nope'));

            Swal.fire({
                icon: 'error',
                title: 'Gagal !',
                text: message,
            })
        </script>
    @endif
    @push('script')
        @if ($errors->any())
            <script>
                $('#modal-tambah').modal('show');
            </script>
        @endif
    @endpush
@endpush
