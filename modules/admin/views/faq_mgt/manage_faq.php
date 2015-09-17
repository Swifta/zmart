<?php defined('SYSPATH') OR die('No direct access allowed.'); ?>
<div class="bread_crumb"><a href="<?php echo PATH.'admin.html'; ?>" title="<?php echo $this->Lang['HOME']; ?>"><?php echo $this->Lang["HOME"]; ?> <span class="fwn">&#155;&#155;</span></a><p><?php echo $this->template->title; ?></p></div>
<div class="cont_container mt15 mt10">
    <div class="content_top"><div class="top_left"></div><div class="top_center"></div><div class="top_rgt"></div></div>
    <div class="content_middle">
    <form method="post">
     <?php $this->session->set("lasturl",substr($_SERVER['REQUEST_URI'], REQUEST_URL_COUNT));  ?>
    <?php if(count($this->faq_details)>0){ ?>
        <div class="table_over_flow">
        <table class="list_table fl clr">
                <tr>
                <th align="left" width="5%"><?php echo $this->Lang['S_NO']; ?></th>
                <th align="left"><?php echo $this->Lang['QUES']; ?></th>
                <th align="left"><?php echo $this->Lang['ANS1']; ?></th>
                <?php if(ADMIN_PRIVILEGES_FAQ_EDIT){?>
                <th align="left"><?php echo $this->Lang["EDIT"]; ?></th>
                <?php }?>
                <?php if(ADMIN_PRIVILEGES_FAQ_BLOCK){?>
                <th align="left"><?php echo $this->Lang["STATUS"]; ?></th>
                <th align="left"><?php echo $this->Lang["DELETE"]; ?></th>             
                <?php }?>
                </tr>
                <?php $i=0; $first_item = $this->pagination->current_first_item; foreach($this->faq_details as $c) { ?>
                <tr>
                <td valign=top align="left"><?php echo $i + $first_item ; ?></td>
                <td valign=top align="left"><?php echo ucfirst(htmlspecialchars($c->question)) ; ?></td>
                <td valign=top align="left"><?php echo ucfirst(htmlspecialchars($c->answer)) ; ?></td> 
                <?php if(ADMIN_PRIVILEGES_FAQ_EDIT){?>
                <td valign=top align="left">
					<a href="<?php echo PATH.'faq/edit-faq/'.$c->faq_id;?>" class="editicon" title="<?php echo $this->Lang['EDIT_FAQ']; ?>"></a>
                </td>
                <?php }?>
                <?php if(ADMIN_PRIVILEGES_FAQ_BLOCK){?>
                <td valign=top>
					<?php if($c->faq_status == 1) { ?>
						<a onclick="return blockunblockFaq('<?php echo $c->faq_id; ?>','block');" class="blockicon" title="<?php echo $this->Lang['BLOCK']; ?>"></a>
					<?php } else {  ?>
						<a onclick="return blockunblockFaq('<?php echo $c->faq_id; ?>','unblock');" class="unblockicon" title="<?php echo $this->Lang['UNBLOCK']; ?>"></a>
					<?php } ?>
				</td>
                <td valign=top>
					<a onclick="return deleteFaq('<?php echo $c->faq_id; ?>');" class="deleteicon" title="<?php echo $this->Lang['DELETE']; ?>" ></a>
                </td>
                <?php }?>
                </tr>
                <?php $i++; } ?>
        </table>
        </div>
	<?php } else { ?><p class="nodata"><?php echo $this->Lang["NO_DATA"]; ?></p><?php } ?>
        </form>  
	<?php echo $this->pagination; ?>      
    </div>
    <div class="content_bottom"><div class="bot_left"></div><div class="bot_center"></div><div class="bot_rgt"></div>
</div>
</div>
