<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
    <head>
        <script>
            var baseUrl = "<?php echo base_url(); ?>";
        </script>
        <meta charset="utf-8">
              <?php $version = time(); ?>
            <script src="<?php echo base_url(); ?>js/jquery1.5.1.min.js" type="text/javascript"></script>
            <script src="<?php echo base_url() ?>js/jquery-ui-1.8.10.custom.min.js" type="text/javascript"></script>
            <script  src="<?php echo base_url(); ?>js/jquery.multiselect2side.js" type="text/javascript" ></script>
            <script src="<?php echo base_url() ?>js/autocomplete-jquery.js" type="text/javascript"></script>
            <script src="<?php echo base_url() ?>js/jquery.validate.js" type="text/javascript"></script>

            <script src="<?php echo base_url() ?>js/helper.js?<? echo $version ?>" type="text/javascript"></script>
            <script src="<?php echo base_url() ?>js/admin.js?<? echo $version ?>" type="text/javascript"></script>
             <script src="<?php echo base_url() ?>js/agent.js?<? echo $version ?>" type="text/javascript"></script>


            
            <link href="<?php echo base_url(); ?>css/style.css?<? echo $version ?>" rel="stylesheet" type="text/css" />
            <link href="<?php echo base_url(); ?>css/menu.css?<? echo $version ?>" rel="stylesheet" type="text/css" />
            <link href="<?php echo base_url(); ?>css/jquery-ui-1.8.10.custom.css" rel="stylesheet" type="text/css" />
            <link href="<?php echo base_url(); ?>css/jquery-autocomplete.css" rel="stylesheet" type="text/css" />            
            <link  href="<?php echo base_url(); ?>css/jquery.multiselect2side.css" rel="stylesheet" type="text/css" media="screen" />
            <link  href="<?php echo base_url(); ?>css/admin.css?<? echo $version ?>" rel="stylesheet" type="text/css" />            
    </head>

    <body>
        <div class="overall-container">
            <div id="header">
                <div class="logo">
                    <label><a href="<?php echo base_url(); ?>" class="logo-no"><img src='<?php echo base_url() . 'css/images/asterfone.png' ?>' width='220px' height='46px' /> </a></label>
                </div>
                <?
                if ($this->session->userdata('logged_in')) {
                    $base = base_url() . 'index.php';
                    $current = current_url();
                    if ($current == $base) {
                        redirect('login/checkSession');
                    }
                    ?>
                    <div class="logged-in-name">	       
    <? $sessionValues = $this->session->userdata('logged_in'); ?>
                        <span class='welcome-msg'>Welcome:</span>
                        <a href='<? echo base_url() . 'index.php/login/profile' ?>' title='profile' ><? echo $sessionValues['first_name']; ?></a>

                    </div>
                    <div class='logout-container'><a href='<? echo base_url() . 'index.php/login/logout' ?>' class='logout' title='logout' >logout</a></div>
                    <? if ($sessionValues['role'] == 'Administrator') { ?>
                        <?php include "menu.php"; ?>  
                    <? } ?>	  
<? } ?>  		
            </div>

            <div class="content-container">



