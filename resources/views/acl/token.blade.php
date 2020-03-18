@extends('index')
@section('content')

<div class="buttons-tab">
    <span data-tab=".ln-tab-content .tab-list-item">tab list</span>
    <span data-tab=".ln-tab-content .tab-new-item">tab new</span>
    <span data-tab=".ln-tab-content .tab-edit-item">tab edit</span>
</div>
<div class="ln-tab-content">
    <div class="ln-tab tab-list-item active-tab"></div>
</div>


@extends('index')
@section('content')
<div class="ln-tab-content">
    <div class="ln-tab tab-list-item active-tab">  
        <div class="table-display-list">
<div>
    <form action="{{ route('tokens.list') }}" method="post" class="form-inline myformsearch">
        <input type="text" placeholder="name" class="form-control" name="fields[name]" />
        <input type="text" placeholder="username" class="form-control" name="fields[username]" />
        <input type="text" placeholder="value" class="form-control searchvalue" name="searchvalue" />
        <input type="hidden" name="orderfield" value="" />
        <input type="hidden" name="orderdir" value="" />
        <input type="hidden" name="page" value="" />
        <button class="btn btn-default searchvalue"> @lang('common.Filter') </button>
     </form>
    <div class="text-right">
                <a data-route="{{ route('tokens.create') }}" data-tab=".ln-tab-content .tab-form-item" >@lang('common.New item')</a> |
                <a class="btn-delete-items" data-url="{{ route('tokens.delete.items') }}" data-list=".myformitems" >@lang('common.Delete')</a>
            </div>    
</div>

<form class="myformitems">
    <div class="box-body table-responsive no-padding company-offered-service">
        <table class="table table-hover" >
            <thead>
                <tr>
                    <th><input type="checkbox" class="check-all-items" /></th>
                    <th><span data-field="username" class="reorderlist {{ getdirection('username') }}"> @lang('common.Username') </span></th>
                    <th><span data-field="token" class="reorderlist {{ getdirection('api_token') }}"> @lang('common.Api token') </span></th>
                    <th><span data-field="revoked" class="reorderlist {{ getdirection('revoked') }}"> @lang('common.Revoked') </span></th>
                    <th></th>
                </tr>
            </thead>
            <tbody class="tableitemlist">
                @include('acl.tokens.list')
            </tbody>
        </table>
    </div>
</form>
</div>
    </div></div>
@endsection