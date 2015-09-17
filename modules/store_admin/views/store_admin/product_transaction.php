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
<div class="bread_crumb"><a href="<?php echo PATH."store-admin.html"; ?>" title="<?php echo $this->Lang['HOME']; ?>"><?php echo $this->Lang["HOME"]; ?> <span class="fwn">&#155;&#155;</span></a>
<?php if(isset($s->title)){?>
<a href="<?php echo PATH.$this->url; ?>" title="<?php echo $this->template->title; ?>">&nbsp;<?php echo $this->template->title; ?>&nbsp;<span class="fwn">&#155;&#155;</span>
<?php } else{ ?>
<p><?php echo $this->template->title; ?></p>
<?php } ?></div>
<div class="cont_container mt15 mt10">
    <div class="content_top"><div class="top_left"></div><div class="top_center"></div><div class="top_rgt"></div></div>
    <div class="content_middle">
	<form method="get" class="admin_form" action=""> 
	
	<?php if(count($this->product_transaction_list)>0){
                $parm="";
                if(isset($_GET['param'])){
                        $parm='&param='.$_GET['param'].'&sort='.$_GET['sort'];
                } ?>

                <?php if($this->pagination !=""){ ?>
                        <a class="fr frm_export" href="<?php echo PATH.$this->base.'?id='.$this->Lang['SEARCH'].'&name='.$this->input->get('name').$parm.'&today='.$this->input->get('today').'&startdate='.$this->input->get('startdate').'&enddate='.$this->input->get('enddate'); ?>" title="<?php echo $this->Lang['EXP_DL']; ?>"><?php echo $this->Lang['EXP_PAGE']; ?></a>
                <?php } ?>			
                        <a class="fr frm_export" href="<?php echo $this->sort_url.'id='.$this->Lang['ALL2'].'&name='.$this->input->get('name').$parm.'&today='.$this->input->get('today').'&startdate='.$this->input->get('startdate').'&enddate='.$this->input->get('enddate'); ?>" title="<?php echo $this->Lang['EXP_DL']; ?>"><?php echo $this->Lang['EXP_ALL']; ?></a>	
                <?php }  ?>	  
	<table class="list_table1 fl clr">
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
                    <label><?php echo $this->Lang["NAME"]; ?> :</label>        
                    <span><input type = "text" name = "name" <?php if(isset($this->search_key)){?> value="<?php echo $this->search_key; ?>"<?php } ?> autofocus /></span>
                 </div>
                   <div class="date_range_right">
                        <label><?php echo $this->Lang['TRANS_TYPE']; ?> :</label> 
                        <span><select onchange="window.open(this.options[this.selectedIndex].value,'_top')">
		        
		        <option value="<?php echo PATH.'store-admin-product/all-transaction.html';?>" <?php if($this->uri->last_segment() == "all-transaction.html"){  ?>  selected="selected" <?php }  ?>><?php echo $this->Lang["ALL_TRAN"]; ?></option>
		           <option value="<?php echo PATH.'merchant-product/success-transaction.html';?>" <?php if(($this->uri->last_segment() == "success-transaction.html")||($this->uri->segment(2)== "success-transaction")){  ?>  selected="selected" <?php }  ?>><?php echo $this->Lang["SUCC_TRAN"]; ?></option>
		        
		        <option value="<?php echo PATH.'store-admin-product/completed-transaction.html';?>" <?php if(($this->uri->last_segment() == "completed-transaction.html")||($this->uri->segment(2)== "completed-transaction")){  ?>  selected="selected" <?php }  ?>><?php echo $this->Lang["COMP_TRAN"]; ?></option>
		        
		        <option value="<?php echo PATH.'store-admin-product/failed-transaction.html';?>" <?php if(($this->uri->last_segment() == "failed-transaction.html")||($this->uri->segment(2)== "failed-transaction")){  ?>  selected="selected" <?php }  ?>><?php echo $this->Lang["FAI_TRAN"]; ?></option>
		        
		        <option value="<?php echo PATH.'store-admin-product/hold-transaction.html';?>" <?php if(($this->uri->last_segment() == "hold-transaction.html")||($this->uri->segment(2)== "hold-transaction")){  ?>  selected="selected" <?php }  ?>><?php echo $this->Lang["HOLD_TRAN"]; ?></option>         
		        </select></span>
                   </div>
                    </div>
            <div class="date_range_part" >
                <div class="date_range_right">
                      <label>&nbsp;</label>        
                      <span><?php echo $this->Lang["SEARCH_TRAN_PRODUCT"]; ?></span>
                    </div>
            </div>
            <div class="date_range_bottm" >    
                    <div class="date_range_submit">
                    <input type="submit" title="<?php echo $this->Lang['SEARCH']; ?>" value="<?php echo $this->Lang['SEARCH']; ?>"/>
                    </div>
                </div>
        </div>
	             
        </form>
	<?php echo new View("store_admin/product_transaction_list"); ?>
    </div>
    <div class="content_bottom"><div class="bot_left"></div><div class="bot_center"></div><div class="bot_rgt"></div></div>
</div>
<span class="pagination"> <?php echo $this->pagination; ?> </span>
