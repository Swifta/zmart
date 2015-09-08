<?php defined('SYSPATH') OR die('No direct access allowed.'); ?>

<div class="bread_crumb"><a href="<?php echo PATH."admin.html"; ?>" title="<?php echo $this->Lang['HOME']; ?>"><?php echo $this->Lang["HOME"]; ?> <span class="fwn">&#155;&#155;</span></a><p><?php echo $this->template->title; ?></p></div>
<div class="cont_container mt15 mt10">
    <div class="content_top"><div class="top_left"></div><div class="top_center"></div><div class="top_rgt"></div></div>
    <div class="content_middle">
        <form action="" name="subsector_form" id="subsector_form" method="post" class="admin_form" enctype="multipart/form-data"  >
            <table>
                <?php foreach($this->sector_data as $c){ ?>
                

					<tr>
                    <td><label><?php echo $this->main_cat; ?></label></td>
                    <td><label>:</label></td>
                    <td><input type="text" name="main_category" readonly value="<?php echo $c->sector_name ?>" title="<?php echo $this->Lang['SECTOR_NAME']; ?>" />
                </tr>
					 <tr>
                    <td><label><?php echo $this->sub_cat; ?></label></td>
                    <td><label>:</label></td>
                    <td>
				<input name="subsector" type="text" --id="demo-input-facebook-theme" value="" maxlength="100" title="<?php echo $this->Lang['SUB_SECTOR_NAME']; ?>" value="<?php if(!isset($this->form_error['subsector']) && isset($this->userPost['subsector'])){ echo $this->userPost['subsector']; }?>" /> 
                    <em id="subsector_error"><?php if(isset($this->form_error["subsector"])){ echo $this->form_error["subsector"]; }?></em></td>
		 <label for="demo-input-facebook-theme" generated="true" id="subsector_txt" class="errorvalid" style="display: none;"><?php echo $this->Lang["SUB_SECTOR_NAME"];?></label>
                </tr>
                <?php /*<tr>
                    <td><label>Category Mapping</label></td>
                    <td><label>:</label></td>
                    <td><textarea name="m_category"></textarea>
                    </td>
                </tr> */?>

                   <tr>
                    <td><label><?php echo $this->Lang["UPLOAD_ZIPFILE"]; ?></label></td>
                    <td><label>:</label></td>
                    <td><input type="file"  id="zip_file" name="zip_file" /> 
			<em id="error_zipfile" ><?php if(isset($this->form_error["zip_file"])){ echo $this->form_error["zip_file"]; } ?></em>
                    </td>
                </tr>


                   <tr>
                    <td><label><?php echo $this->Lang["SECTOR_STATUS"]; ?></label></td>
                    <td><label>:</label></td>
                    <td><input  type="radio"  name="status" checked="checked" title="<?php echo $this->Lang['ACTIVE']; ?>"  value="1"/> <?php echo $this->Lang["ACTIVE"]; ?> <input  type="radio" name="status" title="<?php echo $this->Lang['DEACTIVE']; ?>"  value="0" /> <?php echo $this->Lang["DEACTIVE"]; ?>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td><input type="hidden" name="sub_sectorid" id="sub_sectorid" > <input type="button" value="<?php echo $this->Lang['SUBMIT']; ?>"  onclick="return subsector_form_validate();" /><input type="reset" value="<?php echo $this->Lang['RESET']; ?>"/></td>
                </tr>
    <?php } ?>
            </table>
        </form>
    </div>
    <div class="content_bottom"><div class="bot_left"></div><div class="bot_center"></div><div class="bot_rgt"></div></div>
</div>

<script>

$('#zip_file').bind('change', function() {

    if(this.files[0].type =='application/zip' )	
    {	    }
    else
    {
	$('#zip_file').val('');
	alert('Upload document file format in zip');
	return
    }
    if(this.files[0].size >= 1024000) { // 10 MB (this size is in bytes)
	$('#zip_file').val('');
	alert('Upload file size should be less than 1MB');
    }
});


function subsector_form_validate()
{
	var form_valid = 0;
	var main_category = document.subsector_form.main_category.value;	
	var subsector_name = document.subsector_form.subsector.value;	

	if(subsector_name =='' )
	{
		$("#subsector_error").html('Please enter the sector Theme Name');
		form_valid = 1;
	}
	if( document.getElementById("zip_file").files.length == 0 ){
		$("#error_zipfile").html('Please upload the zipfile');
		form_valid = 1;
	}

	if(form_valid == 1)
	{
		return false;
	}
	else {
		document.getElementById("subsector_form").submit();
	}

}
</script>
<style>
	.errorvalid{margin-top:10px;}
</style>
