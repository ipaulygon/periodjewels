@extends('layouts.master')

@section('title')
    {{"Product"}}
@stop

@section('style')
<link rel="stylesheet" href="{{ URL::asset('DataTables/css/dataTables.bootstrap.css') }}" />
<link rel="stylesheet" href="{{ URL::asset('DataTables/css/responsive.dataTables.css') }}" />
<link rel="stylesheet" href="{{ URL::asset('DataTables/css/buttons.dataTables.css') }}" />
<link rel="stylesheet" href="{{ URL::asset('DataTables/css/buttons.bootstrap.css') }}" />
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
                        <th>Product</th>
                        <th>Description</th>
                        <th class="text-right">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($products as $product)
                    <tr>
                        <td id="dataName">{{$product->name}}</td>
                        <td id="dataDescription">{{$product->description}}</td>
                        <td class="text-right">
                            <button id="btnUpdate" type="button" data-id="{{$product->id}}" class="btn btn-primary btn-sm btn-flat">
                                <i class="fa fa-pencil"></i> Update
                            </button>
                            <button id="btnDeactivate" type="button" data-link="product" data-id="{{$product->id}}" class="btn btn-danger btn-sm btn-flat">
                                <i class="fa fa-trash"></i> Deactivate
                            </button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="form-group pull-right">
                <label class="checkbox-inline"><input type="checkbox" data-link="product" id="showDeactivated"> Show deactivated records</label>
            </div>
        </div>
        <div id="loading" class="overlay hidden">
            <i class="fa fa-spin fa-refresh"></i>
        </div>
    </div>

    <!-- Modals -->
    <!-- create -->
    <div id="createModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="createForm">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                        <h4 class="modal-title">New Record</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group" id="nameForm">
                            <label for="">Product</label><span>*</span>
                            <input type="text" name="name" id="name" class="form-control" autofocus>
                            <ul class="text-danger" id="nameError"></ul>
                        </div>
                        <div class="form-group" id="descriptionForm">
                            <label for="">Description</label>
                            <textarea name="description" id="description" cols="30" rows="5" class="form-control"></textarea>
                            <ul class="text-danger" id="descriptionError"></ul>
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
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="updateForm">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                        <h4 class="modal-title">Update Record</h4>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="_method" value="PUT">
                        <input type="hidden" name="idUpdate" id="idUpdate">
                        <div class="form-group" id="nameFormUpdate">
                            <label for="">Product</label><span>*</span>
                            <input type="text" name="name" id="nameUpdate" class="form-control" autofocus>
                            <ul class="text-danger" id="nameErrorUpdate"></ul>
                        </div>
                        <div class="form-group" id="descriptionFormUpdate">
                            <label for="">Description</label>
                            <textarea name="description" id="descriptionUpdate" cols="30" rows="5" class="form-control"></textarea>
                            <ul class="text-danger" id="descriptionErrorUpdate"></ul>
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
<script type="text/javascript" src="{{ URL::asset('js/record.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/product.js') }}"></script>
@stop