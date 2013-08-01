$(document).ready(function() {
    //Ramasamy
    $('.create-new-extension').dialog({
        width: 500,
        height: 400,
        modal: true,
        title: "Create Extension",
        resizable: false,
        autoOpen: false
    });

    $('.create-extension').live('click', function() {
        $('label.error').remove();
        $('.sip-extension').val('');
        $('.display-name').val('');
        $('.sceret-fld').val('');
        $('.call-group').val('');
        $('.call-pickup').val('');
        $('.email-id').val('');
        $('.password-ext').val('');
        $('.create-new-extension').dialog('open');
    });

    $("#pbx-new-extensions").validate({
        rules: {
            sip_extension: "required",
            display_name: "required",
            secret: "required",
            call_group: "required",
            pickup_group: "required",
            mailid: "required",
            password_ext: "required",
        },
        errorPlacement: function(error, element) {
            if (element.attr('name') == 'sip_extension') {
                error.insertAfter('#sip-extension-error');
            }
            if (element.attr('name') == 'display_name') {
                error.insertAfter('#display-name-error');
            }
            if (element.attr('name') == 'secret') {
                error.insertAfter('#secret-extension-error');
            }
            if (element.attr('name') == 'call_group') {
                error.insertAfter('#call-group-error');
            }
            if (element.attr('name') == 'pickup_group') {
                error.insertAfter('#call-pickup-error');
            }
            if (element.attr('name') == 'mailid') {
                error.insertAfter('#password-error');
            }
            if (element.attr('name') == 'password_ext') {
                error.insertAfter('#password-error');
            }
        },
        messages: {
            sip_extension: "Please enter Sip Extension.",
            display_name: "Please enter Display Name.",
            secret: "Please enter Secret.",
            call_group: "Please enter Call Group.",
            pickup_group: "Please enter Call Pickup Group.",
            mailid: "Please enter Mail Id.",
            password_ext: "Please enter password.",
        },
        submitHandler: function(form) {
            $("#pbx-new-extensions").submit();
        }
    });
    
     $('.edit-extension-div').dialog({
        width: 500,
        height: 400,
        modal: true,
        title: "Edit Extension",
        resizable: false,
        autoOpen: false
    });

    $('.edit-extension').live('click', function() {
        $('label.error').remove();
        $('.edit-extension-div').dialog('open');
    });
});

