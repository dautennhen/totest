@extends('index')

@section('content')
<div class="table-display-list">
<div>
    <form action="{{route('zipcode-list')}}" method="post" class="myformsearch">
        <a href="{{ route('zipcode-new') }}">new item</a> | 
        <span> <input type="text" name="searchvalue" value="{{ request('searchvalue', '') }}" /> </span>
        <input type="hidden" name="orderfield" value="{{ request('orderfield', '') }}" />
        <input type="hidden" name="orderdir" value="{{ request('orderdir', '') }}" />
        <input type="hidden" name="page" value="{{ request('page', 0) }}">
        @csrf
        <button class="searchvalue">search</button>
     </form>
</div>

<div class="box-body table-responsive no-padding company-offered-service">
    <table class="table table-hover" data-delurl="" >
        <tr>
            <th><a></a></th>
            <th><span data-field="zipcode" class="reorderlist {{ getdirection('zipcode') }}">zipcode</span></th>
            <th><span data-field="city" class="reorderlist {{ getdirection('city') }}">city</span></th>
            <th></th>
        </tr>
        @foreach ($zipcodes as $zipcode)
            <tr>	
                <td></td>
                <td>{{$zipcode->zipcode}}</td>
                <td>{{$zipcode->city}}</td>
                <td>
                    <span class="glyphicon glyphicon-remove icon remove-item" data-url="{{ route('zipcode-remove', ['id' => $zipcode->zipcode]) }}"></span> | 
                    <a href="{{ route('zipcode-detail', ['id' => $zipcode->zipcode]) }}"><span class="glyphicon glyphicon-eye-open icon"></span></a>
                    <a href="{{ route('zipcode-edit', ['id' => $zipcode->zipcode]) }}"><span class="glyphicon glyphicon-edit icon"></span></a>
                </td>
            </tr>
        @endforeach
    </table>
    <div>{{ $zipcodes->links() }}</div>
</div>
</div>

<script type="text/javascript">
    $('.table-display-list .pagination .page-link').bind('click', function(event){
        event.preventDefault() 
        var page=$(this).attr('href')
        page = page.split('=')
        page = page[1];
        var $form = $('.myformsearch');
        $form.find('input[name="page"]').val(page)
        $form.submit()
    })
    
    $('.table-display-list .myformsearch button').bind('click', function(event){
        event.preventDefault()
        var $form = $('.myformsearch')
        $form.find('input[name="page"]').val(0)
        $form.submit()
    })
    
    $('.table-display-list .reorderlist').bind('click', function(){
        var val = $(this).is('.asc') ? 'desc' : 'asc'
        var $form = $('.myformsearch')
        $form.find('input[name="orderdir"]').val(val)
        $form.find('input[name="orderfield"]').val($(this).data('field'))
        $form.submit()
    })
    
    $('.table-display-list .remove-item').bind('click', function(){
        if(!confirm('Do you really want to delete')) 
            return
        var url = $(this).data('url');
        $.ajax({
            url: url,
            data: {_token: $('meta[name="csrf-token"]').attr('content')},                    
            type: 'POST',
            success:function(data) {
                location.reload()
            }
        })
    })
</script>
@endsection