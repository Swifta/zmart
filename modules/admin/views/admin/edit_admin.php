<?php defined('SYSPATH') OR die('No direct access allowed.'); ?>
<div class="bread_crumb"><a href="<?php echo PATH."admin.html"; ?>" title="<?php echo $this->Lang['HOME']; ?>"><?php echo $this->Lang["HOME"]; ?> <span class="fwn">&#155;&#155;</span></a><p><?php echo $this->template->title; ?></p></div>
<div class="cont_container mt15 mt10">
    <div class="content_top"><div class="top_left"></div><div class="top_center"></div><div class="top_rgt"></div></div>
    <div class="content_middle">
      
        <?php foreach($this->user_data as $u){ ?>
        <form method="post" class="admin_form" name="edit_users" >
                <table>
                        <tr> 
                                <td><label><?php echo $this->Lang["NAME"]; ?></label><span>*</span></td>
                                <td><label>:</label></td>
                                <td><input autofocus type="text" name="name" maxlength="32" value="<?php echo $u->firstname;?>"/>
                                <em><?php if(isset($this->form_error['name'])){ echo $this->form_error["name"]; }?></em>
                                </td>
                        </tr>
                        <tr>
                                <td><label><?php echo $this->Lang["EMAIL_F"]; ?></label><span>*</span></td>
                                <td><label>:</label></td>
                                <td><input type="text" name="email" readonly value="<?php echo $u->email;?>"/>
                                <em><?php if(isset($this->form_error['email'])){ echo $this->form_error["email"]; }?></em>
                                </td>
                        </tr>
                         <tr>
                                <td><label><?php echo $this->Lang["PHONE"]; ?></label></td>
                                <td><label>:</label></td>
                                <td><input type="text" name="mobile" maxlength="15" value="<?php echo $u->phone_number;?>"/>
                                <em><?php if(isset($this->form_error['mobile'])){ echo $this->form_error["mobile"]; }?></em>
                                </td>
                        </tr>
                        <tr>
                                <td><label><?php echo $this->Lang["ADDR1"]; ?></label></td>
                                <td><label>:</label></td>
                                <td><input type="text" name="address1" maxlength="100" value="<?php echo $u->address1;?>"/>
                                </td>
                        </tr>
                        <tr>
                                <td><label><?php echo $this->Lang["ADDR2"]; ?></label></td>
                                <td><label>:</label></td>
                                <td><input type="text" name="address2" maxlength="100" value="<?php echo $u->address2;?>"/>
                                </td>
                        </tr>                   
                        <tr>
                    <td><label><?php echo $this->Lang["CITY"]; ?></label><span>*</span></td>
                    <td><label>:</label></td>
                    <td>
                        <select name="city">
                        <?php 

							if(!isset($this->form_error["city"]) && isset($this->userPost["city"])){
								foreach($this->city_list as $c){
									if($c->city_id == $this->$u["city"]){
						?>
                        				 <option value="<?php echo $c->city_id; ?>"><?php echo ucfirst($c->city_name); ?></option> 
                        <?php 
									}
								}
							}
							else{?>
                            <option value="<?php echo $u->city_id; ?>"><?php echo ucfirst($u->city_name); ?></option>
						    <?php }	foreach($this->city_list as $c){ ?>
                            <option value="<?php echo $c->city_id; ?>"><?php echo ucfirst($c->city_name); ?></option>  
                            <?php } ?>
                        </select>
                        <em><?php if(isset($this->form_error["city"])){ echo $this->form_error["city"]; }?></em>
					</td>
                        </tr>
			<tr> 
                                <td><label><?php echo $this->Lang["PAYMENT_ACC"]; ?></label></td>
                                <td><label>:</label></td>
                                <td><input type="text" name="payment" maxlength="255" value="<?php echo $u->payment_account_id;?>"/>
                                <em><?php if(isset($this->form_error['payment'])){ echo $this->form_error["payment"]; }?></em>
                                </td>
                        </tr>
                        <tr>
                                <td></td>
                                <td></td>
                                <td><input type="submit" value="<?php echo $this->Lang['UPDATE']; ?>" /><input type="button" value="<?php echo $this->Lang['CANCEL']; ?>" onclick='window.location.href="<?php echo PATH?>admin/settings.html"'/></td>
                        </tr>
                      
                </table>
        </form>
          <?php  }?>
    </div>
    <div class="content_bottom"><div class="bot_left"></div><div class="bot_center"></div><div class="bot_rgt"></div></div>
</div>
