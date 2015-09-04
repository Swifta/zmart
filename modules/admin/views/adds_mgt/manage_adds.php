<?php defined('SYSPATH') OR die('No direct access allowed.'); ?>
<div class="bread_crumb"><a href="<?php echo PATH.'admin.html'; ?>" title="<?php echo $this->Lang['HOME']; ?>"><?php echo $this->Lang["HOME"]; ?> <span class="fwn">&#155;&#155;</span></a><p><?php echo $this->template->title; ?></p></div>
<div class="cont_container mt15 mt10">
    <div class="content_top"><div class="top_left"></div><div class="top_center"></div><div class="top_rgt"></div></div>
    <div class="content_middle">
    <form method="post">
    <?php if(count($this->ad_details)>0){ ?>
        <div class="table_over_flow">
        <table class="list_table fl clr">
        	<tr><th align="left"><?php echo $this->Lang["AD_ID"]; ?></th>
            	<th align="left"><?php echo $this->Lang["AD_TITLE"]; ?></th>
                <th align="left"><?php echo $this->Lang["ADS_POSITION"]; ?></th>
                <th align="left"><?php echo $this->Lang["PAGE"]; ?></th>
                <?php if(ADMIN_PRIVILEGES_ADS_EDIT){?>
                <th align="left"><?php echo $this->Lang["EDIT"]; ?></th>
                <?php }?>
                <?php if(ADMIN_PRIVILEGES_ADS_BLOCK){?>
                <th align="left"><?php echo $this->Lang["STATUS"]; ?></th>
                <th align="left"><?php echo $this->Lang["DELETE"]; ?></th>             
                <?php }?>
            </tr>
	    
            <?php $i=1; foreach($this->ad_details as $c) { ?>
            <tr><td valign=top align="left"><?php echo $i?></td>
                <td valign=top align="left"><?php echo ucfirst(htmlspecialchars($c->ads_title)) ; ?></td> 
                <td valign=top align="left">  
                <?php 
					$ads_position = Kohana::config('settings');   
					if($c->page_position==1)
						$ads_list = $ads_position["ads_position"];
					else
						$ads_list = $ads_position["ads_position_1"];
					foreach($ads_list as $index => $position){
						if($c->ads_position == $index){
							echo $position;
						}
					}
				?>
		</td>                
		<td valign=top align="left"><?php if($c->page_position == "1"){
		echo $this->Lang['HOME']; 
		} elseif($c->page_position == "2"){ 
		echo $this->Lang['DEALS']; 
		} elseif($c->page_position == "3"){ 
		echo $this->Lang['PRODUCT']; 
		} elseif($c->page_position == "4"){ 
		echo $this->Lang['AUCTION']; 
		} 		
		 ?>
		 <?php if(ADMIN_PRIVILEGES_ADS_EDIT){?>
		</td> 
                <td valign=top align="left">
					<a href="<?php echo PATH.'admin/edit-ads/'.$c->ads_id.'_'.$c->ads_position.'_'.$c->page_position;?>" class="editicon" title="<?php echo $this->Lang['EDIT_AD']; ?>"></a>
                
                </td>
                <?php }?>
                <?php if(ADMIN_PRIVILEGES_ADS_BLOCK){?>
                <td valign=top>
					<?php if($c->status == 1){?>
                	<a onclick="return blockunblockAds('<?php echo $c->ads_id; ?>','block');" class="blockicon" title="<?php echo $this->Lang['BLO_UNBLO_AD']; ?>"></a>
                    <?php } else{  ?>
                    <a onclick="return blockunblockAds('<?php echo $c->ads_id; ?>','unblock');" class="unblockicon" title="<?php echo $this->Lang['BLO_UNBLO_AD']; ?>"></a>
                    <?php } ?>
                </td>
                <td valign=top>
					<a onclick="return deleteAds('<?php echo $c->ads_id; ?>');" class="deleteicon" title="<?php echo $this->Lang['DELETE_AD']; ?>" ></a>
                </td>
                <?php }?>
	   </tr>
           <?php $i++;} } else{?><p class="nodata"><?php echo $this->Lang["NO_DATA"]; ?></p><?php }?>
	
        </table>
        </div>
        </form>        
    </div>
    <div class="content_bottom"><div class="bot_left"></div><div class="bot_center"></div><div class="bot_rgt"></div></div>
</div>
