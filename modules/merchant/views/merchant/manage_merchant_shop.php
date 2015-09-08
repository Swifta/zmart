<?php defined('SYSPATH') OR die('No direct access allowed.'); ?>
  <?php $this->session->set("lasturl",substr($_SERVER['REQUEST_URI'], 1));  ?>
<div class="bread_crumb"><a href="<?php echo PATH.'merchant.html'; ?>" title="<?php echo $this->Lang['HOME']; ?>"><?php echo $this->Lang["HOME"]; ?> <span class="fwn">&#155;&#155;</span></a><p><?php echo $this->template->title; ?></p></div>
<div class="cont_container mt15 mt10">
    <div class="content_top"><div class="top_left"></div><div class="top_center"></div><div class="top_rgt"></div></div>
    <div class="content_middle">
  
        <form method="get" class="admin_form">
		<?php $this->session->set("lasturl",substr($_SERVER['REQUEST_URI'], REQUEST_URL_COUNT));  ?>
		<?php if(count($this->users_list) > 0){ ?>
		
	 	<?php if($this->pagination !=""){ ?>
				<a class="fr frm_export" href="<?php echo PATH.$this->url.'/page/'.$this->page.'?id='.$this->Lang['SEARCH'].'&storename='.$this->input->get('name').'&city='.$this->input->get('city');  ?>" title="<?php echo $this->Lang['EXP_DL']; ?>"><?php echo $this->Lang['EXP_PAGE']; ?></a>
			<?php } ?>
		<a class="fr frm_export" href="<?php echo PATH.$this->url.'?id='.$this->Lang['ALL2'].'storename='.$this->input->get('name').'&city='.$this->input->get('city');  ?>" title="<?php echo $this->Lang['EXP_DL']; ?>"><?php echo $this->Lang['EXP_ALL']; ?></a>
		

		<?php } ?>
                
                <?php 
	            if(isset($this->search_key)){
		            $s = $this->search_key;
	            }?>
                <div class="date_range_common">            
        <div class="list_table1 fl clr date_range_part">
            <div class="date_range_lft">
                <label><?php echo $this->Lang["STORES_NAME"]; ?> :</label>        
                <span><input type = "text" name = "storename" <?php if(isset($s->storename)){?> value="<?php echo $s->storename; ?>"<?php } ?> autofocus /></span>
            </div>
            <div class="date_range_right">
               <label><?php echo $this->Lang["CITY"]; ?> :</label>        
               <span><select name ="city">
                 <?php if(isset($s->city)){ foreach($this->city_list as $c){ if($s->city == $c->city_id){ ?>
                <option value="<?php echo $c->city_id; ?>"><?php echo ucfirst($c->city_name);?></option> <?php  }}} ?>
                <option value=""><?php echo $this->Lang["SEL_CITY"]; ?></option>
                <?php foreach($this->city_list as $c){ ?>
                <?php if(isset($s->city)){
                if($s->city != $c->city_id){  ?>
                <option value="<?php echo $c->city_id; ?>"><?php echo ucfirst($c->city_name); ?></option>  
                <?php } } else { ?>
                <option value="<?php echo $c->city_id; ?>"><?php echo ucfirst($c->city_name); ?></option>  
                <?php } ?> 
                <?php }?>
                </select></span>
            </div>        
        </div>
                    <div class="date_range_bottm" >    
                    <div class="date_range_submit">
                    <input type="submit" title="<?php echo $this->Lang['SEARCH']; ?>" value="<?php echo $this->Lang['SEARCH']; ?>"/>
                    </div>
                </div>
                </div>
                </form>

                <?php if(count($this->users_list)>0){?>
        <div class="table_over_flow">
                <table class="list_table fl clr mt15">
        	<tr>
        	<th align="left" ><?php echo $this->Lang['S_NO']; ?></th>
            	<th align="left" ><?php echo $this->Lang["STORE_NAME"]; ?></th>
            	<th align="left" ><?php echo $this->Lang["PHONE"]; ?></th>
            	<th align="left" ><?php echo $this->Lang["ADDRES"]; ?></th>
            	<th align="left" ><?php echo $this->Lang["CITY"]; ?></th>
            	<th align="left" ><?php echo $this->Lang["PERSONALIZED"]; ?></th>
                <th align="left" ><?php echo $this->Lang["EDIT"]; ?></th>
                <th align="left" ><?php echo $this->Lang["B_UNB"]; ?></th>
                </tr>
                <?php $i=0; $first_item = $this->pagination->current_first_item;
                foreach($this->users_list as $u){?>
                <tr>    
                        <td align="left"><?php echo $i+$first_item; ?></td>
                        <td align="left" ><?php echo ucfirst(htmlspecialchars($u->store_name)); ?></td>
                        <td align="left"><?php echo $u->phone_number; ?></td>
                        <td align="left"><?php echo htmlspecialchars($u->address1);?></td>		
                        <td align="left"><?php foreach($this->city_list as $c){ if($c->city_id == $u->city_id){ echo ucfirst($c->city_name);}  }?></td>
                        <?php  if(PRIVILEGES_PERSONALIZED_STORE_EDIT==1){ ?>
                        <td align="left">
                            <a href="<?php echo PATH; ?>merchant/store-personalized/<?php echo $u->store_id;?>.html" class="editicon" title="<?php echo $this->Lang['EDIT_PERSONALIZED']; ?>"></a>
                        </td>
                        <?php } ?>
                        <td align="left">
                    	<a href="<?php echo PATH.'merchant/edit-shop/'.$u->store_id;?>.html" class="editicon" title="<?php echo $this->Lang['EDIT_STORES']; ?>"></a>
                        </td>
                        <td>
                    	<?php if($u->store_status == 1){?>
                    	<a onclick="return blockunblockshop('<?php echo $u->store_id; ?>','block');" class="blockicon" title="<?php echo $this->Lang['BLO_STORES']; ?>"></a>
                        <?php } else{  ?>
                        <a onclick="return blockunblockshop('<?php echo $u->store_id; ?>','unblock');" class="unblockicon" title="<?php echo $this->Lang['UNBLO_STORES']; ?>"></a>
                        <?php } ?>
                    </td>
                                       
                </tr>
            <?php $i++;} ?>   
        </table>
        </div>
    <?php } else{?><p class="nodata"><?php echo $this->Lang["NO_DATA"]; ?></p><?php }?>
    <?php echo $this->pagination; ?>
</div>
    <div class="content_bottom"><div class="bot_left"></div><div class="bot_center"></div><div class="bot_rgt"></div></div>
</div>
