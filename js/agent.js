$(document).ready(function() {
  
     $('.add_queue_popup').dialog({
        width: 500,
        height: 400,
        modal: true,
        title: "Add Queue",
        resizable: false,
        autoOpen: false
    });
  
     
  $('.remove_queue_popup').dialog({
        width: 500,
        height: 400,
        modal: true,
        title: "Add Queue",
        resizable: false,
        autoOpen: false
    });
     
     
     
     
    
  
     $('.queue_select').live('click', function() {
          $('.add_queue_popup').dialog('open');
    });
     
     
       $('.remove_queue').live('click', function() {
          $('.remove_queue_popup').dialog('open');
    });
     
     
  
  
  
  
  
  
  
  
  
  
  
  
	    });
