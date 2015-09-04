<?php defined('SYSPATH') OR die('No direct access allowed.'); ?>
<div class="bread_crumb"><a href="<?php echo PATH."admin.html"; ?>" title="<?php echo $this->Lang['HOME']; ?>"><?php echo $this->Lang["HOME"]; ?> <span class="fwn">&#155;&#155;</span></a><p><?php echo $this->template->title; ?></p></div>
<div class="cont_container mt15 mt10">
    <div class="content_top"><div class="top_left"></div><div class="top_center"></div><div class="top_rgt"></div></div>
    <div class="content_middle">
        <div class="mergent_det">
                       <fieldset>
                       <legend><?php echo $this->Lang['ADD_USER']; ?></legend>
        
        <form method="post"  class="admin_form">
                <table>
                        <tr>
                                <td><label><?php echo $this->Lang["FIRST_NAME"]; ?></label><span>*</span></td>
                                <td><label>:</label></td>
                                <td><input type="text" name="firstname" maxlength="32"  value="<?php if(!isset($this->form_error['firstname']) && isset($this->userPost['firstname'])){echo $this->userPost['firstname'];}?>" autofocus />
                                <em><?php if(isset($this->form_error['firstname'])){ echo $this->form_error["firstname"]; }?></em>
                                </td>
                        </tr>
                        
                        <tr>
                                <td><label><?php echo $this->Lang["LAST_NAME"]; ?></label><span>*</span></td>
                                <td><label>:</label></td>
                                <td><input type="text" name="lastname" maxlength="32"  value="<?php if(!isset($this->form_error['lastname']) && isset($this->userPost['lastname'])){echo $this->userPost['lastname'];}?>"/>
                                <em><?php if(isset($this->form_error['lastname'])){ echo $this->form_error["lastname"]; }?></em>
                                </td>
                        </tr>
                        
                        <tr>
                                <td><label><?php echo $this->Lang["EMAIL_F"]; ?></label><span>*</span></td>
                                <td><label>:</label></td>
                                <td><input type="text" name="email" maxlength="255" value="<?php if(!isset($this->form_error['email']) && isset($this->userPost['email'])){echo $this->userPost['email'];}?>"/>
                                <em><?php if(isset($this->form_error['email'])){ echo $this->form_error["email"]; }?></em>
                                </td>
                        </tr>
                         <tr>
                                <td><label><?php echo $this->Lang["AGE_RNG"]; ?></label><span>*</span></td>
                                <td><label>:</label></td>
                                <td><select name="age_range">
										<option value=""><?php echo $this->Lang['SEL_AGE_RNG']; ?></option>
										<option value="1" <?php if(!isset($this->form_error['age_range']) && isset($_POST['age_range'])){ if($_POST['age_range'] == 1){ ?> selected <?php } } ?> ><?php echo $this->Lang["17_BEL"]; ?></option>
										<option value="2" <?php if(!isset($this->form_error['age_range']) && isset($_POST['age_range'])){ if($_POST['age_range'] == 2){ ?> selected <?php } } ?> ><?php echo $this->Lang["18_25"]; ?></option>
										<option value="3" <?php if(!isset($this->form_error['age_range']) && isset($_POST['age_range'])){ if($_POST['age_range'] == 3){ ?> selected <?php } } ?> ><?php echo $this->Lang["26_35"]; ?></option>
										<option value="4" <?php if(!isset($this->form_error['age_range']) && isset($_POST['age_range'])){ if($_POST['age_range'] == 4){ ?> selected <?php } } ?> ><?php echo $this->Lang["36_45"]; ?></option>
										<option value="5" <?php if(!isset($this->form_error['age_range']) && isset($_POST['age_range'])){ if($_POST['age_range'] == 5){ ?> selected <?php } } ?> ><?php echo $this->Lang["46_65"]; ?></option>
										<option value="6" <?php if(!isset($this->form_error['age_range']) && isset($_POST['age_range'])){ if($_POST['age_range'] == 6){ ?> selected <?php } } ?> ><?php echo $this->Lang["66_ABV"]; ?></option>
									</select>
                                <em><?php if(isset($this->form_error['age_range'])){ echo $this->form_error["age_range"]; }?></em>
                                </td>
                        </tr>
                          <tr>
                                <td><label><?php echo $this->Lang["GENDER"]; ?></label><span>*</span></td>
                                <td><label>:</label></td>
                                <td>
									<select name="gender">
										<option value=""><?php echo $this->Lang["SEL_GEN"]; ?></option>
										<option value="1" <?php if(!isset($this->form_error['gender']) && isset($_POST['gender'])){ if($_POST['gender'] == 1){ ?> selected <?php } } ?> ><?php echo $this->Lang["MALE"]; ?></option>
										<option value="2" <?php if(!isset($this->form_error['gender']) && isset($_POST['gender'])){ if($_POST['gender'] == 2){ ?> selected <?php } } ?>><?php echo $this->Lang["FEMALE"]; ?></option>
									 </select>
                                <em><?php if(isset($this->form_error['gender'])){ echo $this->form_error["gender"]; }?></em>
                                </td>
                        </tr>
                        <tr>
                                <td><label><?php echo $this->Lang["PHONE"]; ?></label><span>*</span></td>
                                <td><label>:</label></td>
                                <td><input type="text" name="mobile" maxlength="15" value="<?php if(!isset($this->form_error['mobile']) && isset($this->userPost['mobile'])){echo $this->userPost['mobile'];}?>"/>
                                <em><?php if(isset($this->form_error['mobile'])){ echo $this->form_error["mobile"]; }?></em>
                                </td>
                        </tr>
                         <tr>
                                <td><label><?php echo $this->Lang["ADDR1"]; ?></label><span>*</span></td>
                                <td><label>:</label></td>
                                <td><input type="text" name="address1" maxlength="100" value="<?php if(isset($this->userPost['address1'])){echo $this->userPost['address1'];}?>"/>
                                <em><?php if(isset($this->form_error['address1'])){ echo $this->form_error["address1"]; }?></em>
                                </td>
                        </tr>
                        <tr>
                                <td><label><?php echo $this->Lang["ADDR2"]; ?></label></td>
                                <td><label>:</label></td>
                                <td><input type="text" name="address2" maxlength="100" value="<?php if(isset($this->userPost['address2'])){echo $this->userPost['address2'];}?>"/>
                                <em><?php if(isset($this->form_error['address2'])){ echo $this->form_error["address2"]; }?></em>
                                </td>
                        </tr>                        
                       
                        <tr>
                    <td><label><?php echo $this->Lang["SEL_COUNTRY"]; ?></label><span>*</span></td>
                    <td><label>:</label></td>
                    <td>
                        <select name="country" onchange="return city_change(this.value);">
                        <option value=""><?php echo $this->Lang["SEL_COUNTRY"]; ?></option>
                        
                        <?php foreach($this->country_list as $d){ ?>
                        
                        <option value="<?php echo $d->country_id ?>" <?php if(!isset($this->form_error['country']) && isset($_POST['country'])){ if($_POST['country'] == $d->country_id){ ?> selected <?php } } ?>><?php echo $d->country_name; ?></option>
                          <?php } ?>
                        </select>
                       <em><?php if(isset($this->form_error["country"])){ echo $this->form_error["country"]; }?></em>
                     </td>
                     </tr>
                     
                        <tr id="CitySD">
                    <td><label><?php echo $this->Lang["SEL_CITY"]; ?></label><span>*</span></td>
                    <td><label>:</label></td>
                    <td>
                        <?php if(!isset($this->form_error['city']) && isset($_POST['city'])){ ?>
				<select name="city">
				<?php foreach($this->city_list as $s){ ?>
				<?php if($s->city_id == $_POST['city']){ ?>
			                <option value="<?php echo $s->city_id; ?>" <?php if(isset($_POST['city'])){ if($_POST['city'] == $s->city_id){ ?> selected <?php } } ?>><?php echo $s->city_name; ?></option>
				<?php } } ?>
		                </select>
			<?php } else{ ?>
		                <select name="city">
		                <option value=""> <?php echo $this->Lang["CITY_FIRST"]; ?></option>
		                </select>
                        <?php } ?>
                        <em><?php if(isset($this->form_error["city"])){ echo $this->form_error["city"]; }?></em>
					</td>
                        </tr> 
                         <tr>
                                <td><label><?php echo $this->Lang["UNIQ_IDEN"]; ?></label></td>
                                <td><label>:</label></td>
                                <td> <input name="unique_identifier" maxlength="15"  type="text" value="" />
                                <em><?php if(isset($this->form_error['unique_identifier'])){ echo $this->form_error["unique_identifier"]; }?></em>
                                </td>
                        </tr>
                        <tr>
                                <td></td>
                                <td></td>
                                <td><input type="submit" id="submit" value="<?php echo $this->Lang['SUBMIT']; ?>" /><input type="reset" value="<?php echo $this->Lang['RESET']; ?>" onclick="javascript:window.location='<?php echo PATH; ?>admin/add-user.html'"/></td>
                        </tr>
                </table>
        </form>
        </fieldset>
        </div>
    </div>
    <div class="content_bottom"><div class="bot_left"></div><div class="bot_center"></div><div class="bot_rgt"></div></div>
</div>






