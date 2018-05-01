@extends('layouts.app')

@section('title')
    {{"Home"}}
@stop

@section('content')
<div class="container">
    <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
            <li data-target="#carousel-example-generic" data-slide-to="1" class=""></li>
        </ol>
        <div class="carousel-inner">
            <div class="item active">
                <img src="{{URL::asset('/img/gb-emerald.jpg')}}" alt="">
                <div class="carousel-caption">
                    <h1>Georgina Emerald</h1><br>
                    <p>In 2016, a new emerald deposit was found in the Seba Boru district near the town of Shakiso, Ethiopia.</p>
                    <p>The mining is done by small-scale miners, the traditional way, by hand without heavy machinery.</p>
                    <p>Most of the material being mined is commercial grade, but fine quality crystals of good size, color,</p>
                    <p> and clarity are being found, and the gems cut from these crystals do not require clarity enhancement,</p>
                    <p>such as oiling.</p>
                </div>
            </div>
            <div class="item">
                <img src="{{URL::asset('/img/exquisite-gems.jpg')}}" alt="">
                <div class="carousel-caption">
                Exquisite Gems
                </div>
            </div>
        </div>
        <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
            <span class="fa fa-angle-left"></span>
        </a>
        <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
            <span class="fa fa-angle-right"></span>
        </a>
    </div>
</div>
<div class="inverse-body margin-padding">
    <div class="container">
        <div class="col-md-12">
            <div class="col-xs-12 col-md-6">
                <div class="heading">
                    <h2>COLLECTIONS</h2>
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-md-12">
            <div class="col-xs-12 col-md-4">
                <div class="cards">
                    <div class="fades reveals images">
                        <img class="visibles contents" src="{{URL::asset('/img/ring201804192.jpg')}}">
                        <img class="hiddens contents" src="{{URL::asset('/img/ring201804191.jpg')}}">
                    </div>
                </div>
                <div style="margin:10px">
                    <h4 class="heading">Rings</h4>
                </div>
            </div>
            <div class="col-xs-12 col-md-4">
                <div class="cards">
                    <div class="fades reveals images">
                        <img class="visibles contents" src="{{URL::asset('/img/bracelet201804191.jpg')}}">
                        <img class="hiddens contents" src="{{URL::asset('/img/bracelet201804192.jpg')}}">
                    </div>
                </div>
                <div style="margin:10px">
                    <h4 class="heading">Bracelets</h4>
                </div>
            </div>
            <div class="col-xs-12 col-md-4">
                <div class="cards">
                    <div class="fades reveals images">
                        <img class="visibles contents" src="{{URL::asset('/img/necklace201804192.jpg')}}">
                        <img class="hiddens contents" src="{{URL::asset('/img/necklace201804191.jpg')}}">
                    </div>
                </div>
                <div style="margin:10px">
                    <h4 class="heading">Necklaces</h4>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="margin-padding">
    <div class="container">
        <div class="col-md-12">
            <div class="col-xs-12 col-md-6">
                <div class="heading">
                    <h2>ABOUT US</h2>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="col-xs-12 col-md-6">
                <p>Whether it’s a Collateral Loan shop in Beverly Hills, London’s Portobello market on a Saturday morning or an Emerald mine in the Copper Belt region of Zambia, we search the Globe for the finest and most interesting pieces of Antique Jewelry, unusual Gemstones and Diamonds. We invite you to take a look at our collection and let us know if you need more information.</p>
            </div>
            <div class="col-xs-12 col-md-6">
                <p>We are always looking to acquire fine pieces of signed Jewelry, Diamonds and Gems. We specialize in the purchase of Van Cleef & Arpels, Cartier, Harry Winston, Tiffany & Co , David Webb, Verdura, Buccellati to name but a few. We are typically the highest bidder for signed pieces from the Georgian period, all the way up to present day. We can arrange appointments to value your Estate Jewelry in the privacy of our Beverly Hills offices, or the place of your choice, insuring complete confidentiality.</p>
            </div>
        </div>
    </div>
</div>
@endsection
