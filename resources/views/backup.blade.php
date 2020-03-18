@extends('index')
@section('content')
<h2> @lang('common.Backup') </h2>
<span> </span>
<div class="box-body table-responsive no-padding">
    <table class="table table-hover" >
        <thead>
            <tr>
                <td></td>
                <th width="30%"><span> @lang('common.File') </span></th>
                <th></th>
            </tr>
        </thead>
        <tbody class="tableitemlist">
            @include('backup_list')
        </tbody>
    </table>
</div>
@endsection