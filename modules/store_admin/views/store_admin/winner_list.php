<?php defined('SYSPATH') OR die("No direct access allowed."); ?>
  <?php $this->session->set("lasturl",substr($_SERVER['REQUEST_URI'], REQUEST_URL_COUNT));  ?>
<div class="bread_crumb"><a href="<?php echo PATH."store-admin.html"; ?>" title="<?php echo $this->Lang["HOME"]; ?>"><?php echo $this->Lang["HOME"]; ?> <span class="fwn">&#155;&#155;</span></a>
<?php if(isset($s->title)){?>
<a href="<?php echo PATH.$this->url; ?>" title="<?php echo $this->template->title; ?>">&nbsp;<?php echo $this->template->title; ?>&nbsp;<span class="fwn">&#155;&#155;</span></a><p><?php echo $this->Lang["SEARCH"]; ?></p>
<?php } else{ ?>
<p><?php echo $this->template->title; ?></p>
<?php } ?></div>

<div class="cont_container mt15 mt10">
    <div class="content_top"><div class="top_left"></div><div class="top_center"></div><div class="top_rgt"></div></div>
    <div class="content_middle">

	<form method="get" class="admin_form fl" action="" style="width:755px;">

		<?php if(count($this->winner_list) > 0){ ?>
		<?php if($this->pagination !=""){ ?>
				<a class="fr frm_export" href="<?php echo PATH.$this->url.'/page/'.$this->page.'?id='.$this->Lang['SEARCH'].'&name='.$this->input->get('name');  ?>" title="<?php echo $this->Lang['EXP_DL']; ?>"><?php echo $this->Lang['EXP_PAGE']; ?></a>
			<?php } ?>
		<a class="fr frm_export" href="<?php echo PATH.$this->url.'?id='.$this->Lang['ALL2'].'&name='.$this->input->get('name');  ?>" title="<?php echo $this->Lang['EXP_DL']; ?>"><?php echo $this->Lang['EXP_ALL']; ?></a>
		
		<?php }  ?>
          <table class="list_table1 fl clr">
                <?php 
	            if(isset($this->search_key)){
		            $s = $this->search_key; 
	            }?>


		<label class="fl"> <b class="search_deal_title"><?php echo $this->Lang['SEARCH_AU_PROD']; ?> :</b></label>
	
                <tr>
		<?php /*<td><label><?php echo $this->Lang["CITY_NAME"]; ?></label></td>
                <td><label>:</label></td>
                <td><select name ="city">
                <?php if(isset($s->city)){ foreach($this->city_list as $c){ if($s->city == $c->city_id){ ?>
                <option value="<?php echo $c->city_id; ?>"><?php echo ucfirst($c->city_name); }}}?></option>
                <option value=""><?php echo $this->Lang["SEL_CITY"]; ?></option>
                <?php foreach($this->city_list as $c){ ?>
                <option value="<?php echo $c->city_id; ?>"><?php echo ucfirst($c->city_name); ?></option>  
                <?php }?>
                </select></td> */ ?>
		<td width="50px"><label><?php echo $this->Lang["NAME"]; ?></label></td>
                <td width="20px"><label>:</label></td>
                <td width="200px"><input type = "text" name = "name" <?php if(isset($s->name)){?> value="<?php echo $s->name; ?>"<?php } ?> autofocus /></td>
		
		
		
                <td><div class="new_search_button"> <input type="submit" value="<?php echo $this->Lang['SEARCH']; ?>"/> </div></td>
            </tr>
            <tr>
            <td></td><td></td><td>
            <label><?php echo $this->Lang['AUCTION_NAME']; ?>, <?php echo $this->Lang['USER_NAME']; ?></label>
            </td>
            </tr>
        </table>

        </form> 
        
         <?php if(count($this->winner_list) > 0){ ?>
        <div class="table_over_flow">
        <table class="list_table fl clr mt20">
        	<tr>
			<th align="left" width="5"><?php echo $this->Lang['S_NO']; ?></th>
			<th align="left" width="20%"><?php echo $this->Lang['AUCTION_NAME']; ?></th>
			<th align="left" width="12%"><?php echo $this->Lang['USER_NAME']; ?></th>			
			<?php /*<th align="left" width="12%"><?php echo $this->Lang["STORE_NAME"]; ?></th> */ ?>
			<th align="left" width="15%"><?php echo $this->Lang['STAR_BID']; ?> <?php echo '('.CURRENCY_SYMBOL.')';?></th>
			<th align="left" width="15%"><?php echo $this->Lang['BID_AMO']; ?> <?php echo '('.CURRENCY_SYMBOL.')';?></th>
			<th align="left" width="15%"><?php echo $this->Lang['SHIP_FEE']; ?> <?php echo '('.CURRENCY_SYMBOL.')';?></th>
			<th align="left" width="15%"><?php echo $this->Lang['AUC_IM']; ?></th> 
			
                 </tr>
            
            <?php $i=0; $saving = 0;
			$first_item = $this->pagination->current_first_item;
			foreach($this->winner_list as $u){ 
			//	$saving = round((($u->product_value - $u->deal_value) / $u->product_value) * 100) ;
				?>
                <tr>    
                        <td align="left"><?php echo $i + $first_item ; ?></td>
                        <td align="left"><a href="<?php echo PATH.'store-admin/view-auction/'.$u->deal_key.'/'.$u->deal_id.'.html';?>" title="<?php echo $u->deal_title; ?>"><?php echo htmlspecialchars($u->deal_title); ?> </td>
						<td align="left"><?php echo htmlspecialchars($u->firstname); ?></td>
                        <?php /*<td align="left"><?php echo $u->store_name; ?></td> */ ?>
                        <td align="left"><?php echo $u->deal_value; ?></td>
                        <td align="left"><?php echo $u->bid_amount; ?></td>
                        <td align="left"><?php echo $u->shipping_amount; //if($saving<0)echo "0"; else echo $saving; ?></td>
         	                      
         	   <?php  if(file_exists(DOCROOT.'images/auction/1000_800/'.$u->deal_key.'_1'.'.png')) { ?>
         	   
                    <td align="left"><img border="0" src= "<?php echo PATH.'images/auction/1000_800/'.$u->deal_key.'_1'.'.png';?>" alt="" width="80" /></td>
                     <?php } else { ?>
                     <td><img border="0" src= "<?php echo PATH.'/images/no-images.png';?>" alt="" width="80" /></td>
                     <?php } ?>
                <script>
                  	 $(document).keyup(function(e) {
                if (e.keyCode == 27) 
                  {
                $('.popup_block_win').hide();
                 } 
                });
		$(document).ready(function(){
			$('a#show-panel<?php echo $u->user_id.'_'.$u->deal_id; ?>').click(function(){ 

				$('#lightbox-panel<?php echo $u->user_id.'_'.$u->deal_id; ?>').show();

			})

				$('#cancel').click(function(){ 
					$('#em').text(''); 

				})

		});

	</script>


			<?php /* <td>
                    	<a id="show-panel<?php echo $u->user_id.'_'.$u->deal_id; ?>" title="<?php echo $this->Lang['SEND_MAIL']; ?>"  href="javascript:;"><img src="<?php echo PATH;?>images/mail.png"><input type="hidden" name="email1" id="mail" value="<?php echo $u->email; ?>"></a>
				
		<div class="popup_show popup_block_win" id="lightbox-panel<?php echo $u->user_id.'_'.$u->deal_id; ?>" style="display:none;">
	<form method="post"  class="admin_form" action="" >
				<input type="hidden" name="deal_key" value="<?php echo $u->deal_key; ?>" />
				<input type="hidden" name="deal_id" value="<?php echo $u->deal_id; ?>" />
				<input type="hidden" name="deal_title" value="<?php echo $u->deal_title; ?>" />
				<input type="hidden" name="deal_description" value="<?php echo strip_tags($u->deal_description); ?>" />
				<input type="hidden" name="deal_value" value="<?php echo $u->deal_value; ?>" />
				<input type="hidden" name="bid_increment" value="<?php echo $u->bid_increment; ?>" />
				<input type="hidden" name="user_limit_quantity" value="<?php echo $u->user_limit_quantity; ?>" />
				<input type="hidden" name="url_title" value="<?php echo $u->url_title; ?>" />
				<input type="hidden" name="bid_amount" value="<?php echo $u->bid_amount; ?>" />
				<input type="hidden" name="shipping_fee" value="<?php echo $u->shipping_fee; ?>" />
				<input type="hidden" name="city_name" value="<?php echo $u->city_name; ?>" />
				
                <table>
			
                        <tr>
                            <td><label><?php echo $this->Lang['EMAIL']; ?></label></td>
                            <td><label>:</label></td>
		            <td><input type="text" name="email" value="<?php echo $u->email; ?> " readonly >
					
                            </td>
                        </tr>
	
                        <tr>
                            <td><label><?php echo $this->Lang['ENTR_MSG']; ?></label></td>
                            <td><label>:</label></td>
		            <td><textarea class="TextArea" name="message" id="msg" cols=15 rows=10 /></textarea>
		                 <em id="em"><?php if(isset($this->form_error['message'])){ echo $this->form_error["message"]; }?></em>
			    </td>
                        </tr>
                        <tr>
                             <td></td>
                             <td></td>
                             <td><input type="submit" value="<?php echo $this->Lang['SEND']; ?>" id="submit<?php echo $u->user_id.'_'.$u->deal_id; ?>"> <input type="reset" id="cancel" value="<?php echo $this->Lang['CANCEL']; ?>" onclick="javascript:window.location='<?php echo PATH; ?>merchant-auction/winner-list.html'" />
			     </td>
                        </tr>
                </table>
        </form>
	</div>
		
					
                    </td>*/?>
                </tr>
            <?php $i++; } ?>   
        </table> 
        </div>
        <p><?php echo $this->pagination; ?></p>
       <?php } else{ ?>
       	<p class="nodata"><?php echo $this->Lang['NO_AU_PROD_FOUND']; ?></p>
       <?php } ?>
        
    </div>
    <div class="content_bottom"><div class="bot_left"></div><div class="bot_center"></div><div class="bot_rgt"></div></div>
</div>

