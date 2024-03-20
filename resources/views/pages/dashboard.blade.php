@extends('layout')

@section('title', 'Dashboard')

@section('content')
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between gap-3">
                        <div
                            class="wh-48 d-flex bg-success text-success bg-opacity-10 align-items-center justify-content-center rounded-circle">
                            <span class="material-icons-outlined">check_circle</span>
                        </div>
                        <div class="text-end">
                            <h4 class="mb-0">{{ number_format($pesananSelesai) }}</h4>
                            <p class="mb-0">Pesanan Selesai</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between gap-3">
                        <div
                            class="wh-48 d-flex bg-primary text-primary bg-opacity-10 align-items-center justify-content-center rounded-circle">
                            <span class="material-icons-outlined">inventory_2</span>
                        </div>
                        <div class="text-end">
                            <h4 class="mb-0">{{ number_format($barang) }}</h4>
                            <p class="mb-0">Data Barang</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between gap-3">
                        <div
                            class="wh-48 d-flex bg-info text-info bg-opacity-10 align-items-center justify-content-center rounded-circle">
                            <span class="material-icons-outlined">group</span>
                        </div>
                        <div class="text-end">
                            <h4 class="mb-0">{{ number_format($konsumen) }}</h4>
                            <p class="mb-0">Konsumen</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between gap-3">
                        <div
                            class="wh-48 d-flex bg-danger text-danger bg-opacity-10 align-items-center justify-content-center rounded-circle">
                            <span class="material-icons-outlined">pending_actions</span>
                        </div>
                        <div class="text-end">
                            <h4 class="mb-0">{{ number_format($pesananPending) }}</h4>
                            <p class="mb-0">Pesanan Pending</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between gap-3">
                        <div
                            class="wh-48 d-flex bg-warning text-warning bg-opacity-10 align-items-center justify-content-center rounded-circle">
                            <span class="material-icons-outlined">favorite_border</span>
                        </div>
                        <div class="text-end">
                            <h4 class="mb-0">{{ number_format($belumLunas) }}</h4>
                            <p class="mb-0">Belum Lunas</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between gap-3">
                        <div
                            class="wh-48 d-flex bg-success text-success bg-opacity-10 align-items-center justify-content-center rounded-circle">
                            <span class="material-icons-outlined">favorite_border</span>
                        </div>
                        <div class="text-end">
                            <h4 class="mb-0">{{ number_format($lunas) }}</h4>
                            <p class="mb-0">Lunas</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-9">
            <div class="card">
                <div class="card-body">
                    <div class="">
                        <h5 class="mb-0 fw-bold">Grafik Pemasukan</h5>
                    </div>
                    <div id="chart4"></div>

                </div>
            </div>
        </div>
    </div>
@endsection


@push('scripts')
    <script src="{{ asset('assets/plugins/apexchart/apexcharts.min.js') }}"></script>

    <script>
        var options = {
            series: [{
                name: "Pemasukan",
                data: [
                    @for ($i = 0; $i < 12; $i++)
                        {{ $grafik[$i] }},
                    @endfor
                ]
            }, ],
            chart: {
                foreColor: "#9ba7b2",
                height: 250,
                type: 'bar',
                toolbar: {
                    show: !1,
                },
                sparkline: {
                    enabled: !1
                },
                zoom: {
                    enabled: false
                }
            },
            dataLabels: {
                enabled: false
            },
            stroke: {
                width: 4,
                curve: 'smooth',
                colors: ['transparent']
            },
            fill: {
                type: 'gradient',
                gradient: {
                    shade: 'dark',
                    gradientToColors: ['#0d6efd', 'rgba(13, 109, 253, 0.35);'],
                    shadeIntensity: 1,
                    type: 'vertical',
                    //opacityFrom: 0.8,
                    //opacityTo: 0.1,
                    stops: [0, 100, 100, 100]
                },
            },
            colors: ['#0d6efd', "rgba(13, 109, 253, 0.35);"],
            plotOptions: {
                // bar: {
                //   horizontal: !1,
                //   columnWidth: "55%",
                //   endingShape: "rounded"
                // }
                bar: {
                    horizontal: false,
                    borderRadius: 4,
                    borderRadiusApplication: 'around',
                    borderRadiusWhenStacked: 'last',
                    columnWidth: '55%',
                }
            },
            grid: {
                show: false,
                borderColor: 'rgba(0, 0, 0, 0.15)',
                strokeDashArray: 4,
            },
            tooltip: {
                theme: "dark",
                fixed: {
                    enabled: !0
                },
                x: {
                    show: !0
                },
                y: {
                    title: {
                        formatter: function(e) {
                            return ""
                        }
                    }
                },
                marker: {
                    show: !1
                }
            },
            xaxis: {
                categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
            }
        };


        var chart = new ApexCharts(document.querySelector("#chart4"), options);
        chart.render();
    </script>
@endpush
