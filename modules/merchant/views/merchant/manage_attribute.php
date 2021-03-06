<?php defined('SYSPATH') OR die('No direct access allowed.'); ?>
<div class="bread_crumb"><a href="<?php echo PATH."merchant.html"; ?>" title="<?php echo $this->Lang['HOME']; ?>"><?php echo $this->Lang["HOME"]; ?> <span class="fwn">&#155;&#155;</span></a><p><?php echo $this->template->title; ?></p></div>
<div class="cont_container mt15 mt10">
    <div class="content_top"><div class="top_left"></div><div class="top_center"></div><div class="top_rgt"></div></div>
    <div class="content_middle">
                <?php $this->session->set("lasturl",substr($_SERVER['REQUEST_URI'], REQUEST_URL_COUNT));  ?>
		<?php if(count($this->attributeDataList)>0){ ?>
        <div class="table_over_flow">
        <table class="list_table fl clr">
        	<tr>
        	<th width="5%"><?php echo $this->Lang['S_NO']; ?></th>
		<th width="20%"><?php echo $this->Lang['ATTR_LABEL']; ?></th>
		<th width="20%"><?php echo $this->Lang['ATTR_GROUP_LABEL']; ?></th>
		<th width="20%"><?php echo $this->Lang['SORT_ORDER']; ?></th>
                <th width="10%"><?php echo $this->Lang["EDIT"]; ?></th>
                
            </tr>
            <?php   $i=0; $first_item = $this->pagination->current_first_item; 
					foreach($this->attributeDataList as $c){?>
                <tr>
                    <td><?php echo $i+$first_item; ?></td>
                    <td><?php echo htmlspecialchars($c->name); ?></td>
                    <td><?php echo htmlspecialchars($c->groupname); ?></td>
                    <td><?php echo $c->sort_order; ?></td>
                    <td>
						
                    	<a href="<?php echo PATH.'merchant/edit-attribute/'.base64_encode($c->attribute_id).'.html'; ?>" class="editicon" title="<?php echo $this->Lang['EDIT_ATTR']; ?>"></a>
                    	
                    </td>
                   
                   
                </tr>
            <?php $i++; } ?>    
        </table>
        </div>
		<?php } else { ?>
		<p class="nodata"><?php echo $this->Lang["NO_ATTR"]; ?></p>
		<?php } ?>
<?php echo $this->pagination; ?>
    </div>
    <div class="content_bottom"><div class="bot_left"></div><div class="bot_center"></div><div class="bot_rgt"></div></div>
</div>
