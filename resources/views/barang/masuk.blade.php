@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-12 mb-2">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-tambah">
                <i class="fas fa-plus"></i> Tambah barang diterima</button>

            {{-- <a href="{{ route('masuk.cetak') }}" target="_blank" type="button" class="btn btn-secondary">
                <i class="fas fa-print"></i> Print Barang diterima</a> --}}

            <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#modal-print">
                <i class="fas fa-print"></i> Print Barang Diterima </button>
        </div>
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Tabel data barang diterima</h3>
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
                                <th>Jumlah Masuk</th>
                                <th>Pemasok</th>
                                <th>Tanggal</th>
                                <th style="width: 40px">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $nomor = 1 + ($masuk->currentPage() - 1) * $masuk->perPage();
                            @endphp
                            @foreach ($masuk as $m)
                                <tr>
                                    <td>{{ $nomor++ }}</td>
                                    <td>{{ $m->barang->nama_barang }}</td>
                                    <td>{{ $m->jumlah_masuk }}</td>
                                    <td>{{ $m->pemasok }}</td>
                                    <td>{{ $m->created_at->format('Y-m-d') }}</td>
                                    <td class="project-actions text-right">
                                        <a class="btn btn-primary btn-sm" href="{{ route('masuk.view', $m->id_masuk) }}">
                                            <i class="fas fa-folder">
                                            </i>
                                            Detail
                                        </a>
                                        <a class="btn btn-info btn-sm" data-toggle="modal"
                                            data-target="#modal-edit-{{ $m->id_masuk }}">
                                            <i class="fas fa-pencil-alt">
                                            </i>
                                            Edit
                                        </a>
                                        <a class="btn btn-danger btn-sm" data-toggle="modal"
                                            data-target="#modal-delete-{{ $m->id_masuk }}">
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
                    {!! $masuk->appends(Request::except('page'))->render() !!}
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
                        <h4 class="modal-title">Tambah Barang Diterima</h4>
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
                            <label for="pemasok">Pemasok</label>
                            <input type="text" placeholder="masukan pemasok" class="form-control" name="pemasok"
                                required>
                        </div>
                        <div class="form-group">
                            <label for="jumlah_masuk">Jumlah Barang</label>
                            <input type="number" placeholder="masukan jumlah masuk" class="form-control"
                                name="jumlah_masuk" required>
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
    @foreach ($masuk as $m)
        <div class="modal fade" id="modal-edit-{{ $m->id_masuk }}">
            <div class="modal-dialog">
                <form action="{{ route('masuk.update', $m->id_masuk) }}" method="POST">
                    @csrf
                    @method('put')
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Edit Barang Diterima</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="id_barang">Nama Barang</label>
                                <select class="form-control select2" style="width: 100%;" name="id_barang">
                                    @foreach ($barang as $b)
                                        <option value="{{ $b->id_barang }}"
                                            @if ($m->barang->id_barang == $b->id_barang) selected @endif>
                                            {{ $b->nama_barang }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="pemasok">Pemasok Barang</label>
                                <input type="text" value="{{ $m->pemasok }}" class="form-control" name="pemasok">
                            </div>
                            <div class="form-group">
                                <label for="jumlah_barang">Jumlah Barang</label>
                                <input type="number" value="{{ $m->jumlah_masuk }}" class="form-control"
                                    name="jumlah_masuk">
                            </div>
                        </div>
                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    @endforeach
    {{-- modal delete --}}
    @foreach ($masuk as $m)
        <div class="modal fade" id="modal-delete-{{ $m->id_masuk }}">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-danger">
                        <h4 class="modal-title">Hapus Barang Diterima</h4>

                    </div>
                    <div class="modal-body">
                        <p>Anda yakin ingin menghapus?</p>
                        <hr>
                        <h4>Keterangan Hapus :</h4>
                        <p>Menghapus data Barang Diterima merubah data stok Barang</p>
                        <hr>
                        <p>Gunakan aksi edit jika hanya ingin merubah data Barang Diterima</p>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <div>
                            <form action="{{ route('masuk.destroy', $m->id_masuk) }}" method="POST">
                                @csrf
                                @method('delete')
                                <input type="text" hidden value="{{ $m->id_barang }}" name="id_barang">
                                <input type="submit" name="submit" value="Hapus" class="btn btn-danger">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
    {{-- Print Modal --}}
    <div class="modal fade" id="modal-print">
        <div class="modal-dialog">
            <form action="{{ route('masuk.cetak') }}" method="GET" target="_blank">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Print Data Barang Diterima</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="pemasok">Pemasok</label>
                            <select name="pemasok" id="pemasok" class="form-control">
                                <option value="">Semua Data</option>
                                @foreach ($nama_pemasok as $index => $pemasok)
                                    <option value="{{ $index }}">{{ $index }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="id_barang">Nama Barang</label>
                            <select name="id_barang" id="id_barang" class="form-control">
                                <option value="">Semua Data</option>
                                @foreach ($nama_barang as $index => $barang)
                                    <option value="{{ $index }}">{{ $index }}</option>
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
    @if ($massege = Session::get('failed'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Gagal !',
                text: 'Jumlah Akan menjadi minus silahkan periksa penyerahan barang !',
            })
        </script>
    @endif
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
@endpush
