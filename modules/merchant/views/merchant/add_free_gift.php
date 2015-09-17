<?php defined('SYSPATH') OR die('No direct access allowed.'); ?>
<link rel="stylesheet" type="text/css" href="<?php echo PATH ?>css/jquery.cleditor.css">
<script type="text/javascript" src="<?php echo PATH ?>js/jquery.cleditor.min.js"></script>
<div class="bread_crumb"><a href="<?php echo PATH."merchant.html"; ?>" title="<?php echo $this->Lang['HOME']; ?>"><?php echo $this->Lang["HOME"]; ?> <span class="fwn">&#155;&#155;</span></a><p><?php echo $this->template->title; ?></p></div>
<div class="cont_container mt15 mt10">
    <div class="content_top"><div class="top_left"></div><div class="top_center"></div><div class="top_rgt"></div></div>
    <div class="content_middle">
        <form action="" method="post" class="admin_form" enctype="multipart/form-data">
            <table>
                <tr>
                    <td><label><?php echo $this->Lang["GIFT_NAME"]; ?></label><span>*</span></td>
                    <td><label>:</label></td>
                    <td><input type="text" name="gift" value="<?php if(!isset($this->form_error["gift"])&&isset($this->userPost["gift"])){ echo $this->userPost["gift"]; }?>"  autofocus />
                    <em><?php if(isset($this->form_error["gift"])){ echo $this->form_error["gift"]; }?></em></td>
                </tr>
                
                <tr>
                <td><label><?php echo $this->Lang["CATEGORY"]; ?></label><span>*</span></td>
                <td><label>:</label></td>
                <td>
                <select name="category" >
                <option value=""><?php echo $this->Lang['SEL_CATEGORY']; ?></option>
                <?php foreach($this->category_list as $main){ if($main->product == 1 ) { ?>
                <option value="<?php echo $main->category_id?>" <option value="<?php echo $main->category_id?>" <?php if(!isset($this->form_error['category']) && isset($_POST['category'])){  if($_POST['category'] == $main->category_id){ ?>selected<?php } } ?>><?php echo ucfirst($main->category_name); ?></option>    
                <?php } } ?>
                </select>
                <em><?php if(isset($this->form_error["category"])){ echo $this->form_error["category"]; }?></em>
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
                    <td><label><?php echo $this->Lang["QUAN"]; ?></label><span>*</span></td>
                    <td><label>:</label></td>
                    <td>
                        <input type="text" name="quantity" maxlength="8" onkeypress="return isNumberKey(event,this.value);"  value="<?php if(!isset($this->form_error["quantity"])&&isset($this->userPost["quantity"])){ echo $this->userPost["quantity"]; }?>" />
                        <em><?php if(isset($this->form_error["quantity"])){ echo $this->form_error["quantity"]; }?></em>
                    </td>
                </tr>
                
                <tr>
                    <td><label><?php echo $this->Lang['GIFT_TYPE']; ?></label><span>*</span></td>
                    <td><label>:</label></td>
                    <td>
                        <input type="radio" name="gift_type" onclick="shospe()" checked value="0"> <?php echo $this->Lang['FREE_GIFT']; ?>
                        <input type="radio" name="gift_type" value="1"  onclick="shospe()"> <?php echo $this->Lang['AMOUNT_BASED']; ?>
                       
                    </td>
                 </tr>
                 
                <tr class="spe_show" >
                    <td><label><?php echo $this->Lang["AMOUNT"]; ?></label><span>*</span></td>
                    <td><label>:</label></td>
                    <td><input type="text" name="amount" maxlength="8" onkeypress="return isNumberKey(event,this.value);" value="" autofocus />
                    <em><?php if(isset($this->form_error["amount"])){ echo $this->form_error["amount"]; }?></em></td>
                </tr>
                
                <tr>
                    <td><label><?php echo $this->Lang["GIFT_IMG"]; ?></label></td>
                    <td><label>:</label></td>
                                
                    <td>
                        <div class = "inputs">
                        <input type="file" name="image"  id="first"/>
                       </div>
                        <em><?php if(isset($this->form_error["image"])){ echo $this->form_error["image"]; }?></em>
                        <label><?php echo $this->Lang['IMG_UP']; ?> 200 X 200</label>
                    </td>
                </tr>
                
                <tr>
                    <td></td>
                    <td></td>
                    <td>		
		<input type="submit" value="<?php echo $this->Lang['SUBMIT']; ?>" /><input type="reset" value="<?php echo $this->Lang['RESET']; ?>" onclick="javascript:window.location='<?php echo PATH; ?>merchant/add-free-gift.html'"/></td>
                </tr>
            </table>
        </form>
    </div>
    <div class="content_bottom"><div class="bot_left"></div><div class="bot_center"></div><div class="bot_rgt"></div></div>
</div>
<script>
 $(document).ready(function(){
        $('.spe_show').hide();
  });
function isNumberKey(evt,value)
{
	var charCode = (evt.which) ? evt.which : evt.keyCode;
	if (charCode != 46 && charCode > 31 
	&& (charCode < 48 || charCode > 57))
	 return false;
	 
	 var val=value.split('.');
	 if(val[1].length>=2)
	 {
		 return false;
	 }

	var parts = evt.srcElement.value.split('.');
                if(parts.length > 1 && charCode==46)
                    return false;
                return true;
}

function shospe() {
    var value = $('input:radio[name=gift_type]:checked').val();
	 
	 if(value==1) {
	  $(".spe_show").show();
	 }else{
	  $(".spe_show").hide();
	 }
}

</script>
