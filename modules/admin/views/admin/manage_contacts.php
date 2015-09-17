<?php defined('SYSPATH') OR die('No direct access allowed.'); ?>
<div class="bread_crumb"><a href="<?php echo PATH.'admin.html'; ?>" title="<?php echo $this->Lang['HOME']; ?>"><?php echo $this->Lang["HOME"]; ?> <span class="fwn">&#155;&#155;</span></a><p><?php echo $this->template->title; ?></p></div>
<div class="cont_container mt15 mt10">
    <div class="content_top"><div class="top_left"></div><div class="top_center"></div><div class="top_rgt"></div></div>
    <div class="content_middle">
        <form method="get" class="admin_form" action="<?php echo PATH.'admin/manage-contacts.html';?>">
            <table class="list_table1 fl clr">
            <?php $this->session->set("lasturl",substr($_SERVER['REQUEST_URI'], REQUEST_URL_COUNT));  ?>
	<?php if(($this->uri->last_segment()=="manage-contacts.html") || ($this->uri->segment(3)=="page")) { ?>	
	 <?php if(count($this->contacts_list)>0){?>
			<?php if($this->pagination !=""){ // export per page ?>
	 <a class="fr frm_export" href="<?php echo PATH.$this->url.'/page/'.$this->page.'?id='.$this->Lang['SEARCH'].'&search='.$this->input->get('search');  ?>" title="<?php echo $this->Lang['EXP_DL']; ?>"><?php echo $this->Lang['EXP_PAGE']; ?></a>
			<?php } ?>
			
		<a class="fr frm_export" href="<?php echo PATH.$this->url.'?id='.$this->Lang['ALL2'].'&search='.$this->input->get('search');  ?>" title="<?php echo $this->Lang['EXP_DL']; ?>"><?php echo $this->Lang['EXP_ALL']; ?></a>
		
<?php }   }	 ?>	
            <?php 
            if(isset($this->search_key)){
	            $s = $this->search_key;
            }?>

			 <tr>
		        <td><label><?php echo $this->Lang['NAME']; ?></label></td>
                <td><label>:</label></td>
                <td><input autofocus type = "text" name ="search" <?php if(isset($s->search)){?> value="<?php echo $s->search; ?>"<?php } ?>/> 
				<div class="new_search_button"> <input type="submit" value="<?php echo $this->Lang['SEARCH']; ?>"/> </div>
				</td>
                <td></td>
            </tr>
            <tr>
            <td></td><td></td><td>
           	 <label><?php echo $this->Lang['NAME'].",".$this->Lang['EMAIL']; ?></label>
            </td>
            </tr>
        </table>
        </form>
    <?php if(count($this->contacts_list)>0){?>
        <div class="table_over_flow">
        <table class="list_table fl clr mt15">
            <tr>
                <th align="left" ><?php echo $this->Lang['S_NO']; ?></th>
                <th align="left" ><?php echo $this->Lang['NAME']; ?></th>
                <th align="left" ><?php echo $this->Lang['EMAIL_F']; ?></th>
                <th align="left" ><?php echo $this->Lang['PH_NUM']; ?></th>
                <th align="left" ><?php echo $this->Lang['MSGG']; ?></th>
                <th align="left" ><?php echo $this->Lang['SEND_MAIL']; ?></th>
                <th align="left" ><?php echo $this->Lang["DELETE"]; ?></th>
            </tr>
            <?php $i=0; $first_item = $this->pagination->current_first_item;

                foreach($this->contacts_list as $u){?>
                <tr>    
                <td align="left"><?php echo $i+$first_item; ?></td>
                <td align="left"><?php echo htmlspecialchars($u->name); ?></td>
                <td align="left"><?php echo $u->email; ?></td>	
                <td width=12 align="left"><?php echo $u->phone_number; ?></td>
                <td align="left"><?php echo substr(ucfirst($u->message), 0,250); ?>
                <?php $count = strlen($u->message); if($count > 250){ ?>
                <a id="showmessage-panel<?php echo $u->contact_id; ?>" title="<?php echo $this->Lang['VIEW_MORE']; ?>"  href="javascript:;"> <?php echo $this->Lang['VIEW_MORE']; ?></a><?php } ?> </td>
                
                <div class="popup_show1 showmsg_scroll mangeinq_pop"  id="showmessage-panel<?php echo $u->contact_id; ?>" style="display:none;">
                <div > <a class="rejected_shipping"  id="showmessage-panel-close<?php echo $u->contact_id; ?>" >&nbsp; </a></div>
                        <p style="padding:0 0 10px;"> <?php echo ucfirst($u->message); ?> </p>
                </div>
		<script>
		
		 $(document).keyup(function(e) {
                if (e.keyCode == 27) 
                  {
                        $('.popup_block_con').hide();
                        $('.popup_show1').hide();
                 } 
                });
                $(document).ready(function(){
                $('.popup_show1').hide();
                $('a#show-panel<?php echo $u->contact_id; ?>').click(function(){ 
                //$('div#panel').hide();
                $('#fade').css({'visibility' : 'visible'});
                $('#lightbox-panel<?php echo $u->contact_id; ?>').show();
                })
                $('a#showmessage-panel<?php echo $u->contact_id; ?>').click(function(){ 
                //$('div#panel').hide();
                $('#showmessage-panel<?php echo $u->contact_id; ?>').show();
                })
                $('a#showmessage-panel-close<?php echo $u->contact_id; ?>').click(function(){ 
                //$('div#panel').hide();
                $('#showmessage-panel<?php echo $u->contact_id; ?>').hide();
                 $('.popup_show1').hide();
                })

/*$('#submit<?php echo $u->contact_id; ?>').click(function(){ 

if(($('#em').text()=='')){ 
$('#lightbox-panel<?php echo $u->contact_id; ?>').show();
return false;
}
else{	
$('#lightbox-panel<?php echo $u->contact_id; ?>').hide();
return true;
}

})*/

$('#cancel').click(function(){ 
$('#em').text(''); 

})

});

</script>
	
                        <td >
                    	<a id="show-panel<?php echo $u->contact_id; ?>" title="<?php echo $this->Lang['SEND_MAIL']; ?>"  href="javascript:;"><img src="<?php echo PATH;?>images/mail.png"><input type="hidden" name="email1" id="mail" value="<?php echo $u->email; ?>"></a>
				
		<div class="popup_show popup_block_con" id="lightbox-panel<?php echo $u->contact_id; ?>" style="display:none;">
	<form method="post"  class="admin_form">
                <table>
			
                        <tr>
                            <td><label><?php echo $this->Lang['EMAIL_F']; ?></label></td>
                            <td><label>:</label></td>
		            <td><input type="text" name="email" value="<?php echo $u->email; ?> " readonly >
                            </td>
                        </tr>
	
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
                             <td><input type="submit" value="<?php echo $this->Lang['SEND']; ?>" id="submit<?php echo $u->contact_id; ?>"> <input type="reset" id="cancel" value="<?php echo $this->Lang['CANCEL']; ?>" onclick="javascript:window.location='<?php echo PATH; ?>admin/manage-contacts.html'" />
			     </td>
                        </tr>
                </table>
        </form>
	</div>
		
					
                    </td>
	 <td>
						<?php if($this->user_type==1){?>
                    	<a onclick="return deletesubcontact('<?php echo $u->contact_id; ?>')" class="deleteicon" title="<?php echo $this->Lang['DELETE']; ?>" ></a>
                    	<?php } else{echo "--";}?>
                    </td>  
                    
                </tr>
            <?php $i++;} ?>   
        </table>
    </div>
<?php } else{?><p class="nodata"><?php echo $this->Lang["NO_DATA"]; ?></p><?php }?>
     <?php echo $this->pagination; ?>    </div>
    <div class="content_bottom"><div class="bot_left"></div><div class="bot_center"></div><div class="bot_rgt"></div></div>
 
</div>



