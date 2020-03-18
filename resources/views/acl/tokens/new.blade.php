<h4 class="modal-title">@lang('common.Product')</h4>
<hr />
<div class="text-center text-danger form-edit-msg"></div>
<form name="form-item" method="POST" action="{{ route('products.store') }}" enctype="multipart/form-data">
  <div class="form-group">
    <label>@lang('common.Name') :</label>
    <input type="text" required class="form-control" name="name" />
  </div>
  <div class="form-group">
    <label>@lang('common.Price') :</label>
    <input type="text" required class="form-control" name="price" />
  </div>
  <div class="form-group">
    <label>@lang('common.Image') :</label>
    <span class="select_img" onclick="$('#form_upload .img').trigger('click')">@lang('common.Select image')</span> |
    <a href="" class="popup_selector" data-inputid="feature_image">Select Image</a>
    <div id="feature_image"></div>
    <input type="hidden" name="image" />
  </div>
  <div class="form-group">
    <label>@lang('common.Video') :</label>
    <input type="url" pattern="https?://.+" required class="form-control" name="video" />
  </div>
  <div class="form-group">
        <iframe class="video no_display" width="560" height="315" src="" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
  </div>
  <div class="form-group">
    <label>@lang('common.Description') : </label>
    <textarea name="description" class="form-control"></textarea>
  </div>
  <div class="form-group">
    <label>@lang('common.Category') :</label>
    <select name="cate_id" class="form-control">
        @foreach ($cates as $cate)
            <option value="{{ $cate->id }}"> {{ $cate->name }} </option>
        @endforeach
    </select>
  </div>
  <div class="text-right">
      <button type="button" class="btn btn-default btn-save-item">@lang('common.Save')</button>
  </div>
</form>

<form style="display:none" name="form_upload" id="form_upload" class="form_product_image d-none"  action="{{ route('ajax-upload-image', ['uploads', 'image']) }}" enctype="multipart/form-data" method="POST" 
    onsubmit="return ajaxUploadFile.submit(this, {'onComplete': function () { ajaxUploadFile.resetUpload('.form_product_image', afterUploadedProductImage) }})" >
    {{ csrf_field() }}
    <label><input type="file" multiple="multiple" class="img" name="image[]" onchange="jQuery(this).parents('form').submit()" />Upload a photo</label>
</form>

<script type="text/javascript">
$(document).ready(function(){
    function validURL(str) {
        var pattern = new RegExp('^(https?:\\/\\/)?'+ // protocol
          '((([a-z\\d]([a-z\\d-]*[a-z\\d])*)\\.)+[a-z]{2,}|'+ // domain name
          '((\\d{1,3}\\.){3}\\d{1,3}))'+ // OR ip (v4) address
          '(\\:\\d+)?(\\/[-a-z\\d%_.~+]*)*'+ // port and path
          '(\\?[;&a-z\\d%_.~+=-]*)?'+ // query string
          '(\\#[-a-z\\d_]*)?$','i'); // fragment locator
        return !!pattern.test(str);
      }
    $('[name="video"]').change('click', function(){
        if(!validURL($(this).val()))
            return $('.video').addClass('no_display').attr('src', '')
        $('.video').removeClass('no_display').attr('src', $(this).val())
    })
})
    
var afterUploadedProductImage = function(form, result){
    var a = '<img width="70" height="70" />'
    var arr = []
    for(var i=0; i<result.path.length; i++) {
        $a = $(a).clone()
        $a.attr('src', 'storage/'+result.path[i])
        $('#feature_image').append($a)
        arr.push(result.path[i])
    }
    $('[name="image"]').val(arr.join('|'))
}

var processSelectedFile = function(file, feature_image){
    var arr = []
    if($.isArray(file)) {
        for(var i =0; i<file.length; i++) {
            $('#feature_image').append('<img src="'+'storage/'+file[i].path+'" />')
            arr.push(file[i].path)
        }
    } else {
        $('#feature_image').append('<img src="'+'storage/'+file.path+'" />')
        arr.push(file.path)
    }
    $('[name="image"]').val(arr.join('|'))
    //$('[name="image[]"]').val(arr)
}
</script>