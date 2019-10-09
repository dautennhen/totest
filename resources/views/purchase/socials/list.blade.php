@foreach ($items as $item)
<tr>	
    <td><input type="checkbox" name="items[]" value="{{$item->id}}" /></td>
    <td>{{$item->username}}</td>
    <td>{{$item->password}}</td>
    <td>{{$item->cate_id}}</td>
    <td>{{$item->status}}</td>
    <td>
        <span class="glyphicon glyphicon-remove icon remove-item" data-url="{{ route('socials.destroy', ['id' => $item->id]) }}"></span> | 
        <span data-route="{{ route('socials.show', ['id' => $item->id]) }}" data-form="#item-form" class="glyphicon glyphicon-eye-open icon"></span>
        <a href="{{ route('socials.edit', ['id' => $item->id]) }}"></a>
        <span data-route="{{ route('socials.edit', ['id' => $item->id]) }}" data-form="#item-form" class="glyphicon glyphicon-edit icon edit-item"></span>
    </td>
</tr>
@endforeach
<tr><td colspan="5"> {{ $items->links() }} </td></tr>