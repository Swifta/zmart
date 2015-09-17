<?php defined('SYSPATH') OR die('No direct access allowed.'); ?>
<div class="bread_crumb"><a href="<?php echo PATH."admin.html"; ?>" title="<?php echo $this->Lang['HOME']; ?>"><?php echo $this->Lang["HOME"]; ?> <span class="fwn">&#155;&#155;</span></a><p><?php echo $this->template->title; ?></p></div>
<div class="cont_container mt15 mt10">
    <div class="content_top"><div class="top_left"></div><div class="top_center"></div><div class="top_rgt"></div></div>
    <div class="content_middle">  
    <?php foreach($this->category_data as $c){ ?>
        <form action="" method="post" class="admin_form" enctype="multipart/form-data">
            <table>  
                <tr>
                    <td><label><?php echo $this->Lang["CATEGORY_NAME"]; ?></label><span>*</span></td>
                    <td><label>:</label></td>
                    <td><input type="text" name="category" maxlength="100" value="<?php echo $c->category_name ?>" title="<?php echo $this->Lang['CATEGORY_NAME']; ?>" />
                    <em><?php if(isset($this->form_error["category"])){ echo $this->form_error["category"]; }?></em></td>
                </tr>

                <!--<tr>
                    <td><label>Category Mapping</label></td>
                    <td><label>:</label></td>
                    <td><textarea name="category_mapping"><?php echo $c->category_mapping;?></textarea>
                    <em><?php if(isset($this->form_error["category_mapping"])){ echo $this->form_error["category_mapping"]; }?></em></td>
                </tr>-->

                <tr>
                    <td><label><?php echo $this->Lang["CATEGORY_STATUS"]; ?></label></td>
                    <td><label>:</label></td>
                    <td><input  type="radio"  name="status" <?php if($c->category_status == 1){?> checked="checked" <?php } ?>  value="1"/> <?php echo $this->Lang["ACTIVE"]; ?> <input  type="radio" name="status"  value="0" <?php if($c->category_status == 0){?> checked="checked" <?php } ?> /> <?php echo $this->Lang["DEACTIVE"]; ?>
                    </td>
                </tr>
                
		<tr>
                    <td><label><?php echo $this->Lang['TYPE']; ?></label></td>
                    <td><label>:</label></td>
                    <td><input  type="checkbox"  name="deal" <?php if($c->deal == 1 ){ ?> checked <?php } ?> value="1"/><?php echo $this->Lang['DEALS']; ?> <input  type="checkbox"  name="product" <?php if($c->product == 1 ){ ?> checked <?php } ?> value="1"/><?php echo $this->Lang['PRODUCTS']; ?> <input  type="checkbox"  name="auction" <?php if($c->auction == 1 ){ ?> checked <?php } ?> value="1"/><?php echo $this->Lang['AUCTION']; ?> 
			<em><?php if(isset($this->form_error["type_error"])){ echo $this->form_error["type_error"]; }?></em>
                    </td>
                </tr>

                <tr>
                    <td><label><?php echo $this->Lang['LIST_CATE_IMAGE']; ?></label></td>
                    <td><label>:</label></td>
                    <td>
                        <input type="file" name="list_icon" />
                        <?php                                 
                        $imgSRC_list = "images/category/icon/".url::title($c->category_name).".png";
                        if(file_exists(DOCROOT.$imgSRC_list)){?>   
                        <img border="0" src= "<?php echo PATH.$imgSRC_list;?>" alt="<?php echo $c->category_name; ?>"/>
                        <?php } ?>
                        <em><br /><?php if(isset($this->form_error["list_icon"])){ echo $this->form_error["list_icon"]; }?></em>
                        <label><?php echo $this->Lang['IMG_UP']; ?> 200 * 280 </label>
                    </td>
                </tr>
                
                <tr>
                    <td></td>
                    <td></td>
                    <td><input type="submit" value="<?php echo $this->Lang['SUBMIT']; ?>"  /><input type="button" value="<?php echo $this->Lang['CANCEL']; ?>" onclick="window.location.href='<?php echo PATH?>admin/manage-category.html'"/></td>
                </tr>
            </table>
        </form>
    <?php } ?>
    </div>
    <div class="content_bottom"><div class="bot_left"></div><div class="bot_center"></div><div class="bot_rgt"></div></div>
</div>
