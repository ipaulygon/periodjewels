@extends('layouts.app')

@section('title')
    {{"Home"}}
@stop

@section('content')
<div class="box box-primary">
    <div class="box-body">
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
</div>
<div class="col-md-12">
    <div class="col-md-4">
        <div class="cards">
            <div class="fades reveals images">
                <img class="visibles contents" src="{{URL::asset('/img/ring201804192.jpg')}}">
                <img class="hiddens contents" src="{{URL::asset('/img/ring201804191.jpg')}}">
            </div>
            <div class="contents">
                <div class="headers">
                    Rings
                </div>
                <div class="descriptions">
                    Finest gems and rings for wedding or anniversary!
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="cards">
            <div class="fades reveals images">
                <img class="visibles contents" src="{{URL::asset('/img/bracelet201804191.jpg')}}">
                <img class="hiddens contents" src="{{URL::asset('/img/bracelet201804192.jpg')}}">
            </div>
            <div class="contents">
                <div class="headers">
                    Bracelets
                </div>
                <div class="descriptions">
                    High quality bracelets with an exquisite design.
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="cards">
            <div class="fades reveals images">
                <img class="visibles contents" src="{{URL::asset('/img/necklace201804192.jpg')}}">
                <img class="hiddens contents" src="{{URL::asset('/img/necklace201804191.jpg')}}">
            </div>
            <div class="contents">
                <div class="headers">
                    Necklaces
                </div>
                <div class="descriptions">
                    Necklaces that will mesmerize you.
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
