<?php defined('SYSPATH') OR die('No direct access allowed.'); ?>
<div class="bread_crumb"><a href="<?php echo PATH."admin.html"; ?>" title="<?php echo $this->Lang['HOME']; ?>"><?php echo $this->Lang["HOME"]; ?> <span class="fwn">&#155;&#155;</span></a><p><?php echo $this->template->title; ?></p></div>
<div class="cont_container mt15 mt10">
    <div class="content_top"><div class="top_left"></div><div class="top_center"></div><div class="top_rgt"></div></div>
    <div class="content_middle">
        <form action="" method="post" class="admin_form" enctype="multipart/form-data">
            <table>  
                <tr>
                    <td><label><?php echo $this->Lang["TOP_CATEGORY_NAME"]; ?></label><span>*</span></td>
                    <td><label>:</label></td>
                    <td><input autofocus type="text" name="category" maxlength="255" title="<?php echo $this->Lang['CATEGORY_NAME']; ?>" value="<?php if(!isset($this->form_error["category"]) && isset($this->userPost["category"])){ echo $this->userPost["category"]; }?>" />
                    <em><?php if(isset($this->form_error["category"])){ echo $this->form_error["category"]; }?></em></td>
                </tr>
                <!--<tr>
                    <td><label>Category Mapping</label></td>
                    <td><label>:</label></td>
                    <td><textarea name="category_mapping"></textarea>
                    <em><?php if(isset($this->form_error["category_mapping"])){ echo $this->form_error["category_mapping"]; }?></em></td>
                </tr>-->
                <tr>
                    <td><label><?php echo $this->Lang["CATEGORY_STATUS"]; ?></label></td>
                    <td><label>:</label></td>
                    <td><input  type="radio"  name="status" checked="checked" title="<?php echo $this->Lang['ACTIVE']; ?>"  value="1"/><?php echo $this->Lang["ACTIVE"]; ?> <input  type="radio"  title="<?php echo $this->Lang['DEACTIVE']; ?>" name="status"  value="0" /> <?php echo $this->Lang["DEACTIVE"]; ?>
                    </td>
                </tr>

				 <tr>
                    <td><label><?php echo $this->Lang['TYPE']; ?></label></td>
                    <td><label>:</label></td>
                    <td><input  type="checkbox"  name="deal" checked="checked" value="1"/><?php echo $this->Lang['DEALS']; ?> <input  type="checkbox"  name="product" value="1"/><?php echo $this->Lang['PRODUCTS']; ?> <input  type="checkbox"  name="auction" value="1"/><?php echo $this->Lang['AUCTION']; ?>
							<em><?php if(isset($this->form_error["type_error"])){ echo $this->form_error["type_error"]; }?></em>
                    </td>
                </tr>
                
             <?php 
		/**   <tr>
                    <td><label>Category Image</label></td>
                    <td><label>:</label></td>
                    <td>
                    	<input type="file" name="icon" />
                    	<em><?php if(isset($this->form_error["icon"])){ echo $this->form_error["icon"]; }?></em>
                    </td>
                </tr> **/
             ?>

                <tr>
                    <td><label><?php echo $this->Lang['LIST_CATE_IMAGE']; ?></label></td>
                    <td><label>:</label></td>
                    <td>
                    	<input type="file" name="list_icon" />
                    	<em><?php if(isset($this->form_error["list_icon"])){ echo $this->form_error["list_icon"]; }?></em>
                    	<label><?php echo $this->Lang['IMG_UP']; ?> 200 * 280 </label>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td><input type="submit" value="<?php echo $this->Lang['SUBMIT']; ?>"  /><input type="reset" value="<?php echo $this->Lang['RESET']; ?>" onclick="javascript:window.location='<?php echo PATH; ?>admin/add-category.html'"/></td>
                </tr>
            </table>
        </form>
    </div>
    <div class="content_bottom"><div class="bot_left"></div><div class="bot_center"></div><div class="bot_rgt"></div></div>
</div>
