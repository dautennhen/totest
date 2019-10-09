<h4 class="modal-title">@lang('common.User')</h4>
<hr />
<div class="text-center text-danger form-edit-msg"></div>
<form name="form-item" method="POST" action="{{ route('users.store') }}">
    <div class="form-group">
        <label for="city">@lang('common.Name') : </label>
        <input type="text" required class="form-control" name="name" value="" />
    </div>
    <div class="form-group">
        <label for="city">@lang('common.Username') : </label>
        <input type="text" required class="form-control" name="username" value="" />
    </div>
    <div class="form-group">
        <label for="city">@lang('common.Email') :</label>
        <input type="text" required class="form-control" name="email" value="" />
    </div>
    <div class="form-group">
        <label for="city">@lang('common.Group') :</label>
        <ul class="list-unstyled">
            @foreach ($groups as $group)
            <li> <input type="radio" value="{{ $group->id }}" name="group_id" type="radio" /> {{ $group->name }} </li>
            @endforeach
        </ul>
    </div>
    <div class="form-group">
        <label>@lang('common.Status') :</label>
        <ul class="list-unstyled">
            <li> <input type="radio" value="active" name="status" type="radio" /> @lang('common.active') </li>
            <li> <input type="radio" value="inactive" name="status" type="radio" /> @lang('common.inactive') </li>
        </ul>
    </div>
    <div class="text-right">
        <button type="button" class="btn btn-default btn-save-item">@lang('common.Save')</button>
    </div>
</form>
