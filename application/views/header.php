<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
    <head>
        <script>
            var baseUrl = "<?php echo base_url(); ?>";
        </script>
        <meta charset="utf-8">

            <link href="<?php echo base_url(); ?>css/style.css" rel="stylesheet" type="text/css" />
            <link href="<?php echo base_url(); ?>css/menu.css" rel="stylesheet" type="text/css" />
            <link href="<?php echo base_url(); ?>css/jquery-ui-1.8.10.custom.css" rel="stylesheet" type="text/css" />

         
            <script src="<?php echo base_url() ?>js/jquery-1.9.1.js" type="text/javascript"></script>             
	    <script src="<?php echo base_url() ?>js/jquery-ui.1.10.3.js" type="text/javascript"></script>

	    <script src="<?php echo base_url() ?>js/helper.js" type="text/javascript"></script>
	    

    </head>

    <body>
    <div class="overall-container">
        <div id="header">
	      <div class="logo">
                 <label><a href="<?php echo base_url(); ?>" class="logo-no"><img src='<?php echo base_url().'css/images/asterfone.png'?>' width='220px' height='46px' /> </a></label>
	      </div>
	      <? if($this->session->userdata('logged_in')) { ?>
	      <div class="logged-in-name">
	       
		  <? $sessionValues = $this->session->userdata('logged_in'); ?>
		  <span class='welcome-msg'>Welcome:</span>
		  <a href='<? echo base_url().'index.php/login/profile' ?>' title='profile' ><? echo $sessionValues['first_name']; ?></a>
		      
		  </div>
		  <div class='logout-container'><a href='<? echo base_url().'index.php/login/logout' ?>' class='logout' title='logout' >logout</a></div>

	  <?php include "menu.php";?>  
	<? } ?>  		
        </div>
    
        <div class="content-container">
        


