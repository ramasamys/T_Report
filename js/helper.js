 $(document).ready(function(){
   
//   if ($('.report-login').find('input[type="text"]').length > 0) { 
//         $('.report-login').find('input[type="text"]')[0].focus();    
//   }
  
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
 });
 
  