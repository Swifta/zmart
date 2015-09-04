<?php defined('SYSPATH') OR die('No direct access allowed.'); ?>
<div class="bread_crumb"><a href="<?php echo PATH.'admin.html'; ?>" title="<?php echo $this->Lang['HOME']; ?>"><?php echo $this->Lang["HOME"]; ?> <span class="fwn">&#155;&#155;</span></a><p><?php echo $this->template->title; ?></p></div>
<div class="cont_container mt15 mt10">

    <div class="content_top"><div class="top_left"></div><div class="top_center"></div><div class="top_rgt"></div></div>
    
    <div class="content_middle">
    <?php if(count($this->subscriber) > 0) {?>
        <table class="list_table fl clr">
        	<tr>
            	<th align="left" width="10%"><?php echo $this->Lang['S_NO']; ?></th>
            	<th align="left" width="40%"><?php echo $this->Lang["EMAIL_F"]; ?></th>
            	<th align="left" width="30%"><?php echo $this->Lang["CITY"]; ?></th>
            	<th align="left" width="15%"><?php echo $this->Lang["SUBSCRIB"]; ?></th>
                <th align="left" width="10%"><?php echo $this->Lang["DELETE"]; ?></th>
            </tr>
            <?php $i =0 + $this->pagination->current_first_item; foreach($this->subscriber as $u){ 
            
             ?>
                <tr>
                    <td align="left"><?php echo $i; ?></td>	
                    <td align="left"><?php echo $u->email_id; ?></td>
                    <td align="left">
						<?php
					
						 $s=explode(" ",$u->city_id); 
				 	echo common::manage_subscriber($u->city_id); 
           			?>
			</td>
                    <td align="left">
                	<?php if($u->suscribe_status == 1){?>
                	<a onclick="return blockunblocksubscriber('<?php echo $u->user_id; ?>','block');" class="blockicon" title="<?php echo $this->Lang['SUBSC']; ?>"></a>
                    <?php } else {?>
                    <a onclick="return blockunblocksubscriber('<?php echo $u->user_id; ?>', 'unblock');" class="unblockicon" title="<?php echo $this->Lang['UNSUBSC']; ?>"></a>
                    <?php }?>
                    </td>
                    <td>
                	<a onclick="return deletesubscriber('<?php echo $u->user_id; ?>');" class="deleteicon" title="<?php echo $this->Lang['DEL_SUBS']; ?>" ></a>
                    </td>
                </tr>
            <?php $i++; }?>
        </table>
        <?php } else { echo "<center>".$this->Lang["NO_SUBSCRIBER"]."</center>"; } ?>
    </div>
    <div class="content_bottom"><div class="bot_left"></div><div class="bot_center"></div><div class="bot_rgt"></div></div>
</div>
<?php echo $this->pagination;?>
