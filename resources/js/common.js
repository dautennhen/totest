$(document).ready(function() {
    
    function loadRouteAction(formAttr, data, callback) {
        return console.log(formAttr)
        return sendData(formAttr.route, data, 'GET', function(response){
            $form = $(formAttr.form)
            //$form.find('.modal-title').html(formAttr.title)
            $form.find('.modal-body').html(response)
            $form.modal()
            window.location.href = window.location.protocol + '//'
                + window.location.hostname
                + window.location.pathname
                + '#' + formAttr.route
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
            beforeSend: function() {},
            complete: function() {},
            success: function(response) {
                callback(response)
            }
        })
    }
    
    function submitForm($form) {
        var data = $form.serialize()
        var url = $form.attr('action')
        var method = $form.attr('method')
        return sendData(url, data, method, function(response) {
            $('.tableitemlist').html(response)
        })
    }
    
    $(document).on('click', '[data-route]', function(event) {
        event.preventDefault() 
        var formAttr = $(this).data()
        return loadRouteAction(formAttr, {}, $.noop)
    })
    
    $(document).on('click', '.table-display-list .pagination .page-link', function(event) {
        event.preventDefault()
        var page=$(this).attr('href')
        page = page.split('=')
        page = page[1]
        var $form = $('.myformsearch')
        $form.find('input[name="page"]').val(page)
        return submitForm($form)
    })
    
    $(document).on('click', '.table-display-list .myformsearch button', function(event) {
        event.preventDefault()
        var $form = $('.myformsearch')
        $form.find('input[name="page"]').val(0)
        return submitForm($form)
    })
    
    $(document).on('click', '.table-display-list .reorderlist', function() {
        if($(this).is('.disable'))
            return
        var $form = $('.myformsearch')
        var $orderdir = $form.find('input[name="orderdir"]')
        var $orderfield = $form.find('input[name="orderfield"]')
        var val = $orderdir.val()
        val = (val=='asc') ? 'desc' : 'asc'
        if( $orderfield.val() != $(this).data('field') )
            val = 'asc'
        $orderdir.val(val)
        $orderfield.val($(this).data('field'))
        return submitForm($form)
    })
    
    $(document).on('click', '.table-display-list .remove-item', function() {
        if(!confirm('Do you really want to delete'))
            return
        var url = $(this).data('url')
        return sendData(url, {}, 'POST', function(response) {
            submitForm( $('.myformsearch') )
        })
    })
    
    $(document).on('click', '.btn-save-item', function() {
        var $form = $(this).closest("form")
        //return console.log($form.attr('action'))
        return sendData($form.attr('action'), $form.serialize(), $form.attr('method'), function(response) {
            (response.success) ? 
                    $('.form-edit-msg').html('sucess') :
                    $('.form-edit-msg').html('failed')
        })
    })
    
    $(document).on('loaded', '.form', function() {
        //$(this).validate()
    })
 })