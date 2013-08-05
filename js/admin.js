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
            sip_extension: {required: true, digits: true},
            display_name: "required",
            secret: "required",
            call_group: "required",
            pickup_group: "required",
            mailid: {required: '#mailbox:checked', email: true,},
            password_ext: {required: '#mailbox:checked', digits: true},
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





/////////////////queue////////////////////////


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

	//////edit queue//////
	
 $('.edit-queue-div').dialog({
        width: 500,
        height: 600,
        modal: true,
        title: "Edit queue",
        resizable: false,
        autoOpen: false
    });
	
    $('.edit-queue').live('click', function() {
        $('label.error').remove();
		$('.edit-queue-name').val($(this).attr('queue_name'));
		$('.edit-queue-calls-waiting').val($(this).attr('queue_calls_waiting'));
		
		
        $('.edit-queue-div').dialog('open');
    });

	/////////////delete queue//////////
	
	     $('.delete-queue').live('click',function(){ 
	var queue_delete_id = $(this).attr('deleteid');
	var confirmationvalues = confirm("Are you sure you want to delete this queue "+queue_delete_id+"? Click Yes to continue or No to cancel");
	if(confirmationvalues == true){
	if(queue_delete_id !=''){
	  $(this).parents('tr').remove();
	      var post_data = {queue_delete_id:queue_delete_id};
		    $.ajax({
		      type:'POST',
		      url: baseUrl + "index.php/pbx_admin/queue_delete",
		      data:post_data,
		      success: function(data) {
console.log(data);
		      }
	      });
	}
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
		$('.set-destination').val('');
		
		
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
		$('#dependent_destination').empty();
        $.ajax({
            type: "POST",     
            dataType:"html",
            url: baseUrl + "index.php/pbx_admin/inbound_dependent",
            data: post_data,
            success: function(data) {
                var result = '';
               var myObject = eval('(' + data + ')');
                    for (var index in myObject) {
                      $('#dependent_destination').append('<option value="'+myObject[index].list+'">'+myObject[index].list+'</option>'); 
                    }
            }
        });



    });
	
	
/////////edit inbound//////////
	
$('.edit-inbound-div').dialog({
        width: 500,
        height: 400,
        modal: true,
        title: "Edit queue",
        resizable: false,
        autoOpen: false
    });

    $('.edit-inbound').live('click', function() {
        $('label.error').remove();
		
		
        $('.edit-inbound-div').dialog('open');
    });



	
/////////////delete inbound//////////
	
	     $('.delete-inbound').live('click',function(){ 
	var inbound_delete_id = $(this).attr('deleteid');
	var confirmationvalues = confirm("Are you sure you want to delete this inbound route "+inbound_delete_id+"? Click Yes to continue or No to cancel");
	if(confirmationvalues == true){
	if(inbound_delete_id !=''){
	  $(this).parents('tr').remove();
	      var post_data = {inbound_delete_id:inbound_delete_id};
		    $.ajax({
		      type:'POST',
		      url: baseUrl + "index.php/pbx_admin/inbound_delete",
		      data:post_data,
		      success: function(data) {
console.log(data);
		      }
	      });
	}
      }
      });   
	
	
////followme////


$('.create-new-followme').dialog({
        width: 650,
        height: 400,
        modal: true,
        title: "Create Followme",
        resizable: false,
        autoOpen: false
    });


    $('.create-followme').live('click', function() {
        $('label.error').remove();
       
        $('.followme-name').val('');
        $('.followme-list').html('');
        $('.create-new-followme').dialog('open');
    });

    $("#pbx-new-followme").validate({
        rules: {
           
		   followme_name: "required",
               
			   },
        errorPlacement: function(error, element) {
            if (element.attr('name') == 'followme_name') {
                error.insertAfter('#followme-name-error');
            }
            
           
        },
        messages: {
            
			followme_name: "Please enter followme name.",
            
			},
        submitHandler: function(form) {
            $("#pbx-new-followme").submit();
        }
    });


	
	$('#quickpick_extension').change(function() {
        // update input box with the currently selected value
        $('#followme_list').append($('#quickpick_extension').val()+'\n');
    });
	

//edit followme

	$('.edit-followme-div').dialog({
        width: 500,
        height: 400,
        modal: true,
        title: "Edit Followme",
        resizable: false,
        autoOpen: false
    });

    $('.edit-followme').live('click', function() {
        $('label.error').remove();
			
		$('.edit-followme-name').val($(this).attr('followme_name'));
		$('.edit-ring-time').val($(this).attr('ring_time'));
		$('.edit-extension-list').val($(this).attr('extension_list'));
		$('.edit-set-destination').val($(this).attr('set_destination'));
		$('.edit-dependent-value').val($(this).attr('dependent_value'));
		
        $('.edit-followme-div').dialog('open');
    });



/////////////delete followme//////////
	
	     $('.delete-followme').live('click',function(){ 
	var followme_delete_id = $(this).attr('deleteid');
	var confirmationvalues = confirm("Are you sure you want to delete this followme "+followme_delete_id+"? Click Yes to continue or No to cancel");
	if(confirmationvalues == true){
	if(followme_delete_id !=''){
	  $(this).parents('tr').remove();
	      var post_data = {followme_delete_id:followme_delete_id};
		    $.ajax({
		      type:'POST',
		      url: baseUrl + "index.php/pbx_admin/followme_delete",
		      data:post_data,
		      success: function(data) {
console.log(data);
		      }
	      });
	}
      }
      });
	
});

