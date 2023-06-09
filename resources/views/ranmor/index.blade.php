@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-12 mb-2">
            @can('admin')
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-tambah">
                    <i class="fas fa-plus"></i> Tambah Ranmor</button>

                <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#modal-pj">
                    <i class="fas fa-print"> </i> Print Data Ranmor </button>
                <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#modal-excell">
                    <i class="fas fa-file-excel"></i> upload data excel </button>
            @endcan
        </div>
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Tabel data Ranmor</h3>
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
                                <th>Tahun</th>
                                <th>Nomer Mesin</th>
                                <th>Nomer Rangka</th>
                                <th>Nomor Polisi</th>
                                <th>Bagian</th>
                                <th>Kondisi</th>
                                <th style="width: 40px">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $nomor = 1 + ($ranmor->currentPage() - 1) * $ranmor->perPage();
                            @endphp
                            @foreach ($ranmor as $r)
                                <tr>
                                    <td>{{ $nomor++ }}</td>
                                    <td>{{ $r->tahun }}</td>
                                    <td>{{ $r->nosin }}</td>
                                    <td>{{ $r->noka }}</td>
                                    <td>{{ $r->nopol }}</td>
                                    <td>{{ $r->bagian }}</td>
                                    <td>{{ $r->kondisi }}</td>
                                    <td class="project-actions text-right">
                                        <a class="btn btn-primary btn-sm" href="{{ route('ranmor.view', $r->id_ranmor) }}">
                                            <i class="fas fa-folder">
                                            </i>
                                            Detail
                                        </a>
                                        @can('admin')
                                            <a class="btn btn-info btn-sm" data-toggle="modal"
                                                data-target="#modal-edit-{{ $r->id_ranmor }}">
                                                <i class="fas fa-pencil-alt">
                                                </i>
                                                Edit
                                            </a>
                                            <a class="btn btn-danger btn-sm" data-toggle="modal"
                                                data-target="#modal-delete-{{ $r->id_ranmor }}">
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
                    {!! $ranmor->appends(Request::except('page'))->render() !!}
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal-tambah">
        <div class="modal-dialog">
            <form action="{{ route('ranmor.store') }}" method="POST">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Tambah Ranmor</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="id_jenisranmor">Nama Jenis</label>
                            <select class="form-control select2" style="width: 100%;" name="id_jenisranmor">
                                @foreach ($jenis as $j)
                                    <option value="{{ $j->id_jenisranmor }}">{{ $j->merek }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="tahun">Tahun</label>
                            <input type="text" placeholder="masukan tahun" class="form-control" name="tahun" required>
                        </div>
                        <div class="form-group">
                            <label for="nosin">Nomor mesin</label>
                            <input type="text" placeholder="masukan nosin" class="form-control" name="nosin">
                        </div>
                        <div class="form-group">
                            <label for="noka">Nomor rangka</label>
                            <input type="text" placeholder="masukan Noka" class="form-control" name="noka">
                        </div>
                        <div class="form-group">
                            <label for="nopol">Nomor polisi</label>
                            <input type="text" placeholder="masukan Nopol" class="form-control" name="nopol">
                        </div>
                        <div class="form-group">
                            <label for="bagian">Bagian</label>
                            <input type="text" placeholder="masukan bagian" class="form-control" name="bagian" required>
                        </div>
                        <div class="form-group">
                            <label for="kondisi">kondisi</label>
                            <select class="form-control select2" style="width: 100%;" name="kondisi">
                                <option value="B">B</option>
                                <option value="RR">RR</option>
                                <option value="RB">RB</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="pemakai">Pemakai</label>
                            <input type="text" placeholder="masukan pemakai" class="form-control" name="pemakai">
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
    @foreach ($ranmor as $r)
        <div class="modal fade" id="modal-edit-{{ $r->id_ranmor }}">
            <div class="modal-dialog">
                <form action="{{ route('ranmor.update', $r->id_ranmor) }}" method="POST">
                    @method('put')
                    @csrf
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Edit Ranmor</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <input type="text" hidden value="{{ $r->id_ranmor }}">
                            <div class="form-group">
                                <label for="id_jenisranmor">Nama Jenis</label>
                                <select class="form-control select2" style="width: 100%;" name="id_jenisranmor">
                                    @foreach ($jenis as $j)
                                        <option value="{{ $j->id_jenisranmor }}"
                                            @if ($j->id_jenisranmor == $r->jenis->id_jenisranmor) selected @endif>
                                            {{ $j->merek }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="nosin">Nomer mesin</label>
                                <input type="text" value="{{ $r->nosin }}" class="form-control" name="nosin">
                            </div>
                            <div class="form-group">
                                <label for="noka">Nomer rangka</label>
                                <input type="text" value="{{ $r->noka }}" class="form-control" name="noka">
                            </div>
                            <div class="form-group">
                                <label for="nopol">Nomer polisi</label>
                                <input type="text" value="{{ $r->nopol }}" class="form-control" name="nopol">
                            </div>
                            <div class="form-group">
                                <label for="bagian">Bagian</label>
                                <input type="text" value="{{ $r->bagian }}" class="form-control" name="bagian">
                            </div>
                            <div class="form-group">
                                <label for="kondisi">kondisi</label>
                                <select class="form-control select2" style="width: 100%;" name="kondisi">
                                    <option {{ old('kondisi', $r->kondisi) == 'B' ? 'selected' : '' }}>B</option>
                                    <option {{ old('kondisi', $r->kondisi) == 'RR' ? 'selected' : '' }}>RR</option>
                                    <option {{ old('kondisi', $r->kondisi) == 'RB' ? 'selected' : '' }}>RB</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="pemakai">Pemakai</label>
                                <input type="text" value="{{ $r->pemakai }}" class="form-control" name="pemakai">
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
    @foreach ($ranmor as $r)
        <div class="modal fade" id="modal-delete-{{ $r->id_ranmor }}">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-danger">
                        <h4 class="modal-title">Hapus Jenis</h4>

                    </div>
                    <div class="modal-body">
                        <p>Anda yakin ingin menghapus?</p>
                        <hr>
                        <p>Gunakan aksi edit jika hanya ingin merubah data Ranmor</p>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <form action="{{ route('ranmor.destroy', $r->id_ranmor) }}" method="POST">
                            @csrf
                            @method('delete')
                            <input type="submit" name="submit" value="Hapus" class="btn btn-danger">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
    <div class="modal fade" id="modal-pj">
        <div class="modal-dialog">
            <form action="{{ route('ranmor.cetak') }}" method="GET" target="_blank">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Print data Ranmor</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="nama">Nama Penanggung Jawab 1</label>
                            <select class="form-control select2" style="width: 100%;" name="pj_1">
                                @foreach ($user as $u)
                                    <option value="{{ $u->id_user }}">{{ $u->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="nama">Nama Penanggung Jawab 2</label>
                            <select class="form-control select2" style="width: 100%;" name="pj_2">
                                @foreach ($user as $u)
                                    <option value="{{ $u->id_user }}">{{ $u->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="id_jenisranmor">Jenis Roda</label>
                            <select class="form-control select2" style="width: 100%;" name="id_jenisranmor">
                                <option value="">Semua Data</option>
                                @foreach ($nama_roda as $index => $roda)
                                    <option value="{{ $index }}">{{ $index }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="id_ranmor">Tahun Kendaraan</label>
                            <select class="form-control select2" style="width: 100%;" name="id_ranmor">
                                <option value="">Semua Data</option>
                                @foreach ($tahun_kendaraan as $tahun)
                                    <option value="{{ $tahun }}">{{ $tahun }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="bagian">Bagian</label>
                            <select class="form-control select2" style="width: 100%;" name="bagian">
                                <option value="">Semua Data</option>
                                @foreach ($bagian_kendaraan as $index => $bagian)
                                    <option value="{{ $index }}">{{ $index }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="kondisi">kondisi</label>
                            <select class="form-control select2" style="width: 100%;" name="kondisi">
                                <option value="">Semua Data</option>
                                @foreach ($kondisi_kendaraan as $index => $kondisi)
                                    <option value="{{ $index }}">{{ $index }}</option>
                                @endforeach
                            </select>
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
    {{-- modal import excell --}}
    <div class="modal fade" id="modal-excell">
        <div class="modal-dialog">
            <form action="{{ route('ranmor.import') }}" method="POST" enctype="multipart/form-data">
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
