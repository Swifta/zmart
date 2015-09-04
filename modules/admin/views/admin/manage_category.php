<?php defined('SYSPATH') OR die('No direct access allowed.'); ?>
<div class="bread_crumb"><a href="<?php echo PATH."admin.html"; ?>" title="<?php echo $this->Lang['HOME']; ?>"><?php echo $this->Lang["HOME"]; ?> <span class="fwn">&#155;&#155;</span></a><p><?php echo $this->template->title; ?></p></div>
<div class="cont_container mt15 mt10">
    <div class="content_top"><div class="top_left"></div><div class="top_center"></div><div class="top_rgt"></div></div>
    <div class="content_middle">
        <div class="table_over_flow">
        <table class="fl clr list_table">
        <?php $this->session->set("lasturl",substr($_SERVER['REQUEST_URI'], REQUEST_URL_COUNT));  ?>
        	<tr><th ><?php echo $this->Lang['S_NO']; ?></th>
            	<th width="26%"><?php echo $this->Lang["CATEGORY_NAME"]; ?></th>
                <!--<th  align="left" width="30%">Category Mapping</th>-->
                <th align="left" width="10%"><?php echo $this->Lang['IMAGE']; ?></th>
                <th align="left" width="10%">Sort Order</th>
                <?php if(ADMIN_PRIVILEGES_CATEGORIES_ADD){?>
				<th align="left" ><?php echo $this->Lang['ADD_MAIN_CAT']; ?></th>
				<?php }?>
				<th align="left" ><?php echo $this->Lang['MANAGE_MAIN_CAT']; ?></th>
				<?php if(ADMIN_PRIVILEGES_CATEGORIES_EDIT){?>
                <th align="left" width="5%" ><?php echo $this->Lang["EDIT"]; ?></th>
                <?php }?>
                <?php if(ADMIN_PRIVILEGES_CATEGORIES_BLOCK){?>
                <th align="left" width="5%" ><?php echo $this->Lang["STATUS"]; ?></th>
                <th align="left" width="5%" ><?php echo $this->Lang["DELETE"]; ?></th>
                <?php }?>
            </tr>
            <?php $i=1; foreach($this->category_list as $c){ if($c->main_category_id == 0){ ?>
            <tr>
                <td><?php echo $i;?></td>
                <td><?php echo ucfirst(htmlspecialchars($c->category_name));?></td>
               <!-- <td><?php echo $c->category_mapping ?></td>--->
					<td align="left">
						<?php
						
						$Cat_img_URL = "images/category/icon/".url::title($c->category_name).".png";
						if(file_exists($Cat_img_URL)){?> 
						<img src="<?php echo PATH."images/category/icon/".url::title($c->category_name).".png";?>" style="width:60px;height:75px;"/> <?php } ?></td>
					<td>
						<?php if($c->category_status==1){?>
						<select name="sort_order" id="sort_order_<?php echo $c->category_id;?>" onchange="change_sortorder(this.value,<?php echo $c->category_id;?>);">
							<option value='0' <?php if($c->order_by==0){ echo "selected='selected'"; }?>>---</option>
							<option value='1' <?php if($c->order_by==1){ echo "selected='selected'"; }?>>1</option>
							<option value='2' <?php if($c->order_by==2){ echo "selected='selected'"; }?>>2</option>
							<option value='3' <?php if($c->order_by==3){ echo "selected='selected'"; }?>>3</option>
							<option value='4' <?php if($c->order_by==4){ echo "selected='selected'"; }?>>4</option>
							<option value='5' <?php if($c->order_by==5){ echo "selected='selected'"; }?>>5</option>
							<option value='6' <?php if($c->order_by==6){ echo "selected='selected'"; }?>>6</option>
							<option value='7' <?php if($c->order_by==7){ echo "selected='selected'"; }?>>7</option>
						</select>
						<?php }else{ echo " - - - "; }?>
						<input type="hidden" id="hdn_sort_val_<?php echo $c->category_id;?>" value="<?php echo $c->order_by;?>">
					</td>
					<?php if(ADMIN_PRIVILEGES_CATEGORIES_ADD){?>
					<td align="center">
					 <?php if($c->category_status ==1){?> 
                    	<a <?php if($c->category_status ==1){?> href="<?php echo PATH.'admin/add-sub-category/'.$c->category_id.'/'.$c->category_url;?>.html"  <?php } ?>   ><img src="<?php echo PATH."images/add_branch.png";?>" title="<?php echo $this->Lang['ADD_SUB_CAT']; ?>"/></a>
                    	<?php } else { ?>
                    	<img src="<?php echo PATH.'images/Block_icon.png';?>" title="<?php echo $this->Lang['CAT_BLOG_CANT_AD']; ?>"/>
                    	<?php } ?>
                        </td>
					<?php }?>
			<td align="center">
				
                    	<a href="<?php echo PATH.'admin/manage-sub-category/'.$c->category_id.'/'.$c->category_url;?>.html" ><img src="<?php echo PATH."images/manage_branch.png";?>" title="<?php echo $this->Lang['MANAGE_SUB_CAT']; ?>"/>
                    	<?php $j = 0; foreach( $this->sub_category_list as $s){ if(($s->category_status ==1) && ($s->main_category_id == $c->category_id)){ $j++; }} echo "(".$j.") ".$this->Lang['CATEGORIES1']; ?> </a> 
                    	
                        </td>
                     <?php if(ADMIN_PRIVILEGES_CATEGORIES_EDIT){?>
                    <td>
						<?php
							$edit = "edit-category";
							if($this->uri->last_segment() != "manage-category.html"){
								$edit = "edit-sub-category";
							}
                        ?>
                        
                    	<a href="<?php echo PATH.'admin/'.$edit.'/'.$c->category_id.'/'.$c->category_url;?>.html" class="editicon" title="<?php echo $this->Lang['EDIT_CATEGORY']; ?>"></a>
                    </td>
                    <?php }?>
                    <?php if(ADMIN_PRIVILEGES_CATEGORIES_BLOCK){?>
                    <td>
						<?php if($c->category_status == 1){?>
                    	<a onclick="return blockunblockCategory('<?php echo $c->category_id; ?>','<?php echo $c->category_url; ?>','block');" class="blockicon" title="<?php echo $this->Lang['BLO_CATEGORY']; ?>"></a>
                        <?php } else{  ?>
                        <a onclick="return blockunblockCategory('<?php echo $c->category_id; ?>','<?php echo $c->category_url; ?>','unblock');" class="unblockicon" title="<?php echo $this->Lang['UNBLO_CATEGORY']; ?>"></a>
                        <?php } ?>
                    </td>
                    <td>
						<a onclick="return deleteCategory('<?php echo $c->category_id; ?>','<?php echo $c->category_url; ?>');" class="deleteicon" title="<?php echo $this->Lang['DEL_CATEGORY']; ?>" ></a>
                    </td>
                    <?php }?>
            </tr>
            <?php $i++; } } ?>
        </table>
        </div>
    </div>
    <div class="content_bottom"><div class="bot_left"></div><div class="bot_center"></div><div class="bot_rgt"></div></div>
</div>
<script>
function change_sortorder(val,cat_id){
	$.post(SrcPath+'/admin/change_sortorder/'+val+'/'+cat_id,{ 
	}, function(response){
		if(response=='-1'){
			$('#sort_order_'+cat_id).val($('#hdn_sort_val_'+cat_id).val());
			alert("Error!. Sort Order already Exists.");
		}else{
			location.reload();
		}
	});

}
</script>
