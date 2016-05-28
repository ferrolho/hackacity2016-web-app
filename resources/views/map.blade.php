@extends('app')

@section('content')

    <div id="content" class="container">
        <div class="row">

            <div class="col-xs-12">

                <h2 class="text-center">Toxic Gases Map</h2>

                <hr>

                <div id="map"></div>

                <form class="text-center">
                    <div class="form-group">
                        <div class="col-xs-12">
                            <input id="range-slider" type="text" data-slider-min="0" data-slider-max="{{ $hours }}"
                                   data-slider-value="{{ $hours }}" data-slider-ticks='[0, {{ $hours }}]'
                                   data-slider-ticks-labels='["{{ $firstTimestamp }}", "{{ $lastTimestamp }}"]'>
                        </div>

                        <div class="clearfix"></div>
                    </div>
                </form>

            </div>

        </div>
    </div>

@endsection

@push('scripts')
<script>

    var ozoneLevels = {!! json_encode($ozoneLevels) !!};
    var firstTimestamp = {!! json_encode($firstTimestamp) !!};

    prepareLatAndLng(ozoneLevels);

    var map, sensorCircles = [];

    function initMap() {

        map = new google.maps.Map(document.getElementById('map'), {
            center: {lat: 41.2080688477, lng: -8.39911651611},
            scrollwheel: false,
            zoom: 10
        });

        drawCircles(ozoneLevels);

    }

    function prepareLatAndLng(data) {
        for (var i in data) {
            data[i]['coords']['lat'] = parseFloat(data[i]['coords']['lat']);
            data[i]['coords']['lng'] = parseFloat(data[i]['coords']['lng']);
        }
    }

    function drawCircles(circlesData) {
        for (var sensorData in circlesData) {
            var sensorCircle = new google.maps.Circle({
                strokeColor: '#FF0000',
                strokeOpacity: 0.6,
                strokeWeight: 2,
                fillColor: '#FF0000',
                fillOpacity: 0.2,
                map: map,

                center: circlesData[sensorData].coords,
                radius: Math.sqrt(circlesData[sensorData].o3) * 100
            });

            sensorCircles.push(sensorCircle);
        }
    }

    var rangeSlider = $('#range-slider').slider({
        formatter: function (value) {
            var d = new Date(firstTimestamp);

            d.setHours(d.getHours() + value);

            var sliderVal = d.getFullYear() + '-' + to2digits(d.getMonth() + 1) + '-' + to2digits(d.getDate()) + " " + to2digits(d.getHours()) + ":" + to2digits(d.getMinutes()) + ":" + to2digits(d.getSeconds());

            return sliderVal;
        },
        id: "range-slider",
        step: 1
    });

    function to2digits(number) {
        return ('0' + number).slice(-2);
    }

    $(document).ready(function () {

        $('#range-slider').on('change', function (e) {
            clearPreviousCircles();

            $.ajax({
                url: '/getSensorData/' + rangeSlider.slider('getValue'),
                dataType: 'json'
            }).done(function (data) {
                prepareLatAndLng(data);
                drawCircles(data);
            }).fail(function () {
                alert('Failed to fetch sensors info.');
            });

            e.preventDefault();
        });

        function clearPreviousCircles() {
            for (var i in sensorCircles)
                sensorCircles[i].setMap(null);

            sensorCircles = [];
        }

    });

</script>
@endpush
