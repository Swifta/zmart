<?php defined('SYSPATH') OR die('No direct access allowed.'); ?>
<div class="bread_crumb"><a href="<?php echo PATH."merchant.html"; ?>" title="<?php echo $this->Lang['HOME']; ?>"><?php echo $this->Lang["HOME"]; ?> <span class="fwn">&#155;&#155;</span></a><p><?php echo $this->template->title; ?></p></div>
<div class="cont_container mt15 mt10">
    <div class="content_top"><div class="top_left"></div><div class="top_center"></div><div class="top_rgt"></div></div>
    <div class="content_middle">
         <table class="fl clr list_table">
        <?php $this->session->set("lasturl",substr($_SERVER['REQUEST_URI'], REQUEST_URL_COUNT));  ?>
        	<tr><th width="5%" ><?php echo $this->Lang['S_NO']; ?></th>
            	<th width="25%"><?php echo $this->Lang["GIFT_NAME"]; ?></th>
            	<th width="10%"><?php echo $this->Lang["QUAN"]; ?></th>
            	<th width="25%"><?php echo $this->Lang["GIFT_TYPE"]; ?></th>
                <th align="left" width="5%" ><?php echo $this->Lang["EDIT"]; ?></th>
                <th align="left" width="5%" ><?php echo $this->Lang["STATUS"]; ?></th>
                <th align="left" width="5%" ><?php echo $this->Lang["DELETE"]; ?></th>
            </tr>
            <?php $i=0; $first_item = $this->pagination->current_first_item;foreach($this->gift_list as $c){?>
            <tr>
                <td><?php echo $i+$first_item;?></td>
                <td><?php echo ucfirst(htmlspecialchars($c->gift_name));?></td>
                <td><?php echo $c->quantity-$c->purchased_quantity;?></td>
                <td><?php if($c->gift_type==0){ echo $this->Lang["FREE_GIFT"]; } else { echo $this->Lang["AMOUNT_BASED"]." ( ". CURRENCY_SYMBOL.$c->gift_Amount ." ) "; } ;?></td>
                    <td>		
                    	<a href="<?php echo PATH.'merchant/edit-gift/'.$c->gift_id.'/'.$c->merchant_id;?>.html" class="editicon" title="<?php echo $this->Lang['EDIT_GIFT']; ?>"></a>
                    </td>
                    <td>		
                    	<?php if($c->gift_status == 1){?>
                    	<a onclick="return blockunblockGift('<?php echo $c->gift_id; ?>','<?php echo $c->merchant_id; ?>','block');" class="blockicon" title="<?php echo $this->Lang['BLO_GIFT']; ?>"></a>
                        <?php } else{  ?>
                        <a onclick="return blockunblockGift('<?php echo $c->gift_id; ?>','<?php echo $c->merchant_id; ?>','unblock');" class="unblockicon" title="<?php echo $this->Lang['UNBLO_GIFT']; ?>"></a>
                        <?php } ?>
                        
                    </td>
                    
                    <td>
					<?php if($this->user_type==3){?>	
                    	<a onclick="return deleteGift('<?php echo $c->gift_id; ?>','<?php echo $c->merchant_id; ?>');" class="deleteicon" title="<?php echo $this->Lang['DEL_GIFT']; ?>" ></a>
                    	<?php }else{echo "--";}?>
                    	
                    </td>
            </tr>
            <?php $i++;  } ?>
        </table>
        <?php echo $this->pagination;?>
    </div>
    <div class="content_bottom"><div class="bot_left"></div><div class="bot_center"></div><div class="bot_rgt"></div></div>
</div>
