@extends('index')
@section('content')

<div class="buttons-tab">
    <span data-tab=".ln-tab-content .tab-list-item">tab list</span>
    <span data-tab=".ln-tab-content .tab-new-item">tab new</span>
    <span data-tab=".ln-tab-content .tab-edit-item">tab edit</span>
</div>
<div class="ln-tab-content">
    <div class="ln-tab tab-list-item active-tab">  
        <div class="table-display-list">
        <div>
            <form action="{{ route('products.list') }}" method="post" class="form-inline myformsearch">
                <input type="text" placeholder="value" class="form-control searchvalue" name="searchvalue" />
                <input type="hidden" name="orderfield" value="" />
                <input type="hidden" name="orderdir" value="" />
                <input type="hidden" name="page" value="" />
                <button class="btn btn-default searchvalue"> @lang('common.Filter') </button>
             </form>
            <div class="text-right">
                <a data-route="{{ route('products.create') }}" data-tab=".ln-tab-content .tab-form-item" >@lang('common.New item')</a> |
                <a class="btn-delete-items" data-url="{{ route('products.delete.items') }}" data-list=".myformitems" >@lang('common.Delete')</a>
            </div>    
        </div>
        <form class="myformitems">
            <div class="box-body table-responsive no-padding company-offered-service">
                <table class="table table-hover" data-delurl="" >
                    <thead>
                        <tr>
                            <th><a></a></th>
                            <th width="40%"><span data-field="name" class="reorderlist {{ getdirection('name') }}"> @lang('common.Name') </span></th>
                            <th width="20%"><span data-field="price" class="reorderlist {{ getdirection('price') }}"> @lang('common.Price') </span></th>
                            <th width="40%"><span> @lang('common.Image') </span></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody class="tableitemlist">
                        @include('purchase.products.list')
                    </tbody>
                </table>
            </div>
        </form>
        </div>
    </div>
    <div class="ln-tab tab-form-item"> @lang('common.loading')</div>
</div>

@endsection