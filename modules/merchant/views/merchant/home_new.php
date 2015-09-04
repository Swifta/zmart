<?php defined('SYSPATH') OR die('No direct access allowed.'); ?>
<script type="text/javascript" src="<?php echo PATH ?>js/chart/highcharts.js"></script>
<script type="text/javascript" src="<?php echo PATH ?>js/chart/exporting.js"></script>



<?php
    /*********************** Transaction List Chart Start ************************/
    
  $tra_con = '';
    $tra_val = '';    
    
    if(count($this->deals_transaction_list)>0 || count($this->products_transaction_list)>0 || count($this->auctions_transaction_list)>0){    
        $j = 0;       
        for($i=0;$i<=30;$i++)
                {                                  
                foreach($this->deals_transaction_list as $transaction){
                        $transactiondate=$transaction->transaction_date;
                        
                        $start=mktime(0, 0, 0, date("m")  , date("d")-$i, date("Y"));
                        $end=mktime(0, 0, 0, date("m")  , date("d")-$i+1, date("Y"));
                        $k=$i+1;
                        $date=date("M/d", strtotime("-$i day") ) ;
                        if(($start <= $transactiondate) && ( $end >= $transactiondate)) {
                               $j += 1; 
                        }
                }
				foreach($this->products_transaction_list as $transaction){
                        $transactiondate=$transaction->transaction_date;
                        
                        $start=mktime(0, 0, 0, date("m")  , date("d")-$i, date("Y"));
                        $end=mktime(0, 0, 0, date("m")  , date("d")-$i+1, date("Y"));
                        $k=$i+1;
                        $date=date("M/d", strtotime("-$i day") ) ;
                        if(($start <= $transactiondate) && ( $end >= $transactiondate)) {
                               $j += 1; 
                        }
                }
				foreach($this->auctions_transaction_list as $transaction){
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
    }
	
	 ?>
<script>

Highcharts.theme = {
   colors: ['#ff9b02', '#50B432', '#ED561B', '#DDDF00', '#24CBE5', '#64E572', '#FF9655', '#FFF263', '#6AF9C4'],
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
/************************************* Leads END **********************************/
</script> 
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
                           if($transaction->deal_id){ 
                                $ad +=$transaction->amount; 
                            }   
                       }
                }

	if(count($this->products_transaction_list)>0){                                           
                foreach($this->products_transaction_list as $transaction){                       
                            if($transaction->product_id){  
                                $ap +=$transaction->amount+$transaction->shipping_amount+$transaction->tax_amount; 
                           	}
                       }
                }
	if(count($this->auctions_transaction_list)>0){                                           
                foreach($this->auctions_transaction_list as $transaction){                       
                            if($transaction->auction_id){ 
                              $aa +=$transaction->bid_amount+$transaction->shipping_amount+$transaction->tax_amount;                         
                            } 
                               
                       }
                }
   ?>
<div class="admin_home">
<div class="admin_home_outer">
<div class="cont_container mt15 mt10">
<div class="dash_cont_top"> 
<h1><?php echo $this->Lang['MERCHANT_DASHBOARD']; ?></h1> 
<?php if(count($this->store_details) > 0 ){ 
foreach($this->store_details as $deta){ 
?>
<a href="<?php echo PATH; ?><?php echo $deta->store_url_title; ?>" title="View Live Store" class="view_live_store">View Live Store</a>

<?php } } ?>
</div>

<div class="bread_crumb">
	<a title="<?php echo $this->Lang['HOME']; ?>" href="<?php echo PATH ?>merchant.html"><?php echo $this->Lang['MERCHANT']; ?> <span class="fwn">  &raquo;</span>
	</a>
	<p> <?php  ?><?php echo $this->Lang['MERCHANT_DASHBOARD']; ?></p>
	<p class="acc_bal">
		<?php echo $this->Lang['ACC_BAL']; ?> :
			<span class="blink"><?php echo " ".CURRENCY_SYMBOL." ".$this->balance; ?>
			</span>
	</p>

</div>
    
    
    <div class="merchant_home">
        <div class="merchant_home_banner">
            <h2>Welcome to <?php echo SITENAME; ?>, <?php echo $this->session->get("name"); ?></h2>
            <img src="<?php echo PATH;?>/images/merchant_banner.png"/>
        </div>
        <div class="merchant_home_content">
            <ul>
                <li>
                    <div class="lft_bg">
                        <a href="<?php echo PATH; ?>merchant/add-products.html"><img src="<?php echo PATH;?>/images/new_1.png"/></a>
                    </div>
                    <div class="new_rgt_con">
                        <strong>Add a Product</strong>
                        <a href="<?php echo PATH; ?>merchant/add-products.html">Add a Product</a>
                    </div>
                </li>
                <li>
                    <div class="lft_bg">
                        <a href="<?php echo PATH; ?>merchant/add-free-gift.html"><img src="<?php echo PATH;?>/images/new_2.png"/></a>
                    </div>
                    <div class="new_rgt_con">
                        <strong>Add a Gift</strong>
                        <a href="<?php echo PATH; ?>merchant/add-free-gift.html">Add a Gift</a>
                    </div>
                </li>
                <li>
                    <div class="lft_bg">
                        <a href="<?php echo PATH; ?>merchant/add-deals.html"><img src="<?php echo PATH;?>/images/new_3.png"/></a>
                    </div>
                    <div class="new_rgt_con">
                        <strong>Add a Deal</strong>
                        <a href="<?php echo PATH; ?>merchant/add-deals.html">Add a Deal</a>
                    </div>
                </li>
                <li>
                    <div class="lft_bg">
                        <a href="<?php echo PATH; ?>merchant/add-auction.html"><img src="<?php echo PATH;?>/images/new_4.png"/></a>
                    </div>
                    <div class="new_rgt_con">
                        <strong>Add a Auction</strong>
                        <a href="<?php echo PATH; ?>merchant/add-auction.html">Add a Auction</a>
                    </div>
                </li>
                <li>
                    <div class="lft_bg">
                        <a href="<?php echo PATH; ?>merchant/store-personalized.html"><img src="<?php echo PATH;?>/images/new_5.png"/></a>
                    </div>
                    <div class="new_rgt_con">
                        <strong>Personalize Theme</strong>
                        <a href="<?php echo PATH; ?>merchant/store-personalized.html">Personalize Theme</a>
                    </div>
                </li>
                <li>
                    <div class="lft_bg">
                        <a href="<?php echo PATH; ?>merchant/settings.html"><img src="<?php echo PATH;?>/images/new_6.png"/></a>
                    </div>
                    <div class="new_rgt_con">
                        <strong>Settings</strong>
                        <a href="<?php echo PATH; ?>merchant/settings.html">Settings</a>
                    </div>
                </li>
                <li>
                    <div class="lft_bg">
                        <a href="<?php echo PATH; ?>merchant/add-shop.html"><img src="<?php echo PATH;?>/images/new_7.png"/></a>
                    </div>
                    <div class="new_rgt_con">
                        <strong>Create Shops</strong>
                        <a href="<?php echo PATH; ?>merchant/add-shop.html">Create Shops</a>
                    </div>
                </li>
                <li>
                    <div class="lft_bg">
                        <a href="<?php echo PATH; ?>merchant/add-duration.html"><img src="<?php echo PATH;?>/images/new_8.png"/></a>
                    </div>
                    <div class="new_rgt_con">
                        <strong>Allow Installment Payment</strong>
                        <a href="<?php echo PATH; ?>merchant/add-duration.html">Allow Installment Payment</a>
                    </div>
                </li>
                <li>
                    <div class="lft_bg">
                        <a href="<?php echo PATH; ?>merchant/shipping-delivery.html"><img src="<?php echo PATH;?>/images/new_9.png"/></a>
                    </div>
                    <div class="new_rgt_con">
                        <strong>View all Orders</strong>
                        <a href="<?php echo PATH; ?>merchant/shipping-delivery.html">View all Orders</a>
                    </div>
                </li>
                <li>
                    <div class="lft_bg">
                        <a href="<?php echo PATH; ?>merchant/send-newsletter.html"><img src="<?php echo PATH;?>/images/new_10.png"/></a>
                    </div>
                    <div class="new_rgt_con">
                        <strong>Newsletter</strong>
                        <a href="<?php echo PATH; ?>merchant/send-newsletter.html">Newsletter</a>
                    </div>
                </li>
                
            </ul>
        </div>
    </div>
    
    <?php /*
    <div class="content_top">
        <div class="top_left"></div><div class="top_center"></div><div class="top_rgt"></div></div>
    <div class="content_middle">
  		<div class="admin_menu">
  		
  		<ul>
           		<?php $c = $this->merchant_dashboard_data; ?>
           		
           		<li>
                     <div class="dash_active_left"> </div> 
                     <div class="dash_active_mid">
                                          
                      <div class="dash_act_img">
                    
                     <a class="dash_icons" href="<?php echo PATH?>merchant/manage-deals.html" title="<?php echo $this->Lang['ACTIVE_DEALS']; ?>">
                      <img src="<?php echo PATH ?>images/active_deals.png" class="image" alt="<?php echo $this->Lang['ACTIVE_DEALS']; ?>"/>
                      </a>
                       </div>
                       
                       <a href="<?php echo PATH?>merchant/manage-deals.html" title="<?php echo $this->Lang['ACTIVE_DEALS']; ?>">
                       <?php echo $this->Lang["ACTIVE_DEALS"]; ?>
                       <span>(<?php echo $c["active_deals"]?>)</span>
                       </a> 
                      
                       </div> <div class="dash_active_right">  </div> 
                       
                       </li>
           		
           		<li>
                     <div class="dash_active_left"> </div> 
                     <div class="dash_active_mid">
                                          
                      <div class="dash_act_img">
                    
                     <a class="dash_icons" href="<?php echo PATH?>merchant/archive-deals.html" title="<?php echo $this->Lang['ARCHIVE_DEALS']; ?>">
                     <img src="<?php echo PATH ?>images/archive_deals.png" class="image" alt="<?php echo $this->Lang['ARCHIVE_DEALS']; ?>"/>
                      </a>
                       </div>
                       
                       <a href="<?php echo PATH?>merchant/archive-deals.html" title="<?php echo $this->Lang['ARCHIVE_DEALS']; ?>">
                       <?php echo $this->Lang["ARCHIVE_DEALS"]; ?>
                       <span>(<?php echo $c["archive_deals"]?>)</span>
                       </a> 
                      
                       </div> <div class="dash_active_right">  </div> 
                       
                       </li>
                		 <li>
                     <div class="dash_active_left"> </div> 
                     <div class="dash_active_mid">
                                          
                      <div class="dash_act_img">
                    
                     <a class="dash_icons" href="<?php echo PATH?>merchant/close-couopn-list.html" title="<?php echo $this->Lang['REDEM_COU']; ?>">
                     <img src="<?php echo PATH ?>images/close_coupon.png" class="image" alt="<?php echo $this->Lang['REDEM_COU']; ?>"/>
                      </a>
                       </div>
                       
                       <a href="<?php echo PATH?>merchant/close-couopn-list.html" title="<?php echo $this->Lang['REDEM_COU']; ?>">
                       <?php echo $this->Lang['REDEM_COU']; ?>
                       <span>(<?php echo $c["close_coupon"]?>)</span>
                       </a> 
                      
                       </div> <div class="dash_active_right">  </div> 
                       
                       </li> 
					<li>
                     <div class="dash_active_left"> </div> 
                     <div class="dash_active_mid">
                                          
                      <div class="dash_act_img">
                    
                     <a class="dash_icons" href="<?php echo PATH?>merchant/all-transaction.html" title="<?php echo $this->Lang['DEALS']; ?>  <?php echo $this->Lang['TRANS']; ?>">
                     <img src="<?php echo PATH ?>images/balance.png" class="image" alt="<?php echo $this->Lang['DEALS']; ?>  <?php echo $this->Lang['TRANS']; ?>"/>
                      </a>
                       </div>
                       
                       <a href="<?php echo PATH?>merchant/all-transaction.html" title="<?php echo $this->Lang['DEALS']; ?>  <?php echo $this->Lang['TRANS']; ?>">
                       <?php echo $this->Lang['DEALS']; ?>  <?php echo $this->Lang['TRANS']; ?>
                       <span>(<?php echo CURRENCY_SYMBOL." ".$ad; ?>)</span>
                       </a> 
                      
                       </div> <div class="dash_active_right">  </div> 
                       
                       </li>  
  		       
                 	 <li>
                     <div class="dash_active_left"> </div> 
                     <div class="dash_active_mid">
                                          
                      <div class="dash_act_img">
                    
                        <a class="dash_icons" href="<?php echo PATH?>merchant/manage-products.html" title="<?php echo $this->Lang['ACTIVE_PRODUCTS']; ?>">
                            <img src="<?php echo PATH ?>images/active_products.png" class="image" alt="<?php echo $this->Lang['ACTIVE_PRODUCTS']; ?>"/>
                         </a>
                       </div>
                       
                       <a href="<?php echo PATH?>merchant/manage-products.html" title="<?php echo $this->Lang['ACTIVE_PRODUCTS']; ?>">
                       <?php echo $this->Lang["ACTIVE_PRODUCTS"]; ?>
                       <span>(<?php echo $c["active_products"]?>)</span>
                       </a> 
                      
                       </div> <div class="dash_active_right">  </div> 
                       
                       </li>
                
  		        <li>
                     <div class="dash_active_left"> </div> 
                     <div class="dash_active_mid">
                                          
                      <div class="dash_act_img">
                    
                     <a class="dash_icons" href="<?php echo PATH?>merchant/sold-products.html" title="<?php echo $this->Lang['SOLD_PRODUCTS']; ?>">
                     <img src="<?php echo PATH ?>images/sole_products.png" class="image" alt="<?php echo $this->Lang['SOLD_PRODUCTS']; ?>"/>
                      </a>
                       </div>
                       
                       <a href="<?php echo PATH?>merchant/sold-products.html" title="<?php echo $this->Lang['SOLD_PRODUCTS']; ?>">
                       <?php echo $this->Lang["SOLD_PRODUCTS"]; ?>
                       <span>(<?php echo $c["sold_products"]?>)</span>
                       </a> 
                      
                       </div> <div class="dash_active_right">  </div> 
                       
                       </li>
						<li>
                     <div class="dash_active_left"> </div> 
                     <div class="dash_active_mid">
                                          
                      <div class="dash_act_img">
                    
                     <a class="dash_icons" href="<?php echo PATH?>merchant/shipping-delivery.html" title="<?php echo $this->Lang['SHIP_DEL']; ?>">
                     <img src="<?php echo PATH ?>images/shipping_delivery.png" class="image" alt="<?php echo $this->Lang['SHIP_DEL']; ?>"/>
                      </a>
                       </div>
                       
                       <a href="<?php echo PATH?>merchant/shipping-delivery.html" title="<?php echo $this->Lang['SHIP_DEL']; ?>">
                      <?php echo $this->Lang['SHIP_DEL']; ?>
                       <span>(<?php echo $c["products_shipping"]?>)</span>
                       </a> 
                      
                       </div> <div class="dash_active_right">  </div> 
                       
                       </li>  
						<li>
                     <div class="dash_active_left"> </div> 
                     <div class="dash_active_mid">
                                          
                      <div class="dash_act_img">
                    
                     <a class="dash_icons" href="<?php echo PATH?>merchant-product/all-transaction.html" title="<?php echo $this->Lang['PRODUCTS']; ?> <?php echo $this->Lang['TRANS']; ?>">
                     <img src="<?php echo PATH ?>images/balance.png" class="image" alt="<?php echo $this->Lang['PRODUCTS']; ?> <?php echo $this->Lang['TRANS']; ?>"/>
                      </a>
                       </div>
                       
                       <a href="<?php echo PATH?>merchant-product/all-transaction.html" title="<?php echo $this->Lang['PRODUCTS']; ?> <?php echo $this->Lang['TRANS']; ?>">
                      <?php echo $this->Lang['PRODUCTS']; ?> <?php echo $this->Lang['TRANS']; ?>
                       <span>(<?php echo CURRENCY_SYMBOL." ".$ap; ?>)</span>
                       </a> 
                      
                       </div> <div class="dash_active_right">  </div> 
                       
                       </li>  
						<li>
                     <div class="dash_active_left"> </div> 
                     <div class="dash_active_mid">
                                          
                      <div class="dash_act_img">
                    
                     <a class="dash_icons" href="<?php echo PATH?>merchant/manage-auction.html" title="<?php echo $this->Lang['ACTI_AUCT']; ?>">
                     <img src="<?php echo PATH ?>images/active_auction.png" class="image" alt="<?php echo $this->Lang['ACTI_AUCT']; ?>"/>
                      </a>
                       </div>
                       
                       <a href="<?php echo PATH?>merchant/manage-auction.html" title="<?php echo $this->Lang['ACTI_AUCT']; ?>">
                       <?php echo $this->Lang['ACTI_AUCT']; ?>
                       <span>(<?php echo $c["active_auction"]?>)</span>
                       </a> 
                      
                       </div> <div class="dash_active_right">  </div> 
                       
                       </li>  <li>
                     <div class="dash_active_left"> </div> 
                     <div class="dash_active_mid">
                                          
                      <div class="dash_act_img">
                    
                     <a class="dash_icons" href="<?php echo PATH?>merchant/archive-auction.html" title="<?php echo $this->Lang['AR_AUCT']; ?>">
                     <img src="<?php echo PATH ?>images/sold_auction.png" class="image" alt="<?php echo $this->Lang['AR_AUCT']; ?>"/>
                      </a>
                       </div>
                       
                       <a href="<?php echo PATH?>merchant/archive-auction.html" title="<?php echo $this->Lang['AR_AUCT']; ?>">
                       <?php echo $this->Lang['AR_AUCT']; ?>
                       <span>(<?php echo $c["archive_auction"]?>)</span>
                       </a> 
                      
                       </div> <div class="dash_active_right">  </div> 
                       
                       </li>
						<li>
                     <div class="dash_active_left"> </div> 
                     <div class="dash_active_mid">
                                          
                      <div class="dash_act_img">
                    
                     <a class="dash_icons" href="<?php echo PATH?>merchant-auction/shipping-delivery.html" title="<?php echo $this->Lang['SHIP_DEL']; ?>">
                     <img src="<?php echo PATH ?>images/shipping_delivery.png" class="image" alt="<?php echo $this->Lang['SHIP_DEL']; ?>"/>
                      </a>
                       </div>
                       
                       <a href="<?php echo PATH?>merchant-auction/shipping-delivery.html" title="<?php echo $this->Lang['SHIP_DEL']; ?>">
                       <?php echo $this->Lang['SHIP_DEL']; ?>
                       <span>(<?php echo $c["auction_shipping"]?>)</span>
                       </a> 
                      
                       </div> <div class="dash_active_right">  </div> 
                       
                       </li>
						 <li>
                     <div class="dash_active_left"> </div> 
                     <div class="dash_active_mid">
                                          
                      <div class="dash_act_img">
                    
                     <a class="dash_icons" href="<?php echo PATH?>merchant-auction/all-transaction.html" title="<?php echo $this->Lang['AUCTION']; ?> <?php echo $this->Lang['TRANS']; ?>">
                     <img src="<?php echo PATH ?>images/balance.png" class="image" alt="<?php echo $this->Lang['AUCTION']; ?> <?php echo $this->Lang['TRANS']; ?>"/>
                      </a>
                       </div>
                       
                       <a href="<?php echo PATH?>merchant-auction/all-transaction.html" title="<?php echo $this->Lang['AUCTION']; ?> <?php echo $this->Lang['TRANS']; ?>">
                       <?php echo $this->Lang['AUCTION']; ?> <?php echo $this->Lang['TRANS']; ?>
                       <span>(<?php echo CURRENCY_SYMBOL." ".$aa; ?>)</span>
                       </a> 
                      
                       </div> <div class="dash_active_right">  </div> 
                       
                       </li> 
  		        
  		        <li>
                     <div class="dash_active_left"> </div> 
                     <div class="dash_active_mid">
                                          
                      <div class="dash_act_img">
                    
                     <a class="dash_icons" href="<?php echo PATH?>merchant/manage-shop.html" title="<?php echo $this->Lang['STORES']; ?>">
                     <img src="<?php echo PATH ?>images/stores.png" class="image"  class="Stores" alt="<?php echo $this->Lang['STORES']; ?>"/>
                      </a>
                       </div>
                       
                       <a href="<?php echo PATH?>merchant/manage-shop.html" title="<?php echo $this->Lang['STORES']; ?>">
                      <?php echo $this->Lang['STORES']; ?>
                       <span>(<?php echo $c["stores"]?>)</span>
                       </a> 
                      
                       </div> <div class="dash_active_right">  </div> 
                       
                       </li>
  		         
			
  		           
			<li>
                     <div class="dash_active_left"> </div> 
                     <div class="dash_active_mid">
                                          
                      <div class="dash_act_img">
                    
                     <a class="dash_icons" href="<?php echo PATH?>merchant/fund_request.html" title="<?php echo $this->Lang['FUND_REQ']; ?>">
                     <img src="<?php echo PATH ?>images/fund_request.png" title="<?php echo $this->Lang['FUND_REQ']; ?>" class="image"/>
                      </a>
                       </div>
                       
                       <a href="<?php echo PATH?>merchant/fund_request.html" title="<?php echo $this->Lang['FUND_REQ']; ?>">
                       <?php echo $this->Lang['FUND_REQ']; ?>
                       <span>(<?php $i=0; foreach($this->balance_list_fund as $u) { $i=$i+$u->amount; }echo CURRENCY_SYMBOL." ".$i; ?>)</span>
                       </a> 
                      
                       </div> <div class="dash_active_right">  </div> 
                       
                       </li>
			<li>
                     <div class="dash_active_left"> </div> 
                     <div class="dash_active_mid">
                                          
                      <div class="dash_act_img">
                    
                     <a class="dash_icons" href="<?php echo PATH?>merchant/couopn_code.html" title="<?php echo $this->Lang['COUPON_VALIDATE']; ?>">
                     <img src="<?php echo PATH ?>images/bar-code_validation.png" title="<?php echo $this->Lang['COUPON_VALIDATE']; ?>" class="image"/>
                      </a>
                       </div>
                       
                       <a href="<?php echo PATH?>merchant/couopn_code.html" title="<?php echo $this->Lang['COUPON_VALIDATE']; ?>">
                       <?php echo $this->Lang['COUPON_VALIDATE']; ?>
                       <span></span>
                       </a> 
                      
                       </div> <div class="dash_active_right">  </div> 
                       
                       </li>
					<li>
                     <div class="dash_active_left"> </div> 
                     <div class="dash_active_mid">
                                          
                      <div class="dash_act_img">
                    
                    <a class="dash_icons" href="<?php echo PATH?>merchant/settings.html" title="<?php echo $this->Lang['SETTINGS']; ?>">
                    <img src="<?php echo PATH ?>images/module_settings.png" class="image" alt="<?php echo $this->Lang['SETTINGS']; ?>"/>
                      </a>
                       </div>
                       
                       <a href="<?php echo PATH?>merchant/settings.html" title="<?php echo $this->Lang['SETTINGS']; ?>">
                       <?php echo $this->Lang['SETTINGS']; ?>
                       </a> 
                      
                       </div> <div class="dash_active_right">  </div> 
                       
                       </li>
  		</ul>
  		</div>  	       
        <div class="goto_live fl">        	            
            <a class="m_but" href="<?php echo PATH; ?>" title="<?php echo $this->Lang['GO_LIVE']; ?>"><?php echo $this->Lang["GO_LIVE"]; ?></a>            
        </div>
           
  	  
<div class="scr" style="overflow-x:scroll; width:960px;">
<div id="container_line" class="chart_1" style="float:left; width:1600px;" ></div>
</div>
</div>
    <div class="content_bottom"><div class="bot_left"></div><div class="bot_center"></div><div class="bot_rgt"></div></div>
    
    */?>
    
</div>
</div>
</div>
