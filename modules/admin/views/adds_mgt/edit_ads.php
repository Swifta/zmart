<?php defined('SYSPATH') OR die('No direct access allowed.'); ?>

<div class="bread_crumb"><a href="<?php echo PATH.'admin.html'; ?>" title="<?php echo $this->Lang['HOME']; ?>"><?php echo $this->Lang["HOME"]; ?> <span class="fwn">&#155;&#155;</span></a><p><?php echo $this->template->title; ?></p></div>
<div class="cont_container mt15 mt10">
    <div class="content_top"><div class="top_left"></div><div class="top_center"></div><div class="top_rgt"></div></div>
    <div class="content_middle">

       <?php foreach($this->get_record as $ads){ ?>
        <form action="" method="post" class="admin_form" enctype="multipart/form-data">
            <table>
		<tr>
				<td><label><?php echo $this->Lang["ADD_TITLE"]; ?>:</label></td>
			<td><input type="text" name="ad_title" autofocus value="<?php echo $ads->ads_title; ?>"><em><?php if(isset($this->form_error["ad_title"])){ echo $this->form_error["ad_title"]; }?></em></td>
		</tr>
<tr>
                    <td><label><?php echo $this->Lang['PAGE']; ?>*</label></td>
                    
                    <td>
                    	<select name="pages"  id="pages" onchange="show_ads_position()">
							
							<option value=""><?php echo $this->Lang['SEL_PAGE']; ?></option>
							<option value="1"<?php if($ads->page_position=="1") { ?> selected="selected" <?php } ?> ><?php echo $this->Lang['HOME']; ?></option>
							<option value="2"<?php if($ads->page_position=="2")  { ?> selected="selected" <?php } ?> ><?php echo $this->Lang['DEALS']; ?></option>
							<option value="3"<?php if($ads->page_position=="3")  { ?> selected="selected" <?php } ?> ><?php echo $this->Lang['PRODUCT']; ?></option>
							<option value="4"<?php if($ads->page_position=="4") { ?> selected="selected" <?php } ?> ><?php echo $this->Lang['AUCTION']; ?></option>
							
                    	</select>
                    	<em><?php if(isset($this->form_error["pages"])){ echo $this->form_error["pages"]; }?></em>
                    </td>
                </tr>
                <tr>
        	<td><label><?php echo $this->Lang["ADS_POSITION"]; ?> :</label></td>
            <td>
                <select name="ads_position" id="ads_position" onchange="mychange(this.value)">
                <?php
                $ads_position = Kohana::config('settings');
                if($ads->page_position==1)
					$ads_list = $ads_position["ads_position"];
				else
					$ads_list = $ads_position["ads_position_1"];
                foreach($ads_list as $index => $position){ ?>
                <option value="<?php echo $index; ?>" <?php if($ads->ads_position == $index){ echo "selected='selected'"; }?>><?php echo $position;?></option>
                <?php } ?>
                </select>
                <em><?php if(isset($this->form_error["ads_position"])){ echo $this->form_error["ads_position"]; }?></em>
            </td>
        </tr>
	<?php /*	<tr>
			<td valign="top"><label><?php echo $this->Lang["ADD_CODE"]; ?>:</label></td>
			<td align="left"><textarea cols="20" rows="8" name="ad_code"><?php echo $ads->ads_code; ?></textarea><em><?php if(isset($this->form_error["ad_code"])){ echo $this->form_error["ad_code"]; }?></em></td>
			</tr>
		<tr> */ ?>
		
                <tr>
                    <td><label><?php echo $this->Lang['REDIRECT'];  ?>*</label></td>
                    
                    <td>
                    	<input type="text" name="redirect_url" value="<?php echo $ads->redirect_url; ?>" />
                    	<em><?php if(isset($this->form_error["redirect_url"])){ echo $this->form_error["redirect_url"]; }?></em>
                    </td>
                </tr>
                 <tr>
              <td><label><?php echo $this->Lang['UPLOAD']; ?>* </label></td>
              
              <td>
                  	<input type="file" name="image" /><label id="show_size" >
                                <?php if($ads->ads_position =='hr') { echo 'Image upload size 350px x 250px';
                                } else if($ads->ads_position =='ls') { echo 'Image upload size 180px x 500px';
                                }else if($ads->ads_position =='bf') { echo 'Image upload size 790px x 100px';
                                } ?>
                  	
                  	</label>
                   	<em><?php if(isset($this->form_error["image"])){ echo $this->form_error["image"]; }?></em>
              </td>
                </tr>
                <tr>
					
                    <td></td>
					<td align="left"><img border="0" src= "<?php echo PATH.'images/ad_image/'.$ads->ads_id.'.png';?>" alt="" width="80" /></td>
				</tr>
                <td></td>        <td><input type="submit" value="<?php echo $this->Lang['SUBMIT']; ?>" /><input type="button" value="<?php echo $this->Lang['CANCEL']; ?>" onclick="window.location.href='<?php echo PATH?>adds_mgmt/manage_adds.html'"/></td>
                </tr>
            </table>
        </form>
        <?php } ?>
    </div>
    <div class="content_bottom"><div class="bot_left"></div><div class="bot_center"></div><div class="bot_rgt"></div></div>
</div>


<script>
function show_ads_position(){
	var page=$('#pages').val();
	$.post(SrcPath+'/ads/show_ads_position/'+page, { 
	}, function(response){ 
		$('#ads_position').html(response);
		mychange('');
	});
}
function mychange(a)
{ 
	$('label#show_size').hide();
	if(a =='hr') { $('label#show_size').html('Image upload size 350px x 250px');
		$('label#show_size').show();
	} else if(a =='hr1' || a =='hr2' || a == 'rs1' || a == 'rs2') { $('label#show_size').html('Image upload size 196px x 168px');
		$('label#show_size').show();
	} else if(a =='hs1' || a =='hs2' || a =='hs3' || a =='hs4' || a =='hs5' || a =='hs6' || a =='hs7') { $('label#show_size').html('Image upload size 197px x 359px');
		$('label#show_size').show();
	} else if(a =='hc1' || a =='hc2') { $('label#show_size').html('Image upload size 553px x 118px');
		$('label#show_size').show();
	} else if(a =='hb1') { $('label#show_size').html('Image upload size 1120px x 110px');
		$('label#show_size').show();
	} else if(a =='hb2') { $('label#show_size').html('Image upload size 1120px x 280px');
		$('label#show_size').show();
	}
}
</script>
