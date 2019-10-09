$(document).ready(function () {

    function loadRouteAction(formAttr, data, callback) {
        return sendData(formAttr.route, data, 'GET', function (response) {
            if (formAttr.form) {
                $form = $(formAttr.form)
                $form.find('.modal-body').html(response)
                return $form.modal()
            }
            $(formAttr.tab).parent().children().removeClass('active-tab')
            return $(formAttr.tab).html(response).addClass('active-tab')
            /*return window.location.href = window.location.protocol + '//'
             + window.location.hostname
             + window.location.pathname
             + '#' + formAttr.route
             */
        })
    }

    function sendData(url, data, method, callback) {
        return $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: url,
            data: data,
            type: method,
            beforeSend: function () {
                $('.fullscreen').addClass('active')
            },
            complete: function () {
                $('.fullscreen').removeClass('active')
            },
            success: function (response) {
                callback(response)
            }
        })
    }

    function submitForm($form) {
        var data = $form.serialize()
        var url = $form.attr('action')
        var method = $form.attr('method')
        $('.check-all-items').prop('checked', false)
        return sendData(url, data, method, function (response) {
            $('.tableitemlist').html(response)
            activeTab('.ln-tab-content .tab-list-item')
        })
    }

    $(document).on('click', '[data-route]', function (event) {
        event.preventDefault()
        var formAttr = $(this).data()
        return loadRouteAction(formAttr, {}, $.noop)
    })

    $(document).on('click', '.table-display-list .pagination .page-link', function (event) {
        event.preventDefault()
        var page = $(this).attr('href')
        page = page.split('=')
        page = page[1]
        var $form = $('.myformsearch')
        $form.find('input[name="page"]').val(page)
        return submitForm($form)
    })

    $(document).on('click', '.table-display-list .myformsearch button', function (event) {
        event.preventDefault()
        var $form = $('.myformsearch')
        $form.find('input[name="page"]').val(0)
        return submitForm($form)
    })

    $(document).on('click', '.table-display-list .reorderlist', function () {
        if ($(this).is('.disable'))
            return
        var $form = $('.myformsearch')
        var $orderdir = $form.find('input[name="orderdir"]')
        var $orderfield = $form.find('input[name="orderfield"]')
        var val = $orderdir.val()
        val = (val == 'asc') ? 'desc' : 'asc'
        if ($orderfield.val() != $(this).data('field'))
            val = 'asc'
        $orderdir.val(val)
        $orderfield.val($(this).data('field'))
        return submitForm($form)
    })

    $(document).on('click', '.table-display-list .remove-item', function () {
        if (!confirm('Do you really want to delete ?'))
            return
        var url = $(this).data('url')
        return sendData(url, {}, 'DELETE', function (response) {
            submitForm($('.myformsearch'))
        })
    })

    $(document).on('click', '.btn-save-item', function () {
        var $form = $(this).closest("form")
        return sendData($form.attr('action'), $form.serialize(), $form.attr('method'), function (response) {
            (response.success == true) ?
                    $('.form-edit-msg').html('sucess') :
                    $('.form-edit-msg').html('failed')
            return submitForm($('.myformsearch'))
        })
    })

    $(document).on('click', '.btn-delete-items', function () {
        if (!confirm('Do you really want to delete ?'))
            return
        var data = $(this).data();
        return sendData(data.url, $(data.list).serialize(), 'DELETE', function (response) {
            var msg = (response.success == true) ? 'sucess' : 'failed';
            console.log(msg)
            return submitForm($('.myformsearch'))
        })
    })

    // table list checkbox
    $(document).on('click', '.check-all-items', function () {
        var checked = $(this).is(':checked') ? true : false
        $('.tableitemlist').find('[name="items[]"]').each(function () {
            $(this).prop('checked', checked)
        })
    })

    $(document).on('click', '.tableitemlist [name="items[]"]', function () {
        var $items = $('.tableitemlist').find('[name="items[]"]')
        var checked = ($items.length == $items.filter(':checked').length) ? true : false
        $('.check-all-items').prop('checked', checked)
    })

    // upload file 
    $(document).on('change', 'input[type=file]', function () {

    })

    $(document).on('click', '[data-tab]', function () {
        var tab = $(this).data('tab')
        $(tab).parent().children().removeClass('active-tab')
        $(tab).addClass('active-tab')
    })

    function activeTab(tab) {
        //var tab = $(this).data('tab')
        $(tab).parent().children().removeClass('active-tab')
        $(tab).addClass('active-tab')
    }
    

})

// Upload ajax
ajaxUploadFile = {
    frameName: 'frameUpload',
    frame: function (c) {
        var d = document.createElement('DIV');
        d.innerHTML = '<iframe style="display:none" src="about:blank" id="' + this.frameName + '" name="' + this.frameName + '" onload="ajaxUploadFile.loaded(\'' + this.frameName + '\')"></iframe>';
        document.body.appendChild(d);
        var i = document.getElementById(this.frameName);
        if (c && typeof (c.onComplete) == 'function') {
            i.onComplete = c.onComplete;
        }
        return this.frameName;
    },
    form: function (f, name) {
        f.setAttribute('target', name);
    },
    submit: function (f, c) {
        this.form(f, this.frame(c));
        if (c && typeof (c.onStart) == 'function') {
            return c.onStart();
        } else {
            return true;
        }
    },
    loaded: function (id) {
        var i = document.getElementById(id);
        if (i.contentDocument) {
            var d = i.contentDocument;
        } else if (i.contentWindow) {
            var d = i.contentWindow.document;
        } else {
            var d = window.frames[id].document;
        }
        if (d.location.href == "about:blank") {
            return;
        }
        if (typeof (i.onComplete) == 'function') {
            i.onComplete(d.body.innerHTML);
        }
    },
    resetUpload: function (form, callback) {
        var result = jQuery('#' + this.frameName).contents().find('body').text();
        result = JSON.parse(result)
        //console.log(result)
        if (result.success == true) {
            if (typeof callback == 'function')
                callback(form, result);
        } else {
            console.log('Something wrong when upload file in server');
        }
    }
}