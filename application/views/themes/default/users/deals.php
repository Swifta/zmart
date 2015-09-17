<table class="maccount_table_inner" width="100%" cellspacing="0" cellpadding="5" border="0">
<?php if(count($this->deals_coupons_list) > 0 ) { ?>
    <thead>
        <tr>
            <th width="100" align="left"><?php echo $this->Lang['TITLE']; ?> </th>
            <th width="100" align="left"><?php echo $this->Lang['STORE_NAME']; ?></th>
            <th width="100" align="left"><?php echo $this->Lang['PURCHASE_DATE']; ?></th>
            <th width="100" align="left"><?php echo $this->Lang['EXPIRY']; ?></th>
            <th width="100" align="left"><?php echo $this->Lang['STATUS1']; ?></th>
            <th width="100" align="center"><?php echo $this->Lang['DAYS_LEFT']; ?></th>
            <th width="100" align="center"><?php echo $this->Lang['DOWNLOAD']; ?></th>
            <th width="100" align="center"><?php echo $this->Lang['PAY_LATER_DOCUMENT']; ?></th> 
        </tr>
    </thead>
                                
<?php } ?>

<?php if(count($this->deals_coupons_list) > 0 ) { ?>
					<?php foreach($this->deals_coupons_list as $u){
					  $enddate=date('d-M-Y',$u->expirydate);
					  $current_date=Date("d -F - Y");
					  $start_time = strtotime($current_date);
				  	  $end_time = strtotime($enddate);
				  	  $days_left =  round(($end_time-$start_time)/(3600*24));
				  	  $m=round(($u->expirydate-time())/60);
				  	  $j=0;
				 	  ?>

				 


                                        <tr>
					    <td><a href="<?php echo PATH.$u->store_url_title.'/deals/'.$u->deal_key.'/'.$u->url_title.'.html';?>" title="<?php echo $u->deal_title;?>" class="fl clear"><?php echo $u->deal_title;?></a></td>
					    <td><a href="<?php echo PATH.$u->store_url_title.'/';?>" title="<?php echo $u->store_name; ?>"><?php echo $u->store_name; ?></a></td>
					    <td><?php echo date('d-M-Y',$u->transaction_date);?></td>
					    <td><?php echo date('d-M-Y',$u->expirydate);?></td>
                                            <td>
                                                <?php  if(($u->minimum_deals_limit > $u->purchase_count)||($u->captured == 1)) {?>
                                                <span class="ornage"><?php echo $this->Lang['PENDING']; ?></td>
                                                 <?php } else { ?>    
                                                <?php if($u->coupon_code_status =="1") { ?>
                                                <?php if($m > 0){ ?>
                                                <span class="green"><?php echo $this->Lang['ACTIVE']; ?></span>
                                                <?php } else { ?>
                                                <span class="red"><?php echo $this->Lang['EXPIRY']; ?></span>
                                                <?php } } else { $j=1; // for no need to show the coupon  ?>
                                                <span class="black"><?php echo $this->Lang['CLOSED']; ?></span>
                                                <?php } }?>
                                            </td>
					    
					    
					    <td align="center">
					    <?php if(($days_left == "0")and($m > 0)){ ?>
					    <?php echo $m; ?><?php echo $this->Lang['MINUTES']; ?>
					    <?php } else if($m < 0 ) {?>
					    ----
					    <?php } else {?>
					    <?php echo $days_left; ?><?php echo $this->Lang['DAYS']; ?>
					    
					    <?php } ?>
					    </td>


					    <?php  if(($m < 0)||($u->minimum_deals_limit > $u->purchase_count)||($u->captured == 1) || ($j==1) ) {?>
					     <td align="center">----</td>    
					    <?php } /*else if($u->trans_type == 5) {?>
							 <li class="my_buy_downloadcoupon"> <center><?php echo $this->Lang['CO_D']; ?></center> </li>    
						<?php } */ else { ?>
					   <td align="center">
					  <script>
					    function pdf(id)
					    {

						window.location = "<?php echo PATH; ?>pdf.html?id="+id;
					    }
					  </script>
                                          <a class="cur" title="click to download" onclick="pdf('<?php echo $u->coupon_code;?>')"><img src="<?php echo PATH;?>images/user/150_115/pdfimg.png" /></a>
                                           </td>
					 
					 <?php } ?>
					     <td align="center">
						<script type="text/javascript">     
						$(document).ready(function(){
							$('a#bank_deposit_deal_<?php echo $u->trans_id; ?>').click(function(){ 
								$('#doc_error_<?php echo $u->trans_id; ?>').hide();
								$('.bank_deposit_deal_<?php echo $u->trans_id; ?>').show();
							});
						})
						</script> 
						<?php if($u->trans_type==6){ ?> <a id="bank_deposit_deal_<?php echo $u->trans_id; ?>" title="<?php echo $this->Lang['ATTACH_PAY_LATER_DOCUMENT'];?>"><img src="<?php echo PATH;?>images/details_view.gif" title="<?php echo $this->Lang['ATTACH_PAY_LATER_DOCUMENT'];?>"></a><?php }else{ echo " - - - ";}?>
						<div class="bank_deposit_deal_<?php echo $u->trans_id; ?> popup_show" style="display:none;">
							<div class="track_title" >
								<b><?php echo $this->Lang['ATTACH_PAY_LATER_DOCUMENT'];?></b>
							</div>
							<form method="post" enctype="multipart/form-data">
								<table>
									<tr>
										<td style="width:150px;"><h1><?php echo $this->Lang['PAY_LATER_DOCUMENT'];?> : </h1></td>
										<td><input type="file" id="file_<?php echo $u->trans_id;?>" name="file" style="float:left;">
										
										<input type="hidden" id="type" name="type" value="2">
										<input type="hidden" id="transaction_id" name="transaction_id" value="<?php echo $u->trans_id; ?>">
										<span id='doc_error_<?php echo $u->trans_id;?>' style="float:left;color:red;display:none;clear:both;"><?php echo $this->Lang['PLEASE_SELECT_PAY_LATER_DOCUMET'];?></span>
										<?php if(file_exists(DOCROOT.'images/Pay_Later_Doc/'.$u->file_name) && $u->file_name!=''){?>
										<a href="<?php echo PATH.'images/Pay_Later_Doc/'.$u->file_name;?>" target="_blank" style="float:left;clear:both;padding-top:5px;color:black;font-weight:bold;"><?php echo $u->file_name;?></a>
										<?php }?>
										</td>
									</tr>
									<tr>
										<td align="right"><input type="submit" onclick="return check_document(<?php echo $u->trans_id; ?>)"></td>
										<td align="left"><input type="button" value="<?php echo $this->Lang['CANCEL'];?>" onclick="close_popup(<?php echo $u->trans_id; ?>);"></td>
									</tr>
								</table>
							</form>
						</div>
					</td>
					  </tr>
					<?php } } ?>
					</table>
					<?php if(count($this->deals_coupons_list) == 0 ) { ?>
				      <tr><td colspan="6"><p class="no_referal"><p class="no_referal"><?php echo $this->Lang['NO_DEALS']; ?></p></td></tr>
					<?php }?>
<script>
	function close_popup(id){
		$('.bank_deposit_deal_'+id).hide();
	}
	function check_document(id){
		$('#doc_error_'+id).hide();
		var file = $('#file_'+id).val();
		if(file==''){
			$('#doc_error_'+id).show();
			return false;
		}else{
			return true;
		}
	}
</script>
