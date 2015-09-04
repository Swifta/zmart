<?php defined('SYSPATH') OR die('No direct access allowed.'); ?>
<div class="bread_crumb"><a href="<?php echo PATH.'admin.html'; ?>" title="<?php echo $this->Lang['HOME']; ?>"><?php echo $this->Lang["HOME"]; ?> <span class="fwn">&#155;&#155;</span></a><p><?php echo $this->template->title; ?></p></div>
<div class="cont_container mt15 mt10">
    <div class="content_top"><div class="top_left"></div><div class="top_center"></div><div class="top_rgt"></div></div>
    <div class="content_middle">
  
        <form method="get" class="admin_form">
            <table class="list_table1 fl clr">
                <?php 
	            if(isset($this->search_key)){
		            $s = $this->search_key;
	            }?>
                <tr><td><label><?php echo $this->Lang["STORES_NAME"]; ?> :</label></td>
              
                <td><input autofocus type = "text" name = "storename" <?php if(isset($s->storename)){?> value="<?php echo $s->storename; ?>"<?php } ?>/></td>           
                <td><label><?php echo $this->Lang["CITY"]; ?></label></td>
                <td><label>:</label></td>
                <td><select name ="city">
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
                </select></td>
                               
                <td></td><td></td>
                <td><input type="submit" value="<?php echo $this->Lang['SEARCH']; ?>" class="fl"/></td>
            </tr>
        </table>
        </form>
    
        <?php if(count($this->users_list)>0){?>
        <table class="list_table fl clr mt15">
        	<tr>
        	<th align="left" ><?php echo $this->Lang['S_NO']; ?></th>
            	<th align="left" ><?php echo $this->Lang["STORE_NAME"]; ?></th>
            	<th align="left" ><?php echo $this->Lang["PHONE"]; ?></th>
            	<th align="left" ><?php echo $this->Lang["ADDRES"]; ?></th>
            	<th align="left" ><?php echo $this->Lang["CITY"]; ?></th>
            	<?php if(ADMIN_PRIVILEGES_MERCHANT_EDIT){?>
            	<th align="left" ><?php echo $this->Lang["PERSONALIZED"]; ?></th>            
            	<th align="left" ><?php echo $this->Lang["EDIT"]; ?></th>
            	<?php }?>
            	<?php if(ADMIN_PRIVILEGES_MERCHANT_BLOCK){?>
                <th align="left" ><?php echo $this->Lang["B_UNB"]; ?></th>
                <?php }?>
                </tr>
                <?php $i=0; $first_item = $this->pagination->current_first_item;
                foreach($this->users_list as $u){?>
                <tr>    
                        <td align="left"><?php echo $i+$first_item; ?></td>
                        <td align="left" ><?php echo ucfirst(htmlspecialchars($u->store_name)); ?></td>
                        <td align="left"><?php echo $u->phone_number; ?></td>
                        <td align="left"><?php echo htmlspecialchars($u->address1);?></td>		
                        <td align="left"><?php foreach($this->city_list as $c){ if($c->city_id == $u->city_id){ echo ucfirst($c->city_name);}  }?></td>
                        <?php if(ADMIN_PRIVILEGES_MERCHANT_EDIT){?>
                        <td align="left">
                        <a href="<?php echo PATH.'admin/edit-merchant-personalized/'.$u->store_id;?>.html" class="editicon" title="<?php echo $this->Lang['EDIT_PERSONALIZED']; ?>"></a>
                        </td>
                        <td align="left">
                    	<a href="<?php echo PATH.'admin/edit-merchant-shop/'.$u->store_id.'/'.$u->merchant_id;?>.html" class="editicon" title="<?php echo $this->Lang['EDIT_STORES']; ?>"></a>
                        </td>
                        <?php }?>
                        <?php if(ADMIN_PRIVILEGES_MERCHANT_BLOCK){?>
                    <td>
                    	<?php if($u->store_status == 1){?>
                    	<a onclick="return blockunblockmerchantshop('<?php echo $u->store_id; ?>','<?php echo $u->merchant_id; ?>','block');" class="blockicon" title="<?php echo $this->Lang['BLO_STORES']; ?>"></a>
                        <?php } else{  ?>
                        <a onclick="return blockunblockmerchantshop('<?php echo $u->store_id; ?>','<?php echo $u->merchant_id; ?>','unblock');" class="unblockicon" title="<?php echo $this->Lang['UNBLO_STORES']; ?>"></a>
                        <?php } ?>
                    </td>
                    <?php }?>
                                       
                </tr>
            <?php $i++;} ?>   
        </table>
    <?php } else{?><p class="nodata"><?php echo $this->Lang["NO_DATA"]; ?></p><?php }?>
    <?php echo $this->pagination; ?>
	<a href="javascript:history.back();" class="back_btn"><?php echo $this->Lang["BACK"]; ?></a>
 </div>

   
    <div class="content_bottom"><div class="bot_left"></div><div class="bot_center"></div><div class="bot_rgt"></div></div>

</div>
