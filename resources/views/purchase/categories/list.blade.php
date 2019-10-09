@foreach ($items as $item)
<tr>	
    <td><input type="checkbox" name="items[]" value="{{$item->id}}" /></td>
    <td>{{$item->name}}</td>
    <td>{{$item->description}}</td>
    <td>
        <span class="glyphicon glyphicon-remove icon remove-item" data-url="{{ route('purchase-categories.destroy', ['id' => $item->id]) }}"></span> | 
        <span data-route="{{ route('purchase-categories.show', ['id' => $item->id]) }}" data-form="#item-form" class="glyphicon glyphicon-eye-open icon"></span>
        <a href="{{ route('purchase-categories.edit', ['id' => $item->id]) }}"></a>
        <span data-route="{{ route('purchase-categories.edit', ['id' => $item->id]) }}" data-form="#item-form" class="glyphicon glyphicon-edit icon edit-item"></span>
    </td>
</tr>
@endforeach
<tr><td colspan="5"> {{ $items->links() }} </td></tr>