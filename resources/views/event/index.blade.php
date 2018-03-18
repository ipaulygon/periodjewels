@extends('layouts.master')

@section('title')
    {{"Event"}}
@stop

@section('style')
<link rel="stylesheet" href="{{ URL::asset('DataTables/css/dataTables.bootstrap.css') }}" />
<link rel="stylesheet" href="{{ URL::asset('DataTables/css/responsive.dataTables.css') }}" />
<link rel="stylesheet" href="{{ URL::asset('DataTables/css/buttons.dataTables.css') }}" />
<link rel="stylesheet" href="{{ URL::asset('DataTables/css/buttons.bootstrap.css') }}" />
<link rel="stylesheet" href="{{ URL::asset('bootstrap-daterangepicker/daterangepicker.css') }}" />
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
                        <th>Event</th>
                        <th>Duration</th>
                        <th>Location</th>
                        <th>Description</th>
                        <th class="text-right">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($events as $event)
                    <tr>
                        <td id="dataName">{{$event->name}}</td>
                        @php
                            $startDate = explode('-',$event->startDate);
                            $finalStartDate = "$startDate[1]/$startDate[2]/$startDate[0]";
                            $endDate = explode('-',$event->endDate);
                            $finalEndDate = "$endDate[1]/$endDate[2]/$endDate[0]";
                            $date = "$finalStartDate-$finalEndDate";
                        @endphp
                        <td id="dataDate" data-date="{{$date}}">{{date('F j, Y',strtotime($event->startDate))}} - {{date('F j, Y', strtotime($event->endDate))}}</td>
                        <td id="dataAddress">{{$event->address}}</td>
                        <td id="dataDescription">{{$event->description}}</td>
                        <td class="text-right">
                            <button id="btnUpdate" type="button" data-id="{{$event->id}}" class="btn btn-primary btn-sm btn-flat">
                                <i class="fa fa-pencil"></i> Update
                            </button>
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
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form id="createForm">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                        <h4 class="modal-title">New Record</h4>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group" id="nameForm">
                                    <label for="">Event</label><span>*</span>
                                    <input type="text" name="name" id="name" class="form-control" autofocus>
                                    <ul class="text-danger" id="nameError"></ul>
                                </div>
                                <div class="form-group" id="dateForm">
                                    <label for="">Date</label><span>*</span>
                                    <div class="input-group">
                                        <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                                        <input type="text" name="date" id="date" class="form-control ">
                                    </div>
                                    <ul class="text-danger" id="dateError"></ul>
                                </div>
                                <div class="form-group" id="addressForm">
                                    <label for="">Address</label><span>*</span>
                                    <textarea name="address" id="address" cols="30" rows="5" class="form-control"></textarea>
                                    <input type="hidden" name="valid" id="valid">
                                    <ul class="text-danger" id="addressError"></ul>
                                    <ul class="text-danger" id="validError"></ul>
                                </div>
                                <div class="form-group" id="descriptionForm">
                                    <label for="">Description</label>
                                    <textarea name="description" id="description" cols="30" rows="5" class="form-control"></textarea>
                                    <ul class="text-danger" id="descriptionError"></ul>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Location</label>
                                    <div id="googleMap" style="height:500px;width:100%;"></div>
                                </div>
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
        <div class="modal-dialog modal-lg">
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
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group" id="nameFormUpdate">
                                    <label for="">Event</label><span>*</span>
                                    <input type="text" name="name" id="nameUpdate" class="form-control" autofocus>
                                    <ul class="text-danger" id="nameErrorUpdate"></ul>
                                </div>
                                <div class="form-group" id="dateFormUpdate">
                                    <label for="">Date</label><span>*</span>
                                    <div class="input-group">
                                        <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                                        <input type="text" name="date" id="dateUpdate" class="form-control ">
                                    </div>
                                    <ul class="text-danger" id="dateErrorUpdate"></ul>
                                </div>
                                <div class="form-group" id="addressFormUpdate">
                                    <label for="">Address</label><span>*</span>
                                    <textarea name="address" id="addressUpdate" cols="30" rows="5" class="form-control"></textarea>
                                    <input type="hidden" name="valid" id="validUpdate">
                                    <ul class="text-danger" id="addressErrorUpdate"></ul>
                                    <ul class="text-danger" id="validErrorUpdate"></ul>
                                </div>
                                <div class="form-group" id="descriptionFormUpdate">
                                    <label for="">Description</label>
                                    <textarea name="description" id="descriptionUpdate" cols="30" rows="5" class="form-control"></textarea>
                                    <ul class="text-danger" id="descriptionErrorUpdate"></ul>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Location</label>
                                    <div id="googleMapUpdate" style="height:500px;width:100%;"></div>
                                </div>
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
<script type="text/javascript" src="{{ URL::asset('bootstrap-daterangepicker/daterangepicker.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/record.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/event.js') }}"></script>
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCg-c5uumPyrpGrz3RAvHFYrLJGEyWGi-w"></script>
@stop