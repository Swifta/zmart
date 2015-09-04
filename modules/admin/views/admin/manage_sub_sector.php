<?php defined('SYSPATH') OR die('No direct access allowed.'); ?>
<div class="bread_crumb"><a href="<?php echo PATH."admin.html"; ?>" title="<?php echo $this->Lang['HOME']; ?>"><?php echo $this->Lang["HOME"]; ?> <span class="fwn">&#155;&#155;</span></a><p><?php echo $this->template->title; ?></p></div>
<div class="cont_container mt15 mt10">
    <div class="content_top"><div class="top_left"></div><div class="top_center"></div><div class="top_rgt"></div></div>
    <div class="content_middle">
        <div class="table_over_flow">
        <table class="fl clr list_table">
        <?php $this->session->set("lasturl",substr($_SERVER['REQUEST_URI'], REQUEST_URL_COUNT));  ?>
        	<tr><th width="5%"><?php echo $this->Lang['S_NO']; ?></th>
            	<th width="26%"><?php echo $this->Lang["SECTOR_NAME"]; ?></th>
                <!--<th  align="left" width="30%">Category Mapping</th>-->
                
				
                <?php /*<th align="left" width="5%" ><?php echo $this->Lang["EDIT"]; ?></th>*/ ?>
                <?php if(ADMIN_PRIVILEGES_SECTOR_BLOCK){?>
                <th align="left" width="5%" ><?php echo $this->Lang["STATUS"]; ?></th>
                <th align="left" width="5%" ><?php echo $this->Lang["DELETE"]; ?></th>
                <?php }?>
            </tr>
            <?php $i=1;// $first_item = $this->pagination->current_first_item; 
            foreach($this->sector_list as $c){  ?>
            <tr>
                <td><?php echo $i;?></td>
                <td><?php echo ucfirst(htmlspecialchars($c->sector_name));?></td>
              
					
		<?php /*			
                    <td>
						<?php if($this->user_type==1){?>
						<?php
							$edit = "edit-sector";
							if($this->uri->last_segment() != "manage-sector.html"){
								$edit = "edit-sub-sector";
							}
                        ?>
                        
                    	<a href="<?php echo PATH.'admin/'.$edit.'/'.$c->sector_id.'/'.$c->sector_name;?>.html" class="editicon" title="<?php echo $this->Lang['EDIT_CATEGORY']; ?>"></a>
                    	<?php } else{echo "--";}?>
                    </td> */ ?>
                    <?php if(ADMIN_PRIVILEGES_SECTOR_BLOCK){?>
                    <td>
						<?php if($c->sector_status == 1){?>
                    	<a onclick="return blockunblockSubSector('<?php echo $c->main_sector_id; ?>','<?php echo $c->sector_id; ?>','<?php echo $c->sector_name; ?>','block');" class="blockicon" title="<?php echo $this->Lang['B_SECTOR']; ?>"></a>
                        <?php } else{  ?>
                        <a onclick="return blockunblockSubSector('<?php echo $c->main_sector_id; ?>','<?php echo $c->sector_id; ?>','<?php echo $c->sector_name; ?>','unblock');" class="unblockicon" title="<?php echo $this->Lang['UB_SECTOR']; ?>"></a>
                        <?php } ?>
                    </td>
                    <td>
						<a onclick="return deletesECTOR('<?php echo $c->sector_id; ?>','<?php echo $c->sector_name; ?>');" class="deleteicon" title="<?php echo $this->Lang['DEL_SECTOR']; ?>" ></a>
                    </td>
                    <?php }?>
            </tr>
            <?php $i++; } ?>
        </table>
        </div>
    </div>
    <div class="content_bottom"><div class="bot_left"></div><div class="bot_center"></div><div class="bot_rgt"></div></div>
</div>
