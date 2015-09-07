<?php defined('SYSPATH') OR die('No direct access allowed.'); ?>
        <div class="contianer_outer1">
            <div class="contianer_inner">
<div class="bread_crumb">
                        <ul>
                            <li><p><a href="<?php echo PATH;?>" title="<?php echo $this->Lang['HOME']; ?>"><?php echo $this->Lang["HOME"]; ?></a></p></li>
                            <li><p><?php echo $this->Lang["ABT"]; ?></p></li>
                        </ul>
                    </div>
                <div class="contianer">
                    <!--content start-->
                    <div class="content_abouts">
                        <div class="content_abou_common">                            
                            <h2 class="inner_commen_title"><?php echo $this->Lang["ABT"]; ?></h2>                            
                            <div class="content_abou_text m_imagesize">
                                <?php foreach($this->about_us as $d){?>
                                <p class="aboutus"><?php echo $d->cms_desc;?></p>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                    <!--end-->
                </div>
            </div>
        </div>
