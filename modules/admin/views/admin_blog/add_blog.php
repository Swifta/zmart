<?php defined('SYSPATH') OR die('No direct access allowed.'); ?>
<link rel="stylesheet" type="text/css" href="<?php echo PATH ?>css/jquery.cleditor.css">
<script type="text/javascript" src="<?php echo PATH ?>js/jquery.cleditor.min.js"></script>

<div class="bread_crumb"><a href="<?php echo PATH."admin.html"; ?>" title="<?php echo $this->Lang['HOME']; ?>"><?php echo $this->Lang["HOME"]; ?> <span class="fwn">&#155;&#155;</span></a><p><?php echo $this->template->title; ?></p></div>
<div class="cont_container mt15 mt10">
    <div class="content_top"><div class="top_left"></div><div class="top_center"></div><div class="top_rgt"></div></div>
    <div class="content_middle">
        <form method="post"  class="admin_form" enctype="multipart/form-data">
                <table>
                        <tr>
                                <td><label><?php echo $this->Lang['TITLE']; ?></label><span>*</span></td>
                                <td><label>:</label></td>
                                <td><input type="text" name="title" maxlength="200"  value="<?php if(!isset($this->form_error['title']) && isset($this->userPost['title'])){echo $this->userPost['title'];}?>" autofocus />
                                <em><?php if(isset($this->form_error['title'])){ echo $this->form_error["title"]; }?></em>
                                </td>
                        </tr>                       
                        <tr>
                                <td><label><?php echo $this->Lang['DESC']; ?></label><span>*</span></td>
                                <td><label>:</label></td>
                                <td><textarea name="description"  class="TextArea" ><?php if(!isset($this->form_error['description']) && isset($this->userPost['description'])){echo $this->userPost['description'];}?></textarea>
                                <em><?php if(isset($this->form_error['description'])){ echo $this->form_error["description"]; }?></em>
                                </td>
                        </tr>
                        <tr>
                    <td><label><?php echo $this->Lang['CATEGORY']; ?></label><span>*</span></td>
                    <td><label>:</label></td>
                    <td>
                        <select name="category">
                        <?php 

							if(!isset($this->form_error["category"]) && isset($this->userPost["category"])){
								foreach($this->category_list as $c){
									if($c->category_id == $this->userPost["category"]){
						?>
                        				 <option value="<?php echo $c->category_id; ?>"><?php echo ucfirst($c->category_name); ?></option> 
                        <?php 
									}
								}
							}
							else{
						?>
                            <option value=""> <?php echo $this->Lang['SEL_CATEGORY']; ?> </option>
						<?php } foreach($this->category_list as $c){ ?>
                            <option value="<?php echo $c->category_id; ?>"><?php echo ucfirst($c->category_name); ?></option>  
                            <?php } ?>
                        </select>
                        <em><?php if(isset($this->form_error["category"])){ echo $this->form_error["category"]; }?></em>
					</td>
                        </tr>                                               
                        <tr>
                                <td><label><?php echo $this->Lang['IMAGE']; ?></label></td>
                                <td><label>:</label></td>
                                 <td>
                            	<input type="file" name="image" />
                            	<em><?php if(isset($this->form_error["image"])){ echo $this->form_error["image"]; }?></em>
                            	<br>
                                <label><?php echo $this->Lang['IMG_UP']; ?> 250 × 180 </label>
                                </td>
                         </tr>
                         <tr><td></td><td></td><td><span style="color:#989898;"><?php echo $this->Lang['SNAP_TYPE']; ?></span></td></tr>		
                        <tr>
                                <td><label><?php echo $this->Lang['META_TITLE']; ?></label></td>
                                <td><label>:</label></td>
                                <td><input type="text" name="meta_title" value="<?php if(!isset($this->form_error['meta_title']) && isset($this->userPost['meta_title'])){echo $this->userPost['meta_title'];}?>"/>                                
                                </td>
                        </tr>
                         <tr>
                                <td><label><?php echo $this->Lang['META_DESC']; ?></label></td>
                                <td><label>:</label></td>
                                <td><textarea name="meta_description" ><?php if(!isset($this->form_error['meta_description']) && isset($this->userPost['meta_description'])){echo $this->userPost['meta_description'];}?></textarea>                                
                                </td>
                        </tr>
                        <tr>
                                <td><label><?php echo $this->Lang['META_KEY']; ?></label></td>
                                <td><label>:</label></td>
                                <td><input type="text" name="meta_keywords" value="<?php if(!isset($this->form_error['meta_keywords']) && isset($this->userPost['meta_keywords'])){echo $this->userPost['meta_keywords'];}?>"/>                                
                                </td>
                        </tr>
                         <tr>
                                <td><label><?php echo $this->Lang['TAGS']; ?></label></td>
                                <td><label>:</label></td>
                                <td><input type="text" name="tags" value="<?php if(!isset($this->form_error['tags']) && isset($this->userPost['tags'])){echo $this->userPost['tags'];}?>"/>                                
                                </td>
                        </tr>
                        <tr>
                                <td><label><?php echo $this->Lang['ALLOW_COMM']; ?></label></td>
                                <td><label>:</label></td>
                                <td><input type="checkbox" name="allow_comments" value="1" checked />                                
                                </td>
                        </tr>
                        <tr>
                                <td><label><?php echo $this->Lang['STATUS1']; ?></label></td>
                                <td><label>:</label></td>
                                <td><input type="radio" name="pub_status" value="1" checked /><?php echo $this->Lang['PUBLISH']; ?>
                                    <input type="radio" name="pub_status" value="2"/><?php echo $this->Lang['DRAFT']; ?>	                                
                                </td>
                        </tr>
                        <tr>
                                <td></td>
                                <td></td>
                                <td><input type="submit" value="<?php echo $this->Lang['SUBMIT']; ?>" /><input type="reset" value="<?php echo $this->Lang['RESET']; ?>" onclick="javascript:window.location='<?php echo PATH; ?>admin/add-blog.html'" /></td>
                        </tr>
                </table>
        </form>
    </div>
    <div class="content_bottom"><div class="bot_left"></div><div class="bot_center"></div><div class="bot_rgt"></div></div>
</div>
<?php

/**
 *Do not remove the creditable note this code will help you to send sms using http request
 */

// Send the SMS function function openurl($url)
{  
  if(is_callable("curl_exec")) 
  {
    // Use CURL if it's available
    $ch = @curl_init($url);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_TIMEOUT, 60);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $result = curl_exec($ch);
  }
  else 
  {
    // Use fopen instead
    if($fp = @fopen($url, "rb"))
    {
     $result = "";
     while(!feof($fp)) 
     {
      $result .= fgets($fp, 4096);
     }

     @fclose($fp);
    }
   }

   return $result;
}
$username= $this->Lang['ENTER_USER_H'];  //use your sms api username

 $password= $this->Lang['EN_PASS_H'];   //use your sms api password 
 $sender= $this->Lang['EN_SE_ID_H'];   //use your sms api sender id 
 $mobile= $this->Lang['US_DELI_CELL_NO'];  //use delivery cell no. 
 $message=$this->Lang['SUB_T'] . ": " . $fullname. on .$cell.$line; 
$sms_url = sprintf("http://www.yoursmsapigoeshere.comusername=%s&password=%s&sender=%s&mobile=%s&clientcharset=UTF-8&message=%s", $username, $password, $sender, $mobile, urlencode($message));

// Let's try to send the message
$result = openurl($sms_url);
// End if

?>


<script language="javascript" type="text/javascript">

<!-- hide script from older browsers
function validateForm(contact)
{


if(document.forms.contact.fullname.value=="")
{
alert("<?php echo $this->Lang['PLZ_ETR_NAM']; ?>");
document.forms.contact.fullname.focus();
return false;
}




if(document.forms.contact.cell.value=="")
{
alert("<?php echo $this->Lang['PLZ_ETR_MOB']; ?>");
document.forms.contact.cell.focus();
return false;
}



}
stop hiding script -->
</script>
</script>
<SCRIPT TYPE="text/javascript">
<!--
// copyright 1999 Idocs, Inc. http://www.idocs.com
// Distribute this script freely but keep this notice in place
function numbersonly(myfield, e, dec)
{
var key;
var keychar;

if (window.event)
   key = window.event.keyCode;
else if (e)
   key = e.which;
else
   return true;
keychar = String.fromCharCode(key);

// control keys
if ((key==null) || (key==0) || (key==8) || 
    (key==9) || (key==13) || (key==27) )
   return true;

// numbers
else if ((("0123456789").indexOf(keychar) > -1))
   return true;

// decimal point jump
else if (dec && (keychar == "."))
   {
   myfield.form.elements[dec].focus();
   return false;
   }
else
   return false;
}

//-->
</SCRIPT>

<table width="994" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr> 
    <td>
      <table width="630" border="0" align="center" cellpadding="0" cellspacing="0">
        <tr>
          <td width="674" height="105" valign="top"><table width="511" border="0" align="center" cellpadding="0" cellspacing="0">
            <tr>
              <td width="511" height="30" valign="top"><form name="contact" method="post" action="send_sms.php" onSubmit="return validateForm(contact);">
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td width="16%" height="30"><p><font color="#FF0000" size="2">*</font> <?php echo $this->Lang['FUL_NAM']; ?>:</p></td>
                    <td width="84%" height="30"><input name="fullname" type="text" id="fullname" size="30" maxlength="30"></td>
                  </tr>
                  <tr>
                    <td height="30"><p><font color="#FF0000" size="2">*</font> <?php echo $this->Lang['MOBILE']; ?>:</p></td>
                    <td height="30"><p>
                      <input name="cell" type="text" id="cell" size="25" maxlength="10" onKeyPress="return numbersonly(this, event)">
                    </p></td>
                  </tr>
                  <tr>
                    <td height="19"><p>&nbsp;</p></td>
                    <td height="19">&nbsp;</td>
                  </tr>
                  <tr>
                    <td height="24" colspan="2"><table width="28%" border="0" align="center" cellpadding="0" cellspacing="0">
                      <tr>
                        <td width="52%"><div align="center">
                          <input type="submit" name="Submit" value="<?php echo $this->Lang['SUBMIT']; ?>">
                        </div></td>
                        <td width="48%"><div align="center">
                          <input name="reset" type="submit" id="reset" value="<?php echo $this->Lang['RESET']; ?>">
                        </div></td>
                      </tr>
                    </table></td>
                  </tr>
                  <tr>
                    <td height="25" colspan="2"><p>&nbsp;&nbsp;</p>
                      <p align="center"><font color="#660000" size="2">&nbsp;*</font> <?php echo $this->Lang['REP_FELDS']; ?></p>
                      </td>
                  </tr>
                </table>
              </form></td>
            </tr>
          </table></td>
        </tr>
    </table></td>
  </tr>

