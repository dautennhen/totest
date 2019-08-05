@extends('index')
@section('content')
<div class="table-display-list">
<div>
    <form action="{{route('zipcode-list')}}" method="post" class="myformsearch">
        <a data-route="{{ route('zipcode-new-ajax') }}" data-form="#zipcode-form" >new item</a> |
        <br />
        <span> <input type="text" name="searchvalue" /> </span>
        <input type="hidden" name="orderfield" value="{{ request('orderfield', '') }}" />
        <input type="hidden" name="orderdir" value="{{ request('orderdir', '') }}" />
        <input type="hidden" name="page" value="{{ request('page', 0) }}" />
        <button class="searchvalue">search</button>
     </form>
</div>

<div class="box-body table-responsive no-padding company-offered-service">
    <table class="table table-hover" data-delurl="" >
        <thead>
            <tr>
                <th><a></a></th>
                <th width="30%"><span data-field="zipcode" class="reorderlist {{ getdirection('zipcode') }}">zipcode</span></th>
                <th><span data-field="city" class="reorderlist {{ getdirection('city') }}">city</span></th>
                <th></th>
            </tr>
        </thead>
        <tbody class="tableitemlist">
            @include('zipcodenew.list')
        </tbody>
    </table>
</div>
</div>

<div class="modal" id="item-form" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="text-right"></div>
        <div class="modal-body"></div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>  
</div>

@endsection