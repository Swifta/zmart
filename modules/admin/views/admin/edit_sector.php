<?php defined('SYSPATH') OR die('No direct access allowed.'); ?>
<div class="bread_crumb"><a href="<?php echo PATH."admin.html"; ?>" title="<?php echo $this->Lang['HOME']; ?>"><?php echo $this->Lang["HOME"]; ?> <span class="fwn">&#155;&#155;</span></a><p><?php echo $this->template->title; ?></p></div>
<div class="cont_container mt15 mt10">
    <div class="content_top"><div class="top_left"></div><div class="top_center"></div><div class="top_rgt"></div></div>
    <div class="content_middle">
	
        <form action="" method="post" class="admin_form">
            <table>
		<?php foreach($this->groupData as $row ){ ?>
             <?php /*   <tr>
                        <td><label><?php echo $this->Lang["CATEGORY"]; ?></label><span>*</span></td>
                        <td><label>:</label></td>
                        <td>
                        <select name="category" >
                        <option value=""><?php echo $this->Lang['SEL_CATEGORY']; ?></option>
                        <?php foreach($this->category_list as $main){  ?>
                        <option value="<?php echo $main->category_id?>" <?php if($main->category_id == $row->categoryid){ ?>selected<?php } ?>><?php echo ucfirst($main->category_name); ?></option>    
                        <?php } ?>
                        </select>
                        <em><?php if(isset($this->form_error["category"])){ echo $this->form_error["category"]; }?></em>
                        </td>
                </tr>  */?>
                     
                 <tr>
                    <td><label><?php echo $this->Lang['SECTOR_NAME']; ?></label><span>*</span></td>
                    <td><label>:</label></td>
                    <td><input type="text" name="sector" maxlength="63" value="<?php echo $row->sector_name; ?>" autofocus />
                    <em><?php if(isset($this->form_error["sector"])){ echo $this->form_error["sector"]; }?></em></td>
                </tr>
                
                <tr>
                    <td></td>
                    <td></td>
                    <td><input type="submit" value="<?php echo $this->Lang['SUBMIT']; ?>" /><input type="reset" value="<?php echo $this->Lang['CANCEL']; ?>" onclick="javascript:window.location='<?php echo PATH; ?>admin/manage-sector.html'"/></td>
                </tr>
		<?php } ?>
            </table>
        </form>
    </div>
    <div class="content_bottom"><div class="bot_left"></div><div class="bot_center"></div><div class="bot_rgt"></div></div>
</div>
