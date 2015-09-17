<?php defined('SYSPATH') OR die("No direct access allowed."); ?>
<div class="bread_crumb"><a href="<?php echo PATH."merchant.html"; ?>" title="<?php echo $this->Lang['HOME']; ?>"><?php echo $this->Lang["HOME"]; ?> <span class="fwn">&#155;&#155;</span></a>
<?php if(isset($s->title)){?>
<a href="<?php echo PATH.$this->url; ?>" title="<?php echo $this->template->title; ?>">&nbsp;<?php echo $this->template->title; ?>&nbsp;<span class="fwn">&#155;&#155;</span></a><p><?php echo $this->Lang["SEARCH"]; ?></p>
<?php } else{ ?>
<p><?php echo $this->template->title; ?></p>
<?php } ?></div>

<div class="cont_container mt15 mt10">
    <div class="content_top"><div class="top_left"></div><div class="top_center"></div><div class="top_rgt"></div></div>
    <div class="content_middle">
<form method="get" class="admin_form fl" action="">

	<?php if(count($this->all_coupon_list) > 0){ ?>
		<?php if($this->pagination !=""){ ?>
				<a class="fr frm_export" href="<?php echo PATH.$this->url.'/page/'.$this->page.'?id='.$this->Lang['SEARCH'].'&coupon_code='.$this->input->get('coupon_code').'&name='.$this->input->get('name');  ?>" title="<?php echo $this->Lang['EXP_DL']; ?>"><?php echo $this->Lang['EXP_PAGE']; ?></a>
			<?php } ?>
		<a class="fr frm_export" href="<?php echo PATH.$this->url.'?id='.$this->Lang['ALL2'].'&coupon_code='.$this->input->get('coupon_code').'&name='.$this->input->get('name');  ?>" title="<?php echo $this->Lang['EXP_DL']; ?>"><?php echo $this->Lang['EXP_ALL']; ?></a>

		<?php } ?>
          <label class="fl"> <b class="search_deal_title"><?php echo $this->Lang["SEARCH_DEALS"]; ?> :</b></label>
          
                <?php 
	            if(isset($this->search_key)){
		            $s = $this->search_key; 
	            }?>
                
          <div class="date_range_common">            
        <div class="list_table1 fl clr date_range_part">
            <div class="date_range_lft">
                <label><?php echo $this->Lang['COUPON_CODE']; ?> :</label>        
                <span><input type = "text" name ="coupon_code" <?php if(isset($s->name)){?> value="<?php echo $s->coupon_code; ?>"<?php } ?> autofocus /></span>
            </div>
            <div class="date_range_right">
               <label><?php echo $this->Lang["NAME"]; ?> :</label>        
               <span><input type = "text" name ="name" <?php if(isset($s->name)){?> value="<?php echo $s->name; ?>"<?php } ?>/></span>
            </div>        
        </div>
              <div class="date_range_part" >    
                    <div class="date_range_lft">
                    <label></label>        
                    <span></span>
                    </div>
                    <div class="date_range_right">
                      <label>&nbsp;</label>        
                      <span><?php echo $this->Lang['DEALS_NAME']; ?>, <?php echo $this->Lang['STORE_NAME']; ?></span>
                    </div> 
               </div>
              <div class="date_range_bottm" >    
                    <div class="date_range_submit">
                    <input type="submit" title="<?php echo $this->Lang['SEARCH']; ?>" value="<?php echo $this->Lang['SEARCH']; ?>"/>
                    </div>
                </div> 
          </div>
        </form>
        
        <?php if(count($this->all_coupon_list) > 0){ ?>
        <div class="table_over_flow">
        <table class="list_table fl clr mt20">
        	<tr>
				<th align="left" width="5%"><?php echo $this->Lang['S_NO']; ?></th>
				<th align="left" width="20%"><?php echo $this->Lang["DEALS_NAME"]; ?></th>
				<th align="left" width="12%"><?php echo $this->Lang['USER_NAME']; ?></th>			
				<th align="left" width="12%"><?php echo $this->Lang['COUPON_CODE']; ?></th>
				<th align="left" width="12%"><?php echo $this->Lang['DATE']; ?></th>
				<th align="left" width="15%"><?php echo $this->Lang["DEAL_IMG"]; ?></th> 
            </tr>
            
            <?php $i=0; 
			$first_item = $this->pagination->current_first_item;
			foreach($this->all_coupon_list as $u){ ?>
                <tr>    
                        <td align="left"><?php echo $i + $first_item ; ?></td>
                        <td align="left"><?php echo htmlspecialchars($u->deal_title); ?></td>
						<td align="left"><?php echo htmlspecialchars($u->firstname); ?></td>
                        <td align="left"><?php echo $u->coupon_code; ?></td>
                        <td align="left"><?php echo date('m/d/Y H:i:s', $u->transaction_date); ?></td>
         	                      
         	   <?php  if(file_exists(DOCROOT.'images/deals/1000_800/'.$u->deal_key.'_1'.'.png')) { ?>
         	   
                    <td align="left"><img border="0" src= "<?php echo PATH.'images/deals/1000_800/'.$u->deal_key.'_1'.'.png';?>" alt="" width="80" /></td>
                     <?php } else { ?>
                     <td><img border="0" src= "<?php echo PATH.'/images/no-images.png';?>" alt="" width="80" /></td>
                     <?php } ?>
                 
                </tr>
            <?php $i++; } ?>   
        </table> 
        </div>
        <p><?php echo $this->pagination; ?></p>
       <?php } else{ ?>
       	<p class="nodata"><?php echo $this->Lang["NO_DEALS"]; ?></p>
       <?php } ?>
        
    </div>
    <div class="content_bottom"><div class="bot_left"></div><div class="bot_center"></div><div class="bot_rgt"></div></div>
</div>

