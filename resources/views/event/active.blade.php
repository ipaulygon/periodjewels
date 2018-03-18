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