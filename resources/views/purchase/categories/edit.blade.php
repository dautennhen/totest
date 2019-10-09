<h4 class="modal-title">@lang('common.Purchase category')</h4>
<hr />
<div class="text-center text-danger form-edit-msg"></div>
<form name="form-item" method="PUT" action="{{ route('purchase-categories.update', ['id' => $item->id ]) }}">
  <div class="form-group">
    <label for="name">@lang('common.Name') : </label>
    <input type="text" required class="form-control" name="name" value="{{ $item->name }}" />
  </div>
  <div class="form-group">
    <label for="description">@lang('common.Description') :</label>
    <input type="text" required class="form-control" name="description" value="{{ $item->description }}" />
  </div>
  <div class="text-right">
      <button type="button" class="btn btn-default btn-save-item">@lang('common.Save')</button>
  </div>
</form>
