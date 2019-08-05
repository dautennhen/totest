<h4 class="modal-title">@lang('common.User')</h4>
<hr />
<div class="text-center text-danger form-edit-msg"></div>
<form name="form-item" method="PUT" action="{{ route('users.update', ['id' => $item->id ]) }}">
  <div class="form-group">
    <label for="city">@lang('common.Name') : </label>
    <input type="text" required class="form-control" name="name" value="{{ $item->name }}" />
  </div>
  <div class="form-group">
    <label for="city">@lang('common.Username') : </label>
    <input type="text" required class="form-control" name="username" value="{{ $item->username }}" />
  </div>
  <div class="form-group">
    <label for="city">@lang('common.Email') :</label>
    <input type="text" required class="form-control" name="email" value="{{ $item->email }}" />
  </div>
  <div class="form-group">
    <ul class="list-unstyled">
        @foreach ($groups as $group)
            <li> <input type="radio" class="form-control" 
                @if( $item->group_id == $group->id )
                    checked
                @endif
                name="group_id" type="radio"
                value="{{$group->id}}"
                />
                {{ $group->name }}
            </li>
        @endforeach
    </ul>
  </div>
  <div class="text-right">
      <button type="button" class="btn btn-default btn-save-item">@lang('common.Save')</button>
  </div>
</form>
