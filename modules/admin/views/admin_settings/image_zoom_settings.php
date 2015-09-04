<?php defined('SYSPATH') OR die('No direct access allowed.'); ?>
<div class="bread_crumb"><a href="<?php echo PATH."admin.html"; ?>" title="<?php echo $this->Lang['HOME']; ?>"><?php echo $this->Lang["HOME"]; ?> <span class="fwn">&#155;&#155;</span></a><p><?php echo $this->template->title; ?></p></div>
<div class="cont_container mt15 mt10">
    <div class="content_top"><div class="top_left"></div><div class="top_center"></div><div class="top_rgt"></div></div>
    <div class="content_middle">
       
      
			<form action="" name="image" method="post" class="admin_form">
 <?php foreach($this->image_settings_data as $general){ ?>
		<?php if($general->type == 1) { ?>
	<div class="mergent_det">
	<fieldset>
   		<legend><?php echo 'Common'; ?></legend>
            <table>
             	
            	 <tr >
                    <td style="width: 100px;"></td>
                    <td></td>
                    <td style="padding: 0 0 0 105px;"><?php echo $this->Lang['WIDTH']; ?></td>
					<td style="padding: 0 0 0 105px;"><?php echo $this->Lang['HEIGHT']; ?></td>
                </tr>
                <tr >
                    <td style="width: 100px;"><label><?php echo $this->Lang['LOGO']; ?></label><span>*</span></td>
                    <td><label>:</label></td>
                    <td ><input type="text" name="logo_width" maxlength="4" value="<?php echo $general->list_width; ?>" autofocus />
                    <em><?php if(isset($this->form_error["logo_width"])){ echo $this->form_error["logo_width"]; }?></em></td>
					<td ><input type="text" name="logo_height" maxlength="4" value="<?php echo $general->list_height; ?>" />
                    <em><?php if(isset($this->form_error["logo_height"])){ echo $this->form_error["logo_height"]; }?></em></td>
                </tr>

                <tr >
                    <td style="width: 100px;"><label><?php echo $this->Lang['FAVI']; ?></label><span>*</span></td>
                    <td><label>:</label></td>
                    <td ><input type="text" name="favicon_width" maxlength="4" value="<?php echo $general->detail_width; ?>" />
                    <em><?php if(isset($this->form_error["favicon_width"])){ echo $this->form_error["favicon_width"]; }?></em></td>
					<td ><input type="text" name="favicon_height" maxlength="4" value="<?php echo $general->detail_height; ?>" />
                    <em><?php if(isset($this->form_error["favicon_height"])){ echo $this->form_error["favicon_height"]; }?></em></td>
						
                </tr>
				<tr >
                    <td style="width: 100px;"><label><?php echo $this->Lang['CATEGORY']; ?></label><span>*</span></td>
                    <td><label>:</label></td>
                    <td ><input type="text" name="category_width" maxlength="4" value="<?php echo $general->thumb_width; ?>" />
                    <em><?php if(isset($this->form_error["category_width"])){ echo $this->form_error["category_width"]; }?></em></td>
					<td ><input type="text" name="category_height" maxlength="4" value="<?php echo $general->thumb_height; ?>" />
                    <em><?php if(isset($this->form_error["category_height"])){ echo $this->form_error["category_height"]; }?></em></td>
						
                </tr>
               			<input type="hidden" name="common" value="1">
		</table>	
			
	</fieldset>
		
</div>
	<?php } if($general->type == 2) { ?>
	
	<div class="mergent_det2">
	<fieldset>
   		<legend><?php echo 'Deal'; ?></legend>
            <table>
             	
            	 <tr >
                    <td style="width: 100px;"></td>
                    <td></td>
                    <td style="padding: 0 0 0 105px;"><?php echo $this->Lang['WIDTH']; ?></td>
					<td style="padding: 0 0 0 105px;"><?php echo $this->Lang['HEIGHT']; ?></td>
                </tr>
                <tr >
                    <td style="width: 100px;"><label><?php echo $this->Lang['LIST']; ?></label><span>*</span></td>
                    <td><label>:</label></td>
                    <td ><input type="text" name="deal_list_width" maxlength="4" value="<?php echo $general->list_width; ?>" />
                    <em><?php if(isset($this->form_error["deal_list_width"])){ echo $this->form_error["deal_list_width"]; }?></em></td>
					<td ><input type="text" name="deal_list_height" maxlength="4" value="<?php echo $general->list_height; ?>" />
                    <em><?php if(isset($this->form_error["deal_list_height"])){ echo $this->form_error["deal_list_height"]; }?></em></td>
                </tr>

                <tr >
                    <td style="width: 100px;"><label><?php echo $this->Lang['DETAIL']; ?></label><span>*</span></td>
                    <td><label>:</label></td>
                    <td ><input type="text" name="deal_detail_width" maxlength="4" value="<?php echo $general->detail_width; ?>" />
                    <em><?php if(isset($this->form_error["deal_detail_width"])){ echo $this->form_error["deal_detail_width"]; }?></em></td>
					<td ><input type="text" name="deal_detail_height" maxlength="4" value="<?php echo $general->detail_height; ?>" />
                    <em><?php if(isset($this->form_error["deal_detail_height"])){ echo $this->form_error["deal_detail_height"]; }?></em></td>
                </tr>
				 <tr >
                    <td style="width: 100px;"><label><?php echo $this->Lang['THUMB']; ?></label><span>*</span></td>
                    <td><label>:</label></td>
                    <td ><input type="text" name="deal_thumb_width" maxlength="4" value="<?php echo $general->thumb_width; ?>" />
                    <em><?php if(isset($this->form_error["deal_thumb_width"])){ echo $this->form_error["deal_thumb_width"]; }?></em></td>
					<td ><input type="text" name="deal_thumb_height" maxlength="4" value="<?php echo $general->thumb_height; ?>" />
                    <em><?php if(isset($this->form_error["deal_thumb_height"])){ echo $this->form_error["deal_thumb_height"]; }?></em></td>
                </tr>
               			<input type="hidden" name="deal" value="2">	
               
		</table>
			
	</fieldset>
		
</div>
	<?php } if($general->type == 3 ) { ?>
	
<div class="mergent_det2">
	<fieldset>
   		<legend><?php echo 'Product'; ?></legend>
            <table>
             	
            	 <tr >
                    <td style="width: 100px;"></td>
                    <td></td>
                    <td style="padding: 0 0 0 105px;"><?php echo $this->Lang['WIDTH']; ?></td>
					<td style="padding: 0 0 0 105px;"><?php echo $this->Lang['HEIGHT']; ?></td>
                </tr>
                <tr >
                    <td style="width: 100px;"><label><?php echo $this->Lang['LIST']; ?></label><span>*</span></td>
                    <td><label>:</label></td>
                    <td ><input type="text" name="product_list_width" maxlength="4" value="<?php echo $general->list_width; ?>" />
                    <em><?php if(isset($this->form_error["product_list_width"])){ echo $this->form_error["product_list_width"]; }?></em></td>
					<td ><input type="text" name="product_list_height" maxlength="4" value="<?php echo $general->list_height; ?>" />
                    <em><?php if(isset($this->form_error["product_list_height"])){ echo $this->form_error["product_list_height"]; }?></em></td>
                </tr>

                <tr >
                    <td style="width: 100px;"><label><?php echo $this->Lang['DETAIL']; ?></label><span>*</span></td>
                    <td><label>:</label></td>
                    <td ><input type="text" name="product_detail_width" maxlength="4" value="<?php echo $general->detail_width; ?>" />
                    <em><?php if(isset($this->form_error["product_detail_width"])){ echo $this->form_error["product_detail_width"]; }?></em></td>
					<td ><input type="text" name="product_detail_height" maxlength="4" value="<?php echo $general->detail_height; ?>" />
                    <em><?php if(isset($this->form_error["product_detail_height"])){ echo $this->form_error["product_detail_height"]; }?></em></td>
                </tr>
				 <tr >
                    <td style="width: 100px;"><label><?php echo $this->Lang['THUMB']; ?></label><span>*</span></td>
                    <td><label>:</label></td>
                    <td ><input type="text" name="product_thumb_width" maxlength="4" value="<?php echo $general->thumb_width; ?>" />
                    <em><?php if(isset($this->form_error["product_thumb_width"])){ echo $this->form_error["product_thumb_width"]; }?></em></td>
					<td ><input type="text" name="product_thumb_height" maxlength="4" value="<?php echo $general->thumb_height; ?>" />
                    <em><?php if(isset($this->form_error["product_thumb_height"])){ echo $this->form_error["product_thumb_height"]; }?></em></td>
                </tr>
               			<input type="hidden" name="product" value="3">	
               
		</table>
	</fieldset>
</div>
	<?php } if($general->type == 4 ) { ?>
<div class="mergent_det2">
	
	<fieldset>
   		<legend><?php echo 'Auction'; ?></legend>
            <table>
             	
            	 <tr >
                    <td style="width: 100px;"></td>
                    <td></td>
                    <td style="padding: 0 0 0 105px;"><?php echo $this->Lang['WIDTH']; ?></td>
					<td style="padding: 0 0 0 105px;"><?php echo $this->Lang['HEIGHT']; ?></td>
                </tr>
                <tr >
                    <td style="width: 100px;"><label><?php echo $this->Lang['LIST']; ?></label><span>*</span></td>
                    <td><label>:</label></td>
                    <td ><input type="text" name="auction_list_width" maxlength="4" value="<?php echo $general->list_width; ?>" />
                    <em><?php if(isset($this->form_error["auction_list_width"])){ echo $this->form_error["auction_list_width"]; }?></em></td>
					<td ><input type="text" name="auction_list_height" maxlength="4" value="<?php echo $general->list_height; ?>" />
                    <em><?php if(isset($this->form_error["auction_list_height"])){ echo $this->form_error["auction_list_height"]; }?></em></td>
                </tr>

                <tr >
                    <td style="width: 100px;"><label><?php echo $this->Lang['DETAIL']; ?></label><span>*</span></td>
                    <td><label>:</label></td>
                    <td ><input type="text" name="auction_detail_width" maxlength="4" value="<?php echo $general->detail_width; ?>" />
                    <em><?php if(isset($this->form_error["auction_detail_width"])){ echo $this->form_error["auction_detail_width"]; }?></em></td>
					<td ><input type="text" name="auction_detail_height" maxlength="4" value="<?php echo $general->detail_height; ?>" />
                    <em><?php if(isset($this->form_error["auction_detail_height"])){ echo $this->form_error["auction_detail_height"]; }?></em></td>
                </tr>
				 <tr >
                    <td style="width: 100px;"><label><?php echo $this->Lang['THUMB']; ?></label><span>*</span></td>
                    <td><label>:</label></td>
                    <td ><input type="text" name="auction_thumb_width" maxlength="4" value="<?php echo $general->thumb_width; ?>" />
                    <em><?php if(isset($this->form_error["auction_thumb_width"])){ echo $this->form_error["auction_thumb_width"]; }?></em></td>
					<td ><input type="text" name="auction_thumb_height" maxlength="4" value="<?php echo $general->thumb_height; ?>" />
                    <em><?php if(isset($this->form_error["auction_thumb_height"])){ echo $this->form_error["auction_thumb_height"]; }?></em></td>
                </tr>
               			<input type="hidden" name="auction" value="4">	
               
		</table>
	</fieldset>
</div>
	
	<?php } if($general->type == 5 ) { ?>
<div class="mergent_det2">
	<fieldset>
    	<legend><?php echo 'Store'; ?></legend>   
			<table>
             	
            	 <tr >
                    <td style="width: 100px;"></td>
                    <td></td>
                    <td style="padding: 0 0 0 105px;"><?php echo $this->Lang['WIDTH']; ?></td>
					<td style="padding: 0 0 0 105px;"><?php echo $this->Lang['HEIGHT']; ?></td>
                </tr>
                <tr >
                    <td style="width: 100px;"><label><?php echo $this->Lang['LIST']; ?></label><span>*</span></td>
                    <td><label>:</label></td>
                    <td ><input type="text" name="store_list_width" maxlength="4" value="<?php echo $general->list_width; ?>" />
                    <em><?php if(isset($this->form_error["store_list_width"])){ echo $this->form_error["store_list_width"]; }?></em></td>
					<td ><input type="text" name="store_list_height" maxlength="4" value="<?php echo $general->list_height; ?>" />
                    <em><?php if(isset($this->form_error["store_list_height"])){ echo $this->form_error["store_list_height"]; }?></em></td>
                </tr>

                <tr >
                    <td style="width: 100px;"><label><?php echo $this->Lang['DETAIL']; ?></label><span>*</span></td>
                    <td><label>:</label></td>
                    <td ><input type="text" name="store_detail_width" maxlength="4" value="<?php echo $general->detail_width; ?>" />
                    <em><?php if(isset($this->form_error["store_detail_width"])){ echo $this->form_error["store_detail_width"]; }?></em></td>
					<td ><input type="text" name="store_detail_height" maxlength="4" value="<?php echo $general->detail_height; ?>" />
                    <em><?php if(isset($this->form_error["store_detail_height"])){ echo $this->form_error["store_detail_height"]; }?></em></td>
                </tr>
				 <tr >
                    <td style="width: 100px;"><label><?php echo $this->Lang['THUMB']; ?></label><span>*</span></td>
                    <td><label>:</label></td>
                    <td ><input type="text" name="store_thumb_width" maxlength="4" value="<?php echo $general->thumb_width; ?>" />
                    <em><?php if(isset($this->form_error["store_thumb_width"])){ echo $this->form_error["store_thumb_width"]; }?></em></td>
					<td ><input type="text" name="store_thumb_height" maxlength="4" value="<?php echo $general->thumb_height; ?>" />
                    <em><?php if(isset($this->form_error["store_thumb_height"])){ echo $this->form_error["store_thumb_height"]; }?></em></td>
                </tr>
               			<input type="hidden" name="store" value="5">	
               
		</table>
	</fieldset>
</div>       
		<?php } if($general->type == 6 ) { ?>
<div class="mergent_det2">
	<fieldset>
    	<legend><?php echo 'User/Banner'; ?></legend>   
			<table>
             	
            	 <tr >
                    <td style="width: 100px;"></td>
                    <td></td>
                    <td style="padding: 0 0 0 105px;"><?php echo $this->Lang['WIDTH']; ?></td>
					<td style="padding: 0 0 0 105px;"><?php echo $this->Lang['HEIGHT']; ?></td>
                </tr>
                <tr >
                    <td style="width: 100px;"><label><?php echo $this->Lang['USER_LI']; ?></label><span>*</span></td>
                    <td><label>:</label></td>
                    <td ><input type="text" name="user_list_width" maxlength="4" value="<?php echo $general->list_width; ?>" />
                    <em><?php if(isset($this->form_error["user_list_width"])){ echo $this->form_error["user_list_width"]; }?></em></td>
					<td ><input type="text" name="user_list_height" maxlength="4" value="<?php echo $general->list_height; ?>" />
                    <em><?php if(isset($this->form_error["user_list_height"])){ echo $this->form_error["user_list_height"]; }?></em></td>
                </tr>


                <tr >
                    <td style="width: 100px;"><label><?php echo $this->Lang['USER_DETA']; ?></label><span>*</span></td>
                    <td><label>:</label></td>
                    <td ><input type="text" name="user_detail_width" maxlength="4" value="<?php echo $general->detail_width; ?>" />
                    <em><?php if(isset($this->form_error["user_detail_width"])){ echo $this->form_error["user_detail_width"]; }?></em></td>
					<td ><input type="text" name="user_detail_height" maxlength="4" value="<?php echo $general->detail_height; ?>" />
                    <em><?php if(isset($this->form_error["user_detail_height"])){ echo $this->form_error["user_detail_height"]; }?></em></td>
                </tr>
				 <tr >
                    <td style="width: 100px;"><label><?php echo $this->Lang['BANA']; ?></label><span>*</span></td>
                    <td><label>:</label></td>
                    <td ><input type="text" name="banner_thumb_width" maxlength="4" value="<?php echo $general->thumb_width; ?>" />
                    <em><?php if(isset($this->form_error["banner_thumb_width"])){ echo $this->form_error["banner_thumb_width"]; }?></em></td>
					<td ><input type="text" name="banner_thumb_height" maxlength="4" value="<?php echo $general->thumb_height; ?>" />
                    <em><?php if(isset($this->form_error["banner_thumb_height"])){ echo $this->form_error["banner_thumb_height"]; }?></em></td>
                </tr>
               			<input type="hidden" name="user" value="6">	
               
		</table>
	</fieldset>
</div>       
<?php } if($general->type == 7 ) { ?>
<div class="mergent_det2">
	<fieldset>
    	<legend><?php echo 'Near Me Map'; ?></legend>   
			<table>
             	
            	 <tr >
                    <td style="width: 100px;"></td>
                    <td></td>
                    <td style="padding: 0 0 0 105px;"><?php echo $this->Lang['WIDTH']; ?></td>
		    <td style="padding: 0 0 0 105px;"><?php echo $this->Lang['HEIGHT']; ?></td>
                </tr>
                <tr >
                    <td style="width: 100px;"><label><?php echo $this->Lang['NEAR_LI']; ?></label><span>*</span></td>
                    <td><label>:</label></td>
                    <td><input type="text" name="map_list_width" maxlength="4" value="<?php echo $general->list_width; ?>" />
                    <em><?php if(isset($this->form_error["map_list_width"])){ echo $this->form_error["map_list_width"]; }?></em></td>
		    <td><input type="text" name="map_list_height" maxlength="4" value="<?php echo $general->list_height; ?>" />
                    <em><?php if(isset($this->form_error["map_list_height"])){ echo $this->form_error["map_list_height"]; }?></em></td>
                </tr>

			
               			<input type="hidden" name="map" value="7">	
               
		</table>
	</fieldset>
</div>       
<?php } ?>
<?php } ?>
			<table>
				<tr>
                   
                    <td style="padding:15px 0px 0px 223px;"><input type="submit" value="<?php echo $this->Lang['UPDATE']; ?>" title="<?php echo $this->Lang['UPDATE']; ?>" /><input type="button" title="<?php echo $this->Lang['CANCEL']; ?>"  value="<?php echo $this->Lang['CANCEL']; ?>" onclick='window.location.href="<?php echo PATH?>admin.html"'/></td>
                </tr>
            </table>

        </form>
        
    </div>
    <div class="content_bottom"><div class="bot_left"></div><div class="bot_center"></div><div class="bot_rgt"></div></div>
</div>
