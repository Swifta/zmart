<?php defined('SYSPATH') OR die('No direct access allowed.'); ?>
<div class="bread_crumb"><a href="<?php echo PATH."merchant.html"; ?>" title="<?php echo $this->Lang['HOME']; ?>"><?php echo $this->Lang["HOME"]; ?> <span class="fwn">&#155;&#155;</span></a><p><?php echo $this->template->title; ?></p></div>
<div class="cont_container mt15 mt10">
        <div class="content_top"><div class="top_left"></div><div class="top_center"></div><div class="top_rgt"></div></div>
        <div class="content_middle">
        <?php $this->session->set("lasturl",substr($_SERVER['REQUEST_URI'], REQUEST_URL_COUNT));  ?>
        <?php if(count($this->ColorDataList)>0){ ?>
        <div class="table_over_flow">
        <table class="list_table fl clr">
        <tr>
        <th width="5%"><?php echo $this->Lang['S_NO']; ?></th>
        <th width="20%"><?php echo $this->Lang['CO_CO']; ?></th>
        <th width="20%"><?php echo $this->Lang['CO_NA']; ?></th>
        <th width="10%"><?php echo $this->Lang["EDIT"]; ?></th>
        </tr>
        <?php   $i=0; $first_item = $this->pagination->current_first_item;
        foreach($this->ColorDataList as $c){?>
        <tr>
        <td><?php echo $i+$first_item; ?></td>
        <td><?php echo $c->color_code; ?></td>
        <td><span style="color:#<?php echo $c->color_code;?>"><?php echo $c->color_name; ?></span></td>
        <td>
        <a href="<?php echo PATH.'merchant/edit-color/'.base64_encode($c->id);?>.html#<?php echo $c->color_code;?>" class="editicon" title="<?php echo $this->Lang['EDIT_CO']; ?>"></a>
        </td>
        </tr>
        <?php $i++; } ?>
        </table>
        </div>
        <?php } else { ?>
        <p class="nodata"><?php echo $this->Lang["NO_DATA"]; ?></p>
        <?php } ?>
        <?php echo $this->pagination; ?>
        </div>
        <div class="content_bottom"><div class="bot_left"></div><div class="bot_center"></div><div class="bot_rgt"></div></div>
</div>
