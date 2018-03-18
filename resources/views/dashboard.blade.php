@extends('layouts.master')

@section('title')
    {{"Dashboard"}}
@stop

@section('style')
@stop

@section('content')
    <div class="box box-widget widget-user">
        <div class="widget-user-header bg-purple-active">
            <center><h3 class="widget-user-username">{{$util->name}}</h3></center>
        </div>
        <div class="widget-user-image">
            <img class="img-circle" src="{{ URL::asset($util->logo) }}" alt="User Avatar">
        </div>
        <div class="box-footer">
            <div class="row">
            <div class="col-sm-3 border-right">
                <div class="description-block">
                    <h5 class="description-header">0</h5>
                    <span class="description-text">SALES</span>
                </div>
            </div>
            <div class="col-sm-3 border-right">
                <div class="description-block">
                    <h5 class="description-header">0</h5>
                    <span class="description-text">VIEWS</span>
                </div>
            </div>
            <div class="col-sm-3 border-right">
                <div class="description-block">
                    <h5 class="description-header">0</h5>
                    <span class="description-text">PRODUCTS</span>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="description-block">
                    <h5 class="description-header">0</h5>
                    <span class="description-text">EVENTS</span>
                </div>
            </div>
        </div>
    </div>
@stop

@section('script')

@stop