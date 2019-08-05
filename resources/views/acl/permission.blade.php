@extends('index')
@section('content')
<div class="table-display-list">
<div>
    <form action="{{ route('permissions.list') }}" method="post" class="form-inline myformsearch">
        <a data-route="{{ route('permissions.create') }}" data-form="#item-form" >@lang('common.New item')</a> |
        <br />
        <input type="text" class="form-control searchvalue" name="searchvalue" />
        <input type="hidden" name="orderfield" value="" />
        <input type="hidden" name="orderdir" value="" />
        <input type="hidden" name="page" value="" />
        <button class="btn btn-default searchvalue"> @lang('common.Search') </button>
     </form>
</div>

<div class="box-body table-responsive no-padding company-offered-service">
    <table class="table table-hover" data-delurl="" >
        <thead>
            <tr>
                <th><a></a></th>
                <th width="30%"><span data-field="alias" class="reorderlist {{ getdirection('alias') }}"> @lang('common.Alias') </span></th>
                <th width="30%"><span data-field="name" class="reorderlist {{ getdirection('name') }}"> @lang('common.Name') </span></th>
                <th><span data-field="description" class="reorderlist {{ getdirection('city') }}"> @lang('common.Description') </span></th>
                <th></th>
            </tr>
        </thead>
        <tbody class="tableitemlist">
            @include('acl.permissions.list')
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