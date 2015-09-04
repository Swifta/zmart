
                        <div class="limit_scroll">	
									
				<?php 
				$shipping_amount=0;
				
				
				foreach ($_SESSION as $key => $value) {
                                        if ((is_string($value)) && ($key == 'product_cart_id' . $value)) {
                                            
                                            $this->cart_window_product_details = $this->payment_products->get_cart_products1($this->session->get($key));
				 foreach($this->cart_window_product_details as $cart){ ?>
									<div class="cart_pur_list">
										<table cellpadding="3" cellspacing="0">
											<tr>
												  
												   
                                               
											
												
												<td width="15">
													  <?php if (file_exists(DOCROOT . 'images/products/1000_800/' . $cart->deal_key . '_1' . '.png')) { ?>
													<img width="50" src="<?php echo PATH . 'images/products/1000_800/' . $cart->deal_key . '_1' . '.png'; ?>"/>
													   <?php } else { ?>
													   <img width="50" src="<?php echo PATH; ?>themes/<?php echo THEME_NAME; ?>/images/noimage_products_list.png"/>
													   <?php } ?>
													</td>
												<td width="110"><p><a href="<?php echo PATH . $cart->store_url_title.'/product/' . $cart->deal_key . '/' . $cart->url_title . '.html'; ?>"><?php echo $cart->deal_title; ?></a></p></span></td>
												<?php $head_q = $this->session->get('product_quantity_qty'.$cart->deal_id);  ?>
                                                <td width="10">
                                               <?php echo "1";?>

                                                </td>
                                                <td><span>X</span></td>

												<td width="20"><p id="head_totalamount<?php echo $cart->deal_id; ?>"><?php  echo number_format((float) $cart->deal_value ,3,'.',''); ?></p></td>
												<td width="15">
													 <a class="cart_delete" onclick="delete_cart('<?php echo $cart->deal_id; ?>');" title="<?php echo $this->Lang['RMV']; ?>">&nbsp;</a>
													</td>
											</tr>
											
										</table>
										
									</div>
									
								<?php }}?>
									
									
								<?php } ?>
                        </div>
								<?php if(count($this->cart_window_product_details)>0){?>
								<div class="process_check_out" >
                                    <a class="process_che_out"  <?php if($this->UserID){ ?>   href="<?php echo PATH ?>cart.html"  <?php } else { ?> href="javascript:showlogin();" <?php } ?>><?php echo $this->Lang['CHECKOUT_NOW'] ?></a>
                                   
                                </div>
                                <?php } ?>
								

<script>
function delete_cart(dealid)
	{
	        if(dealid){ 
	                window.location.href = Path+"payment_product/cart_product_remove/product_cart_id"+dealid;
	        }
	}	
</script>
