<?php defined('SYSPATH') OR die('No direct access allowed.'); ?>
<div class="bread_crumb"><a href="<?php echo PATH."admin.html"; ?>" title="<?php echo $this->Lang['HOME']; ?>"><?php echo $this->Lang["HOME"]; ?> <span class="fwn">&#155;&#155;</span></a><p><?php echo $this->template->title; ?></p></div>
<div class="cont_container mt15 mt10">
    <div class="content_top"><div class="top_left"></div><div class="top_center"></div><div class="top_rgt"></div></div>
    <div class="content_middle">
                 <?php $this->session->set("lasturl",substr($_SERVER['REQUEST_URI'], REQUEST_URL_COUNT));  ?>
		<?php if(count($this->sizeDataList)>0){ ?>
        <div class="table_over_flow">
        <table class="list_table fl clr">
        	<tr>
        	    <th width="5%"><?php echo $this->Lang['S_NO']; ?></th>
				<th width="20%"><?php echo $this->Lang['SIZE']; ?></th>
				<?php if(ADMIN_PRIVILEGES_ATTRIBUTS_EDIT){?>
                <th width="10%"><?php echo $this->Lang["EDIT"]; ?></th>
                <?php }?>
                <?php if(ADMIN_PRIVILEGES_ATTRIBUTS_BLOCK){?>
                <th width="10%"><?php echo $this->Lang["DELETE"]; ?></th>
                <?php }?>
            </tr>
            <?php   $i=0; $first_item = $this->pagination->current_first_item; 
					foreach($this->sizeDataList as $c){?>
                <tr>
                    <td><?php echo $i+$first_item; ?></td>
                    <td><?php echo htmlspecialchars($c->size_name); ?></td>
                    <?php if(ADMIN_PRIVILEGES_ATTRIBUTS_EDIT){?>
                    <td>
                        <?php  if($c->size_name != "None"){ ?>
                    	<a href="<?php echo PATH.'admin/edit-size/'.base64_encode($c->size_id).'.html'; ?>" class="editicon" title="<?php echo $this->Lang['EDIT_SIZE']; ?>"></a>
                    	<?php } else { ?> ---
                    	<?php } ?>
                    </td>
                   <?php }?>
                   <?php if(ADMIN_PRIVILEGES_ATTRIBUTS_BLOCK){?>
                    <td>
                        <?php  if($c->size_name != "None"){ ?>
                    	<a href="<?php echo PATH.'admin/delete-size/'.base64_encode($c->size_id);?>.html" onclick="return confirm('<?php echo $this->Lang['ARE_U_DEL']; ?>')" class="deleteicon" title="<?php echo $this->Lang['DEL_SIZE']; ?>"></a>
                        <?php } else { ?> ---
                    	<?php } ?>
                    </td>
                    <?php }?>
                </tr>
            <?php $i++; } ?>    
        </table>
        </div>
		<?php } else { ?>
		<p class="nodata"><?php echo $this->Lang["NO_DATA"]; ?></p>
		<?php } ?>
<?php echo $this->pagination; ?>
    </div>
    <div class="content_bottom"><div class="bot_left"></div><div class="bot_center"></div><div class="bot_rgt"></div></div>
</div>
