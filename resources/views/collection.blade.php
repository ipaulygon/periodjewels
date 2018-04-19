@extends('layouts.app')

@section('title')
    {{"Collection"}}
@stop

@section('content')
<div class="box box-primary">
    <div class="box-header">
        <h3 class="box-title with-border">
            Collections
        </h3>
    </div>
    <div class="box-body">
        <div class="row">
            <div class="col-md-12">
                <ul class="nav nav-tabs">
                    <li role="presentation" class="active"><a href="#">Home</a></li>
                    <li role="presentation"><a href="#">Profile</a></li>
                    <li role="presentation"><a href="#">Messages</a></li>
                    @foreach($jewelries as $jewelry)
                    @if ($loop->first)
                    <li role="presentation" class="active"><a href="#">{{$jewelry->name}}</a></li>
                    @else
                    <li role="presentation"><a href="#">{{$jewelry->name}}</a></li>
                    @endif
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection
