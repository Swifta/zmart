<?php defined('SYSPATH') OR die("No direct access allowed."); ?>
<?php $start_date_one = date("Y-m-d 00:00:01"); 
        $enddate_date_one = date("Y-m-d 23:59:59"); 
        $end_date_seven = date("Y-m-d H:i:s"); 
        $start_date_seven = strtotime($end_date_seven) - (7*24*3600);
        $start_date_seven = date("Y-m-d H:i:s",$start_date_seven);
        $end_date_thirty = date("Y-m-d H:i:s"); 
        $start_date_thirty = strtotime($end_date_thirty) - (30*24*3600);
        $start_date_thirty = date("Y-m-d H:i:s",$start_date_thirty);
?>

        <script type="text/javascript"> 
        $(document).ready(function(){
        $('#date_display').hide();
        $("#ui-datepicker-div").hide();
                $("#startdate").datetimepicker({
                        maxDate: 'today',
                        dateFormat: "yy-mm-dd",
                        onSelect: function(selected) {
                                $("#enddate").datetimepicker("option","minDate", selected)
                        }
                });
        $("#enddate").datetimepicker({
                maxDate: 'today',
                dateFormat: "yy-mm-dd",
                onSelect: function(selected) {
                        $("#startdate").datetimepicker("option","maxDate", selected)
                }
        }); 	
        $("#startdate").datetimepicker().datetimepicker('disable');
        $("#enddate").datetimepicker().datetimepicker('disable');
        <?php if(isset($_GET['today'])) { ?>
                change_dat();
        <?php } ?>
        });	
	function today_transaction(val)
	{
		window.location='<?php $current_url = explode('?', $_SERVER["REQUEST_URI"]); echo $current_url[0]; ?>?today='+val;
	}
	function validate()
	{	
		if(document.getElementById('date_range').checked) {
			var startdate = $('#startdate').val();
			var enddate = $('#enddate').val();
			if(startdate == "" && enddate != "")
			{
				alert("Please Enter From Date");
				return false;
			}
			if(startdate != "" && enddate == "")
			{
				alert("Please Enter To Date");
				return false;
			}
			if(startdate == "" && enddate == "")
			{
				alert("Please Enter From Date and To Date ");
				return false;
			}
		} else {
			var startdate = $('#startdate').val();
			var enddate = $('#enddate').val();
			if(startdate != "" && enddate != "")
			{
				alert("Please Select Date Range");
				return false;
			}
			if(startdate != "" && enddate == "")
			{
				alert("Please Enter To Date");
				return false;
			}
			if(startdate == "" && enddate != "")
			{
				alert("Please Enter From Date");
				return false;
			}
		}
	}
</script>
<div class="bread_crumb"><a href="<?php echo PATH.'admin.html'; ?>" title="<?php echo $this->Lang['HOME']; ?>"><?php echo $this->Lang["HOME"]; ?> <span class="fwn">&#155;&#155;</span></a><p><?php echo $this->template->title; ?></p></div>
<?php $this->session->set("lasturl",substr($_SERVER['REQUEST_URI'], REQUEST_URL_COUNT));  ?>
<div class="cont_container mt15 mt10">
    <div class="content_top"><div class="top_left"></div><div class="top_center"></div><div class="top_rgt"></div></div>
    <div class="content_middle">
        <form method="get" class="admin_form">
        
        <?php if(count($this->users_list) > 0){ ?>
			<?php if($this->pagination !=""){ // export per page ?>
				<a class="fr frm_export" href="<?php echo PATH.$this->url.'/page/'.$this->page.'?id='.$this->Lang['SEARCH'].'&name='.$this->input->get('name').'&city='.$this->input->get('city').'&email='.$this->input->get('email').'&today='.$this->input->get('today').'&startdate='.$this->input->get('startdate').'&enddate='.$this->input->get('enddate');  ?>" title="<?php echo $this->Lang['EXP_DL']; ?>" title="<?php echo $this->Lang['EXP_DL']; ?>"><?php echo $this->Lang['EXP_PAGE']; ?></a>

			<?php } ?>
			
		<a class="fr frm_export" href="<?php echo PATH.$this->url.'?id='.$this->Lang['ALL2'].'&name='.$this->input->get('name').'&city='.$this->input->get('city').'&email='.$this->input->get('email').'&today='.$this->input->get('today').'&startdate='.$this->input->get('startdate').'&enddate='.$this->input->get('enddate');  ?>" title="<?php echo $this->Lang['EXP_DL']; ?>" title="<?php echo $this->Lang['EXP_DL']; ?>"><?php echo $this->Lang['EXP_ALL']; ?></a>
		

		<?php } ?>
		
        <table class="list_table1 fl clr filter_part">
        <tr>
        <td><input type="radio" name="today" value="4" onclick="return change_dat();" <?php if($this->today == 4 || $this->today == "") { echo "checked"; } ?>><label><?php echo "All"; ?></label></td>
        <td><input type="radio" name="today" value="1" onclick="return change_dat();" <?php if(isset($this->today) && $this->today == 1) { echo "checked"; } ?>><label>Today</label></td>
        <td><input type="radio" name="today" value="2" onclick="return change_dat();" <?php if(isset($this->today) && $this->today == 2) { echo "checked"; } ?>><label><?php echo "Less than 7days"; ?></label></td>
        <td><input type="radio" name="today" value="3" onclick="return change_dat();" <?php if(isset($this->today) && $this->today == 3) { echo "checked"; } ?>><label><?php echo "Less than 30days"; ?></label></td>       
        <td><input type="radio" name="today" value="5" onclick="return change_dat();" <?php if(isset($this->today)  && $this->today == 5) { echo "checked"; } ?>><label>Date Range</label></td>
        </tr>
        </table>
                
                <div class="date_range_common">            
                    <div class="list_table1 fl clr date_range_part" id="date_display">
                        <div class="date_range_lft">
                            <label><?php echo $this->Lang["FROM"]; ?> :</label>        
                            <span><input class="transction_txt" type="text" name="startdate" readonly id="startdate" value="<?php if(isset($this->startdate)){ echo $this->startdate;  } ?>" /></span>
                        </div>
                        <div class="date_range_right">
                           <label><?php echo $this->Lang["TO"]; ?> :</label>        
                           <span><input type="text" name="enddate" readonly id="enddate" value="<?php if(isset($this->enddate)){ echo $this->enddate;  } ?>" ></span>
                        </div>        
                    </div>
                    
                     <?php 
                if(isset($this->search_key)){
                $s = $this->search_key;
                }?>
                <div class="date_range_part">
                    <div class="date_range_lft">
                        <label><?php echo $this->Lang["NAME"]; ?> :</label>  
                        <span><input type = "text" name = "name" <?php if(isset($s->name)){?> value="<?php echo $s->name; ?>"<?php } ?> autofocus /></span>
                    </div>
                    <div class="date_range_right">
                        <label><?php echo $this->Lang["EMAIL_F"]; ?> :</label>
                        <span><input type = "text" name = "email" <?php if(isset($s->email)){?> value="<?php echo $s->email; ?>"<?php } ?>/></span>
                    </div>
                </div>
                    <div class="date_range_part">
                    <div class="date_range_lft">
                        <label><?php echo $this->Lang["CITY_NAME"]; ?> :</label>        
                        <span><select name ="city" autofocus>
                     <?php if(isset($s->city)){ foreach($this->city_list as $c){ if($s->city == $c->city_id){ ?>
                        <option value="<?php echo $c->city_id; ?>"><?php echo ucfirst($c->city_name);?></option> <?php  }}} ?>
                        <option value=""><?php echo $this->Lang["SEL_CITY"]; ?></option>
                        <?php foreach($this->city_list as $c){ ?>
                        <?php if(isset($s->city)){
                        if($s->city != $c->city_id){  ?>
                        <option value="<?php echo $c->city_id; ?>"><?php echo ucfirst($c->city_name); ?></option>  
                        <?php } } else { ?>
                        <option value="<?php echo $c->city_id; ?>"><?php echo ucfirst($c->city_name); ?></option>  
                        <?php } ?> 
                        <?php }?>
                    </select></span>
                    </div>
                    </div>
                    <div class="date_range_bottm" >    
                        <div class="date_range_submit">
                        <input type="submit" value="<?php echo $this->Lang['SEARCH']; ?>"/>
                        </div>
                    </div>
                </div>                
                
        
        </form>
    
    <?php if(count($this->users_list)>0){?>
        <div class="table_over_flow">
        <table class="list_table fl clr mt15">
        	<tr>
        	<th align="left" ><?php echo $this->Lang['S_NO']; ?></th>
            	<th align="left" ><div class="arrow"><a href="<?php echo $this->sort_url;?>param=name&sort=<?php if($this->input->get('sort')=='DESC'){ echo 'ASC'; }else{ echo 'DESC'; } ?>" title="<?php echo $this->Lang['SORT_BY_NAME']; ?>" ><?php echo $this->Lang["NAME"]; ?></a></div></th>
            	<th align="left" ><div class="arrow"><a href="<?php echo $this->sort_url;?>param=email&sort=<?php if($this->input->get('sort')=='DESC'){ echo 'ASC'; }else{ echo 'DESC'; } ?>" title="<?php echo $this->Lang['SO_B_E']; ?>" ><?php echo $this->Lang["EMAIL_F"]; ?></a></div></th>

            	<th align="left" ><div class="arrow1"><a href="<?php echo $this->sort_url;?>param=store&sort=<?php if($this->input->get('sort')=='DESC'){ echo 'ASC'; }else{ echo 'DESC'; } ?>" title="<?php echo $this->Lang['SO_B_ST']; ?>" ><?php echo $this->Lang["STORE_NAME"]; ?></a></div></th>

            	<th align="left" ><div class="arrow1"><a href="<?php echo $this->sort_url;?>param=city&sort=<?php if($this->input->get('sort')=='DESC'){ echo 'ASC'; }else{ echo 'DESC'; } ?>" title="<?php echo $this->Lang['SORT_BY_CITY']; ?>" ><?php echo $this->Lang["CITY"]; ?></a></div></th>
            		<th align="left" ><?php echo $this->Lang["JOIN_DATE"]; ?></th>
            		<th align="left" ><?php echo $this->Lang['SEND_MAIL']; ?></th>
            	<th align="left" ><?php echo $this->Lang['APPROVE']; ?>/<br><?php echo $this->Lang['DIS_APPR']; ?></th> 
            	<?php if(ADMIN_PRIVILEGES_MERCHANT_ADD){?>
                <th align="left" ><?php echo $this->Lang["ADD_BRANCH_SHOP"]; ?></th>
                <?php }?>
                <th align="left" ><?php echo $this->Lang["MAN_BRANCH_SHOP"]; ?></th>
                <?php if(ADMIN_PRIVILEGES_MERCHANT_EDIT){?>
                <th align="left" ><?php echo $this->Lang["EDIT"]; ?></th>
                <?php }?>
                <?php if(ADMIN_PRIVILEGES_MERCHANT_BLOCK){?>
                <th align="left" ><?php echo $this->Lang["B_UNB"]; ?></th>
                <?php }?>
				<?php /*<th align="left" ><?php echo 'Rating'; ?></th> */ ?>
            </tr>
            <?php $i=0; $first_item = $this->pagination->current_first_item;
                foreach($this->users_list as $u){?>
                <tr>    
                        <td align="left"><?php echo $i+$first_item; ?></td>
                        <td align="left"><a href="<?php echo PATH; ?>admin/merchant-details/<?php echo base64_encode($u->user_id); ?>.html"><?php echo ucfirst(htmlspecialchars($u->firstname)); ?></a></td>
                        <td align="left"><?php echo $u->email; ?></td>
                        <td align="left"><?php echo htmlspecialchars($u->store_name);?></td>		
                        <td align="left"><?php foreach($this->city_list as $c){ if($c->city_id == $u->city_id){ echo ucfirst(htmlspecialchars($c->city_name));}  }?></td>
                        <td align="left"><?php echo date('d-M-Y h:i:s A',$u->joined_date);?></td>
                        <script>
                $(document).keyup(function(e) {
                if (e.keyCode == 27) 
                  {
                $('.popup_show_user').hide();
                 } 
                });
		$(document).ready(function(){
			$('a#show-panel<?php echo $u->user_id; ?>').click(function(){ 
				$('#lightbox-panel<?php echo $u->user_id; ?>').show();
			})
			$('#cancel').click(function(){ 
				$('#em').text(''); 
			})
		});
	</script>


			 <td align="left">
                    	<a id="show-panel<?php echo $u->user_id; ?>" title="<?php echo $this->Lang['SEND_MAIL']; ?>"  href="javascript:;"><img src="<?php echo PATH;?>images/mail.png"><input type="hidden" name="email1" id="mail" value="<?php echo $u->email; ?>"></a>
				
		<div class="popup_show popup_show_user" id="lightbox-panel<?php echo $u->user_id; ?>" style="display:none;">
	<form method="post"  class="admin_form">
                <table>
			
                        <tr>
                            <td><label><?php echo $this->Lang['EMAIL']; ?></label></td>
                            <td><label>:</label></td>
		            <td><input type="text" name="email" value="<?php echo $u->email; ?> " readonly >
                            </td>
                        </tr>
	                <input type="hidden" name="name" value="<?php echo $u->firstname; ?> " readonly >
                        <tr>
                            <td><label><?php echo $this->Lang['ENTR_MSG']; ?></label></td>
                            <td><label>:</label></td>
		            <td><textarea class="TextArea" name="message" id="msg" cols=15 rows=10 /></textarea>
		                 <em id="em"><?php if(isset($this->form_error['message'])){ echo $this->form_error["message"]; }?></em>
			    </td>
                        </tr>
                        <tr>
                             <td></td>
                             <td></td>
                             <td><input type="submit" value="<?php echo $this->Lang['SEND']; ?>" id="submit<?php echo $u->user_id; ?>"> <input type="reset" id="cancel" value="<?php echo $this->Lang['CANCEL']; ?>" onclick="javascript:window.location='<?php echo PATH; ?>admin/merchant.html'" />
			     </td>
                        </tr>
                </table>
        </form>
	</div>
		
					
                    </td>

					   <td align="center">
						   <?php if($this->user_type==1 || $this->user_type==2){?>
							<?php /*if ($u->created_by !=$this->user_id ) { */ if($u->approve_status == 1){?>
							<?php /* <a onclick="return approvedisapproveMerchant('<?php echo base64_encode($u->user_id); ?>','disapprove',this);" title="<?php echo $this->Lang['APPROVE']; ?>" class="approveicon"  ></a> */ ?>							
							<p  title="<?php echo $this->Lang['APPROVED']; ?>" class="approveicon"  ></p>
							<?php } else{  ?>
							<a onclick="return approvedisapproveMerchant('<?php echo base64_encode($u->user_id); ?>','approve',this);" title="<?php echo $this->Lang['DIS_APPR_MERCHANT']; ?>" class="disapproveicon" ></a>
							<?php } ?>
						<?php //} else echo "---"; ?>
						<?php }else{echo "--";} ?>
						</td>
						
                        <?php if(ADMIN_PRIVILEGES_MERCHANT_ADD){?>       
                     <td align="center">
						 <?php if($u->user_status =="1"){?> 
                    	<a <?php if($u->user_status =="1"){?> href="<?php echo PATH.'admin/add-merchant-shop/'.$u->user_id;?>.html"  <?php } ?>   ><img src="<?php echo PATH."images/add_branch.png";?>" title="<?php echo $this->Lang['ADD_STR_BR']; ?>"/></a>
                    	<?php } else { ?>
                    	<img src="<?php echo PATH."images/Block_icon.png";?>" title="<?php echo $this->Lang['MERCHANT_BLO']; ?>"/>
                    	<?php } ?>
                        </td>
					<?php }?>
                        
                        <td align="center">
						<a href="<?php echo PATH.'admin/merchant-shop/'.$u->user_id;?>.html" ><img src="<?php echo PATH.'images/manage_branch.png';?>" title="<?php echo $this->Lang['MANG_STORE']; ?>"/>
                    	<?php $j = 0; foreach($this->getstoreslist as $c){ if($c->merchant_id == $u->user_id){ $j++; } } echo "(".$j.")  Shops"; ?> </a> 
                        </td>
                        <?php if(ADMIN_PRIVILEGES_MERCHANT_EDIT){?>
                        <td align="left">
							
                    	<a href="<?php echo PATH.'admin/edit-merchant/'.$u->user_id;?>.html" class="editicon" title="<?php echo $this->Lang['EDIT_MERCHANT']; ?>"></a>
                    	
                        </td>
                        <?php }?>
                        <?php if(ADMIN_PRIVILEGES_MERCHANT_BLOCK){?>
                    <td>
						
                        <?php if($u->approve_status == 1){?>
                    	<?php if($u->user_status == 1){?>
                    	<a onclick="return blockunblockmerchant('<?php echo $u->user_id; ?>','<?php echo base64_encode($u->email); ?>','block');" class="blockicon" title="<?php echo $this->Lang['BLO_MERCHANT']; ?>"></a>
                        <?php } else{  ?>
                        <a onclick="return blockunblockmerchant('<?php echo $u->user_id; ?>','<?php echo base64_encode($u->email); ?>','unblock');" class="unblockicon" title="<?php echo $this->Lang['UNBLO_MERCHANT']; ?>"></a>

                        <?php } ?>
                        <?php } else { ?>
                            <p class="unblockicon"></p>
                        <?php } ?>
                 	<?php /*   <td>
				 <input type="text" size="5px" id="rating-<?php echo $u->user_id; ?>" maxlength="3" name="rating" onkeyup="return rating(this.value,'<?php echo PATH; ?>',<?php echo $u->user_id; ?>);" value="<?php echo $u->rating; ?>"> */ ?>
					</td>
					<?php }?>
                    
                </tr>
            <?php $i++;} ?>   
        </table>
        </div>
    <?php } else{?><p class="nodata"><?php echo $this->Lang["NO_DATA"]; ?></p><?php }?>
	
    <?php echo $this->pagination; ?>
</div>
    <div class="content_bottom"><div class="bot_left"></div><div class="bot_center"></div><div class="bot_rgt"></div></div>
</div>
