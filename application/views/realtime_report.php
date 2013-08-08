<?php include "header.php";?>
<table class="global-table-style">
   <tbody>
	<td style="float:left;" >Total calls - &nbsp;&nbsp;&nbsp;&nbsp;<a  href="#" >Answered calls -</a>&nbsp;&nbsp;&nbsp;&nbsp;<a  href="#">Abandon calls - </a>
</td>	 
 </tbody>
  </table> 
<div id="content" >
<div id="menu1"style="float:left;">

<div>
  <table width="100%"  align="left" class="global-table">
  <tr>
   <h3 align="center" style="margin-bottom:0;">
 Inbound Agent Status
</h3>
    </tr>
	
	
  <tr>
  <h3 align="center" style="margin-bottom:0;">
 Billing
</h3>
    
  </tr>
<tbody>
 <tr>
<th>Sip</th>
<th>Agent</th>
<th>Status</th>

  </tr>
  <? if(!empty($realtime)){ 
     foreach($realtime as $value) : ?>
  <tr>
    
  </tr>
  
  <?php endforeach; ?>
   <? } else { ?>
    <tr>
      <td colspan="3">No Records</td>
    </tr>
  <? } ?>
</tbody>             
   </table> 
</div>   
 <div>
  <table width="100%"  align="left" class="global-table">
  
  <tr>
<h3 align="center" style="margin-bottom:0;">
 Technical
</h3>
</tr>

<tbody>
 <tr>
 <th>Sip</th>
<th>Agent</th>
<th>Status</th>

  </tr>
   <? if(!empty($realtime)){ 
     foreach($realtime as $value) :  ?>
  <tr>
    
  </tr>
  
  <?php endforeach; ?>
   <? } else { ?>
    <tr>
      <td colspan="3">No Records</td>
    </tr>
  <? } ?>
  </tbody>
  </table></div>
 

  <div>
  <table width="100%"  align="center"  class="global-table">
  <tr>
   <h3 align="center" style="margin-bottom:5;">
 Outbound Agent Status
</h3>
    </tr>
    
    <tbody>
 <tr>
 <th>Sip</th>
<th>Agent</th>
<th>Status</th>

  </tr>
   <? if(!empty($realtime)){ 
     foreach($realtime as $value) :  ?>
  <tr>
    
  </tr>
  <tr>
    
  </tr>
  <?php endforeach; ?>
   <? } else { ?>
    <tr>
      <td colspan="3">No Records</td>
    </tr>
  <? } ?>
  </table> 
</tbody>  
  </div>
  </div>
  
  
  <div id="content1" style="float:left">
    <div>
	<table width="100%"  class="global-table">
  <tr>
  <h3 align="center" style="margin-bottom:0;">
    Real Time Status
</h3>
    </tr>
 
  

<tbody>
 <tr>
<th>Queue</th>
<th>LoggedIn</th>
<th>Available</th>
<th>Calls In Queue</th>
</tr>
   <? if(!empty($realtime)){ 
     foreach($realtime as $value) :  ?>
  <tr>
    
  </tr>
  
  <?php endforeach; ?>
   <? } else { ?>
    <tr>
      <td colspan="4">No Records</td>
    </tr>
  <? } ?>
  </tbody>
  </table> 
  </div> 
  <div>
  <table width="100%"  class="global-table">
  <tr>
   <h3 align="center" style="margin-bottom:0;">
        Live Calls
</h3>
   </tr>
  
<tr>
<tbody>
 <tr>
 <th>Call Time</th>
<th>Queue</th>
<th>Agent</th>
<th>Caller Id</th>
<th>Call Duration</th>

</tr>
   <? if(!empty($realtime)){ 
     foreach($realtime as $value) :  ?>
  <tr>
    
  </tr>
  <tr>
    
  </tr>
  <?php endforeach; ?>
   <? } else { ?>
    <tr>
      <td colspan="5">No Records</td>
    </tr>
  <? } ?>
  </tbody>             
  </tr>
  </table> 
  </div> 
  <div>
  <table width="100%"  class="global-table">
  <tr>
   <h3 align="center" style="margin-bottom:0;">
        Calls Waiting
</h3>
   </tr>
  
<tbody>
 <tr>
 <th>Call Time</th>
<th>Queue</th>
<th>Caller Id</th>
</tr>
   <? if(!empty($realtime)){ 
     foreach($realtime as $value) :  ?>
  <tr>
    
  </tr>
  <tr>
    
  </tr>
  <?php endforeach; ?>
   <? } else { ?>
    <tr>
      <td colspan="3">No Records</td>
    </tr>
  <? } ?>
  </tbody>
  </table> 
  </div> 
    
  <div>
  <table width="100%"  class="global-table">
  <tr>
   <h3 align="center" style="margin-bottom:0;">
Live Outbound Calls
</h3>
   </tr>
  
<tbody>
 <tr>
 <th>Call Time</th>
<th>Caller Id</th>
<th>Destination</th>
<th>Status</th>
</tr>
   <? if(!empty($realtime)){ 
     foreach($realtime as $value) :  ?>
  <tr>
    
  </tr>
  <tr>
    
  </tr>
  <?php endforeach; ?>
   <? } else { ?>
    <tr>
      <td colspan="4">No Records</td>
    </tr>
  <? } ?>
  </tbody>             
  
  </table> 
  </div> 

  </div> 
 
  </div>

<?php include "footer.php";?>
