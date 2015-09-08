<?php defined('SYSPATH') OR die('No direct access allowed.'); date_default_timezone_set('Asia/Calcutta'); ?>
<div class="bread_crumb"><a href="<?php echo PATH.'admin.html'; ?>" title="<?php echo $this->Lang['HOME']; ?>"><?php echo $this->Lang["HOME"]; ?> <span class="fwn">&#155;&#155;</span></a><p><?php echo $this->template->title; ?></p></div>
<div class="cont_container mt15 mt10">
    <div class="content_top"><div class="top_left"></div><div class="top_center"></div><div class="top_rgt"></div></div>
    <div class="content_middle">    	
        <form method="get" class="admin_form" action="">
            <div class="date_range_common">  
            <table class="list_table1 fl clr">
            <?php $this->session->set("lasturl",substr($_SERVER['REQUEST_URI'], REQUEST_URL_COUNT));  ?>
                <?php
	            if(isset($this->search_key)){
		            $s = $this->search_key;
	            }?>
                <div class="date_range_part">
                    <div class="date_range_lft">
                        <label><?php echo $this->Lang['BLOG_TITLE']; ?> :</label>  
                        <span><input autofocus type = "text" name = "name" <?php if(isset($s->name)){?> value="<?php echo $s->name; ?>"<?php } ?>/></span>
                    </div>
                    <div class="date_range_right">
                        <label><?php echo $this->Lang['CATEGORY']; ?> :</label>
                        <span><select name="category">
                        <?php 
                        if(isset($s->category)){
                                if($s->category){
                                foreach($this->category_list as $category){
	                                if($s->category == $category->category_id){
                                ?>
                                <option value="<?php echo $category->category_id;?>"><?php echo ucfirst($category->category_name); ?></option>
                                <?php }}} }?>
                                <?php 
                                if(!isset($this->form_error["category"]) && isset($this->userPost["category"])){
                                foreach($this->category_list as $c){
                                if($c->category_id == $this->userPost["category"]){
                                ?>
                                <option value="<?php echo $c->category_id; ?>"><?php echo ucfirst($c->category_name); ?></option> 
                                <?php 
                                }
                                }
                                }
                                else{
						?>
						
						
                            <option value=""> <?php echo $this->Lang['SEL_CATEGORY']; ?> </option>
						<?php } foreach($this->category_list as $c){ ?>
                            <option value="<?php echo $c->category_id; ?>"><?php echo ucfirst($c->category_name); ?></option>  
                            <?php } ?>
                        </select>
                        <em><?php if(isset($this->form_error["category"])){ echo $this->form_error["category"]; }?></em>
                        </span>
                    </div>                    
                </div>
                <div class="date_range_bottm" >    
                        <div class="date_range_submit">
                        <input type="submit" value="<?php echo $this->Lang['SEARCH']; ?>"/>
                        </div>
                    </div>            
        </table>
            </div>
        </form>

    <?php if(count($this->blog_list)>0){ ?> 
        <div class="table_over_flow">
        <table class="list_table fl clr mt15">
        	<tr>
        	    <th align="left" ><?php echo $this->Lang['S_NO']; ?></th>
            	<th align="left" ><?php echo $this->Lang['BLOG_TITLE']; ?></th>            	
            	<th align="left" ><?php echo $this->Lang['CATEGORY']; ?></th> 
            	<?php  if($this->blog_list->current()->publish_status == 1){?> 
            	<th align="left" ><?php echo $this->Lang['COMM']; ?></th>          	
            	<?php } ?>
            	<th align="left" ><?php echo $this->Lang['DATE']; ?></th>            	
            	<th align="left" ><?php echo $this->Lang['DETAILS']; ?></th>  
            	<?php if(ADMIN_PRIVILEGES_BLOG_EDIT){?>          	
                <th align="left" ><?php echo $this->Lang["EDIT"]; ?></th>
                <?php }?>
                <?php if(ADMIN_PRIVILEGES_BLOG_BLOCK){?>
                <?php if($this->blog_list->current()->publish_status == 1){?> 
                <th align="left" ><?php echo $this->Lang["STATUS"]; ?></th>
                <?php }else{ ?>
                <th align="left" ><?php echo $this->Lang['PUBLISH']; ?></th>
                <?php } ?>
                <th align="left" ><?php echo $this->Lang["DELETE"]; ?></th>
                <?php }?>
            </tr>
            <?php $i=0; $first_item = $this->pagination->current_first_item;
                foreach($this->blog_list as $u){?>
                <tr>
                        <td align="left"><?php echo $i+$first_item; ?></td>
                        <td align="left"><?php echo ucfirst(htmlspecialchars($u->blog_title)); ?></td>                        
                         <td align="left"><?php echo htmlspecialchars($u->category_name); ?></td>
                         <?php if($u->publish_status == 1){?> 

                         <td align="left">
                         <a href="<?php echo PATH.'admin/manage-comments/'.$u->blog_id;?>.html" class="" title="<?php echo $this->Lang['VIW_COMM']; ?>">

                         <?php if($u->comments_count > 0) { echo ' ( '.$u->comments_count.' ) '; }?> <?php echo $this->Lang['VIEW']; ?>
                         </a>
                         </td>
                         <?php } ?>
                          <td align="left" style=" width:70px;"><?php echo date("d-m-Y",$u->blog_date); ?></td>                                                                          		
                       <td align="left">                      
                    	<a href="<?php echo PATH.'admin/view-blog/'.$u->blog_id.'/'.$u->url_title.'/'.$u->publish_status;?>.html" class="" title="<?php echo $this->Lang['VIEW_BLOG']; ?>"><?php echo $this->Lang['VIEW']; ?></a>
                        </td>
                        <?php if(ADMIN_PRIVILEGES_BLOG_EDIT){?>
                        <td align="left">
							
                    	<a href="<?php echo PATH.'admin/edit-blog/'.$u->blog_id.'/'.$u->url_title.'/'.$u->publish_status;?>.html" class="editicon" title="<?php echo $this->Lang['EDIT_BLOG']; ?>"></a>
                    	
                        </td>
                        <?php }?>
                        <?php if(ADMIN_PRIVILEGES_BLOG_BLOCK){?>
                    <td>
						
                    <?php if($u->publish_status == 1){ 
		             	if($u->blog_status == 1)
		             	{?>
				    	<a onclick="return blockunblockBlog('<?php echo $u->blog_id; ?>','<?php echo $u->url_title; ?>','block','<?php echo $u->publish_status; ?>');" class="blockicon" title="<?php echo $this->Lang['BLOCK']; ?>"></a>
				 <?php }else{  ?>
				        <a onclick="return blockunblockBlog('<?php echo $u->blog_id; ?>','<?php echo $u->url_title; ?>','unblock','<?php echo $u->publish_status; ?>');" class="unblockicon" title="<?php echo $this->Lang['UNBLOCK']; ?>"></a>
		                <?php } 
                   	}else{?>                         		
		                <a onclick="return publishBlog('<?php echo $u->blog_id; ?>','<?php echo $u->url_title; ?>','publish','<?php echo $u->publish_status; ?>');" class="blockicon" title="<?php echo $this->Lang['PUBLISH']; ?>"></a>
                  <?php } ?>
                  
                    </td>
                    <td>
					  	<a onclick="return deleteBlog('<?php echo $u->blog_id; ?>','<?php echo $u->url_title; ?>','<?php echo $u->publish_status; ?>');" class="deleteicon" title="<?php echo $this->Lang['DELETE']; ?>" ></a>
                    	
                    </td>
                    <?php }?>
                </tr>
            <?php $i++;} ?>
        </table>
        </div>
        <?php } else{?><p class="nodata"><?php echo $this->Lang["NO_DATA"]; ?></p><?php }?>
    </div>
    <?php echo $this->pagination; ?>
    <div class="content_bottom"><div class="bot_left"></div><div class="bot_center"></div><div class="bot_rgt"></div></div>
</div>
