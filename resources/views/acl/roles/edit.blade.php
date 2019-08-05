<h4 class="modal-title">@lang('common.Role')</h4>
<hr />
<div class="text-center text-danger form-edit-msg"></div>
<form name="form-item" method="PUT" action="{{ route('roles.update', ['id' => $item->id ]) }}">
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
        @foreach ($permissions as $permission)
            <li> <input type="checkbox" class="form-control" 
                @if( in_array($permission->alias, $itemPermissions) )
                    checked
                @endif
                name="permissions[]" type="radio"
                value="{{$permission->alias}}"
                />
                {{ $permission->alias }}
            </li>
        @endforeach
    </ul>
  </div>
  <div class="text-right">
      <button type="button" class="btn btn-default btn-save-item">@lang('common.Save')</button>
  </div>
</form>
