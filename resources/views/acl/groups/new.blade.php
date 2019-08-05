<h4 class="modal-title">@lang('common.Group')</h4>
<hr />
<div class="text-center text-danger form-edit-msg"></div>
<form name="form-item" method="POST" action="{{ route('groups.store') }}">
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
        @foreach ($roles as $role)
            <li> <input type="checkbox" class="form-control" value="{{ $role->id }}" name="roles[]" type="radio" /> {{ $role->name }} </li>
        @endforeach
    </ul>
  </div>
    <div class="text-right">
      <button type="button" class="btn btn-default btn-save-item">@lang('common.Save')</button>
    </div>
</form>
