<?php defined('SYSPATH') OR die('No direct access allowed.'); ?>
<?php /* Pagination */ ?>
	<script type="text/javascript">
$(document).ready(function () {
$('a.view_more').live("click", function(e){
        	var offset  = 0;
            offset = document.getElementById('offset').value;
            var record = document.getElementById('record').value;
	    	var record1 = document.getElementById('record1').value;
	    
			var url = '<?php echo PATH; ?>'+'auction/winner_pagination?offset='+offset+'&record='+record;
			$.post(url,function(check){ 
				if(check){ 
				  
				  $('#product').append(check);
				  $('#loading').show();
				  offset = parseInt(offset)+10;

				  $("#offset").val(offset);

				  if(offset >= record1 ) {

 				   $('#loading').hide();

				   }

				}
			});     
        
    });
});

</script>


	 </div> <!--for header -->
    </div>
</div>
<input type="hidden" name="offset" id="offset" value="10">
<input type="hidden" name="record" id="record" value="10">
<input type="hidden" name="record" id="record1" value="<?php echo $this->count; ?>">
<div class="contianer_outer">
            <div class="contianer_inner">

                <div class="contianer">
 <div class="bread_crumb">
            <ul>
                <li><p><a href="<?php echo PATH; ?>" title="<?php echo $this->Lang['HOME']; ?>"><?php echo $this->Lang['HOME']; ?></a></p></li>
                    <li><p><a href="<?php echo PATH;?>auction.html" title="<?php echo $this->Lang['AUCTION']; ?>"><?php echo $this->Lang['AUCTION']; ?></a></p></li>
				 <li><p><?php echo $this->Lang['WINNERS2']; ?></p></li>
            </ul>
			
        </div>

                    <!--content start-->
                    <div class="content">
                        <div class="winner_common" id="product">
							<?php echo new View("themes/".THEME_NAME."/auction/winner_list"); ?>
                        </div>

						 <?php  if(($this->uri->last_segment()=="winner.html")&&($this->count > 1)){ ?>
								 <div id="loading">
								  <?php if(($this->pagination) !=""){ ?> 
												            <div class="feature_viewmore">
												                <div class="fea_view_more">												                
												                    <a class="view_more view_more_but">
                                                                                                                        <span class="view_more_icon">&nbsp;</span><?php echo $this->Lang['VIW_MRE']; ?><span class="view_more_icon">&nbsp;</span>
                                                                                                                    </a>												                
                                                                                                                </div>
												            </div>
												              <?php }?>
								 </div>
						<?php  } ?> 
                    </div>
                    <!--end-->
                </div>
            </div>
        </div>

        
