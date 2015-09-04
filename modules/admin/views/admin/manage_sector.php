<?php defined('SYSPATH') OR die('No direct access allowed.'); ?>
<div class="bread_crumb"><a href="<?php echo PATH."admin.html"; ?>" title="<?php echo $this->Lang['HOME']; ?>"><?php echo $this->Lang["HOME"]; ?> <span class="fwn">&#155;&#155;</span></a><p><?php echo $this->template->title; ?></p></div>
<div class="cont_container mt15 mt10">
    <div class="content_top"><div class="top_left"></div><div class="top_center"></div><div class="top_rgt"></div></div>
    <div class="content_middle">
                <?php $this->session->set("lasturl",substr($_SERVER['REQUEST_URI'], REQUEST_URL_COUNT));  ?>
		<?php if(count($this->sector_list)>0){ ?>
        <table class="list_table fl clr">
        	<tr>
        	    <th width="5%"><?php echo $this->Lang['S_NO']; ?></th>
				<th width="20%"><?php echo $this->Lang['SECTOR_NAME']; ?></th>
				<?php if(ADMIN_PRIVILEGES_SECTOR_ADD){?>
				<th width="5%"><?php echo $this->Lang['SUBSECTOR'];?></th>
				<?php }?>
				<th width="5%"><?php echo $this->Lang['MANAGE_SUBSECTOR'];?></th>
				<?php /*<th width="20%"><?php echo $this->Lang['CATEGORY_NAME']; ?></th>*/?>
             <?php if(ADMIN_PRIVILEGES_SECTOR_EDIT){ ?>
                <th width="10%"><?php echo $this->Lang["EDIT"]; ?></th>
            <?php } ?>  
            <?php if(ADMIN_PRIVILEGES_SECTOR_BLOCK){?> 
                   <th width="10%"><?php echo $this->Lang["STATUS"]; ?></th>
			    <th width="10%"><?php echo $this->Lang["DELETE"]; ?></th>
            <?php } ?>   
            </tr>
            <?php   $i=0; $first_item = $this->pagination->current_first_item; 
					foreach($this->sector_list as $c){?>
                <tr>
                    <td><?php echo $i+$first_item; ?></td>
                    <td><?php echo ucfirst($c->sector_name); ?></td>
                 <!--   <td><?php //echo ucfirst($c->category_name); ?></td>-->
				<?php  if(ADMIN_PRIVILEGES_SECTOR_ADD){ ?>
				<td align="center">
					 <?php if($c->sector_status ==1){?> 
                    	<a <?php if($c->sector_status ==1){?> href="<?php echo PATH.'admin/add-sub-sector/'.$c->sector_id.'/'.$c->sector_name;?>.html"  <?php } ?>   ><img src="<?php echo PATH."images/add_branch.png";?>" title="<?php echo $this->Lang['ADD_SUB_SECTOR']; ?>"/></a>
                    	<?php } else { ?>
                    	<img src="<?php echo PATH.'images/Block_icon.png';?>" title="<?php echo $this->Lang['CAT_BLOG_CANT_AD']; ?>"/>
                    	<?php } ?>
                        </td>
                       <?php }?>
                        <td align="center">
				
                    	<a href="<?php echo PATH.'admin/manage-sub-sector/'.$c->sector_id.'/'.$c->sector_name;?>.html" ><img src="<?php echo PATH."images/manage_branch.png";?>" title="<?php echo $this->Lang['MANAGE_SUBSECTOR']; ?>"/>
                    	<?php $j = 0; foreach( $this->sub_sector_list as $s){ if($s->main_sector_id == $c->sector_id){ $j++; }} echo "(".$j.") ".$this->Lang['SECTORS']; ?> </a> 
                    	
                        </td>
                        <?php if(ADMIN_PRIVILEGES_SECTOR_EDIT){?>
                    <td>
						<a href="<?php echo PATH.'admin/edit-sector/'.base64_encode($c->sector_id).'.html'; ?>" class="editicon" title="<?php echo $this->Lang['EDIT_SECTOR']; ?>"></a>
				<?php  } ?>  
				<?php if(ADMIN_PRIVILEGES_SECTOR_BLOCK){?>
				<td>
						<?php if($c->sector_status == 1){?>
                    	<a href="<?php echo PATH.'admin/block-sector/'. $c->sector_id;?>.html" class="blockicon" title="<?php echo $this->Lang['BLO_COUNT']; ?>"></a>
                        <?php } else{  ?>
                        <a href="<?php echo PATH.'admin/unblock-sector/'. $c->sector_id;?>.html" class="unblockicon" title="<?php echo $this->Lang['UNBLO_COUNT']; ?>"></a>
                        <?php } ?>
                    </td>
                    <td>
				     	<a href="<?php echo PATH.'admin/delete-sector/'.base64_encode($c->sector_id);?>.html" onclick="return confirm('<?php echo addslashes($this->Lang['ARE_U_DEL']); ?>')" class="deleteicon" title="<?php echo $this->Lang['ARE_U_DEL']; ?>"></a>
                    </td>
                 <?php } ?>   
                </tr>
            <?php $i++; } ?>    
        </table>
		<?php } else { ?>
		<p class="nodata"><?php echo $this->Lang["NO_ATTR_GROUP"]; ?></p>
		<?php } ?>
<?php echo $this->pagination; ?>
    </div>
    <div class="content_bottom"><div class="bot_left"></div><div class="bot_center"></div><div class="bot_rgt"></div></div>
</div>
