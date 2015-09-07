<?php defined('SYSPATH') OR die('No direct access allowed.'); ?>
<div class="bread_crumb"><a href="<?php echo PATH.'admin.html'; ?>" title="<?php echo $this->Lang['HOME']; ?>"><?php echo $this->Lang["HOME"]; ?> <span class="fwn">&#155;&#155;</span></a><p><?php echo $this->template->title; ?></p></div>
<div class="cont_container mt15 mt10">
    <div class="content_top"><div class="top_left"></div><div class="top_center"></div><div class="top_rgt"></div></div>
    <div class="content_middle">
        <form method="get" class="admin_form" action="<?php echo PATH.'admin/manage-referral-users.html';?>">
           
	<?php if(($this->uri->last_segment()=="manage-referral-users.html") || ($this->uri->segment(3)=="page")) { ?>	
	 <?php if(count($this->users_list)>0){?>
		<?php if($this->pagination !=""){ // export per page ?>
			<a class="fr frm_export" href="<?php echo PATH.$this->url.'/page/'.$this->page.'?id='.$this->Lang['SEARCH'].'&name='.$this->input->get('name').'&email='.$this->input->get('email'); ?>" title="<?php echo $this->Lang['EXP_DL']; ?>"><?php echo $this->Lang['EXP_PAGE']; ?></a>
			<?php } ?>
			
		<a class="fr frm_export" href="<?php echo PATH.$this->url.'?id='.$this->Lang['ALL2'].'&name='.$this->input->get('name').'&email='.$this->input->get('email');  ?>" title="<?php echo $this->Lang['EXP_DL']; ?>"><?php echo $this->Lang['EXP_ALL']; ?></a>

<?php }   }	 ?>	
                <?php 
	            if(isset($this->search_key)){
		            $s = $this->search_key;
	            }?>
            <div class="date_range_common">    
            <div class="list_table1 fl clr date_range_part">
                
                <div class="date_range_lft">
                <label><?php echo $this->Lang["NAME"]; ?> :</label>        
                <span><input autofocus type = "text" name = "name" <?php if(isset($s->name)){?> value="<?php echo $s->name; ?>"<?php } ?>/></span>
            </div>
            <div class="date_range_right">
               <label><?php echo $this->Lang['EMAIL_F']; ?> :</label>        
               <span><input type = "text" name = "email" <?php if(isset($s->email)){?> value="<?php echo $s->email; ?>"<?php } ?>/></span>
            </div>   
            </div>
                <div class="date_range_bottm" >    
                <div class="date_range_submit">
                <input type="submit" value="<?php echo $this->Lang['SEARCH']; ?>"/>                
                </div>
         </div>
            </div>
        </table>
        </form>
    
    <?php if(count($this->users_list)>0){?>
        <div class="table_over_flow">
        <table class="list_table fl clr mt15">
        	<tr>
        	<th align="left" ><?php echo $this->Lang['S_NO']; ?></th>

            	<th align="left" ><?php echo $this->Lang["NAME"]; ?></th>
		<th align="left" ><?php echo $this->Lang['EMAIL_F']; ?></th>

		<th align="left" ><?php echo $this->Lang['REFERED']; ?></th>
		<th align="left" ><?php echo $this->Lang["JOIN_DATE"]; ?></th>
                
            </tr>
            <?php $i=0; $first_item = $this->pagination->current_first_item;

                foreach($this->users_list as $u){?>
                <tr>    
                        <td align="left"><?php echo $i+$first_item; ?></td>
       
                    

                        <td align="left"><a href="<?php echo PATH.'admin/view-user/'.$u->userid;?>.html"><?php echo ucfirst(htmlspecialchars($u->referal_name)); ?></a></td>		
                  
     			 <td align="left"><?php echo $u->ref_email; ?></td>
	

                        <td> <a href="<?php echo PATH.'admin/view-user/'.$u->referreduserid;?>.html"><?php echo ucfirst(htmlspecialchars($u->refered_name)); ?></a>        </td>
	 		<td> <?php echo date('d-M-Y h:m:i a',$u->ref_joined_date);?> </td>  
                    
                </tr>
            <?php $i++;} ?>   
        </table>
        </div>
<?php } else{?><p class="nodata"><?php echo $this->Lang["NO_DATA"]; ?></p><?php }?>
     <?php echo $this->pagination; ?>    </div>
    <div class="content_bottom"><div class="bot_left"></div><div class="bot_center"></div><div class="bot_rgt"></div></div>
 
</div>
