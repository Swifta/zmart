<?php defined('SYSPATH') OR die('No direct access allowed.'); ?>
<div class="bread_crumb"><a href="<?php echo PATH.'admin.html'; ?>" title="<?php echo $this->Lang['HOME']; ?>"><?php echo $this->Lang["HOME"]; ?> <span class="fwn">&#155;&#155;</span></a><p><?php echo $this->template->title; ?></p></div>
<div class="cont_container mt15 mt10">
    <div class="content_top"><div class="top_left"></div><div class="top_center"></div><div class="top_rgt"></div></div>
    <div class="content_middle">
        <form method="get" class="admin_form" action="<?php echo PATH.'admin/manage-email-subscriber.html';?>">
            <?php $this->session->set("lasturl",substr($_SERVER['REQUEST_URI'], REQUEST_URL_COUNT));  ?>
	<?php if(($this->uri->last_segment()=="manage-email-subscriber.html") || ($this->uri->segment(3)=="page")) { ?>	
	 <?php if(count($this->users_list)>0){?>

	<a class="fr frm_export" href="<?php echo PATH.'admin/manage-email-subscriber.html?id='.$this->Lang['SEARCH'].'&email='.$this->input->get('email').'&city='.$this->input->get('city'); ?>" title="<?php echo $this->Lang['EXP_DL']; ?>"><?php echo $this->Lang['EXP_PAGE']; ?></a>

	
<?php }   }	 ?>	
<?php $this->session->set("lasturl",substr($_SERVER['REQUEST_URI'], 1));  ?>
                <?php 
	            if(isset($this->search_key)){
		            $s = $this->search_key;
	            }?>
                
        <div class="date_range_common">    
            <div class="list_table1 fl clr date_range_part">
        
        <div class="date_range_lft">
                <label><?php echo $this->Lang["CATEGORY_NAME"]; ?> :</label>        
                <span><select name ="category" autofocus >
                <?php if(isset($s->category)){ foreach($this->category_list as $c){ if($s->category == $c->category_id){ ?>
                <option value="<?php echo $c->category_id; ?>"><?php echo ucfirst($c->category_name); }}}?></option>
                <option value=""><?php echo $this->Lang["SEL_CATEGORY"]; ?></option>
                <?php foreach($this->category_list as $c){ ?>
                <?php if(isset($s->category)){
                if($s->category != $c->category_id){  ?>
                <option value="<?php echo $c->category_id; ?>"><?php echo ucfirst($c->category_name); ?></option>  
                <?php } } else { ?>
                <option value="<?php echo $c->category_id; ?>"><?php echo ucfirst($c->category_name); ?></option>  
                <?php } ?> 
                <?php }?>
                
                </select></span>
            </div>
            <div class="date_range_right">
               <label><?php echo $this->Lang['EMAIL_F']; ?> :</label>        
               <span><input type = "text" name = "email" <?php if(isset($s->email)){?> value="<?php echo $s->email; ?>"<?php } ?>/></span>
            </div>         
         <div class="date_range_bottm" >    
                <div class="date_range_submit">
                <input type="submit" value="<?php echo $this->Lang['SEARCH']; ?>"/>                
                </div>
         </div>
        </div>
            </div>
       
        </form>
    
    <?php if(count($this->users_list)>0){?>
        <table class="list_table fl clr mt15">
        	<tr>
        	<th align="left" ><?php echo $this->Lang['S_NO']; ?></th>

            	<th align="left" ><?php echo $this->Lang['EMAIL_F']; ?></th>
		<th align="left" ><?php echo $this->Lang['CATEGORY_NAME']; ?></th>
		<?php if(ADMIN_PRIVILEGES_CUSTOMER_BLOCK){?>
		<th align="left" ><?php echo $this->Lang["B_UNB"]; ?></th>
		<th align="left" ><?php echo $this->Lang["DELETE"]; ?></th>
		<?php }?>
                
            </tr>
            <?php $i=0; $first_item = $this->pagination->current_first_item;
						
                foreach($this->users_list as $u){
					
					$category_ids = explode(',',$u->category_ids);
					$category_names = "";
					foreach($category_ids as $d){ 
						foreach($this->category_list as $s){
							if($s->category_id == $d){
								$category_names .= $s->category_name.',';
							}
						}

					}
				?>
                <tr>    
                        <td align="left"><?php echo $i+$first_item; ?></td>
       
                    

                        <td align="left"><?php echo $u->email_id; ?></td>		
                  
     			 <td align="left"><?php echo trim(htmlspecialchars($category_names), ","); ?></td>
	
<?php if(ADMIN_PRIVILEGES_CUSTOMER_BLOCK){?>
                        <td>
							
                    	<?php if($u->suscribe_status == 1){?>
                    	<a onclick="return blockunblocksubscriber('<?php echo $u->subscribe_id; ?>','block');" class="blockicon" title="<?php echo $this->Lang['BLO_USER']; ?>"></a>
                        <?php } else{  ?>
                        <a onclick="return blockunblocksubscriber('<?php echo $u->subscribe_id; ?>','unblock');" class="unblockicon" title="<?php echo $this->Lang['UNBLO_USER']; ?>"></a>
                        <?php } ?>
                    </td>
	 <td>
						
                    	<a onclick="return deletesubscriber('<?php echo $u->subscribe_id; ?>')" class="deleteicon" title="<?php echo $this->Lang['DELETE']; ?>" ></a>
                    </td>  
                    <?php }?>
                    
                </tr>
            <?php $i++;} ?>   
        </table>
<?php } else{?><p class="nodata"><?php echo $this->Lang["NO_DATA"]; ?></p><?php }?>
     <?php echo $this->pagination; ?>    </div>
    <div class="content_bottom"><div class="bot_left"></div><div class="bot_center"></div><div class="bot_rgt"></div></div>
 
</div>
