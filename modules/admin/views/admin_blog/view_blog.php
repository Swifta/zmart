<?php defined('SYSPATH') OR die('No direct access allowed.'); ?>
<div class="bread_crumb"><a href="<?php echo PATH.'admin.html'; ?>" title="<?php echo $this->Lang['HOME']; ?>"><?php echo $this->Lang["HOME"]; ?> <span class="fwn">&#155;&#155;</span></a><p><?php echo $this->template->title; ?></p></div>
<div class="cont_container mt15 mt10">
    <div class="content_top"><div class="top_left"></div><div class="top_center"></div><div class="top_rgt"></div></div>
    <div class="content_middle">
	
	
	
                <div class="mergent_det2">
      <fieldset>
    		<legend><?php echo $this->template->title; ?></legend>

        <table class="list_table fl clr show_details_table">
            <?php foreach( $this->blog_details as $d){
											
			?>
                <tr>
                         <th valign="top" align="left" width="20%"><?php echo $this->Lang['BLOG_TITLE']; ?></th><th valign="top">:</th><td align="left"><?php echo ucfirst(htmlspecialchars($d->blog_title)); ?></td>
                </tr>
               
                <tr>
                        <th valign="top" align="left"><?php echo $this->Lang['DESC']; ?></th><th valign="top">:</th><td align="left"><?php echo nl2br(html_entity_decode(htmlspecialchars($d->blog_description)));?></td>
                </tr>
                <tr>
                        <th valign="top" align="left" ><?php echo $this->Lang['SNAB']; ?></th><th valign="top">:</th><td align="left"><img src="<?php echo PATH.'images/blog_images/'.$d->blog_id.'.jpg'; ?>" alt="<?php echo $d->blog_title;?>" width="300"></td></td>  
                </tr>                 
                <tr>
                        <th align="left" ><?php echo $this->Lang['CATEGORY']; ?></th><th>:</th><td align="left"><?php echo htmlspecialchars($d->category_name); ?></td>
                </tr>
                <tr>
                        <th align="left"><?php echo $this->Lang['META_TITLE']; ?></th><th>:</th><td align="left"><?php echo htmlspecialchars($d->meta_title); ?></td>
                </tr>
                <tr>
                        <th align="left" ><?php echo $this->Lang['META_DESC']; ?></th><th>:</th><td align="left"><?php echo htmlspecialchars($d->meta_description); ?></td>
                </tr> 
                 <tr>
                        <th align="left" ><?php echo $this->Lang['META_KEY']; ?></th><th>:</th><td align="left"><?php echo htmlspecialchars($d->meta_keywords); ?></td>
                </tr> 
                <tr>
                        <th align="left" ><?php echo $this->Lang['TAGS']; ?></th><th>:</th><td align="left"><?php echo $d->tags; ?></td>
                </tr> 
                <tr>
                        <th align="left" ><?php echo $this->Lang['ALLOW_COMM']; ?></th><th>:</th><td align="left"><?php if($d->allow_comments == 1){ $this->Lang['YES']; }else{ echo $this->Lang['NO']; }; ?></td>
                </tr> 
                <tr>
                        <th align="left" ><?php echo $this->Lang['COMM']; ?> <?php echo $this->Lang['COUNT']; ?></th><th>:</th><td align="left"><?php echo $d->comments_count; ?></td>
                </tr> 
                <tr>
                        <th align="left" ><?php echo $this->Lang['VIEWS']; ?></th><th>:</th><td align="left"><?php echo $d->blog_views; ?></td>
                </tr>                      
                <tr>
                        <th align="left" ><?php echo $this->Lang['BLOG_PO']; ?> <?php echo $this->Lang['DATE']; ?></th><th>:</th><td align="left"><?php echo date("d-m-y", $d->blog_date); ?></td>
                </tr>
                <tr>
                        <th align="left" ><?php echo $this->Lang['BLOG']; ?> <?php echo $this->Lang['STATUS1']; ?></th><th>:</th><td align="left"><?php if($d->blog_status == 1){ echo $this->Lang['ACTIVE']; }else{ echo $this->Lang['BLOCKED']; } ?></td>
                </tr> 	 
				 </table>
				 </fieldset>
				 </div>                                                                                              	                                                                                                
                  <tr><td colspan="3"><a href="javascript:history.back();" class="back_btn"><?php echo $this->Lang["BACK"]; ?></a></td></tr>                 
                
                <?php } ?>
        </table>
    </div>
    <div class="content_bottom"><div class="bot_left"></div><div class="bot_center"></div><div class="bot_rgt"></div></div>
</div>
