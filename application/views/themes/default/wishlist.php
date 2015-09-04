<?php defined('SYSPATH') OR die('No direct access allowed.'); ?>
<div class="contianer_outer">
	<div class="contianer_inner">
		<div class="contianer">
		        <div class="bread_crumb">
			        <ul>
					<li><p><a href="<?php echo PATH; ?>" title="<?php echo $this->Lang['HOME']; ?>"><?php echo $this->Lang['HOME']; ?></a></p></li>
					<li><p><?php echo $this->Lang['WISH_LIST']; ?></p></li>
				</ul>
		        </div>
		        <!--content start-->
		        <div class="content">
		            <!--Blog content starts-->

				<div class="blog_left_inner_common_bor">
					<div class="blog_left_inner_common_bor">
						<div class="show_wishlist_title">							                                                
                                                        <h2><?php echo $this->Lang['WISH_LIST']; ?></h2>
                                                        <?php
                                                                if($this->user_wishlist_count) { ?>
                                                            <div class="show_wishlist_limit">
                                                                <label><?php echo $this->Lang['SHW']; ?>:</label>
                                                                    <select onchange="location = this.value;">
                                                                            <?php foreach($this->limit_value as $limit) { ?>
                                                                            <option value="<?php echo PATH; ?>wishlist.html?limit=<?php echo $limit; ?>" <?php if(isset($this->limit) && $this->limit== $limit) {?> selected <?php } ?>><?php echo $limit; ?></option>
                                                                            <?php } ?>
                                                                    </select>
                                                            </div>
                                                <?php } ?>                                                

							
						</div>
						
							<?php if($this->user_wishlist_count && count($this->user_wishlist_count) > 0) { ?>
                                                    <div class="payouter_block pay_br">
						        <div class="cart_table clearfix">                                                            
                                                                <table width="100%" cellspacing="0" cellpadding="5" border="0" class="mcart_table_inner">                                                                                                                                									 								
                                                                    <thead class="paybr_title pay_titlebg">
                                                                        <tr>
                                                                            <th align="left" width="100"><?php echo $this->Lang['IMAGE']; ?></th>
                                                                            <th align="left" width="100"><?php echo $this->Lang['TITLE']; ?></th>
                                                                            <th align="left" width="100"><?php echo "Top category"; ?></th>
                                                                            <th align="left" width="100"><?php echo $this->Lang['ACT_PRI']; ?></th>
                                                                            <th align="left" width="100"><?php echo $this->Lang['PRICE']; ?></th>
                                                                            <? /* <div class="lp-tb-desc" style="width:150px;"><?php echo $this->Lang['ADD_TO_CART']; ?></div> */ ?>
                                                                            <th align="center" width="100"><?php echo $this->Lang['DELETE']; ?></th>
                                                                        </tr>
                                                                    </thead>
									 <?php

									foreach($this->user_wishlist as $u)
									{
										$wishlist_id = unserialize($u->wishlist);
										$i=1;
										foreach($wishlist_id as $p_id)
										{
											$limit = (isset($this->limit) && $this->limit == "100")?count($this->user_wishlist_count):$this->limit;
											if($i <= $limit)
											{
											$this->products = new Products_Model();
											$this->get_wishlist_products = $this->products->get_wishlist_products($p_id);
											$this->product_size = $this->products->get_product_one_size($p_id);
											$size = $this->product_size->current()->size_id;

											foreach($this->get_wishlist_products as $products)
											{
								?>
								<tr>
                                                                    <td>

                                                                        <a href="<?php echo PATH.$products->store_url_title.'/product/'.$products->deal_key.'/'.$products->url_title.'.html';?>" title="<?php echo $products->deal_title; ?>">
                                                                                <?php  if(file_exists(DOCROOT.'images/products/1000_800/'.$products->deal_key.'_1'.'.png')){ ?>
                                                                                        <img src="<?php echo PATH.'resize.php';?>?src=<?php echo PATH.'/images/products/1000_800/'.$products->deal_key.'_1.png'?>&w=80&h=80"  alt="<?php echo $products->deal_title; ?>" title="<?php echo $products->deal_title; ?>">
                                                                                <?php } else { ?>
                                                                                        <img src="<?php echo PATH.'resize.php';?>?src=<?php echo PATH; ?>themes/<?php echo THEME_NAME; ?>/images/noimage_products_list.png&w=80&h=80" alt="<?php echo $products->deal_title; ?>" title="<?php echo $products->deal_title; ?>" />
                                                                                <?php }?>
                                                                        </a>

                                                                    </td>
                                                                    
                                                                    <td>
                                                                            <a href="<?php echo PATH.$products->store_url_title.'/product/'.$products->deal_key.'/'.$products->url_title.'.html';?>" title="<?php echo $products->deal_title; ?>" style="color:#ff9b02;"><?php echo $products->deal_title; ?></a>
                                                                    </td>
                                                                    <?php
                                                                            $symbol = CURRENCY_SYMBOL;

                                                                    ?>
                                                                    <td><?php  echo $products->category_name; ?></td>

                                                                    <td><?php  echo $symbol.$products->deal_price; ?></td>
                                                                    <td><?php  echo $symbol.$products->deal_value; ?></td>
                                                            <? /*	<div class="lp-tb-price-value" style="width:168px;">
                                                                            <?php if((isset($size) && $size == "1") && isset($products->color) && $products->color =="0"){ ?>
                                                                            <a href="<?php echo PATH; ?>payment_product/cart_items?deal_id=<?php echo base64_encode($products->deal_id); ?>" class="cart_button" title="<?php echo $this->Lang['ADD_TO_CART']; ?>"><img src="<?php echo PATH; ?>images/add_to_cart.png" alt="<?php echo $this->Lang['ADD_TO_CART']; ?>"></a>
                                                                            <?php } else { ?>
                                                                            <a href="<?php echo PATH.'product/'.$products->deal_key.'/'.$products->url_title.'.html';?>" class="cart_button" title="<?php echo $this->Lang['ADD_TO_CART']; ?>"><img src="<?php echo PATH.'themes/'.THEME_NAME.'/images/add_to_cart.png'; ?>" alt="<?php echo $this->Lang['ADD_TO_CART']; ?>"></a>
                                                                            <?php } ?>
                                                                    </div> */ ?>
                                                                    <td align="center">
                                                                            <a class="cart_delete" onclick="removewishlist('<?php echo $products->deal_id; ?>')" title="<?php echo $this->Lang['DELETE']; ?>">&nbsp;</a>
                                                                    </td>
								</tr>
							<?php
									}}
								$i++;}
							}
							?>  
                                                        </table>
							</div>
                                                    </div>
							<?php } else { ?>
							<div class="wishlist_empty">
                                                            <p><?php echo $this->Lang['YR_WIS_LIS_MT']; ?></p>
                                                            <img alt="logo" src="<?php echo PATH; ?>themes/<?php echo THEME_NAME; ?>/images/new/wishlist_empty.png"/>
                                                        </div>
							<?php } ?>
						

					</div>

				</div>
			</div>
                    <!--Blog content ends-->
                </div>
        </div>
</div>

