@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-3 col-6">
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>{{ $jumlah_barang }}</h3>
                    <p>Stok Barang</p>
                </div>
                <div class="icon">
                    <i class="ion ion-clipboard"></i>
                </div>
                <a href="{{ route('barang.barang') }}" class="small-box-footer">More info <i
                        class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>

        <div class="col-lg-3 col-6">
            <div class="small-box bg-secondary">
                <div class="inner">
                    <h3>{{ $jumlah_masuk }}</h3>
                    <p>Barang Masuk</p>
                </div>
                <div class="icon">
                    <i class="ion ion-archive"></i>
                </div>
                <a href="{{ route('barang.masuk') }}" class="small-box-footer">More info <i
                        class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>

        <div class="col-lg-3 col-6">
            <div class="small-box bg-warning">
                <div class="inner">
                    <h3>{{ $jumlah_keluar }}</h3>
                    <p>Barang Keluar</p>
                </div>
                <div class="icon">
                    <i class="ion ion-stats-bars"></i>
                </div>
                <a href="{{ route('barang.keluar') }}" class="small-box-footer">More info <i
                        class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>

        <div class="col-lg-3 col-6">
            <div class="small-box bg-success">
                <div class="inner">
                    <h3>{{ $jumlah_ranmor }}</h3>
                    <p>Ranmor</p>
                </div>
                <div class="icon">
                    <i class="fas fa-car"></i>
                </div>
                <a href="{{ route('gudang.index') }}" class="small-box-footer">More info <i
                        class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
    </div>

    <div class="card card-success">
        <div class="card-header">
            <h3 class="card-title">Diagram Barang Masuk & Barang Keluar</h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                </button>
                <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        </div>
        <div class="card-body">
            <div class="chart">
                <canvas id="barChart"
                    style="min-height: 250px; height: 300px; max-height: 300px; max-width: 100%;"></canvas>
            </div>
        </div>
    </div>
@endsection
@push('script')
    <script>
        $(function() {

            const masukBar = [];
            @foreach ($jumlah_masuk_bar as $item)
                masukBar.push({{ $item }});
            @endforeach
            const keluarBar = [];
            @foreach ($jumlah_keluar_bar as $item)
                keluarBar.push({{ $item }});
            @endforeach

            var areaChartData = {
                labels: ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'JUni', 'Juli', 'Agustus', 'September',
                    'Oktober', 'November', 'Desember'
                ],
                datasets: [{
                        label: 'Barang Keluar',
                        backgroundColor: 'rgba(60,141,188,0.9)',
                        borderColor: 'rgba(60,141,188,0.8)',
                        pointRadius: false,
                        pointColor: '#3b8bba',
                        pointStrokeColor: 'rgba(60,141,188,1)',
                        pointHighlightFill: '#fff',
                        pointHighlightStroke: 'rgba(60,141,188,1)',
                        data: keluarBar
                    },
                    {
                        label: 'Barang Masuk',
                        backgroundColor: 'rgba(210, 214, 222, 1)',
                        borderColor: 'rgba(210, 214, 222, 1)',
                        pointRadius: false,
                        pointColor: 'rgba(210, 214, 222, 1)',
                        pointStrokeColor: '#c1c7d1',
                        pointHighlightFill: '#fff',
                        pointHighlightStroke: 'rgba(220,220,220,1)',
                        data: masukBar
                    },
                ]
            }

            //-------------
            //- BAR CHART -
            //-------------
            var barChartCanvas = $('#barChart').get(0).getContext('2d')
            var barChartData = $.extend(true, {}, areaChartData)
            var temp0 = areaChartData.datasets[0]
            var temp1 = areaChartData.datasets[1]
            barChartData.datasets[0] = temp1
            barChartData.datasets[1] = temp0

            var barChartOptions = {
                responsive: true,
                maintainAspectRatio: false,
                datasetFill: false
            }

            new Chart(barChartCanvas, {
                type: 'bar',
                data: barChartData,
                options: barChartOptions
            })
        })
    </script>
@endpush
