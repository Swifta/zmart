<?php defined('SYSPATH') OR die('No direct access allowed.'); ?>
<link rel="stylesheet" type="text/css" href="<?php echo PATH ?>css/jquery.cleditor.css">
<script type="text/javascript" src="<?php echo PATH ?>js/jquery.cleditor.min.js"></script>
<div class="bread_crumb"><a href="<?php echo PATH."admin.html"; ?>" title="<?php echo $this->Lang['HOME']; ?>"><?php echo $this->Lang["HOME"]; ?> <span class="fwn">&#155;&#155;</span></a><p><?php echo $this->template->title; ?></p></div>
<div class="cont_container mt15 mt10">
    <div class="content_top"><div class="top_left"></div><div class="top_center"></div><div class="top_rgt"></div></div>
    <div class="content_middle">
        <form action="" method="post" class="admin_form">
		<?php foreach($this->cms_data as $d) { ?>
                <table>
                                <tr>
                                <td><label><?php echo $this->Lang["PAGE_TITLE"]; ?> :</label></td>
                                </tr>
                                <tr>
                                <td><input autofocus type="text" name="title" maxlength="255" value="<?php echo $d->cms_title; ?>" <?php if($d->cms_title == "Help"){ ?> readonly <?php } ?>/>
                                <em><?php if(isset($this->form_error["title"])){ echo $this->form_error["title"]; }?></em></td>
                                </tr>
                                <tr>
                                
                                <td><label><input type="radio" onclick="show_desc();" checked <?php if($d->type != 2 ) { ?> checked="unchecked" <?php } ?> name="cms_type" value="1"><?php echo $this->Lang['DESC']; ?></label>  
                                <?php if($d->cms_title != "Help"){ ?><label><input type="radio" onclick="show_url();" <?php if($d->type != 2 ) { ?> checked <?php } ?>name="cms_type" value="2" ><?php echo $this->Lang['URL']; ?></label><?php } ?></td>
                                
                                </tr>
                                <?php $style = ($d->type == 2) ? 'block': 'none'; ?>
                                <tr  class="desc" style="display:<?php echo $style; ?>"><td><label><?php echo $this->Lang["PAGE_DESC"]; ?> <span class="req">*</span> :</label><em class="desc"><?php if(isset($this->form_error["desc"])){ echo $this->form_error["desc"]; }?></em></td></tr>
                                <tr class="desc" style="display:<?php echo $style; ?>"><td align="left"><textarea name="desc" class="TextArea"><?php if($d->type == 2 ) echo $d->cms_desc; ?></textarea></td></tr>
                                <?php $style = ($d->type != 2 ) ? 'block': 'none'; ?>
                                <tr class="url" style="display:<?php echo $style; ?>"><td><label><?php echo $this->Lang["PAGE_URL"]; ?> <span class="req">*</span> :</label><em class="desc"><?php if(isset($this->form_error["url"])){ echo $this->form_error["url"]; }?></em></td></tr>
                                <tr class="url" style="display:<?php echo $style; ?>" ><td align="left"><input type="text" name="url" value="<?php if( $d->type != 2 ) echo $d->cms_desc; ?>"/></td></tr>
                                <tr>
                                <td><input type="submit" value="<?php echo $this->Lang['SUBMIT']; ?>" /><input type="button" value="<?php echo $this->Lang['CANCEL']; ?>" onclick="window.location.href='<?php echo PATH?>cms/manage-pages.html'"/></td>
                                </tr>
            </table>
		<?php } ?>
        </form>
    </div>
    <div class="content_bottom"><div class="bot_left"></div><div class="bot_center"></div><div class="bot_rgt"></div></div>
</div>
<script type="text/javascript">
	function show_desc()
	{
		$('.url').hide();
		$('.desc').show();
		$('em.desc').html('');
	}
	
	function show_url()
	{
		$('.desc').hide();
		$('.url').show();
		$('em.url').html('');
	}
</script>
