<?php defined('SYSPATH') OR die('No direct access allowed.'); ?>
<link rel="stylesheet" type="text/css" href="<?php echo PATH ?>css/jquery.cleditor.css">
<script type="text/javascript" src="<?php echo PATH ?>js/jquery.cleditor.min.js"></script>
<form action=""  method="post" class="admin_form" name="newsletter">
			 <div class="input-text1 clearfix">
            		<label><?php echo $this->Lang['SND_USER']; ?>*: </label>
    			<div class="search-input1 select-box"> 
    				<select autofocus name="users"  class="select" onchange="return user_change(this.value,1);">
    							<option value="10"><?php echo $this->Lang['SEL_USERS']; ?></option>
    							<option value="4"><?php echo $this->Lang['MY_USERS']; ?></option>
						</select>
						<em><?php if(isset($this->form_error["users"])){ echo $this->form_error["users"]; }?></em>
			</div>
			</div>		
            
            
           <div class="input-text1 clearfix">
            	<div id="email">
                    <label><?php echo $this->Lang['SEL_EMAIL']; ?> *:</label>

                <div class="search-input1 select-box"> 
                    	  <input type="hidden" name="firstname[]">
                        <select  class="Multi add_pt" name="email[]" id="emailsend"  multiple="multiple" >
                        <option value=""><?php echo $this->Lang['SEL_USER_FST']; ?></option>
                        </select>
                        <em><?php if(isset($this->form_error["email"])){ echo $this->form_error["email"]; }?></em>
               </div>
               </div>
            </div>
          <div class="input-text1 clearfix">
                       <label><?php echo $this->Lang['SUB2']; ?> *:</label>
                       <div class="search-input1"> <input type="text" name="subject" class="input_text"  />
                       <em><?php if(isset($this->form_error["subject"])){ echo $this->form_error["subject"]; }?></em>
           </div>
		
              </div>
                  <div class="input-text1 clearfix">
                        <label><?php echo $this->Lang["MSGG"]; ?>*:</label>
                        <div class="search-input1"> 
                            <textarea name="message" cols="20" rows="5" class="TextArea"><?php
                            if (!isset($this->form_error["message"]) && isset($this->userPost["message"])) {
                                echo $this->userPost["message"];
                            }
                            ?></textarea>
                           <em><?php
                            if (isset($this->form_error["message"])) {
                                echo $this->form_error["message"];
                            }
                            ?></em>
                        </div> 

                       
                    </div>

			 <div class="input-text1 clearfix">
             <label>  &nbsp;</label>
              <div class="search-input1"> 
          		<input type="submit" value="<?php echo $this->Lang['SEND']; ?>">
                <input type="button" value="<?php echo $this->Lang['CANCEL']; ?>" onclick="window.location.href='<?php echo PATH?>admin/manage-auction.html'"/>  
                </div>
                </div>
			<?php foreach( $this->deatils as $u) { ?>
                <input type="hidden" name="deal_key" value="<?php echo $u->deal_key; ?>" />
				<input type="hidden" name="deal_id" value="<?php echo $u->deal_id; ?>" />
				<input type="hidden" name="deal_title" value="<?php echo $u->deal_title; ?>" />
				<input type="hidden" name="deal_description" value="<?php echo strip_tags($u->deal_description); ?>" />
				<input type="hidden" name="deal_value" value="<?php echo $u->deal_value; ?>" />
				<input type="hidden" name="bid_increment" value="<?php echo $u->bid_increment; ?>" />
				<input type="hidden" name="user_limit_quantity" value="<?php echo $u->user_limit_quantity; ?>" />
				<input type="hidden" name="url_title" value="<?php echo $u->url_title; ?>" />
				<input type="hidden" name="shipping_fee" value="<?php echo $u->shipping_fee; ?>" />
				<input type="hidden" name="city_name" value="<?php echo $u->city_name; ?>" />
			<?php } ?>
        </form>
