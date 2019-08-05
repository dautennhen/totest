@foreach ($zipcodes as $zipcode)
<tr>	
    <td></td>
    <td>{{$zipcode->zipcode}}</td>
    <td>{{$zipcode->city}}</td>
    <td>
        <span class="glyphicon glyphicon-remove icon remove-item" data-url="{{ route('zipcode-remove', ['id' => $zipcode->zipcode]) }}"></span> | 
        <a href="{{ route('zipcode-detail', ['id' => $zipcode->zipcode]) }}"><span class="glyphicon glyphicon-eye-open icon"></span></a>
        <a href="{{ route('zipcode-edit', ['id' => $zipcode->zipcode]) }}"></a>
        <span data-route="{{ route('zipcode-edit', ['id' => $zipcode->zipcode]) }}" data-form="#zipcode-form" class="glyphicon glyphicon-edit icon edit-item"></span>
    </td>
</tr>
@endforeach
<tr><td colspan="4"> {{ $zipcodes->links() }} </td></tr>