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
                        <div class="row no-print">
                            <div class="col-12">
                                <a href="{{ route('ranmor.cetakdetail', $ranmor->id_ranmor) }}" target="_blank">
                                    <button type="button" class="btn btn-primary float-right" style="margin-right: 5px;">
                                        <i class="fas fa-download"></i> Cetak PDF
                                    </button>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
