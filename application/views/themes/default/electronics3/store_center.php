  <div class="electronics_banner">
                <div class="electronics_menu">
                    <ul class="head_menu head_menu1 bold"> 
                        <h2 class="all_menu">
                            <a href="#" title="All">All</a>
                        </h2>
                    <li <?php
                            if (isset($this->is_home)) {
                                    echo "class='active'";
                            }
                            ?>>

                            <a class="hmenu" href="<?php echo PATH.$this->storeurl; ?>" title="<?php echo $this->Lang['HOME']; ?>"><?php echo $this->Lang['HOME']; ?>
                            </a>
                    </li>
                    <?php if ($this->product_setting) { ?>
                    <li class="<?php if (isset($this->is_product)) echo "active"; ?>"> <a class="hmenu" href="<?php echo PATH.$this->storeurl; ?>/products.html" title="<?php echo $this->Lang['PRODUCTS']; ?>"><?php echo $this->Lang['PRODUCTS']; ?></a>
                     <div class="sub_cate_list_show">
                            <div class="sub_cate_list_show_inner">  
								<?php if($this->categeory_list_product){  
									foreach ($this->categeory_list_product as $d) {
										$check_sub_cat = $d->product_count;
										if(($check_sub_cat !=-1 )&&($check_sub_cat !=0)) { ?>
											<div class="sub_list_shw">
												<h2><?php echo ucfirst($d->category_name); ?></h2>
												<ul>
													<?php if(count($this->subcategories_list)>0){
														$hdn_second_cnt = 1;
														foreach($this->subcategories_list as $sub_cate){
															if($sub_cate->main_category_id == $d->category_id){
																if($hdn_second_cnt<5){?>
																<li><a href="javascript:filtercategory_store('<?php echo $sub_cate->category_url; ?>', 'products', '<?php echo base64_encode("sub"); ?>','<?php echo $this->storeurl; ?>');" title="<?php echo ucfirst($sub_cate->category_name);?>"><?php echo ucfirst($sub_cate->category_name);?></a></li> 
													<?php $hdn_second_cnt++;}
													if($hdn_second_cnt==5){?>
													<li class="cate_view_more"><a href="javascript:filtercategory_store('<?php echo $d->category_url; ?>', 'products', '<?php echo base64_encode("main"); ?>','<?php echo $this->storeurl; ?>');" title="<?php echo ucfirst($sub_cate->category_name);?>"><?php echo $this->Lang['VIW_MRE'];?></a></li> 
													<?php break;}
													}
													
													}
													}?>
												</ul>
												<div class="sub_list_ad_part">
													<?php if(file_exists(DOCROOT.'images/category/icon/'.$d->category_url.'.png')){ ?>
													   <img alt="" src="<?php echo PATH.'images/category/icon/'.$d->category_url.'.png'; ?>"/><?php }?>
												</div>
											</div>
									<?php }}}?>
                            </div>  
                        </div>
            </li>



<?php } ?>

<?php if ($this->deal_setting) { ?>
		<li class="<?php if (isset($this->is_todaydeals)) echo "active"; ?> "><a class="hmenu" href="<?php echo PATH.$this->storeurl; ?>/today-deals.html" title="<?php echo $this->Lang['DEALS']; ?>">

				<?php echo $this->Lang['DEALS']; ?>

			</a>
                  <div class="sub_cate_list_show">
			<div class="sub_cate_list_show_inner">  
				<?php if($this->categeory_list_deal){  
					foreach ($this->categeory_list_deal as $d) {
						$check_sub_cat = $d->deal_count;
						if(($check_sub_cat !=-1 )&&($check_sub_cat !=0)) { ?>
							<div class="sub_list_shw">
								<h2><?php echo ucfirst($d->category_name); ?></h2>
								<ul>
									<?php if(count($this->subcategories_list)>0){
										$hdn_second_cnt = 1;
										foreach($this->subcategories_list as $sub_cate){
											if($sub_cate->main_category_id == $d->category_id){
												if($hdn_second_cnt<5){?>
												<li><a href="javascript:filtercategory_store('<?php echo $sub_cate->category_url; ?>', 'deal', '<?php echo base64_encode("sub"); ?>','<?php echo $this->storeurl; ?>');" title="<?php echo ucfirst($sub_cate->category_name);?>"><?php echo ucfirst($sub_cate->category_name);?></a></li> 
									<?php $hdn_second_cnt++;}
									if($hdn_second_cnt==5){?>
									<li class="cate_view_more"><a href="javascript:filtercategory_store('<?php echo $d->category_url; ?>', 'deal', '<?php echo base64_encode("main"); ?>','<?php echo $this->storeurl; ?>');" title="<?php echo ucfirst($sub_cate->category_name);?>"><?php echo $this->Lang['VIW_MRE'];?></a></li> 
									<?php break;}
									}
									
									}
									}?>
								</ul>
								<div class="sub_list_ad_part">
									<?php if(file_exists(DOCROOT.'images/category/icon/'.$d->category_url.'.png')){ ?>
									   <img alt="" src="<?php echo PATH.'images/category/icon/'.$d->category_url.'.png'; ?>"/><?php }?>
								</div>
							</div>
					<?php }}}?>
			</div>  
		</div>
                </li>
<?php } ?>
<?php if ($this->auction_setting) { ?>
<li class="<?php if (isset($this->is_auction)) echo "active"; ?>"><a class="hmenu" href="<?php echo PATH.$this->storeurl; ?>/auction.html" title="<?php echo $this->Lang['AUCTION']; ?>">
				<?php echo $this->Lang['AUCTION']; ?>
			</a>
                   <div class="sub_cate_list_show">
			<div class="sub_cate_list_show_inner">  
				<?php if($this->categeory_list_auction){  
					foreach ($this->categeory_list_auction as $d) {
						$check_sub_cat = $d->auction_count;
						if(($check_sub_cat !=-1 )&&($check_sub_cat !=0)) { ?>
							<div class="sub_list_shw">
								<h2><?php echo ucfirst($d->category_name); ?></h2>
								<ul>
									<?php if(count($this->subcategories_list)>0){
										$hdn_second_cnt = 1;
										foreach($this->subcategories_list as $sub_cate){
											if($sub_cate->main_category_id == $d->category_id){
												if($hdn_second_cnt<5){?>
												<li><a href="javascript:filtercategory_store('<?php echo $sub_cate->category_url; ?>', 'auction', '<?php echo base64_encode("sub"); ?>','<?php echo $this->storeurl; ?>');" title="<?php echo ucfirst($sub_cate->category_name);?>"><?php echo ucfirst($sub_cate->category_name);?></a></li> 
									<?php $hdn_second_cnt++;}
									if($hdn_second_cnt==5){?>
									<li class="cate_view_more"><a href="javascript:filtercategory_store('<?php echo $d->category_url; ?>', 'auction', '<?php echo base64_encode("main"); ?>','<?php echo $this->storeurl; ?>');" title="<?php echo ucfirst($sub_cate->category_name);?>"><?php echo $this->Lang['VIW_MRE'];?></a></li> 
									<?php break;}
									}
									
									}
									}?>
								</ul>
								<div class="sub_list_ad_part">
									<?php if(file_exists(DOCROOT.'images/category/icon/'.$d->category_url.'.png')){ ?>
									   <img alt="" src="<?php echo PATH.'images/category/icon/'.$d->category_url.'.png'; ?>"/><?php }?>
								</div>
							</div>
					<?php }}}?>
			</div>  
		</div>
		</li>
<?php } ?>
	<?php if ($this->past_deal_setting) { ?>

		<li <?php
			if (isset($this->is_soldout)) {
				echo "class='active'";
			}
			?>>
			<a   class="hmenu" href="<?php echo PATH.$this->storeurl; ?>/soldout.html" title=" <?php echo $this->Lang['SOLD_OUT2']; ?>">
				<?php echo $this->Lang['SOLD_OUT2']; ?>
			</a>

		</li>
	<?php } ?>

	<?php if ($this->store_setting) { ?>
		<li <?php
			if (isset($this->is_store)) {
				echo "class='active'";
			}
			?>>
			<a  class="hmenu" href="<?php echo PATH; ?>stores.html" title="<?php echo $this->Lang['STORES']; ?>">
				<?php echo $this->Lang['STORES']; ?>
			</a></li>
	<?php } ?>

	<?php if (($this->deal_setting == 1 || $this->product_setting == 1 || $this->auction_setting == 1 ) && $this->map_setting) { ?>
		<li <?php
			if (isset($this->is_map)) {
				echo "class='active'";
			}
			?>>

			<a class="hmenu" href="<?php echo PATH; ?>near-map.html" title="<?php echo $this->Lang['NEAR_MAP']; ?>">
				<?php echo $this->Lang['NEAR_MAP']; ?>
			</a>

		</li>
	<?php } ?>

	<?php if ($this->blog_setting) { ?>
		<li <?php
			if (isset($this->is_blog)) {
				echo "class='active'";
			}
			?>>
			<a  class="hmenu" href="<?php echo PATH; ?>blog" title="<?php echo $this->Lang['BLOG']; ?>">
				<?php echo $this->Lang['BLOG']; ?>
			</a>
		</li>
<?php } ?>
</ul>
                                        
           </div>       
            <!-- banner start-->
       
            <div class="banner">
                                <div class="slider_home">
									<?php
       $banner_check = 0;
        if(count($this->merchant_personalised_details)>0) { 
	foreach($this->merchant_personalised_details as $m) { 
		?>
		<div class="images wloader_parent">
									<?php $tabs=0;for ($i = 1; $i <= 3; $i++)
									{?> 
										<?php if (file_exists(DOCROOT . 'images/merchant/banner/' . $m->storeid.'_'.$m->sector_name.'_'.$i.'_banner.png')) { 
											$banner_link="";
											if($m->banner_1_link !="" || $m->banner_2_link !="" || $m->banner_3_link !="") { $banner_check = 1;
											if($i==1) { $banner_link = $m->banner_1_link; } else if($i==2) { $banner_link = $m->banner_2_link; } else if($i==3) { $banner_link = $m->banner_3_link; }}  ?>
										
                                        <i class="wloader_img" style="min-height: 525px;">&nbsp;</i>   
                                        <div style="display: none;">                                                                                
                                            <a href="<?php echo $banner_link; ?>"  title = "<?php echo $banner_link; ?>">
                                                <img alt="<?php echo $this->Lang['LOGO']; ?>" src="<?php echo PATH; ?>images/merchant/banner/<?php echo $m->storeid.'_'.$m->sector_name.'_'.$i.'_banner.png'; ?>"/>
                                            </a>
                                        </div>
                                        <?php $tabs++;}?>
                                            
                                    
                                   <?php }
                                   if($tabs==0){ ?>
                                   <img alt="Banner image" src="<?php echo PATH; ?>themes/<?php echo THEME_NAME ?>/images/banner_noimage.png"/>
                                            <?php } ?>
                                   </div>      
                                            <div class="controls">                                                    
                                                    <div class="slidetabs">
						<?php for ($i = 1; $i <= $tabs; $i++) { if (file_exists(DOCROOT . 'images/merchant/banner/' .$m->storeid.'_'.$m->sector_name.'_'.$i.'_banner.png')) { ?>
                                                       <a href="" class="slider_dot current">&nbsp;</a>
                                                        <?php } } ?>
                                                    </div>                                                                                                   
                                            </div>
                                            <?php }  } ?> 
                                    </div>
            </div>
            <?php /* 
            if(count($this->merchant_personalised_details)==0){  ?>
             <div class="banner">
                <div class="slider_home">
                    <img alt="Banner image" src="<?php echo PATH; ?>themes/<?php echo THEME_NAME ?>/images/banner_noimage.png"/>
                </div>
            </div>
            <?php }*/?>
                          
            </div>
             <?php $ads_check = 0;
             if(count($this->merchant_personalised_details)>0) { 
	foreach($this->merchant_personalised_details as $m) {
		  ?>        
            <div class="advertice_part">
                <ul>
					<?php for ($i = 1; $i <= 2; $i++) { ?>
										<?php if (file_exists(DOCROOT . 'images/merchant/ads/' . $m->storeid.'_'.$m->sector_name.'_'.$i.'_ads.png')) { 
											$ads_link="";
											if($m->ads_1_link !="" || $m->ads_2_link !="" || $m->ads_3_link !="") { $ads_check = 1; 
											if($i==1) { $ads_link = $m->ads_1_link; } else if($i==2) { $ads_link = $m->ads_2_link; } else if($i==3) { $ads_link = $m->ads_3_link; }}  ?>
                    <li>
                        <div class="advertice_inner">
                            <a href="<?php echo $ads_link; ?>" title="<?php echo $ads_link; ?>">
                              <img alt="" src="<?php echo PATH; ?>images/merchant/ads/<?php echo $m->storeid.'_'.$m->sector_name.'_'.$i.'_ads.png'; ?>"/>  
                            </a>
                        </div>
                    </li>
                    <?php }else{?>
                    <li><img alt="add image" src="<?php echo PATH; ?>themes/<?php echo THEME_NAME ?>/images/add_noimage.png"/></li>
                    
                    <?php  }} ?>
                </ul>  
            </div>
            <?php  } } ?>
          <?php /*if($ads_check==0){?>
            <div class="empty_add">
                <ul>
                    
                    <li><img alt="add image" src="<?php echo PATH; ?>themes/<?php echo THEME_NAME ?>/images/add_noimage.png"/></li>
                </ul>
            </div>
			<?php }*/?>
