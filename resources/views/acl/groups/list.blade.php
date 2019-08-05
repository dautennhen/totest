@foreach ($items as $item)
<tr>	
    <td></td>
    <td>{{$item->name}}</td>
    <td>{{$item->description}}</td>
    <td>
        <span class="glyphicon glyphicon-remove icon remove-item" data-url="{{ route('groups.destroy', ['alias' => $item->id]) }}"></span> | 
        <span data-route="{{ route('groups.show', ['alias' => $item->id]) }}" data-form="#item-form" class="glyphicon glyphicon-eye-open icon"></span>
        <a href="{{ route('groups.edit', ['alias' => $item->id]) }}"></a>
        <span data-route="{{ route('groups.edit', ['alias' => $item->id]) }}" data-form="#item-form" class="glyphicon glyphicon-edit icon edit-item"></span>
    </td>
</tr>
@endforeach
<tr><td colspan="4"> {{ $items->links() }} </td></tr>