@extends('layouts.app')

@section('content')

    @component('layouts.card')

    @slot('header')
        Information
    @endslot
    <div class="">
        <div class="">Phone Number</div>
            <div class="font-weight-bold"> {{ $mayday->phone_number }} </div>
        </div>
        <div class="my-3">
            <div class="">Last Seen</div>
            {{--  Livewire  --}}
            <div class="font-weight-bold"> {{ $mayday->updated_at }} </div>
        </div>
        <div class="my-3">
            <div class="">Current Status</div>
            {{--  Livewire  --}}
            <div class="font-weight-bold"> {{ $mayday->status }} </div>
        </div>
        <div class="my-3">
            <div class="">Last Location</div>
            {{--  Livewire  --}}
            <div class="font-weight-bold"> {{ $mayday->last_latitude }}, {{ $mayday->last_longitude }} </div>
            <div class="font-weight-bold"> {{ $mayday->last_w3w }}</div>
        </div>
        <div class="my-3">
            {{--  Livewire  --}}
            <button class="btn btn-danger">Close Down</button>
        </div>

    @endcomponent

    @if($mayday->last_latitude && $mayday->last_longitude)
        @component('layouts.card')
        
        @slot('header')
        Map
        @endslot
        <div id="map"></div>
        @endcomponent
    @endif

    @if($mayday->last_location)
        @component('layouts.card')
        
        @slot('header')
        Last Location
        @endslot
        <div class="my-3">
            <div class="">GPS</div>
            <div class="font-weight-bold"> {{ $mayday->last_location['latitude'] }}, {{ $mayday->last_location['longitude'] }} </div>
        </div>
        <div class="my-3">
            <div class="">Accuracy (m)</div>
            <div class="font-weight-bold"> {{ round($mayday->last_location['accuracy'],0) }} </div>
        </div>
        <div class="my-3">
            <div class="">Speed (mph)</div>
            <div class="font-weight-bold"> {{ round($mayday->last_location['speed'],0) }} </div>
        </div>
        <div class="my-3">
            <div class="">Heading</div>
            <div class="font-weight-bold"> {{ round($mayday->last_location['heading'],0) }} </div>
        </div>
        @endcomponent
    @endif

    @if($mayday->last_connection)
        @component('layouts.card')
        
        @slot('header')
        Last Connection
        @endslot
        <div class="my-3">
            <div class="">Effective Type</div>
            <div class="font-weight-bold"> {{ $mayday->last_connection['effectiveType'] }} </div>
        </div>
        <div class="my-3">
            <div class="">Downlink Speed (mbits/s)</div>
            <div class="font-weight-bold"> {{ $mayday->last_connection['downlink'] }} </div>
        </div>
        <div class="my-3">
            <div class="">RTT (ms)</div>
            <div class="font-weight-bold"> {{ $mayday->last_connection['rtt'] }} </div>
        </div>
        @endcomponent
    @endif

@endsection

@section('styles')
<link rel="stylesheet" href="https://js.arcgis.com/3.27/esri/css/esri.css"/>
<style>
#map {
    height: 300px;
    margin: 0;
    padding: 0;
    }
</style>
@endsection

@section('scripts')
<script src="https://js.arcgis.com/3.27" ></script>
<script>
var map;

require([
        "esri/map",
        "esri/layers/WebTiledLayer",
        "esri/geometry/Point",
        "esri/graphic",
        "esri/geometry/Circle",
        "esri/symbols/SimpleFillSymbol",
        "dojo/domReady!"
    ], function(Map, WebTiledLayer, Point, Graphic, Circle, SimpleFillSymbol) {
    
    map = new Map("map", {
        center: [-0.01, 51],
        zoom: 15
    });

    var osmLayer = new WebTiledLayer("https://tile.openstreetmap.org/${level}/${col}/${row}.png");
    map.addLayer(osmLayer);

    {{--  Livewire  --}}
    {{--  Alter to update Info from geojson?  --}}
    @if($mayday->last_latitude && $mayday->last_longitude && $mayday->last_location)
    updateMap({{$mayday->last_latitude}},{{$mayday->last_longitude}},{{$mayday->last_location['accuracy']}})
    @endif

    function updateMap(lat,lon, accuracy){
        map.graphics.clear();
        var point = new Point(lon, lat);
        var circleGeometry = new Circle(point,{
            "radius": accuracy
            });
        var sfs = new SimpleFillSymbol()
        var pointGraphic = new Graphic(circleGeometry, sfs)
        map.graphics.add(pointGraphic)
        map.centerAt(point)
        console.log(map)
    }
});
</script>
@endsection