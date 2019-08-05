@extends('index')
@section('content')
<div class="text-center text-danger form-edit-msg"></div>
<form name="form-zipcode" action="{{ route('zipcode-save',['id' => 0 ]) }}">
  <div class="form-group">
    <label for="zipcode">Zipcode:</label>
    <input type="text" required class="form-control" id="zipcode" name="zipcode" />
  </div>
  <div class="form-group">
    <label for="city">City:</label>
    <input type="text" required class="form-control" id="city" name="city" />
  </div>
  <button type="button" class="btn btn-default btn-save">Save</button>
  <button type="button" class="btn btn-dark btn-back" onClick="history.back()">Back</button>
</form>

<script type="text/javascript">
$(document).ready(function() {
    $form = $('[name="form-zipcode"]').validate()
    $('.btn-save').bind('click', function(){
        if(!$form.valid())
            return
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        var $form = $('form[name="form-zipcode-edit"]')
        var data = $form.serialize() + '&_token=' + CSRF_TOKEN
        $.ajax({
            url: $form.attr('action'),
            data: data,                    
            type: 'POST',
            success:function(response) {
                (response.success) ? 
                    $('.form-edit-msg').html('sucess') :
                    $('.form-edit-msg').html('failed')
            }
        });
    })
})
</script>
@endsection