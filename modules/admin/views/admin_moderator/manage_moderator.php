<?php defined('SYSPATH') OR die('No direct access allowed.'); ?>
<div class="bread_crumb"><a href="<?php echo PATH.'admin.html'; ?>" title="<?php echo $this->Lang['HOME']; ?>"><?php echo $this->Lang["HOME"]; ?> <span class="fwn">&#155;&#155;</span></a><p><?php echo $this->template->title; ?></p></div>
<div class="cont_container mt15 mt10">
    <div class="content_top"><div class="top_left"></div><div class="top_center"></div><div class="top_rgt"></div></div>
    <div class="content_middle">
        <form method="get" class="admin_form" action="<?php echo PATH.'admin/manage-moderator.html';?>">
		 
	<?php if(($this->uri->last_segment()=="manage-moderator.html") || ($this->uri->segment(3)=="page")) { ?>	
	 <?php if(count($this->users_list)>0){?>
		<?php /*	<?php if($this->pagination !=""){ ?>
				<a class="fr frm_export" href="<?php echo PATH.$this->url.'/page/'.$this->page.'?id='.$this->Lang['SEARCH'].'&name='.$this->input->get('name').'&email='.$this->input->get('email').'&city='.$this->input->get('city').'&logintype='.$this->input->get('logintype');  ?>" title="<?php echo $this->Lang['EXP_DL']; ?>"><?php echo $this->Lang['EXP_PAGE']; ?></a>
			<?php } ?>
			
		<a class="fr frm_export" href="<?php echo PATH.$this->url.'?id='.$this->Lang['ALL2'].'&name='.$this->input->get('name').'&email='.$this->input->get('email').'&city='.$this->input->get('city').'&logintype='.$this->input->get('logintype');  ?>" title="<?php echo $this->Lang['EXP_DL']; ?>"><?php echo $this->Lang['EXP_ALL']; ?></a> */ ?>
	
<?php }   }	 ?>		
		
            <table class="list_table1 fl clr">
                <?php 
	            if(isset($this->search_key)){
		            $s = $this->search_key;
	            }?>
			
                <tr><td><label><?php echo $this->Lang["NAME"]; ?></label></td>
                <td><label>:</label></td>
                <td><input type = "text" name = "name" <?php if(isset($s->name)){?> value="<?php echo $s->name; ?>"<?php } ?>/></td>
                <td><label><?php echo $this->Lang["EMAIL_F"]; ?></label></td>
                <td><label>:</label></td>
                <td><input type = "text" name = "email" <?php if(isset($s->email)){?> value="<?php echo $s->email; ?>"<?php } ?>/></td>
                <tr>
                <td><label><?php echo $this->Lang["CITY"]; ?></label></td>
                <td><label>:</label></td>
                <td><select name ="city">
                <?php if(isset($s->city)){ foreach($this->city_list as $c){ if($s->city == $c->city_id){ ?>
                <option value="<?php echo $c->city_id; ?>"><?php echo ucfirst($c->city_name); }}}?></option>
                <option value=""><?php echo $this->Lang["SEL_CITY"]; ?></option>
                <?php foreach($this->city_list as $c){ ?>
                <option value="<?php echo $c->city_id; ?>"><?php echo ucfirst($c->city_name); ?></option>  
                <?php }?>
                </select></td>
                
                
                <td></td><td></td>
                <td><input type="submit" value="<?php echo $this->Lang['SEARCH']; ?>" class="fl"/></td>
            </tr>
        </table>
        </form>
    
    <?php if(count($this->users_list)>0){?>
        <div class="table_over_flow">
        <table class="list_table fl clr mt15">
        	<tr>
        	    <th align="left" ><?php echo $this->Lang['S_NO']; ?></th>
            	<th align="left"><div class="arrow"><a href="<?php echo $this->sort_url;?>param=name&sort=<?php if($this->input->get('sort')=='DESC'){ echo 'ASC'; }else{ echo 'DESC'; } ?>" title="<?php echo $this->Lang['SORT_BY_NAME']; ?>" ><?php echo $this->Lang["NAME"]; ?></a></div></th>
            	<th align="left" ><div class="arrow"><a href="<?php echo $this->sort_url;?>param=email&sort=<?php if($this->input->get('sort')=='DESC'){ echo 'ASC'; }else{ echo 'DESC'; } ?>" title="<?php echo $this->Lang['SO_B_E']; ?>" ><?php echo $this->Lang["EMAIL_F"]; ?></a></div></th>
            	<th align="left" ><div class="arrow1"><a href="<?php echo $this->sort_url;?>param=city&sort=<?php if($this->input->get('sort')=='DESC'){ echo 'ASC'; }else{ echo 'DESC'; } ?>" title="<?php echo $this->Lang['SORT_BY_CITY']; ?>" ><?php echo $this->Lang["CITY"]; ?></a></div></th>	
            	<th align="left" ><div class="arrow3"><a href="<?php echo $this->sort_url;?>param=date&sort=<?php if($this->input->get('sort')=='DESC'){ echo 'ASC'; }else{ echo 'DESC'; } ?>" title="<?php echo $this->Lang['SORT_B_DATE']; ?>" ><?php echo $this->Lang["JOIN_DATE"]; ?></a></div></th>
            	<th align="left" ><?php echo $this->Lang['SEND_MAIL']; ?></th>
                <th align="left" ><?php echo $this->Lang["EDIT"]; ?></th>
                <th align="left" ><?php echo $this->Lang["STATUS"]; ?></th>
                <th align="left" ><?php echo $this->Lang["DELETE"]; ?></th>
            </tr>
            <?php $i=0; $first_item = $this->pagination->current_first_item;
                foreach($this->users_list as $u){?>
                <tr>    
                        <td align="left"><?php echo $i+$first_item; ?></td>
                        <td align="left"><a href="<?php echo PATH.'admin/view-moderator/'.$u->user_id;?>.html"><?php echo ucfirst($u->firstname); ?></a></td>
                        <td align="left"><?php echo $u->email; ?></td>
                        <td align="left"><?php foreach($this->city_list as $c){ if($c->city_id == $u->city_id){ echo ucfirst($c->city_name);}  }?></td>
                        <td align="left"><?php echo date('d-M-Y h:m:i a',$u->joined_date);?></td>
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
			
			$('#submit<?php echo $u->user_id; ?>').click(function(){ 

				var msg = $('#msg<?php echo $u->user_id; ?>').val();
			   
			   if(msg ==''){
				  
			$('#em').html("<?php echo $this->Lang["REQ"]; ?>");
			return false;
			}
         })

				$('#cancel').click(function(){ 
					$('#em').text(''); 

				})

		});

	</script>


			 <td align="center">
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
		            <td><textarea class="TextArea" name="message" id="msg<?php echo $u->user_id; ?>" cols=15 rows=10 /></textarea>
		                 <em id="em"><?php if(isset($this->form_error['message'])){ echo $this->form_error["message"]; }?></em>
			    </td>
                        </tr>
                        <tr>
                             <td></td>
                             <td></td>
                             <td><input type="submit" value="<?php echo $this->Lang['SEND']; ?>" id="submit<?php echo $u->user_id; ?>"> <input type="reset" id="cancel" value="<?php echo $this->Lang['CANCEL']; ?>" onclick="javascript:window.location='<?php echo PATH; ?>admin/manage-moderator.html'" />
			     </td>
                        </tr>
                </table>
        </form>
	</div>
		
					
                    </td>

                        <td align="left">
                    	<a href="<?php echo PATH.'admin/edit-moderator/'.$u->user_id;?>.html" class="editicon" title="<?php echo $this->Lang['EDIT_USER']; ?>"></a>
                        </td>
                    <td>
                    	<?php if($u->user_status == 1){?>
                    	<a onclick="return blockunblockmoderator('<?php echo $u->user_id; ?>','<?php echo base64_encode($u->email); ?>','block');" class="blockicon" title="<?php echo $this->Lang['BLO_USER']; ?>"></a>
                        <?php } else{  ?>
                        <a onclick="return blockunblockmoderator('<?php echo $u->user_id; ?>','<?php echo base64_encode($u->email); ?>','unblock');" class="unblockicon" title="<?php echo $this->Lang['UNBLO_USER']; ?>"></a>
                        <?php } ?>
                    </td>
                    <td>
                    	<a onclick="return deletemoderator('<?php echo $u->user_id; ?>','<?php echo base64_encode($u->email); ?>');" class="deleteicon" title="<?php echo $this->Lang['DEL_USER']; ?>" ></a>
                    </td>
                    
                </tr>
            <?php $i++;} ?>   
        </table>
        </div>
  <?php } else{?><p class="nodata"><?php echo $this->Lang["NO_DATA"]; ?></p><?php }?>
    <?php echo $this->pagination; ?>  </div>
    <div class="content_bottom"><div class="bot_left"></div><div class="bot_center"></div><div class="bot_rgt"></div></div>
</div>
