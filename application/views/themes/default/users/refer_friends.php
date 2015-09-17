<script type="text/javascript"> 
    function select_all()
    {
        var text_val=eval("document.form1.user_referral_url");
        text_val.focus();
        text_val.select();
    }
</script>  
<div class="contianer_outer1">
    <div class="contianer_inner">
        <div class="contianer">
            <div class="bread_crumb">
                <ul>
                    <li><p><a href="<?php echo PATH; ?>" title="<?php echo $this->Lang['HOME']; ?>"><?php echo $this->Lang['HOME']; ?></a></p></li>
                    <li><p><?php echo $this->Lang['REF_FRD']; ?></li>
                </ul>
            </div>
            <!--content start-->
            <div class="content_abouts">
                <div class="content_abou_common">
                     <div class="pro_top5">
                                                                      <div class="common_ner_commont1">
<div class="common_ner_commont"> 
                    <h2><?php echo $this->Lang['REF_FRD']; ?></h2>
</div>
                                                                      </div>
                     </div>
                    <div class="refer_frient_top">

                        <div class="refer_left">   </div>
                        <div class="refer_middle">

                            <h1><?php echo $this->Lang['REFER_A_FRIEND']; ?> <?php echo CURRENCY_SYMBOL .' '. REFERRAL_AMOUNT; ?> in<span class="colorC8161D"> <?php echo SITENAME; ?></span> <?php echo $this->Lang['BUCKS']; ?>! </h1>
                            <h2><?php echo $this->Lang['YOU_CAN_EARN']; ?> <?php echo CURRENCY_SYMBOL .' '. REFERRAL_AMOUNT; ?> <?php echo $this->Lang['IN_UniEcommerce_BUCKS']; ?> </h2>
                            <?php if (count($this->users_details) > 0) { ?>
                                <?php foreach ($this->users_details as $details) { ?>
                                    <div class="refer_social_links">


                                        <div class="ref_link"> 
                                            <span> &nbsp;</span>
                                            <p><?php echo $this->Lang['YOUR_PERSONAL']; ?>  </p>



                                        </div>
                                        <a  href="mailto:?body=<?php echo $this->Lang['MAILTO']; ?>  http=<?php echo PATH; ?>referral/<?php echo $details->referral_id; ?>&amp;subject=<?php echo $this->Lang['SUB']; ?>">
                                            <div class="ref_mail_it"> 
                                                <span>&nbsp;</span>
                                                <p><?php echo $this->Lang['MAIL_IT']; ?>  </p>

                                            </div></a>
                                              <a href="http://www.linkedin.com/shareArticle?mini=true&url=<?php echo PATH; ?>referral/<?php echo $details->referral_id; ?> &title=Create an Uniecommerce account here  -  &summary=Create an Uniecommerce account here  -">
                                           <div class="ref_link_it">
                                               <span> </span>
                                               <p><?php echo $this->Lang['LINK_IN']; ?></p>
                                           </div>
                                       </a>
                                        <a href="http://facebook.com/share.php?u=<?php echo PATH; ?>referral/<?php echo $details->referral_id; ?>" rel="skip_external">
                                            <div class="ref_facebook">
                                                <span>&nbsp;</span>
                                                <p> <?php echo $this->Lang['SHARE_IT_ON']; ?> </p>                                         

                                            </div></a>
                                        <a href="http://twitter.com/share?url=<?php echo PATH; ?>referral/<?php echo $details->referral_id; ?>&amp;text=Create an Uniecommerce account here  - ">
                                            <div class="ref_tweet_it">
                                                <span>&nbsp;</span>
                                                <p><?php echo $this->Lang['TWEET_IT']; ?></p>
                                            </div>
                                        </a>
                                        <div class="text_after">
                                            <form name="form1">
                                                <div class="ref_link_input1"> 
                                                    <input class="auto_select text G_event E-Share_Link_ReferPage" onclick="select_all();" id="user_referral_url" name="user_referral_url" size="40"  readonly="readonly" type="text" value="<?php echo PATH; ?>referral/<?php echo $details->referral_id; ?>" autofocus />

                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                <?php }
                            } else { ?>
                                <h3> <a onclick="javascript:showlogin();" title="<?php echo $this->Lang['SIGN_IN']; ?>" class="color9A0F33" style="cursor:pointer"><?php echo $this->Lang['SIGN_IN']; ?> </a><?php echo $this->Lang['OR']; ?> <a onclick="showsignup();" title="<?php echo $this->Lang['SET_UP']; ?> " class="color9A0F33" style="cursor:pointer"><?php echo $this->Lang['SET_UP']; ?> </a> <?php echo $this->Lang['TO_GET_YOUR']; ?> </h3>
<?php } ?> 
                        </div>

                        <div class="refer_right">  </div>

                    </div>
                    <div class="refer_friend_midd">
                        <div class="refer_frd_box">
                            <h1><?php echo $this->Lang['WHAT_THIS']; ?>  </h1>
                            <p><?php echo $this->Lang['YOU_CAN_EARN']; ?> <?php echo CURRENCY_SYMBOL .' '. REFERRAL_AMOUNT; ?> <?php echo $this->Lang['IN_CART_DELAS']; ?> </p>
                        </div>
                        <div class="refer_frd_box">
                            <h1><?php echo $this->Lang['HOW_DO_I']; ?> </h1>
                            <p><?php echo $this->Lang['USE_THE_TOOLS']; ?> <?php echo CURRENCY_SYMBOL .' '. REFERRAL_AMOUNT; ?> <?php echo $this->Lang['OR_MORE_YOU']; ?> <?php echo CURRENCY_SYMBOL .' '. REFERRAL_AMOUNT; ?> <?php echo $this->Lang['IN_CART_ORDER']; ?></p>
                        </div>
                        <div class="refer_frd_box1">
                            <h1><?php echo $this->Lang['WHEN_WILL_I']; ?> </h1>
                            <p><?php echo $this->Lang['ONCE_WE_CONFIRM']; ?><?php echo CURRENCY_SYMBOL .' '. REFERRAL_AMOUNT; ?> <?php echo $this->Lang['IN_YOUR_ACCOUNT']; ?> </p>
                        </div>
                    </div>


                </div>  

            </div>
            <!--end-->
        </div>
    </div>
</div>
