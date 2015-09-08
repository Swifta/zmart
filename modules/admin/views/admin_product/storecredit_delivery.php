<?php defined('SYSPATH') OR die('No direct access allowed.'); ?>
	  <?php $this->session->set("lasturl",substr($_SERVER['REQUEST_URI'], REQUEST_URL_COUNT));  ?>
<div class="bread_crumb"><a href="<?php echo PATH.'merchant.html'; ?>" title="<?php echo $this->Lang['HOME']; ?>"><?php echo $this->Lang["HOME"]; ?> <span class="fwn">&#155;&#155;</span></a><p><?php echo $this->template->title; ?></p></div>
<div class="cont_container mt15 mt10" >
    <div class="content_top"><div class="top_left"></div><div class="top_center"></div><div class="top_rgt"></div></div>
    <div class="content_middle">
        <form method="get" class="admin_form" >
            <table class="list_table1 fl clr">
	 <?php /* if(count($this->storecredit_list)>0){?>

	 	<?php if($this->pagination !=""){ ?>
				<a class="fr frm_export" href="<?php echo PATH.$this->sort_url.'/page/'.$this->page.'?id='.$this->Lang['SEARCH'].'&search='.$this->input->get('search');  ?>" title="<?php echo $this->Lang['EXP_DL']; ?>"><?php echo $this->Lang['EXP_PAGE']; ?></a>
			<?php } ?>
		<a class="fr frm_export" href="<?php echo PATH.$this->sort_url.'?id='.$this->Lang['ALL2'].'&search='.$this->input->get('search');  ?>" title="<?php echo $this->Lang['EXP_DL']; ?>"><?php echo $this->Lang['EXP_ALL']; ?></a>
	
	<?php } */ ?>
                <?php 
	            if(isset($this->search_key)){
		            $s = $this->search_key;
	            }?>
                

			 <tr>
				<td><label><?php echo $this->Lang['SEARCH']; ?></label></td>
                <td><label>:</label></td>
                <td><input type = "text" name ="search" <?php if(isset($s->search)){?> value="<?php echo $s->search; ?>"<?php } ?> autofocus />
                    <div class="new_search_button"> <input type="submit" value="<?php echo $this->Lang['SEARCH']; ?>"/> </div>
                </td>
	
                <td></td>
            </tr>
            <tr>
            <td></td><td></td><td>
           	 <label><?php echo $this->Lang['NAME'].",".$this->Lang['EMAIL']; ?></label>
            </td>
            </tr>
        </table>
        </form>
    
    <?php if(count($this->storecredit_list)>0){?>
        <div class="table_over_flow">
        <table class="list_table fl clr mt15">
        	<tr>
				<th align="left" ><?php echo $this->Lang['S_NO']; ?></th>
				<th align="left" ><?php echo $this->Lang['PRODUCTS']; ?> <?php echo $this->Lang['NAME']; ?></th>
				<th align="left" ><?php echo $this->Lang['NAME']; ?></th>
				<th align="left" ><?php echo $this->Lang['EMAIL']; ?></th>
				<th align="left" ><?php echo $this->Lang['STATUS1']; ?></th>
				<th align="left" ><?php echo $this->Lang["STR_DOC"]; ?></th>
				<?php  if(isset($this->storecredit_list) && ($this->storecredit_list->current()->credit_status==4)) {  ?>
				<th align="left" ><?php echo $this->Lang["INST_DET"]; ?></th>
				<?php } ?>
		    </tr>
            <?php $k=0; $first_item = $this->pagination->current_first_item;
                foreach($this->storecredit_list as $u){?>
                <tr>    
					<td align="left"><?php echo $k+$first_item; ?></td>
					<td align="left"><?php echo $u->deal_title; ?></td>
					<td align="left"><?php echo $u->firstname; ?></td>
					<td align="left"><?php echo $u->email; ?></td>	
					<td align="left">
						<?php if($u->credit_status==4) {
							echo $this->Lang['PURCHS'];?>
						<?php } else if($u->credit_status==3) {
							echo $this->Lang['DIS_APPR'];?>
						<?php } else if($u->credit_status==2) {
							echo $this->Lang['APPROVE'];?>
						<?php }else if($u->credit_status==1) {
							echo $this->Lang['PENDING'];
							} ?>
					</td>
					<td align="center" >
					<?php if(file_exists(DOCROOT.'images/store_credit/'.$u->document_no) && $u->document_no!=''){?>
						<a href="<?php echo PATH.'images/store_credit/'.$u->document_no;?>" target="_blank" style="float:left;clear:both;padding-top:5px;color:black;font-weight:bold;"><?php echo "Download";?></a>
						<?php } else { echo "--"; } ?>
					</td>
					<?php if(($u->credit_status==4)) { ?>
					 <td align="center">
					 <a id="details-panel<?php echo $u->storecredit_id; ?>" title=""  href="javascript:;" ><img src="<?php echo PATH;?>images/details_view.gif"></a>
					<div class="popup_show1 popup_block_mer_ship" id="lightboxdetails-panel<?php echo $u->storecredit_id; ?>" style="display:none;"  >
						<div class="rejected_shipping" id="details-close<?php echo $u->storecredit_id; ?>" ></div>
						<?php   
						$instalment_value =0;
						$grand_tot = ($u->product_value * $u->product_quantity)+ $u->shipping_amount;
						if($u->duration_period!="" && $u->duration_period!=0){ 
							$instalment_value = $grand_tot/$u->duration_period;
						} 
					?>  
						<table cellpadding="0" cellspacing="0" width="100%">
							 <tr height="30" valign="middle" style=" padding: 10px; font-size: 12px; font-weight:bold; font-family: Arial;color:#666;">
								 <td width="80%" align="center">
								<img style="border: medium none;" src="<?php echo PATH; ?>/themes/<?php echo THEME_NAME; ?>/images/logo.png" height="20"><br>
								</td>
							</tr>
							<?php if($u->duration_period!=""){?>
							 <tr height="30" valign="middle" style="background: #eaeaea;font-size: 12px; font-weight:bold; font-family: Arial;color:#666;">
							<td width="80%" align="center"><?php echo $this->Lang["STR_CRD"]." : ".$u->duration_period." ".$this->Lang["MTHS"]; ?></td></tr>
							<?php } ?>
							<?php if($u->duration_period!=""){ 
								for($i=1;$i<=$u->duration_period;$i++) { ?>

							 <tr height="30" valign="middle" style="background: #eaeaea;font-size: 12px; font-weight:bold; font-family: Arial;color:#666;">
							<td width="80%" align="center"><?php echo $this->Lang["INSTL"]." ".$i." : ".CURRENCY_SYMBOL.$instalment_value." => "; ?>
							<?php if($u->installments_paid>=$i) { ?>
							<span style="color:#000"><?php echo $this->Lang["PAID"]; ?> </span>
							<?php } elseif($u->installments_paid+1==$i) { ?>
								<span style="color:#FDB713"> <?php echo $this->Lang["NXT_INST_PAY"]; ?> </span>
							<?php } else { ?>
							<span style="color:#A61C00"><?php echo $this->Lang["YET_TO_PAY"]; ?> </span>
							<?php } ?>
							</td></tr>
							<?php } } ?>
							</table>
					</div>
                 </td>
                 <script>
					$(document).keyup(function(e) {
						if (e.keyCode == 27) 
						{
							$('.popup_block_mer_ship').hide();
						 } 
					 });
                
					$(document).ready(function(){
						$('a#details-panel<?php echo $u->storecredit_id; ?>').click(function(){ 
							$('#lightboxdetails-panel<?php echo $u->storecredit_id; ?>').show();
						});
						
						$('#details-close<?php echo $u->storecredit_id; ?>').click(function(){ 
						$('#lightboxdetails-panel<?php echo $u->storecredit_id; ?>').hide();
						})
					});
                
                </script>
					<?php } ?>
					
                </tr>
            <?php $k++; } ?>   
        </table>
        </div>
<?php } else{?><p class="nodata"><?php echo $this->Lang["NO_DATA"]; ?></p><?php }?>
     <?php echo $this->pagination; ?>    </div>
    <div class="content_bottom"><div class="bot_left"></div><div class="bot_center"></div><div class="bot_rgt"></div></div>
 
</div>


