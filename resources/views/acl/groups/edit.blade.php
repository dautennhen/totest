<h4 class="modal-title">@lang('common.Group')</h4>
<hr />
<div class="text-center text-danger form-edit-msg"></div>
<form name="form-item" method="PUT" action="{{ route('groups.update', ['id' => $item->id ]) }}">
  <div class="form-group">
    <label for="city">@lang('common.Name') : </label>
    <input type="text" required class="form-control" name="name" value="{{ $item->name }}" />
  </div>
  <div class="form-group">
    <label for="city">@lang('common.Description') :</label>
    <input type="text" required class="form-control" name="description" value="{{ $item->description }}" />
  </div>
  <div class="form-group">
    <ul class="list-unstyled">
        @foreach ($roles as $role)
            <li> <input type="checkbox" class="form-control" 
                @if( in_array($role->id, $itemRoles) )
                    checked
                @endif
                name="roles[]" type="radio"
                value="{{$role->id}}"
                />
                {{ $role->name }}
            </li>
        @endforeach
    </ul>
  </div>
  <div class="text-right">
      <button type="button" class="btn btn-default btn-save-item">@lang('common.Save')</button>
  </div>
</form>
