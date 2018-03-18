@extends('layouts.master')

@section('title')
    {{"Product"}}
@stop

@section('style')
<link rel="stylesheet" href="{{ URL::asset('DataTables/css/dataTables.bootstrap.css') }}" />
<link rel="stylesheet" href="{{ URL::asset('DataTables/css/responsive.dataTables.css') }}" />
<link rel="stylesheet" href="{{ URL::asset('DataTables/css/buttons.dataTables.css') }}" />
<link rel="stylesheet" href="{{ URL::asset('DataTables/css/buttons.bootstrap.css') }}" />
<link rel="stylesheet" href="{{ URL::asset('select2/dist/css/select2.css') }}" />
@stop

@section('content')
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title"></h3>
            <div class="box-tools">
                <button type="button" class="btn btn-primary btn-md btn-flat" data-toggle="modal" data-target="#createModal">
                    <i class="fa fa-plus"></i> New Record
                </button>
            </div>
        </div>
        <div id="box-body" class="box-body dataTables_wrapper">
            <table id="tableData" class="table table-striped table-bordered table-responsive">
                <thead>
                    <tr>
                        <th></th>
                        <th>Gem</th>
                        <th>Carat</th>
                        <th>Description</th>
                        <th>Price ($)</th>
                        <th>Certificate(s)</th>
                        <th>Status</th>
                        <th class="text-right">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($products as $product)
                    <tr>
                        <td id="dataImage" data-image="{{$product->image}}">
                        @if(count($product->image) != 0)
                            @if(count($product->image->where('isMain',1)->first()) != 0)
                            <img class="img-responsive" src="{{URL::asset('https://s3-ap-southeast-1.amazonaws.com/periodjewels/'.$product->image->where('isMain',1)->first()->image)}}" alt="" style="max-width:150px; background-size: contain">                            
                            @else
                            <img class="img-responsive" src="{{URL::asset('https://s3-ap-southeast-1.amazonaws.com/periodjewels/'.$product->image->first()->image)}}" alt="" style="max-width:150px; background-size: contain">                            
                            @endif
                        @endif
                        </td>
                        <td id="dataGem" data-gem="{{$product->gem->id}}">{{$product->gem->name}}</td>
                        <td id="dataCarat" data-carat="{{$product->carat}}">{{number_format($product->carat,2)}}</td>
                        <td id="dataDescription" data-jewelry="{{$product->jewelry->id}}" data-color="{{$product->color}}" data-clarity="{{$product->clarity}}" data-cut="{{$product->cut}}" data-origin="{{$product->origin}}" data-description="{{$product->description}}">
                            <ul>
                                <li>Jewelry: {{$product->jewelry->name}}</li>
                                @if(!empty($product->color))<li>Color: {{$product->color}}</li>@endif
                                @if(!empty($product->clarity))<li>Clarity: {{$product->clarity}}</li>@endif
                                @if(!empty($product->cut))<li>Cut: {{$product->cut}}</li>@endif
                                @if(!empty($product->origin))<li>Origin: {{$product->origin}}</li>@endif
                                <li>Description: {{$product->description}}</li>
                            </ul>
                        </td>
                        <td id="dataPrice" data-price="{{$product->price}}">{{number_format($product->price,2)}}</td>
                        <td id="dataCertificate" data-certificate="{{$product->certificate}}">
                            @if(!empty($product->certificate))
                            <ul>
                                @foreach($product->certificate as $certificate)
                                    <li><a target="_blank" href="{{url('https://s3-ap-southeast-1.amazonaws.com/periodjewels/'.$certificate->certificate)}}">{{$certificate->certificate}}</a></li>
                                @endforeach
                            </ul>
                            @endif
                        </td>
                        <td>
                            {{($product->isSold ? "Sold" : "Unsold")}}
                        </td>
                        <td class="text-right">
                            @if(!$product->isSold)
                            <button id="btnUpdate" type="button" data-id="{{$product->id}}" class="btn btn-primary btn-sm btn-flat">
                                <i class="fa fa-pencil"></i> Update
                            </button>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div id="loading" class="overlay hidden">
            <i class="fa fa-spin fa-refresh"></i>
        </div>
    </div>

    <!-- Modals -->
    <!-- create -->
    <div id="createModal" class="modal fade" role="dialog">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <form id="createForm" enctype="multipart/form-data">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                        <h4 class="modal-title">New Record</h4>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group" id="gemForm">
                                            <label for="">Gem Stone</label><span>*</span>
                                            <select name="gem" id="gem" class="select2 form-control" autofocus>
                                                <option value="">Select Gem Stone</option>                                        
                                                @foreach($gems as $gem)
                                                    <option value="{{$gem->id}}">{{$gem->name}}</option>
                                                @endforeach
                                            </select>
                                            <ul class="text-danger" id="gemError"></ul>
                                        </div>
                                        <div class="form-group" id="caratForm">
                                            <label for="">Carat</label><span>*</span>
                                            <input type="text" name="carat" id="carat" class="form-control">
                                            <ul class="text-danger" id="caratError"></ul>
                                        </div>
                                        <div class="form-group" id="colorForm">
                                            <label for="">Color</label>
                                            <input type="text" name="color" id="color" class="form-control">
                                            <ul class="text-danger" id="colorError"></ul>
                                        </div>
                                        <div class="form-group" id="clarityForm">
                                            <label for="">Clarity</label>
                                            <input type="text" name="clarity" id="clarity" class="form-control">
                                            <ul class="text-danger" id="clarityError"></ul>
                                        </div>
                                        <div class="form-group" id="cutForm">
                                            <label for="">Cut</label>
                                            <input type="text" name="cut" id="cut" class="form-control">
                                            <ul class="text-danger" id="cutError"></ul>
                                        </div>
                                        <div class="form-group" id="countryForm">
                                            <label for="">Origin</label>
                                            <select name="origin" id="origin" class="select2 form-control">
                                                <option value="">Select Country</option>                                        
                                                @foreach($countries as $country)
                                                    <option value="{{$country}}">{{$country}}</option>
                                                @endforeach
                                            </select>
                                            <ul class="text-danger" id="countryError"></ul>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group" id="jewelryForm">
                                            <label for="">Jewelry</label><span>*</span>
                                            <select name="jewelry" id="jewelry" class="select2 form-control" autofocus>
                                                <option value="">Select Jewelry</option>                                        
                                                @foreach($jewelries as $jewelry)
                                                    <option value="{{$jewelry->id}}">{{$jewelry->name}}</option>
                                                @endforeach
                                            </select>
                                            <ul class="text-danger" id="jewelryError"></ul>
                                        </div>
                                        <div class="form-group" id="priceForm">
                                            <label for="">Price</label><span>*</span>
                                            <div class="input-group">
                                                <div class="input-group-addon">
                                                    <i class="fa fa-dollar"></i>
                                                </div>
                                                <input type="text" name="price" id="price" class="form-control">
                                            </div>
                                            <ul class="text-danger" id="priceError"></ul>
                                        </div>
                                        <div class="form-group" id="descriptionForm">
                                            <label for="">Description</label><span>*</span>
                                            <textarea name="description" id="description" cols="30" rows="5" class="form-control"></textarea>
                                            <ul class="text-danger" id="descriptionError"></ul>
                                        </div>
                                        <div class="form-group" id="certificateForm">
                                            <label for="">Certificate</label>
                                            <input type="file" name="certificate" id="certificate" class="form-control btn btn-primary btn-flat btn-md" multiple>
                                            <ul class="text-danger" id="certificateError"></ul>
                                        </div>
                                        <div class="form-group" id="imageForm">
                                            <label for="">Image</label>
                                            <input type="file" name="image" id="image" class="form-control btn btn-primary btn-flat btn-md" multiple>
                                            <ul class="text-danger" id="imageError"></ul>
                                        </div>
                                        <input type="hidden" name="main" id="main">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <b>Certificate(s):</b><br>
                                <div id="certificatePreview"><ul id="certificateList"></ul></div>
                                <hr>
                                <b>Image(s):</b><br>
                                <div id="imagePreview" style="max-height: 400px;overflow:auto"></div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" id="close" class="btn btn-default btn-flat pull-left" data-dismiss="modal">Close</button>
                        <button type="submit" id="submitCreate" class="btn btn-primary btn-flat">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- update -->
    <div id="updateModal" class="modal fade" role="dialog">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <form id="updateForm" enctype="multipart/form-data">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                        <h4 class="modal-title">Update Record</h4>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="_method" value="PUT">
                        <input type="hidden" name="idUpdate" id="idUpdate">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group" id="gemFormUpdate">
                                            <label for="">Gem Stone</label><span>*</span>
                                            <select name="gem" id="gemUpdate" class="select2 form-control" autofocus>
                                                <option value="">Select Gem Stone</option>                                        
                                                @foreach($gems as $gem)
                                                    <option value="{{$gem->id}}">{{$gem->name}}</option>
                                                @endforeach
                                            </select>
                                            <ul class="text-danger" id="gemErrorUpdate"></ul>
                                        </div>
                                        <div class="form-group" id="caratFormUpdate">
                                            <label for="">Carat</label><span>*</span>
                                            <input type="text" name="carat" id="caratUpdate" class="form-control">
                                            <ul class="text-danger" id="caratErrorUpdate"></ul>
                                        </div>
                                        <div class="form-group" id="colorFormUpdate">
                                            <label for="">Color</label>
                                            <input type="text" name="color" id="colorUpdate" class="form-control">
                                            <ul class="text-danger" id="colorErrorUpdate"></ul>
                                        </div>
                                        <div class="form-group" id="clarityFormUpdate">
                                            <label for="">Clarity</label>
                                            <input type="text" name="clarity" id="clarityUpdate" class="form-control">
                                            <ul class="text-danger" id="clarityErrorUpdate"></ul>
                                        </div>
                                        <div class="form-group" id="cutFormUpdate">
                                            <label for="">Cut</label>
                                            <input type="text" name="cut" id="cutUpdate" class="form-control">
                                            <ul class="text-danger" id="cutErrorUpdate"></ul>
                                        </div>
                                        <div class="form-group" id="countryFormUpdate">
                                            <label for="">Origin</label>
                                            <select name="origin" id="originUpdate" class="select2 form-control">
                                                <option value="">Select Country</option>                                        
                                                @foreach($countries as $country)
                                                    <option value="{{$country}}">{{$country}}</option>
                                                @endforeach
                                            </select>
                                            <ul class="text-danger" id="countryErrorUpdate"></ul>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group" id="jewelryFormUpdate">
                                            <label for="">Jewelry</label><span>*</span>
                                            <select name="jewelry" id="jewelryUpdate" class="select2 form-control" autofocus>
                                                <option value="">Select Jewelry</option>                                        
                                                @foreach($jewelries as $jewelry)
                                                    <option value="{{$jewelry->id}}">{{$jewelry->name}}</option>
                                                @endforeach
                                            </select>
                                            <ul class="text-danger" id="jewelryErrorUpdate"></ul>
                                        </div>
                                        <div class="form-group" id="priceFormUpdate">
                                            <label for="">Price</label><span>*</span>
                                            <div class="input-group">
                                                <div class="input-group-addon">
                                                    <i class="fa fa-dollar"></i>
                                                </div>
                                                <input type="text" name="price" id="priceUpdate" class="form-control">
                                            </div>
                                            <ul class="text-danger" id="priceErrorUpdate"></ul>
                                        </div>
                                        <div class="form-group" id="descriptionFormUpdate">
                                            <label for="">Description</label><span>*</span>
                                            <textarea name="description" id="descriptionUpdate" cols="30" rows="5" class="form-control"></textarea>
                                            <ul class="text-danger" id="descriptionErrorUpdate"></ul>
                                        </div>
                                        <div class="form-group" id="certificateFormUpdate">
                                            <label for="">Certificate</label>
                                            <input type="file" name="certificate" id="certificateUpdate" class="form-control btn btn-primary btn-flat btn-md" multiple>
                                            <ul class="text-danger" id="certificateErrorUpdate"></ul>
                                        </div>
                                        <div class="form-group" id="imageFormUpdate">
                                            <label for="">Image</label>
                                            <input type="file" name="image" id="imageUpdate" class="form-control btn btn-primary btn-flat btn-md" multiple>
                                            <ul class="text-danger" id="imageErrorUpdate"></ul>
                                        </div>
                                        <input type="hidden" name="main" id="mainUpdate">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <b>Certificate(s):</b><br>
                                <div id="certificatePreviewUpdate"><ul id="certificateListUpdate"></ul></div>
                                <hr>
                                <b>Image(s):</b><br>
                                <div id="imagePreviewUpdate" style="max-height: 400px;overflow:auto"></div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" id="close" class="btn btn-default btn-flat pull-left" data-dismiss="modal">Close</button>
                        <button type="submit" id="submitUpdate" class="btn btn-primary btn-flat">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop

@section('script')
<script type="text/javascript" src="{{ URL::asset('DataTables/jquery.dataTables.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('DataTables/dataTables.bootstrap.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('DataTables/dataTables.responsive.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('DataTables/dataTables.buttons.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('DataTables/buttons.flash.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('DataTables/buttons.html5.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('DataTables/jszip.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('select2/dist/js/select2.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('inputmask/dist/inputmask/inputmask.js')}}"></script>
<script type="text/javascript" src="{{ URL::asset('inputmask/dist/inputmask/inputmask.extensions.js')}}"></script>
<script type="text/javascript" src="{{ URL::asset('inputmask/dist/inputmask/inputmask.numeric.extensions.js')}}"></script>
<script type="text/javascript" src="{{ URL::asset('inputmask/dist/inputmask/jquery.inputmask.js')}}"></script>
<script type="text/javascript" src="{{ URL::asset('js/record.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/product.js') }}"></script>
@stop