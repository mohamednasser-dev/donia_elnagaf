
@extends('admin_temp')
@section('styles')

@endsection
@section('content')
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h3 class="text-themecolor">إحصائيات موظفين الفرع</h3>
        </div>
        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">إحصائيات موظفين الفرع</li>
                <li class="breadcrumb-item active"><a href="{{route('users.charts')}}">إحصائيات الانتاجية</a></li>
                <li class="breadcrumb-item active"><a href="{{url('home')}}">{{trans('admin.nav_home')}}</a></li>
            </ol>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">موظفين المبيعات</h4>
                    <div>
                        <canvas id="chart2" height="150"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">موظفين المخازن</h4>
                    <div>
                        <canvas id="chart3" height="150"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
{{--    <script src="{{ asset('/assets/plugins/Chart.js/chartjs.init.js') }}"></script>--}}
{{--    <script src="{{ asset('/assets/plugins/Chart.js/Chart.min.js') }}"></script>--}}

<script src="{{ asset('/assets/plugins/Chart.js/Chart.min.js') }}"></script>
<script type="text/javascript">
    $( document ).ready(function() {
        // Chart for Super admin
        var ctx2 = document.getElementById("chart2").getContext("2d");
        var data2 = {
            labels: {!! $sales_emp_names !!},
            datasets: [
                {
                    label: "My First dataset",
                    fillColor: "#009efb",
                    strokeColor: "#009efb",
                    highlightFill: "#009efb",
                    highlightStroke: "#009efb",
                    data: {!! $sales_total_payments !!}
                }
            ]
        };
        var chart2 = new Chart(ctx2).Bar(data2, {
            scaleBeginAtZero : true,
            scaleShowGridLines : true,
            scaleGridLineColor : "rgba(0,0,0,.005)",
            scaleGridLineWidth : 0,
            scaleShowHorizontalLines: true,
            scaleShowVerticalLines: true,
            barShowStroke : true,
            barStrokeWidth : 0,
            tooltipCornerRadius: 2,
            barDatasetSpacing : 3,
            legendTemplate : "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<datasets.length; i++){%><li><span style=\"background-color:<%=datasets[i].fillColor%>\"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>",
            responsive: true
        });
    });

    $( document ).ready(function() {
        // Chart for Super admin
        var ctx2 = document.getElementById("chart3").getContext("2d");
        var data2 = {
            labels: {!! $stores_emp_names !!},
            datasets: [
                {
                    label: "My First dataset",
                    fillColor: "#55ce63",
                    strokeColor: "#55ce63",
                    highlightFill: "#55ce63",
                    highlightStroke: "#55ce63",
                    data: {!! $stores_total_payments !!}
                }
            ]
        };
        var chart3 = new Chart(ctx2).Bar(data2, {
            scaleBeginAtZero : true,
            scaleShowGridLines : true,
            scaleGridLineColor : "rgba(0,0,0,.005)",
            scaleGridLineWidth : 0,
            scaleShowHorizontalLines: true,
            scaleShowVerticalLines: true,
            barShowStroke : true,
            barStrokeWidth : 0,
            tooltipCornerRadius: 2,
            barDatasetSpacing : 3,
            legendTemplate : "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<datasets.length; i++){%><li><span style=\"background-color:<%=datasets[i].fillColor%>\"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>",
            responsive: true
        });
    });
</script>
@endsection
