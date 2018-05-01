@extends('layouts.app')

@section('title')
    {{"Collection"}}
@stop

@section('content')
<div class="container">
    <div class="box box-primary">
        <div class="box-header">
            <center>
                <h3 class="box-title with-border">Collection</h3>
            </center>
        </div>
        <div class="box-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="nav-tabs-custom">
                        <ul class="nav nav-tabs">
                            @foreach($jewelries as $jewelry)
                            <li role="presentation" class="{{($loop->first ? 'active' : '')}}"><a href="#{{$jewelry->id}}" data-toggle="tab">{{$jewelry->name}}</a></li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="tab-content">
                        @foreach($jewelries as $jewelry)
                            <div class="tab-pane fade {{($loop->first ? 'in active' : '')}}" id="{{$jewelry->id}}">
                                <div class="col-md-12">
                                @foreach($products->where('jewelryId',$jewelry->id) as $product)
                                <div class="col-md-3" style="padding:3%!important">
                                @if(!empty($product->image))
                                    @if(count($product->image->where('isMain',1))!=0)
                                    <img class="img-responsive" src="{{URL::asset($util->site.$product->image->where('isMain',1)->first()->image)}}" alt="" style="max-width:150px; background-size: contain">                            
                                    @else
                                    <img class="img-responsive" src="{{URL::asset($util->site.$product->image->first()->image)}}" alt="" style="max-width:150px; background-size: contain">                            
                                    @endif
                                @endif
                                </div>
                                @endforeach
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
