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
	 $(".guide").hide();
 	$("#ui-datepicker-div").hide();
 	$('.wholesaleprice').hide();
 	 $('.aramexshipping').hide();
 	// $(".display_div").hide();
 	$(".display_color").hide();
 	$('.spe_show').hide();
 	$('.attribute').hide(); // for attribute
 	$("#check2").click(function(){ 	
        
        var textVal = $(".txtChar").val();
        if(textVal == "") {
            alert('Quantity is required');
            return false;
        }
        if(textVal == 0) {
            alert('The Quantity should not be zero');
            return false;
        }
       /* var selectsize = $(".selectsize").val();
        if(selectsize == "") {
            alert('Please fill all mandatory fields');
            return false;
        }*/

        var a = 0, rdbtn=document.getElementsByName("shipping")
        for(i=0;i<rdbtn.length;i++) {
                if(rdbtn.item(i).checked == false) {
                        a++;
                }
        }
        if(a == rdbtn.length) {
                alert("No way you submit it without choose shipping method");
                return false;
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

        // else you can show error message like this
       // alert("No way you submit it without choose shipping method");
        
        if($('input[type=checkbox]:checked').length == 0){
            alert("Please select minimum one size checkbox");
            return false;
        }
    })
 });
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
					$.post("<?php echo PATH;?>merchant/addmore_color?count="+count,{
						}, function(response){
						  $(".display_color").show();
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
              //$(".quantity_size").val(0);
               $(".size_check").attr("checked",false);
                $(".size_quantity").hide();
               
               $.post("<?php echo PATH;?>merchant/addmore_size?count="+count,{
                       }, function(response){
                        //$(".display_div").show();
                       
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

<script type="text/javascript">
function validate() {
        var a = 0, rdbtn=document.getElementsByName("shipping")
        //alert(rdbtn);
        for(i=0;i<rdbtn.length;i++) {
        if(rdbtn.item(i).checked == false) {
        a++;
        }
        }
        if(a == rdbtn.length) {
        alert("Please select your gender");
        //document.getElementById("gen").style.border = "2px solid red";
        return false;
        } else {
        //document.getElementById("gen").style.border = "";
        }
}
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
   <link rel="stylesheet" type="text/css" href="<?php echo PATH ?>css/jquery.cleditor.css">
<script type="text/javascript" src="<?php echo PATH ?>js/jquery.cleditor.min.js"></script>
<script type="text/javascript" src="<?php echo PATH ?>js/multiimage.js"></script>
<div class="bread_crumb"><a href="<?php echo PATH."store-admin.html"; ?>" title="<?php echo $this->Lang['HOME']; ?>"><?php echo $this->Lang["HOME"]; ?> <span class="fwn">&#155;&#155;</span></a><p><?php echo $this->template->title; ?></p></div>
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
      <div class="tab2" ><a onclick="return User_year();"  id="useryear"><?php echo $this->Lang['SHIP_C']; ?> </a></div>
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
    <div class="content_middle seller_t" >
        <form action="" method="post" class="admin_form" enctype="multipart/form-data" id="addFormId" onsubmit="return validate()" >
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
           
                <tr>
                    <td><label><?php echo $this->Lang["PRODUCT_TITLE"]; ?></label> <span>*</span></td>
		   
                    <td><label>:</label></td>
                    <td>
                    	<input type="text" name="title" maxlength="255" value="<?php if(!isset($this->form_error["title"])&&isset($this->userPost["title"])){ echo $this->userPost["title"]; }?>" autofocus />
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
                        <select name="sec_category"   onchange="return merchant_third_change_category(this.value);">
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
                    <td>
                        <input type="hidden" name="deal_type" value="2" />
                    </td>
                </tr>

                <tr>
                    <td><label><?php echo $this->Lang["PRICE"]; ?></label><span>*</span></td>
                    <td><label>:</label></td>
                    <td>
                        <input type="text" name="price" maxlength="8" value="<?php if(!isset($this->form_error["price"])&&isset($this->userPost["price"])){ echo $this->userPost["price"]; }?>" />
                        <em><?php if(isset($this->form_error["price"])){ echo $this->form_error["price"]; }?></em>
                    </td>
                </tr>
                
                <tr>
                    <td><label><?php echo $this->Lang["DEALVALUE"]; ?></label><span>*</span></td>
		
                    <td><label>:</label></td>
                    <td>
                        <input type="text" name="deal_value" maxlength="8" value="<?php if(!isset($this->form_error["deal_value"])&&isset($this->userPost["deal_value"])){ echo $this->userPost["deal_value"]; }?>" />
                        <em><?php if(isset($this->form_error["deal_value"])){ echo $this->form_error["deal_value"]; }?></em>
                        
                    </td>
                </tr>
                
                <tr>
                <td><label></label></td>
                <td><label></label></td>
                <td>
                <label>
                        <input type="checkbox" name="Including_tax" value="1" checked>
                        <?php echo $this->Lang['INC_TAX_AMOUNT']; ?>  </label>
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
                    <td><label><?php echo $this->Lang['WNT_ADD_ATTR']; ?></label><span>*</span></td>
                    <td><label>:</label></td>
                    <td>
                        <input type="radio" name="attr_option" onclick="shospe()" checked value="0"> <?php echo $this->Lang['NO']; ?>
                        <input type="radio" name="attr_option" value="1"  onclick="shospe()"> <?php echo $this->Lang['YES']; ?>
                        <p class="guide"><?php echo $this->Lang['MENTION_SPECIFICATION'];?></p>
                       
                    </td>
                 </tr>
			
				 <tr class="spe_show" >
                    <td><label><?php echo $this->Lang["ENTRY_ATTRIBUTE"]; ?></label></td>
                    <td></td>
					<td><label><?php echo $this->Lang["TXT_LABEL"]; ?></label>  </td>
			   </tr>
					<tr class="atrmain spe_show"> 
					<td></td>
					<td></td>
                    <td>
                       <select name="attribute[]">
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
									 foreach($a['attribute'] as $atr){  ?>
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
                        <input type="text" class="spec_attrib" name="attribute_value[]" value=""> 
                    </td>
                </tr>
                <tr id="btns" class="spe_show" >
				 <td>&nbsp;</td>
				 <td>&nbsp;</td>
				 <td> <input class="search_submit" id="btn_add" type="button" name="addmore" value="<?php echo $this->Lang['ADDMORE'];?>" onclick="addAttribute()">  </td>
				</tr>
		    
                	      
                
                 <tr>
                    <td><label><?php echo $this->Lang['DEL_DAYS']; ?> </label><span>*</span></td>
                    <td><label>:</label></td>
                    <td>
                        <input type="text" name="delivery_days" maxlength="255"  value="" />
                        
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
                     
                <tr class="policymain">
                 <td><label><?php echo $this->Lang['DEL_POLICY']; ?> </label></td>
                    <td><label>:</label></td>
                    <td> <input type="text" name="Delivery_value[]" value=""> 
                      </td>
		    </tr>                 
                 <tr>
                 
                 <tr  id="Delivery" >
                 <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td> <input class="search_submit" id="Delivery_add" type="button" name="addmore" value="<?php echo $this->Lang['ADDMORE'];?>" onclick="addDelivery()">   </td>
		    </tr>                 
                 <tr>
                 
                   
                        <?php $submit = "0"; 
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
                                        <tr><td><input type="radio" name="shipping" value="1" <?php if(!isset($this->form_error['stores']) && isset($_POST['stores'])){ if($_POST['shipping'] == 1){ ?> checked <?php } } ?> onchange="return checkedretailprice(this)" >Free Shipping</td></tr>
                                        <?php } if($this->flat_shipping_setting == 1 && $flat == 1){ $submit = "1"; ?>
                                        <tr><td><input type="radio" name="shipping" value="2" <?php if(!isset($this->form_error['stores']) && isset($_POST['stores'])){ if($_POST['shipping'] == 2){ ?> checked <?php } } ?>onchange="return checkedretailprice(this)">Flat Shipping</td></tr>
                                         <?php } if($this->per_product_setting == 1 && $per_product == 1){ $submit = "1"; ?>
                                        <tr><td><input type="radio" name="shipping" value="3" <?php if(!isset($this->form_error['stores']) && isset($_POST['stores'])){ if($_POST['shipping'] == 3){ ?> checked <?php } } ?>id="perproduct" onchange="return checkedwholesaleprice(this)" >Per product base Shipping</td></tr>
                                         <?php } if($this->per_quantity_setting == 1 && $per_quantity == 1){ $submit = "1"; ?>
                                        <tr><td><input type="radio" name="shipping" value="4" <?php if(!isset($this->form_error['stores']) && isset($_POST['stores'])){ if($_POST['shipping'] == 4){ ?> checked <?php } } ?>id="perquantity" onchange="return checkedwholesaleprice(this)">Per quantity base Shipping</td></tr>
                                         <?php } if($this->aramex_setting == 1 && $aramex == 1){ $submit = "1"; ?>
                                        <tr><td><input type="radio" name="shipping" value="5" <?php if(!isset($this->form_error['stores']) && isset($_POST['stores'])){ if($_POST['shipping'] == 5){ ?> checked <?php } } ?>id="productaramex" onchange="return checkedaramex(this)">Aramex Shipping</td></tr>
                                        <?php }  if($submit == "0"){ ?>
                                        <tr><td><label><font size="2" color="red"><?php echo $this->Lang["PLZ_CONT_ADMIN_SHIPP_METHODS"]; ?></font> </label></td></tr>
                                        <?php } ?>
                                          </table>
                                          <p class="guide"><?php echo $this->Lang['MENTION_SHIPPING'];?></p>
                                          
                                </td>
                        </tr> 
                        
                        <?php if(!isset($this->form_error['stores']) && isset($_POST['stores'])){  ?>
                
                <?php if(($_POST['shipping'] == 4) || ($_POST['shipping'] == 3)) { ?>
                        <script type="text/javascript">
                                        $(document).ready(function(){
                                        $('.wholesaleprice').show();
                                });
                        </script>
                 <?php } elseif(($_POST['shipping'] == 1) || ($_POST['shipping'] == 2)) { ?>
                        <script type="text/javascript">
                                        $(document).ready(function(){
                                        $('.wholesaleprice').hide();
                                });
                        </script>
                        <?php } elseif($_POST['shipping'] == 5) { ?>
                        <script type="text/javascript">
                                        $(document).ready(function(){
                                        $('.aramexshipping').show();
                                });
                        </script>
                 <?php } ?>
                
                <?php } ?>
                        <tr class="wholesaleprice">
                    <td><label>Shipping Amount</label><span>*</span></td>
                    <td><label>:</label></td>
                    <td>
                        <input id="Wholesale" type="text" name="shipping_amount" maxlength="8"  onkeypress="return shippingNumberKey(event)" value="<?php if(!isset($this->form_error['shipping_amount'])&&isset($this->userPost['shipping_amount'])){ echo $this->userPost['shipping_amount']; }?>" />
                       
                        <em><?php if(isset($this->form_error["shipping_amount"])){ echo $this->form_error["shipping_amount"]; }?></em>
                    </td>
                </tr>
                
                <tr class="aramexshipping">
                    <td><label><?php echo $this->Lang["WT"]; ?></label><span>*</span></td>
                    <td><label>:</label></td>
                    <td>
                         <input id="weightaramex" type="text" name="weight"  maxlength="8"  onkeypress="return shippingNumberKey(event)" value="<?php if(!isset($this->form_error['weight'])&&isset($this->userPost['weight'])){ echo $this->userPost['weight']; }?>" /> <?php echo $this->Lang["KG"]; ?>
                        <em><?php if(isset($this->form_error["weight"])){ echo $this->form_error["weight"]; }?></em>
                    </td>
                </tr>

                <tr class="aramexshipping">
                    <td><label><?php echo $this->Lang["LEN"]; ?></label><span>*</span></td>
                    <td><label>:</label></td>
                    <td>
                         <input id="lengtharamex" type="text" name="length" maxlength="8"  onkeypress="return shippingNumberKey(event)" value="<?php if(!isset($this->form_error['length'])&&isset($this->userPost['lenght'])){ echo $this->userPost['length']; }?>" /> <?php echo $this->Lang["INCM"]; ?>
                        <em><?php if(isset($this->form_error["length"])){ echo $this->form_error["length"]; }?></em>
                    </td>
                </tr>

                <tr class="aramexshipping">
                    <td><label><?php echo $this->Lang["HEI"]; ?></label><span>*</span></td>
                    <td><label>:</label></td>
                    <td>
                         <input id="heightaramex" type="text" name="height" maxlength="8"  onkeypress="return shippingNumberKey(event)" value="<?php if(!isset($this->form_error['height'])&&isset($this->userPost['height'])){ echo $this->userPost['height']; }?>" /> <?php echo $this->Lang["INCM"]; ?>
                         
                        <em><?php if(isset($this->form_error["height"])){ echo $this->form_error["height"]; }?></em>
                    </td>
                </tr>
                
                <tr class="aramexshipping">
                    <td><label><?php echo $this->Lang["WID"]; ?></label><span>*</span></td>
                    <td><label>:</label></td>
                    <td>
                         <input id="widtharamex" type="text" name="width" maxlength="8"  onkeypress="return shippingNumberKey(event)" value="<?php if(!isset($this->form_error['width'])&&isset($this->userPost['width'])){ echo $this->userPost['width']; }?>" /> <?php echo $this->Lang["INCM"]; ?>
                         
                        <em><?php if(isset($this->form_error["width"])){ echo $this->form_error["width"]; }?></em>
                    </td>
                </tr>
                        <input type="hidden" onchange="return checkedsizeadd(this)" name="size_val" value="1">
                        
                        <tr>
                    <td><label><?php echo $this->Lang['PRODU_SIZ']; ?></label><span>*</span></td>
                    <td><label>:</label></td>
                                
                    <td>
 
                        <select name="size_tag[]" id="SizeText" class="selectsize">
			              <option value=""><?php echo $this->Lang['SELE__S']; ?></option>
			            <?php foreach($this->product_size as $size){
			            ?>
			            <option value="<?php echo $size->size_id; ?>" ><?php echo $size->size_name; ?></option>
			            <?php 
			            } ?>
			            </select>
			            
			            <em><?php if(isset($this->form_error["size_tag[]"])){ echo $this->form_error["size_tag[]"]; }?></em>
                    </td>
                </tr>
               
                
                         <tr class="display_div">
                    <td><label><?php echo $this->Lang['QUAN']; ?></label><span>*</span></td>
                    <td><label>:</label></td>
                    <td>
                                <span id="size_display">
                                 <span style='width:3px;padding:3px;' class="size_quantity"><input type='checkbox' class="size_check" name='size[]'onclick="return false;"checked='checked' value='1'style="display:none;" ></span><br>
                                <p class="size_quantity" style='float:left;'><span style='width:3px;padding:3px;'><input style='width:auto;' type='text' name='size_quantity[]'  maxlength='8' value='1' class='txtChar quantity_size' onkeypress='return isNumberKey(event)'></span></p></span>
                               
                                
                        
                    </td>
                    
                    
                </tr>     
                
                
                <tr>
                    <td><label><?php echo $this->Lang['AD_CO_FI']; ?></label><span>*</span></td>
                    <td><label>:</label></td>
                    <td>
                        <input type="radio" onchange="return checkedcolorremove(this)" name="color_val" value="0" checked><?php echo $this->Lang['NO']; ?>
                        <input type="radio" onchange="return checkedcoloradd(this)" name="color_val" value="1"><?php echo $this->Lang['YES']; ?>
                        
						<p class="guide"><?php echo $this->Lang['MENTION_COLOR'];?></p>
                    </td>
                 </tr>
                 
                 <tr class="addcolor">
                    <td><label><?php echo $this->Lang['PRODUC_COLOR']; ?></label></td>
                    <td><label>:</label></td>
                                
                    <td>
                        
                        <select name="city_tag[]" id="toggleText" >
			              <option value=""><?php echo $this->Lang['S_PRODU_COLOR']; ?></option>
			            <?php foreach($this->color_code as $CityL){
			            ?>
			            <option value="<?php echo $CityL->color_code; ?>" style='color:#<?php echo $CityL->color_code; ?>'; ><?php echo $CityL->color_name; ?></option>
			            <?php 
			            } ?>
			            </select>
			            
                    </td>
                </tr>
               
                 
                 <tr class="addcolor">
                    <td class="display_color"><label><?php echo $this->Lang['Y_S_CO']; ?></label></td>
                    <td class="display_color"><label>:</label></td>
                    <td>
                                <span id="city_display"> </span>
                        
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

		 		<?php /*<tr>
                    <td><label><?php echo $this->Lang['AUTO_PO_FA']; ?>  </label></td>
                    <td><label>:</label></td>
                    <td>

		 <input type="radio" name="autopost" <?php if($this->session->get("facebook_status")==1) {?> checked <?php } ?>  value="1" > <?php echo $this->Lang['YES']; ?> <input type="radio" name="autopost" value="2" <?php if($this->session->get("facebook_status")!=1) {?> checked  <?php } ?> > <?php echo $this->Lang['NO']; ?>
			</td>
                </tr>*/?>

                <tr>
                    <td><label><?php echo $this->Lang["PRODUCT_IMG"]; ?></label></td>
                    <td><label>:</label></td>
                                
                    <td>
                        <div class = "inputs">
                        <input type="file" name="image[]"  id="first" onchange="return validateFileExtension(this)" />
                       </div>
                       
                        <input type="button" id="add" value="<?php echo $this->Lang['MRE_IMG']; ?>" >
                        <input type="button" id="remove" value="<?php echo $this->Lang['RMV']; ?>" >
                        <em><?php if(isset($this->form_error["image"])){ echo $this->form_error["image"]; }?></em>
                        <label><?php echo $this->Lang['IMG_UP_S']; ?> </label>
                    </td>
                </tr>

			  
                 
                


				

			  
			  <!-- attribute end -->
			  
                
                <?php /*
                <tr class="addcolor">
                    <td><label>Product Color</label></td>
                    <td><label>:</label></td>
                                
                    <td>
                        <div class = "inputs_text">
                        <input type="text" name="color[]"  id="firsttext" onchange="return validateFileExtensiontext(this)" /></div>
                        <input type="button" id="addtext" value="Add color" >
                        <input type="button" id="removetext" value="<?php echo $this->Lang['RMV']; ?>" >
                        <em><?php if(isset($this->form_error["image"])){ echo $this->form_error["image"]; }?></em>
                    </td>
                </tr>
                    */ ?>
                
                
                
                </table>
                </div>
                <fieldset>
					<legend><?php echo $this->Lang["FR_STR_TRANS_ONLY"]; ?></legend>
					<table>
						<?php $this->merchant_duration = $this->merchant->get_duration_values(); // store credits options ?>
						<?php if((!isset($this->form_error['duration'])) && (!isset($_POST['duration']))){ ?>
						<?php if(count($this->merchant_duration)>0) { ?>        
						<tr>
							<td><label><?php echo $this->Lang["STR_CRD"]; ?></label><span></span></td>
							<td><label>:</label></td>
							<td>
								<?php foreach($this->merchant_duration as $dur) {  ?>
									<input type="checkbox" name="duration[]" value="<?php echo $dur->duration_id.','.$dur->duration_period; ?>" /><?php echo $dur->duration_period; ?><?php echo " ".$this->Lang['MTHS']; ?>
							   <?php } ?>
							   
							   
								<em></em>
							</td>
						</tr>
						<?php }} else { ?>
						<?php if(count($this->merchant_duration)>0) { ?>        
						<tr>
							<td><label><?php echo $this->Lang["STR_CRD"]; ?></label><span></span></td>
							<td><label>:</label></td>
							<td>
								<?php foreach($this->merchant_duration as $dur) {  ?>
								<input type="checkbox" name="duration[]" value="<?php echo $dur->duration_id.','.$dur->duration_period; ?>"<?php if(in_array($dur->duration_id.','.$dur->duration_period,$_POST['duration'])){?>checked<?php } ?> /><?php echo $dur->duration_period; ?><?php echo " ".$this->Lang['MTHS']; ?>
							
							   <?php } ?>
							  
								<em></em>
							</td>
						</tr>
						<?php } } ?>
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
                        <input type="radio" name="offer" value="0" onclick="bulk_discount();" checked  style="display:none" >
                    	<input type="radio" name="offer" value="1"  onclick="bulk_discount();" <?php if(!isset($this->form_error["offer"])&&isset($this->userPost["offer"])&& $this->userPost["offer"]==1){?>checked<?php } ?>><?php echo $this->Lang["BULK_DISCOUNT"]; ?>
                    	<input type="radio" name="offer" value="2" <?php if(!isset($this->form_error["offer"])&&isset($this->userPost["offer"])&& $this->userPost["offer"]==2){?>checked<?php } ?> onclick="gift();"><?php echo $this->Lang["GIFT"]; ?>
                      	<em><?php if(isset($this->form_error["offer"])){ echo $this->form_error["offer"]; }?></em>
                   	</td>
                </tr>
						
						 <tr class="gift" <?php if(!isset($this->form_error["offer"])&&isset($this->userPost["offer"])&& $this->userPost["offer"]!=2){?>style="display:none;" <?php }elseif(isset($this->userPost["offer"]) && $this->userPost["offer"]==2){?>style="visibility:visible;"<?php } ?> style="display:none">
                    <td><label><?php echo $this->Lang["GIFT"]; ?></label> <span>*</span></td>
		   
                    <td><label>:</label></td>
                    <td>
                    	<select name="free_gift" class="free_gift">
			<option value=""><?php echo $this->Lang['SEL_ANY'];?></option>
			<?php foreach($this->gift_list as $free){?>
			<option value="<?php echo $free->gift_id; ?>"  <?php if(!isset($this->form_error['free_gift']) && isset($_POST['free_gift'])){  if($_POST['free_gift'] == $free->gift_id){ ?>selected<?php } } ?>><?php echo $free->gift_name;?></option>
			<?php } ?>
                    	</select>
                      	<em><?php if(isset($this->form_error["free_gift"])){ echo $this->form_error["free_gift"]; }?></em>
                   	</td>
                </tr>
                
                <tr class="bulk_discount" <?php if(!isset($this->form_error["offer"])&&isset($this->userPost["offer"])&& $this->userPost["offer"]==2){?>style="display:none;" <?php } ?>>
                    <td><label><?php echo $this->Lang["BULK_DISCOUNT"]; ?></label></td>
                    <td><label>:</label></td>
                    <td>
						<table>
							<tr>
								<td><?php echo $this->Lang['BUY_ONE'];?></td>
								<td><select name="buy_bulk" class=" buy_bulk required" style="width:130px;">
									<option value=""><?php echo $this->Lang['SEL_ANY'];?></option>
									<?php for($i=1;$i<=40;$i++){?>
									<option value="<?php echo $i;?>" <?php if(!isset($this->form_error['buy_bulk']) && isset($_POST['buy_bulk'])){  if($_POST['buy_bulk'] == $i){ ?>selected<?php } } ?>><?php echo $i;?></option>
									<?php } ?>
								</select>
								<em><?php if(isset($this->form_error["buy_bulk"])){ echo $this->form_error["buy_bulk"]; }?></em></td>
								<td><?php echo $this->Lang['GET'];?></td>
								<td><select name="get_bulk" class=" get_bulk required" style="width:130px;">
									<option value=""><?php echo $this->Lang['SEL_ANY'];?></option>
									<?php for($i=1;$i<=20;$i++){?>
									<option value="<?php echo $i;?>" <?php if(!isset($this->form_error['get_bulk']) && isset($_POST['get_bulk'])){  if($_POST['get_bulk'] == $i){ ?>selected<?php } } ?>><?php echo $i;?></option>
									<?php } ?>
								</select>
								<em><?php if(isset($this->form_error["get_bulk"])){ echo $this->form_error["get_bulk"]; }?></em></td>
							</tr>
						</table>
                    	<?php /*<input type="text" name="bulk_discount" maxlength="255" value="<?php if(!isset($this->form_error["bulk_discount"])&&isset($this->userPost["bulk_discount"])){ echo $this->userPost["bulk_discount"]; }?>" autofocus />*/?>
                    	
                      	<em><?php if(isset($this->form_error["bulk_discount"])){ echo $this->form_error["bulk_discount"]; }?></em>
                   	</td>
                </tr>
               
                <tr class="date_offer" >
                    <td><label><?php echo $this->Lang["START_DATE"]; ?></label><span>*</span></td>
                    <td><label>:</label></td>
                    <td>
                    	<input type="text" id="startdate" name="start_date" readonly="readonly"  value="<?php if(!isset($this->form_error["start_date"])&&isset($this->userPost["start_date"])){ echo $this->userPost["start_date"]; }?>" />
                        <em><?php if(isset($this->form_error["start_date"])){ echo $this->form_error["start_date"]; }?></em>
                    </td>
                </tr>
                
                 <tr class="date_offer" >
                    <td><label><?php echo $this->Lang["END_DATE"]; ?></label><span>*</span></td>
                    <td><label>:</label></td>
                    <td>
                    	<input type="text" name="end_date" id="enddate" readonly="readonly" value="<?php if(!isset($this->form_error["end_date"])&&isset($this->userPost["end_date"])){ echo $this->userPost["end_date"]; }?>" />
                    	<em><?php if(isset($this->form_error["end_date"])){ echo $this->form_error["end_date"]; }?></em>
                    </td>
                </tr>
					</table>
					
                </div>
                <?php if($submit == "1"){ ?>
                <tr>
                    <td></td>
                    <td></td>
                    <td>
                        <div class="submit_margin">
							<input type="hidden" id="status" name="status" value="1">
							<input type="submit" value="<?php echo $this->Lang['SUBMIT']; ?>"  id="check2"/>
							<input type="button" value="<?php echo $this->Lang['PREVIEW']; ?>"  onclick="check_validation();"/>
                            <input type="button" value="<?php echo $this->Lang['RESET']; ?>" onclick="javascript:window.location='<?php echo PATH; ?>store-admin/add-products.html'" />
                        </div>
                    </td>
                </tr>
                <?php } ?>
        </div>
           
        </form>
        
    </div>
    <div class="content_bottom"><div class="bot_left"></div><div class="bot_center"></div><div class="bot_rgt"></div></div>
</div>

<?php 
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
		 html  = '<tr class="atrmain" id="row-'+addedrow+'">  <td></td><td></td> <td> ';
		 html += '<select name="attribute[]">';
		 html += sel;
		 html += '  </select> ';
		 html+= ' <input class="spec_attrib" type="text" name="attribute_value[]" value="">   ' ;
		html+= '<input type="button" name="remove" onclick="RemoveAttribute('+addedrow+')" class="btn_remove" value="Remove">   </td> </tr>' ;
		 
		 $('#btns').before(html);
	   }else{
		alert("Maximum limit reached");
		return false;
		
	   }
 
 
}

function showatr() {
    var value = $('input:radio[name=attr_option]:checked').val();
	 
	 if(value==1) {
	  $(".attribute").show();
	 }else{
	  $(".attribute").hide();
	 }
}

function shospe() {
    var value = $('input:radio[name=attr_option]:checked').val();
	 
	 if(value==1) {
	  $(".spe_show").show();
	 }else{
	  $(".spe_show").hide();
	 }
}

function addDelivery() {
 var Deliverydrow = $('.policymain').length;

		 html  = '<tr class="policymain" id="row-'+Deliverydrow+'"> ';
                  html+= '<td><label><?php echo $this->Lang["DEL_POLICY"]; ?> </label></td>';
                  html+= ' <td><label>:</label></td>';
		 html+= '<td> <input type="text" name="Delivery_value[]" value="">' ;
		html+= ' <input type="button" name="remove" onclick="RemoveDelivery('+Deliverydrow+')" class="Delivery_remove" value="Remove">   </td> </tr>' ;
		 
		 $('#Delivery').before(html);
 
 
}

function RemoveDelivery(val) {
 
  $("#row-"+val).remove();
}
function bulk_discount()
{
	$(".bulk_discount").show();
	$(".date_offer").show();
	$(".gift").hide();
	$(".free_gift").val('');
	
}
function gift()
{
	$(".gift").show();
	$(".date_offer").show();
	$(".bulk_discount").hide();
	$(".buy_bulk").val('');
	$(".get_bulk").val('');
}
 </script>
<script>
function check_validation(){
	var textVal = $(".txtChar").val();
	if(textVal == "") {
		alert('Quantity is required');
		return false;
	}
	if(textVal == 0) {
		alert('The Quantity should not be zero');
		return false;
	}
   /* var selectsize = $(".selectsize").val();
	if(selectsize == "") {
		alert('Please fill all mandatory fields');
		return false;
	}*/

	var a = 0, rdbtn=document.getElementsByName("shipping")
	for(i=0;i<rdbtn.length;i++) {
		if(rdbtn.item(i).checked == false) {
			a++;
		}
	}
	if(a == rdbtn.length) {
		alert("No way you submit it without choose shipping method");
		return false;
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

	// else you can show error message like this
   // alert("No way you submit it without choose shipping method");
	
	if($('input[type=checkbox]:checked').length == 0){
		alert("Please select minimum one size checkbox");
		return false;
	}
	$('#status').val(2);
	$('#addFormId').submit();
}
</script>
