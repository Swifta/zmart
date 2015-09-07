<?php defined('SYSPATH') OR die('No direct access allowed.'); ?>
  <?php $this->session->set("lasturl",substr($_SERVER['REQUEST_URI'], 1));  ?>
<div class="bread_crumb"><a href="<?php echo PATH.'merchant.html'; ?>" title="<?php echo $this->Lang['HOME']; ?>"><?php echo $this->Lang["HOME"]; ?> <span class="fwn">&#155;&#155;</span></a><p><?php echo $this->template->title; ?></p></div>
<div class="cont_container mt15 mt10">
    <div class="content_top"><div class="top_left"></div><div class="top_center"></div><div class="top_rgt"></div></div>
    <div class="content_middle">
  
        <form method="get" class="admin_form">
		<?php $this->session->set("lasturl",substr($_SERVER['REQUEST_URI'], REQUEST_URL_COUNT));  ?>
		        <?php 
	            if(isset($this->search_key)){
		            $s = $this->search_key;
	            }?>
                <div class="date_range_common">            
        <div class="list_table1 fl clr date_range_part">
            <div class="date_range_lft">
                <label><?php echo $this->Lang["DUR_NAME"]; ?> :</label>        
                <span><input type = "text" name = "duration" <?php if(isset($s->duration)){?> value="<?php echo $s->duration; ?>"<?php } ?> autofocus /></span>
            </div>
        </div>
                    <div class="date_range_bottm" >    
                    <div class="date_range_submit">
                    <input type="submit" title="<?php echo $this->Lang['SEARCH']; ?>" value="<?php echo $this->Lang['SEARCH']; ?>"/>
                    </div>
                </div>
                </div>
                </form>

                <?php if(count($this->duration_list)>0){?>
        <div class="table_over_flow">
                <table class="list_table fl clr mt15">
        	<tr>
        	<th align="left" ><?php echo $this->Lang['S_NO']; ?></th>
            	<th align="left" ><?php echo $this->Lang["DUR_NAME"]; ?></th>
                <th align="left" ><?php echo $this->Lang["EDIT"]; ?></th>
                <th align="left" ><?php echo $this->Lang["B_UNB"]; ?></th>
                </tr>
                <?php $i=0; $first_item = $this->pagination->current_first_item;
                foreach($this->duration_list as $u){?>
                <tr>    
                        <td align="left"><?php echo $i+$first_item; ?></td>
                        <td align="left" ><?php echo ucfirst(htmlspecialchars($u->duration_period)); ?></td>
                        <td align="left">
                    	<a href="<?php echo PATH.'merchant/edit-duration/'.$u->duration_id;?>.html" class="editicon" title="<?php echo $this->Lang['EDIT_STORES']; ?>"></a>
                        </td>
                        <td>
                    	<?php if($u->duration_status == 1){?>
                    	<a onclick="return blockunblockduration('<?php echo base64_encode($u->duration_id); ?>','block');" class="blockicon" title="<?php echo $this->Lang['BLO_STORES']; ?>"></a>
                        <?php } else{  ?>
                        <a onclick="return blockunblockduration('<?php echo base64_encode($u->duration_id); ?>','unblock');" class="unblockicon" title="<?php echo $this->Lang['UNBLO_STORES']; ?>"></a>
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
