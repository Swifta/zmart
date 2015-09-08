<?php defined('SYSPATH') OR die('No direct access allowed.'); ?>
<?php
foreach ($this->transaction_details as $tran) {
    if (file_exists(DOCROOT . 'images/auction/466_347/' . $tran->deal_key . '_1' . '.png')) {
        $image = PATH . 'images/auction/466_347/' . $tran->deal_key . '_1' . '.png';
    } else {
        $image = PATH . "themes/" . THEME_NAME . "/images/noimage_deals_list.png";
    }
    $end_time = $tran->end_time + (AUCTION_ALERT_DAY * 24 * 60 * 60);
    ?>
    <!DOCTYPE html>
    <html lang="en" class="demo-1">
        <head>
            <meta charset="UTF-8" />
        </head>
        <body>
            <table cellspacing="0" cellpadding="0" border="0" width="700" style=" background:#fff; width:700px; border:  1px solid #ccc;">
                <tr>
                    <td>
                        <table cellspacing="0" cellpadding="0" border="0" style=" width:680px; margin:0 0 0 9px;">
                            <tr>
                                <td>
                                    <table cellspacing="0" cellpadding="0" border="0" >
                                        <tr>				
                                            <td style=" width:544px;margin:0px; padding:0px; height:2px;">
                                                <div style="width:116px; margin:0px; padding:0px;  height:2px;">&nbsp;</div>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <table cellspacing="0" cellpadding="0" border="0">
                                        <tr style="height:16px;"></tr>
                                        <tr>
                                            <td style="margin:0px; padding:0px; width: 497px; vertical-align: top; ">
                                                <a href="<?php echo PATH; ?>" title="<?php echo SITENAME; ?>"><img src="<?php echo PATH;?>themes/<?php echo THEME_NAME; ?>/images/logo.png" border="0" alt="" /></a>
                                            </td>
                                            <td style="vertical-align: top; width: 183px;">
                                                <table>
                                                    <tr>
                                                        <td style=" vertical-align: top;  width: 183px; text-align: right;font:  normal 12px arial; color: #333; padding: 0px; margin: 0px;"><?php echo date('F d,Y l'); ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <a href="<?php echo FB_PAGE; ?>" title="Facebook" style=" padding: 0 0 0 82px;"><img src="<?php echo PATH; ?>themes/<?php echo THEME_NAME; ?>/images/new/facebook1_2.png"  border="0" alt="Facebook"/></a>
                                                            <a href="<?php echo TWITTER_PAGE; ?>" title="Twitter"><img src="<?php echo PATH; ?>themes/<?php echo THEME_NAME; ?>/images/new/twitter1_2.png"  border="0" alt="twitter"/></a>
                                                            <a href="<?php echo LINKEDIN_PAGE; ?>" title="linked In"><img src="<?php echo PATH; ?>themes/<?php echo THEME_NAME; ?>/images/new/linked_in1_2.png"  border="0" alt="linked_in"/></a>
                                                            <a href="<?php echo LINKEDIN_PAGE; ?>" title="Google+"><img src="<?php echo PATH; ?>themes/<?php echo THEME_NAME; ?>/images/new/goog1_2.png"  border="0" alt="Google+"/></a>
                                                            <?php if ($this->city_id) { ?> 
                                                                <?php foreach ($this->all_city_list as $CX) {
                                                                    if ($this->city_id == $CX->city_id) { ?>
                                                                        <a href="<?php echo PATH . 'deals/rss/' . $this->city_id . '/' . $CX->city_url; ?>" title="Rss"><img src="<?php echo PATH; ?>themes/<?php echo THEME_NAME; ?>/images/new/rss1_2.png"  border="0" alt="Rss"/></a>
            <?php }
        }
    } ?>
                                                        </td>
                                                    </tr>
                                                    <tr height="10"></tr>
                                                </table>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <table cellspacing="0" cellpadding="0"  style="width:680px;    border: 1px solid #ECE9E4; background:#fff;">
                                        <tr height="10"><td colspan="3"></td></tr>
                                        <tr height="5"><td colspan="3"></td></tr>
                                        <tr>
                                            <td width="8"></td>
                                            <td>
                                                <table>
                                                    <tr>
                                                        <td style="width: 351px; vertical-align: top;">
                                                            <table>
                                                                <tr>
                                                                    <td style="vertical-align: top;"> <p style=" font:  normal 23px/25px arial; color: #000; margin: 0px; padding: 0px;"><?php echo $this->Lang['CONGRA']; ?>, <?php echo $tran->firstname; ?></p>
                                                                        <p style="font:  normal 18px arial; color: #FF9B02; margin: 0px; padding: 0px;"> <?php echo $this->Lang['YOU_WON_AUC']; ?></p>
                                                                    </td>                   
                                                                </tr>
                                                                <tr>
                                                                    <td> 
                                                                        <table>
                                                                            <tr height="10"></tr>
                                                                            <tr>
                                                                                <td  style="width:282px">
                                                                                    <img src="<?php echo $image; ?>" style="width:282px; height:195px; float:left; border:1px solid #ECE9E4;" border="0" alt="" />
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td  style=" vertical-align: top;">
                                                                                    <table cellpadding="0" cellspacing="0" border="0">
                                                                                        <tr>
                                                                                            <td style="width:195px;">
                                                                                                <p style=" font:  normal 16px/19px arial; color: #666; margin: 0px; padding: 0px;"><?php echo $tran->auction_title; ?></p>
                                                                                            </td>
                                                                                            <td>
                                                                                                <a style=" font:  bold 12px arial; background: #FF9B02;  color: #fff; margin: 0px; margin-left:10px;padding:4px 11px 5px 12px; text-decoration: none;" href="<?php echo PATH . 'auction/buy_auction/' . base64_encode($tran->auction_id) . '/' . base64_encode($tran->user_id) . '/' . base64_encode($tran->bid_amount) . '/' . base64_encode($tran->bid_id); ?>" title="<?php echo $this->Lang['BUY_NOW2']; ?>"><?php echo $this->Lang['BUY_NOW2']; ?></a>
                                                                                            </td>
                                                                                        </tr>
                                                                                    </table>
                                                                                </td>
                                                                            </tr>
                                                                        </table>
                                                                    </td>                   
                                                                </tr>
                                                            </table>
                                                        </td>
                                                        <td width="15"></td>
                                                        <td style="width: 286px; vertical-align: top;">
                                                            <table width="100%" cellspacing="0" cellpadding="0" border="0">
                                                                <tr>
                                                                    <td style="vertical-align: top;">
                                                                        <p style=" font:  normal 24px/23px arial; color: #fff; background: #FF9B02; margin: 0px; padding: 6px 24px 8px 20px; text-align: center; text-decoration: none;"><?php echo $this->Lang['YOU_WIN']; ?></p>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td style="vertical-align: top;">
                                                                        <p  style=" font:  bold 14px/18px arial;  padding-top: 10px;color: #666;  margin: 0px;  text-align: center; text-decoration: none;"><?php echo $this->Lang['PAY_BEFORE']; ?></p>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td style="vertical-align: top;">
                                                                        <p  style=" font:  bold 16px arial;  padding-top: 10px;color: #FF9B02;  margin: 0px;  text-align: center; text-decoration: none;"><?php echo date('M d Y, h:i A', $end_time); ?></p>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td style=" vertical-align: top;">
                                                                        <p  style=" font:  bold 13px/17px arial;  padding-top: 10px;color: #666;  margin: 0px;  text-align: center; text-decoration: none;"><?php echo $this->Lang['AUTO_CANCEL_PRO']; ?>
                                                                            <br/><?php echo $this->Lang['INTO_INVEN']; ?></p>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td style=" vertical-align: top;">
                                                                        <p  style=" font:  normal 12px arial;  padding-top: 10px;color: #666;  margin: 0px;  text-align: center; text-decoration: none;"><?php echo $this->Lang['NON_PAY_AUC']; ?> <?php echo SITENAME; ?>  <?php echo $this->Lang['CANCEL_CURR_BID']; ?>
                                                                            <br/><?php echo $this->Lang['INTO_INVEN']; ?></p>
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                    <tr height="15"><td></td></tr>
                                                </table>
                                            </td>
                                            <td width="7"></td>
                                        </tr>
                                        
                            
                            <tr>
                                <td width="8"></td>
                                <td>
                                    <table>
                                        <tr>
                                            <td style=" width: 314px; border:  1px solid #ccc; padding: 3px;">
                                                <table>
                                                    <tr>
                                                        <td style=" vertical-align: top; font: bold 13px arial; color: #FF9B02;"><?php echo $this->Lang['AUC_DETS']; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td style=" vertical-align: top; ">
                                                            <table>
                                                                <tr>
                                                                    <td style=" vertical-align: top; font: bold 15px arial; color: #666;"><?php echo $this->Lang['WIN_BID_PRICE']; ?>  :  </td>
                                                                    <td style=" vertical-align: top; font: bold 15px arial; color: #666;"> <?php echo CURRENCY_SYMBOL . $tran->bid_amount; ?></td>
                                                                </tr>
                                                                <tr height="2"></tr>
                                                                <tr>
                                                                    <td style=" vertical-align: top; font: bold 15px arial; color: #666;"><?php echo $this->Lang['AUC_CLOSE']; ?>  :         </td>
                                                                    <td style=" vertical-align: top; font: bold 15px arial; color: #666;">  <?php echo date('M d Y, h:i A', $tran->enddate); ?></td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </td>
                                            <td width="7"></td>
                                        </tr>
                                    </table>
                                </td>
                                <td width="7"></td>
                            </tr>
                            <tr height="7"> <td colspan="3"></td></tr>
                            <tr>
                                <td width="8"></td>
                                <td style=" vertical-align: top; text-align: right; padding-bottom: 10px; padding-top: 6px;">
                                    <table>
                                        <tr>
                                            <td width="10"></td>
                                            <td>
                                                <p style="font: normal 12px arial; text-align: center; color: #666; margin: 0px; "><?php echo $this->Lang['won_auc_comm_win_bid_amo']; ?> </p>   
                                            </td>
                                            <td width="10"></td> 
                                        </tr>
                                        <tr height="7"></tr>	
                                        <? /* <tr>
                                            <td width="10"></td>
                                            <td>
                                                <p style="font: normal 12px arial; text-align: center; color: #666;margin: 0px;  "><?php echo $this->Lang['REVIEW_SHIPP']; ?> <a style="font: bold 12px arial; text-align: center; color: #000; " href="<?php echo PATH; ?>users/my-coupons.html" title="My page"> My page.</a> </p>   
                                            </td>
                                            <td width="10"></td> 
                                        </tr>
                                        <tr height="7"></tr> */ ?>
                                    </table>
                                </td>
                                <td width="7"></td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td>
                        <p  style="width:660px; margin:0px; padding: 10px 0 0 0px; font: normal 12px arial;  color:#333; text-align:center;"><?php echo $this->Lang['RECE_MSG_ADD']; ?><a  style=" color: #0066cc;" title="<?php echo $tran->email; ?>"> <?php echo $tran->email; ?></a>
                        </p>
                    </td>
                </tr>
                
                <tr>
                    <td>
                        <p style=" font:  normal 13px arial; color: #007bd9; text-align: center; padding:0; margin:0;"> <a style=" color: #0066cc;" href="<?php echo PATH;?>users/email-subscribtions.html" title="<?php echo $this->Lang['UNSUBSC']; ?>"> <?php echo $this->Lang['UNSUBSC']; ?> </a>  | <a  style=" color: #0066cc;"  href="<?php echo PATH;?>privacy-policy.php" title="<?php echo $this->Lang['PRIVACY']; ?>"><?php echo $this->Lang['PRIVACY']; ?></a></p>
                    </td>
                </tr>
                <tr height="10"><td></td></tr>
                <tr>
                    <td>
                        <p style=" font:  normal 13px arial; color: #333; text-align: center; padding:0; margin:0; "> <?php echo $this->Lang['FOOTER_COPYRIGHT']; ?> <?php echo SITENAME; ?> <?php echo $this->Lang['FOOTER_ALLRIGHT']; ?> </p>
                    </td>
                </tr>
                <tr height="10"><td></td></tr>        
            </table>    
                    </td>
                </tr>
                   
                <tr>
                    <td width="20"></td>
                    <td width="660"></td>
                    <td width="20"></td>
                </tr>               
            </table>
    </body>
    </html>
<?php } ?>
