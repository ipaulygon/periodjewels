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
            @if(!empty($product->image))
                @if(!empty($product->image->where('isMain',1)->get()))
                <img class="img-responsive" src="{{URL::asset('https://s3.amazonaws.com/us-periodjewels/'.$product->image->where('isMain',1)->first()->image)}}" alt="" style="max-width:150px; background-size: contain">                            
                @else
                <img class="img-responsive" src="{{URL::asset('https://s3.amazonaws.com/us-periodjewels/'.$product->image->first()->image)}}" alt="" style="max-width:150px; background-size: contain">                            
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
                        <li><a target="_blank" href="{{url('https://s3.amazonaws.com/us-periodjewels/'.$certificate->certificate)}}">{{$certificate->certificate}}</a></li>
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