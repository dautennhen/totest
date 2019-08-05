@foreach ($items as $item)
<tr>	
    <td></td>
    <td>{{$item->alias}}</td>
    <td>{{$item->name}}</td>
    <td>{{$item->description}}</td>
    <td>
        <span class="glyphicon glyphicon-remove icon remove-item" data-url="{{ route('permissions.destroy', ['alias' => $item->alias]) }}"></span> | 
        <span data-route="{{ route('permissions.show', ['alias' => $item->alias]) }}" data-form="#item-form" class="glyphicon glyphicon-eye-open icon"></span>
        <a href="{{ route('permissions.edit', ['alias' => $item->alias]) }}"></a>
        <span data-route="{{ route('permissions.edit', ['alias' => $item->alias]) }}" data-form="#item-form" class="glyphicon glyphicon-edit icon edit-item"></span>
    </td>
</tr>
@endforeach
<tr><td colspan="4"> {{ $items->links() }} </td></tr>