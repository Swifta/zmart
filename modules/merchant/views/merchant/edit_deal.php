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
	$(document).ready(function(){
        $("#ui-datepicker-div").hide();
});

 </script>
 
<style>
#fade { background: #000; position: fixed; left: 0; top: 0; width: 100%; height: 100%; opacity: 0.5; z-index: 9999; }
.popup{ float: left;position: fixed; width:40%;  z-index: 99999; background: white; border-color:red;clear:both;top:42px; left:580px;  padding: 0px; }

</style>
<link rel="stylesheet" type="text/css" href="<?php echo PATH ?>css/jquery.cleditor.css">
<script type="text/javascript" src="<?php echo PATH ?>js/jquery.cleditor.min.js"></script>

<script type="text/javascript" src="<?php echo PATH ?>js/multiimage.js"></script>
<div class="bread_crumb"><a href="<?php echo PATH."merchant.html"; ?>" title="<?php echo $this->Lang['HOME']; ?>"><?php echo $this->Lang["HOME"]; ?> <span class="fwn">&#155;&#155;</span></a><p><?php echo $this->template->title; ?></p></div>
<div class="cont_container mt15 mt10">
    <div class="content_top"><div class="top_left"></div><div class="top_center"></div><div class="top_rgt"></div></div>
    <div class="content_middle">
        <form action="" method="post" class="admin_form" id="postForm" enctype="multipart/form-data">
        <?php foreach($this->deal as $u){?>
            <table>
                <tr>
                    <td><label><?php echo $this->Lang["TITLE"]; ?></label><span>*</span></td>
                    <td><label>:</label></td>
                    <td>
                    	<input type="text" name="title" maxlength="255" value="<?php echo $u->deal_title; ?>" autofocus />
                      	<em><?php if(isset($this->form_error["title"])){ echo $this->form_error["title"]; }?></em>
                   	</td>
                </tr>
               <tr>
                    <td><label><?php echo $this->Lang["CATEGORY"]; ?></label><span>*</span></td>
                    <td><label>:</label></td>
                    <td>
                    	<select name="category" onchange="return merchant_change_category(this.value);">
                        	<option value=""><?php echo $this->Lang['SEL_CATEGORY']; ?></option>
				  <?php foreach($this->category_list as $main){ if($main->deal == 1 ) { ?>
                                    <option value="<?php echo $main->category_id?>" <option value="<?php echo $main->category_id?>" <?php if($main->category_id == $u->category_id){ ?>selected<?php } ?>><?php echo ucfirst($main->category_name); ?></option>    
                            <?php } } ?>
                    	</select>
                    	<em><?php if(isset($this->form_error["category"])){ echo $this->form_error["category"]; }?></em>
					</td>
                </tr>
                     
                <tr id="category">
                    <td><label><?php echo $this->Lang['SEL_MAIN_CAT']; ?></label><span>*</span></td>
                    <td><label>:</label></td>
                    <td>
				 
                        <select name="sub_category" onchange="return merchant_sec_change_category(this.value);">
			<?php $cat_ids = explode(',',$u->sub_category_id); foreach($this->sub_category_list as $d){ if($u->category_id == $d->main_category_id) { ?>
			                <option value="<?php echo $d->category_id; ?>" <?php foreach($cat_ids as $ci){ if($d->category_id == $ci){ ?> selected <?php } } ?> > <?php echo $d->category_name; ?></option>
				<?php } }  ?>
		                </select>
			
                        <em><?php if(isset($this->form_error["sub_category"])){ echo $this->form_error["sub_category"]; }?></em>
					</td>
		
                </tr>      
                
                <tr id="sub_category">
                    <td><label><?php echo $this->Lang['SEL_SUB_CAT']; ?></label><span>*</span></td>
                    <td><label>:</label></td>
                    <td>
				 
                        <select name="sec_category" onchange="return merchant_third_change_category(this.value);">
			<?php $cat_ids = explode(',',$u->sec_category_id); foreach($this->sec_category_list as $d){ if($u->category_id == $d->main_category_id) { if($u->sub_category_id == $d->sub_category_id) { ?>
			                <option value="<?php echo $d->category_id; ?>" <?php foreach($cat_ids as $ci){ if($d->category_id == $ci){ ?> selected <?php } } ?> > <?php echo $d->category_name; ?></option>
				<?php } } } ?>
		                </select>
			
                        <em><?php if(isset($this->form_error["sec_category"])){ echo $this->form_error["sec_category"]; }?></em>
					</td>
		
                </tr>    
                
                 <tr id="sec_category">
                    <td><label><?php echo $this->Lang['SEL_SEC_SUB_CAT']; ?></label></td>
                    <td><label>:</label></td>
                    <td>
				 
                        <select name="third_category">
			<?php $cat_ids = explode(',',$u->third_category_id); $i = 1; foreach($this->third_category_list as $d){ if($u->sec_category_id == $d->sub_category_id) { ?>
			                <option value="<?php echo $d->category_id; ?>" <?php foreach($cat_ids as $ci){ if($d->category_id == $ci){ ?> selected <?php } } ?> > <?php echo $d->category_name; ?></option>
				<?php } else{ if($i ==1) {?>
		                <option value=""><?php echo $this->Lang['SUB_CAT_FIRST']; ?></option>
                        <?php } } $i++; } ?>
		                </select>
			
                        <em><?php if(isset($this->form_error["third_category"])){ echo $this->form_error["third_category"]; }?></em>
					</td>
		
                </tr>              
                    <td>
                        <input type="hidden" name="deal_type" value="1"/> 
                    </td>
               
                <tr>
                    <td><label><?php echo $this->Lang["PRICE"]; ?> </label><span>*</span></td>
                    <td><label>:</label></td>
                    <td>
                        <input type="text" name="price" maxlength="8" value="<?php echo $u->deal_price; ?>" />
                        <em><?php if(isset($this->form_error["price"])){ echo $this->form_error["price"]; }?></em>
                    </td>
                </tr>
                
		<tr>
                    <td><label><?php echo $this->Lang["DEALVALUE"]; ?></label><span>*</span></td>
                    <td><label>:</label></td>
                    <td>
                        <input type="text" name="deal_value" maxlength="8" value="<?php echo $u->deal_value; ?>" />
                        <em><?php if(isset($this->form_error["deal_value"])){ echo $this->form_error["deal_value"]; }?></em>
                    </td>
                </tr>

                <tr>
                    <td><label><?php echo $this->Lang["START_DATE"]; ?></label><span>*</span></td>
                    <td><label>:</label></td>
                    <td>
                    	<input type="text" id="startdate" name="start_date" readonly="readonly"  value="<?php echo date('m/d/Y H:i:s', $u->startdate); ?>" />
                        <em><?php if(isset($this->form_error["start_date"])){ echo $this->form_error["start_date"]; }?></em>
                    </td>
                </tr>
                
                 <tr>
                    <td><label><?php echo $this->Lang["END_DATE"]; ?></label><span>*</span></td>
                    <td><label>:</label></td>
                    <td>
                    	<input type="text" name="end_date" id="enddate" readonly="readonly" value="<?php echo date('m/d/Y H:i:s', $u->enddate); ?>" />
                    	<em><?php if(isset($this->form_error["end_date"])){ echo $this->form_error["end_date"]; }?></em>
                    </td>
                </tr>
                
                 <tr>
                    <td><label><?php echo $this->Lang["EXPIRY"]; ?></label><span>*</span></td>
                    <td><label>:</label></td>
                    <td>
                    	<input type="text" name="expiry_date" id="expirydate" readonly="readonly" value="<?php echo date('m/d/Y H:i:s', $u->expirydate); ?>" />
                    	<em><?php if(isset($this->form_error["expiry_date"])){ echo $this->form_error["expiry_date"]; }?></em>
                    </td>
                </tr>
		<tr>
                    <td><label><?php echo $this->Lang["DESC"]; ?></label><span>*</span></td>
                    <td><label>:</label></td>
                    <td>
                    <textarea name="description" class="TextArea"><?php echo $u->deal_description;?></textarea>
			<em><?php if(isset($this->form_error["description"])){ echo $this->form_error["description"]; }?></em>
                    </td>
                </tr>     
                
                    <tr id="shop">
                    <td><label><?php echo $this->Lang["SEL_SHOP"]; ?><span>*</span></label></td>
                    <td><label>:</label></td>
                    <td>
                        <select name="stores">
			<?php foreach($this->shop_list as $d){ ?>
				<option value=<?php echo $d->store_id; ?> <?php if($u->shop_id==$d->store_id) { ?> selected="selected" <?php  } ?>><?php echo $d->store_name; ?></option>
			<?php }  ?> 
                        </select>
                        <em><?php if(isset($this->form_error["stores"])){ echo $this->form_error["stores"]; }?></em>
					</td>
                 </tr> 

                    <tr>
                    <td><label><?php echo $this->Lang["META_KEY"]; ?></label></td>

                    <td><label>:</label></td>
                    <td>
                        <textarea name="meta_keywords"><?php echo $u->meta_keywords; ?></textarea>
                        <em><?php if(isset($this->form_error["meta_keywords"])){ echo $this->form_error["meta_keywords"]; }?></em>
                    </td>
                </tr>
                
                 <tr>
                    <td><label><?php echo $this->Lang["META_DESC"]; ?></label></td>
                    <td><label>:</label></td>
                    <td>
                        <textarea name="meta_description"><?php echo $u->meta_description; ?></textarea>
                        <em><?php if(isset($this->form_error["meta_description"])){ echo $this->form_error["meta_description"]; }?></em>
                    </td>
                </tr>
                
                 <tr>
                    <td><label><?php echo $this->Lang["MIN_USER_LIMIT"]; ?></label><span>*</span></td>
                    <td><label>:</label></td>
                    <td><input type="text" name="minlimit" maxlength="18" <?php if($u->purchase_count >= $u->minimum_deals_limit ) { ?> readonly="readonly" <?php } ?> value="<?php echo $u->minimum_deals_limit; ?>" /><em><?php if(isset($this->form_error["minlimit"])){ echo $this->form_error["minlimit"]; }?></em></td>
                </tr>
                
                 <tr>
                    <td><label><?php echo $this->Lang["MAX_USER_LIMIT"]; ?></label><span>*</span></td>
                    <td><label>:</label></td>
                    <td>
                        <input type="text" name="maxlimit" maxlength="18" value="<?php echo $u->maximum_deals_limit; ?>" />
                        <em><?php if(isset($this->form_error["maxlimit"])){ echo $this->form_error["maxlimit"]; }?></em>
                    </td>
                </tr>
		 <tr>
                    <td><label><?php echo $this->Lang["USER_LIMIT_QUAN"]; ?></label><span>*</span></td>
                    <td><label>:</label></td>
                    <td>
                        <input type="text" name="quantity" maxlength="18" value="<?php echo $u->user_limit_quantity; ?>" />
                        <em><?php if(isset($this->form_error["quantity"])){ echo $this->form_error["quantity"]; }?></em>
                    </td>
                </tr>
                
                <tr>
                    <td><label><?php echo $this->Lang["DEAL_IMG"]; ?></label></td>
                    <td><label>:</label></td>
                    <td>
                         <div class = "inputs">
                      <?php /*  <input type="file" name="image[]"  id="first" onchange="return validateFileExtension(this)" /></div>
                        <input type="button" id="add" value="<?php echo $this->Lang['MRE_IMG']; ?>" >
                        <input type="button" id="remove" value="<?php echo $this->Lang['RMV']; ?>" > */ ?>
                        <em><?php if(isset($this->form_error["image"])){ echo $this->form_error["image"]; }?></em>
                        <label><?php echo $this->Lang['DEAL_IMG_SIZE']; ?> </label>
                        
                    </td>
                </tr>

                <tr>
                <td></td>
                <td></td>
                <?php /* $con=0; 
                        for($i=1; $i<=5; $i++){ 
                                if(file_exists(DOCROOT.'images/deals/466_347/'.$u->deal_key.'_'.$i.'.png')) { 
                                        $con=$con+1; 
                                } 
                         } */ ?>
                
               
                <?php for($i=1; $i<=5; $i++){ ?>
                <td style="float:left;>
					<div class="merchant_store_img_edit">
							<div class="popup">
							<div class = "inputs">
								
								</div>
								<input type="button" id="remove<?php echo '_'.$i;?>" value="<?php echo "CANCEL"; ?>" >
								<input type="button" id="upload<?php echo '_'.$i;?>" value="<?php echo $this->Lang['ADD']; ?>" onchange="return validateFileExtension1(this,<?php echo $i;?>)">
								
							</div>
							
							
							<div class="uploadWrapper">
                                                            <span class="image_upload">
                                                                <img src="<?php echo PATH.'images/image_upload.png';?>" alt="<?php echo $this->Lang['EDIT']; ?>" title="<?php echo $this->Lang['EDIT']; ?>" />
                                                            </span>
                                                        <input type="file" name="image[]"  class="first" id="first<?php echo '_'.$i;?>" onchange="return validateFileExtension1(this,<?php echo $i;?>)"  style="width:24px;"  title="<?php echo $this->Lang['EDIT']; ?>"/>                                                        
                                                                <?php if($i!=1){ ?>
                                                            <?php  if(file_exists(DOCROOT.'images/deals/1000_800/'.$u->deal_key.'_'.$i.'.png'))  { ?>

                                                                                                                       <a class="image_delete" href="<?php echo PATH; ?>delete-deal-images.html?type=<?php echo 'deals';?>&id=<?php echo $u->deal_id; ?>&img=<?php echo base64_encode($u->deal_key.'_'.$i);?>&deal_key=<?php echo $u->deal_key; ?>" onclick="return confirm('<?php echo $this->Lang["ARE_U_DEL"]; ?>')" title="<?php echo $this->Lang['DELETE']; ?>">
                                                            
                                                                <img src="<?php echo PATH.'images/image_delete.png';?>" alt="<?php echo $this->Lang['DELETE']; ?>" title="<?php echo $this->Lang['DELETE']; ?>" />
                                                            </a>
                                                                        <?php } ?>
                                                                        <?php } ?>
                                                        </div>
							
						</div>
                <?php  if(file_exists(DOCROOT.'images/deals/1000_800/'.$u->deal_key.'_'.$i.'.png'))  { ?>
<img id="del<?php echo '_'.$i;?>" border="0" src= "<?php echo PATH.'resize.php';?>?src=<?php echo PATH.'images/deals/1000_800/'.$u->deal_key.'_'.$i.'.png';?>&w=100&h=125" alt="" class="class_img<?php echo $i;?>"  />
                       
                <?php } else {  ?>
						<img style="float:left;"border="0" src= "<?php echo PATH.'/images/no-images.png';?>" alt="" width="100" height="125" class="class_img<?php echo $i;?>"  />
                <?php } ?>   
                  <p id="img_name<?php echo '_'.$i; ?>"></p>
      
				<script>
$(document).ready(function(){
    //   $('#first<?php echo '_'.$i;?>').hide();
       $('#remove<?php echo '_'.$i;?>').hide();
       $('.popup').hide();
       $('#upload<?php echo '_'.$i;?>').hide();
       var i = $('inputs').size() + 0;
       
        
    $("#show-panel<?php echo '_'.$i;?>").click(function() { 
		$('#first<?php echo '_'.$i;?>').show();
		$('.popup').show();
        $('#remove<?php echo '_'.$i;?>').show();
        $('#upload<?php echo '_'.$i;?>').show();
        $('body').append('<div id="fade"></div>'); //Add the fade layer to bottom of the body tag.
		$('#fade').css({'filter' : 'alpha(opacity=100)'}).fadeIn();
		$('#fade').css({'visibility' : 'visible'});
        
        
        if(i != 4)  {
			
		i++;
        if(i == 4)  {
                $('#add').hide();
        }
        }else{ $('#add').hide(); } 
    });
    
    $('#remove<?php echo '_'.$i;?>').click(function() {
        if(i > 0) { 
			$('#first<?php echo '_'.$i;?>').val('');
        $('#first<?php echo '_'.$i;?>').hide();
        $('#upload<?php echo '_'.$i;?>').hide();
         $('.popup').hide();
         
         
		$('#fade').css({'filter' : 'alpha(opacity=100)'}).fadeOut();
		$('#fade').css({'visibility' : 'invisibe'});
        i--;
        if(i==0)
        { 
		$('#first<?php echo '_'.$i;?>').val('');
        $('#remove<?php echo '_'.$i;?>').hide();
        $('#upload<?php echo '_'.$i;?>').hide();
         $('.popup').hide();
         
        }
        }else if(i == 0){
        alert('No more to remove');
        i = 1;
        return false;
        }
    });
         
    $("#upload<?php echo '_'.$i;?>").click(function() { 
		if($('#first<?php echo '_'.$i;?>').val()=='') {
			alert("Please add some Image file");
			
		} else {
			$('#first<?php echo '_'.$i;?>').hide();
        $('#remove<?php echo '_'.$i;?>').hide();
        $('#first<?php echo '_'.$i;?>').val();
        var img_name_dis = $('#first<?php echo '_'.$i;?>').val();
        var res = "..."+img_name_dis.substr(img_name_dis.length - 13);
        $('#img_name<?php echo '_'.$i; ?>').html(res);
         $('#upload<?php echo '_'.$i;?>').hide();
        $('#fade').css({'filter' : 'alpha(opacity=100)'}).fadeOut();
		$('#fade').css({'visibility' : 'invisibe'});
        
		}
		
       
    });
    

});

function validateFileExtension1(input,idvalue) {
        var resdis = ".class_img"+idvalue;
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $(resdis)
                    .attr('src', e.target.result)
                    .width(100)
                    .height(125);
            };

            reader.readAsDataURL(input.files[0]);
        }
    }
</script></td>
                <?php } ?>
                
                </tr> 
                <tr>
                    <td></td>
                    <td></td>
                    <td><input type="submit" value="<?php echo $this->Lang['SUBMIT']; ?>" id="check2"/><input type="button" value="<?php echo $this->Lang['CANCEL']; ?>" onclick='window.location.href="<?php echo PATH?>merchant/manage-deals.html"'/></td>
                </tr>
            </table><?php }?>
        </form>
        
    </div>
    <div class="content_bottom"><div class="bot_left"></div><div class="bot_center"></div><div class="bot_rgt"></div></div>
</div>
