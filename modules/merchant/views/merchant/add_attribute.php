<?php defined('SYSPATH') OR die('No direct access allowed.'); ?>
<div class="bread_crumb"><a href="<?php echo PATH."merchant.html"; ?>" title="<?php echo $this->Lang['HOME']; ?>"><?php echo $this->Lang["HOME"]; ?> <span class="fwn">&#155;&#155;</span></a><p><?php echo $this->template->title; ?></p></div>
<div class="cont_container mt15 mt10">
    <div class="content_top"><div class="top_left"></div><div class="top_center"></div><div class="top_rgt"></div></div>
    <div class="content_middle">
	
        <form action="" method="post" class="admin_form">
            <table>
                 <tr>
                    <td><label><?php echo $this->Lang['ATTR_LABEL']; ?></label><span>*</span></td>
                    <td><label>:</label></td>
                    <td><input autofocus type="text" name="name" maxlength="100" value="<?php if(!isset($this->form_error['name']) && isset($this->userPost['name'])){ echo $this->userPost['name']; }?>" />
                    <em><?php if(isset($this->form_error["name"])){ echo $this->form_error["name"]; }?></em></td>
                </tr>
                
				<tr>
                    <td><label><?php echo $this->Lang['ATTR_GROUP_LABEL']; ?></label><span>*</span> </td>
                    <td><label>:</label></td>
                    <td> <select name="attribute_group">
						<?php
						if(count($this->attribute_groups) > 0){
							?>
						<option value="-1"><?php echo $this->Lang['SEL_ATTR_GROUP'];?></option>
						<?php
						foreach($this->attribute_groups as $group){
							?>
						<option value="<?php echo $group->attribute_group_id;?>" <?php echo (isset($this->userPost['attribute_group']) && $this->userPost['attribute_group']==$group->attribute_group_id)?"selected='selected'":"";?> > <?php echo $group->groupname;?></option>
						<?php }
						}else{
							?>
							<option value="-1"><?php echo $this->Lang['NO_ATTR_GROUP'];?></option>
							<?php } ?>
					</select>
                    <em><?php if(isset($this->form_error["attribute_group"])){ echo str_replace("attribute_group","sortattribute_grouporder",$this->form_error["attribute_group"]); }?></em></td>
                </tr>
				
				<tr>
                    <td><label><?php echo $this->Lang['SORT_ORDER']; ?></label> </td>
                    <td><label>:</label></td>
                    <td><input type="text" name="sort_order" size="2" style="width:10%" maxlength="2" value="<?php if(!isset($this->form_error['sort_order']) && isset($this->userPost['sort_order'])){ echo $this->userPost['sort_order']; }?>" />
                    <em><?php if(isset($this->form_error["sort_order"])){ echo str_replace("sort_order","sort order",$this->form_error["sort_order"]); }?></em></td>
                </tr>
				
                <tr>
                    <td></td>
                    <td></td>
                    <td><input type="submit" value="<?php echo $this->Lang['SUBMIT']; ?>" /><input type="reset" value="<?php echo $this->Lang['RESET']; ?>" onclick="javascript:window.location='<?php echo PATH; ?>merchant/add-attribute.html'"/></td>
                </tr>
            </table>
        </form>
    </div>
    <div class="content_bottom"><div class="bot_left"></div><div class="bot_center"></div><div class="bot_rgt"></div></div>
</div>
