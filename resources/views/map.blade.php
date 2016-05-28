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

    for (var i in ozoneLevels) {
        ozoneLevels[i]['coords']['lat'] = parseFloat(ozoneLevels[i]['coords']['lat']);
        ozoneLevels[i]['coords']['lng'] = parseFloat(ozoneLevels[i]['coords']['lng']);
    }

    function initMap() {

        var map = new google.maps.Map(document.getElementById('map'), {
            center: {lat: 41.2080688477, lng: -8.39911651611},
            scrollwheel: false,
            zoom: 10
        });

        for (var sensorData in ozoneLevels) {
            var sensorCircle = new google.maps.Circle({
                strokeColor: '#FF0000',
                strokeOpacity: 0.6,
                strokeWeight: 2,
                fillColor: '#FF0000',
                fillOpacity: 0.2,
                map: map,

                center: ozoneLevels[sensorData].coords,
                radius: Math.sqrt(ozoneLevels[sensorData].o3) * 100
            });
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

</script>
@endpush
