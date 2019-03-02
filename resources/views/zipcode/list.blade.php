@extends('index')

@section('content')
<div><a href="{{ route('zipcode-new') }}">new item</a></div>
<div class="box-body table-responsive no-padding company-offered-service">
    <table class="table table-hover" data-delurl="" >
        <tr>
            <th><a></a></th>
            <th><a>zipcode</a></th>
            <th><a>city</a></th>
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

<script>
    $('.remove-item').bind('click', function(){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        var url = $(this).data('url');
        $.ajax({
            url: url,
            data: {_token: CSRF_TOKEN},                    
            type: 'POST',
            success:function(data) {
                location.reload()
            }
        });
    })
/*
 * $('.alias').on('change', function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        var alias = this.value;
        $.ajax({
            url:"/api/get-page",
            data: {_token: CSRF_TOKEN,
                    alias: alias},                    
            type: 'POST',
            success:function(page) {
                $('input[name="title"]').val(page.title);
                $('input[name="content"]').val(page.content);
                $('input[name="keywords"]').val(page.keywords);
                $('input[name="description"]').val(page.description);
            }
        });      
        
    })
*/
</script>
@endsection