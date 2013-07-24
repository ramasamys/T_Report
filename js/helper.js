 $(document).ready(function(){
   
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
 });
 
  