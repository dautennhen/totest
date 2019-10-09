@extends('index')
@section('content')
<div class="table-display-list">
<div>
    <form action="{{ route('socials.list') }}" method="post" class="form-inline myformsearch">
        <a data-route="{{ route('socials.create') }}" data-form="#item-form" >@lang('common.New item')</a> |
        <br />
        <input type="text" class="form-control searchvalue" name="searchvalue" />
        <input type="hidden" name="orderfield" value="" />
        <input type="hidden" name="orderdir" value="" />
        <input type="hidden" name="page" value="" />
        <button class="btn btn-default searchvalue"> @lang('common.Search') </button>
     </form>
    <div class="text-right">
        <a data-route="{{ route('socials.create') }}" data-form="#item-form" >@lang('common.New item')</a> |
        <a class="btn-delete-items" data-url="{{ route('socials.delete.items') }}" data-list=".myformitems" >@lang('common.Delete')</a>
    </div>
</div>

<form class="myformitems">
    <div class="box-body table-responsive no-padding">
    <table class="table table-hover" data-delurl="" >
        <thead>
            <tr>
                <th><input type="checkbox" class="check_all" /></th>
                <th width="30%"><span data-field="username" class="reorderlist {{ getdirection('username') }}"> @lang('common.Username') </span></th>
                <th><span data-field="password" class="reorderlist {{ getdirection('password') }}"> @lang('common.Password') </span></th>
                <th><span data-field="cate_id" class="reorderlist {{ getdirection('cate_id') }}"> @lang('common.Type') </span></th>
                <th width="30%"><span data-field="status" class="reorderlist {{ getdirection('status') }}"> @lang('common.Status') </span></th>
                <th></th>
            </tr>
        </thead>
        <tbody class="tableitemlist">
            @include('purchase.socials.list')
        </tbody>
    </table>
    </div>
</form>
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