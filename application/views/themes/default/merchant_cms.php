<?php defined('SYSPATH') OR die('No direct access allowed.'); ?>
<?php if(count($this->merchant_cms)>0) { foreach($this->merchant_cms as $d){  ?>
        <div class="contianer_outer1">
            <div class="contianer_inner">
                <div class="bread_crumb">
                        <ul>
                            <li><p><a href="<?php echo PATH;?>" title="<?php echo $this->Lang['HOME']; ?>"><?php echo $this->Lang["HOME"]; ?></a></p></li>
                            <?php if($d->terms_conditions_status==1 && $this->type==3) { ?>
                            <li><p><?php echo $this->Lang["SHIP_ING"];; ?></p></li>
                            <?php } ?>
                             <?php if($d->return_policy_status==1 && $this->type==2) { ?>
                            <li><p><?php echo $this->Lang["RET_POLICY"]; ?></p></li>
                            <?php } ?>
                             <?php if($d->warranty_status==1 && $this->type==1) { ?>
                            <li><p><?php echo $this->Lang["WARRANTY"];; ?></p></li>
                            <?php } ?>
                        </ul>
                    </div>
                <div class="contianer">
                    <!--content start-->
                    <div class="content_abouts">
                        <div class="content_abou_common">                             
                            <h2 class="inner_commen_title">
								<?php if($d->terms_conditions_status==1 && $this->type==3) { ?>
								<?php echo $this->Lang["SHIP_ING"];; ?>
								  <?php } ?>
                             <?php if($d->return_policy_status==1 && $this->type==2) { ?>
                             <?php echo $this->Lang["RET_POLICY"]; ?>
								  <?php } ?>
								  <?php if($d->warranty_status==1 && $this->type==1) { ?>
                             <?php  echo $this->Lang["WARRANTY"]; ?>
								  <?php } ?>
                             
								</h2>                                                        
                            <div class="content_abou_text">
							 <?php if($d->terms_conditions_status==1 && $this->type==3) { ?>
                            <p><?php echo $d->terms_conditions;?></p>
                            <?php } ?>
                             <?php if($d->return_policy_status==1 && $this->type==2) { ?>
                            <p><?php echo $d->return_policy;?></p>
                            <?php } ?>
                             <?php if($d->warranty_status==1 && $this->type==1) { ?>
                            <p><?php echo $d->warranty;?></p>
                            <?php } ?>
				
                            </div>
                        </div>  
                    </div>
                    <!--end-->
                </div>
            </div>
        </div>
  <?php  } }  ?>
