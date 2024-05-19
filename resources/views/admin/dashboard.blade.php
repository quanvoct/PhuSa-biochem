@extends('admin.layouts.app')
@section('title')
    {{ $pageName }}
@endsection
@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>{{ $pageName }}</h3>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Bảng tin</a>
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

        <div class="row py-3">
            <div class="col-12 col-lg-4 mb-3 d-flex justify-content-between align-item-center">
            </div>
            <div class="col-12 col-lg-8">
                <div class="d-flex justify-content-end align-item-center">
                    <input type="text" id="dateRange" name="dateRange" class="btn btn-outline-primary mt-0 mb-0"
                        style="opacity: 1;">
                </div>
            </div>
        </div>
    <div class="page-content">
        <section class="row">
            <div class="col-12 col-lg-3 col-md-6">
                <div class="card mb-3">
                    <div class="card-body px-3 py-4">
                        <div class="row">
                            <div class="col-3">
                                <div class="stats-icon purple">
                                    <i class="icon-mid  bi-cash-coin"></i>
                                </div>
                            </div>
                            <div class="col-9 text-end">
                                <h6 class="text-muted font-semibold">Doanh Thu</h6>
                                <h6 class="font-extrabold mb-0 revenues">0</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-3 col-md-6">
                <div class="card mb-3">
                    <div class="card-body px-3 py-4">
                        <div class="row">
                            <div class="col-3">
                                <div class="stats-icon purple">
                                    <i class="icon-mid  bi-cash-coin"></i>
                                </div>
                            </div>
                            <div class="col-9 text-end">
                                <h6 class="text-muted font-semibold">Lợi nhuận</h6>
                                <h6 class="font-extrabold mb-0 revenues">0</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-3 col-md-6">
                <div class="card mb-3">
                    <div class="card-body px-3 py-4">
                        <div class="row">
                            <div class="col-3">
                                <div class="stats-icon blue">
                                    <i class="icon-mid  bi-box2-fill"></i>
                                </div>
                            </div>
                            <div class="col-9 text-end">
                                <h6 class="text-muted font-semibold">Đơn hàng</h6>
                                <h6 class="font-extrabold mb-0 totalOrders">0</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-3 col-md-6">
                <div class="card mb-3">
                    <div class="card-body px-3 py-4">
                        <div class="row">
                            <div class="col-3">
                                <div class="stats-icon green">
                                    <i class="icon-mid  bi-person-circle"></i>
                                </div>
                            </div>
                            <div class="col-9 text-end">
                                <h6 class="text-muted font-semibold">Tồn kho</h6>
                                <h6 class="font-extrabold mb-0">80.000</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Doanh thu</h4>
                </div>
                <div class="card-body">
                    <div id="revenue-chart"></div>
                </div>
            </div>
        </div>
        </section>
    </div>
    <script src="{{ asset('admin/vendors/apexcharts/apexcharts.js') }}"></script>

    @push('scripts')
        <script>
            $(document).ready(function() {
                var now = new Date();
                var endDate = moment(now).format('DD/MM/YYYY');
                var startDate = moment(now.getTime() - 7 * 24 * 60 * 60 * 1000).format('DD/MM/YYYY');

                $('input[name="dateRange"]').daterangepicker({
                    "startDate": startDate,
                    "endDate": endDate,
                    opens: 'left',
                    locale: {
                        format: 'DD/MM/YYYY'
                    }
                });

                let revenuesArray = [],
                    timesArray = [];
                let range = $('input[name="dateRange"]').val();
                $.get(`{{ route('admin.dashboard') }}/?range=${range}`, function(data) {
                    $.each(data.dailyrevenues, function(revenue, created_at) {
                        revenuesArray.push(revenue);
                        timesArray.push(moment(created_at).format('DD/MM/YYYY'));
                    })
                    $('.revenues').text(data.revenues);

                    drawChart(timesArray, revenuesArray);
                })

                $(document).on('change', 'input[name="dateRange"]', function() {
                    let revenuesArrayNew = [],
                        timesArrayNew = [];
                    let range = $('input[name="dateRange"]').val();
                    $.get(`{{ route('admin.dashboard') }}/?range=${range}`, function(data) {
                        console.log(data);
                        $.each(data.dailyrevenues, function(revenue, created_at) {
                            revenuesArrayNew.push(revenue);
                            timesArrayNew.push(moment(created_at).format('DD/MM/YYYY'));
                        })
                        $('.revenues').text(data.revenues);
                        $('.totalOrders').text(data.totalOrders);
                        drawChart(timesArrayNew, revenuesArrayNew);
                    })
                })
            });

            function drawChart(times, revenues) {
                $('#revenue-chart').empty();
                var optionsProfileVisit = {
                    annotations: {
                        position: 'back'
                    },
                    dataLabels: {
                        enabled: false
                    },
                    chart: {
                        type: 'bar',
                        height: 300
                    },
                    fill: {
                        opacity: 1
                    },
                    plotOptions: {},
                    series: [{
                        name: 'sales',
                        data: revenues,
                    }],
                    colors: '#435ebe',
                    xaxis: {
                        categories: times,
                    },
                }

                var chartProfileVisit = new ApexCharts(document.querySelector(
                        "#revenue-chart"),
                    optionsProfileVisit);

                chartProfileVisit.render();
            }
        </script>
    @endpush
@endsection
