<?php defined('SYSPATH') OR die('No direct access allowed.'); ?>

        <div class="contianer_outer1">
            <div class="contianer_inner">

<div class="bread_crumb">
                        <ul>
                            <li><p><a href="<?php echo PATH;?>" title="<?php echo $this->Lang['HOME']; ?>"><?php echo $this->Lang["HOME"]; ?></a></p></li>
                            <li><p><?php echo $this->Lang['FAQ']; ?></p></li>
                        </ul>
                    </div>
                <div class="contianer">

                    <!--content start-->
                    <div class="content_abouts">
                        <div class="content_abou_common">
                            <div class="contact_form_new">

                                <div class="faq_container">
 
                     <h2 class="inner_commen_title"><?php echo $this->Lang['FAQ']; ?></h2>
                                                                                                                                                        

                                    <div class="faq_section1">
										<?php foreach($this->faq as $faq){ ?><h2><?php echo $faq->question; ?></h2><p><a><?php echo $faq->answer; ?></a></p><?php 	} ?>
                                       
                                      
                                    </div>
                                                                       
                                </div>
                            </div>
                            <div class="pro_tit_pagenation_1 mt20">
                                 <div class="pagenation">
				                     <?php echo $this->pagination; ?>
		                         </div>
		                    </div>	
                        </div>  
                    </div>
                    <!--end-->
                </div>
            </div>
        </div>

