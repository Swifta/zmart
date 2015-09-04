<?php defined('SYSPATH') OR die('No direct access allowed.'); ?>

<div class="bread_crumb"><a href="<?php echo PATH.'admin.html'; ?>" title="<?php echo $this->Lang['HOME']; ?>"><?php echo $this->Lang["HOME"]; ?> <span class="fwn">&#155;&#155;</span></a><p><?php echo $this->template->title; ?></p></div>
<div class="cont_container mt15 mt10">
    <div class="content_top"><div class="top_left"></div><div class="top_center"></div><div class="top_rgt"></div></div>
    <div class="content_middle">
    <form method="post">
    <?php $this->session->set("lasturl",substr($_SERVER['REQUEST_URI'], REQUEST_URL_COUNT));  ?>
	<?php if(count($this->cms_page) > 0){?>
        <div class="table_over_flow">
        <table class="list_table fl clr">
        	<tr><th align="left" width="10%"><?php echo $this->Lang['S_NO']; ?></th>
            	<th align="left"><?php echo $this->Lang["PAGE_TITLE"]; ?> </th>
                <th align="left"><?php echo $this->Lang["PAGE_URL"]; ?></th>
                <?php if(ADMIN_PRIVILEGES_CMS_EDIT){?>
                <th align="left" width="10%"><?php echo $this->Lang["EDIT"]; ?> </th>
                <?php }?>
                <?php if(ADMIN_PRIVILEGES_CMS_BLOCK){?>
                <th align="left" width="10%"><?php echo $this->Lang["STATUS"]; ?> </th>
                <th align="left" width="10%"><?php echo $this->Lang["DELETE"]; ?> </th>                 
                <?php }?>
            </tr>
            <?php  $i= 1; foreach($this->cms_page as $c){ if($c->cms_id != 1 && $c->cms_title != "About Us") {?>
            <tr><td valign=top align="left"><?php echo $i;?></td>
                <td valign=top align="left"><?php echo ucfirst(htmlspecialchars($c->cms_title)) ; ?></td>
                 <td valign=top align="left"><a href="<?php echo PATH.$c->cms_url; ?>.php" target="_blank"><?php echo PATH.$c->cms_url; ?>.php</a></td>
                 <?php if(ADMIN_PRIVILEGES_CMS_EDIT){?>
                <td valign=top align="left">
					<a href="<?php echo PATH.'cms/edit-cms/'.$c->cms_id.'/'.$c->cms_url;?>.html" class="editicon" title="<?php echo $this->Lang['EDIT_CMS']; ?>"></a>
                </td>
                <?php }?>
                <?php if(ADMIN_PRIVILEGES_CMS_BLOCK){?>
                <td valign=top>
					<?php if($c->cms_title != "Help" && $c->cms_title!="Warranty" && $c->cms_title!="Returns" && $c->cms_title!="Privacy Policy"){ ?>
                	<?php if($c->cms_status == 1){?>
                	<a onclick="return blockunblockCMS('<?php echo $c->cms_id; ?>','<?php echo $c->cms_url; ?>','block');" class="blockicon" title="<?php echo $this->Lang['BLO/UNBLO_CMS']; ?>"></a>
                    <?php } else{  ?>
                    <a onclick="return blockunblockCMS('<?php echo $c->cms_id; ?>','<?php echo $c->cms_url; ?>','unblock');" class="unblockicon" title="<?php echo $this->Lang['BLO/UNBLO_CMS']; ?>"></a>
                    <?php } ?>
                         <?php } ?>
                </td>
                <td valign=top>
					<?php if($c->cms_title != "Help" && $c->cms_title!="Warranty" && $c->cms_title!="Returns" && $c->cms_title!="Privacy Policy"){ ?>
                	<a onclick="return deleteCMS('<?php echo $c->cms_id; ?>','<?php echo $c->cms_url; ?>');" class="deleteicon" title="<?php echo $this->Lang['DEL_CMS']; ?>" ></a>
                	<?php } ?>
                </td>
                <?php }?>
            </tr>
           <?php  $i++;} } ?>
        </table>
        </div>
		<?php } else {  echo "<center>".$this->Lang["NO_CMS_FOUND"]."</centure>"; } ?>
        </form>        
    </div>
    <div class="content_bottom"><div class="bot_left"></div><div class="bot_center"></div><div class="bot_rgt"></div></div>
</div>
