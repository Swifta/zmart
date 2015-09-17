<?php defined('SYSPATH') OR die('No direct access allowed.'); date_default_timezone_set('Asia/Calcutta'); ?>
<div class="bread_crumb"><a href="<?php echo PATH.'admin.html'; ?>" title="<?php echo $this->Lang['HOME']; ?>"><?php echo $this->Lang["HOME"]; ?> <span class="fwn">&#155;&#155;</span></a><p><?php echo $this->template->title; ?></p></div>
<div class="cont_container mt15 mt10">
    <div class="content_top"><div class="top_left"></div><div class="top_center"></div><div class="top_rgt"></div></div>
    <div class="content_middle">    	
      

    <?php if(count($this->comments_list)>0){ ?> 
        <div class="table_over_flow">
        <table class="list_table fl clr mt15">
        	<tr>
        	    <th align="left" ><?php echo $this->Lang['S_NO']; ?></th>
            	<th align="left"><?php echo $this->Lang['COMM']; ?></th>
            	<?php if(ADMIN_PRIVILEGES_BLOG_BLOCK){?>
            	<?php if($this->comments_settings == 1){?>            	
            	<th align="left" ><?php echo $this->Lang['APPROVE']; ?>/<br><?php echo $this->Lang['DIS_APPR']; ?></th>            	
            	<?php } ?>
            	<?php }?>
            	<th align="left" ><?php echo $this->Lang['DATE']; ?></th>            	
            	<th align="left" ><?php echo $this->Lang['POSTED_BY']; ?></th>
            	<?php if(ADMIN_PRIVILEGES_BLOG_BLOCK){?>
                <th align="left" ><?php echo $this->Lang["STATUS"]; ?></th>
                <th align="left" ><?php echo $this->Lang["DELETE"]; ?></th>
                <?php }?>
            </tr>
            <?php $i=0; 
                foreach($this->comments_list as $u){?>
                <tr>
					<td align="left"><?php echo $i+1; ?></td>
					<td align="left"><?php echo htmlspecialchars($u->comments); ?></td>	
					<?php if(ADMIN_PRIVILEGES_BLOG_BLOCK){?>				
                    <?php if($this->comments_settings == 1){?> 
                    <td>
						
                    	<?php if($u->approve_status == 1){?>
                    	<a onclick="return approvedisapproveComment('<?php echo $u->comments_id; ?>','<?php echo $u->blog_id; ?>','disapprove');" title="<?php echo $this->Lang['APPROVE']; ?>" class="approveicon"  ></a>
                        <?php } else{  ?>
                        <a onclick="return approvedisapproveComment('<?php echo $u->comments_id; ?>','<?php echo $u->blog_id; ?>','approve');" title="<?php echo $this->Lang['DIS_APPR']; ?>" class="disapproveicon" ></a>
                        <?php } ?>
                    </td>
                    <?php } ?>
                    <?php }?>
                         <td align="left"><?php echo date('m-j-y', $u->comments_date); ?></td>
                         <td align="left"><?php echo $u->name; ?></td>
                   <?php if(ADMIN_PRIVILEGES_BLOG_BLOCK){?>      
                    <td>
						
                    	<?php if($u->comments_status == 1){?>
                    	<a onclick="return blockunblockComments('<?php echo $u->comments_id; ?>','<?php echo $u->blog_id; ?>','block');" class="blockicon" title="<?php echo $this->Lang['BLOCK']; ?>"></a>
                        <?php } else{  ?>
                        <a onclick="return blockunblockComments('<?php echo $u->comments_id; ?>','<?php echo $u->blog_id; ?>','unblock');" class="unblockicon" title="<?php echo $this->Lang['UNBLOCK']; ?>"></a>
                        <?php } ?>
                        
                    </td>
                    <td>
						<a onclick="return deleteComments('<?php echo $u->comments_id; ?>','<?php echo $u->blog_id; ?>')" class="deleteicon" title="<?php echo $this->Lang['DELETE']; ?>" ></a>
                    	
                    </td>
                    <?php }?>
                </tr>
            <?php $i++;} ?>
        </table>
        </div>
        <?php } else{?><p class="nodata"><?php echo $this->Lang['NO_DATA']; ?></p><?php }?>
    </div>

    <div class="content_bottom"><div class="bot_left"></div><div class="bot_center"></div><div class="bot_rgt"></div></div>
</div>
