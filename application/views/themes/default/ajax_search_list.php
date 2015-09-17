<?php defined('SYSPATH') OR die('No direct access allowed.'); ?>

<?php  //  For home page search start   ?>

 <?php if($this->type == 0) { ?>

<p id="searchresults">

					<!-- for Product  -->
					
					        <?php  foreach($this->search_category  as $ca ) { 
					                if(($ca->main_category_id == "0")&&($ca->product == "1")){ 
					        ?>
                                        
					        <?php $type = "products";  $categories = $ca->category_url; 
					        $check_sub_cat = common::get_subcat_count($ca->category_id, 3, "main", $ca->category_url);
					        ?>
					        
						 <a class="category_list" onclick="filtercategory('<?php echo $categories; ?>', '<?php echo $type; ?>', '<?php echo base64_encode("main"); ?>');" title="<?php echo ucfirst($ca->category_name) . ' (' . $check_sub_cat . ')'; ?>"><?php echo ucfirst($ca->category_name) . ' (' . $check_sub_cat . ')'; ?></a>
						 <?php } } ?>
						 
						 <?php if(count($this->products_details)) { ?>
						 
                                                <span class="category_sub_list_title">
                                                    <b><?php echo $this->Lang['POP_PRODUCT']; ?></b> 
                                                </span>
						 
						 <?php
							foreach ($this->products_details as $p) {
							$symbol = CURRENCY_SYMBOL;
						 ?>		
                                                 <span class="category_sub_list">
                                                     <artical class="search_list_img">
							<a href="<?php echo PATH . $p->store_url_title.'/product/' . $p->deal_key . '/' . $p->url_title . '.html'; ?>"  title="<?php echo $p->deal_title; ?>" >
							<?php if (file_exists(DOCROOT . 'images/products/1000_800/' . $p->deal_key . '_1' . '.png')) { ?>
							
							<img src="<?php echo PATH . 'images/products/1000_800/' . $p->deal_key . '_1' . '.png'; ?>" border="0" height="50px" width="50px" />
							<?php } else { ?>
							<img src="<?php echo PATH; ?>themes/<?php echo THEME_NAME; ?>/images/noimage_products_list.png" height="50px" width="50px" />
						<?php } ?>
                                                        </a>
                                                     </artical>
					   
                                                <?php $name = $p->deal_title;
						 if(strlen($name) > 40) { 
							$name = substr($name, 0, 40) . "...";
						 }?>  
                                                        
						 
						        
                                                     <artical class="search_list_info">
                                                <a href="<?php echo PATH. $p->store_url_title.'/product/'.$p->deal_key.'/'.$p->url_title.'.html';?>"  class="searchheading" > <?php echo $name; ?> </a>
                                                <br>
                                                <?php $type="products"; $categories=$p->category_url; ?>
                                                <a class="search_category_link" onclick="filtercategory('<?php echo $categories; ?>', '<?php echo $type; ?>', '<?php echo base64_encode("main"); ?>');" title="<?php echo ucfirst($p->category_name); ?>"><?php echo ucfirst($p->category_name); ?> </a>                                                
                                                <span class="search_list_price">
                                                         <b><?php echo $symbol."".$p->deal_value; ?></b>
                                                        <a class="buy_it list_buy_it" href="<?php echo PATH. $p->store_url_title.'/product/'.$p->deal_key.'/'.$p->url_title.'.html';?>" title="<?php echo $this->Lang['ADD_TO_CART']; ?>">
                                                        <?php echo $this->Lang['ADD_TO_CART']; ?></a>
                                                </span>
                                                     </artical>
					   </span>	
						<?php } ?>
                                                         					
					<?php } ?></p>
                                                        
<?php } ?>

<?php  //  For home page search end   ?>


<?php  //  For home page search start   ?>

 <?php if($this->type == 1  ) { ?>

<p id="searchresults">

					<!-- for Product  -->
					
					        <?php  foreach($this->search_category  as $ca ) { 
					                if(($ca->main_category_id == "0")&&($ca->product == "1")){ 
					        ?>
                                        
					        <?php $type = "products";  $categories = $ca->category_url; 
					        $check_sub_cat = common::get_subcat_count($ca->category_id, 3, "main", $ca->category_url);
					        ?>
						 <a class="category_list" onclick="filtercategory('<?php echo $categories; ?>', '<?php echo $type; ?>', '<?php echo base64_encode("main"); ?>');" title="<?php echo ucfirst($ca->category_name) . ' (' . $check_sub_cat . ')'; ?>"><?php echo ucfirst($ca->category_name) . ' (' . $check_sub_cat . ')'; ?></a>
						 <?php } } ?>
						 <?php if(count($this->products_details)) { ?>
                                                <span class="category_sub_list_title">
                                                    <b><?php echo $this->Lang['POP_PRODUCT']; ?></b>
                                                </span>
						 
						 <?php
							foreach ($this->products_details as $p) {
							$symbol = CURRENCY_SYMBOL;
						 ?>		
                                                 <span class="category_sub_list">
                                                     <artical class="search_list_img">
							<a href="<?php echo PATH . $p->store_url_title.'/product/' . $p->deal_key . '/' . $p->url_title . '.html'; ?>"  title="<?php echo $p->deal_title; ?>" >
							<?php if (file_exists(DOCROOT . 'images/products/1000_800/' . $p->deal_key . '_1' . '.png')) { ?>
							
							<img src="<?php echo PATH . 'images/products/1000_800/' . $p->deal_key . '_1' . '.png'; ?>" border="0" height="50px" width="50px" />
							<?php } else { ?>
							<img src="<?php echo PATH; ?>themes/<?php echo THEME_NAME; ?>/images/noimage_products_list.png" height="50px" width="50px" />
						<?php } ?>
                                                        </a>
                                                     </artical>
					   
                                                <?php $name = $p->deal_title;
						 if(strlen($name) > 40) { 
							$name = substr($name, 0, 40) . "...";
						 }?>  
                                                        
						 
						        
                                                     <artical class="search_list_info">
                                                <a href="<?php echo PATH. $p->store_url_title.'/product/'.$p->deal_key.'/'.$p->url_title.'.html';?>"  class="searchheading" > <?php echo $name; ?> </a>
                                                <br>
                                                <?php $type="products"; $categories=$p->category_url; ?>
                                                <a class="search_category_link" onclick="filtercategory('<?php echo $categories; ?>', '<?php echo $type; ?>', '<?php echo base64_encode("main"); ?>');" title="<?php echo ucfirst($p->category_name); ?>"><?php echo ucfirst($p->category_name); ?> </a>                                                
                                                <span class="search_list_price">
                                                         <b><?php echo $symbol."".$p->deal_value; ?></b>
                                                        <a class="buy_it list_buy_it" href="<?php echo PATH. $p->store_url_title.'/product/'.$p->deal_key.'/'.$p->url_title.'.html';?>" title="<?php echo $this->Lang['ADD_TO_CART']; ?>">
                                                        <?php echo $this->Lang['ADD_TO_CART']; ?></a>
                                                </span>
                                                     </artical>
					   </span>	
						<?php } ?>
                                                         					
					<?php } ?></p>
                                                        
<?php } ?>

<?php  //  For home page search end   ?>




<?php  //  For Deals page search start   ?>

 <?php if($this->type == 2) { ?>


<p id="searchresults">
	
					<!-- for Deal  -->
					
						 <?php  foreach($this->search_category  as $ca ) { 
					                if(($ca->main_category_id == "0")&&($ca->deal == "1")){ 
					        ?>
                                        
                                        
					        <?php $type = "deal";  $categories = $ca->category_url; 
					        $check_sub_cat = common::get_subcat_count($ca->category_id, 2, "main", $ca->category_url);
					        ?>
						 <a class="category_list" href="javascript:filtercategory('<?php echo $categories; ?>', '<?php echo $type; ?>', '<?php echo base64_encode("main"); ?>');"  title="<?php echo ucfirst($ca->category_name) . ' (' . $check_sub_cat . ')'; ?>"><?php echo ucfirst($ca->category_name) . ' (' . $check_sub_cat . ')'; ?></a>
						 <?php } } ?>
						 <?php if(count($this->deals_details)) { ?>
                                                <span class="category_sub_list_title">
                                                    <b><?php echo $this->Lang['POP_DEAL']; ?></b>
                                                </span>
						 <?php
							   foreach ($this->deals_details as $d) {
							$symbol = CURRENCY_SYMBOL;
						 ?>
										
										<span class="category_sub_list">
                                                     <artical class="search_list_img">			
							<a href="<?php echo PATH .$d->store_url_title. '/deals/' . $d->deal_key . '/' . $d->url_title . '.html'; ?>"  title="<?php echo $d->deal_title; ?>" >
							<?php if (file_exists(DOCROOT . 'images/deals/1000_800/' . $d->deal_key . '_1' . '.png')) { ?>
							
							<img src="<?php echo PATH . 'images/deals/1000_800/' . $d->deal_key . '_1' . '.png'; ?>" border="0" height="50px" width="50px" />
							
							<?php } else { ?>
							<img src="<?php echo PATH; ?>themes/<?php echo THEME_NAME; ?>/images/noimage_deals_list.png" height="50px" width="50px" />
						<?php } ?>
						
						</a>
                                                     </artical>
					   
						 <?php $name = $d->deal_title;
						 if(strlen($name) > 40) { 
							$name = substr($name, 0, 40) . "...";
						 }     ?>  
						 
						 
						    <artical class="search_list_info">
                                                <a href="<?php echo PATH . $d->store_url_title. '/deals/' . $d->deal_key . '/' . $d->url_title . '.html'; ?>"  class="searchheading" > <?php echo $name; ?> </a>
                                                <br>
                                                <?php $type = "deal";  $categories = $d->category_url; ?>
                                                <a class="search_category_link" href="javascript:filtercategory('<?php echo $categories; ?>', '<?php echo $type; ?>', '<?php echo base64_encode("main"); ?>');" title="<?php echo ucfirst($d->category_name); ?>"><?php echo ucfirst($d->category_name); ?> </a>                                                
                                                <span class="search_list_price">
                                                         <b><?php echo $symbol."".$d->deal_value; ?></b>
                                                        <a class="buy_it list_buy_it" href="<?php echo PATH.$d->store_url_title. '/deals/'.$d->deal_key.'/'.$d->url_title.'.html';?>" title="<?php echo $this->Lang['BUY_NOW2']; ?>">
                                                        <?php echo $this->Lang['BUY_NOW2']; ?></a>
                                                </span>
                                                     </artical>
					   </span>	
					   
						<?php } ?>
						
					<?php } ?>
					
</p>
<?php } ?>

<?php  //  For Deals page search end   ?>


<?php  //  For Products page search start   ?>

 <?php if($this->type == 3 ) { ?>


<p id="searchresults">
	
<!-- for Auction  -->
					
					
						<?php  foreach($this->search_category  as $ca ) { 
					                if(($ca->main_category_id == "0")&&($ca->auction == "1")){ 
					        ?>
                                        
					        <?php $type = "auction";  $categories = $ca->category_url; 
					        $check_sub_cat = common::get_subcat_count($ca->category_id, 4, "main", $ca->category_url);
					        ?>
						 <a class="category_list" href="javascript:filtercategory('<?php echo $categories; ?>', '<?php echo $type; ?>', '<?php echo base64_encode("main"); ?>');" title="<?php echo ucfirst($ca->category_name) . ' (' . $check_sub_cat . ')'; ?>"><?php echo ucfirst($ca->category_name) . ' (' . $check_sub_cat . ')'; ?></a>
						 <?php } } ?>
						 <?php if(count($this->auction_details)) { ?>
                                                <span class="category_sub_list_title">
                                                    <b><?php echo $this->Lang['POP_AUCTION']; ?></b>
                                                </span>
                                                
						 <?php
							   foreach ($this->auction_details as $a) {
							$symbol = CURRENCY_SYMBOL;
						 ?>
										
										<span class="category_sub_list">
                                                     <artical class="search_list_img">			
							<a href="<?php echo PATH . $a->store_url_title. '/auction/' . $a->deal_key . '/' . $a->url_title . '.html'; ?>"  title="<?php echo $a->deal_title; ?>" >
							<?php if (file_exists(DOCROOT . 'images/auction/1000_800/' . $a->deal_key . '_1' . '.png')) { ?>
							
							<img src="<?php echo PATH . 'images/auction/1000_800/' . $a->deal_key . '_1' . '.png'; ?>" border="0" height="50px" width="50px" />
							
							<?php } else { ?>
							<img src="<?php echo PATH; ?>themes/<?php echo THEME_NAME; ?>/images/noimage_deals_list.png" height="50px" width="50px" />
						<?php } ?>
						
						</a>
                                                     </artical>
					   
						 <?php $name = $a->deal_title;
						 if(strlen($name) > 35) { 
							$name = substr($name, 0, 35) . "...";
						 }     ?>                
						 
						<artical class="search_list_info">
                                                <a href="<?php echo PATH . $a->store_url_title. '/auction/' . $a->deal_key . '/' . $a->url_title . '.html'; ?>"  class="searchheading" > <?php echo $name; ?> </a>
                                                <br>
                                                <?php $type="auction"; $categories=$a->category_url; ?>
                                                <a class="search_category_link" href="javascript:filtercategory('<?php echo $categories; ?>', '<?php echo $type; ?>', '<?php echo base64_encode("main"); ?>');" title="<?php echo ucfirst($a->category_name); ?>"><?php echo ucfirst($a->category_name); ?> </a>                                                
                                                <span class="search_list_price">
                                                         <b><?php echo $symbol."".$a->deal_price; ?></b>
                                                        <a class="buy_it list_buy_it" href="<?php echo PATH.$a->store_url_title. '/auction/'.$a->deal_key.'/'.$a->url_title.'.html';?>" title="<?php echo $this->Lang['BID_NOW1']; ?>">
                                                        <?php echo $this->Lang['BID_NOW1']; ?></a>
                                                </span>
                                                     </artical>
					   </span>	
					  
						<?php } ?>
					<?php } ?>
   

</p>
<?php } ?>

<?php  //  For Auction page search end   ?>
			

<script>
	$(document).click(function(){
  $('#suggestions').fadeOut();
});


</script>
