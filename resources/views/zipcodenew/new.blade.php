<h4 class="modal-title">Zipcode</h4>
<hr />
<div class="text-center text-danger form-edit-msg"></div>
<form name="form-zipcode" method="POST" action="{{ route('zipcode-save',['id' => 0 ]) }}">
  <div class="form-group">
    <label for="zipcode">Zipcode:</label>
    <input type="text" required class="form-control" id="zipcode" name="zipcode" />
  </div>
  <div class="form-group">
    <label for="city">City:</label>
    <input type="text" required class="form-control" id="city" name="city" />
  </div>
  <div class="text-right">
      <button type="button" class="btn btn-default btn-save-item">Save</button>
  </div>
  
</form>
