@extends('index')
@section('content')
<div class="table-display-list">
<div>
    <form action="{{ route('users.list') }}" method="post" class="form-inline myformsearch">
        <input type="text" placeholder="name" class="form-control" name="fields[name]" />
        <input type="text" placeholder="username" class="form-control" name="fields[username]" />
        <input type="text" placeholder="value" class="form-control searchvalue" name="searchvalue" />
        <input type="hidden" name="orderfield" value="" />
        <input type="hidden" name="orderdir" value="" />
        <input type="hidden" name="page" value="" />
        <button class="btn btn-default searchvalue"> @lang('common.Filter') </button>
     </form>
    <div class="text-right">
        <a data-route="{{ route('users.create') }}" data-form="#item-form" >@lang('common.New item')</a> |
        <a class="btn-delete-items" data-url="{{ route('users.delete.items') }}" data-list=".myformitems" >@lang('common.Delete')</a>
    </div>    
</div>

<form class="myformitems">
    <div class="box-body table-responsive no-padding company-offered-service">
        <table class="table table-hover" >
            <thead>
                <tr>
                    <th><a></a></th>
                    <th width="30%"><span data-field="name" class="reorderlist {{ getdirection('name') }}"> @lang('common.Name') </span></th>
                    <th><span data-field="username" class="reorderlist {{ getdirection('username') }}"> @lang('common.Username') </span></th>
                    <th><span data-field="email" class="reorderlist {{ getdirection('email') }}"> @lang('common.Email') </span></th>
                    <th><span data-field="deleted_at" class="reorderlist {{ getdirection('deleted_at') }}"> @lang('common.Status') </span></th>
                    <th></th>
                </tr>
            </thead>
            <tbody class="tableitemlist">
                @include('acl.users.list')
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