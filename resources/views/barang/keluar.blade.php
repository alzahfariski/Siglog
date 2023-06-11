@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-12 mb-2">
            <button type="button" class="btn btn-primary" id="tambah-btn" data-toggle="modal" data-target="#modal-tambah">
                <i class="fas fa-plus"></i> Serahkan barang</button>
            {{-- <a href="{{ route('keluar.cetak') }}" target="_blank" type="button" class="btn btn-secondary">
                <i class="fas fa-print"></i> Print Penyerahan Barang </a> --}}

            <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#modal-print">
                <i class="fas fa-print"></i> Print Penyerahan Barang </button>
        </div>
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Tabel data penyerahan barang</h3>
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
                                <th>Nama Barang</th>
                                <th>Jumlah Keluar</th>
                                <th>Penerima</th>
                                <th>Tanggal</th>
                                <th style="width: 40px">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $nomor = 1 + ($keluar->currentPage() - 1) * $keluar->perPage();
                            @endphp
                            @foreach ($keluar as $k)
                                <tr>
                                    <td>{{ $nomor++ }}</td>
                                    <td>{{ $k->barang->nama_barang }}</td>
                                    <td>{{ $k->jumlah_keluar }}</td>
                                    <td>{{ $k->user->nama }}</td>
                                    <td>{{ $k->created_at }}</td>
                                    <td class="project-actions text-right">
                                        <a class="btn btn-primary btn-sm" href="{{ route('keluar.view', $k->id_keluar) }}">
                                            <i class="fas fa-folder">
                                            </i>
                                            Detail
                                        </a>
                                        <a class="btn btn-info btn-sm" data-toggle="modal"
                                            data-target="#modal-edit-{{ $k->id_keluar }}">
                                            <i class="fas fa-pencil-alt">
                                            </i>
                                            Edit
                                        </a>
                                        <a class="btn btn-danger btn-sm" data-toggle="modal"
                                            data-target="#modal-delete-{{ $k->id_keluar }}">
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
                    {!! $keluar->appends(Request::except('page'))->render() !!}
                </div>
            </div>
        </div>
    </div>
    {{-- MODAL ADD --}}
    <div class="modal fade" id="modal-tambah">
        <div class="modal-dialog">
            <form action="{{ route('keluar.store') }}" method="POST">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title"> Serahkan barang</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="id_barang">Nama Barang</label>
                            <select class="form-control select2" style="width: 100%;" name="id_barang" id="id_barang"
                                required>
                                <option selected disabled value="">Pilih Barang</option>
                                @foreach ($barang as $b)
                                    <option value="{{ $b->id_barang }}" data-jumlah="{{ $b->jumlah }}">
                                        {{ $b->nama_barang }}
                                @endforeach
                            </select>
                        </div>
                        <div class="input-group mb-3">
                            <span class="form-control">Jumlah Stok</span>
                            <span type="text" name="jumlah" class="form-control" readonly></span>
                        </div>
                        <div class="form-group">
                            <label for="id_user">kirim ke</label>
                            <select class="form-control select2" style="width: 100%;" name="id_user">
                                @foreach ($user as $u)
                                    <option value="{{ $u->id_user }}">
                                        {{ $u->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="nama_barang">Jumlah Barang</label>
                            <input type="number" placeholder="masukan jumlah barang" class="form-control"
                                name="jumlah_keluar" required>
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
    @foreach ($keluar as $k)
        <div class="modal fade" id="modal-edit-{{ $k->id_keluar }}">
            <div class="modal-dialog">
                <form action="{{ route('keluar.update', $k->id_keluar) }}" method="POST">
                    @csrf
                    @method('put')
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title"> Edit penyerahan barang</h4>
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
                                            @if ($k->barang->id_barang == $b->id_barang) selected @endif>
                                            {{ $b->nama_barang }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="id_user">kirim ke</label>
                                <select class="form-control select2" style="width: 100%;" name="id_user">
                                    @foreach ($user as $u)
                                        <option value="{{ $u->id_user }}"
                                            @if ($k->user->id_user == $u->id_user) selected @endif>
                                            {{ $u->nama }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="nama_barang">Jumlah Barang</label>
                                <input type="number" value="{{ $k->jumlah_keluar }}" class="form-control"
                                    name="jumlah_keluar">
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
    @foreach ($keluar as $k)
        <div class="modal fade" id="modal-delete-{{ $k->id_keluar }}">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-danger">
                        <h4 class="modal-title">Hapus Penyerahan Barang</h4>

                    </div>
                    <div class="modal-body">
                        <p>Anda yakin ingin menghapus?</p>
                        <hr>
                        <h4>Keterangan Hapus :</h4>
                        <p>Menghapus data Penyerahan Barang merubah data stok Barang</p>
                        <hr>
                        <p>Gunakan aksi edit jika hanya ingin merubah data Penyerahan Barang</p>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <div>
                            <form action="{{ route('keluar.destroy', $k->id_keluar) }}" method="POST">
                                @csrf
                                @method('delete')
                                <input type="text" hidden name="id_barang" value="{{ $k->id_barang }}">
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
            <form action="{{ route('keluar.cetak') }}" method="GET" target="_blank">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Print Data Penyerahan Barang</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="id_user">Penerima</label>
                            <select name="id_user" id="id_user" class="form-control">
                                <option value="">Semua Data</option>
                                @foreach ($nama_penerima as $index => $penerima)
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
                text: 'Jumlah Melebihi Batas Stok !',
            })
        </script>
    @endif
    <script>
        $('#id_barang').on('change', function() {
            // ambil data dari elemen option yang dipilih
            const jumlah = $('#id_barang option:selected').data('jumlah');
            $('[name=jumlah]').text(jumlah);
        });
    </script>
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
