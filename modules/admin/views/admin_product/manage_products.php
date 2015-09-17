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
<div class="bread_crumb"><a href="<?php echo PATH."admin.html"; ?>" title="<?php echo $this->Lang['HOME']; ?>"><?php echo $this->Lang["HOME"]; ?> <span class="fwn">&#155;&#155;</span></a>
<?php if(isset($s->title)){?>
<a href="<?php echo PATH.$this->url; ?>" title="<?php echo $this->template->title; ?>">&nbsp;<?php echo $this->template->title; ?>&nbsp;<span class="fwn">&#155;&#155;</span></a><p><?php echo $this->Lang["SEARCH"]; ?></p>
<?php } else { ?>
<p><?php echo $this->template->title; ?></p>
<?php } ?></div>

<?php $this->session->set("lasturl",substr($_SERVER['REQUEST_URI'], REQUEST_URL_COUNT));  ?>

<div class="cont_container mt15 mt10">
<div class="content_top"><div class="top_left"></div><div class="top_center"></div><div class="top_rgt"></div></div>
<div class="content_middle">
<form method="get" class="admin_form" action="">
		<?php  if(($this->uri->last_segment() == 'manage-products.html') || ($this->uri->last_segment() == 'sold-products.html') || ($this->uri->segment(3))){
			
		 if(count($this->all_product_list) > 0){ ?>
		  <?php if($this->pagination !=""){ ?>
				<a class="fr frm_export" href="<?php echo PATH.$this->url.'/page/'.$this->page.'?id='.$this->Lang['SEARCH'].'&name='.$this->input->get('name').'&city='.$this->input->get('city').'&today='.$this->input->get('today').'&startdate='.$this->input->get('startdate').'&enddate='.$this->input->get('enddate');  ?>" title="<?php echo $this->Lang['EXP_DL']; ?>"><?php echo $this->Lang['EXP_PAGE']; ?></a>
			<?php } ?>
			
		<a class="fr frm_export" href="<?php echo PATH.$this->url.'?id='.$this->Lang['ALL2'].'&name='.$this->input->get('name').'&city='.$this->input->get('city').'&today='.$this->input->get('today').'&startdate='.$this->input->get('startdate').'&enddate='.$this->input->get('enddate');  ?>" title="<?php echo $this->Lang['EXP_DL']; ?>"><?php echo $this->Lang['EXP_ALL']; ?></a>

		<?php } } ?>
		
        <table class="list_table1 fl clr filter_part">
        <label> <b class="search_deal_title"><?php echo $this->Lang["SEARCH_PRODUCTS"]; ?> :</b></label>
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
                    <?php if(isset($this->search_key)){  $s = $this->search_key; }?>
                    
                    <div class="list_table1 fl clr date_range_part" id="date_display">
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
            <div class="date_range_right">
               <label><?php echo $this->Lang["NAME"]; ?>:</label>        
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
              <span><?php echo $this->Lang['PRODUCT_NAME']; ?>, <?php echo $this->Lang['STORE_NAME']; ?></span>
            </div> 
               </div>  
                <div class="date_range_lft">
					<label><?php echo $this->Lang["PRD_TYP"]; ?>:</label>
					<select name="product_duration">
						<option value="1"  <?php if(isset($s->product_duration) && $s->product_duration==1){ ?> selected <?php } ?> ><?php echo $this->Lang["ALL_PRODUCT"]; ?></option>
						<option value="2" <?php if(isset($s->product_duration) && $s->product_duration==2){ ?> selected <?php } ?> ><?php echo $this->Lang["NOR_PRD"]; ?></option>
						<option value="3" <?php if(isset($s->product_duration)&& $s->product_duration==3){ ?> selected <?php } ?>><?php echo $this->Lang["STR_CRD_PRD"]; ?></option>
					</select>
                </div>
            <div class="date_range_bottm" >    
                <div class="date_range_submit">
                <input type="submit" value="<?php echo $this->Lang['SEARCH']; ?>"/>
                </div>
            </div> 
               </div>         
        </form>
        
        <?php if(count($this->all_product_list) > 0){ ?>
    <div class="table_over_flow">
        <table class="list_table fl clr mt20">
        	<tr>
			<th align="left" width="5"><?php echo $this->Lang['S_NO']; ?></th>
                        <th align="left" width="20%"><div class="arrow"><a href="<?php echo $this->sort_url;?>param=name&sort=<?php if($this->input->get('sort')=='DESC'){ echo 'ASC'; }else{ echo 'DESC'; } ?>" title="Sort By Products Name" ><?php echo $this->Lang["PRODUCT_NAME"]; ?></a></div></th>
			<th align="left" width="12%"><div class="arrow1"><a href="<?php echo $this->sort_url;?>param=city&sort=<?php if($this->input->get('sort')=='DESC'){ echo 'ASC'; }else{ echo 'DESC'; } ?>" title="Sort By City" ><?php echo $this->Lang["CITY"]; ?></a></div></th>			
			<th align="left" width="12%"><div class="arrow2"><a href="<?php echo $this->sort_url;?>param=store&sort=<?php if($this->input->get('sort')=='DESC'){ echo 'ASC'; }else{ echo 'DESC'; } ?>" title="Sort By Store Name" ><?php echo $this->Lang["STORE_NAME"]; ?></a></div></th>
			<th align="left" width="5%"><div class="arrow3"><a href="<?php echo $this->sort_url;?>param=price&sort=<?php if($this->input->get('sort')=='DESC'){ echo 'ASC'; }else{ echo 'DESC'; } ?>" title="Sort By Price" ><?php echo $this->Lang["PRICE"]; ?><?php echo '('.CURRENCY_SYMBOL.')';?></a></div></th>
			<th align="left" width="5%"><div class="arrow4"><a href="<?php echo $this->sort_url;?>param=value&sort=<?php if($this->input->get('sort')=='DESC'){ echo 'ASC'; }else{ echo 'DESC'; } ?>" title="Sort By Product Value" ><?php echo $this->Lang["DEALVALUE"]; ?><?php echo '('.CURRENCY_SYMBOL.')';?></a></div></th>
			<?php /** <th align="left" width="15%"><div class="arrow5"><a href="<?php echo $this->sort_url;?>param=savings&sort=<?php if($this->input->get('sort')=='DESC'){ echo 'ASC'; }else{ echo 'DESC'; } ?>" title="Sort By Product Savings" ><?php echo $this->Lang["SAVINGS"]; ?><?php echo '('.CURRENCY_SYMBOL.')';?></a></div></th> **/?>
			<th align="left" width="15%"><?php echo $this->Lang["PRODUCT_IMG"]; ?></th>
			<th align="left" width="15%"><?php echo $this->Lang["CREATED_DATE"]; ?></th>
			<?php if(($this->uri->last_segment() == 'manage-products.html')||($this->uri->segment(2) == 'manage-products.html')){ ?> 
			 <th align="left" ><?php echo $this->Lang['SEND_MAIL']; ?></th>
			<?php }?>
			<?php if(($this->uri->last_segment() == 'manage-products.html')||($this->uri->segment(2) == 'manage-products.html')){ ?> 
			<?php if(ADMIN_PRIVILEGES_PRODUCTS_EDIT || ADMIN_PRIVILEGES_PRODUCTS_BLOCK){?>
			<th align="left" width="5%"><?php echo $this->Lang["ACTION"]; ?></th>
			<?php }?>
			
			<th align="left" width="5%"><?php echo $this->Lang['HOT_PRO']; ?></th>
			<?php } ?>
			
			<th align="left" width="5%"><?php echo $this->Lang['PREVIEW']; ?></th>
			<th align="left" width="10%"><?php echo $this->Lang["PRD_TYP"]; ?></th>
			
			<th align="left" width="10%"><?php echo $this->Lang["PRODUCT_DET"]; ?></th>
                 </tr>
            
                <?php $i=0; 
			$first_item = $this->pagination->current_first_item;
			foreach($this->all_product_list as $u){ ?>
                <tr>    
					<td align="left"><?php echo $i + $first_item ; ?></td>
					<td align="left"><?php echo htmlspecialchars($u->deal_title); ?></td>
					<td align="left"><?php echo htmlspecialchars($u->city_name); ?></td>
					<td align="left"><?php echo htmlspecialchars($u->store_name); ?></td>
					<?php if($u->deal_price!=0){ ?>
					<td align="left"><?php echo $u->deal_price; ?></td>
					<?php } else { ?>
					<td><?php echo $u->deal_value; ?></td>
					<?php } ?>
					<td align="left"><?php if($u->deal_price!=0){ echo $u->deal_value; } else { echo "-"; }?></td>
					<?php /**<td align="left"><?php echo $u->deal_savings; ?></td> **/?>
					
         	    <?php  if(file_exists(DOCROOT.'images/products/1000_800/'.$u->deal_key.'_1'.'.png'))       
	             { ?>
                    <td align="left">
<img border="0" src= "<?php echo PATH.'resize.php';?>?src=<?php echo PATH.'images/products/1000_800/'.$u->deal_key.'_1'.'.png';?>&w=80&h=80" alt="" />
<?php /* <img border="0" src= "<?php echo PATH.'images/products/290_215/'.$u->deal_key.'_1'.'.png';?>" alt="" width="80" />*/ ?></td>
                     <?php } else { ?>
                     <td><img border="0" src= "<?php echo PATH.'resize.php';?>?src=<?php echo PATH.'/images/no-images.png';?>&w=80&h=80" alt=""/></td>
                        <?php } ?>
                        <td align="left"><?php echo date('d-M-Y h:i:s A',$u->createddate); ?></td>
                <?php if(($this->uri->last_segment() == 'manage-products.html')||($this->uri->segment(2) == 'manage-products.html')){ ?>
			        <?php  if(($this->uri->last_segment() == 'manage-products.html') && $u->deal_status == 1) { ?><td>
		        <a title="Email to register users" href="<?php echo PATH.'admin/send-product/'.$u->deal_id.'/'.$u->deal_key.'.html';?>"><img src="<?php echo PATH;?>images/mail.png"></a></td> <?php } else{ echo "<td>---</td>"; }?>
		        <?php } ?>
                    <?php if(($this->uri->last_segment() == 'manage-products.html')||($this->uri->segment(2) == 'manage-products.html')){ ?> 
                    <?php if(ADMIN_PRIVILEGES_PRODUCTS_BLOCK || ADMIN_PRIVILEGES_PRODUCTS_EDIT){?>
                    <td align="left">
						<?php if(ADMIN_PRIVILEGES_PRODUCTS_EDIT){?>
                    <a href="<?php echo PATH.'admin/edit-products/'.base64_encode($u->deal_id).'/'.$u->deal_key.'/'.base64_encode('edit').'.html';?>" class="editicon" title="<?php echo $this->Lang['EDIT_PRODUCT']; ?>"></a>
                    <?php }?>
                    <?php if(ADMIN_PRIVILEGES_PRODUCTS_BLOCK){?>
                    <?php if($u->deal_status == 1 && $u->store_status==1){?>
                    <a onclick="return blockunblockproduct('<?php echo $u->deal_id; ?>','<?php echo $u->deal_key; ?>','block');" class="blockicon" title="<?php echo $this->Lang['BLOCK']; ?>"></a>
                    <?php }  elseif($u->deal_status ==1 && $u->store_status ==0) {  ?>
                    <a onclick="return blockunblockproduct('<?php echo $u->deal_id; ?>','<?php echo $u->deal_key; ?>', 'unblock');" class="unblockicon" title="<?php echo $this->Lang['UNBLOCK']; ?>"></a>
                    <?php }  else{  ?>
                    <a onclick="return blockunblockproduct('<?php echo $u->deal_id; ?>','<?php echo $u->deal_key; ?>', 'unblock');" class="unblockicon" title="<?php echo $this->Lang['UNBLOCK']; ?>"></a>
                    <?php } ?>
                    <?php }?>
                    </td>
                    <?php }?>
    		<td align="left" id="popu_<?php echo $u->deal_id; ?></td>">
    		<?php if($this->user_type==1 && $this->user_type==2){?>
    		<input type="checkbox" <?php if($u->deal_feature == 1) { ?> checked <?php } ?> id="popular<?php echo $u->deal_id; ?>" value="<?php echo $u->deal_id; ?>" onclick="popular_product(this.value,this)" />
    		<?php }else{echo "--";} ?>
    		</td>

                  
                  <?php } ?>
                  
                  <td align="left">
                    <a href="<?php echo PATH.$u->store_url_title.'/product/'.$u->deal_key.'/'.$u->url_title.'/admin-manage-preview.html';?>" class="previewicon" title="<?php echo 'Preview'; ?>" target="_blank"></a>
                    </td>
                    <td><?php if($u->product_duration !="") { ?>
						<span style="color:#008000;"><?php echo $this->Lang["STR_CRD_PRD"]; ?></span>
						<?php } else { ?> 
						<span style="color:#0000FF;" ><?php echo $this->Lang["NOR_PRD"]; ?></span> 
						<?php } ?></td>
                    <td align="left"><a href="<?php echo PATH.'admin/view-products/'.$u->deal_key.'/'.$u->deal_id.'.html';?>"><?php echo $this->Lang["VIEW_DET"]; ?></a></td>
                </tr>
            <?php $i++;} ?>   
        </table>
    </div>
        <p><?php echo $this->pagination; ?></p>
       <?php } else{ ?>
       	<p class="nodata"><?php echo $this->Lang["NO_PRODUCTS"]; ?></p>
       <?php } ?>
        
    </div>
    <div class="content_bottom"><div class="bot_left"></div><div class="bot_center"></div><div class="bot_rgt"></div></div>
</div>
