<?php defined('SYSPATH') OR die('No direct access allowed.'); ?>
<script type="text/javascript" src="<?php echo PATH ?>js/jQueryRotate.js"></script>
<script type="text/javascript">
     $(document).ready(function() {
      $(".image").rotate({
           bind:
             {
                mouseover : function() {
                        $(this).rotate({animateTo:360})
                },
                mouseout : function() {
                        $(this).rotate({animateTo:0})
                }
             }
         
       });
    });   
</script>

<?php 
    $aa = 0; 
    $ap = 0; 
    $ad = 0; 
    if(count($this->deals_transaction_list)>0){                                           
                foreach($this->deals_transaction_list as $transaction){                       
                            if($transaction->product_id){  
                                $ap +=$transaction->amount+$transaction->shipping_amount+$transaction->tax_amount+$transaction->referral_amount; 
                            } elseif($transaction->deal_id){ 
                                $ad +=$transaction->amount+$transaction->referral_amount; 
                            }   
                            elseif($transaction->auction_id){ 
                                $aa +=$transaction->bid_amount+$transaction->shipping_amount+$transaction->tax_amount+$transaction->referral_amount;                         
                            } 
                               
                       }
                }
   ?>




<div class="admin_home">
<div class="admin_home_outer">



<div class="cont_container mt15 mt10">

<div class="dash_cont_top"> 
<h1><?php echo $this->Lang['ADMIN_DASHBOARD']; ?></h1> 
<p style="width:550px">
    <b style="width:390px;display: inline-block;text-align: right;">
<?php echo $this->Lang['TOTAL']; ?> <?php echo $this->Lang['TRANS']; ?> <?php echo $this->Lang['AMOUNT']; ?> :
</b>
                       <span class="blink" style="width:150px;display: inline-block;"><?php echo " ".CURRENCY_SYMBOL." ".($ap+$ad+$aa); ?></span> </p>

</div>




<div class="bread_crumb">
	<a title="<?php echo $this->Lang['HOME']; ?>" href="<?php echo PATH ?>admin.html"><?php echo $this->Lang['ADMIN']; ?>
		<span class="fwn">  &raquo;</span>
	</a>
	<p> <?php echo $this->Lang['ADMIN_DASHBOARD']; ?></p>
	<p class="acc_bal" style="float:right;width:550px;">
		<b style="width:390px;display: inline-block;text-align: right;"><?php echo $this->Lang['ACC_BAL']; ?> :</b>
			<span class="blink" style="width:150px;display: inline-block;"><?php echo " ".CURRENCY_SYMBOL." ".$this->balance; ?>
			</span>
	</p>
</div>

	
			
    <div class="content_top"><div class="top_left"></div><div class="top_center"></div><div class="top_rgt"></div></div>
    <div class="content_middle">
  		<div class="admin_menu">
  		    <ul>
           		<?php $c = $this->admin_dashboard_data; ?>
                   <?php if(ADMIN_PRIVILEGES_DEALS){?>
                     <li>
                     <div class="dash_active_left"> </div> 
                     <div class="dash_active_mid">
                                          
                      <div class="dash_act_img">
                    
                     <a href="<?php echo PATH?>admin/manage-deals.html" title="<?php echo $this->Lang['ACTIVE_DEALS']; ?>">
                      <img src="<?php echo PATH ?>images/active_deals.png" class="image" alt="<?php echo $this->Lang['ACTIVE_DEALS']; ?>"/>
                      </a>
                       </div>
                       
                       <a href="<?php echo PATH?>admin/manage-deals.html" title="<?php echo $this->Lang['ACTIVE_DEALS']; ?>">
                       <?php echo $this->Lang["ACTIVE_DEALS"]; ?>
                       <span>(<?php echo $c["active_deals"]?>)</span>
                       </a> 
                      
                       </div> <div class="dash_active_right">  </div> 
                       
                       </li>
                      
                
                	 <li>
                     <div class="dash_active_left"> </div> 
                     <div class="dash_active_mid">
                                          
                      <div class="dash_act_img">
                    
                     <a href="<?php echo PATH?>admin/archive-deals.html" title="<?php echo $this->Lang['ARCHIVE_DEALS']; ?>">
                     <img src="<?php echo PATH ?>images/archive_deals.png" class="image" alt="<?php echo $this->Lang['ARCHIVE_DEALS']; ?>"/>
                      </a>
                       </div>
                       
                       <a href="<?php echo PATH?>admin/archive-deals.html" title="<?php echo $this->Lang['ARCHIVE_DEALS']; ?>">
                       <?php echo $this->Lang["ARCHIVE_DEALS"]; ?>
                       <span>(<?php echo $c["archive_deals"]?>)</span>
                       </a> 
                      
                       </div> <div class="dash_active_right">  </div> 
                       
                       </li>
                
  		              <li>
                     <div class="dash_active_left"> </div> 
                     <div class="dash_active_mid">
                                          
                      <div class="dash_act_img">
                    
                     <a href="<?php echo PATH?>admin/close-couopn-list.html" title="<?php echo $this->Lang['REDEM_COU']; ?>">
                     <img src="<?php echo PATH ?>images/close_coupon.png" class="image" alt="<?php echo $this->Lang['REDEM_COU']; ?>"/>
                      </a>
                       </div>
                       
                       <a href="<?php echo PATH?>admin/close-couopn-list.html" title="<?php echo $this->Lang['REDEM_COU']; ?>">
                     <?php echo $this->Lang['REDEM_COU']; ?>
                       <span>(<?php echo $c["close_coupon"]?>)</span>
                       </a> 
                      
                       </div> <div class="dash_active_right">  </div> 
                       
                       </li>  
                        <?php }?>
                        <?php if(ADMIN_PRIVILEGES_TRANSACTIONS){?>
					<li>
                     <div class="dash_active_left"> </div> 
                     <div class="dash_active_mid">
                                          
                      <div class="dash_act_img">
                    
                     <a href="<?php echo PATH?>admin/all-transaction.html" title="<?php echo $this->Lang['DEALS']; ?> <?php echo $this->Lang['TRANS']; ?>">
                     <img src="<?php echo PATH ?>images/balance.png" class="image" alt="<?php echo $this->Lang['DEALS']; ?>  <?php echo $this->Lang['TRANS']; ?>"/>
                      </a>
                       </div>
                       
                       <a href="<?php echo PATH?>admin/all-transaction.html" title="<?php echo $this->Lang['DEALS']; ?>  <?php echo $this->Lang['TRANS']; ?>">
                       <?php echo $this->Lang['DEALS']; ?> <?php echo $this->Lang['TRANS']; ?>
                       <span>(<?php echo CURRENCY_SYMBOL." ".$ad; ?>)</span>
                       </a> 
                      
                       </div> <div class="dash_active_right">  </div> 
                       
                       </li>  
                       <?php }?>
                       <?php if(ADMIN_PRIVILEGES_CUSTOMER){?>
		
			 <li>
                     <div class="dash_active_left"> </div> 
                     <div class="dash_active_mid">
                                          
                      <div class="dash_act_img">
                    
                     <a href="<?php echo PATH?>admin/manage-user.html" title="<?php echo $this->Lang['USERS']; ?>">
                     <img src="<?php echo PATH ?>images/customer.png" class="image" alt="<?php echo $this->Lang['USERS']; ?>"/>
                      </a>
                       </div>
                       
                       <a href="<?php echo PATH?>admin/manage-user.html" title="<?php echo $this->Lang['USERS']; ?>">
                       <?php echo $this->Lang["USERS"]; ?>
                       <span>(<?php echo $c["users"]?>)</span>
                       </a> 
                      
                       </div> <div class="dash_active_right">  </div> 
                       
                       </li>
                       <?php }?>
                       <?php if(ADMIN_PRIVILEGES_MERCHANT){?>
                       <li>
                     <div class="dash_active_left"> </div> 
                     <div class="dash_active_mid">
                                          
                      <div class="dash_act_img">
                    
                     <a href="<?php echo PATH?>admin/merchant.html" title="<?php echo $this->Lang['MERCHANTS']; ?>">
                     <img src="<?php echo PATH ?>images/merchant.png" class="image" alt="<?php echo $this->Lang['MERCHANTS']; ?>"/>  </a>
                       </div>
                       
                       <a href="<?php echo PATH?>admin/merchant.html" title="<?php echo $this->Lang['MERCHANTS']; ?>">
                       <?php echo $this->Lang['MERCHANTS']; ?>
                       <span>(<?php echo $c["merchant"]?>)</span>
                       </a> 
                      
                       </div> <div class="dash_active_right">  </div> 
                       
                       </li>  
                     
  		       
			<li>
                     <div class="dash_active_left"> </div> 
                     <div class="dash_active_mid">
                                          
                      <div class="dash_act_img">
                    
                     <a href="<?php echo PATH?>admin/merchant.html" title="<?php echo $this->Lang['STORES']; ?>">
                     <img src="<?php echo PATH ?>images/stores.png" class="image" alt="<?php echo $this->Lang['STORES']; ?>"/>
                      </a>
                       </div>
                       
                       <a href="<?php echo PATH?>admin/merchant.html" title="<?php echo $this->Lang['STORES']; ?>">
                       <?php echo $this->Lang['STORES']; ?>
                       <span>(<?php echo $c["stores"]?>)</span>
                       </a> 
                      
                       </div> <div class="dash_active_right">  </div> 
                       
                       </li>  
                         <?php }?>
                         <?php if(ADMIN_PRIVILEGES_CUSTOMER){?>
  		       	<li>
                     <div class="dash_active_left"> </div> 
                     <div class="dash_active_mid">
                                          
                      <div class="dash_act_img">
                    
                    <a href="<?php echo PATH?>admin/manage-contacts.html" title="<?php echo $this->Lang['CONTACT_US']; ?>">
                    <img src="<?php echo PATH ?>images/contact_us_list.png" class="image" alt="<?php echo $this->Lang['CONTACT_US']; ?>"/>
                      </a>
                       </div>
                       
                       <a href="<?php echo PATH?>admin/manage-contacts.html" title="<?php echo $this->Lang['CONTACT_US']; ?>">
                        <?php echo $this->Lang['CONTACT_US']; ?>
                       <span>(<?php echo $c["contact"]?>)</span>
                       </a> 
                      
                       </div> <div class="dash_active_right">  </div> 
                       
                       </li>
<?php }?>
			
                       <?php if(ADMIN_PRIVILEGES_PRODUCTS){?>
                       <li>
                     <div class="dash_active_left"> </div> 
                     <div class="dash_active_mid">
                                          
                      <div class="dash_act_img">
                    
                     <a href="<?php echo PATH?>admin/manage-products.html" title="<?php echo $this->Lang['ACTIVE_PRODUCTS']; ?>">
                     <img src="<?php echo PATH ?>images/active_products.png" class="image" alt="<?php echo $this->Lang['ACTIVE_PRODUCTS']; ?>"/>
                      </a>
                       </div>
                       
                       <a href="<?php echo PATH?>admin/manage-products.html" title="<?php echo $this->Lang['ACTIVE_PRODUCTS']; ?>">
                       <?php echo $this->Lang["ACTIVE_PRODUCTS"]; ?>
                       <span>(<?php echo $c["active_products"]?>)</span>
                       </a> 
                      
                       </div> <div class="dash_active_right">  </div> 
                       
                       </li>	      
                              
			 <li>
                     <div class="dash_active_left"> </div> 
                     <div class="dash_active_mid">
                                          
                      <div class="dash_act_img">
                    
                     <a href="<?php echo PATH?>admin/sold-products.html" title="<?php echo $this->Lang['SOLD_PRODUCTS']; ?>">
                     <img src="<?php echo PATH ?>images/sole_products.png" class="image" alt="<?php echo $this->Lang['SOLD_PRODUCTS']; ?>"/>
                      </a>
                       </div>
                       
                       <a href="<?php echo PATH?>admin/sold-products.html" title="<?php echo $this->Lang['SOLD_PRODUCTS']; ?>">
                       <?php echo $this->Lang["SOLD_PRODUCTS"]; ?>
                       <span>(<?php echo $c["archive_products"]?>)</span>
                       </a> 
                      
                       </div> <div class="dash_active_right">  </div> 
                       
                       </li>	
                       <?php }?>
                       <?php if(ADMIN_PRIVILEGES_TRANSACTIONS){?>
                       <li>
                     <div class="dash_active_left"> </div> 
                     <div class="dash_active_mid">
                                          
                      <div class="dash_act_img">
                    
                     <a href="<?php echo PATH?>admin/shipping-delivery.html" title="<?php echo $this->Lang['SHIP_DEL']; ?>">
                     <img src="<?php echo PATH ?>images/shipping_delivery.png" class="image" alt="<?php echo $this->Lang['SHIP_DEL']; ?>"/>
                      </a>
                       </div>
                       
                       <a href="<?php echo PATH?>admin/shipping-delivery.html" title="<?php echo $this->Lang['SHIP_DEL']; ?>">
                       <?php echo $this->Lang['SHIP_DEL']; ?>
                       <span>(<?php echo $c["products_shipping"]?>)</span>
                       </a> 
                      
                       </div> <div class="dash_active_right">  </div> 
                       
                       </li>  
                       <li>
                     <div class="dash_active_left"> </div> 
                     <div class="dash_active_mid">
                                          
                      <div class="dash_act_img">
                    
                     <a href="<?php echo PATH?>admin-product/all-transaction.html" title="<?php echo $this->Lang['PRODUCTS']; ?> <?php echo $this->Lang['TRANS']; ?>">
                     <img src="<?php echo PATH ?>images/balance.png" class="image" alt="<?php echo $this->Lang['PRODUCTS']; ?> <?php echo $this->Lang['TRANS']; ?>"/>
                      </a>
                       </div>
                       
                       <a href="<?php echo PATH?>admin-product/all-transaction.html" title="<?php echo $this->Lang['PRODUCTS']; ?> <?php echo $this->Lang['TRANS']; ?>">
                       <?php echo $this->Lang['PRODUCTS']; ?> <?php echo $this->Lang['TRANS']; ?>
                       <span>(<?php echo CURRENCY_SYMBOL." ".$ap; ?>)</span>
                       </a> 
                      
                       </div> <div class="dash_active_right">  </div> 
                       
                       </li>  
                       <?php }?>
                       <?php if(ADMIN_PRIVILEGES_COUNTRY){?>
			<li>
                     <div class="dash_active_left"> </div> 
                     <div class="dash_active_mid">
                                          
                      <div class="dash_act_img">
                    
                     <a href="<?php echo PATH?>admin/manage-country.html" title="<?php echo $this->Lang['COUNTR']; ?>"> 
                     <img src="<?php echo PATH ?>images/country.png" class="image" alt="<?php echo $this->Lang['COUNTR']; ?>"/> 
                      </a>
                       </div>
                       
                       <a href="<?php echo PATH?>admin/manage-country.html" title="<?php echo $this->Lang['COUNTR']; ?>"> 
                       <?php echo $this->Lang['COUNTR']; ?>
                       <span>(<?php echo $c["county"]?>)</span>
                       </a> 
                      
                       </div> <div class="dash_active_right">  </div> 
                       
                       </li>  		    
				<?php }?>
				<?php if(ADMIN_PRIVILEGES_CITY){?>
			<li>
                     <div class="dash_active_left"> </div> 
                     <div class="dash_active_mid">
                                          
                      <div class="dash_act_img">
                    
                     <a href="<?php echo PATH?>admin/manage-city.html" title="<?php echo $this->Lang["CITIES"]; ?>"> 
                     <img src="<?php echo PATH ?>images/city.png" class="image" alt="<?php echo $this->Lang["CITIES"]; ?>"/>
                      </a>
                       </div>
                       
                      <a href="<?php echo PATH?>admin/manage-city.html" title="<?php echo $this->Lang["CITIES"]; ?>"> 
                       <?php echo $this->Lang["CITIES"]; ?>
                       <span>(<?php echo $c["city"]?>)</span>
                       </a> 
                      
                       </div> <div class="dash_active_right">  </div> 
                       
                       </li>
                       <?php }?>
                       <?php if(ADMIN_PRIVILEGES_CATEGORIES){?>
                       <li>
                     <div class="dash_active_left"> </div> 
                     <div class="dash_active_mid">
                                          
                      <div class="dash_act_img">
                    
                    <a href="<?php echo PATH?>admin/manage-category.html" title="<?php echo $this->Lang['CATEGORIES1']; ?>">
                    <img src="<?php echo PATH ?>images/category.png" class="image" alt="<?php echo $this->Lang['CATEGORIES1']; ?>"/>
                      </a>
                       </div>
                       
                       <a href="<?php echo PATH?>admin/manage-category.html" title="<?php echo $this->Lang['CATEGORIES1']; ?>">
                        <?php echo $this->Lang['CATEGORIES1']; ?>
                       <span>(<?php echo $c["category"]?>)</span>
                       </a> 
                      
                       </div> <div class="dash_active_right">  </div> 
                       
                       </li>
                       <?php }?>
                       <?php if($this->user_type==1){?>
						<li>
				             <div class="dash_active_left"> </div> 
				             	<div class="dash_active_mid">
				                                  
				              		<div class="dash_act_img">
				            
				           			 	<a href="<?php echo PATH?>admin/module-settings.html" title="<?php echo $this->Lang['MOD_SET']; ?>">
				           				 	<img src="<?php echo PATH ?>images/module_settings.png" class="image" alt="<?php echo $this->Lang['MOD_SET']; ?>"/>
				              			</a>
				               		</div>
				               
				               		<a href="<?php echo PATH?>admin/module-settings.html" title="<?php echo $this->Lang['MOD_SET']; ?>">
				               			<?php echo $this->Lang['MOD_SET']; ?>
				               			<span></span>
				               		</a> 
				              
				               </div> <div class="dash_active_right">  </div> 
                       
                       </li>
  		          <?php }?>
			
<?php if(ADMIN_PRIVILEGES_AUCTIONS){?>
			
                    <li>
                     <div class="dash_active_left"> </div> 
                     <div class="dash_active_mid">
                                          
                      <div class="dash_act_img">
                    
                     <a href="<?php echo PATH?>admin/manage-auction.html" title="<?php echo $this->Lang['ACTI_AUCT']; ?>">
                     <img src="<?php echo PATH ?>images/active_auction.png" class="image" alt="<?php echo $this->Lang['ACTI_AUCT']; ?>"/>
                      </a>
                       </div>
                       
                       <a href="<?php echo PATH?>admin/manage-auction.html" title="<?php echo $this->Lang['ACTI_AUCT']; ?>">
                       <?php echo $this->Lang['ACTI_AUCT']; ?>
                       <span>(<?php echo $c["active_auction"]?>)</span>
                       </a> 
                      
                       </div> <div class="dash_active_right">  </div> 
                       
                       </li> 
                        <li>
                     <div class="dash_active_left"> </div> 
                     <div class="dash_active_mid">
                                          
                      <div class="dash_act_img">
                    
                     <a href="<?php echo PATH?>admin/archive-auction.html" title="<?php echo $this->Lang['AR_AUCT']; ?>">
                     <img src="<?php echo PATH ?>images/sold_auction.png" class="image" alt="<?php echo $this->Lang['AR_AUCT']; ?>"/>
                      </a>
                       </div>
                       
                       <a href="<?php echo PATH?>admin/archive-auction.html" title="<?php echo $this->Lang['AR_AUCT']; ?>">
                       <?php echo $this->Lang['AR_AUCT']; ?>
                       <span>(<?php echo $c["archive_auction"]?>)</span>
                       </a> 
                      
                       </div> <div class="dash_active_right">  </div> 
                       
                       </li> 
                       <?php }?>
                       <?php if(ADMIN_PRIVILEGES_TRANSACTIONS){?>
                        <li>
                     <div class="dash_active_left"> </div> 
                     <div class="dash_active_mid">
                                          
                      <div class="dash_act_img">
                    
                     <a href="<?php echo PATH?>admin-auction/shipping-delivery.html" title="<?php echo $this->Lang['SHIP_DEL']; ?>">
                     <img src="<?php echo PATH ?>images/shipping_delivery.png" class="image" alt="<?php echo $this->Lang['SHIP_DEL']; ?>"/>
                      </a>
                       </div>
                       
                       <a href="<?php echo PATH?>admin-auction/shipping-delivery.html" title="<?php echo $this->Lang['SHIP_DEL']; ?>">
                       <?php echo $this->Lang['SHIP_DEL']; ?>
                       <span>(<?php echo $c["auction_shipping"]?>)</span>
                       </a> 
                      
                       </div> <div class="dash_active_right">  </div> 
                       
                       </li> 
                        <li>
                     <div class="dash_active_left"> </div> 
                     <div class="dash_active_mid">
                                          
                      <div class="dash_act_img">
                    
                     <a href="<?php echo PATH?>admin-auction/all-transaction.html" title="<?php echo $this->Lang['AUCTION']; ?> <?php echo $this->Lang['TRANS']; ?>">
                     <img src="<?php echo PATH ?>images/balance.png" class="image" alt="<?php echo $this->Lang['AUCTION']; ?> <?php echo $this->Lang['TRANS']; ?>"/>
                      </a>
                       </div>
                       
                       <a href="<?php echo PATH?>admin-auction/all-transaction.html" title="<?php echo $this->Lang['AUCTION']; ?> <?php echo $this->Lang['TRANS']; ?>">
                       <?php echo $this->Lang['AUCTION']; ?> <?php echo $this->Lang['TRANS']; ?>
                       <span>(<?php echo CURRENCY_SYMBOL." ".$aa; ?>)</span>
                       </a> 
                      
                       </div> <div class="dash_active_right">  </div> 
                       
                       </li>  	
			<?php }?>
			
			
			<?php if(ADMIN_PRIVILEGES_BLOG){?>
			<li>
                     <div class="dash_active_left"> </div> 
                     <div class="dash_active_mid">
                                          
                      <div class="dash_act_img">
                    
                    <a href="<?php echo PATH?>admin/manage-publish-blog.html" title="<?php echo $this->Lang['BLOG']; ?>">
                    <img src="<?php echo PATH ?>images/blog_comment.png" class="image" alt="<?php echo $this->Lang['BLOG']; ?>"/>
                      </a>
                       </div>
                       
                       <a href="<?php echo PATH?>admin/manage-publish-blog.html" title="<?php echo $this->Lang['BLOG']; ?>">
                       <?php echo $this->Lang['BLOG']; ?>
                       <span>(<?php echo $c["blog"]?>)</span>
                       </a> 
                      
                       </div> <div class="dash_active_right">  </div> 
                       
                       </li>	
                       <?php }?>
                       <?php if(ADMIN_PRIVILEGES_FAQ){?>
			<li>
                     <div class="dash_active_left"> </div> 
                     <div class="dash_active_mid">
                                          
                      <div class="dash_act_img">
                    
                    <a href="<?php echo PATH?>faq_mgt/manage_faq.html" title="<?php echo $this->Lang['FAQ']; ?>">
                    <img src="<?php echo PATH ?>images/FAQ.png" class="image" alt="<?php echo $this->Lang['FAQ']; ?>"/>
                      </a>
                       </div>
                       
                       <a href="<?php echo PATH?>faq_mgt/manage_faq.html" title="<?php echo $this->Lang['FAQ']; ?>">
                        <?php echo $this->Lang['FAQ']; ?>
                       <span>(<?php echo $c["FAQ"]?>)</span>
                       </a> 
                      
                       </div> <div class="dash_active_right">  </div> 
                       
                       </li>
                       <?php }?>
                       <?php if(ADMIN_PRIVILEGES_CUSTOMERCARE){?>
			<li>
                     <div class="dash_active_left"> </div> 
                     <div class="dash_active_mid">
                                          
                      <div class="dash_act_img">
                    
                     <a href="<?php echo PATH?>admin/manage-email-subscriber.html" title="<?php echo $this->Lang['SUBSC_US']; ?>">
                     <img src="<?php echo PATH ?>images/subscriber_users.png" class="image" alt="<?php echo $this->Lang['SUBSC_US']; ?>"/>
                      </a>
                       </div>
                       
                       <a href="<?php echo PATH?>admin/manage-email-subscriber.html" title="<?php echo $this->Lang['SUBSC_US']; ?>">
                       <?php echo $this->Lang['SUBSC_US']; ?> 
                       <span>(<?php echo $c["subscribe"]?>)</span>
                       </a> 
                      
                       </div> <div class="dash_active_right">  </div> 
                       
                       </li>  
                       <?php }?>
                       <?php if(ADMIN_PRIVILEGES_FUNDREQUEST){?>
                       <li>
                     <div class="dash_active_left"> </div> 
                     <div class="dash_active_mid">
                                          
                      <div class="dash_act_img">
                    
                    <a href="<?php echo PATH?>admin/all-fund-request.html" title="<?php echo $this->Lang['FUND_REQ']; ?>">
                    <img src="<?php echo PATH ?>images/fund_request.png" class="image" alt="<?php echo $this->Lang['FUND_REQ']; ?>"/>
                      </a>
                       </div>
                       
                       <a href="<?php echo PATH?>admin/all-fund-request.html" title="<?php echo $this->Lang['FUND_REQ']; ?>">
                       <?php echo $this->Lang['FUND_REQ']; ?>
                       <span>(<?php echo $c["fund"]?>)</span>
                       </a> 
                      
                       </div> <div class="dash_active_right">  </div> 
                       
                       </li>
			<?php }?>
			
			
  		    </ul>
  		</div>  	
        <div class="ad_right">
        <div class="goto_live fl">
        	<div class="live_left fl"></div>
            <div class="live_middle fl">
            	<a href="<?php echo PATH; ?>" target="_blank" title="<?php echo $this->Lang['GO_LIVE']; ?>"><?php echo $this->Lang["GO_LIVE"]; ?></a>
            </div>
            <div class="live_right fl"></div>
        </div>
        <?php if(ADMIN_PRIVILEGES_DAILY_NEWSLETTER){?>
        <a href="<?php echo PATH; ?>admin/send-daily-deals.html" title="<?php echo $this->Lang['SEND_DAILY_DEALS']; ?>"><?php echo $this->Lang["SEND_DAILY_DEALS"]; ?></a> 
        <?php }?>
    </div>
	<script type="text/javascript" src="<?php echo PATH ?>js/chart/highcharts.js"></script>  
	<script type="text/javascript" src="<?php echo PATH ?>js/chart/exporting.js"></script>      
<?php
    /*********************** User List Chart Start ************************/
    $con_con = '';
    $lead_val = ''; 
    $date = '';   
    
    if(count($this->user_list)>0){    
        $j = 0;       
        for($i=0;$i<=11;$i++)
                {                                  
                foreach($this->user_list as $user){
                if($user->user_type == 4){
        
                $userdate=$user->joined_date;
                 
                        $start=strtotime(date("Y-m-1", strtotime("-$i month", strtotime(date("F") . "1")) )) ;
                        $end=strtotime(date("Y-m-t", strtotime("-$i month", strtotime(date("F") . "1")) )) ;
                        $date=date("M/Y", strtotime("-$i month", strtotime(date("F") . "1")) ) ;
                        if(($start <= $userdate) && ( $end >= $userdate)) {
                              $j +=1;             
                        }
                    }    
                }
          $con_con .= "'".$date."',"; 
          $lead_val .= $j.',';  
          $j=0;
         }    
    }
    
    /*********************** User Count Bar Chart Start ************************/
    
    if(count($this->user_list)>0) { 
		$NU = 0; $AU = 0; $FU = 0; $ME = 0;$AM=0;$CUS = 0;$CC = 0;
        foreach($this->user_list as $user){
			/*if($user->login_type == 1){
				$NU++;                        
			}
            if(($user->login_type == 2)&&($user->user_type != 3)){
				$AU++;                        
            }
            if($user->login_type == 3){
				$FU++;                        
            }*/
            if($user->user_type == 2)
				$AM++;
            else if($user->user_type == 3)
				$ME++;                        
			else if($user->user_type == 4)
				$CUS++;
			else if($user->user_type == 7)
				$CC++;
		}
        /*$normal_user =  $NU; 
        $admin_user =  $AU;
        $facebook_user =  $FU;  */
        $customer = $CUS;
        $merchant =  $ME;
        $admin_moderator = $AM;
        $customer_care = $CC; 
    }
    
    /*********************** Transaction List Chart Start ************************/
    $tra_con = '';
    $tra_val = '';    
    
    if(count($this->transaction_list)>0){    
        $j = 0;       
        for($i=0;$i<=30;$i++)
                {                                  
                foreach($this->transaction_list as $transaction){
                        $transactiondate=$transaction->transaction_date;
                        
                        $start=mktime(0, 0, 0, date("m")  , date("d")-$i, date("Y"));
                        $end=mktime(0, 0, 0, date("m")  , date("d")-$i+1, date("Y"));
                        $k=$i+1;
                        $date=date("M/d", strtotime("-$i day") ) ;
                        if(($start <= $transactiondate) && ( $end >= $transactiondate)) {
                               $j += 1; 
                        }
                }
          $tra_con .= "'".$date."',"; 
          $tra_val .= $j.',';  
          $j=0;
         }    
    }  ?>
<script type="text/javascript">
//<![CDATA[
Highcharts.theme = {
   colors: ['#058DC7', '#50B432', '#ED561B', '#DDDF00', '#24CBE5', '#64E572', '#FF9655', '#FFF263', '#6AF9C4'],
   chart: {
      backgroundColor: {
         linearGradient: [0, 0, 500, 500],
         stops: [
            [0, 'rgb(255, 255, 255)'],
            [1, 'rgb(240, 240, 255)']
         ]
      },
      borderWidth: 2,
      plotBackgroundColor: 'rgba(255, 255, 255, .9)',
      plotShadow: true,
      plotBorderWidth: 1
   },
   title: {
      style: {
         color: '#000',
         font: 'bold 16px "Trebuchet MS", Verdana, sans-serif'
      }
   },
   subtitle: {
      style: {
         color: '#666666',
         font: 'bold 12px "Trebuchet MS", Verdana, sans-serif'
      }
   },
   xAxis: {
      gridLineWidth: 1,
      lineColor: '#000',
      tickColor: '#000',
      labels: {
         style: {
            color: '#000',
            font: '11px Trebuchet MS, Verdana, sans-serif'
         }
      },
      title: {
         style: {
            color: '#333',
            fontWeight: 'bold',
            fontSize: '12px',
            fontFamily: 'Trebuchet MS, Verdana, sans-serif'

         }
      }
   },
   yAxis: {
      minorTickInterval: 'auto',
      lineColor: '#000',
      lineWidth: 1,
      tickWidth: 1,
      tickColor: '#000',
      labels: {
         style: {
            color: '#000',
            font: '11px Trebuchet MS, Verdana, sans-serif'
         }
      },
      title: {
         style: {
            color: '#333',
            fontWeight: 'bold',
            fontSize: '12px',
            fontFamily: 'Trebuchet MS, Verdana, sans-serif'
         }
      }
   },
   legend: {
      itemStyle: {
         font: '9pt Trebuchet MS, Verdana, sans-serif',
         color: 'black'

      },
      itemHoverStyle: {
         color: '#039'
      },
      itemHiddenStyle: {
         color: 'gray'
      }
   },
   labels: {
      style: {
         color: '#99b'
      }
   }
};

// Apply the theme
var highchartsOptions = Highcharts.setOptions(Highcharts.theme);

$(function () {
var chart;
    $(document).ready(function() {
        chart = new Highcharts.Chart({
            chart: {
                renderTo: 'bar_lead',
                type: 'column'
            },
            title: {
                text: '<?php echo $this->Lang["LAST_ONE_YR"]; ?>'
            },
            subtitle: {
                text: ''
            },
            xAxis: {
                categories: [<?php echo $con_con; ?>]
            },
            yAxis: {
                min: 0,
                title: {
                    text: '<?php echo $this->Lang["NUM"]; ?>'
                }
            },
            legend: {
                layout: 'vertical',
                backgroundColor: 'none',
                align: 'left',
                verticalAlign: 'top',
                x: 60,
                y: 20,
                floating: true,
                shadow: true
            },
            tooltip: {
                formatter: function() {
                    return ''+
                        this.x +': '+ this.y +' ';
                }
            },
            plotOptions: {
                column: {
                    pointPadding: 0.2,
                    borderWidth: 0
                }
            },
                series: [{
                name: '<?php echo $this->Lang["NEW_CUS"]; ?>',
                data: [<?php echo $lead_val; ?>]
    
            }]
        });
    });
});

var chart;
$(document).ready(function() {
	chart = new Highcharts.Chart({
		chart: {
			renderTo: 'container',
			plotBackgroundColor: null,
			plotBorderWidth: null,
			plotShadow: false
		},
		title: {
			text: '<?php echo $this->Lang["TOTAL"]; $user_cnt = 0;
			if(ADMIN_PRIVILEGES_CUSTOMER){ echo $user_cnt==0 ? " ".$this->Lang['USERS']: ", ".$this->Lang['USERS']; $user_cnt++;  }
			if(ADMIN_PRIVILEGES_MERCHANT){ echo $user_cnt==0 ? " ".$this->Lang['MERCHANTS']: ", ".$this->Lang['MERCHANTS']; $user_cnt++; } 
			if(ADMIN_PRIVILEGES_CUSTOMERCARE){ echo $user_cnt==0 ? " ".$this->Lang['CUSTOMER_CARE']: ", ".$this->Lang['CUSTOMER_CARE']; $user_cnt++; } 
			if($this->user_type==1){ echo $user_cnt==0 ? " ".$this->Lang['MERCHANT_MODERATOR']: ", ".$this->Lang['MERCHANT_MODERATOR']; $user_cnt++; } 
			echo " ".$this->Lang["COUNT"]; ?>'
		},
		
		plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: false
                },
                showInLegend: true
            }
        },
		series: [{
			type: 'pie',
			name: '<?php echo $this->Lang["COUNT"]; ?>',
			data: [
				<?php if(ADMIN_PRIVILEGES_CUSTOMER){?>{
					name: '<?php echo $this->Lang["USERS"]; ?>',
					y: <?php echo $customer; ?>,
					sliced: true,
					selected: true
				},<?php }?>
				<?php if(ADMIN_PRIVILEGES_MERCHANT){?> ['<?php echo $this->Lang["MERCHANTS"]; ?>',    <?php echo $merchant; ?>],<?php }?>
				<?php if(ADMIN_PRIVILEGES_CUSTOMERCARE){?> ['<?php echo $this->Lang['CUSTOMER_CARE']; ?>',     <?php echo $customer_care; ?>],<?php }?>
				<?php if($this->user_type==1){?> ['<?php echo $this->Lang['MERCHANT_MODERATOR']; ?>',   <?php echo $admin_moderator;?>]<?php }?>

			]
		}]
	});
});

$(function () {
    var chart;
    $(document).ready(function() {
        chart = new Highcharts.Chart({
            chart: {
                renderTo: 'container_line',
                type: 'area'
            },
            title: {
                text: '<?php echo $this->Lang["LAST_TRANS_REP"]; ?>'
            },
            
            xAxis: {
                categories: [<?php echo $tra_con; ?>]
            },
            yAxis: {
			title: {
				text: '<?php echo $this->Lang["TRANS_COUNT"]; ?>'
			},
			plotLines: [{
				value: 0,
				width: 1,
				color: '#808080'
			}]
		},
            tooltip: {
                formatter: function() {
                    return this.series.name +'<b>'+
                        Highcharts.numberFormat(this.y, 0) +'</b><br/>'+ this.x;
                }
            },
            
            series: [{
			name: '<?php echo $this->Lang["TRANS"]; ?>',
			data: [<?php echo $tra_val; ?>]
		}]
        });
    });
    
});
    //]]>
/************************************* Leads END **********************************/
</script>
<?php if(ADMIN_PRIVILEGES_CUSTOMER){?>         
<div id="bar_lead" class="chart_1" style=" width:960px;"></div>
<?php }?>
<?php if($this->user_type==1){ ?>
<div id="container" class="chart_1 fl" style=" width:960px;"></div>
<?php }else{
 if(ADMIN_PRIVILEGES_CUSTOMER || ADMIN_PRIVILEGES_MERCHANT || ADMIN_PRIVILEGES_CUSTOMERCARE){?>
<div id="container" class="chart_1 fl" style=" width:960px;"></div>
<?php }
}?>
<?php if(ADMIN_PRIVILEGES_TRANSACTIONS){?>
<div class="scr" style="overflow-x:scroll; width:960px;">
<div id="container_line" class="chart_1" style="float:left; width:1400px;" ></div>
</div>
<?php }?>
</div>

    <div class="content_bottom"><div class="bot_left"></div><div class="bot_center"></div><div class="bot_rgt"></div></div>
</div>

</div>
</div>
