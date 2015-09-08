<?php defined('SYSPATH') OR die('No direct access allowed.'); ?>
<div class="bread_crumb"><a href="<?php echo PATH.'admin.html'; ?>" title="<?php echo $this->Lang['HOME']; ?>"><?php echo $this->Lang["HOME"]; ?> <span class="fwn">&#155;&#155;</span></a><p><?php echo $this->template->title; ?></p></div>
<div class="cont_container mt15 mt10">
    <div class="content_top"><div class="top_left"></div><div class="top_center"></div><div class="top_rgt"></div></div>
    <div class="content_middle">
    <form method="post" name="send_daily_deal" action="">
        <table class="list_table fl clr">
        	<tr>
            	<th align="left"><?php echo $this->Lang['S_NO']; ?></th>
            	<th align="left"><?php echo $this->Lang["CATEGORY_NAME"]; ?></th>
            	<? /*<th align="left"><?php echo $this->Lang["COUNTRY"]; ?></th> */ ?>
                <th align="left"><input type="checkbox"  onclick="checkboxcheckAll('send_daily_deal', 'checkall')" name="checkall"><?php echo $this->Lang['CHECK_ALL']; ?></th>   
            </tr>
            <?php 
				$i = 1;
				if(count($this->categorylist)) { foreach($this->categorylist as $c){
			?>
                <tr>
                    <td align="left"><?php echo $i ; $i++; ?></td>
                    <td align="left"><?php echo ucfirst($c->category_name) ; ?></td>
                  <? /*  <td align="left"><?php echo ucfirst($c->country_name); ?></td> */ ?>
                    <td align="left"><input type="checkbox" value="<?php echo $c->category_id.'__'.$c->category_name; ?>" name="citydata[]"></td>
                </tr>
            <?php } } else echo $this->Lang['PLZ_ADD_TOP_CAT'];?>
                <tr><td></td><td></td><td><input type="submit" value="<?php echo $this->Lang['SEND']; ?>" /></td>
                </tr>   
        </table>
        </form> 
        
    </div>
    <div class="content_bottom"><div class="bot_left"></div><div class="bot_center"></div><div class="bot_rgt"></div></div>
</div>
