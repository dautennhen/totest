<h4 class="modal-title">@lang('common.Social')</h4>
<hr />
<div class="text-center text-danger form-edit-msg"></div>
<form name="form-item" method="POST" action="{{ route('socials.store') }}">
  <div class="form-group">
    <label for="username">@lang('common.Username') : </label>
    <input type="text" required class="form-control" name="username" />
  </div>
  <div class="form-group">
    <label for="password">@lang('common.Password') :</label>
    <input type="text" required class="form-control" name="password" />
  </div>
  <div class="form-group">
     <label>@lang('common.Status') :</label>
     <ul class="list-unstyled">
        @foreach ($status as $a_status)
          <li> <input type="radio" value="{{ $a_status }}" name="status" type="radio" /> {{ $a_status }} </li>
        @endforeach
     </ul>
  </div>
  <div class="form-group">
      <label>@lang('common.Style') :</label>
     <ul class="list-unstyled">
        @foreach ($cates as $cate)
          <li> <input type="radio" value="{{ $cate }}" name="cate_id" type="radio" /> {{ $cate }} </li>
        @endforeach
     </ul>
  </div>
  <div class="text-right">
      <button type="button" class="btn btn-default btn-save-item">@lang('common.Save')</button>
  </div>
</form>
