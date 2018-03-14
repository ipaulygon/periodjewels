<div id="notif">
    <div id="successAlert" class="alert alert-success alert-dismissible fade in">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true" data-toggle="tooltip" title="Close">&times;</button>
        <h4><i class="icon fa fa-check"></i> Success!</h4>
        {{ Session::get('success') }}
    </div>
    <div class="alert alert-danger alert-dismissible fade in">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true" data-toggle="tooltip" title="Close">&times;</button>
        <h4><i class="icon fa fa-ban"></i> Something went wrong!</h4>
        {{ Session::get('error') }}
    </div>
</div>