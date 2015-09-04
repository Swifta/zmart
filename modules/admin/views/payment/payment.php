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
 <?php $this->session->set("lasturl",substr($_SERVER['REQUEST_URI'], REQUEST_URL_COUNT));  ?>
<div class="bread_crumb">
	<a href="<?php echo PATH.'admin.html'; ?>" title="<?php echo $this->Lang["HOME"]; ?>"><?php echo $this->Lang["HOME"]; ?> <span class="fwn">&#155;&#155;</span></a>
		<?php if(isset($s->title)){?>
		<a href="<?php echo PATH.$this->url; ?>" title="<?php echo $this->template->title; ?>">&nbsp;<?php echo $this->template->title; ?>&nbsp;<span class="fwn">&#155;&#155;</span>
		<?php } else{ ?>
	<p><?php echo $this->template->title; ?></p>
<?php } ?>
<p class="acc_bal">
		<?php echo $this->Lang['ACC_BAL']; ?> :
			<span class="blink"><?php echo " ".CURRENCY_SYMBOL." ".$this->balance; ?>
			</span>
	</p>
</div>
<div class="cont_container mt15 mt10">
    <div class="content_top"><div class="top_left"></div><div class="top_center"></div><div class="top_rgt"></div></div>
    <div class="content_middle">
	<form method="get" class="admin_form" action="">
        <?php if(count($this->fund_request_list)>0){
                $parm="";
        if(isset($_GET['param'])){
                $parm='&param='.$_GET['param'].'&sort='.$_GET['sort'];
        } ?>

        <?php if($this->pagination !=""){ ?>
                <a class="fr frm_export" href="<?php echo PATH.$this->base.'?id='.$this->Lang['SEARCH'].'&name='.$this->input->get('name').$parm.'&today='.$this->input->get('today').'&startdate='.$this->input->get('startdate').'&enddate='.$this->input->get('enddate');  ?>" title="<?php echo $this->Lang['EXP_DL']; ?>"><?php echo $this->Lang['EXP_PAGE']; ?></a>
        <?php } ?>
                <a class="fr frm_export" href="<?php echo $this->sort_url.'id='.$this->Lang['ALL2'].'&name='.$this->input->get('name').$parm.'&today='.$this->input->get('today').'&startdate='.$this->input->get('startdate').'&enddate='.$this->input->get('enddate');  ?>" title="<?php echo $this->Lang['EXP_DL']; ?>"><?php echo $this->Lang['EXP_ALL']; ?></a>
        <?php }  ?>
        	 
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
		           
	            }?>
                 <div class="list_table1 fl clr date_range_part">
                  <div class="date_range_lft">
                      <label><?php echo $this->Lang["NAME"]; ?>:</label>        
                      <span><input autofocus type = "text" name = "name" <?php if(isset($this->search_key)){?> value="<?php echo $this->search_key; ?>"<?php } ?>/></span>
                  </div>
                     <div class="date_range_right">
                       <label><?php echo $this->Lang["FUND_TYPE"]; ?> :</label>   
                       <span><select  onchange="window.open(this.options[this.selectedIndex].value,'_top')">
		        
		         <option value="<?php echo PATH.'admin/all-fund-request.html';?>" <?php if($this->uri->last_segment() == "all-fund-request.html"){  ?>  selected="selected" <?php }  ?>><?php echo $this->Lang["WITH_DRAW_ALL"]; ?></option>
		         
		        <option value="<?php echo PATH.'admin/approved-fund-request.html';?>" <?php if(($this->uri->last_segment() == "approved-fund-request.html")||($this->uri->segment(2) == "approved-fund-request")){  ?>  selected="selected" <?php }  ?>><?php echo $this->Lang["WITH_DRAW_APP"]; ?></option>
		        
		        <option value="<?php echo PATH.'admin/reject-fund-request.html';?>" <?php if(($this->uri->last_segment() == "reject-fund-request.html")||($this->uri->segment(2) == "reject-fund-request")){  ?>  selected="selected" <?php }  ?>><?php echo $this->Lang["WITH_DRAW_REG"]; ?></option>
		        
		        <option value="<?php echo PATH.'admin/success-fund-request.html';?>" <?php if(($this->uri->last_segment() == "success-fund-request.html")||($this->uri->segment(2) == "success-fund-request")){  ?>  selected="selected" <?php }  ?>><?php echo $this->Lang["WITH_DRAW_SUCC"]; ?></option>
		        
		         <option value="<?php echo PATH.'admin/failed-fund-request.html';?>" <?php if(($this->uri->last_segment() == "failed-fund-request.html")||($this->uri->segment(2) == "failed-fund-request")){  ?>  selected="selected" <?php }  ?>><?php echo $this->Lang["WITH_DRAW_FAIL"]; ?></option> 
		        </select></span>
                     </div>
                 </div>
            <div class="list_table1 fl clr date_range_part">
                            <div class="date_range_right">
                                <label>&nbsp;</label>        
                                <span>(<?php echo $this->Lang['USER_NAME']; ?>, <?php echo $this->Lang['EMAIL']; ?>)</span>
                            </div>                    
                    </div>
           
                <div class="date_range_bottm" >    
                                <div class="date_range_submit">
                                <input type="submit" value="<?php echo $this->Lang['SEARCH']; ?>"/>
                                </div>
                     </div> 
        </div>
        </form>
		<?php $tot_amt_success = "0";
			$tot_amt_fail = "0";
			$tot_amt_reje = "0"; 
			$tot_amt_pending = "0"; ?>
        <?php if(count($this->fund_request_list) > 0){ ?>
        <div class="table_over_flow">
        <table class="list_table fl clr mt20">
        	<tr>
			<th align="left" width="2%"><span class="align3"><?php echo $this->Lang["S_NO"]; ?></span></th>
			<th align="left" width="12%"><?php echo $this->Lang["MERCHANT_NAME"]; ?></th>
			<th align="left" width="12%"><span class="align1"><?php echo $this->Lang["EMAIL"] ; ?></span></th>
			<th align="left" width="6%"><?php echo $this->Lang["REQUEST_AMOUNT"]; ?><?php echo '('.CURRENCY_SYMBOL.')';?></th>			
			<th align="left" width="14%"><span class="align3"><?php echo $this->Lang["DATE"]; ?></span></th>
			<?php if($this->more_action == 'require') { ?>
			<th align="left" width="8%"><?php echo $this->Lang["STATUS"]; ?></th> 
			<?php } ?>
			
			<?php if($this->more_action == 'message') { ?>
			<th align="left" width="8%"><?php echo $this->Lang["STATUS"]; ?></th> 
			<?php } ?>

                </tr>
            
                <?php $i = 0;  $first_item = $this->pagination->current_first_item;
		
			foreach($this->fund_request_list as $u){?>

                <tr>    
         	    <td align="left"><span class="align4"><?php echo $i+$first_item; ?></span></td>	
		    <td align="left"><?php echo $u->firstname; ?></td>
		    <td align="left"><?php echo $u->email; ?></td>
		    <td ><span class="align"><?php echo $u->amount; ?></span></td>		
                    <td align="left"><?php echo date('d-M-Y h:i:s A',$u->date_time); ?></td>
                    
                    
                    <?php  if($this->more_action == 'require') { ?>
 		   <td align="left"  >
			<?php if($this->user_type==1){?>   
		    <?php if($u->request_status == 1){?>
                   <select  style="height:29px;" onchange="return updatefundrequest_status('<?php echo $u->request_id; ?>','<?php echo $u->user_id; ?>',this.value)">
                        <option value=""><?php echo $this->Lang['PENDING']; ?></option>
                        <option  value="2"><?php echo $this->Lang['APPROVED']; ?></option>
	                <option value="3" ><?php echo $this->Lang['REJECTED']; ?></option>
                   </select>
                 <?php 
			$tot_amt_pending+=$u->amount;
		} elseif($u->payment_status == 1){
                   echo '<span class="clor">'. $this->Lang['SUCCESS'].'</span>'; $tot_amt_success+=$u->amount; }

                  elseif($u->payment_status == 2){
                   	echo '<span class="clor2">'.$this->Lang['FAILURE'].'</span>'; $tot_amt_fail+=$u->amount;
		   } 
		
		 elseif($u->request_status == 3){  ?>
			<span class="clor3"><?php echo $this->Lang['REJECTED']; ?></span>  <?php $tot_amt_reje+=$u->amount;
		 }?> <?php }else{echo "--";} ?>
                </td>
               
                <?php } ?>

                <?php  if($this->more_action == 'message') { ?>
 		   <td align="left"  >
			   <?php if($this->user_type==1){?>
		    <?php if($u->payment_status == 2){?>
                   <select style="height:29px;"  onchange="return updatefundrequest_status('<?php echo $u->request_id; ?>','<?php echo $u->user_id; ?>',this.value)">
                        <option value=""><?php echo $this->Lang['FAILURE']; ?></option>
                        <option  value="2"><?php echo $this->Lang['APPROVED']; ?></option>
                         <option value="3" ><?php echo $this->Lang['REJECTED']; ?></option>
	                <option value="4" ><?php echo $this->Lang['REASON']; ?></option>
                   </select>
                   
                   <?php } elseif($u->payment_status == 1){
                   echo '<span class="clor">'. $this->Lang['SUCCESS'] .'</span>';} ?>
                   <?php } else{echo "--";}?>
                 
                </td>
                <?php  }  ?>
                </tr>
	
            <?php  $i++;} ?> 
        </table> 
        </div>
	<?php if(($this->uri->last_segment() == "all-fund-request.html")||($this->uri->segment(2) == "all-fund-request")){  ?>
        <div class="table_over_flow">
	<table class="list_table fl clr mt20">            
           <th align="left" >
           <fieldset>  
    		<legend><?php echo $this->Lang['FUND_REQ_DET']; ?></legend>  
         <div class="value_total_in">
           
     <div class="value_amount"><p align="left"><?php echo $this->Lang["PEN_REQ"]; ?> </p><b>:</b><span align="center"> <?php echo CURRENCY_SYMBOL.$tot_amt_pending; ?> </span></div>
	 <div class="value_amount"><p align="left"><?php echo $this->Lang["SUCC_REQ"]; ?> </p><b>:</b><span align="center"> <?php echo CURRENCY_SYMBOL.$tot_amt_success; ?> </span></div>
	 <div class="value_amount"><p align="left"><?php echo $this->Lang["REG_REQ"]; ?> </p><b>:</b><span align="center"> <?php echo CURRENCY_SYMBOL.$tot_amt_reje; ?> </span></div>
	<div class="value_amount"><p align="left"><?php echo  $this->Lang["FAIL_REQ"]; ?> </p><b>:</b><span align="center"> <?php echo CURRENCY_SYMBOL.$tot_amt_fail; ?> </span></div>
           </th>       
             
            </div> 
           </fieldset>
            </table> 
        </div>
<?php } ?>	
  <?php } else {?><p class="nodata"><?php echo $this->Lang["NO_DATA"]; ?></p><?php }?>
	
     </div>

    <div class="content_bottom"><div class="bot_left"></div><div class="bot_center"></div><div class="bot_rgt"></div></div>
</div>
 <span class="pagination"> <?php echo $this->pagination; ?> </span>
