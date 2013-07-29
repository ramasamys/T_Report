 $(document).ready(function(){
   //Ramasamy
  if ($('#report-login').find('input[type="text"]').length > 0) { 
        $('#report-login').find('input[type="text"]').focus();    
  }
  
    $( ".datepicker" ).datepicker({
      changeMonth: true,
      changeYear: true
    });
    
    $('.show-div').click( function(){
      $('.show-div').hide();
      $('.hide-div').show();
      $('.slide-up-key').slideDown();
    });
    
    $('.hide-div').click( function(){ 
      $('.hide-div').hide();
      $('.show-div').show();
      $('.slide-up-key').slideUp();
    });
    
    var url = "";
    url = $('#agent-name-autocomplete').attr('url');    
    $('#agent-name-autocomplete').autocomplete(url,{
		delay:10,
		minChars:1,
		matchSubset:1,
		matchContains:1,
		cacheLength:10,
		autoFill:true,
		selectFirst: true

    });  
    $('.mailbox').live('click',function(){
        if($(this).is(':checked')){   
            $('.show-fields').show();
        } else {
            $('.show-fields').hide();
        }
    });
    //rakesh
    
        $("#enterqueue").click(function(){	
	
	if($('#searchable').val()=="null")
	{
	alert("you must select any queue");
	return false;
	}
	else{	
		vall=$('#searchable').val();
		var agent=$('#agentname').val();
//alert("HELLO WORLD!");

//alert(vall);


        var dataString = 'team='+vall+'&q='+agent ;
        //var dataString = 'name='+ name + '&email=' + email + '&phone=' + phone;  
         $.ajax({
        // alert("sdfsdf");
  type: "POST", 
  //dataType: "html", url: baseUrl + "controller/function",
  
 url: baseUrl+"index.php/login/queue_login", 
  data: dataString,
  success: function(response){
    window.location.href =baseUrl+"login/agentmaincontrol";
  //alert(response);
    /*
  if(($.trim(response) != "success")){
    //alert("Select any queue");
    window.location.href = "index(test).php?queue="+vall;
    }
    else{
     window.location.href = "index(test).php?queue="+vall+"&campaign=in";
     }
     */
     }
 
});
 }
});
    
    
    
    
    
    
    
    
    
    
    			$('#searchable').multiselect2side({
				search: "Search: "
			});
			$('#first').multiselect2side({
				optGroupSearch: "Group: ",
				search: "<img src='img/search.gif' />"
			});
			$('#second').multiselect2side({
				selectedPosition: 'right',
				moveOptions: false,
				labelsx: '',
				labeldx: '',
				autoSort: true,
				autoSortAvailable: true
				});
			$('#third').multiselect2side({
				selectedPosition: 'left',
				moveOptions: true,
				labelTop: '+ +',
				labelBottom: '- -',
				labelUp: '+',
				labelDown: '-',
				labelsx: '* Selected *',
				labeldx: '* Available *',
				search: "Find: "
				});
			$('#fourth').multiselect2side({maxSelected: 4});

			$('.clickToView2').click(function() {
				$(this).parent().prevAll("select:first").toggle();
				return false;
			});

			$('.clickToView').click(function() {
				elClick = $(this);
				selEl = elClick.prevAll("select:first");
//alert(elClick);
				$.ajax({
					url: 'jmultiselect2side.php',
					data: selEl.serialize() + '&SELECTNAME=' + selEl.attr("name"),
					success: function(data) {
						elClick.next().next().next().html(data);
					}
				});
				return false;
			});


		$('#fourth')
			.multiselect2side('addOption', {name: 'test selected', value: 'test1', selected: true})
			.multiselect2side('addOption', {name: 'test not selected', value: 'test2', selected: false});
		$('#third')
			.multiselect2side('addOption', {name: 'test selected', value: 'test1', selected: true})
			.multiselect2side('addOption', {name: 'test not selected', value: 'test2', selected: false});
			
    
    
    
    
    
    
    
    
 });
 
  