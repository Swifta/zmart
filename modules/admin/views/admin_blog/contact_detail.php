<div class="bread_crumb"><a href="<?php echo PATH.'admin.html'; ?>" title="<?php echo $this->Lang['HOME']; ?>"><?php echo $this->Lang["HOME"]; ?> <span class="fwn">&#155;&#155;</span></a><p><?php echo $this->template->title; ?></p></div>
<div class="cont_container mt15 mt10">
    <div class="content_top"><div class="top_left"></div><div class="top_center"></div><div class="top_rgt"></div></div>
    <div class="content_middle">
    <?php foreach($this->contact_us as $u){
            if($u->name != 'admin'){ 
                $name = ucfirst($u->name);
                $email = $u->email;
                $phone = $u->phone_number;
                $qurey = $u->message; }
            if($u->name == 'admin')$reply = $u->message;} ?>
        <table class="list_table fl clr mt15">
                <tr><th width="20%" ><?php echo $this->Lang["NAME"]; ?> :</th><td><?php echo $name; ?></td></tr>
                <tr><th width="20%" ><?php echo $this->Lang["EMAIL_F"]; ?> :</th><td><?php echo $email; ?></td></tr>
                <tr><th width="20%" ><?php echo $this->Lang["MOBILE"]; ?> :</th><td><?php echo $phone; ?></td></tr>
                <tr><th width="20%"><?php echo $this->Lang['INQUIRIES']; ?> :</th><td align="left"><?php echo $qurey; ?></td></tr>
                <tr><th width="20%"><?php echo $this->Lang['RPL_ADMIN']; ?> :</th><td align="left"><?php echo $reply; ?></td></tr>
        </table>
    </div>
    <div class="content_bottom"><div class="bot_left"></div><div class="bot_center"></div><div class="bot_rgt"></div></div>
</div></div>
<a style="float:right; padding:20px;" href="<?php echo PATH;?>admin/inquiries.html"><?php echo $this->Lang['BACK']; ?></a>
