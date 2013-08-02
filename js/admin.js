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

    //$("#pbx-new-extensions").validate({ignore:":not(:visible)"});
    $("#pbx-new-extensions").validate({
        rules: {
            sip_extension: {required: true, digits: true},
            display_name: "required",
            secret: "required",
            call_group: "required",
            pickup_group: "required",
            mailid: {required: true, email: true},
            password_ext: {required: true, digits: true},
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
            if (element.attr('name') == 'mailid') {
                error.insertAfter('#mailid-error');
            }
            if (element.attr('name') == 'password_ext') {
                error.insertAfter('#mail-password-error');
            }

        },
        messages: {
            sip_extension: "Please enter only numbers as Sip Extension.",
            display_name: "Please enter Display Name.",
            secret: "Please enter Secret.",
            mailid: "Please enter Mail Id.",
            password_ext: "Please enter only numbers as password.",
        },
        submitHandler: function(form) {
            $("#pbx-new-extensions").submit();
            $('.edit-extension-div').dialog('close');
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





/////////////////kumutha////////////////////////


    $('.create-new-queue').dialog({
        width: 500,
        height: 700,
        modal: true,
        title: "Create Queue",
        resizable: false,
        autoOpen: false
    });

    $('.create-queue').live('click', function() {
        $('label.error').remove();

        $('.queue-name').val('');
        $('.queue-call-wait').val('');
        $('.create-new-queue').dialog('open');
    });

    $("#pbx-new-queue").validate({
        rules: {
            queue_name: "required",
            queue_call_wait: "required",
        },
        errorPlacement: function(error, element) {
            if (element.attr('name') == 'queue_name') {
                error.insertAfter('#queue-name-error');
            }
            if (element.attr('name') == 'queue_call_wait') {
                error.insertAfter('#queue-call-wait-error');
            }

        },
        messages: {
            queue_name: "Please enter queue name.",
            queue_call_wait: "Please enter queue call waiting.",
        },
        submitHandler: function(form) {
            $("#pbx-new-queue").submit();
        }
    });


/////inbound//////	


    $('.create-new-inbound').dialog({
        width: 650,
        height: 400,
        modal: true,
        title: "Create Inbound",
        resizable: false,
        autoOpen: false
    });

    $('.create-inbound').live('click', function() {
        $('label.error').remove();

        $('.did-name').val('');
        $('.did-number').val('');
        $('.create-new-inbound').dialog('open');
    });

    $("#pbx-new-inbound").validate({
        rules: {
            did_name: "required",
            did_number: "required",
        },
        errorPlacement: function(error, element) {
            if (element.attr('name') == 'did_name') {
                error.insertAfter('#did-name-error');
            }
            if (element.attr('name') == 'did_number') {
                error.insertAfter('#did-number-error');
            }

        },
        messages: {
            did_name: "Please enter did name.",
            did_number: "Please enter did number.",
        },
        submitHandler: function(form) {
            $("#pbx-new-inbound").submit();
        }
    });

    $("#set_destination").change(function() {
        var destination = $(this).val();
        var post_data = {destination:destination} ;
        $.ajax({
            type: "POST",     
            dataType:"html",
            url: baseUrl + "index.php/pbx_admin/inbound_dependent",
            data: post_data,
            success: function(data) {
                var result = '';
               var myObject = eval('(' + data + ')');
                    for (var index in myObject) {
                      $('#dependent_destination').append('<option value="username.list">'+myObject[index].list+'</option>'); 
                    }
            }
        });



    });







});

