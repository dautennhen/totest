<h4 class="modal-title">@lang('common.Role')</h4>
<hr />
<div class="text-center text-danger form-edit-msg"></div>
<form name="form-item" method="POST" action="{{ route('roles.store') }}">
  <div class="form-group">
    <label for="city">@lang('common.Name') :</label>
    <input type="text" required class="form-control" name="name" />
  </div>
  <div class="form-group">
    <label for="city">@lang('common.Description') :</label>
    <input type="text" required class="form-control" name="description" />
  </div>
  <div class="form-group">
    <ul class="list-unstyled">
        @foreach ($permissions as $permission)
            <li> <input type="checkbox" class="form-control" value="{{ $permission->alias }}" name="permissions[]" type="radio" /> {{ $permission->name }} </li>
        @endforeach
    </ul>
  </div>
    <div class="text-right">
      <button type="button" class="btn btn-default btn-save-item">@lang('common.Save')</button>
    </div>
</form>
