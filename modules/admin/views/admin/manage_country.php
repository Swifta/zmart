<?php defined('SYSPATH') OR die('No direct access allowed.'); ?>
<div class="bread_crumb"><a href="<?php echo PATH."admin.html"; ?>" title="<?php echo $this->Lang['HOME']; ?>"><?php echo $this->Lang["HOME"]; ?> <span class="fwn">&#155;&#155;</span></a><p><?php echo $this->template->title; ?></p></div>
<div class="cont_container mt15 mt10">
    <div class="content_top"><div class="top_left"></div><div class="top_center"></div><div class="top_rgt"></div></div>
    <div class="content_middle">
        <div class="table_over_flow">
        <table class="list_table fl clr">
        <?php $this->session->set("lasturl",substr($_SERVER['REQUEST_URI'], REQUEST_URL_COUNT));  ?>
        	<tr>
        	<th width="5%"><?php echo $this->Lang['S_NO']; ?></th>
            	<th width="20%"><?php echo $this->Lang["COUNTRY"]; ?></th>
            	<th width="15%"><?php echo $this->Lang['COUN_CO']; ?></th>
            	<th width="20%"><?php echo $this->Lang["CUUR_SYM"]; ?></th>
            	<th width="20%"><?php echo $this->Lang["CUUR_CODE"]; ?></th>
            	<?php if(ADMIN_PRIVILEGES_COUNTRY_EDIT){?>
                <th width="10%"><?php echo $this->Lang["EDIT"]; ?></th>
                <?php }?>
                <?php if(ADMIN_PRIVILEGES_COUNTRY_BLOCK){?>
                <th width="10%"><?php echo $this->Lang["STATUS"]; ?></th>
                <th width="10%"><?php echo $this->Lang["DELETE"]; ?></th>
                <?php }?>
            </tr>
            <?php $i=1; foreach($this->countryDataList as $c){?>
                <tr>
                    <td><?php echo $i;?></td>
                    <td><?php echo htmlspecialchars($c->country_name); ?></td>
                     <td><?php echo htmlspecialchars($c->country_code); ?></td>
                    <td><?php echo htmlspecialchars($c->currency_symbol); ?></td>
                    <td><?php echo htmlspecialchars($c->currency_code); ?></td>
                    <?php if(ADMIN_PRIVILEGES_COUNTRY_EDIT){?>
                    <td>
						<a href="<?php echo PATH.'admin/edit-country/'. $c->country_url;?>.html" class="editicon" title="<?php echo $this->Lang['EDIT_COUNTRY']; ?>"></a>
                    </td>
                    <?php }?>
                    <?php if(ADMIN_PRIVILEGES_COUNTRY_BLOCK){?>
                    <td>
						<?php if($c->country_status == 1){?>
                    	<a href="<?php echo PATH.'admin/block-country/'. $c->country_url;?>.html" class="blockicon" title="<?php echo $this->Lang['BLO_COUNT']; ?>"></a>
                        <?php } elseif($c->country_status==0){  ?>
                        <a href="<?php echo PATH.'admin/unblock-country/'. $c->country_url;?>.html" class="unblockicon" title="<?php echo $this->Lang['UNBLO_COUNT']; ?>"></a>
                        <?php } ?>
                    </td>
                    <td>
						<a href="<?php echo PATH.'admin/delete-country/'.$c->country_url;?>.html" 
                        onclick="return confirm('<?php echo $this->Lang['ARE_U_DEL']; ?>')" class="deleteicon" title="<?php echo $this->Lang['DEL_COUNT']; ?>"></a>
                    </td>
                    <?php }?>
                </tr>
            <?php $i++; } ?>    
        </table>
        </div>
    </div>
    <div class="content_bottom"><div class="bot_left"></div><div class="bot_center"></div><div class="bot_rgt"></div></div>
</div>
