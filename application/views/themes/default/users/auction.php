<table class="maccount_table_inner" width="100%" cellspacing="0" cellpadding="5" border="0">
<?php if(count($this->auctions_coupons_list) > 0 ) { ?>
    <thead>
        <tr>
            <th width="100" align="left"><?php echo $this->Lang['TITLE']; ?></th>
            <th width="100" align="left"><?php echo $this->Lang['STORE_NAME']; ?></th>
            <th width="100" align="left"><?php echo $this->Lang['PURCHASE_DATE']; ?></th>
            <th width="100" align="left"><?php echo $this->Lang['ADDRES']; ?></th>
            <th width="100" align="left"><?php echo $this->Lang['STATUS1']; ?></th>
            <th width="100" align="center"><?php echo $this->Lang['PAY_LATER_DOCUMENT']; ?></th>    
        </tr>
    </thead>
<?php } ?>
<?php if(count($this->auctions_coupons_list) > 0 ) { ?>
				<?php foreach($this->auctions_coupons_list as $p){ ?>
			 
				  <tr>
				    <td><a href="<?php echo PATH.$p->store_url_title.'/auction/'.$p->deal_key.'/'.$p->url_title.'.html';?>" title="<?php echo $p->deal_title;?>" class="fl clear"><?php echo $p->deal_title;?></a></td>
				    <td><a href="<?php echo PATH.$p->store_url_title.'/';?>" title="<?php echo $p->store_name; ?>"><?php echo $p->store_name; ?></a></td>
				    <td><?php echo date('d-M-Y',$p->transaction_date);?></td>
                                    <td><?php echo $p->de_add1.",".$p->de_add2;?></td>
                                    <td><?php if($p->delivery_status==0) { echo $this->Lang['PENDING']; } elseif($p->delivery_status==1) { echo $this->Lang['ORDER_PACKED']; } elseif($p->delivery_status==2) { echo $this->Lang['SHIPPED_DELI_CENT'];  } elseif($p->delivery_status==3) { echo $this->Lang['OR_OUT_DELI']; } elseif($p->delivery_status==4) { echo $this->Lang['DELIVERED']; } ?></td>
                    <td align="center">
				<script type="text/javascript">     
				$(document).ready(function(){
					$('a#bank_deposit_deal_<?php echo $p->trans_id; ?>').click(function(){ 
						$('#doc_error_<?php echo $p->trans_id; ?>').hide();
						$('.bank_deposit_deal_<?php echo $p->trans_id; ?>').show();
					});
				})
				</script> 
				<?php if($p->pay_type==6){ ?> <a id="bank_deposit_deal_<?php echo $p->trans_id; ?>" title="<?php echo $this->Lang['ATTACH_PAY_LATER_DOCUMENT'];?>"><img src="<?php echo PATH;?>images/details_view.gif" title="<?php echo $this->Lang['ATTACH_PAY_LATER_DOCUMENT'];?>"></a><?php }else{ echo " - - - ";}?>
				<div class="bank_deposit_deal_<?php echo $p->trans_id; ?> popup_show" style="display:none;">
					<div class="track_title" >
						<b><?php echo $this->Lang['ATTACH_PAY_LATER_DOCUMENT'];?></b>
					</div>
					<form method="post" enctype="multipart/form-data">
						<table>
							<tr>
								<td style="width:150px;"><h1><?php echo $this->Lang['PAY_LATER_DOCUMENT'];?> : </h1></td>
								<td><input type="file" id="file_<?php echo $p->trans_id;?>" name="file" style="float:left;">
								
								<input type="hidden" id="type" name="type" value="3">
								<input type="hidden" id="transaction_id" name="transaction_id" value="<?php echo $p->trans_id; ?>">
								<span id='doc_error_<?php echo $p->trans_id;?>' style="float:left;color:red;display:none;clear:both;"><?php echo $this->Lang['PLEASE_SELECT_PAY_LATER_DOCUMET'];?></span>
								<?php if(file_exists(DOCROOT.'images/Pay_Later_Doc/'.$p->file_name) && $p->file_name!=''){?>
								<a href="<?php echo PATH.'images/Pay_Later_Doc/'.$p->file_name;?>" target="_blank" style="float:left;clear:both;padding-top:5px;color:black;font-weight:bold;"><?php echo $p->file_name;?></a>
								<?php }?>
								</td>
							</tr>
							<tr>
								<td align="right"><input type="submit" onclick="return check_document(<?php echo $p->trans_id; ?>)"></td>
								<td align="left"><input type="button" value="<?php echo $this->Lang['CANCEL'];?>" onclick="close_popup(<?php echo $p->trans_id; ?>);"></td>
							</tr>
						</table>
					</form>
				</div>
			</td>
				  </tr>
				<?php } } ?>
				
		</table>		
				<?php if(count($this->auctions_coupons_list) == 0 ) { ?>
				<tr><td colspan="5"><p class="no_referal"><?php echo $this->Lang['NO_AUC_FOUND']; ?></p></td></tr>
				<?php }?>
			     
