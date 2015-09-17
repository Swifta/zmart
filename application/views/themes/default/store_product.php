<div class="contianer_outer1">
    <div class="contianer_inner">
        <div class="contianer">
            <div class="bread_crumb">
                <ul>
                    <li><p><a href="<?php echo PATH; ?>" title="<?php echo $this->Lang['HOME']; ?>"><?php echo $this->Lang['HOME']; ?></a></p></li>
                    <li><p><a href="<?php echo PATH; ?>stores.html" title="<?php echo $this->Lang['STORES']; ?>"><?php echo $this->Lang['STORES']; ?></a></p></li>
                    <?php foreach ($this->get_store_details as $store) { ?>
                        <li><p><?php echo ucfirst($store->store_name); ?></p></li>
                    <?php } ?>
                </ul>
            </div>
            <div  id="messagedisplay1" style="display:none;">      
                <div class="session_wrap">
                    <div class="session_container">
                        <div class="success_session">
                            <p><span ><?php echo $this->Lang['COMM_POST_SUCC']; ?>.</span></p>
                            <div class="close_session_2">
                                <a class="closestatus cur" title="<?php echo $this->Lang['CLOSE']; ?>"  onclick="return closeerr();" >&nbsp;</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="store_detail_block">
				<div class="store_lists_block ">
					 <div class="store_slide_list clearfix">
						<h2 class="inner_commen_title" style="text-transform:uppercase;"><?php echo $this->Lang['PRODUCTS']; ?></h2>
						<div class="pro_mid store_product_lisitng" id="product">
							<?php echo new View("themes/" . THEME_NAME . "/store_product_list"); ?>
						</div>
					</div>
				</div>
			</div>
			 <?php if(($this->all_products_count > 1)) { ?>
				<div id="loading">
				<?php if (($this->pagination) != "") { ?>
						<div class="feature_viewmore">
							<div class="fea_view_more">                                                
								<a class="view_more view_more1 view_more_but">
									<span class="view_more_icon">&nbsp;</span><?php echo $this->Lang['SEE_M_PROD']; ?><span class="view_more_icon">&nbsp;</span>
								</a> 
							</div>
						</div>
					<?php } ?>
					</div>
			<?php } ?>
		</div>
	</div>
</div>
<input type="hidden" name="offset" id="offset" value="12">
<input type="hidden" name="record" id="record" value="12">
<input type="hidden" name="record" id="record1" value="<?php echo $this->all_products_count; ?>">
<script>
$(document).ready(function() {
	$('a.view_more1').live("click", function(e) {
		var offset = 0;
		offset = document.getElementById('offset').value;
		var record = document.getElementById('record').value;
		var record1 = document.getElementById('record1').value;
		var url = '<?php echo PATH; ?>' + '/stores/all_product_list/<?php echo $this->storeurl;?>/'+ offset + '/' + record+'/'+'<?php echo $this->cat_type; ?>'+'/'+'<?php echo $this->category_url; ?>'+'/'+'<?php echo $this->search_key;?>' + '/' + '<?php echo $this->search_cate_id;?>';
		$.post(url, function(check) {
			if (check) {
				$('#product').append(check);
				$('#loading').show();
				$('.wloader_img').hide();
				offset = parseInt(offset) + 12;
				$("#offset").val(offset);
				if (offset >= record1) {
					$('#loading').hide();
				}
			} 
		});  
	}); 
});
</script>
