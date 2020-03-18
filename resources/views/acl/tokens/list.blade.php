@foreach ($items as $item)
    @php
        $images = explode("|", $item->image);
    @endphp
<tr>	
    <td><input type="checkbox" name="items[]" value="{{$item->id}}" /></td>
    <td>{{$item->username}}</td>
    <td>{{$item->api_token}}</td>
    <td>{{$item->revoked}}</td>
    <td>
        <span class="glyphicon glyphicon-remove icon remove-item" data-url="{{ route('tokens.destroy', ['id' => $item->id]) }}"></span> | 
        <span data-route="{{ route('tokens.show', ['id' => $item->id]) }}" data-form="#item-form" class="glyphicon glyphicon-eye-open icon"></span>
        <a href="{{ route('tokens.edit', ['id' => $item->id]) }}"></a>
        <span data-route="{{ route('tokens.edit', ['id' => $item->id]) }}" data-tab=".ln-tab-content .tab-form-item" class="glyphicon glyphicon-edit icon edit-item"></span>
    </td>
</tr>
@endforeach
<tr><td colspan="5"> {{ $items->links() }} </td></tr>