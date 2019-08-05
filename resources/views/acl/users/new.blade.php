<h4 class="modal-title">@lang('common.Role')</h4>
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
        <ul class="list-unstyled">
            @foreach ($groups as $group)
            <li> <input type="radio" class="form-control" value="{{ $group->id }}" name="group_id" type="radio" /> {{ $group->name }} </li>
            @endforeach
        </ul>
    </div>
    <div class="text-right">
        <button type="button" class="btn btn-default btn-save-item">@lang('common.Save')</button>
    </div>
</form>
