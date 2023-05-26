@extends('cetak.landscape')
@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="invoice p-3 mb-3">
                        <div class="row">
                            <div class="col-12 table-responsive">
                                <table class="table table-bordered border-dark">
                                    <thead>
                                        <tr>
                                            <th rowspan="2" class="text-center" style="vertical-align: middle;">NO</th>
                                            <th rowspan="2" class="text-center" style="vertical-align: middle;">JENIS
                                                <br> RODA
                                            </th>
                                            <th rowspan="2" class="text-center" style="vertical-align: middle;">JENIS
                                                <br> KENDARAAN
                                            </th>
                                            <th rowspan="2" class="text-center" style="vertical-align: middle;">MEREK
                                            </th>
                                            <th rowspan="2" class="text-center" style="vertical-align: middle;">TH <br>
                                                PEMB</th>
                                            <th rowspan="2" class="text-center" style="vertical-align: middle;">NO <br>
                                                SIN</th>
                                            <th rowspan="2" class="text-center" style="vertical-align: middle;">NO <br>
                                                KA</th>
                                            <th rowspan="2" class="text-center" style="vertical-align: middle;">NO. POL
                                            </th>
                                            <th rowspan="2" class="text-center" style="vertical-align: middle;">BAGIAN
                                            </th>
                                            <th colspan="3" class="text-center" style="vertical-align: middle;">KONDISI
                                            </th>
                                            <th rowspan="2" class="text-center" style="vertical-align: middle;">PEMAKAI
                                            </th>
                                        </tr>
                                        <tr>
                                            <th>BB</th>
                                            <th>RR</th>
                                            <th>RB</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <th>{{ $ranmor->id_ranmor }}</th>
                                        <td>{{ $ranmor->jenis->roda }}</td>
                                        <td>{{ $ranmor->jenis->kendaraan }}</td>
                                        <td>{{ $ranmor->jenis->merek }}</td>
                                        <td>{{ $ranmor->tahun }}</td>
                                        <td>{{ $ranmor->nosin }}</td>
                                        <td>{{ $ranmor->noka }}</td>
                                        <td>{{ $ranmor->nopol }}</td>
                                        <td>{{ $ranmor->bagian }}</td>
                                        @if ($ranmor->kondisi == 'BB')
                                            <td>B</td>
                                        @else
                                            <td>-</td>
                                        @endif
                                        @if ($ranmor->kondisi == 'RR')
                                            <td>RR</td>
                                        @else
                                            <td>-</td>
                                        @endif
                                        @if ($ranmor->kondisi == 'RB')
                                            <td>RB</td>
                                        @else
                                            <td>-</td>
                                        @endif
                                        <td>{{ $ranmor->pemakai }}</td>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
