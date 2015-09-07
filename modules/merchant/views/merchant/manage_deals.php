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
<div class="bread_crumb"><a href="<?php echo PATH."merchant.html"; ?>" title="<?php echo $this->Lang['HOME']; ?>"><?php echo $this->Lang["HOME"]; ?> <span class="fwn">&#155;&#155;</span></a>
  <?php $this->session->set("lasturl",substr($_SERVER['REQUEST_URI'], REQUEST_URL_COUNT));  ?>
<?php if(isset($s->title)){?>
<a href="<?php echo PATH.$this->url; ?>" title="<?php echo $this->template->title; ?>">&nbsp;<?php echo $this->template->title; ?>&nbsp;<span class="fwn">&#155;&#155;</span></a><p><?php echo $this->Lang["SEARCH"]; ?></p>
<?php } else{ ?>
<p><?php echo $this->template->title; ?></p>
<?php } ?></div>
<div class="cont_container mt15 mt10">
    <div class="content_top"><div class="top_left"></div><div class="top_center"></div><div class="top_rgt"></div></div>
    <div class="content_middle">
    
     <form method="get" class="admin_form" action="<?php echo PATH.$this->url;?>">
    
		<?php  if(($this->uri->last_segment() == 'manage-deals.html') || ($this->uri->last_segment() == 'archive-deals.html') ||($this->uri->segment(3))){
						
		 if(count($this->all_deal_list) > 0){ ?>
		<?php if($this->pagination !=""){ ?>
				<a class="fr frm_export" href="<?php echo PATH.$this->url.'/page/'.$this->page.'?id='.$this->Lang['SEARCH'].'&name='.$this->input->get('name').'&city='.$this->input->get('city').'&today='.$this->input->get('today').'&startdate='.$this->input->get('startdate').'&enddate='.$this->input->get('enddate');  ?>" title="<?php echo $this->Lang['EXP_DL']; ?>"><?php echo $this->Lang['EXP_PAGE']; ?></a>
			<?php } ?>
		<a class="fr frm_export" href="<?php echo PATH.$this->url.'?id='.$this->Lang['ALL2'].'&name='.$this->input->get('name').'&city='.$this->input->get('city').'&today='.$this->input->get('today').'&startdate='.$this->input->get('startdate').'&enddate='.$this->input->get('enddate');  ?>" title="<?php echo $this->Lang['EXP_DL']; ?>"><?php echo $this->Lang['EXP_ALL']; ?></a>

		<?php } }?>
		<table class="list_table1 fl clr">
		<label class="fl"> <b class="search_deal_title"><?php echo $this->Lang["SEARCH_DEALS"]; ?> :</b></label>
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
                <div class="list_table1 fl clr date_range_part">
                    <div class="date_range_lft">
                        <label><?php echo $this->Lang["CITY_NAME"]; ?> :</label>
                        <span><select name ="city" autofocus >
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
                <div class="date_range_right">
                        <label><?php echo $this->Lang["NAME"]; ?> :</label>        
                        <span><input type = "text" name = "name" <?php if(isset($s->name)){?> value="<?php echo $s->name; ?>"<?php } ?>/></span>
                </div>
                </div>
                <div class="date_range_part" >    
                    <div class="date_range_lft">
                    <label></label>        
                    <span></span>
                    </div>
                    <div class="date_range_right">
                      <label>&nbsp;</label>        
                      <span><?php echo $this->Lang['DEALS_NAME']; ?>, <?php echo $this->Lang['STORE_NAME']; ?></span>
                    </div> 
               </div>
                <div class="date_range_bottm" >    
                    <div class="date_range_submit">
                    <input type="submit" value="<?php echo $this->Lang['SEARCH']; ?>"/>
                    </div>
                </div>
               </div> 
     
        </form>
        <?php if(count($this->all_deal_list) > 0){ ?>
        <div class="table_over_flow">
        <table class="list_table fl clr mt20">
        	<tr>
			<th align="left" width="5"><?php echo $this->Lang['S_NO']; ?></th>
			<th align="left" width="20%"><div class="arrow"><a href="<?php echo $this->sort_url;?>param=name&sort=<?php if($this->input->get('sort')=='DESC'){ echo 'ASC'; }else{ echo 'DESC'; } ?>" title="<?php echo $this->Lang['SORT_DEALS']; ?>" ><?php echo $this->Lang["DEALS_NAME"]; ?></a></div></th>
			<th align="left" width="12%"><div class="arrow1"><a href="<?php echo $this->sort_url;?>param=city&sort=<?php if($this->input->get('sort')=='DESC'){ echo 'ASC'; }else{ echo 'DESC'; } ?>" title="<?php echo $this->Lang['SORT_BY_CITY']; ?>" ><?php echo $this->Lang["CITY"]; ?></a></div></th>			
			<th align="left" width="12%"><div class="arrow2"><a href="<?php echo $this->sort_url;?>param=store&sort=<?php if($this->input->get('sort')=='DESC'){ echo 'ASC'; }else{ echo 'DESC'; } ?>" title="<?php echo $this->Lang['SORT_BY_STORE']; ?>" ><?php echo $this->Lang["STORE_NAME"]; ?></a></div></th>
			<th align="left" width="12%"><div class="arrow3"><a href="<?php echo $this->sort_url;?>param=price&sort=<?php if($this->input->get('sort')=='DESC'){ echo 'ASC'; }else{ echo 'DESC'; } ?>" title="<?php echo $this->Lang['SORT_BY_PRICE']; ?>" ><?php echo $this->Lang["PRICE"]; ?><?php echo '('.CURRENCY_SYMBOL.')';?></a></div></th>
			<th align="left" width="15%"><div class="arrow4"><a href="<?php echo $this->sort_url;?>param=value&sort=<?php if($this->input->get('sort')=='DESC'){ echo 'ASC'; }else{ echo 'DESC'; } ?>" title="<?php echo $this->Lang['SORT_B_DEA_VAL']; ?>" ><?php echo $this->Lang["DEALVALUE"]; ?><?php echo '('.CURRENCY_SYMBOL.')';?></a></div></th>
			<th align="left" width="15%"><div class="arrow5"><a href="<?php echo $this->sort_url;?>param=savings&sort=<?php if($this->input->get('sort')=='DESC'){ echo 'ASC'; }else{ echo 'DESC'; } ?>" title="<?php echo $this->Lang['SORT_B_DAE_SAVIN']; ?>" ><?php echo $this->Lang["SAVINGS"]; ?><?php echo '('.CURRENCY_SYMBOL.')';?></a></div></th>
			<th align="left" width="15%"><?php echo $this->Lang["DEAL_IMG"]; ?></th>
			<th align="left" width="15%"><?php echo $this->Lang["CREATED_DATE"]; ?></th>
			<?php  if(($this->uri->last_segment() == 'manage-deals.html')||($this->uri->segment(2) == 'manage-deals.html')){ ?> <th align="left" ><?php echo $this->Lang['SEND_MAIL']; ?></th> 
			<th align="left" width="5%"><?php echo $this->Lang["EDIT"]; ?></th> 
			<?php } ?>
			<th align="left" width="5%"><?php echo $this->Lang['PREVIEW']; ?></th>
			<?php /* if(($this->uri->last_segment() == 'manage-deals.html')||($this->uri->segment(2) == 'manage-deals.html')){ ?> 
			<th align="left" width="5%"><?php echo $this->Lang["B_UNB"]; ?></th>
			<?php } */ ?>
			<th align="left" width="10%"><?php echo $this->Lang["DEAL_DET"]; ?></th>
               </tr>
            
                <?php $i=0; 
			$first_item = $this->pagination->current_first_item;
			foreach($this->all_deal_list as $u){?>
                <tr>    
                     <td align="left"><?php echo $i + $first_item ; ?></td>
                     <td align="left"><?php echo htmlspecialchars($u->deal_title); ?></td>
                     <td align="left"><?php echo htmlspecialchars($u->city_name); ?></td>
                     <td align="left"><?php echo htmlspecialchars($u->store_name); ?></td>
		     <td align="left"><?php echo $u->deal_price; ?></td>
		     <td align="left"><?php echo $u->deal_value; ?></td>
         	     <td align="left"><?php echo $u->deal_savings; ?></td>
         	      <?php  if(file_exists(DOCROOT.'images/deals/1000_800/'.$u->deal_key.'_1'.'.png'))       
	             { ?>
                    <td align="left"><img border="0" src= "<?php echo PATH.'resize.php';?>?src=<?php echo PATH.'images/deals/1000_800/'.$u->deal_key.'_1'.'.png';?>&w=80&h=80" alt="" /></td>
                     <?php } else { ?>
                    <td><img border="0" src= "<?php echo PATH.'resize.php';?>?src=<?php echo PATH.'/images/no-images.png';?>&w=80&h=80" alt=""/></td>
                        <?php } ?>
                        <td align="left"><?php echo date('d-M-Y h:i:s A',$u->createddate); ?></td>
                        <?php  if(($this->uri->last_segment() == 'manage-deals.html')||($this->uri->segment(2) == 'manage-deals.html')){ ?>
                 <?php if((($this->uri->last_segment() == 'manage-deals.html')||($this->uri->segment(2) == 'manage-deals.html')) && ($u->deal_status==1)){ ?>
                 
                 <td>
					<a title="Email to register users" href="<?php echo PATH.'merchant/send-deal-mail/'.$u->deal_id.'/'.$u->deal_key.'.html';?>"><img src="<?php echo PATH;?>images/mail.png"></a></td> <?php } else echo "<td>---</td>"; ?>
		
                  <td align="left">
                    <a href="<?php echo PATH.'merchant/edit-deal/'.base64_encode($u->deal_id).'/'.$u->deal_key.'.html';?>" class="editicon" title="<?php echo $this->Lang['EDIT_DEAL']; ?>"></a>
                    </td>
                    <?php } ?>
					<td align="left">
                    <a href="<?php echo PATH.$u->store_url_title.'/deals/'.$u->deal_key.'/'.$u->url_title.'/merchant-preview.html';?>" class="previewicon" title="<?php echo $this->Lang['PREVIEW']; ?>" target="_blank"></a>
                    </td>
                    <?php /* if(($this->uri->last_segment() == 'manage-deals.html')||($this->uri->segment(2) == 'manage-deals.html')){ ?> 
                    <td align="left">
                    <?php if($u->deal_status == 1){?>
                    <a onclick="return blockunblockmdeal('<?php echo $u->deal_id; ?>','<?php echo $u->deal_key; ?>','block');" class="blockicon" title="<?php echo $this->Lang['BLOCK']; ?>"></a>
                    <?php } else{  ?>
                    <a onclick="return blockunblockmdeal('<?php echo $u->deal_id; ?>','<?php echo $u->deal_key; ?>', 'unblock');" class="unblockicon" title="<?php echo $this->Lang['UNBLOCK']; ?>"></a>
                    <?php } ?>
                    </td>
                  <?php } */ ?>
                    <td align="left"><a href="<?php echo PATH.'merchant/view-deal/'.$u->deal_key.'/'.$u->deal_id.'.html';?>"><?php echo $this->Lang["VIEW_DET"]; ?></a></td>
                </tr>
            <?php $i++;} ?>   
        </table> 
		</div>
        <p><?php echo $this->pagination; ?></p>
       <?php } else{ ?>
       	<p class="nodata"><?php echo $this->Lang["NO_DEALS"]; ?></p>

       <?php } ?>
        
    </div>
    <div class="content_bottom"><div class="bot_left"></div><div class="bot_center"></div><div class="bot_rgt"></div></div>
</div>
