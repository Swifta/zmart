<?php defined('SYSPATH') OR die('No direct access allowed.'); ?>
<link rel="stylesheet" type="text/css" href="<?php echo PATH ?>css/jquery.cleditor.css">
<script type="text/javascript" src="<?php echo PATH ?>js/jquery.cleditor.min.js"></script>

<div class="bread_crumb"><a href="<?php echo PATH.'admin.html';?>" title="<?php echo $this->Lang['HOME']; ?>"><?php echo $this->Lang["HOME"]; ?><span class="fwn">&#155;&#155;</span></a><p><?php echo $this->template->title;?></p></div>
<div class="cont_container mt15 mt10">
    <div class="content_top"><div class="top_left"></div><div class="top_center"></div><div class="top_rgt"></div></div>
    <div class="content_middle">
    <?php foreach($this->con_in as $d){?>
        <form action="" method="post" class="admin_form">
            <table>
                <tr><td><label style="float:left;"><?php echo $this->Lang["CUS_INQ"]; ?> :</label></td><td style="background-color:#FFF;"><?php echo $d->message; ?></td></tr>
                <tr><td><label style="float:left;"><?php echo $this->Lang["REP_TO"]; ?> :</label></td><td><input readonly type="text" name="email" value="<?php echo $d->email; ?>"/></td></tr>
                <tr><td><label style="float:left;"><?php echo $this->Lang["SUBJECT"]; ?> :</label></td><td><input type="text" name="sub" value="<?php echo $this->Lang['RE_ABT_INQ']; ?>" /></td></tr>
            </table>
            <table>
                <tr><td><label><?php echo $this->Lang["SOLUTION"]; ?> :</label></td></tr>
                <tr><td align="left"><textarea name="solution" class="TextArea"></textarea></td></tr>
                <tr><td><input type="submit" value="<?php echo $this->Lang['SUBMIT']; ?>" /><input type="button" value="<?php echo $this->Lang['BACK']; ?>" onclick="window.location.href='<?php echo PATH?>admin/inquiries.html'"/></td></tr>
            </table>
        </form>
        <?php } ?>
    </div>
    <div class="content_bottom"><div class="bot_left"></div><div class="bot_center"></div><div class="bot_rgt"></div></div>
</div>
