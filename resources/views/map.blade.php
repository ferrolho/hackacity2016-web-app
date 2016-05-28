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

    var citySensors = {
        sensor1: {
            center: {lat: 41.2399291992, lng: -8.22875976562},
            radius: 20
        },
        sensor2: {
            center: {lat: 41.3003540039, lng: -8.32763671875},
            radius: 20
        },
        sensor3: {
            center: {lat: 40.690612793, lng: -8.4375},
            radius: 20
        },
        sensor4: {
            center: {lat: 41.2591552734, lng: -8.38806152344},
            radius: 20
        },
        sensor5: {
            center: {lat: 41.2948608398, lng: -8.42651367188},
            radius: 20
        },
        sensor6: {
            center: {lat: 41.217956543, lng: -8.38256835938},
            radius: 20
        },
        sensor7: {
            center: {lat: 41.2289428711, lng: -8.44848632812},
            radius: 20
        },
        sensor8: {
            center: {lat: 41.2069702148, lng: -8.33862304688},
            radius: 20
        },
        sensor9: {
            center: {lat: 41.1520385742, lng: -8.42651367188},
            radius: 20
        },
        sensor10: {
            center: {lat: 41.2344360352, lng: -8.38806152344},
            radius: 20
        },
        sensor11: {
            center: {lat: 41.2014770508, lng: -8.46771240234},
            radius: 20
        },
        sensor12: {
            center: {lat: 41.305847168, lng: -8.36059570312},
            radius: 20
        },
        sensor13: {
            center: {lat: 41.2646484375, lng: -8.4635925293},
            radius: 20
        },
        sensor14: {
            center: {lat: 41.1245727539, lng: -8.47045898438},
            radius: 20
        },
        sensor15: {
            center: {lat: 41.2289428711, lng: -8.45947265625},
            radius: 20
        },
        sensor16: {
            center: {lat: 41.2344360352, lng: -8.38256835938},
            radius: 20
        },
        sensor17: {
            center: {lat: 41.2783813477, lng: -8.58032226562},
            radius: 20
        },
        sensor18: {
            center: {lat: 41.2014770508, lng: -8.28369140625},
            radius: 20
        },
        sensor19: {
            center: {lat: 41.2564086914, lng: -8.3056640625},
            radius: 20
        },
        sensor20: {
            center: {lat: 41.2399291992, lng: -8.41552734375},
            radius: 20
        }
    }

    function initMap() {

        var map = new google.maps.Map(document.getElementById('map'), {
            center: {lat: 41.2080688477, lng: -8.39911651611},
            scrollwheel: false,
            zoom: 10
        });

        for (var sensor in citySensors) {
            var sensorCircle = new google.maps.Circle({
                strokeColor: '#FF0000',
                strokeOpacity: 0.8,
                strokeWeight: 2,
                fillColor: '#FF0000',
                fillOpacity: 0.35,
                map: map,
                center: citySensors[sensor].center,
                radius: Math.sqrt(citySensors[sensor].radius) * 1020
            });
        }

    }

</script>
@endpush
