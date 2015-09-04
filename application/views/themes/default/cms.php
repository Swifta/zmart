<?php defined('SYSPATH') OR die('No direct access allowed.'); ?>
<?php foreach($this->cms as $d){  ?>
        <div class="contianer_outer1">
            <div class="contianer_inner">
                <div class="bread_crumb">
                        <ul>
                            <li><p><a href="<?php echo PATH;?>" title="<?php echo $this->Lang['HOME']; ?>"><?php echo $this->Lang["HOME"]; ?></a></p></li>
                            <li><p><?php echo $d->cms_title;?></p></li>
                        </ul>
                    </div>
                <div class="contianer">
                    <!--content start-->
                    <div class="content_abouts">
                        <div class="content_abou_common">                             
                            <h2 class="inner_commen_title"><?php echo strtoupper($d->cms_title);?></h2>                                                        
                            <div class="content_abou_text">
				<p><?php echo $d->cms_desc;?></p>
                            </div>
                        </div>  
                    </div>
                    <!--end-->
                </div>
            </div>
        </div>
  <?php  }  ?>
