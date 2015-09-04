<?php defined('SYSPATH') OR die('No direct access allowed.'); ?>
<div class="bread_crumb"><a href="<?php echo PATH.'admin.html'; ?>" title="<?php echo $this->Lang['HOME']; ?>"><?php echo $this->Lang["HOME"]; ?> <span class="fwn">&#155;&#155;</span></a><p><?php echo $this->template->title; ?></p></div>
<div class="cont_container mt15 mt10">
    <div class="content_top"><div class="top_left"></div><div class="top_center"></div><div class="top_rgt"></div></div>
    <div class="content_middle">
    
    <?php if(count($this->contact_us)>0){?>
        <table class="list_table fl clr mt15">
        	<tr>
        	    <th align="left" ><?php echo $this->Lang['SNO']; ?></th>
            	<th align="left" ><?php echo $this->Lang["NAME"]; ?></th>
            	<th align="left" ><?php echo $this->Lang["EMAIL_F"]; ?></th>
            	<th align="left" ><?php echo $this->Lang["MOBILE"]; ?></th>
                <th align="left" ><?php echo $this->Lang["DETAIL"]; ?></th>
                <th align="left" width="10%" ><?php echo $this->Lang["REPLY"]; ?></th>
                <th align="left" ><?php echo $this->Lang["DELETE"]; ?></th>
            </tr>
            <?php $i=1; foreach($this->contact_us as $u){?>
                <tr>    
                        <td align="left"><?php echo $i; ?></td>
                        <td align="left"><?php echo ucfirst($u->name); ?></td>
                        <td align="left"><?php echo $u->email; ?></td>
                        <td align="left"><?php echo $u->phone_number;?></td>		
                        <td align="left"><a href="<?php echo PATH.'admin/detail/'.$u->contact_id;?>.html" title="<?php echo $this->Lang['DETAIL']; ?>"><?php echo $this->Lang['DETAIL']; ?></a></td>
                        <td ><?php if($u->status == 1){?>
                                <a href="<?php echo PATH.'admin/sendmail/'.$u->contact_id;?>.html" title="<?php echo $this->Lang['UNANS']; ?>"><?php echo $this->Lang['UNANS']; ?></a>
                             <?php } else{ echo $this->Lang['ANS']; } ?>   
                        </td>
                        <td><a onclick="return deleteContact('<?php echo $u->contact_id; ?>');" class="deleteicon" title="<?php echo $this->Lang['DELETE']; ?>" ></a></td>
                </tr>
            <?php $i++;} ?>   
        </table>
    </div><?php } else{?><p class="nodata"><?php echo $this->Lang["NO_DATA"]; ?></p><?php }?>
    <div class="content_bottom"><div class="bot_left"></div><div class="bot_center"></div><div class="bot_rgt"></div></div>
</div>
