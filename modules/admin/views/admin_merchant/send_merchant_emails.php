<?php defined('SYSPATH') OR die('No direct access allowed.'); ?>

<script type="text/javascript" src="<?php echo PATH ?>js/jquery.cleditor.min.js"></script>


<div class="bread_crumb"><a href="<?php echo PATH."admin.html"; ?>" title="<?php echo $this->Lang['HOME']; ?>"><?php echo $this->Lang["HOME"]; ?> <span class="fwn">&#155;&#155;</span></a><p><?php echo $this->template->title; ?></p></div>
<div class="cont_container mt15 mt10">
    <div class="content_top"><div class="top_left"></div><div class="top_center"></div><div class="top_rgt"></div></div>
    <div class="content_middle">
        <form action="" method="post" class="admin_form" name="settings_newsletter" enctype="multipart/form-data" >
            <table>
				 <tr>
                        <td></td>
                        <td></td>
                        <td><label class="filter1"><?php echo $this->Lang["SND_ALL_USER"]; ?></label><span></span>
                        <label class="filter1">:</label>
							<input type="checkbox" name="users" class="users filter1" <?php if(!isset($this->form_error['users']) && isset($this->userPost['users'])){?>checked<?php }?>>
    				
						<em><?php if(isset($this->form_error["users"])){ echo $this->form_error["users"]; }?></em>
						<label class="filter3"></label>
						<label class="filter"><?php echo $this->Lang["SEL_FILTERS"]; ?></label><label class="filter">:</label>
						<input type="checkbox" name="all_users" class="all_users filter" value="1" <?php if(!isset($this->form_error['all_users']) && isset($this->userPost['all_users'])){?>checked<?php }?>>
						<em><?php
                            if (isset($this->form_error["all_users"])) {
                                echo $this->form_error["all_users"];
                            }
                            ?></em>
						
			</td>
                 </tr>
                  <tr <?php if(!isset($this->form_error['all_users']) && isset($this->userPost['all_users'])){?><?php }else{?>class="user_filters"<?php }?>>
                        <td><label><?php echo $this->Lang["LOCATION"]; ?></label><span></span></td>
                        <td><label>:</label></td>
                        <td>
							<table class="new_inner_table">
								<tr>
									<td>
							<select name="city" class="city" autofocus tabindex="1" onchange="return changing_filters(this.value);" style="width: 125px;"> 
                <?php 
                if(!isset($this->form_error["city"]) && isset($this->userPost["city"])){
					$cityid="";
					$cityname="";
                        foreach($this->city_list as $c){
                                if($c->city_id == $this->userPost["city"]){
									$cityname=$c->city_name;
									$cityid=$c->city_id;
                                } elseif($this->userPost["city"]=="all") { $cityname="all"; $cityid="all"; ?>
									
								<?php } 
                        } ?>
                        <option value=""> <?php echo $this->Lang['SEL_CITY']; ?> </option>
                         <option value="<?php echo $this->Lang['ALL2']; ?>" <?php if(!isset($this->form_error['city']) && isset($_POST['city'])){  if($_POST['city'] == 'All'){ ?>selected<?php } } ?>><?php echo $this->Lang['ALL']; ?></option>
                        
                        <?php
                }
                else{
                ?>
            <option value=""> <?php echo $this->Lang['SEL_CITY']; ?> </option>
            <option value="<?php echo $this->Lang['ALL2']; ?>"><?php echo $this->Lang['ALL']; ?></option>
	    <?php } foreach($this->city_list as $c){ ?>
            <option value="<?php echo $c->city_id; ?>" <?php if(!isset($this->form_error['city']) && isset($_POST['city'])){  if($_POST['city'] == $c->city_id){ ?>selected<?php } } ?>><?php echo ucfirst($c->city_name); ?></option>  
            <?php } ?>
        </select>
        <em><?php if(isset($this->form_error["city"])){ echo $this->form_error["city"]; }?></em></td>
       <td> <label><?php echo $this->Lang["GENDER"]; ?></label><span></span></td>
                        <td><label>:</label></td>
                        <td><select name="gender" class="gender" autofocus tabindex="1" onchange="return changing_filters(this.value);" style="width: 120px;"> 
						<option value=""> <?php echo $this->Lang['SEL_GEN']; ?> </option>
						<option value="<?php echo $this->Lang['ALL2']; ?>" <?php if(!isset($this->form_error['gender']) && isset($_POST['gender'])){  if($_POST['gender'] == 'All'){ ?>selected<?php } } ?>><?php echo $this->Lang['ALL']; ?></option>
						<option value="1" <?php if(!isset($this->form_error['gender']) && isset($_POST['gender'])){  if($_POST['gender'] == '1'){ ?>selected<?php } } ?>><?php echo $this->Lang["MALE"]; ?></option>
						<option value="2" <?php if(!isset($this->form_error['gender']) && isset($_POST['gender'])){  if($_POST['gender'] == '2'){ ?>selected<?php } } ?>><?php echo $this->Lang["FEMALE"]; ?></option>
           
        </select></td>
                        <td><label><?php echo $this->Lang["AGE_RNG"]; ?></label><span></span></td>
                        <td><label>:</label></td>
                        <td><select name="age_range" class="age_range" autofocus tabindex="1" onchange="return changing_filters(this.value);" style="width:152px;"> 
               
						<option value=""> <?php echo $this->Lang['SEL_AGE_RNG']; ?> </option>
						<option value="<?php echo $this->Lang['ALL2']; ?>" <?php if(!isset($this->form_error['age_range']) && isset($_POST['age_range'])){  if($_POST['age_range'] == 'All'){ ?>selected<?php } } ?>><?php echo $this->Lang['ALL']; ?></option>
	  
						<option value="1"<?php if(!isset($this->form_error['age_range']) && isset($_POST['age_range'])){  if($_POST['age_range'] == '1'){ ?>selected<?php } } ?> ><?php echo $this->Lang["17_BEL"]; ?></option>
						<option value="2" <?php if(!isset($this->form_error['age_range']) && isset($_POST['age_range'])){  if($_POST['age_range'] == '2'){ ?>selected<?php } } ?>><?php echo $this->Lang["18_25"]; ?></option>
						<option value="3" <?php if(!isset($this->form_error['age_range']) && isset($_POST['age_range'])){  if($_POST['age_range'] == '3'){ ?>selected<?php } } ?>><?php echo $this->Lang["26_35"]; ?></option>
						<option value="4" <?php if(!isset($this->form_error['age_range']) && isset($_POST['age_range'])){  if($_POST['age_range'] == '4'){ ?>selected<?php } } ?>><?php echo $this->Lang["36_45"]; ?></option>
						<option value="5" <?php if(!isset($this->form_error['age_range']) && isset($_POST['age_range'])){  if($_POST['age_range'] == '5'){ ?>selected<?php } } ?>><?php echo $this->Lang["46_65"]; ?></option>
						<option value="6" <?php if(!isset($this->form_error['age_range']) && isset($_POST['age_range'])){  if($_POST['age_range'] == '6'){ ?>selected<?php } } ?>><?php echo $this->Lang["66_ABV"]; ?></option>
        </select>
        </td>
        </tr>
			</table>
        </td>
                 </tr>
                  <tr <?php if(!isset($this->form_error['all_users']) && isset($this->userPost['all_users'])){?><?php }else{?>class="user_filters"<?php }?> >
                        <td><label><?php echo $this->Lang["SEL_EMAIL"]; ?></label><span>*</span></td>
                        <td><label>:</label></td>
                        <td id="email1">
							<div class="input-text1 clearfix">
		                	 <div class="search-input1" style="padding:0;" ><div class="add_pt"><ul>
								  <?php if(!isset($_POST['age_range']) && !isset($_POST['city']) && !isset($_POST['gender'])){?>
							 <li><input type="checkbox" name="email" onclick="checkboxcheckAllUsers(&#39;settings_newsletter&#39;,&#39;email&#39;)" /><span>Select all</span></li>
							 
							 <?php foreach($this->users as $users){?>
							 <li><input type="checkbox" name="email[]" class="case" value="<?php echo $users->email.'__'.$users->firstname.'__'.$users->user_id;?>" <?php if(!isset($this->form_error['email']) && isset($_POST['email'])){  if($_POST['email'] == $users->email){  ?>checked<?php } } ?> /><span><?php echo $users->email;?></span></li>
							 <?php } ?>
							 <?php } else{
								 $this->merchant = new Admin_merchant_Model();
								 $this->user_per_filter=$this->merchant->get_user_list1(1,$_POST['city'],$_POST['gender'],$_POST['age_range']);
								 
								 ?>
							 
								<li><input type="checkbox" name="email" onclick="checkboxcheckAllUsers(&#39;settings_newsletter&#39;,&#39;email&#39;)" /><span>Select all</span></li>
							 <?php foreach($this->user_per_filter as $users){?>
							 <li><input type="checkbox" name="email[]" class="case" value="<?php echo $users->email.'__'.$users->firstname.'__'.$users->user_id;?>" <?php if(isset($_POST['email'])){  if(in_array($users->email.'__'.$users->firstname.'__'.$users->user_id,$_POST['email'])){?>checked<?php } } ?> /><span><?php echo $users->email;?></span></li>
							 <?php } ?>
							 <?php } ?>
							 </ul></div></div></div></td>
                        <em><?php if(isset($this->form_error["email"])){ echo $this->form_error["email"]; }?></em>
                        </td>
                 </tr>
               
                  <tr>
                        <td><label><?php echo $this->Lang["SUBJECT"]; ?></label><span>*</span></td>
                        <td><label>:</label></td>
                        <td><input type="text" name="subject"  value="<?php if(!isset($this->form_error['subject']) && isset($this->userPost['subject'])){ echo $this->userPost['subject']; }?>" />
                        <em><?php if(isset($this->form_error["subject"])){ echo $this->form_error["subject"]; }?></em></td>
                 </tr>
                   <tr>
					 <td><label><?php echo $this->Lang["WANT_TO_ADD_NS_TMP"]; ?></label><span>*</span></td>
                     <td><label>:</label></td>
                     <td>
						 <span><input type="radio" name="add_temp" value="1" onclick="show_temp()" <?php if(!isset($this->form_error['add_temp']) && isset($this->userPost['add_temp'])&& $this->userPost['add_temp']==1){?>checked<?php }else if(empty($_POST)){?> checked <?php }?>><?php echo $this->Lang['YES']; ?></span>
						 <span><input type="radio" name="add_temp" value="0" onclick="show_temp()" <?php if(!isset($this->form_error['add_temp']) && isset($this->userPost['add_temp'])&& $this->userPost['add_temp']==0){?>checked<?php }?>><?php echo $this->Lang['NO']; ?></span>
						  
                     </td>
                 </tr>
                  <tr class="show_news_temp">
                        <td><label><?php echo $this->Lang["EMAIL_TEMPLATE"]; ?></label><span>*</span></td>
                        <td><label>:</label></td>
                        <td>
							<div style="float:left;margin-right:10px;">
						  <div class="dash_act_img" style="float: left;width: 192px;padding: 5px;height: auto;border: 2px solid #d8d8d8;border-radius: 3px;">
						
						  <img src="<?php echo PATH ?>/themes/<?php echo THEME_NAME;?>/images/2.png" class="image" alt="<?php echo "Template1"; ?>"/>
						   </div>
						   
						   <p style="float:left;clear:both;margin:5px 0 0 0;"><?php echo "Template1"; ?>
						  				  
						   <span><input type="radio" name="template" value="1" <?php if(!isset($this->form_error['template']) && isset($this->userPost['template'])&& $this->userPost['template']==1){?>checked<?php }else{ ?> checked<?php } ?>><label></label></span>
						  </p>
						   </div>
						   </div> 
						   
								<div style="float:left;">			  
						  <div class="dash_act_img" style="float: left;width: 192px;padding: 5px;height: auto;border: 2px solid #d8d8d8;border-radius: 3px;">
						
						  <img src="<?php echo PATH ?>/themes/<?php echo THEME_NAME;?>/images/1.png" class="image" alt="<?php echo "Template2"; ?>"/>
						   </div>
						   
						   <p style="float:left;clear:both;margin:5px 0 0 0;"><?php echo "Template2"; ?>
						  
						   <span><input type="radio" name="template" value="2" <?php if(!isset($this->form_error['template']) && isset($this->userPost['template'])&& $this->userPost['template']==2){?>checked<?php } ?>><label></label><label></label></span>
						  </p>
						   </div> 
						    </div>
							
							
                        <em><?php if(isset($this->form_error["template"])){ echo $this->form_error["template"]; }?></em></td>
                 </tr>
                 <tr>
                        <td valign="top"><label><?php echo $this->Lang["MSGG"]; ?></label><span>*</span></td>
                        <td valign="top"><label>:</label></td>
                        <td><textarea cols="20" rows="5" name="message" class="TextArea required"><?php if(!isset($this->form_error['message']) && isset($this->userPost['message'])){echo $this->userPost['message'];}?></textarea>
                        <em><?php
                            if (isset($this->form_error["message"])) {
                                echo $this->form_error["message"];
                            }
                            ?></em>
                        </td>
                 </tr>
                 <tr style="display:none;">
                        <td><label><?php echo $this->Lang["ATACH"]; ?></label><span>*</span></td>
                        <td><label>:</label></td>
                        <td><input type="file" name="attach[]" id="attachment"/>
                        <em><?php if(isset($this->form_error["attach"])){ echo $this->form_error["attach"]; }?></em></td>
                 </tr>
                 <tr>
                        <td></td>
                        <td></td>
                        <td>
							<input type="hidden" value="2" name="mail_category">
							<input type="submit" value="<?php echo $this->Lang['SEND']; ?>" /><input type="button" value="<?php echo $this->Lang['CANCEL']; ?>" onclick='window.location.href="<?php echo PATH?>admin.html"'/></td>
                 </tr>
            </table>
        </form>
    </div>

    <div class="content_bottom"><div class="bot_left"></div><div class="bot_center"></div><div class="bot_rgt"></div></div>

</div>

<script>
$(document).ready(function()
{
	$(".user_filters").hide();
	$('input[class="all_users"]').click(function(){
	 if($(this).prop("checked") == true){
	
	$(".filter1").hide();
	$(".filter3").hide();
	
}else{
	$(".user_filters").hide();
	$(".filter1").show();
}

});
	
});
$(document).ready(function() {
   
    $(".users").click(function() {
        if (this.checked) {
            $(".filter").hide();
            $(".filter3").hide();
	$(".all_users").attr("checked",false);
	$(".gender").val("");
	$(".age_range").val("");
	$(".city").val("");
        }else{
			$(".filter").show();
			$(".filter3").show();
		}
    });
    $(".all_users").click(function() {
        if (this.checked) {
			
			$(".filter1").hide();
			$(".filter3").hide();
			$(".user_filters").show();
			$(".users").attr("checked",false);
	var city=$(".city").val();
	var gender=$(".gender").val();
	var age_range=$(".age_range").val();
	if(city=="")
	{
		city=0;
	}if(gender=="")
	{
		gender=0;
	}if(age_range=="")
	{
		age_range=0;
	}
	
	
	var url = SrcPath+'/admin_merchant/user_select1/1/'+city+'/'+gender+'/'+age_range; 
	

	$.ajax(
	{
		type:'POST',
		url:url,
		cache:false,
		async:true,
		global:false,

		dataType:"html",
		success:function(check)
		{
		   $("#email1").html(check);
		   
		},
		error:function()
		{
			alert('No Email Under the Option.');
		}
	});
		}else{
			
			$(".filter1").show();
			$(".filter3").show();
			$(".user_filters").hide();
			$(".city").val("");
			$(".gender").val("");
			$(".age_range").val("");
		}
		
	});
});
	
function changing_filters(val){ 
	
	
	var city=$(".city").val();
	var gender=$(".gender").val();
	var age_range=$(".age_range").val();
	if(city=="")
	{
		city=0;
	}if(gender=="")
	{
		gender=0;
	}if(age_range=="")
	{
		age_range=0;
	}
	var url = SrcPath+'/admin_merchant/user_select1/1/'+city+'/'+gender+'/'+age_range; 
	

	$.ajax(
	{
		type:'POST',
		url:url,
		cache:false,
		async:true,
		global:false,

		dataType:"html",
		success:function(check)
		{
		   $("#email1").html(check);
		   
		},
		error:function()
		{
			alert('No Email Under the Option.');
		}
	});



}
function show_temp(){
	var value = $('input:radio[name=add_temp]:checked').val();
	if(value==1) {
		$(".show_news_temp").show();
	}else{
		$(".show_news_temp").hide();
	}
}
</script>
<?php if(!isset($this->form_error['add_temp']) && isset($this->userPost['add_temp'])&& $this->userPost['add_temp']==1){?>
<script>
	$(document).ready(function() { 
		$(".show_news_temp").show();
	});
</script>
<?php }?>
<?php if(!isset($this->form_error['add_temp']) && isset($this->userPost['add_temp'])&& $this->userPost['add_temp']==0){?>
<script>
	$(document).ready(function() { 
		$(".show_news_temp").hide();
	});
</script>
<?php }?>
