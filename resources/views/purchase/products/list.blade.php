@foreach ($items as $item)
    @php
        $images = explode("|", $item->image);
    @endphp
<tr>	
    <td><input type="checkbox" name="items[]" value="{{$item->id}}" /></td>
    <td>{{$item->name}}</td>
    <td>{{$item->price}}</td>
    <td>
        @foreach ($images as $a_image)
            <img width="70" height="70" src="storage/{{ $a_image }}" />
        @endforeach
    </td>
    <td>
        <span class="glyphicon glyphicon-remove icon remove-item" data-url="{{ route('products.destroy', ['id' => $item->id]) }}"></span> | 
        <span data-route="{{ route('products.show', ['id' => $item->id]) }}" data-form="#item-form" class="glyphicon glyphicon-eye-open icon"></span>
        <a href="{{ route('products.edit', ['id' => $item->id]) }}"></a>
        <span data-route="{{ route('products.edit', ['id' => $item->id]) }}" data-tab=".ln-tab-content .tab-form-item" class="glyphicon glyphicon-edit icon edit-item"></span>
    </td>
</tr>
@endforeach
<tr><td colspan="5"> {{ $items->links() }} </td></tr>