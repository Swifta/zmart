<?php defined('SYSPATH') OR die('No direct access allowed.'); ?>
<div class="bread_crumb"><a href="<?php echo PATH."admin.html"; ?>" title="<?php echo $this->Lang['HOME']; ?>"><?php echo $this->Lang["HOME"]; ?> <span class="fwn">&#155;&#155;</span></a><p><?php echo $this->template->title; ?></p></div>
<div class="cont_container mt15 mt10">
    <div class="content_top"><div class="top_left"></div><div class="top_center"></div><div class="top_rgt"></div></div>
    <div class="content_middle">
        <div class="table_over_flow">
        <table class="fl clr list_table">
        <?php $this->session->set("lasturl",substr($_SERVER['REQUEST_URI'], REQUEST_URL_COUNT));  ?>
        	<tr><th ><?php echo $this->Lang['S_NO']; ?></th>
            	<th width="26%"><?php echo $this->Lang["TITLE"]; ?></th>
                <th align="left" width="10%"><?php echo $this->Lang['TEMPLATE_FILE']; ?></th>
				<th align="left" ><?php echo $this->Lang['TEMPLATE_IMAGE']; ?></th>
				<?php if(ADMIN_PRIVILEGES_NEWSLETTER_EDIT){?>
				<th align="left" width="5%" ><?php echo $this->Lang["EDIT"]; ?></th>
				<?php }?>
				<?php if(ADMIN_PRIVILEGES_NEWSLETTER_BLOCK){?>
                <th align="left" width="5%" ><?php echo $this->Lang["STATUS"]; ?></th>
                <th align="left" width="5%" ><?php echo $this->Lang["DELETE"]; ?></th>
                <?php }?>
            </tr>
            <?php $i=1; 
            if(count($this->newsletter_template_list)>0){
            foreach($this->newsletter_template_list as $news){?>
            <tr>
                <td><?php echo $i;?></td>
                <td><?php echo ucfirst(htmlspecialchars($news->newsletter_title));?></td>
                <td><a href="<?php echo PATH.'images/newsletter/Template_file_'.$news->newsletter_id.'.php';?>" target="_blank"><?php echo "Template_file_".$news->newsletter_id.".php";?></a></td>
                <td><img src="<?php echo PATH.'images/newsletter/'.$news->newsletter_id.'.png';?>" style="width:50px;height:50px"></td>
                <?php if(ADMIN_PRIVILEGES_NEWSLETTER_EDIT){?>
				<td>
					<a href="<?php echo PATH.'admin/edit-template/'.base64_encode($news->newsletter_id).'.html';?>" class="editicon" title="<?php echo $this->Lang['EDIT_TEMPLATE']; ?>"></a>
				</td>
				<?php }?>
				<?php if(ADMIN_PRIVILEGES_NEWSLETTER_BLOCK){?>
				<td>
					<?php if($news->newsletter_status==1){?>
					<a onclick="return blockunblockNewsletter('<?php echo base64_encode($news->newsletter_id); ?>','block');" class="blockicon" title="<?php echo $this->Lang['BLOCK']; ?>"></a>
					<?php } else{  ?>
					<a onclick="return blockunblockNewsletter('<?php echo base64_encode($news->newsletter_id); ?>','unblock');" class="unblockicon" title="<?php echo $this->Lang['UNBLOCK']; ?>"></a>
					<?php } ?>
				</td>
				<td>
					<a onclick="return deleteNewsletter('<?php echo base64_encode($news->newsletter_id); ?>');" class="deleteicon" title="<?php echo $this->Lang['DELETE']; ?>" ></a>
				</td>
				<?php }?>
            </tr>
            <?php $i++; }}else{?>
            <tr>
				<td colspan="7"><div class="no_record"><?php echo $this->Lang["NO_TEMPLATES_FOUND"];?></div></td>
            </tr>
            <?php }?>
        </table>
        </div>
    </div>
    <div class="content_bottom"><div class="bot_left"></div><div class="bot_center"></div><div class="bot_rgt"></div></div>
</div>
