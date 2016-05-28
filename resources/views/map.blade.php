@extends('app')

@section('content')

    <div id="content" class="container">
        <div class="row">

            <div class="col-xs-12">
                <h2 class="text-center">Toxic Gases Map</h2>

                <hr>

                <div id="map"></div>
            </div>

        </div>
    </div>

@endsection

@push('scripts')
<script>

    var ozoneLevels = {!! json_encode($ozoneLevels) !!};

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

</script>
@endpush
