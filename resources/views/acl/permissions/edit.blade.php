<h4 class="modal-title">@lang('common.Permission')</h4>
<hr />
<div class="text-center text-danger form-edit-msg"></div>
<form name="form-item" method="PUT" action="{{ route('permissions.update', ['alias' => $item->alias ]) }}">
  <div class="form-group">
    <label for="zipcode">@lang('common.Alias') : </label>
    <input type="text" required class="form-control" name="alias" value="{{ $item->alias }}" />
  </div>
  <div class="form-group">
    <label for="city">@lang('common.Name') :</label>
    <input type="text" required class="form-control" name="name" value="{{ $item->name }}" />
  </div>
  <div class="form-group">
    <label for="city">@lang('common.Description') :</label>
    <input type="text" required class="form-control" name="description" value="{{ $item->description }}" />
  </div>
  <div class="text-right">
      <button type="button" class="btn btn-default btn-save-item">@lang('common.Save')</button>
  </div>
</form>
