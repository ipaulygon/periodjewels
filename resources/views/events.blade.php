@extends('layouts.app')

@section('title')
    {{"Events"}}
@stop

@section('content')
<div class="container">
    <div class="box box-primary">
        <div class="box-header">
            <center>
                <h3 class="box-title with-border">Events</h3>
            </center>
        </div>
        <div class="box-body">
            <div class="row">
                <form action="">
                    @if(!empty($events))
                        @foreach($events as $key => $event)
                            <div class="col-md-8 col-md-offset-2">
                                <div class="col-md-6">
                                    <label for="">Event: </label>
                                    <p>{{$event->name}}</p>
                                    <label for="">Duration: </label>
                                    <p>{{date('F j, Y',strtotime($event->startDate))}} - {{date('F j, Y', strtotime($event->endDate))}}</p>
                                    <label for="">Address: </label>
                                    <p>{{$event->address}}</p>
                                    <label for="">Description: </label>
                                    <p>{{$event->description}}</p>
                                </div>
                                <div class="col-md-6">
                                    <div id="googleMap{{$key}}" style="height:400px;width:100%;"></div>
                                    <script>myMap("{{$event->address}}",{{$key}})</script>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('headerScript')
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCg-c5uumPyrpGrz3RAvHFYrLJGEyWGi-w"></script>
    <script>
        function myMap(address,key) {
            var address = address;
            var geocoder = new google.maps.Geocoder();
            geocoder.geocode({
                'address': address
                }, 
                function(results, status) {
                    if(status == google.maps.GeocoderStatus.OK) {
                        new google.maps.Marker({
                            position: results[0].geometry.location,
                            map: map
                        });
                        map.setCenter(results[0].geometry.location);
                    }
            });
            var mapProp = {
                zoom: 17,
                scrollwheel: true,
                draggable: true,
                mapTypeId: google.maps.MapTypeId.ROADMAP
            };
            var map = new google.maps.Map(document.getElementById("googleMap"+key), mapProp);
        }
    </script>
@endsection