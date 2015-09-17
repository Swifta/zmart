<?php defined('SYSPATH') OR die('No direct access allowed.');?>
<div class="bread_crumb"><a href="<?php echo PATH."store-admin.html"; ?>" title="<?php echo $this->Lang['HOME']; ?>"><?php echo $this->Lang["HOME"]; ?> <span class="fwn">&#155;&#155;</span></a><p><?php echo $this->template->title; ?></p></div>
<div class="cont_container mt15 mt10">
    <div class="content_top"><div class="top_left"></div><div class="top_center"></div><div class="top_rgt"></div></div>
    <div class="content_middle">
        <?php foreach($this->data as $d){ ?>
        <form action="" method="post" class="admin_form"  enctype="multipart/form-data">
            <table>
            
                 <tr style="background-color:#ff9800;width:8px;border:1px solid black;padding:10px;"> <td></td><td><label><b><?php echo $this->Lang["PERSONALIZED"]; ?></b></label></td><td></td></tr>
                <?php foreach($this->user_details as $uu){ ?>		
			<tr>
                    <td><label><?php echo $this->Lang["SECTOR"]; ?></label></td>
                    <td>
                        <select autofocus name="sector" onchange="return merchant_change_sector(this.value);">
			    
                        <?php if($uu->store_sector_id != ''){ ?>
                        <?php if($uu->store_sector_id == 0){?>
			<option value="0" <?php if($uu->user_sector_id == 0){?> selected="selected" <?php } ?>><?php echo "Default"; ?></option> 
			<?php } ?>
                                <?php foreach($this->sector_list as $c){ 
                                if($uu->store_sector_id == $c->sector_id){ ?>
                                        <option value="<?php echo $uu->store_sector_id;?>"><?php echo $c->sector_name; ?></option> 
                                <?php } }?>
                                <?php foreach($this->sector_list as $c){ 
                                if($uu->store_sector_id != $c->sector_id){ ?>
                                        <option value="<?php echo $c->sector_id;?>"><?php echo $c->sector_name; ?></option> 
                                <?php } }?>
                        <?php } else { ?> 
                                <option value=""><?php echo $this->Lang["SELECT_SECTOR"]; ?></option>  
                        <?php foreach($this->sector_list as $c){ ?>
                                <option value="<?php echo $c->sector_id; ?>"><?php echo ucfirst($c->sector_name); ?></option>  
                        <?php } } ?>
                        </select>
                        <em><?php if(isset($this->form_error["sector"])){ echo $this->form_error["sector"]; }?></em>
					</td>
                 </tr>
                        <?php } ?>
                        
                        <tr id="subsector1">
			<td ><label><?php echo $this->Lang['SUBSECTOR']; ?> :</label></td><td>
			<select name="subsector" class="required" >
				<?php foreach($this->sub_sector_list as $s){?>
				<?php if($uu->store_sector_id==$s->main_sector_id){
						$theme_check = true;
						$theme_name = strtolower($s->sector_name);
						if(!file_exists(DOCROOT.'modules/'.$theme_name.'/controllers/'.$theme_name.'.php'))
							$theme_check = false;
						if(!file_exists(DOCROOT.'modules/'.$theme_name.'/models/'.$theme_name.'.php'))
							$theme_check = false;
						if(!file_exists(DOCROOT.'modules/'.$theme_name.'/config/routes.php'))
							$theme_check = false;
						if(!is_dir(DOCROOT.'themes/'.THEME_NAME.'/css/'.$theme_name))
							$theme_check = false;
						if(!is_dir(DOCROOT.'application/views/themes/'.THEME_NAME.'/'.$theme_name))
							$theme_check = false;
						if($theme_check==true){?>
				<option value="<?php echo $s->sector_id;?>" <?php if($uu->store_subsector_id==$s->sector_id){?>selected<?php } ?>><?php echo ucfirst($s->sector_name); ?></option>
				<?php }}} ?>
			</select>
			<em><?php if(isset($this->form_error["subsector"])){ echo $this->form_error["subsector"]; }?></em>
			
			</td></tr>
                        
               
                <tr><td><label><?php echo $this->Lang['BG_COLOR']; ?> :</label></td><td><input type="text" id="color" name="bg_color" value="<?php echo $d->bg_color; ?>" readonly /><em><?php if(isset($this->form_error["bg_color"])){ echo $this->form_error["bg_color"]; }?></em></td><td><div style="background-color:<?php echo $d->bg_color; ?>;width:8px;border:1px solid black;padding:10px;"></td></tr>
                
                <tr><td><label><?php echo $this->Lang['FONT_COLOR']; ?> :</label></td><td><input type="text" id="color" value="<?php echo $d->font_color; ?>" name="font_color" readonly /><em><?php if(isset($this->form_error["font_color"])){ echo $this->form_error["font_color"]; }?></em></td><td><div style="background-color:<?php echo $d->font_color; ?>;width:8px;border:1px solid black;padding:10px;"></td></tr>
                
                
                 <tr><td><label><?php echo $this->Lang['FONT_SIZE']; ?> :</label></td><td>
                 <select name="font_size" >
                 <option value=""><?php echo $this->Lang['SELECT_FONT_SIZE']; ?></option>
                 <?php for($i=6; $i<=40; $i++){ ?>
                 <option <?php if($d->font_size == $i){ ?> selected <?php } ?> value="<?php echo $i; ?>"><?php echo $i; ?></option>
                 <?php } ?>
                 </select>
                 <em><?php if(isset($this->form_error["font_size"])){ echo $this->form_error["font_size"]; }?></em></td><td><div style="font-size:<?php echo $d->font_size; ?>px;">Hi..!</div></td></tr>
                
                <tr style="background-color:#ff9800;width:8px;border:1px solid black;padding:10px;"> <td></td><td><label><b><?php echo $this->Lang["BANNER_1"]; ?></b></label></td></tr>
                <tr>
                <td><label><?php echo $this->Lang["BANNER_1"]; ?> :</label></td>
                <td>
                <div class = "inputs">
                <input type="file" name="banner_1" /></div>
                <em><?php if(isset($this->form_error["banner_1"])){ echo $this->form_error["banner_1"]; }?></em>
                <label><?php echo $this->Lang['IMG_UP']; ?> <?php echo $this->banner_width; ?> X <?php echo $this->banner_height; ?></label>
                </td>
                
                </tr>
                <tr>
                <td></td>
                <?php  if(file_exists(DOCROOT.'images/merchant/banner/'.$d->storeid.'_'.$d->sector_name.'_1_banner.png'))  { ?>
                <td><img border="0" src= "<?php echo PATH.'images/merchant/banner/'.$d->storeid.'_'.$d->sector_name.'_1_banner.png';?>" alt="" width="240" />
                </td>
                <?php } else { ?>
                <td><img border="0" src= "<?php echo PATH.'/images/no-images.png';?>" alt="" width="100" /></td>
                <?php } ?>
                </tr>

                <tr>
                <td><label><?php echo $this->Lang["BANNER_LINK"]; ?> :</label></td>
                <td>
                <input type="text" value="<?php echo $d->banner_1_link; ?>" name="banner_1_link"  />
                <em><?php if(isset($this->form_error["banner_1_link"])){ echo $this->form_error["banner_1_link"]; }?></em>
                </td>
                </tr>
                <tr style="background-color:#ff9800;width:8px;border:1px solid black;padding:10px;"> <td></td><td><label><b><?php echo $this->Lang["BANNER_2"]; ?></b></label></td></tr>
                <tr>
                <td><label><?php echo $this->Lang["BANNER_2"]; ?> :</label></td>
                <td>
                <div class = "inputs">
                <input type="file" name="banner_2" /></div>
                <em><?php if(isset($this->form_error["banner_2"])){ echo $this->form_error["banner_2"]; }?></em>
                <label><?php echo $this->Lang['IMG_UP']; ?> <?php echo $this->banner_width; ?> X <?php echo $this->banner_height; ?></label>
                </td>
                </tr>
                <tr>
                <td></td>
                <?php  if(file_exists(DOCROOT.'images/merchant/banner/'.$d->storeid.'_'.$d->sector_name.'_2_banner.png'))  { ?>
                <td><img border="0" src= "<?php echo PATH.'images/merchant/banner/'.$d->storeid.'_'.$d->sector_name.'_2_banner.png';?>" alt="" width="240" />
                </td>
                <?php } else { ?>
                <td><img border="0" src= "<?php echo PATH.'/images/no-images.png';?>" alt="" width="100" /></td>
                <?php } ?>
                </tr>
                
                <tr>
                <td><label><?php echo $this->Lang["BANNER_LINK"]; ?> :</label></td>
                <td>
                <input type="text" value="<?php echo $d->banner_2_link; ?>" name="banner_2_link"  />
                <em><?php if(isset($this->form_error["banner_2_link"])){ echo $this->form_error["banner_2_link"]; }?></em>
                </td>
                </tr>
                
                <tr style="background-color:#ff9800;width:8px;border:1px solid black;padding:10px;"> <td></td><td><label><b><?php echo $this->Lang["BANNER_3"]; ?></b></label></td></tr>
                <tr>
                <td><label><?php echo $this->Lang["BANNER_3"]; ?> :</label></td>
                <td>
                <div class = "inputs">
                <input type="file" name="banner_3" /></div>
                <em><?php if(isset($this->form_error["banner_3"])){ echo $this->form_error["banner_3"]; }?></em>
                <label><?php echo $this->Lang['IMG_UP']; ?> <?php echo $this->banner_width; ?> X <?php echo $this->banner_height; ?></label>
                </td>
                </tr>
                <tr>
                <td></td>
                <?php if(file_exists(DOCROOT.'images/merchant/banner/'.$d->storeid.'_'.$d->sector_name.'_3_banner.png'))  { ?>
                <td><img border="0" src= "<?php echo PATH.'images/merchant/banner/'.$d->storeid.'_'.$d->sector_name.'_3_banner.png';?>" alt="" width="240" />
                </td>
                <?php } else { ?>
                <td><img border="0" src= "<?php echo PATH.'/images/no-images.png';?>" alt="" width="100" /></td>
                <?php } ?>
                </tr>
                <tr>
                <td><label><?php echo $this->Lang["BANNER_LINK"]; ?> :</label></td>
                <td>
                <input type="text" value="<?php echo $d->banner_3_link; ?>" name="banner_3_link"  />
                <em><?php if(isset($this->form_error["banner_3_link"])){ echo $this->form_error["banner_3_link"]; }?></em>
                </td>
                </tr>

                
                <tr style="background-color:#ff9800;width:8px;border:1px solid black;padding:10px;"> <td></td><td><label><b><?php echo $this->Lang["ADS_2"]; ?></b></label></td></tr>
                 <tr>
                <td><label><?php echo $this->Lang["ADS_1"]; ?> :</label></td>
                <td>
                <div class = "inputs">
                <input type="file" name="ads_1" /></div>
                <em><?php if(isset($this->form_error["ads_1"])){ echo $this->form_error["ads_1"]; }?></em>
                <label><?php echo $this->Lang['IMG_UP']; ?> <?php echo $this->ads_width; ?> X <?php echo $this->ads_height; ?></label>
                </td>
                </tr>
                
                <tr>
                <td></td>
                 <?php  if(file_exists(DOCROOT.'images/merchant/ads/'.$d->storeid.'_'.$d->sector_name.'_1_ads.png'))  { ?>
                <td><img border="0" src= "<?php echo PATH.'images/merchant/ads/'.$d->storeid.'_'.$d->sector_name.'_1_ads.png';?>" alt="" width="240" />
                </td>
                <?php } else { ?>
                <td><img border="0" src= "<?php echo PATH.'/images/no-images.png';?>" alt="" width="100" /></td>
                <?php } ?>
                </tr>
                
                <tr>
                <td><label><?php echo $this->Lang["ADS_LINK"]; ?> :</label></td>
                <td>
                <input type="text" value="<?php echo $d->ads_1_link; ?>" name="ads_1_link"  />
                <em><?php if(isset($this->form_error["ads_1_link"])){ echo $this->form_error["ads_1_link"]; }?></em>
                </td>
                </tr>
                <tr style="background-color:#ff9800;width:8px;border:1px solid black;padding:10px;"> <td></td><td><label><b><?php echo $this->Lang["ADS_2"]; ?></b></label></td></tr>
                <tr>
                <td><label><?php echo $this->Lang["ADS_2"]; ?> :</label></td>
                <td>
                <div class = "inputs">
                <input type="file" name="ads_2" /></div>
                <em><?php if(isset($this->form_error["ads_2"])){ echo $this->form_error["ads_2"]; }?></em>
                <label><?php echo $this->Lang['IMG_UP']; ?> <?php echo $this->ads_width; ?> X <?php echo $this->ads_height; ?></label>
                </td>
                </tr>
                <tr>
                <td></td>
                 <?php  if(file_exists(DOCROOT.'images/merchant/ads/'.$d->storeid.'_'.$d->sector_name.'_2_ads.png'))  { ?>
                <td><img border="0" src= "<?php echo PATH.'images/merchant/ads/'.$d->storeid.'_'.$d->sector_name.'_2_ads.png';?>" alt="" width="240" />
                </td>
                <?php } else { ?>
                <td><img border="0" src= "<?php echo PATH.'/images/no-images.png';?>" alt="" width="100" /></td>
                <?php } ?>
                </tr>
                <tr>
                <td><label><?php echo $this->Lang["ADS_LINK"]; ?> :</label></td>
                <td>
                <input type="text" value="<?php echo $d->ads_2_link; ?>" name="ads_2_link"  />
                <em><?php if(isset($this->form_error["ads_2_link"])){ echo $this->form_error["ads_2_link"]; }?></em>
                </td>
                </tr>
                <tr style="background-color:#ff9800;width:8px;border:1px solid black;padding:10px;"> <td></td><td><label><b><?php echo $this->Lang["ADS_3"]; ?></b></label></td></tr>
                <tr>
                <td><label><?php echo $this->Lang["ADS_3"]; ?> :</label></td>
                <td>
                <div class = "inputs">
                <input type="file" name="ads_3" /></div>
                <em><?php if(isset($this->form_error["ads_3"])){ echo $this->form_error["ads_3"]; }?></em>
                <label><?php echo $this->Lang['IMG_UP']; ?> <?php echo $this->ads_width; ?> X <?php echo $this->ads_height; ?></label>
                </td>
                </tr>
                <tr>
                <td></td>
                 <?php  if(file_exists(DOCROOT.'images/merchant/ads/'.$d->storeid.'_'.$d->sector_name.'_3_ads.png'))  { ?>
                <td><img border="0" src= "<?php echo PATH.'images/merchant/ads/'.$d->storeid.'_'.$d->sector_name.'_3_ads.png';?>" alt="" width="240" />
                </td>
                <?php } else { ?>
                <td><img border="0" src= "<?php echo PATH.'/images/no-images.png';?>" alt="" width="100" /></td>
                <?php } ?>
                </tr>
                <tr>
                <td><label><?php echo $this->Lang["ADS_LINK"]; ?> :</label></td>
                <td>
                <input type="text" value="<?php echo $d->ads_3_link; ?>" name="ads_3_link"  />
                <em><?php if(isset($this->form_error["ads_3_link"])){ echo $this->form_error["ads_3_link"]; }?></em>
                </td>
                </tr>
                
                <tr><td><input type="submit" value="<?php echo $this->Lang['SUBMIT']; ?>" /><input type="reset" value="<?php echo $this->Lang['RESET']; ?>" onclick="javascript:window.location='<?php echo PATH; ?>store-admin.html'"/></td></tr>
                

            </table>
        </form>
        <?php } ?>
    </div>
    <div class="content_bottom"><div class="bot_left"></div><div class="bot_center"></div><div class="bot_rgt"></div></div>
</div>
<link rel="stylesheet" href="<?php echo PATH; ?>css/simple-color-picker.css" type="text/css" />

<script type="text/javascript" src="<?php echo PATH; ?>js/simple-color-picker.js"></script>
<script type="text/javascript">
$(document).ready(function() {
    $('input#color').simpleColorPicker();
    $('input#color2').simpleColorPicker({ colorsPerLine: 16 });
    var colors = ['#000000', '#444444', '#666666', '#999999', '#cccccc', '#eeeeee', '#f3f3f3', '#ffffff'];
    $('input#color3').simpleColorPicker({ colors: colors });
    $('input#color4').simpleColorPicker({ showEffect: 'fade', hideEffect: 'slide' });
    $('button#color5').simpleColorPicker({ onChangeColor: function(color) { $('label#color-result').text(color); } });
});
</script>
