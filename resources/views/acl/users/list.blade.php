@foreach ($items as $item)
<tr>	
    <td><input type="checkbox" name="items[]" value="{{$item->id}}" /></td>
    <td>{{$item->name}}</td>
    <td>{{$item->username}}</td>
    <td>{{$item->email}}</td>
    <td>{{ $item->deleted_at == null ? '' : 'deleted' }}</td>
    <td>
        <span class="glyphicon glyphicon-remove icon remove-item" data-url="{{ route('users.destroy', ['id' => $item->id]) }}"></span> | 
        <span data-route="{{ route('users.show', ['id' => $item->id]) }}" data-form="#item-form" class="glyphicon glyphicon-eye-open icon"></span>
        <a href="{{ route('users.edit', ['id' => $item->id]) }}"></a>
        <span data-route="{{ route('users.edit', ['id' => $item->id]) }}" data-form="#item-form" class="glyphicon glyphicon-edit icon edit-item"></span>
    </td>
</tr>
@endforeach
<tr><td colspan="4"> {{ $items->links() }} </td></tr>