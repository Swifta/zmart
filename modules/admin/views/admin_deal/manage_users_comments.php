<?php defined('SYSPATH') OR die('No direct access allowed.'); ?>
<div class="bread_crumb"><a href="<?php echo PATH.'admin.html'; ?>" title="<?php echo $this->Lang['HOME']; ?>"><?php echo $this->Lang["HOME"]; ?> <span class="fwn">&#155;&#155;</span></a><p><?php echo $this->template->title; ?></p></div>
<div class="cont_container mt15 mt10">
    <div class="content_top"><div class="top_left"></div><div class="top_center"></div><div class="top_rgt"></div></div>
    <div class="content_middle">
        <form method="get" class="admin_form" action="<?php echo PATH.'admin/manage-deal-comments.html';?>">
            <table class="list_table1 fl clr">
                <?php 
	            if(isset($this->search_key)){
		            $s = $this->search_key;
	            }?>
                
              <tr>
		      <td><label><?php echo $this->Lang["NAME"]; ?></label></td>
		        <td><label>:</label></td>
		        <td><input type = "text" name = "firstname" <?php if(isset($s->firstname)){?> value="<?php echo $s->firstname; ?>"<?php } ?>/></td>
		        <td><input type="submit" title="<?php echo $this->Lang['SEARCH']; ?>" value="<?php echo $this->Lang['SEARCH']; ?>" class="fl"/></td>
		    </tr>
		     <tr>
		     <td></td><td></td><td>
		    <label><?php echo $this->Lang['USER_NAME']; ?>, <?php echo $this->Lang['DEALS_NAME']; ?>, <?php echo $this->Lang['COMM_DESCC']; ?></label>
		    </td>
             </tr>
        </table>
        </form>
    
    <?php if(count($this->users_list)>0){?>
        <table class="list_table fl clr mt15">
        	<tr>
        	<th align="left" ><?php echo $this->Lang['S_NO']; ?></th>
            <th align="left" ><?php echo $this->Lang["DEALS_NAME"]; ?></th>
            <th align="left" ><?php echo $this->Lang["USER_NAME"]; ?></th>
            <th align="left" ><?php echo $this->Lang["COMM_DESCC"]; ?></th>
            <th align="left" ><?php echo $this->Lang["COMM_DATE"]; ?></th>
            <th align="left" ><?php echo $this->Lang["EDIT"]; ?></th>
			<th align="left" ><?php echo $this->Lang["B_UNB"]; ?></th>
			<th align="left" ><?php echo $this->Lang["DELETE"]; ?></th>
                
            </tr>
            <?php $i=0; $first_item = $this->pagination->current_first_item;

                foreach($this->users_list as $u){?>
                <tr>    
                        <td align="left"><?php echo $i+$first_item; ?></td>
                        <td align="left"><a href="<?php echo PATH.'admin/view-deal/'.$u->deal_key.'/'.$u->deal_id.'.html';?>" title="<?php echo ucfirst($u->deal_title); ?>" ><?php echo ucfirst($u->deal_title); ?></a></td>
                        <td align="left"><?php echo ucfirst($u->firstname); ?></td>
                        <td align="left"><?php echo $u->comments;?></td>
                        <td align="left"><?php echo date('d-M-Y',$u->dis_create); ?></td>		
                  
                    
                    <td align="left">
                    	<a href="<?php echo PATH.'admin/edit-deal-comments/'.$u->discussion_id;?>.html" class="editicon" title="<?php echo $this->Lang['EDIT_COMM']; ?>"></a>
                        </td>
                        <td>
                    	<?php if($u->discussion_status == 1){?>
                    	<a href="<?php echo PATH.'admin/block-deal-comments/'.$u->discussion_id.'.html'?>" class="blockicon" title="<?php echo $this->Lang['BLOCK_COMM']; ?>"></a>
                        <?php } else{  ?>
                        <a href="<?php echo PATH.'admin/unblock-deal-comments/'.$u->discussion_id.'.html'?>" class="unblockicon" title="<?php echo $this->Lang['UNBLOCK_COMM']; ?>"></a>
                        <?php } ?>
                    </td>
		 			<td>
                    	<a onclick="return deleteDealComments('<?php echo $u->discussion_id; ?>')" class="deleteicon" title="<?php echo $this->Lang['DELETE']; ?>" ></a>
                    </td>  
                    
                </tr>
            <?php $i++;} ?>   
        </table>
<?php } else{?><p class="nodata"><?php echo $this->Lang["NO_DATA"]; ?></p><?php }?>
     <?php echo $this->pagination; ?>    </div>
    <div class="content_bottom"><div class="bot_left"></div><div class="bot_center"></div><div class="bot_rgt"></div></div>
 
</div>
