@extends('app')

@section('content')

    <div id="content" class="container">
        <div class="row">

            <div class="col-xs-12">
                <h2 class="text-center">Toxic Gases Line Chart</h2>

                <hr>

                <div id="dataChartContainer">
                    <canvas id="dataChart" width="400" height="400"></canvas>
                </div>
            </div>

        </div>
    </div>

@endsection

@push('scripts')
<script>

    var labels = {!! json_encode($labels) !!};

    var co_data = {!! json_encode($co_data) !!};
    var no2_data = {!! json_encode($no2_data) !!};
    var proc_no2_data = {!! json_encode($proc_no2_data) !!};
    var o3_data = {!! json_encode($o3_data) !!};
    var proc_o3_data = {!! json_encode($proc_o3_data) !!};

    // - - - - - - - - - - - - - - - - - - - - - - - - - - - -

    Chart.defaults.global.responsive = true;
    Chart.defaults.global.maintainAspectRatio = false;

    var ctx = $("#dataChart");

    var dataChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: labels,
            datasets: [
                {
                    label: 'CO',
                    fill: false,
                    lineTension: 0,
                    backgroundColor: '#888',
                    borderColor: '#000',
                    pointBackgroundColor: '#fff',
                    pointHoverBorderWidth: 2,
                    pointRadius: 4,
                    data: co_data
                }, {
                    label: 'NO2',
                    fill: false,
                    lineTension: 0,
                    backgroundColor: '#88f',
                    borderColor: '#00f',
                    pointBackgroundColor: '#fff',
                    pointHoverBorderWidth: 2,
                    pointRadius: 4,
                    data: no2_data
                }, {
                    label: 'NO2 Processado',
                    fill: false,
                    lineTension: 0,
                    backgroundColor: '#44b',
                    borderColor: '#00b',
                    pointBackgroundColor: '#fff',
                    pointHoverBorderWidth: 2,
                    pointRadius: 4,
                    data: proc_no2_data
                }, {
                    label: 'O3 (/100)',
                    fill: false,
                    lineTension: 0,
                    backgroundColor: '#f88',
                    borderColor: '#f00',
                    pointBackgroundColor: '#fff',
                    pointHoverBorderWidth: 2,
                    pointRadius: 4,
                    data: o3_data
                }, {
                    label: 'O3 Processado',
                    fill: false,
                    lineTension: 0,
                    backgroundColor: '#b44',
                    borderColor: '#b00',
                    pointBackgroundColor: '#fff',
                    pointHoverBorderWidth: 2,
                    pointRadius: 4,
                    data: proc_o3_data
                }
            ]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
    });

</script>
@endpush
