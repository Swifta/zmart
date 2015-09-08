
<?php defined('SYSPATH') OR die('No direct access allowed.'); ?>
<div class="bread_crumb"><a href="<?php echo PATH.'merchant.html'; ?>" title="<?php echo $this->Lang['HOME']; ?>"><?php echo $this->Lang["HOME"]; ?> <span class="fwn">&#155;&#155;</span></a><p><?php echo $this->template->title; ?></p></div>
<div class="cont_container mt15 mt10">
    <div class="content_top"><div class="top_left"></div><div class="top_center"></div><div class="top_rgt"></div></div>
    <div class="content_middle">
        
    <?php if(count($this->message_list)>0){?>
        <div class="table_over_flow">
        <table class="list_table fl clr mt15">
        	<tr>
        	   
            	
                <th align="left" ><?php echo $this->Lang["S_NO"]; ?></th>
                <th align="left" ><?php echo $this->Lang["SUBJECT"]; ?></th>
                <th align="left" ><?php echo $this->Lang["DATE"]; ?></th>
                
            </tr>
            <?php $i=0; $first_item = $this->pagination->current_first_item;
                foreach($this->message_list as $u){?>
                <?php $url ="none";  if(is_numeric($this->uri->last_segment())){ $url =$this->uri->last_segment();  } ?>
                <tr>
                        
                    <td>
						<?php echo $i+$first_item;?>
                    	
                    </td>
                    
                   
                      <td align="center">
						  <?php if($this->uri->last_segment()=="merchant_email_inbox.html")
						  {?>
						  <a href="<?php echo PATH.'merchant/show-merchant-message/'.$u->id;?>.html"><?php echo $u->email_subject;?></a>
						  <?php }elseif($this->uri->last_segment()=="moderator_email_inbox.html"){?>
						<a href="<?php echo PATH.'merchant/show-merchant-message/'.$u->id;?>.html"><?php echo $u->email_subject;?></a>
						<?php } ?>
					</td>
					<td><?php if($u->send_time>0){ echo date('d-M-Y H:i:s A',$u->send_time); }else{ echo " - - - ";}?></td>
                </tr>
            <?php $i++;} ?>   
        </table>
        </div>
  <?php } else{?><p class="nodata"><?php echo $this->Lang["NO_DATA"]; ?></p><?php }?>
    <?php echo $this->pagination; ?>  </div>
    <div class="content_bottom"><div class="bot_left"></div><div class="bot_center"></div><div class="bot_rgt"></div></div>
</div>

