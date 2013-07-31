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

     $('.delete-extension').live('click',function(){ 
	var delete_id = $(this).attr('deleteid');
	var confirmationvalues = confirm("Are you sure you want to delete this Extension? Click Yes to continue or No to cancel");
	if(confirmationvalues == true){
	if(delete_id !=''){
	  $(this).parents('tr').remove();
	      var post_data = {delete_id:delete_id};
	      $.ajax({
		      type:'POST',
		      url: baseUrl + "index.php/pbx_admin/deleteExtension",
		      data:post_data,
		      success: function(data) {
console.log(data);
		      }
	      });
	}
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

        var dataString = 'team='+vall+'&q='+agent ;
         $.ajax({
  type: "POST", 
 url: baseUrl+"index.php/login/queue_login", 
  data: dataString,
  success: function(response){
    window.location.href =baseUrl+"index.php/login/agentmaincontrol";
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
			
    
   			
	$("#pause").click(function(){
			alert('puase');
			var usr=$('#agent').val();
			var dataString='agent='+usr+'&flag=f3';
			$.ajax({
					type:"POST",
					url:baseUrl+"index.php/login/agentpause",
					data:dataString,
					success:function(response){
					//$('#pause').style.background='gray';
					 $("#pause").css("background-color","gray");
					}
			});
	
 });	
			
			
	$("#unpause").click(function(){
			alert('unpause');
			var usr=$('#agent').val();
			var dataString='agent='+usr+'&flag=f4';
			$.ajax({
					type:"POST",
					url:baseUrl+"index.php/login/agentpause",
					data:dataString,
					success:function(response){
					 $("#pause").css("background-color","#F15A29");	
					}
			});
	
 });	 
//call popup div





    
    
    
    
    
    
 });
 
 //ajax popup div 
 function openpopup(id){ 
popup1.style.visibility = "visible";
//Calculate Page width and height 
var pageWidth = window.innerWidth; 
var pageHeight = window.innerHeight; 
if (typeof pageWidth != "number"){ 
if (document.compatMode == "CSS1Compat"){ 
pageWidth = document.documentElement.clientWidth; 
pageHeight = document.documentElement.clientHeight; 
} else { 
pageWidth = document.body.clientWidth; 
pageHeight = document.body.clientHeight; 
} 
}
//Make the background div tag visible... 
var divbg = document.getElementById('bg'); 
 divbg.style.visibility = "visible"; 

var divobj = document.getElementById(id); 
divobj.style.visibility = "visible"; 
//divobj.style.left="330px !important";
//divobj.style.top="25px !important";
if (navigator.appName=="Microsoft Internet Explorer") 
computedStyle = divobj.currentStyle; 
else computedStyle = document.defaultView.getComputedStyle(divobj, null); 
//Get Div width and height from StyleSheet 
var divWidth = computedStyle.width.replace('px', ''); 
var divHeight = computedStyle.height.replace('px', ''); 
var divLeft = (pageWidth - divWidth) / 2; 
var divTop = (pageHeight - divHeight) / 2; 
//Set Left and top coordinates for the div tag 
divobj.style.left = (divLeft + 130) + "px"; 
divobj.style.top = (divTop +20) + "px"; 
//console.log(divLeft);
//console.log(divTop);
//Put a Close button for closing the popped up Div tag 
if(divobj.innerHTML.indexOf("closepopup('" + id +"')") < 0 ) 
divobj.innerHTML = "<a href=\"#\" onclick=\"closepopup('" + id +"')\"><span class=\"close_button\">X</span></a>" + divobj.innerHTML; 
	//var t=setTimeout(function(){ popup1.style.visibility = "hidden";
	//bg.style.visibility = "hidden";},7000);
	 // setTimeout();
	 //iframerefresh();
} 
function closepopup(id){ 
var divbg = document.getElementById('bg'); 
divbg.style.visibility = "hidden"; 
var divobj = document.getElementById(id); 
divobj.style.visibility = "hidden"; 
}

$(function(){
cometpopup();		
});



function cometpopup(){

var agentnumber=$('#agent').val();
$.ajax({
type:'Get',
url:baseUrl+"index.php/login/popup",
async:true,
success:function(data){
	var json=eval('(' + data + ')');
	console.log(json);
	var phon=json.phone;
	
	console.log(phon);
	if(phon!='')
	{
           var ccc=json.check;
	
	if(ccc=="done")
	{
		alert("you hv tht number");
				$('#popup1').html("<center>user data is there in database</center>");
		openpopup('popup1');
		var t=setTimeout(function(){ popup1.style.visibility = "hidden";
	  bg.style.visibility = "hidden";},7000);
		
	}
	else
	{
		alert("no such tht number");
		$('#popup1').html("<center>No data found</center>");
		openpopup('popup1');
		var t=setTimeout(function(){ popup1.style.visibility = "hidden";
	  bg.style.visibility = "hidden";},7000);
		
	}
		
	}
	else
	{

	}
		setTimeout('cometpopup()', 1000);
		},
	error : function(XMLHttpRequest, textstatus, error) { 
					//alert(error);
					$('#send').html('ERROR');
					setTimeout('cometpopup()', 1000);
		
}
	
});
}
 
 
 
 
 
  