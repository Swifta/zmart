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
    <script type="text/javascript"> 
    $(document).ready(function(){
		//$(".guide").hide();
        $('.wholesaleprice').hide();
	$('.aramexshipping').hide();
        $("#yourFormId").submit(function() {
        var textVal = $(".txtChar").val();
        if(textVal == "") {
            alert('Fill this field');
            return false;
        }
    });

    $("#ui-datepicker-div").hide();
        $("#check2").click(function(){
			 $('#status').val(1);
            if($('input[type=checkbox]:checked').length == 0){
                alert("Please select minimum one size checkbox");
                return false;
            }
            
        if ((document.getElementById('productaramex').checked)) {
        if ((document.getElementById('weightaramex').value == '') ||  (document.getElementById('weightaramex').value == '0')) { 
                document.getElementById("weightaramex").focus();
                      alert("Please enter product weight");
                      return false; 
        }
        }
        
        if ((document.getElementById('productaramex').checked)) {
        if ((document.getElementById('lengtharamex').value == '') ||  (document.getElementById('lengtharamex').value == '0')) { 
                document.getElementById("lengtharamex").focus();
                      alert("Please enter product length");
                      return false; 
        }
        }
        
        if ((document.getElementById('productaramex').checked)) {
        if ((document.getElementById('heightaramex').value == '') ||  (document.getElementById('heightaramex').value == '0')) { 
                document.getElementById("heightaramex").focus();
                      alert("Please enter product heigh");
                      return false; 
        }
        }
        
        if ((document.getElementById('productaramex').checked)) {
        if ((document.getElementById('widtharamex').value == '') ||  (document.getElementById('widtharamex').value == '0')) { 
                document.getElementById("widtharamex").focus();
                      alert("Please enter product width");
                      return false; 
        }
        }
        
         if ((document.getElementById('perquantity').checked)) {
         if ((document.getElementById('Wholesale').value == '') ||  (document.getElementById('Wholesale').value == '0')) { 
                document.getElementById("Wholesale").focus();
                      alert("Please enter your shipping amount");
                      return false; 
        }
        }
        
        if ((document.getElementById('perproduct').checked)) {
        if ((document.getElementById('Wholesale').value == '') ||  (document.getElementById('Wholesale').value == '0')) { 
                document.getElementById("Wholesale").focus();
                      alert("Please enter your shipping amount");
                      return false; 
        }
        }
        
        })
    });
    </script>
    <SCRIPT language="Javascript"> 
          function isNumberKey(evt)
          {
             var charCode = (evt.which) ? evt.which : event.keyCode        
             if (charCode > 31 && (charCode < 48 || charCode > 57))
                return false;
                
             return true;
              
          }
          
           function shippingNumberKey(evt)
          {
             var charCode = (evt.which) ? evt.which : event.keyCode        
             if (charCode != 46 && charCode > 31 && (charCode < 48 || charCode > 57))
                return false;
             return true;
          }
    </SCRIPT>
     <style>
#fade { background: #000; position: fixed; left: 0; top: 0; width: 100%; height: 100%; opacity: 0.5; z-index: 9999; }
.popup{ float: left;position: fixed; width:40%;  z-index: 99999; background: white; border-color:red;clear:both;top:200px; left:580px;  padding: 0px; }

</style>
<link rel="stylesheet" type="text/css" href="<?php echo PATH ?>css/jquery.cleditor.css">
<script type="text/javascript" src="<?php echo PATH ?>js/jquery.cleditor.min.js"></script>
<script type="text/javascript" src="<?php echo PATH ?>js/multiimage.js"></script>

<div class="bread_crumb"><a href="<?php echo PATH."merchant.html"; ?>" title="<?php echo $this->Lang['HOME']; ?>"><?php echo $this->Lang["HOME"]; ?> <span class="fwn">&#155;&#155;</span></a><p><?php echo $this->template->title; ?></p></div>
<div class="cont_container mt15 mt10">
<?php /* <div class="chart_2 fl">
    <ul>
    <li  id="userdate" class=" selected fl"> 
      <div class="tab1"></div>
      <div class="tab2" ><a  onclick="return User_date();" id="userdate"><?php echo $this->Lang['PRODU_DETAILS']; ?></a></div>
      <div class="tab3"></div>
    </li>
    
    <li class=" fl" id="reflist">
      <div class="tab1"></div>
      <div class="tab2" ><a onclick="return User_ref();"  id="reflist"><?php echo $this->Lang['P_IM']; ?></a></div>
      <div class="tab3"></div>
    </li>
      
    <li class=" fl" id="useryear">
      <div class="tab1"></div>
      <div class="tab2" ><a onclick="return User_year();"  id="useryear"><?php echo $this->Lang['SHIP_CO_SIZE']; ?></a></div>
      <div class="tab3"></div>
    </li>

	<li class=" fl" id="attribute">
      <div class="tab1"></div>
      <div class="tab2" ><a onclick="return ShowAttributes();"  id="attribute"><?php echo $this->Lang['ATTR_TXT']; ?> </a></div>
      <div class="tab3"></div>
    </li>
    
     <li class=" fl" id="usermonth">
      <div class="tab1"></div>
      <div class="tab2" ><a onclick="return User_month();"  id="usermonth"><?php echo $this->Lang['SEO_FE']; ?></a></div>
      <div class="tab3"></div>
    </li>

  </ul>
</div>  */ ?>
    <div class="content_top"><div class="top_left"></div><div class="top_center"></div><div class="top_rgt"></div></div>
    <div class="content_middle seller_t">
        <form action="" method="post" class="admin_form" enctype="multipart/form-data" id="yourFormId" >
        <?php foreach($this->product as $u){?>
            <div class="mergent_det2 user_date">
            <div class="mergent_det">
				 <fieldset>
    <legend><?php echo $this->Lang["PRODUCT"]; ?></legend>
            <table>
				<tr >
                    <td><label></label><span></span></td>
                    <td><label></label></td>
                    <td>
                    </td>
                </tr>
                 <tr >
                    <td><label></label><span></span></td>
                    <td><label></label></td>
                    <td>
                    </td>
                </tr>

                <tr>
                    <td><label><?php echo $this->Lang["PRODUCT_TITLE"]; ?></label><span>*</span></td>
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
							<?php foreach($this->category_list as $main){ if($main->product == 1 ) { ?>
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
                
                <tr> 
                  <td>
                      <input type="hidden" name="deal_type" value="2" <?php if($u->deal_type == 2){ ?>checked="checked" <?php } ?>/> 
                    </td>
                </tr>
                           
                <tr>
                    <td><label><?php echo $this->Lang["PRICE"]; ?> </label><span>*</span></td>
                    <td><label>:</label></td>
                    <td>
                        <input type="text" name="deal_value" maxlength="8" value="<?php if($u->deal_price !=0) { echo $u->deal_price; } else { echo $u->deal_value; }  ?>" />
                        <em><?php if(isset($this->form_error["deal_value"])){ echo $this->form_error["deal_value"]; }?></em>
                    </td>
                </tr>
		<tr>
                    <td><label><?php echo $this->Lang["DEALVALUE"]; ?></label><span></span></td>
                    <td><label>:</label></td>
                    <td>
						<?php if($u->deal_price!=0) { ?>
                        <input type="text" name="price" maxlength="8" value="<?php echo $u->deal_value; ?>" />
                       <?php /* <em><?php if(isset($this->form_error["price"])){ echo $this->form_error["price"]; }?></em> */?>
                       <?php } else{ ?>
                       <input type="text" name="price" maxlength="8" value="" />
                       <?php } ?>
                     </td>
                </tr>
                <tr>
                <td><label></label></td>
                <td><label></label></td>
                <td>
                <label>
                        <input type="checkbox" name="Including_tax" value="1" <?php  if($u->Including_tax == "1") { ?>checked <?php } ?>>
                        <?php echo $this->Lang['INC_TAX_AMOUNT']; ?>  </label>
                </td>
                </tr>
		<tr>
                    <td><label><?php echo $this->Lang["DESC"]; ?></label><span>*</span></td>
                    <td><label>:</label></td>
                    <td>
                       <textarea name="description" class="TextArea" ><?php echo $u->deal_description;?></textarea>
		       <em><?php if(isset($this->form_error["description"])){ echo $this->form_error["description"]; }?></em>
                    </td>
                </tr>
                <tr>
                    <td><label><?php echo $this->Lang['WNT_ADD_ATTR']; ?> </label><span>*</span></td>
                    <td><label>:</label></td>
                    <td> 
                        <input type="radio" name="attr_option" <?php if($u->attribute ==0) {?> checked <?php } ?> onclick="shospe(0)" value="0"> <?php echo $this->Lang['NO']; ?>
                        <input type="radio" name="attr_option" value="1" <?php if($u->attribute ==1) {?> checked <?php } ?> onclick="shospe(1)"> <?php echo $this->Lang['YES']; ?>
                         <p class="guide"><?php echo $this->Lang['MENTION_SPECIFICATION'];?></p>
                    </td>
                 </tr>
                <script type="text/javascript"> 
                $(document).ready(function(){
                var textVal = <?php echo $u->attribute; ?>;
                if(textVal == "1") {
                    $('.spe_show').show();
                }
                if(textVal == "0") {
                    $('.spe_show').hide();
                }
                });
                </script>
                <tr class="spe_show">
                    <td><label><?php echo $this->Lang["ENTRY_ATTRIBUTE"]; ?></label></td>
                    <td>&nbsp;</td>
			<td><label><?php echo $this->Lang["TXT_LABEL"]; ?></label> </td>
			   </tr>
			<?php
			$atr_option =$u->attribute;
			$inc=1;
			if(count($this->selectproduct_attr) > 0){
				foreach($this->selectproduct_attr as $sel_atr){ 
				?> 
			<tr class="atrmain spe_show" id="row-<?php echo $inc;?>" > 
			<td>&nbsp;</td>
			<td>&nbsp;</td>
                    <td class="spe_show">
                        <select name="attribute[]">
						<?php
						 $attr= $this->all_attributes;
						  
 						  $totrow= count($attr);
						 if(count($attr) > 0){
						   $attrow=1;
							foreach($attr as $a){
							   if(count($a['attribute']) > 0){
								   $group_name = $a['name'];
								   echo '<optgroup label="'.$group_name.'">';
									 foreach($a['attribute'] as $atr){ ?>
									 <option value="<?php echo $atr['attribute_id'];?>" <?php echo ($sel_atr->attribute_id==$atr['attribute_id'])?"selected='selected'":"";?>><?php echo $atr['name'];?></option>
						 <?php
									}//end of attribte foreach
							   }else{ // end of attribute count
							   ?>
									 <option value="-1"><?php echo $this->Lang['NO_ATTR'];?></option>
							   <?php
							   }//end of attribute list if
						   } //end of attribute group loop
						 }else{
						  ?>
								<option value="-1"><?php echo $this->Lang['NO_ATTR'];?></option>
						  <?php
						 }
						 ?>
						  
						</select> 
                        <input type="text" name="attribute_value[]" value="<?php echo $sel_atr->text;?>"> 
                   
					<?php if($inc!=1){?>
					  <input type="button" name="remove" onclick="RemoveAttribute(<?php echo $inc;?>)" class="btn_remove" value="Remove">   </td>
					<?php  } ?>
					</tr>
					
					<?php
						$inc++; }
						
					}else{
						 ?>
						 <tr class="atrmain" id="row-<?php echo $inc;?>"> 
						 <td>&nbsp;</td>
						 <td>&nbsp;</td>
                    <td class="spe_show">
                        <select name="attribute[]" style="margin:0 5px 0 0;">
                        <option value=""><?php echo $this->Lang['SEL_SPECI']; ?></option>
						 <?php
						 $attr= $this->all_attributes;
						  
 						  $totrow= count($attr);
						 if(count($attr) > 0){

						   $attrow=1;
							foreach($attr as $a){
							   if(count($a['attribute']) > 0){
								   $group_name = $a['name'];
								   echo '<optgroup label="'.$group_name.'">';
									 foreach($a['attribute'] as $atr){

						  ?>
 						 <option value="<?php echo $atr['attribute_id'];?>"><?php echo $atr['name'];?></option>
						 <?php
									}//end of attribte foreach
							   }else{ // end of attribute count
							   ?>
							   <option value="-1"><?php echo $this->Lang['NO_ATTR'];?></option>
							   <?php
							   }//end of attribute list if
						   } //end of attribute group loop
						 }else{
						  ?>
						  <option value="-1"><?php echo $this->Lang['NO_ATTR'];?></option>
						  <?php
						 }
						 ?>
						</select> 
                        <input type="text" name="attribute_value[]" value=""> 
                    </td>
					<?php				
					}
					?>
					
                <tr id="btns" class="spe_show">
				 <td>&nbsp;</td>
				 <td>&nbsp;</td>
				 <td> <input id="btn_add" class="search_submit" type="button" name="addmore" value="<?php echo $this->Lang['ADDMORE'];?>" onclick="addAttribute()">  </td>
				</tr>
                  
                 <tr>
                    <td><label><?php echo $this->Lang['DEL_DAYS']; ?> </label><span>*</span></td>
                    <td><label>:</label></td>
                    <td>
                        <input type="text" name="delivery_days" maxlength="255"  value="<?php echo $u->delivery_period;  ?>" />
                        <em><?php if(isset($this->form_error["delivery_days"])){ echo $this->form_error["delivery_days"]; }?></em>
                    </td>
                </tr>
                 <tr>
                    <td><span></span></td>
                    <td><label></label></td>
                    <td>
                      <label><?php echo "Ex : ( 2 - 5 ) "; ?> </label>
                    </td>
                </tr>
                
                <!-- policy start --> 
			
					<?php
					$atr_option =$u->attribute;
					$policymain=1;
					if(count($this->selectproduct_policy) > 0){
						foreach($this->selectproduct_policy as $sel_policy){ 
						?> 
					<tr class="policymain" id="row-<?php echo $policymain;?>"> 
					<td><label><?php echo $this->Lang['DEL_POLICY']; ?> </label></td>
                    <td><label>:</label></td>
					<td>
                        <input type="text" name="Delivery_value[]" value="<?php echo $sel_policy->text;?>"> 
                    
					<?php if($policymain!=1){?>
					 <input type="button" name="remove" onclick="RemoveAttribute(<?php echo $policymain;?>)" class="btn_remove" value="Remove">   </td>
					<?php  } ?>
					</tr>
					
					<?php
						$policymain++; }
						
					}else{
						 ?>
					 <tr class="policymain">
                 <td><label><?php echo $this->Lang['DEL_POLICY']; ?> </label></td>
                    <td><label>:</label></td>
                    <td> <input type="text" name="Delivery_value[]" value="">    </td>
		    </tr>                 
                 <tr>
					<?php				
					}
					?>
					
                <tr id="Delivery">
				 <td>&nbsp;</td>
				  <td>&nbsp;</td>
				 <td> <input class="search_submit" id="Delivery_add" type="button" name="addmore" value="<?php echo $this->Lang['ADDMORE'];?>" onclick="addDelivery()">  </td>
				</tr>
		    
                

			  
			  <!-- policy end -->
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
                        <?php      $submit = "0"; 
                                        foreach($this->shipping_data as $ship){ 
                                        $free = $ship->free;
                                        $flat = $ship->flat;
                                        $per_product = $ship->per_product;
                                        $per_quantity = $ship->per_quantity;
                                        $aramex = $ship->aramex;
                         } ?>
                       <tr>
                                <td><label>Shipping method <span>*</span></label></td>
                                <td><label>:</label></td>
                                <td>
                                 <table style="border: 1px solid #999; border-collapse: collapse; width:242px;">
                                        <?php if($this->free_shipping_setting == 1 && $free == 1){ $submit = "1"; ?>
                                        <tr><td><input type="radio" name="shipping" value="1" onchange="return checkedretailprice(this)" <?php if($u->shipping == 1){ ?>checked <?php } ?>>Free Shipping</td></tr>
                                        <?php } if($this->flat_shipping_setting == 1 && $flat == 1){ $submit = "1"; ?>
                                        <tr><td><input type="radio" name="shipping" value="2" onchange="return checkedretailprice(this)" <?php if($u->shipping == 2){ ?>checked <?php } ?>>Flat Shipping</td></tr>
                                         <?php } if($this->per_product_setting == 1 && $per_product == 1){ $submit = "1"; ?>
                                        <tr><td><input type="radio" name="shipping" value="3" id="perproduct" onchange="return checkedwholesaleprice(this)" <?php if($u->shipping == 3){ ?>checked <?php } ?>>Per product base Shipping</td></tr>
                                         <?php } if($this->per_quantity_setting == 1 && $per_quantity == 1){ $submit = "1"; ?>
                                        <tr><td><input type="radio" name="shipping" value="4" id="perquantity" onchange="return checkedwholesaleprice(this)" <?php if($u->shipping == 4){ ?>checked <?php } ?>>Per quantity base Shipping</td></tr>
                                         <?php } if($this->aramex_setting == 1 && $aramex == 1){ $submit = "1"; ?>
                                        <tr><td><input type="radio" name="shipping" value="5" id="productaramex" onchange="return checkedaramex(this)" <?php if($u->shipping == 5){ ?>checked <?php } ?>>Aramex Shipping</td></tr>
                                        <?php }  if($submit == "0"){ ?>
                                        <tr><td><label><font size="2" color="red"><?php echo $this->Lang["PLZ_CONT_ADMIN_SHIPP_METHODS"]; ?></font> </label></td></tr>
                                        <?php } ?>
                                        </table>
                                        <p class="guide"><?php echo $this->Lang['MENTION_SHIPPING'];?></p>
                                </td>
                        </tr>

                        <?php if(($u->shipping == 4) || ($u->shipping == 3)) { ?>
                        <script type="text/javascript">
                                        $(document).ready(function(){
                                        $('.wholesaleprice').show();
                                });
                        </script>
                 <?php } elseif(($u->shipping == 1) || ($u->shipping == 2)) { ?>
                        <script type="text/javascript">
                                        $(document).ready(function(){
                                        $('.wholesaleprice').hide();
                                });
                        </script>
                        <?php } elseif($u->shipping == 5) { ?>
                        <script type="text/javascript">
                                        $(document).ready(function(){
                                        $('.aramexshipping').show();
                                });
                        </script>
                 <?php } ?>
                 <tr class="wholesaleprice">
                    <td><label>Shipping Amount</label><span>*</span></td>
                    <td><label>:</label></td>
                    <td>
                        <input id="Wholesale" type="text" name="shipping_amount" maxlength="8" value="<?php echo $u->shipping_amount; ?>"  onkeypress="return shippingNumberKey(event)" />
                        <em><?php if(isset($this->form_error["shipping_amount"])){ echo $this->form_error["shipping_amount"]; }?></em>
                                                
                    </td>
                </tr>
                
                     <tr  class="aramexshipping">
                    <td><label><?php echo $this->Lang["WT"]; ?></label></td>
                    <td><label>:</label></td>
                    <td>
                         <input  id="weightaramex" type="text" name="weight"  maxlength="8"  onkeypress="return shippingNumberKey(event)" value="<?php echo $u->weight; ?>" /> <?php echo $this->Lang["KG"]; ?>
                        <em><?php if(isset($this->form_error["weight"])){ echo $this->form_error["weight"]; }?></em>
                    </td>
                </tr>                           

                   <tr  class="aramexshipping">
                    <td><label><?php echo $this->Lang["LEN"]; ?></label></td>
                    <td><label>:</label></td>
                    <td>
                         <input id="lengtharamex" type="text" name="length" maxlength="8"  onkeypress="return shippingNumberKey(event)" value="<?php echo $u->length; ?>" /><?php echo $this->Lang["INCM"]; ?>
                        <em><?php if(isset($this->form_error["length"])){ echo $this->form_error["length"]; }?></em>
                    </td>
                </tr>
                
                <tr  class="aramexshipping">
                    <td><label><?php echo $this->Lang["HEI"]; ?></label></td>
                    <td><label>:</label></td>
                    <td>
                         <input id="heightaramex" type="text" name="height" maxlength="8"  onkeypress="return shippingNumberKey(event)" value="<?php echo $u->height; ?>" /><?php echo $this->Lang["INCM"]; ?>
                        <em><?php if(isset($this->form_error["height"])){ echo $this->form_error["height"]; }?></em>
                    </td>
                </tr>
                
                <tr  class="aramexshipping">
                    <td><label><?php echo $this->Lang["WID"]; ?></label></td>
                    <td><label>:</label></td>
                    <td>
                         <input id="widtharamex" type="text" name="width" maxlength="8"  onkeypress="return shippingNumberKey(event)" value="<?php echo $u->width; ?>" /><?php echo $this->Lang["INCM"]; ?>
                        <em><?php if(isset($this->form_error["width"])){ echo $this->form_error["width"]; }?></em>
                    </td>
                </tr>

                <input type="hidden" onchange="return checkedsizeadd(this)" name="size_val" value="1" >
                
                
                <?php if(count($this->product_size)>0) { ?>
                        <td><label><?php echo $this->Lang['PRODU_SIZ']; ?></label><span>*</span></td>
                        <td><label>:</label></td>
                        <td >
                        <?php $user_city=""; foreach($this->selectproduct_size as $city1){
			                $user_city .= $city1->size_id.",";
			            }
			            $city_Tags=explode(",", substr($user_city, 0, -1));
			            ?>
                        <select name="Size_tag[]" id="SizeText">			  
			            <option value=""><?php echo $this->Lang['SELE__S']; ?></option>
			            <?php $i=1;
			            foreach($this->product_size as $CityL){
	 		              if(!in_array($CityL->size_id, $city_Tags)){
			            ?>
			            <option  value="<?php echo $CityL->size_id; ?>"><?php echo ucfirst($CityL->size_name); ?> </option> 
			            <?php  }
			            } ?>
			            </select>
			            </td>
                    </tr>
                    <?php 
                    } else {?>
                    <tr >
                    <td><label><?php echo $this->Lang['PRODU_SIZ']; ?></label></td>
                    <td><label>:</label></td>
                    <td>
                        <select name="city_size[]" id="SizeText" >
			            <option value="">Select Size</option>
			            <?php foreach($this->selectproduct_size as $CityL){ ?>
			            <option value="<?php echo $CityL->size_id; ?>"><?php echo ucfirst($CityL->size_name); ?></option>
			            <?php } ?>
			            </select>
                    </td>
                </tr>
                <?php } ?>
                <tr>
                    <td ></td>
                    <td></td>
                    <td>
                                <label><?php echo $this->Lang['MORE_CUS_SIZE']; ?>  <a href="<?php echo PATH; ?>merchant/manage-sizes.html"> <?php echo $this->Lang['ADD']; ?></a></label>
                                <p class="guide"><?php echo $this->Lang['MENTION_SIZE'];?></p>
                    </td>
                </tr>    
                
                 <tr>
                    <td><label><?php echo $this->Lang['YOUR_SELE_S_QU']; ?></label><span>*</span></td>
                    <td><label>:</label></td>
                    <td>
                    <?php if(count($this->selectproduct_size)>0) { ?>
                         <span id="size_display"> </span>
                        <?php 
                            foreach($this->selectproduct_size as $c){
                            echo "<p style='float:left;'><span style='width:3px;padding:3px;'>  Select size = ".ucfirst($c->size_name)." <input type='checkbox' name='size[]' checked='checked' value='".$c->size_id."'></span> <br> <span style='width:3px;padding:3px;'><input style='width:auto;' type='text' name='size_quantity[]'   maxlength='8' value='".$c->quantity."' class='txtChar' onkeypress='return isNumberKey(event)'></span> </p> ";
                        } } else { ?>
                        <span id="size_display" > </span>
                        <?php }?>
                    </td>
                </tr>
                    <script language="javascript"> 
                    function toggle() {
                        var ele = document.getElementById("SizeText");
                        var text = document.getElementById("displayText");
                            if(ele.style.display == "none") {
                                ele.style.display = "block";
                                text.style.display = "none";
                            }
                            else {
                                ele.style.display = "none";
                                text.style.display = "block";
                            }
                    } 

                    $(document).ready(function() {
                        $('#SizeText').change(function() {
                            var count=$(this).val();
                            $.post("<?php echo PATH;?>merchant/editmore_size?count="+count+"&deal="+<?php echo $u->deal_id; ?>,{
                            }, function(response){ 
								var check = 1;
									$("#size_display input:checked").each(function() {
											if(count == this.value){
												check=2;
											}	
									});
									if(check == 1){
										$("#size_display").append(response);
									 }else{
										alert('<?php echo $this->Lang['SIZE_ALREADY_SELE']; ?>');
									 }
                            });
                        });
                    });
                    </script>
                    
                               <tr>
                    <td><label><?php echo $this->Lang['AD_CO_FI']; ?></label><span>*</span></td>
                    <td><label>:</label></td>
                    <td class="overlay"> 
                        <input type="radio" onchange="return checkedcolorremove(this)" id="color_val_co" name="color_val" value="0" <?php if($u->color==0){ ?> checked <?php } ?>><?php echo $this->Lang['NO']; ?>
                        <input type="radio" onchange="return checkedcoloradd(this)" id="color_val_co1" name="color_val" value="1" <?php if($u->color==1){ ?> checked <?php } ?>><?php echo $this->Lang['YES']; ?>
                        <p class="guide"><?php echo $this->Lang['MENTION_COLOR'];?></p>
                    </td>
                 </tr>
                 <?php if(count($this->product_color)>0) { ?>
                    
                    <tr>
                        <td><label><?php echo $this->Lang['PRODUC_COLOR']; ?></label></td>
                        <td><label>:</label></td>
                        <td >
                        
                        
                        
                        <?php $user_city=""; foreach($this->product_color as $city1){
			                $user_city .= $city1->color_code_id.",";
	 		                
			            }
			            $city_Tags=explode(",", substr($user_city, 0, -1));
			            ?>
                        <select name="city_tag[]" id="toggleText">			  
			            <option value=""><?php echo $this->Lang['S_PRODU_COLOR']; ?></option>
			            <?php $i=1;
			            
			            foreach($this->color_code as $CityL){
			            	
	 		              if(!in_array($CityL->id, $city_Tags)){
			            	
			            ?>
			            <option  value="<?php echo $CityL->color_code; ?>" style='color:#<?php echo $CityL->color_code; ?>';><?php echo ucfirst($CityL->color_name); ?> </option>
			            <?php  }
			            } ?>
			            </select>
			            </td>
                    </tr>
                    <?php 
                    } else {?>
                    
                    <tr class="addcolor">
                    <td><label><?php echo $this->Lang['PRODUC_COLOR']; ?></label></td>
                    <td><label>:</label></td>
                                
                    <td>
                        <select name="city_tag[]" id="toggleText" >
			              <option value=""><?php echo $this->Lang['S_PRODU_COLOR']; ?></option>
			            <?php foreach($this->color_code as $CityL){
			            ?>
			            <option value="<?php echo $CityL->color_code; ?>" style='color:#<?php echo $CityL->color_code; ?>' ><?php echo ucfirst($CityL->color_name); ?></option>
			            <?php 
			            } ?>
			            </select>
                    </td>
                </tr>
                    
                    <?php } ?>
                    <tr >
                    <td ></td>
                    <td></td>
                    <td>
                                <label><?php echo $this->Lang['MORE_CUS_COLOR']; ?>  <a href="<?php echo PATH; ?>admin/manage-colors.html"> <?php echo $this->Lang['ADD']; ?></a></label>
                    </td>
                </tr>
                <?php if(count($this->product_color)>0) { ?>
                <tr class="select_color_pro">
                    <td><label><?php echo $this->Lang['Y_S_CO']; ?></label></td>
                    <td><label>:</label></td>
                    <td>
                     
                         <span id="city_display"> </span>
                        <?php 
                            foreach($this->product_color as $color){
                            echo "<span style='padding:3px;margin:2px;width:auto;height:20px;vetical-align:top;display:inline-block;border:3px solid #$color->color_name;'><input type='checkbox' name='color[]' checked='checked' value='".$color->color_name."'>".ucfirst($color->color_code_name)."</span> ";
                        } ?>
                    </td>
                    
                </tr>
				<?php } else{ ?>
					
                <tr class="addcolor">
                    <td><label><?php echo $this->Lang['Y_S_CO']; ?></label></td>
                    <td><label>:</label></td>
                    <td>
                        <span id="city_display"> </span>
                        
                    </td>
                    
                </tr>
                
                <?php }?>
                <script language="javascript"> 
                function toggle() {
                var ele = document.getElementById("toggleText");
                var text = document.getElementById("displayText");
                if(ele.style.display == "none") {
                ele.style.display = "block";
                text.style.display = "none";
                }
                else {
                ele.style.display = "none";
                text.style.display = "block";
                }
                } 

                $(document).ready(function() {
					$('#toggleText').change(function() {
						var count=$(this).val();
							$.post("<?php echo PATH;?>merchant/editmore_color?count="+count+"&deal="+<?php echo $u->deal_id; ?>,{
							}, function(response){ 
								var check1 = 1;
									$("#city_display input:checked").each(function() {
											if(count == this.value){
												check1=2;
											}	
									});
									if(check1 == 1){ 
										$("#city_display").append(response);
									}else{
										alert('<?php echo $this->Lang['CO_ALREADY_SELE']; ?>');
									}
							});
					});
                });
                </script>
                
                 
                
                
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

                   <!-- attribute start --> 
                   
                   
                    <tr>
                
                    <td><label><?php echo $this->Lang["PRODUCT_IMG"]; ?></label></td>
                    <td><label>:</label></td>
                    <td>
                        <div class = "inputs">
				<?php /*<input type="file" name="image[]"  id="first" onchange="return validateFileExtension(this)" /></div>
                        <input type="button" id="add" value="<?php echo $this->Lang['MRE_IMG']; ?>" >

                        <input type="button" id="remove" value="<?php echo $this->Lang['RMV']; ?>" > */ ?>
                        <em><?php if(isset($this->form_error["image"])){ echo $this->form_error["image"]; }?></em>
                        <label><?php echo $this->Lang['IMG_UP_S']; ?> </label>
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
                <td style="float:left;">
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
                                                            <?php  if(file_exists(DOCROOT.'images/products/1000_800/'.$u->deal_key.'_'.$i.'.png'))  { ?>

                                                            <a class="image_delete" href="<?php echo PATH; ?>delete-deal-images.html?type=<?php echo "products"; ?>&id=<?php echo $u->deal_id; ?>&img=<?php echo base64_encode($u->deal_key.'_'.$i);?>&deal_key=<?php echo $u->deal_key; ?>" onclick="return confirm('<?php echo $this->Lang["ARE_U_DEL"]; ?>')" title="<?php echo $this->Lang['DELETE']; ?>">
                                                                <img src="<?php echo PATH.'images/image_delete.png';?>" alt="<?php echo $this->Lang['DELETE']; ?>" title="<?php echo $this->Lang['DELETE']; ?>" />
                                                            </a>
                                                                <?php } ?>
                                                                <?php } ?>
                                                        </div>
							
								
						</div>
                <?php  if(file_exists(DOCROOT.'images/products/1000_800/'.$u->deal_key.'_'.$i.'.png'))  { ?>
<img id="del<?php echo '_'.$i;?>" border="0" src= "<?php echo PATH.'resize.php';?>?src=<?php echo PATH.'images/products/1000_800/'.$u->deal_key.'_'.$i.'.png';?>&w=100&h=125" alt="" class="class_img<?php echo $i;?>" />
                      
                <?php } else {  ?>
						<img style="float:left;" border="0" src= "<?php echo PATH.'resize.php';?>?src=<?php echo PATH.'/images/no-images.png';?>&w=100&h=125" alt="" class="class_img<?php echo $i;?>"/>
                <?php } ?>   
                  <p id="img_name<?php echo '_'.$i; ?>"></p>
                  

				<script>
$(document).ready(function(){
      // $('#first<?php echo '_'.$i;?>').hide();
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
          var img_name_dis = $('#first<?php echo '_'.$i;?>').val();
        var res = "..."+img_name_dis.substr(img_name_dis.length - 13);
        $('#img_name<?php echo '_'.$i; ?>').html(res);
         
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
        $('#img_name<?php echo '_'.$i; ?>').html($('#first<?php echo '_'.$i;?>').val());
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
				
		    
               

			  
			  <!-- attribute end -->

			      
               
                
                 </table>
                  </div>
					<fieldset>
						<legend><?php echo $this->Lang["FR_STR_TRANS_ONLY"]; ?></legend>
						<table>
							<?php $duration = unserialize($u->product_duration);?>
							 <?php if(count($this->merchant_duration)>0) { ?>        
							<tr>
								<td><label><?php echo $this->Lang["STR_CRD"]; ?></label><span></span></td>
								<td><label>:</label></td>
								<td>
									<?php $i=0; foreach($this->merchant_duration as $dur) { if(isset($duration[$i])) { if($dur->duration_id.','.$dur->duration_period == $duration[$i]) { ?>
											<input type="checkbox" <?php if($dur->duration_id.','.$dur->duration_period == $duration[$i]) { ?> checked <?php } ?> name="duration[]" value="<?php echo $dur->duration_id.','.$dur->duration_period; ?>" />	<?php echo $dur->duration_period; ?><?php echo " ".$this->Lang['MTHS']; ?>
								   <?php $i++; } else { ?> 
											<input type="checkbox"  name="duration[]" value="<?php echo $dur->duration_id.','.$dur->duration_period; ?>" />	<?php echo $dur->duration_period; ?><?php echo " ".$this->Lang['MTHS']; ?>
								   <?php } } else { ?> 
											<input type="checkbox"  name="duration[]" value="<?php echo $dur->duration_id.','.$dur->duration_period; ?>" />	<?php echo $dur->duration_period; ?><?php echo " ".$this->Lang['MTHS']; ?>
								   <?php } } ?>
									<em></em>
								</td>
							</tr>
							<?php } else{ ?>
							
								<tr>
								<td><label><?php echo $this->Lang["STR_CRD"]; ?></label><span>*</span></td>
								<td><label>:</label></td>
								<td>
									<label><?php echo $this->Lang['NO_SHOP_CREDITS'];?></label>	
									
									<em></em>
								</td>
							</tr>
							<?php } ?>
						</table>
					</fieldset>	
                <div class="mergent_det2">
					<fieldset>
    <legend><?php echo $this->Lang["OFFER"]; ?></legend>
					<table>
						 <tr >
                    <td><label></label><span></span></td>
                    <td><label></label></td>
                    <td>
                    </td>
                </tr>
                 <tr >
                    <td><label></label><span></span></td>
                    <td><label></label></td>
                    <td>
                    </td>
                </tr>
						<tr>
                    <td><label><?php echo $this->Lang["OFFER"]; ?></label> <span>*</span></td>
		   
                    <td><label>:</label></td>
                    <td>
                        <input type="radio" name="offer" value="0" onclick="bulk_discount();" <?php if($u->product_offer==0){?>checked<?php } ?> style="display:none">
                    	<input type="radio" name="offer" value="1" onclick="bulk_discount();"  <?php if(isset($this->userPost['offer']) && $this->userPost['offer']==1){?>checked<?php }else if($u->product_offer==1){?>checked<?php } ?>><?php echo $this->Lang["BULK_DISCOUNT"]; ?>
                    	<input type="radio" name="offer" value="2" onclick="gift();" <?php if(isset($this->userPost['offer']) && $this->userPost['offer']==2){?>checked<?php }else if($u->product_offer==2){?>checked<?php } ?>><?php echo $this->Lang["GIFT"]; ?>
                      	<em><?php if(isset($this->form_error["offer"])){ echo $this->form_error["offer"]; }?></em>
                   	</td>
                </tr>
						
						 <tr class="gift" <?php if($u->product_offer!=2){?>style="display:none;"<?php } ?>>
                    <td><label><?php echo $this->Lang["GIFT"]; ?></label> <span>*</span></td>
		   
                    <td><label>:</label></td>
                    <td>
                    	<select name="free_gift" class="free_gift">
							<option value=""><?php echo $this->Lang['SEL_ANY'];?></option>
							<?php foreach($this->gift_list as $free){?>
							<option value="<?php echo $free->gift_id; ?>" <?php if($u->gift_offer==$free->gift_id){?>selected<?php } ?>><?php echo $free->gift_name;?></option>
							<?php } ?>
                    	</select>
                      	<em><?php if(isset($this->form_error["offer"])){ echo $this->form_error["offer"]; }?></em>
                   	</td>
                </tr>
                
                 <tr class="bulk_discount" <?php if($u->product_offer==2){?>style="display:none;"<?php } ?>>
                    <td><label><?php echo $this->Lang["BULK_DISCOUNT"]; ?></label></td>
                    <td><label>:</label></td>
                    <td>
			<table>
				<tr>
					<td><?php echo $this->Lang['BUY_ONE'];?></td>
					<td>
						<?php if(!isset($_POST['buy_bulk'])){?>
						<select name="buy_bulk" class="required buy_bulk" style="width:130px;">
						<option value=""><?php echo $this->Lang['SEL_ANY'];?></option>
						<?php for($i=1;$i<=40;$i++){?>
						<option value="<?php echo $i;?>" <?php if($u->bulk_discount_buy==$i){   ?>selected<?php  } ?>><?php echo $i;?></option>
						<?php } ?>
					</select>
					<?php }else{ ?>
					
						<select name="buy_bulk" class="required buy_bulk" style="width:130px;">
						<option value=""><?php echo $this->Lang['SEL_ANY'];?></option>
						<?php for($i=1;$i<=40;$i++){?>
						<option value="<?php echo $i;?>" <?php if($_POST['buy_bulk']==$i){   ?>selected<?php  } ?>><?php echo $i;?></option>
						<?php } ?>
					</select>
					<?php } ?>
					<em><?php if(isset($this->form_error["buy_bulk"])){ echo $this->form_error["buy_bulk"]; }?></em></td>
					<td><?php echo $this->Lang['GET'];?></td>
					<td>
						<?php if(!isset($_POST['buy_bulk'])){?>
						<select name="get_bulk" class="required" style="width:130px;">
						<option value=""><?php echo $this->Lang['SEL_ANY'];?></option>
						<?php for($i=1;$i<=20;$i++){?>
						<option value="<?php echo $i;?>" <?php if($u->bulk_discount_get==$i){   ?>selected<?php  } ?>><?php echo $i;?></option>
						<?php } ?>
					</select>
					<?php }else{ ?>
						<select name="get_bulk" class="required" style="width:130px;">
						<option value=""><?php echo $this->Lang['SEL_ANY'];?></option>
						<?php for($i=1;$i<=20;$i++){?>
						<option value="<?php echo $i;?>" <?php if($_POST['get_bulk']==$i){   ?>selected<?php  } ?>><?php echo $i;?></option>
						<?php } ?>
					</select>
					<?php } ?>
					<em><?php if(isset($this->form_error["get_bulk"])){ echo $this->form_error["get_bulk"]; }?></em></td>
				</tr>
			</table>
                    	<?php /*<input type="text" name="bulk_discount" maxlength="255" value="<?php echo $u->bulk_discount; ?>" autofocus />
                      	<em><?php if(isset($this->form_error["bulk_discount"])){ echo $this->form_error["bulk_discount"]; }?></em>*/?>
                   	</td>
                </tr>
               
                <tr class="date_offer">
                    <td><label><?php echo $this->Lang["START_DATE"]; ?></label><span>*</span></td>
                    <td><label>:</label></td>
                    <td>
                    	<input type="text" id="startdate" name="start_date" readonly="readonly"  value="<?php echo date('m/d/Y H:i:s', $u->start_date); ?>" />
                        <em><?php if(isset($this->form_error["start_date"])){ echo $this->form_error["start_date"]; }?></em>
                    </td>
                </tr>
                
                 <tr class="date_offer">
                    <td><label><?php echo $this->Lang["END_DATE"]; ?></label><span>*</span></td>
                    <td><label>:</label></td>
                    <td>
                    	<input type="text" name="end_date" id="enddate" readonly="readonly" value="<?php echo date('m/d/Y H:i:s', $u->end_date); ?>" />
                    	<em><?php if(isset($this->form_error["end_date"])){ echo $this->form_error["end_date"]; }?></em>
                    </td>
                </tr>
					</table>
					
                </div>
                <tr>
                    <td></td>
                    <td></td>
                    <td>
						<input type="hidden" id="status" name="status" value="<?php if($this->preview_type=='edit'){ echo $u->deal_status; }else{ echo "2";}?>">
						<input type="submit" value="<?php if($this->preview_type=='edit'){ echo $this->Lang['UPDATE']; }else{ echo $this->Lang['SUBMIT'];}?>" id="check2">
						<input type="button" value="<?php echo $this->Lang['PREVIEW']; ?>"  onclick="check_validation();"/>
						<input type="button" value="<?php echo $this->Lang['CANCEL']; ?>" onclick='window.location.href="<?php echo PATH?>merchant/manage-products.html"'/></td>
                </tr><?php }?>
        </div>
        </form>
        
    </div>
    <div class="content_bottom"><div class="bot_left"></div><div class="bot_center"></div><div class="bot_rgt"></div></div>
</div>

<?php // for attribute 
	 $attr= $this->all_attributes;
	  $append_select= "";
	 if(count($attr) > 0){
	        $append_select.= '<option value=""> '.$this->Lang['SEL_SPECI'].'</option>';
		foreach($attr as $a){
		   if(count($a['attribute']) > 0){
			   $group_name = $a['name'];
				$append_select.= '<optgroup label="'.$group_name.'">';
				foreach($a['attribute'] as $atr){
				   $append_select.= '<option value="'.$atr['attribute_id'].'"> '.$atr['name'].'</option>';
				}//end of attribte foreach
		   } // end of attribute count
		   else{
		   $append_select.= '<option value="-1">'.$this->Lang['NO_ATTR'].'</option>';
		   }
		   
	   } //end of attribute group loop
	 }else{
	  $append_select.= '<option value="-1">'.$this->Lang['NO_ATTR'].'</option>';
	   
	 } 
	 
	 ?>

 <script type="text/javascript">

function RemoveAttribute(val) {
 
  $("#row-"+val).remove();
}

 
var totrow=  <?php echo count($this->product_attributes);?>;
 
var sel= '<?php echo $append_select;?>';


function addAttribute() {
 var addedrow = $('.atrmain').length;

 if (totrow > addedrow){
		 html  = '<tr class="atrmain" id="row-'+addedrow+'"> <td>&nbsp;</td><td>&nbsp;</td> <td> ';
		 html += '<select name="attribute[]" style="margin:0 5px 0 0;">';
		 html += sel;
		 html += '  </select>  ';
		 html+= '<input type="text" name="attribute_value[]" value="">  ' ;
		html+= ' <input type="button" name="remove" onclick="RemoveAttribute('+addedrow+')" class="btn_remove" value="Remove">   </td> </tr>' ;
		 
		 $('#btns').before(html);
	   }else{
		alert("Maximum limit reached");
		return false;
		
	   }
 
 
}

function addDelivery() {
 var Deliverydrow = $('.policymain').length;

		 html  = '<tr class="policymain" id="row-'+Deliverydrow+'">  ';
                  html+= '<td><label><?php echo $this->Lang["DEL_POLICY"]; ?> </label></td>';
                  html+= ' <td><label>:</label></td>';
		 html+= '<td> <input type="text" name="Delivery_value[]" value="">' ;
		html+= ' <input type="button" name="remove" onclick="RemoveDelivery('+Deliverydrow+')" class="Delivery_remove" value="Remove">   </td> </tr>' ;
		 
		 $('#Delivery').before(html);
 
 
}

function RemoveDelivery(val) {
 
  $("#row-"+val).remove();
}

function showatr(value) {
    //var value = $('input:radio[name=attr_option]:checked').val();
	 
	 if(value==1) {
	  $(".attribute").show();
	 }else{
	  $(".attribute").hide();
	 }
}

function shospe(value) {
    //var value = $('input:radio[name=attr_option]:checked').val();
	 
	 if(value==1) {
	  $(".spe_show").show();
	 }else{
	  $(".spe_show").hide();
	 }
}
function bulk_discount()
{
	$(".bulk_discount").show();
	$(".date_offer").show();
	$(".gift").hide();
	//$(".free_gift").val('');
	//$("#startdate").val('');
	//$("#enddate").val('');
	
}
function gift()
{
	$(".gift").show();
	$(".date_offer").show();
	$(".bulk_discount").hide();
	//$(".buy_bulk").val('');
	//$(".get_bulk").val('');
	//$("#startdate").val('');
	//$("#enddate").val('');
}
 </script>
<script>
function check_validation(){
	$('#status').val(2);
	if($('input[type=checkbox]:checked').length == 0){
		alert("Please select minimum one size checkbox");
		return false;
	}
	/*if ((document.getElementById('productaramex').checked)) {
		if ((document.getElementById('weightaramex').value == '') ||  (document.getElementById('weightaramex').value == '0')) { 
			document.getElementById("weightaramex").focus();
			alert("Please enter product weight");
			return false; 
		}
	}
	if ((document.getElementById('productaramex').checked)) {
		if ((document.getElementById('lengtharamex').value == '') ||  (document.getElementById('lengtharamex').value == '0')) { 
			document.getElementById("lengtharamex").focus();
			alert("Please enter product length");
			return false; 
		}
	}
	
	if ((document.getElementById('productaramex').checked)) {
	if ((document.getElementById('heightaramex').value == '') ||  (document.getElementById('heightaramex').value == '0')) { 
			document.getElementById("heightaramex").focus();
				  alert("Please enter product heigh");
				  return false; 
	}
	}
	
	if ((document.getElementById('productaramex').checked)) {
	if ((document.getElementById('widtharamex').value == '') ||  (document.getElementById('widtharamex').value == '0')) { 
			document.getElementById("widtharamex").focus();
				  alert("Please enter product width");
				  return false; 
	}
	}*/
	
	 if ((document.getElementById('perquantity').checked)) {
	 if ((document.getElementById('Wholesale').value == '') ||  (document.getElementById('Wholesale').value == '0')) { 
			document.getElementById("Wholesale").focus();
				  alert("Please enter your shipping amount");
				  return false; 
	}
	}
	
	if ((document.getElementById('perproduct').checked)) {
	if ((document.getElementById('Wholesale').value == '') ||  (document.getElementById('Wholesale').value == '0')) { 
			document.getElementById("Wholesale").focus();
				  alert("Please enter your shipping amount");
				  return false; 
	}
	}
	$('#yourFormId').submit();  
}
</script>
<?php /*if(isset($this->userPost['offer'])){
	if($this->userPost['offer'] == 1){ ?>
	<script>
		bulk_discount();
	</script>
	<?php }else if($this->userPost['offer'] == 2){ ?>
	<script>
		gift();
	</script>
	<?php }
	}*/?>

