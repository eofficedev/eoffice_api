<?php
            $appconfig = $app_config->row();
        ?>
        
        <style type="text/css">
            .banner-link{
                color:white!important;
            }
            .banner-title{
                color:white!important;
            }
        </style>
<div class="enable-bootstrap"  style='background:#1a1a1a'>
    <div class="container">
        <div class=" row">
                <div class='col-lg-4' style='padding: 10px'>
                    <p class="banner-title">Related Links :</p>
                    <a class="banner-link" href="http://<?php echo $appconfig->link1; ?>"><?php echo $appconfig->link1_desc; ?></a> <br/><br/>
                    <a class="banner-link" href="http://<?php echo $appconfig->link2; ?>"><?php echo $appconfig->link2_desc; ?></a> <br/><br/>
                    
                </div>
                <div class='col-lg-4' style="padding:10px">
                    <p class="banner-title">Technical Support : </p>
                    <a class="banner-link" href="mailto:<?php echo $appconfig->tech_support; ?>"><?php echo $appconfig->tech_support; ?></a>
                </div>
                <!-- <div class='col-lg-4' style="padding:10px">
                    <p class="banner-title">Powered By :</p>
                    <img id="pic" src="<?php echo base_url("css")."/".$appconfig->logo_url; ?>" />
                </div>     -->
            
        </div>
        
    </div>
    
</div>
