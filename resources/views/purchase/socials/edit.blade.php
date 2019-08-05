<h4 class="modal-title">@lang('common.Social')</h4>
<hr />
<div class="text-center text-danger form-edit-msg"></div>
<form name="form-item" method="PUT" action="{{ route('socials.update', ['id' => $item->id ]) }}">
  <div class="form-group">
    <label for="name">@lang('common.Name') : </label>
    <input type="text" required class="form-control" name="name" value="{{ $item->name }}" />
  </div>
  <div class="form-group">
    <label for="username">@lang('common.Username') :</label>
    <input type="text" required class="form-control" name="username" value="{{ $item->username }}" />
  </div>
  <div class="form-group">
    <label for="password">@lang('common.Password') :</label>
    <input type="text" required class="form-control" name="password" value="{{ $item->password }}" />
  </div>
  <div class="text-right">
      <button type="button" class="btn btn-default btn-save-item">@lang('common.Save')</button>
  </div>
</form>
