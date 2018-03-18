<table id="tableData" class="table table-striped table-bordered table-responsive">
    <thead>
        <tr>
            <th>Gem</th>
            <th>Description</th>
            <th class="text-right">Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach($gems as $gem)
        <tr>
            <td id="dataName">{{$gem->name}}</td>
            <td id="dataDescription">{{$gem->description}}</td>
            <td class="text-right">
                <button id="btnReactivate" type="button" data-link="gem" data-id="{{$gem->id}}" class="btn btn-info btn-sm btn-flat">
                    <i class="fa fa-refresh"></i> Reactivate
                </button>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
<div class="form-group pull-right">
    <label class="checkbox-inline"><input type="checkbox" data-link="gem" id="showDeactivated" checked> Show deactivated records</label>
</div>