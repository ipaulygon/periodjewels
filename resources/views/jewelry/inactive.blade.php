<table id="tableData" class="table table-striped table-bordered table-responsive">
    <thead>
        <tr>
            <th>Jewelry</th>
            <th>Description</th>
            <th class="text-right">Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach($jewelries as $jewelry)
        <tr>
            <td id="dataName">{{$jewelry->name}}</td>
            <td id="dataDescription">{{$jewelry->description}}</td>
            <td class="text-right">
                <button id="btnReactivate" type="button" data-link="jewelry" data-id="{{$jewelry->id}}" class="btn btn-info btn-sm btn-flat">
                    <i class="fa fa-refresh"></i> Reactivate
                </button>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
<div class="form-group pull-right">
    <label class="checkbox-inline"><input type="checkbox" data-link="jewelry" id="showDeactivated" checked> Show deactivated records</label>
</div>