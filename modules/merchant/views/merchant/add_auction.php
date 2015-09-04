<?php defined('SYSPATH') OR die("No direct access allowed."); ?>
<script type="text/javascript"> 
 $(document).ready(function(){
 	$("#ui-datepicker-div").hide();

		$('#startdate').datetimepicker({
				minDate: 'today',
			//timeFormat: 'hh:mm:ss'
		});	
		$('#enddate').datetimepicker({
				minDate: 'today',
			//timeFormat: 'hh:mm:ss'
		});
		$('#expirydate').datetimepicker({
				minDate: 'today',
			//timeFormat: 'hh:mm:ss'
		});
	}); 
	

</script>
<link rel="stylesheet" type="text/css" href="<?php echo PATH ?>css/jquery.cleditor.css">
<script type="text/javascript" src="<?php echo PATH ?>js/jquery.cleditor.min.js"></script>
 
<script type="text/javascript" src="<?php echo PATH ?>js/multiimage.js"></script>
<div class="bread_crumb"><a href="<?php echo PATH."merchant.html"; ?>" title="<?php echo $this->Lang["HOME"]; ?>"><?php echo $this->Lang["HOME"]; ?> <span class="fwn">&#155;&#155;</span></a><p><?php echo $this->template->title; ?></p></div>
<div class="cont_container mt15 mt10">
    <div class="content_top"><div class="top_left"></div><div class="top_center"></div><div class="top_rgt"></div></div>
    <div class="content_middle">
        <form action="" method="post" class="admin_form" enctype="multipart/form-data">
            <table>
                <tr>
                    <td><label><?php echo $this->Lang["TITLE"]; ?></label> <span>*</span></td>
		   
                    <td><label>:</label></td>
                    <td>
                    	<input type="text" name="title" maxlength="255" value="<?php if(!isset($this->form_error["title"])&&isset($this->userPost["title"])){ echo $this->userPost["title"]; }?>" autofocus tabindex="1" />
                      	<em><?php if(isset($this->form_error["title"])){ echo $this->form_error["title"]; }?></em>
                   	</td>
                </tr>
                
               
                
                <tr>
                    <td><label><?php echo $this->Lang["CATEGORY"]; ?></label><span>*</span></td>
                    <td><label>:</label></td>
                    <td>
                    	<select name="category" onchange="return merchant_change_category(this.value);">
                        	<option value=""><?php echo $this->Lang['SEL_CATEGORY']; ?></option>
							<?php foreach($this->category_list as $main){ if($main->product == 1 ) { ?>
                                    <option value="<?php echo $main->category_id?>" <option value="<?php echo $main->category_id?>" <?php if(!isset($this->form_error['category']) && isset($_POST['category'])){  if($_POST['category'] == $main->category_id){ ?>selected<?php } } ?>><?php echo ucfirst($main->category_name); ?></option>    
                            <?php } } ?>
                    	</select>
                    	<em><?php if(isset($this->form_error["category"])){ echo $this->form_error["category"]; }?></em>
					</td>
                </tr>
                     
                <tr id="category">
                    <td><label ><?php echo $this->Lang['SEL_MAIN_CAT']; ?></label><span>*</span></td>
                    <td><label>:</label></td>
                    <td >
                        <?php if(!isset($this->form_error['category']) && isset($_POST['category'])){ ?>
                        <select name="sub_category"   onchange="return merchant_sec_change_category(this.value);">

			<?php foreach($this->sub_category_list as $s){  ?>
				<?php if($s->main_category_id == $_POST['category']){ ?>
			                <option value="<?php echo $s->category_id; ?>" <?php if(isset($_POST['sub_category'])){ if($_POST['sub_category'] == $s->category_id){ ?> selected <?php } } ?> > <?php echo $s->category_name; ?></option>
				<?php } } ?>
		                </select>
			<?php } else{ ?>
		                <select name="sub_category">
		                <option value=""><?php echo $this->Lang['SEL_CAT_FIRST']; ?></option>
		                </select>
                        <?php } ?>
                        <em><?php if(isset($this->form_error["sub_category"])){ echo $this->form_error["sub_category"]; }?></em>
					</td>
                </tr> 
                
                 <tr id="sub_category">
                    <td><label ><?php echo $this->Lang['SEL_SUB_CAT']; ?></label><span>*</span></td>
                    <td><label>:</label></td>
                    <td >
                        <?php if(!isset($this->form_error['sub_category']) && isset($_POST['sub_category'])){ ?>
                        <select name="sec_category"  onchange="return merchant_third_change_category(this.value);">
			<?php foreach($this->sec_category_list as $s){  ?>
				<?php if($s->sub_category_id == $_POST['sub_category']){ ?>
			                <option value="<?php echo $s->category_id; ?>" <?php if(isset($_POST['sec_category'])){ if($_POST['sec_category'] == $s->category_id){ ?> selected <?php } } ?> > <?php echo $s->category_name; ?></option>
				<?php } else { ?><option value="">No Main Category</option> <?php  } } ?>
		                </select>
			<?php } else{ ?>
		                <select name="sec_category">
		                <option value=""><?php echo $this->Lang['MAIN_CAT_FIRST']; ?></option>
		                </select>
                        <?php } ?>
                        <em><?php if(isset($this->form_error["sec_category"])){ echo $this->form_error["sec_category"]; }?></em>
					</td>
                </tr> 
                
                <tr id="sec_category">
                    <td><label ><?php echo $this->Lang['SEL_SEC_SUB_CAT']; ?></label></td>
                    <td><label>:</label></td>
                    <td >
                        <?php if(!isset($this->form_error['third_category']) && isset($_POST['third_category'])){ ?>
                        <select name="third_category"   >
			<?php foreach($this->third_category_list as $s){  ?>
				<?php if($s->category_id == $_POST['third_category']){ ?>
			                <option value="<?php echo $s->category_id; ?>" <?php if(isset($_POST['third_category'])){ if($_POST['third_category'] == $s->category_id){ ?> selected <?php } } ?> > <?php echo $s->category_name; ?></option>
				<?php } else { ?><option value="">No Sub Category</option> <?php  } } ?>
		                </select>
			<?php } else{ ?>
		                <select name="third_category">
		                <option value=""><?php echo $this->Lang['SUB_CAT_FIRST']; ?></option>
		                </select>
                        <?php } ?>
                        <em><?php if(isset($this->form_error["third_category"])){ echo $this->form_error["third_category"]; }?></em>
			</td>
                </tr> 

                <tr>
                    <td><label><?php echo $this->Lang['PRODUCT_PRI']; ?></label><span>*</span></td>
                    <td><label>:</label></td>
                    <td>
                        <input type="text" name="product_price" maxlength="8" value="<?php if(!isset($this->form_error["product_price"])&&isset($this->userPost["product_price"])){ echo $this->userPost["product_price"]; }?>" />
                        <em><?php if(isset($this->form_error["product_price"])){ echo $this->form_error["product_price"]; }?></em>
                    </td>
                </tr>

                <tr>
                    <td><label><?php echo $this->Lang['AUC_PRICE']; ?></label><span>*</span></td>
                    <td><label>:</label></td>
                    <td>
                        <input type="text" name="deal_value" maxlength="8" value="<?php if(!isset($this->form_error["deal_value"])&&isset($this->userPost["deal_value"])){ echo $this->userPost["deal_value"]; }?>" />
                        <em><?php if(isset($this->form_error["deal_value"])){ echo $this->form_error["deal_value"]; }?></em>
                    </td>
                </tr>
                
                <tr>
                    <td><label><?php echo $this->Lang['BID_INCR']; ?></label><span>*</span></td>
                    <td><label>:</label></td>
                    <td>
                        <input type="text" name="bid_increment" maxlength="8" value="<?php if(!isset($this->form_error["bid_increment"])&&isset($this->userPost["bid_increment"])){ echo $this->userPost["bid_increment"]; }?>" />
                        <em><?php if(isset($this->form_error["bid_increment"])){ echo $this->form_error["bid_increment"]; }?></em>
                    </td>
                </tr>
                
                       <tr>
                    <td><label><?php echo $this->Lang["START_DATE"]; ?></label><span>*</span></td>
                    <td><label>:</label></td>
                    <td>
                    	<input type="text" id="startdate" name="start_date" readonly="readonly"  value="<?php if(!isset($this->form_error["start_date"])&&isset($this->userPost["start_date"])){ echo $this->userPost["start_date"]; }?>" />
                        <em><?php if(isset($this->form_error["start_date"])){ echo $this->form_error["start_date"]; }?></em>
                    </td>
                </tr>
                
                 <tr>
                    <td><label><?php echo $this->Lang["END_DATE"]; ?></label><span>*</span></td>
                    <td><label>:</label></td>
                    <td>
                    	<input type="text" name="end_date" id="enddate" readonly="readonly" value="<?php if(!isset($this->form_error['end_date'])&&isset($this->userPost['end_date'])){ echo $this->userPost['end_date']; }?>" />
                    	<em><?php if(isset($this->form_error["end_date"])){ echo $this->form_error["end_date"]; }?></em>
                    </td>
                </tr>
                
                <tr>
                    <td><label><?php echo $this->Lang['SHIP_FEE']; ?></label><span>*</span></td>
                    <td><label>:</label></td>
                    <td>
                        <input type="text" name="shipping_fee" maxlength="18" value="<?php if(!isset($this->form_error["shipping_fee"])&&isset($this->userPost["shipping_fee"])){ echo $this->userPost["shipping_fee"]; }?>" />
                        <em><?php if(isset($this->form_error["shipping_fee"])){ echo $this->form_error["shipping_fee"]; }?></em>
                    </td>
                 </tr>
                
                
                <tr>
                    <td><label><?php echo $this->Lang['SHIPP_INFO2']; ?></label><span>*</span></td>
                    <td><label>:</label></td>
                    <td>
                      <textarea name="shipping_info" ><?php if(!isset($this->form_error["shipping_info"])&&isset($this->userPost["shipping_info"])){ echo $this->userPost["shipping_info"]; }?></textarea>
                        <em><?php if(isset($this->form_error["shipping_info"])){ echo $this->form_error["shipping_info"]; }?></em>
                    </td>
		
                </tr>
                
		 <tr>
                    <td><label><?php echo $this->Lang["DESC"]; ?></label><span>*</span></td>
                    <td><label>:</label></td>
                    <td>
                      <textarea name="description" class="TextArea" ><?php if(!isset($this->form_error["description"])&&isset($this->userPost["description"])){ echo $this->userPost["description"]; }?></textarea>
                        <em><?php if(isset($this->form_error["description"])){ echo $this->form_error["description"]; }?></em>
                    </td>
		
                </tr>
		

              

                <tr>
                    <td><label><?php echo $this->Lang["SEL_SHOP"]; ?></label><span>*</span></td>
                    <td><label>:</label></td>
                    <td>
                        <select name="stores">
                        <option value=""><?php echo $this->Lang["SELECT_Y_SHOP"]; ?></option>

                    <?php foreach($this->shop_list as $d){ ?> 
                        <option value="<?php echo $d->store_id; ?>"><?php echo $d->store_name; ?></option>
                          <?php } ?>
                        </select>
                       <em><?php if(isset($this->form_error["stores"])){ echo $this->form_error["stores"]; }?></em>
                     </td>
                </tr>
               
                 <tr>
                    <td>
                        <input type="hidden" name="deal_type" value="3" />
                    </td>
                </tr>
                
                <tr>
                    <td><label><?php echo $this->Lang["META_KEY"]; ?></label></td>
                    <td><label>:</label></td>
                    <td>
                        <textarea name="meta_keywords"><?php if(!isset($this->form_error["meta_keywords"])&&isset($this->userPost["meta_keywords"])){ echo $this->userPost["meta_keywords"]; }?></textarea>
                        <em><?php if(isset($this->form_error["meta_keywords"])){ echo $this->form_error["meta_keywords"]; }?></em>
                    </td>
                </tr>
                
                <tr>
                    <td><label><?php echo $this->Lang["META_DESC"]; ?></label></td>
                    <td><label>:</label></td>
                    <td>
                        <textarea name="meta_description"><?php if(!isset($this->form_error["meta_description"])&&isset($this->userPost["meta_description"])){ echo $this->userPost["meta_description"]; }?></textarea>
                        <em><?php if(isset($this->form_error["meta_description"])){ echo $this->form_error["meta_description"]; }?></em>
                    </td>
                </tr>        
                <tr>
                    <td><label>Auction Products Images</label></td>
                    <td><label>:</label></td>
                                
                    <td>
                        <div class = "inputs">
                        <input type="file" name="image[]"  id="first" onchange="return validateFileExtension(this)" /></div>
                        <input type="button" id="add" value="More Image" >
                        <input type="button" id="remove" value="Remove" >
                        <em><?php if(isset($this->form_error["image"])){ echo $this->form_error["image"]; }?></em>
                        
                        <label><?php echo $this->Lang['IMG_UP_S']; ?> </label>
                    </td>
                </tr>
                
		 <?php /*<tr>
                    <td><label><?php echo $this->Lang['AUTO_PO_FA']; ?> </label></td>
                    <td><label>:</label></td>
                    <td>


		 <input type="radio" name="autopost" <?php if($this->session->get("facebook_status")==1) {?> checked <?php } ?>  value="1" > <?php echo $this->Lang['YES']; ?> <input type="radio" name="autopost" value="2"> <?php echo $this->Lang['NO']; ?>
			</td>
                </tr> */?>

                <tr>
                    <td></td>
                    <td></td>
                    <td><input type="submit" id="submit" value="<?php echo $this->Lang['SUBMIT']; ?>" /><input type="button" value="<?php echo $this->Lang['RESET']; ?>" onclick="javascript:window.location='<?php echo PATH; ?>merchant/add-auction.html'"/></td>
                </tr>
            </table>
        </form>
        
    </div>
    <div class="content_bottom"><div class="bot_left"></div><div class="bot_center"></div><div class="bot_rgt"></div></div>
</div>
