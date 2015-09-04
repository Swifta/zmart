<?php defined('SYSPATH') OR die('No direct access allowed.'); ?>
  <?php $this->session->set("lasturl",substr($_SERVER['REQUEST_URI'], REQUEST_URL_COUNT));  ?>
<div class="bread_crumb"><a href="<?php echo PATH.'merchant.html'; ?>" title="<?php echo $this->Lang['HOME']; ?>"><?php echo $this->Lang["HOME"]; ?> <span class="fwn">&#155;&#155;</span></a><p><?php echo $this->template->title; ?></p></div>
<div class="cont_container mt15 mt10">
    <div class="content_top"><div class="top_left"></div><div class="top_center"></div><div class="top_rgt"></div></div>
    <div class="content_middle">
		<?php $tot_amt_success = "0";
			$tot_amt_fail = "0";
			$tot_amt_reje = "0"; 
			$tot_amt_pending = "0"; ?>
        <?php if(count($this->fund_list)>0){?>
        <div class="table_over_flow">
        <table class="list_table fl clr mt15">
        	<tr>
        	<th align="left" ><?php echo $this->Lang['S_NO']; ?></th>
            	<th align="left" ><?php echo $this->Lang['AMOUNT']." "."(".CURRENCY_SYMBOL.")"; ?></th>
            	<th align="left" ><?php echo $this->Lang['REQ_ON']; ?></th>
            	<th align="left" ><?php echo $this->Lang['STATUS']; ?></th>
            	<th align="left" ><?php echo $this->Lang['EDIT']." / ".$this->Lang['DELETE']; ?></th>
                </tr>
                    <?php $i=0; $first_item = $this->pagination->current_first_item;
                foreach($this->fund_list as $u){?>
                <tr>    
                        <td align="left"><?php echo $i+$first_item; ?></td>
                        <td align="left" ><?php echo $u->amount; ?></td>
                        
                        <td align="left"><?php echo date('d-M-Y H:m:s', $u->date_time); ?></td> 
                        <td align="left" > <?php if($u->request_status==1) { ?> <font color="Darkorange "> <?php echo $this->Lang['PENDING']; ?> </font> <?php $tot_amt_pending+=$u->amount; } ?>
                        
                        <?php if($u->request_status==3) { ?> <font color="blue"><?php echo $this->Lang['REJECTED']; ?></font> <?php $tot_amt_reje+=$u->amount; } ?>
                        
                        <?php if($u->payment_status==1) { ?> <font color="green"><?php echo $this->Lang['SUCCESS']; ?> </font><?php $tot_amt_success+=$u->amount; } ?>
                        
                        <?php if($u->payment_status==2) { ?><font color="red"> <?php echo $this->Lang['FAILURE']; ?> </font><?php $tot_amt_fail+=$u->amount; } ?>
                                              
                        </td>   
                        
                    <td>
                     <?php if(($u->request_status==1)&&($u->payment_status==0)){ ?>
                     <a href="<?php echo PATH.'merchant/edit-fund-request/'.base64_encode($u->request_id).'/'.base64_encode($u->amount).'.html';?>" class="editicon" title="<?php echo $this->Lang['EDIT_FUND']; ?>" ></a>
                    
                    <a onclick="return deletefund('<?php echo $u->request_id; ?>','<?php echo $u->amount; ?>');" class="deleteicon" title="<?php echo $this->Lang['DEL_FUND']; ?>" ></a>
                    <?php  }  else {  echo "---"; }?>
                    </td>
                                  
            <?php $i++;} ?>   
           
        </table>
        </div>
    <?php } else{?><p class="nodata"><?php echo $this->Lang["NO_DATA"]; ?></p><?php }?>
<div class="table_over_flow">
	<table class="list_table fl clr mt20">            
           <th align="left" >
           <fieldset>  
    		<legend><?php echo $this->Lang['REQUE_DETAI']; ?></legend>  
         <div class="value_total_in">
           
           <div class="value_amount"><p align="left"><?php echo $this->Lang["PEN_REQ"]; ?> </p><b>:</b><span align="center"> <?php echo CURRENCY_SYMBOL.$tot_amt_pending; ?> </span></div>
	 <div class="value_amount"><p align="left"><?php echo $this->Lang["SUCC_REQ"]; ?> </p><b>:</b><span align="center"> <?php echo CURRENCY_SYMBOL.$tot_amt_success; ?> </span></div>
	 <div class="value_amount"><p align="left"><?php echo $this->Lang["REG_REQ"]; ?> </p><b>:</b><span align="center"> <?php echo CURRENCY_SYMBOL.$tot_amt_reje; ?> </span></div>
	<div class="value_amount"><p align="left"><?php echo $this->Lang["FAIL_REQ"]; ?> </p><b>:</b><span align="center"> <?php echo CURRENCY_SYMBOL.$tot_amt_fail; ?> </span></div>
           </th>       
             
            </div> 
           </fieldset>
            </table> 
</div>

</div>

  
    <div class="content_bottom"><div class="bot_left"></div><div class="bot_center"></div><div class="bot_rgt"></div></div>
</div>	  <?php echo $this->pagination; ?>
