<?php defined('SYSPATH') OR die('No direct access allowed.'); ?>
<link rel="stylesheet" type="text/css" href="<?php echo PATH ?>css/jquery.cleditor.css">
<script type="text/javascript" src="<?php echo PATH ?>js/jquery.cleditor.min.js"></script>

<div class="bread_crumb"><a href="<?php echo PATH."admin.html"; ?>" title="<?php echo $this->Lang['HOME']; ?>"><?php echo $this->Lang["HOME"]; ?> <span class="fwn">&#155;&#155;</span></a><p><?php echo $this->template->title; ?></p></div>
<div class="cont_container mt15 mt10">
    <div class="content_top"><div class="top_left"></div><div class="top_center"></div><div class="top_rgt"></div></div>
    <div class="content_middle">
	<?php foreach( $this->get_blog as $d){	?>
        <form method="post"  class="admin_form" enctype="multipart/form-data">
                <table>
                        <tr>
                                <td><label><?php echo $this->Lang['BLOG_TITLE']; ?></label><span>*</span></td>
                                <td><label>:</label></td>
                                <td><input type="text" name="title" maxlength="200"  value="<?php echo $d->blog_title;?>" autofocus />
                                <em><?php if(isset($this->form_error['title'])){ echo $this->form_error["title"]; }?></em>
                                </td>
                        </tr>                        
                        <tr>
                                <td><label><?php echo $this->Lang['DESC']; ?></label><span>*</span></td>
                                <td><label>:</label></td>
                                <td><textarea name="description"  class="TextArea"> <?php echo $d->blog_description;?></textarea>
                                <em><?php if(isset($this->form_error['description'])){ echo $this->form_error["description"]; }?></em>
                                </td>
                        </tr>
                        <tr>
                    <td><label><?php echo $this->Lang['CATEGORY']; ?></label><span>*</span></td>
                    <td><label>:</label></td>
                    <td>
                        <select name="category">
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
                           
						<?php } foreach($this->category_list as $c){ ?>
                            <option value="<?php echo $c->category_id; ?>"  <?php if($c->category_id==$d->category_id){ ?> selected="selected" <?php } ?>><?php echo ucfirst($c->category_name); ?></option>  

                            <?php } ?>
                        </select>
                        <em><?php if(isset($this->form_error["category"])){ echo $this->form_error["category"]; }?></em>
					</td>
                        </tr>
                        
                        <tr>
                                <td><label><?php echo $this->Lang['IMAGE']; ?></label></td>
                                <td><label>:</label></td>
                                 <td>
                            	<input type="file" name="image" style="vertical-align: top;margin:20px 0 0;" />
                            	<br>
                                <label><?php echo $this->Lang['IMG_UP']; ?> 250 × 180 </label><br>          
                                 <?php  if(file_exists(DOCROOT.'images/blog_images/'.$d->blog_id.'.jpg'))  { ?>                  	
                            	<img src="<?php echo PATH.'/images/blog_images/'.$d->blog_id.'.jpg'; ?>" alt="<?php echo $d->blog_title;?>" width=100>
                            	<?php } ?>
                                </td>
                         </tr>
                         <tr><td></td><td></td><td><span style="color:#989898;"><?php echo $this->Lang['SNAP_TYPE']; ?></span></td></tr>		
                        <tr>
                                <td><label><?php echo $this->Lang['META_TITLE']; ?></label></td>
                                <td><label>:</label></td>
                                <td><input type="text" name="meta_title" value="<?php echo $d->meta_title; ?>"/>                                
                                </td>
                        </tr>
                         <tr>
                                <td><label><?php echo $this->Lang['META_DESC']; ?></label></td>
                                <td><label>:</label></td>
                                <td><textarea name="meta_description" ><?php echo $d->meta_description; ?></textarea>                                
                                </td>
                        </tr>
                        <tr>
                                <td><label><?php echo $this->Lang['META_KEY']; ?></label></td>
                                <td><label>:</label></td>
                                <td><input type="text" name="meta_keywords" value="<?php echo $d->meta_keywords; ?>"/>                                
                                </td>
                        </tr>
                         <tr>
                                <td><label><?php echo $this->Lang['TAGS']; ?></label></td>
                                <td><label>:</label></td>
                                <td><input type="text" name="tags" value="<?php echo $d->tags; ?>"/>                                
                                </td>
                        </tr>
                         <tr>
                                <td><label><?php echo $this->Lang['ALLOW_COMM']; ?></label></td>
                                <td><label>:</label></td>
                                <td><input type="checkbox" name="allow_comments" value="1" <?php if($d->allow_comments == 1) { echo 'checked'; } ?> />            
                                </td>
                        </tr>
                        <tr>
                                <td><label><?php echo $this->Lang['STATUS1']; ?></label></td>
                                <td><label>:</label></td>                               
                                <td><input type="radio" name="pub_status" value="1" <?php if($d->publish_status == 1) { echo 'checked'; } ?> /><?php echo $this->Lang['PUBLISH']; ?>
                                    <input type="radio" name="pub_status" value="2"  <?php if($d->publish_status == 2) { echo 'checked'; } ?> /><?php echo $this->Lang['DRAFT']; ?>
                                </td>
                        </tr>
                       
                        <tr>
                                <td></td>
                                <td></td>
                                <td><input type="submit" value="<?php echo $this->Lang['UPDATE']; ?>"  /><input type="button" value="<?php echo $this->Lang['CANCEL']; ?>" onclick="window.location.href='<?php echo PATH?>admin/manage-publish-blog.html'"/></td>
                        </tr> 
                </table>
        </form> 
    <?php } ?>
    </div>
    <div class="content_bottom"><div class="bot_left"></div><div class="bot_center"></div><div class="bot_rgt"></div></div>
</div>






