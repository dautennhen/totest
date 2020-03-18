@foreach ($items as $item)
<tr>	
    <td></td>
    <td>{{ basename($item) }}</td>
    <td>
        <span class="glyphicon glyphicon-remove icon remove-item" data-url="{{ route('backups.destroy', ['alias' => $item]) }}"></span>
    </td>
</tr>
@endforeach