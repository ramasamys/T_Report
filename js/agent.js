$(document).ready(function() {
$('.blink').blink();


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

	$("#allcheck").click(function(){
    if($(this).is(":checked"))
        $(".checkall").attr("checked", "checked");
    else
        $(".checkall").removeAttr("checked");
});

$("#checkall").click(function(){
    if($(this).is(":checked"))
        $(".check").attr("checked", "checked");
    else
        $(".check").removeAttr("checked");
});
     
     
    
  
     $('.queue_select').live('click', function() {
          $('.add_queue_popup').dialog('open');
    });
     
     
       $('.remove_queue').live('click', function() {
          $('.remove_queue_popup').dialog('open');
    });
  });
