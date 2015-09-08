<?php defined('SYSPATH') OR die('No direct access allowed.'); ?>
<div class="bread_crumb"><a href="<?php echo PATH."admin.html"; ?>" title="<?php echo $this->Lang['HOME']; ?>"><?php echo $this->Lang["HOME"]; ?> <span class="fwn">&#155;&#155;</span></a><p><?php echo $this->template->title; ?></p></div>
<div class="cont_container mt15 mt10">
    <div class="content_top"><div class="top_left"></div><div class="top_center"></div><div class="top_rgt"></div></div>
    <div class="content_middle">
                <?php $this->session->set("lasturl",substr($_SERVER['REQUEST_URI'], REQUEST_URL_COUNT));  ?>
		<?php if(count($this->bannerDataList)>0){ ?>
        <div class="table_over_flow">
        <table class="list_table fl clr">
        	<tr>
        	    <th width="5%"><?php echo $this->Lang['S_NO']; ?></th>
            	<th width="30%"><?php echo $this->Lang['IMG_TIT']; ?></th>
				<th width="50%"><?php echo $this->Lang['REDIRECT']; ?></th>
				<th width="10%"><?php echo $this->Lang['IMAGE']; ?></th>
				<?php if(ADMIN_PRIVILEGES_BANNER_EDIT){?>
               <th width="5%"><?php echo $this->Lang["EDIT"]; ?></th> 
               <?php }?>
               <?php if(ADMIN_PRIVILEGES_BANNER_BLOCK){?>
				<th align="left" width="5%"><?php echo $this->Lang["B_UNB"]; ?></th>
                <th width="5%"><?php echo $this->Lang["DELETE"]; ?></th>
                <?php }?>
            </tr>
            <?php   $i=0; $first_item = $this->pagination->current_first_item; 
					foreach($this->bannerDataList as $c){?>
                <tr>
                    <td><?php echo $i+$first_item; ?></td>
                    <td><?php echo htmlspecialchars($c->image_title); ?></td>
                    <td><a href="<?php echo $c->redirect_url; ?>"><?php echo $c->redirect_url; ?></a></td>
                     <?php /* <td>
                    	<input type="text" size="5px" id="rating-<?php echo $c->banner_id; ?>" maxlength="3" name="rating" onkeyup="return rating(this.value,'<?php echo PATH; ?>',<?php echo $c->banner_id; ?>);" value="<?php echo $c->position; ?>">
                    </td> */ ?>
					 <?php  //if(file_exists(DOCROOT.'images/banner_images/'.$c->banner_id.'.png')) { ?>
         	   
                    <td align="left">
                    <?php  if(file_exists(DOCROOT.'images/banner_images/'.$c->banner_id.'.png'))  { ?> 
                    <img border="0" src= "<?php echo PATH.'images/banner_images/'.$c->banner_id.'.png';?>" alt="" width="80" />
                    <?php } ?>
                    </td>
                     <?php /* } else { ?>
                     <td><img border="0" src= "<?php echo PATH.'/images/no-images.png';?>" alt="" width="80" /></td>
                     <?php } */ ?>
                     <?php if(ADMIN_PRIVILEGES_BANNER_EDIT){?>
                    <td>
                    	<a href="<?php echo PATH.'admin/edit-banner-image/'.base64_encode($c->banner_id).'.html'; ?>" class="editicon" title="<?php echo $this->Lang['EDIT']; ?>"></a>
                    </td> 
                    <?php }?>
                    <?php if(ADMIN_PRIVILEGES_BANNER_BLOCK){?>
					<td>
						<?php if($c->status==1){ ?>

						<a href="<?php echo PATH.'admin/block-banner-image/'.base64_encode($c->banner_id).'.html' ?>" class="blockicon" title="<?php echo $this->Lang['BLOCK']; ?>"></a>
                    <?php } else{  ?>
                    <a href="<?php echo PATH.'admin/unblock-banner-image/'.base64_encode($c->banner_id).'.html' ?>" class="unblockicon" title="<?php echo $this->Lang['UNBLOCK']; ?>"></a>

						<?php } ?>
						
					</td>
                  
                    <td>
                    	<a href="<?php echo PATH.'admin/delete-banner-image/'.base64_encode($c->banner_id);?>.html" 
                        onclick="return confirm('<?php echo $this->Lang['ARE_U_DEL']; ?>')" class="deleteicon" title="<?php echo $this->Lang['DELETE']; ?>"></a>
                    </td>
                     <?php }?>
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

<script>
function rating(rate,path,banner_id)
{ 
	if(rate!='' && path!='' && banner_id !=''){
		var filter = /^[0-9-+]+$/;
		if(filter.test(rate)==true){
		var url = path+'settings/banner_rating/'+banner_id+'/'+rate;
		$.post(url,function(check){ 
				if(check!=1){ 
					alert('Two positions are same so it would be swapped');
					$("#rating-"+banner_id).css('border','1px solid red');
					var val = check.split(',');
					$("#rating-"+banner_id).val(rate);
					$("#rating-"+val[0]).val(val[1]);
					return true;
				}
				else{
					 $("#rating-"+banner_id).val(rate);
					 $("#rating-"+banner_id).css('border','');
					return true;
				}
			});
		}
		else{
			$("#rating-"+banner_id).css('border','1px solid red');
			return false;
		}

	}
	else return false;
}
</script>
