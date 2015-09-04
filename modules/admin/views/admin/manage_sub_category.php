<?php defined('SYSPATH') OR die('No direct access allowed.'); ?>
<div class="bread_crumb"><a href="<?php echo PATH."admin.html"; ?>" title="<?php echo $this->Lang['HOME']; ?>"><?php echo $this->Lang["HOME"]; ?> <span class="fwn">&#155;&#155;</span></a><a href="<?php echo PATH."admin/manage-category.html"; ?>" title="<?php echo $this->Lang['TOP_CATEGORY']; ?>"><?php echo $this->Lang["TOP_CATEGORY"]; ?> <span class="fwn">&#155;&#155;</span></a><p><?php echo $this->template->title; ?></p></div>
<div class="cont_container mt15 mt10">
    <div class="content_top"><div class="top_left"></div><div class="top_center"></div><div class="top_rgt"></div></div>
    <div class="content_middle">
        <div class="table_over_flow">
        <table class="fl clr list_table">
        	<tr><th><?php echo $this->Lang['S_NO']; ?></th>
            	<th width="26%"><?php echo $this->Lang["CATEGORY_NAME"]; ?></th>
                <!--<th  align="left" width="30%">Category Mapping</th>-->
                <?php /*<th align="left" width="10%">Image</th> */?>
                <?php if(ADMIN_PRIVILEGES_CATEGORIES_ADD){?>
                <th align="left" ><?php echo $this->Lang['ADD_SUB_CAT']; ?></th>
                <?php }?>
		<th align="left" ><?php echo $this->Lang['MANAGE_SUB_CAT']; ?></th>
		<?php if(ADMIN_PRIVILEGES_CATEGORIES_EDIT){?>
                <th align="left" width="10%" ><?php echo $this->Lang["EDIT"]; ?></th>
                <?php }?>
                <?php if(ADMIN_PRIVILEGES_CATEGORIES_BLOCK){?>
                <th align="left" width="10%" ><?php echo $this->Lang["STATUS"]; ?></th>
                <th align="left" width="27%" ><?php echo $this->Lang["DELETE"]; ?></th>
                <?php }?>
            </tr>
            <?php $i=1; foreach($this->category_list as $c){ ?>
            <tr>
                <td><?php echo $i;?></td>
                <td><?php echo ucfirst(htmlspecialchars($c->category_name));?>
					
				</td>
               <!-- <td><?php echo $c->category_mapping ?></td>--->
					<?php /*<td align="left">
						<?php
						
						$Cat_img_URL = "images/category/icon/".url::title($c->category_name).".png";
						if(file_exists($Cat_img_URL)){?> <img src="<?php echo PATH."images/category/icon/".url::title($c->category_name).".png";?>" /> <?php } ?></td>
							*/ ?>
				<?php if(ADMIN_PRIVILEGES_CATEGORIES_ADD){?>			
		        <td align="center">
					 <?php if($c->category_status ==1){?> 
                    	<a <?php if($c->category_status ==1){?> href="<?php echo PATH.'admin/add-sec-sub-category/'.$c->category_id.'/'.$c->category_url;?>.html"  <?php } ?>   ><img src="<?php echo PATH."images/add_branch.png";?>" title="<?php echo $this->Lang['ADD_SUB_CAT']; ?>"/></a>
                    	<?php } else { ?>
                    	<img src="<?php echo PATH.'images/Block_icon.png';?>" title="<?php echo $this->Lang['CAT_BLOG_CANT_AD']; ?>"/>
                    	<?php } ?>
                        </td>
                      <?php }?>  
                        <td align="center">
                    	<a href="<?php echo PATH.'admin/manage-sec-sub-category/'.$c->category_id.'/'.$c->category_url;?>.html" ><img src="<?php echo PATH."images/manage_branch.png";?>" title="<?php echo $this->Lang['MANAGE_SUB_CAT']; ?>"/>
                    	<?php $j = 0; foreach( $this->sub_category_list as $s){ if(($s->category_status ==1) && ($s->sub_category_id == $c->category_id)){ $j++; }} echo "(".$j.")  ".$this->Lang['CATEGORIES1']; ?> </a> 
                        </td>
                      
                      <?php if(ADMIN_PRIVILEGES_CATEGORIES_EDIT){?>  

                    <td>
					<a href="<?php echo PATH.'admin/edit-sub-category/'.$c->category_id.'/'.$c->category_url;?>.html" class="editicon" title="<?php echo $this->Lang['EDIT_CATEGORY']; ?>"></a>
                  	</td>
                  	<?php }?>
                  	<?php if(ADMIN_PRIVILEGES_CATEGORIES_BLOCK){?>
                    <td>
						<?php if($c->category_status == 1){?>
                    	<a onclick="return blockunblockSubCategory('<?php echo $c->main_category_id; ?>','<?php echo $c->category_id; ?>','<?php echo $c->category_url; ?>','block');" class="blockicon" title="<?php echo $this->Lang['BLO_CAT']; ?>"></a>
                        <?php } elseif($c->category_status==0){  ?>
                        <a onclick="return blockunblockSubCategory('<?php echo $c->main_category_id; ?>','<?php echo $c->category_id; ?>','<?php echo $c->category_url; ?>','unblock');" class="unblockicon" title="<?php echo $this->Lang['UNBLO_CAT']; ?>"></a>
                        <?php } ?>
                    </td>
                    <td>
						<a onclick="return deleteCategory('<?php echo $c->category_id; ?>','<?php echo $c->category_url; ?>');" class="deleteicon" title="<?php echo $this->Lang['DELETE']; ?>" ></a>
                    </td>
                   <?php }?>
            </tr>
            <?php $i++; } ?>
        </table>
        </div>
    </div>
    <div class="content_bottom"><div class="bot_left"></div><div class="bot_center"></div><div class="bot_rgt"></div></div>
</div>
