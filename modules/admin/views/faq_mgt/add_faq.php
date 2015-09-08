<?php defined('SYSPATH') OR die('No direct access allowed.'); ?>
<div class="bread_crumb"><a href="<?php echo PATH."admin.html"; ?>" title="<?php echo $this->Lang['HOME']; ?>"><?php echo $this->Lang["HOME"]; ?> <span class="fwn">&#155;&#155;</span></a><p><?php echo $this->template->title; ?></p></div>
<div class="cont_container mt15 mt10">
    <div class="content_top"><div class="top_left"></div><div class="top_center"></div><div class="top_rgt"></div></div>
    <div class="content_middle">
        <form method="post"  class="admin_form">
                <table>
                        <tr>
                            <td><label><?php echo $this->Lang['ETR_QUES']; ?></label><span class="req">*</span> </td>
                            <td><label>:</label></td>
		            <td><input type="text" name="add_qus" maxlength="150" value="<?php if(!isset($this->form_error['add_qus']) && isset($this->userPost['add_qus'])){ echo $this->userPost['add_qus']; } ?>" autofocus />
					<em><?php if(isset($this->form_error["add_qus"])){ echo $this->form_error["add_qus"]; }?>
					</em>	
                            </td>
                        </tr>
                        <tr>
                            <td><label><?php echo $this->Lang['ETR_ANS']; ?></label><span class="req">*</span> </td>
                            <td><label>:</label></td>
		            <td><textarea class="TextArea" name="answer" cols=15 rows=15 /><?php if(!isset($this->form_error['answer']) && isset($this->userPost['answer'])){ echo $this->userPost['answer']; } ?></textarea>
		                 <em><?php if(isset($this->form_error['answer'])){ echo $this->form_error["answer"]; }?></em>
			    </td>
                        </tr>
                        <tr>
                             <td></td>
                             <td></td>
                             <td><input type="submit" value="<?php echo $this->Lang['SUBMIT']; ?>" />
				 <input type="reset" value="<?php echo $this->Lang['RESET']; ?>" onclick="javascript:window.location='<?php echo PATH; ?>faq_mgt/add_faq.html'" />
			     </td>
                        </tr>
                </table>
        </form>
    </div>
    <div class="content_bottom"><div class="bot_left"></div><div class="bot_center"></div><div class="bot_rgt"></div></div>
</div>
