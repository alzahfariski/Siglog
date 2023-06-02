@extends('layouts.app')
@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="invoice p-3 mb-3">
                        <div class="row">
                            <div class="col-12">
                                <h4>
                                    <b>{{ $ranmor->jenis->merek }}</b>
                                    <small class="float-right">Tanggal ranmor ditambahkan :
                                        {{ $ranmor->created_at->format('Y-m-d') }}</small>
                                </h4>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Id ranmor</th>
                                            <th>Tahun</th>
                                            <th>Nosin</th>
                                            <th>Noka</th>
                                            <th>Nopol</th>
                                            <th>kondisi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>{{ $ranmor->id_ranmor }}</td>
                                            <td>{{ $ranmor->tahun }}</td>
                                            <td>{{ $ranmor->nosin }}</td>
                                            <td>{{ $ranmor->noka }}</td>
                                            <td>{{ $ranmor->nopol }}</td>
                                            <td>{{ $ranmor->kondisi }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4 invoice-col">
                                Bagian :
                                <address>
                                    <strong>{{ $ranmor->bagian }}</strong>
                                </address>
                            </div>
                            <div class="col-sm-4 invoice-col">
                                Pemakai :
                                <address>
                                    <strong>{{ $ranmor->pemakai }}</strong>
                                </address>
                            </div>
                            <div class="col-sm-4 invoice-col">
                                Jenis :
                                <address>
                                    <strong>{{ $ranmor->jenis->roda }} - {{ $ranmor->jenis->kendaraan }} </strong>
                                </address>
                            </div>
                        </div>
                        @can('admin')
                            <div class="row no-print">
                                <div class="col-12">
                                    <button type="button" class="btn btn-primary float-right" style="margin-right: 5px;"
                                        data-toggle="modal" data-target="#modal-pj">
                                        <i class="fas fa-download"></i> Cetak PDF
                                    </button>
                                </div>
                            </div>
                        @endcan
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="modal fade" id="modal-pj">
        <div class="modal-dialog">
            <form action="{{ route('ranmor.cetakdetail', $ranmor->id_ranmor) }}" method="GET" target="_blank">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Masukan Penaggung Jawab</h4>
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
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
