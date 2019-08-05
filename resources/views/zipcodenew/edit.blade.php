<h4 class="modal-title">Zipcode</h4>
<hr />
<div class="text-center text-danger form-edit-msg"></div>
<form name="form-zipcode-edit" method="POST" action="{{ route('zipcode-save',['id' => $zipcode->zipcode ]) }}">
  <div class="form-group">
    <label for="zipcode">Zipcode:</label>
    <input type="text" class="form-control" id="zipcode" name="zipcode" value="{{ $zipcode->zipcode }}" readonly />
  </div>
  <div class="form-group">
    <label for="city">City:</label>
    <input type="text" class="form-control" id="city" name="city" value="{{ $zipcode->city }}" />
  </div>
  <button type="button" class="btn btn-default btn-save-item">Save</button>
</form>