<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
        <title></title>
    </head>
    <body>
        <table cellspacing="0" cellpadding="0" border="0" width="700" bgcolor="#ffffff" style="border:1px solid #d3d2d1;">
            <tr>
                <td style="padding:10px;">
                    <table cellspacing="0" cellpadding="0" border="0" width="100%">
                        <tr>
                            <td>
                                <table cellspacing="0" cellpadding="0" border="0" width="100%" bgcolor="#144F5D">
                                    <tr height="68">
                                        <td width="10"></td>
                                        <td align="center" width="235" bgcolor="#fff"><a style="padding:0; margin:10px 0;" href="<?php echo PATH; ?>" title="<?php echo SITENAME; ?>"><img src="<?php echo PATH; ?>themes/<?php echo THEME_NAME; ?>/images/logo.png" border="0" alt="<?php echo $this->Lang['LOGO']; ?>" /></a></td>
                                        <td>&nbsp;</td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr height="20">
                            <td></td>
                        </tr>
                          <?php if(count($this->all_products_list_by_city) > 1) { ?>
                        <tr>
                            <td>
                                <table cellspacing="0" cellpadding="0" border="0" width="100%">
                                    <tr>
                                        <td bgcolor="#333" style="border:1px solid #d2d2d2;padding:9px;font:normal 20px arial;color:#fff;">
                                            PRODUCTS
                                        </td>
                                    </tr>
                                    <tr height="20">
                            <td></td>
                        </tr>
                                    <tr>
                                        <td valign="top">
                                            <table cellspacing="0" cellpadding="0" border="0" width="100%">
                                                <tr height="251">
                                                <?php
                                        $i = 1;
                                        foreach ($this->all_products_list_by_city as $products) {
                                        $symbol = CURRENCY_SYMBOL;
                                        ?>
                                        <?php if (($products->purchase_count < $products->user_limit_quantity)) { ?>
                                        <?php if (($i == 1)) { ?>  
                                                    <td valign="middle" width="330" style="border:1px dotted #c6c6c6;">
                                                        <table cellspacing="0" cellpadding="0" border="0" width="100%" >
                                                            <tr height="130" >
                                                                <td valign="middle" bgcolor="#ffffff">
                                                                   <a href="<?php echo PATH . $products->store_url_title.'/product/' . $products->deal_key . '/' . $products->url_title . '.html'; ?>" style="display: block;">
                                                        <?php if (file_exists(DOCROOT . 'images/products/1000_800/' . $products->deal_key . '_1' . '.png')) { ?>
                                                        <img src="<?php echo PATH.'resize.php';?>?src=<?php echo PATH .'images/products/1000_800/'.$products->deal_key.'_1'.'.png'?>&w=200&h=248" alt="<?php echo $products->deal_title; ?>" title="<?php echo $products->deal_title; ?>" />
                                                        <?php } else { ?>
                                                        <img width="200px" height="248px;" src="<?php echo PATH; ?>themes/<?php echo THEME_NAME; ?>/images/noimage_products_list.png" alt="<?php echo $this->Lang['PRODUCT_IMG']; ?>" title="<?php echo $products->deal_title; ?>" style="border:none;" />
                                                        <?php } ?>
                                                                </a>
                                                                </td>
                                                                <td valign="middle">
                                                                    <table cellspacing="0" cellpadding="0" border="0" width="100%" >
                                                                        <tr>
                                                                            <td align="center" style="font:bold 16px arial;color:#1e2023;">
                                                                                <a style="color:#1e2023;text-decoration: none;" href="<?php echo PATH . $products->store_url_title.'/product/' . $products->deal_key . '/' . $products->url_title . '.html'; ?>" title="<?php echo $products->deal_title; ?> "><?php echo ucfirst(substr($products->deal_title, 0, 20)) ; ?></a>
                                                                            </td>
                                                                        </tr>
                                                                        <tr height="10"><td></td></tr>
                                                                        <tr>
                                                                            <td align="center"  style="font:normal 20px arial;color:#144F5D;"><?php echo round($products->deal_percentage); ?>% OFFER</td>
                                                                        </tr>
                                                                        <tr height="10"><td></td></tr>
                                                                        <tr>
                                                                            <td align="center">
                                                                                <a href="<?php echo PATH . $products->store_url_title.'/product/' . $products->deal_key . '/' . $products->url_title . '.html'; ?>" title="SHOP NOW">
                                                                                    <img src="<?php echo PATH; ?>themes/<?php echo THEME_NAME; ?>/images/new/email_shop_now.png" alt="Shop now" />
                                                                                </a>
                                                                            </td>
                                                                        </tr>
                                                                    </table>
                                                                </td>
                                                                <td width="5"></td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                    <?php } $i++;   } } ?>
                                                    <td width="16"></td>
                                                <?php
                                                $i = 1;
                                                foreach ($this->all_products_list_by_city as $products) {
                                                $symbol = CURRENCY_SYMBOL;
                                                ?>
                                                <?php if (($products->purchase_count < $products->user_limit_quantity)) { ?>
                                                <?php if (($i == 2)) { ?>
                                                    <td valign="middle" width="330" style="border:1px dotted #c6c6c6;">
                                                        <table cellspacing="0" cellpadding="0" border="0" width="100%" >
                                                            <tr height="130" >
                                                                <td align="center" valign="middle" bgcolor="#ffffff" >
                                                                       <a href="<?php echo PATH . $products->store_url_title.'/product/' . $products->deal_key . '/' . $products->url_title . '.html'; ?>" style="display: block;">
                                                        <?php if (file_exists(DOCROOT . 'images/products/1000_800/' . $products->deal_key . '_1' . '.png')) { ?>
                                                        <img src="<?php echo PATH.'resize.php';?>?src=<?php echo PATH .'images/products/1000_800/'.$products->deal_key.'_1'.'.png'?>&w=200&h=248" alt="<?php echo $products->deal_title; ?>" title="<?php echo $products->deal_title; ?>" />
                                                        <?php } else { ?>
                                                        <img width="200px" height="248px;" src="<?php echo PATH; ?>themes/<?php echo THEME_NAME; ?>/images/noimage_products_list.png" alt="<?php echo $this->Lang['PRODUCT_IMG']; ?>" title="<?php echo $products->deal_title; ?>" style="border:none;" />
                                                        <?php } ?>
                                                                </a>
                                                                </td>
                                                                <td valign="middle">
                                                                    <table cellspacing="0" cellpadding="0" border="0" width="100%" >
                                                                        <tr>
                                                                            <td align="center" style="font:bold 16px arial;color:#1e2023;">
                                                                                <a style="color:#1e2023;text-decoration: none;" href="<?php echo PATH . $products->store_url_title.'/product/' . $products->deal_key . '/' . $products->url_title . '.html'; ?>" title="<?php echo $products->deal_title; ?> "><?php echo ucfirst(substr($products->deal_title, 0, 20)) ; ?></a>
                                                                            </td>
                                                                        </tr>
                                                                        <tr height="10"><td></td></tr>
                                                                        <tr>
                                                                            <td align="center"  style="font:normal 20px arial;color:#144F5D;"><?php echo round($products->deal_percentage); ?>% OFFER</td>
                                                                        </tr>
                                                                        <tr height="10"><td></td></tr>
                                                                        <tr>
                                                                            <td align="center">
                                                                                <a href="<?php echo PATH . $products->store_url_title.'/product/' . $products->deal_key . '/' . $products->url_title . '.html'; ?>" title="SHOP NOW">
                                                                                    <img src="<?php echo PATH; ?>themes/<?php echo THEME_NAME; ?>/images/new/email_shop_now.png" alt="Shop now" />
                                                                                </a>
                                                                            </td>
                                                                        </tr>
                                                                    </table>
                                                                </td>
                                                                <td width="5"></td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                    <?php } $i++;   } } ?>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>

                                    <tr height="15"><td></td></tr>
                                    <tr>
                                        <td valign="top">
                                            <table cellspacing="0" cellpadding="0" border="0" width="100%" bgcolor="#f9f9f9" style="border:1px solid #d2d2d2; padding:15px;">
                                                <tr height="298">
                                                 <?php
                                                $i = 1;
                                                foreach ($this->all_products_list_by_city as $products) {
                                                $symbol = CURRENCY_SYMBOL;
                                                ?>
                                                <?php if (($products->purchase_count < $products->user_limit_quantity)) { ?>
                                                <?php if (($i != 1) && ($i != 2) && $i <= 5) { ?>    
                                                    <td valign="middle" width="200" style="border:1px solid #d2d2d2;">
                                                        <table cellspacing="0" cellpadding="0" border="0" width="100%" >
                                                            <tr height="180" >
                                                                <td align="center" valign="middle" bgcolor="#ffffff">
                                                                                                                                      
                                                                    <a href="<?php echo PATH . $products->store_url_title.'/product/' . $products->deal_key . '/' . $products->url_title . '.html'; ?>">
                                                        <?php if (file_exists(DOCROOT . 'images/products/1000_800/' . $products->deal_key . '_1' . '.png')) { ?>
                                                        <img src="<?php echo PATH.'resize.php';?>?src=<?php echo PATH .'images/products/1000_800/'.$products->deal_key.'_1'.'.png'?>&w=200&h=170" alt="<?php echo $products->deal_title; ?>" title="<?php echo $products->deal_title; ?>" />
                                                        <?php } else { ?>
                                                        <img width="200px" height="170px;" src="<?php echo PATH; ?>themes/<?php echo THEME_NAME; ?>/images/noimage_products_list.png" alt="<?php echo $this->Lang['PRODUCT_IMG']; ?>" title="<?php echo $products->deal_title; ?>" style="border:none;" />
                                                        <?php } ?>
                                                        </a>
                                                        
                                                                </td>
                                                            </tr>
                                                            <tr height="5"><td></td></tr>
                                                            <tr>
                                                                <td valign="middle">
                                                                    <table cellspacing="0" cellpadding="0" border="0" width="100%" >
                                                                        <tr>
                                                                            <td align="center" style="font:bold 16px arial;color:#1e2023;">
                                                                                
                                                                                <a href="<?php echo PATH . $products->store_url_title.'/product/' . $products->deal_key . '/' . $products->url_title . '.html'; ?>"  style="color:#1e2023;text-decoration: none;"><?php echo ucfirst(substr($products->deal_title, 0, 25)) ; ?></a>
                                                                                
                                                                            </td>
                                                                        </tr>
                                                                        <tr height="10"><td></td></tr>
                                                                        <tr>
                                                                            <td align="center"  style="font:normal 20px arial;color:#144F5D;"><?php echo round($products->deal_percentage); ?>% OFFER</td>
                                                                        </tr>
                                                                        <tr height="10"><td></td></tr>
                                                                        <tr>
                                                                            <td align="center">
                                                                                <a href="<?php echo PATH . $products->store_url_title.'/product/' . $products->deal_key . '/' . $products->url_title . '.html'; ?>" title="SHOP NOW">
                                                                                    <img src="<?php echo PATH; ?>themes/<?php echo THEME_NAME; ?>/images/new/email_shop_now.png" alt="Shop now" />
                                                                                </a>
                                                                            </td>
                                                                        </tr>
                                                                    </table>
                                                                </td>
                                                            </tr>
                                                            <tr height="15"><td></td></tr>
                                                        </table>
                                                    </td>
                                                       <?php if (($i != 1) && ($i != 2) && $i <= 4) { ?> 
                                                    <td width="36"></td>
                                                    <?php } ?>
                                                    <?php } }  $i++; } ?>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                    <tr height="10"><td></td></tr>
                                    <?php } ?>
                                      <?php if(count($this->all_deals_list_by_city) > 1) { ?>
                                    <tr>
                                        <td bgcolor="#333" style="border:1px solid #d2d2d2;padding:9px;font:normal 20px arial;color:#fff;">
                                            DEALS 
                                        </td>
                                    </tr>
                                    <tr height="10"><td></td></tr>
                                    <tr>
                                        <td valign="top">
                                            <table cellspacing="0" cellpadding="0" border="0" width="100%">
                                                <tr height="251">
                                                <?php
                                        $i = 1;
                                        foreach ($this->all_deals_list_by_city as $deals) {
                                        $symbol = CURRENCY_SYMBOL;
                                        ?>
                                        <?php if (($deals->enddate >= time()) && ($deals->purchase_count < $deals->maximum_deals_limit)) { ?>
                                        <?php if ($i == 1) { ?>
                                                    <td valign="middle" width="330" style="border:1px dotted #c6c6c6;">
                                                        <table cellspacing="0" cellpadding="0" border="0" width="100%" >
                                                            <tr height="130" >
                                                                <td valign="middle" bgcolor="#ffffff">
                                                                            <?php if (file_exists(DOCROOT . 'images/deals/1000_800/' . $deals->deal_key . '_1' . '.png')) { ?>
                                                <a href="<?php echo PATH . $deals->store_url_title.'/deals/' . $deals->deal_key . '/' . $deals->url_title . '.html'; ?>" title="<?php echo $deals->deal_title; ?>" style="display: block;">
                                                <img src="<?php echo PATH.'resize.php';?>?src=<?php echo PATH .'images/deals/1000_800/'.$deals->deal_key.'_1'.'.png'?>&w=200&h=250"  alt="<?php echo $deals->deal_title; ?>" title="<?php echo $deals->deal_title; ?>" >
                                                </a>
                                                <?php } else { ?>
                                                <a href="<?php echo PATH . $deals->store_url_title.'/deals/' . $deals->deal_key . '/' . $deals->url_title . '.html'; ?>" title="<?php echo $deals->deal_title; ?>" style="display: block;"><img width="200px" height="250px;" src="<?php echo PATH; ?>themes/<?php echo THEME_NAME; ?>/images/no-image/deal_list_no_image.png"  alt="<?php echo $deals->deal_title; ?>" title="<?php echo $deals->deal_title; ?>" ></a>  
                                                <?php } ?> 
                                                                </td>
                                                                <td valign="middle">
                                                                    <table cellspacing="0" cellpadding="0" border="0" width="100%" >
                                                                        <tr>
                                                                            <td align="center" style="font:bold 16px arial;color:#1e2023;">
                                                                                <a href="<?php echo PATH . $deals->store_url_title.'/deals/' . $deals->deal_key . '/' . $deals->url_title . '.html'; ?>" title="<?php echo ucfirst(substr($deals->deal_title, 0, 20)) ; ?>" style="color:#1e2023;text-decoration: none;"><?php echo ucfirst(substr($deals->deal_title, 0, 20)) ; ?></a>
                                                                            </td>
                                                                        </tr>
                                                                        <tr height="10"><td></td></tr>
                                                                        <tr>
                                                                            <td align="center"  style="font:normal 20px arial;color:#144F5D;"><?php echo round($deals->deal_percentage); ?>% OFFER</td>
                                                                        </tr>
                                                                        <tr height="10"><td></td></tr>
                                                                        <tr>
                                                                            <td align="center">
                                                                                <a href="<?php echo PATH . $deals->store_url_title.'/deals/' . $deals->deal_key . '/' . $deals->url_title . '.html'; ?>" title="SHOP NOW">
                                                                                    <img src="<?php echo PATH; ?>themes/<?php echo THEME_NAME; ?>/images/new/email_shop_now.png" alt="Shop now" />
                                                                                </a>
                                                                            </td>
                                                                        </tr>
                                                                    </table>
                                                                </td>
                                                                <td width="5"></td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                    <?php } }  $i++; } ?>
                                                    <td width="16"></td>
                                                    <?php
                                        $i = 1;
                                        foreach ($this->all_deals_list_by_city as $deals) {
                                        $symbol = CURRENCY_SYMBOL;
                                        ?>
                                        <?php if (($deals->enddate >= time()) && ($deals->purchase_count < $deals->maximum_deals_limit)) { ?>
                                        <?php if ($i == 2) { ?>
                                                    <td valign="middle" width="330" style="border:1px dotted #c6c6c6;">
                                                        <table cellspacing="0" cellpadding="0" border="0" width="100%" >
                                                            <tr height="130" >
                                                                <td align="center" valign="middle" bgcolor="#ffffff" >
                                                                   
                                                                                   <?php if (file_exists(DOCROOT . 'images/deals/1000_800/' . $deals->deal_key . '_1' . '.png')) { ?>
                                                <a href="<?php echo PATH . $deals->store_url_title.'/deals/' . $deals->deal_key . '/' . $deals->url_title . '.html'; ?>" title="<?php echo $deals->deal_title; ?>" style="display: block;">
                                                <img src="<?php echo PATH.'resize.php';?>?src=<?php echo PATH .'images/deals/1000_800/'.$deals->deal_key.'_1'.'.png'?>&w=200&h=250"  alt="<?php echo $deals->deal_title; ?>" title="<?php echo $deals->deal_title; ?>" >
                                                </a>
                                                <?php } else { ?>
                                                <a href="<?php echo PATH . $deals->store_url_title.'/deals/' . $deals->deal_key . '/' . $deals->url_title . '.html'; ?>" title="<?php echo $deals->deal_title; ?>" style="display: block;"><img width="200px" height="250px;" src="<?php echo PATH; ?>themes/<?php echo THEME_NAME; ?>/images/no-image/deal_list_no_image.png"  alt="<?php echo $deals->deal_title; ?>" title="<?php echo $deals->deal_title; ?>" ></a>  
                                                <?php } ?>
                                                                </td>
                                                                <td valign="middle">
                                                                    <table cellspacing="0" cellpadding="0" border="0" width="100%" >
                                                                        <tr>
                                                                            <td align="center" style="font:bold 16px arial;color:#1e2023;">
                                                                                
                                                                                 <a href="<?php echo PATH . $deals->store_url_title.'/deals/' . $deals->deal_key . '/' . $deals->url_title . '.html'; ?>" title="<?php echo ucfirst(substr($deals->deal_title, 0, 20)) ; ?>" style="color:#1e2023;text-decoration: none;"><?php echo ucfirst(substr($deals->deal_title, 0, 20)) ; ?></a>
                                                                            </td>
                                                                        </tr>
                                                                        <tr height="10"><td></td></tr>
                                                                        <tr>
                                                                            <td align="center"  style="font:normal 20px arial;color:#144F5D;"><?php echo round($deals->deal_percentage); ?>% OFFER</td>
                                                                        </tr>
                                                                        <tr height="10"><td></td></tr>
                                                                        <tr>
                                                                            <td align="center">
                                                                                <a href="<?php echo PATH . $deals->store_url_title.'/deals/' . $deals->deal_key . '/' . $deals->url_title . '.html'; ?>" title="SHOP NOW">
                                                                                    <img src="<?php echo PATH; ?>themes/<?php echo THEME_NAME; ?>/images/new/email_shop_now.png" alt="Shop now" />
                                                                                </a>
                                                                            </td>
                                                                        </tr>
                                                                    </table>
                                                                </td>
                                                                <td width="5"></td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                    <?php } }  $i++; } ?>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                    <tr height="15"><td></td></tr>
                                    <tr>
                                        <td valign="top">
                                            <table cellspacing="0" cellpadding="0" border="0" width="100%" bgcolor="#f9f9f9" style="border:1px solid #d2d2d2; padding:15px;">
                                                <tr>
                                                    <?php
                                        $i = 1;
                                        foreach ($this->all_deals_list_by_city as $deals) {
                                        $symbol = CURRENCY_SYMBOL;
                                        ?>
                                        <?php if (($deals->enddate >= time()) && ($deals->purchase_count < $deals->maximum_deals_limit)) { ?>
                                         <?php if (($i != 1) && ($i != 2) && $i <= 5) { ?> 
                                                    <td valign="middle" width="179">
                                                        <table cellspacing="0" cellpadding="0" border="0" width="100%" >
                                                            <tr height="252">
                                                               
                                                                <td align="center" valign="middle" width="175" bgcolor="#ffffff" style="border:1px dotted #c7c7c7;padding:1px;">
                                                                   <?php if (file_exists(DOCROOT . 'images/deals/1000_800/' . $deals->deal_key . '_1' . '.png')) { ?>
                                                <a href="<?php echo PATH . $deals->store_url_title.'/deals/' . $deals->deal_key . '/' . $deals->url_title . '.html'; ?>" title="<?php echo $deals->deal_title; ?>" style="display: block;">
                                                <img src="<?php echo PATH.'resize.php';?>?src=<?php echo PATH .'images/deals/1000_800/'.$deals->deal_key.'_1'.'.png'?>&w=180&h=250"  alt="<?php echo $deals->deal_title; ?>" title="<?php echo $deals->deal_title; ?>" >
                                                </a>
                                                <?php } else { ?>
                                                <a href="<?php echo PATH . $deals->store_url_title.'/deals/' . $deals->deal_key . '/' . $deals->url_title . '.html'; ?>" title="<?php echo $deals->deal_title; ?>" style="display: block;"><img width="180px" height="250px;" src="<?php echo PATH; ?>themes/<?php echo THEME_NAME; ?>/images/no-image/deal_list_no_image.png"  alt="<?php echo $deals->deal_title; ?>" title="<?php echo $deals->deal_title; ?>" ></a>  
                                                <?php } ?>
                                                                </td>
                                                            </tr>
                                                            <tr height="10">
                                                                <td></td>
                                                            </tr>
                                                            <tr>
                                                                <td style="font:bold 12px arial;color:#333333;">
                                                                    
                                                                     <a href="<?php echo PATH . $deals->store_url_title.'/deals/' . $deals->deal_key . '/' . $deals->url_title . '.html'; ?>" title="<?php echo ucfirst(substr($deals->deal_title, 0, 20)) ; ?>" style="color:#333;text-decoration: none;"><?php echo ucfirst(substr($deals->deal_title, 0, 20)) ; ?></a>
                                                                </td>
                                                            </tr>
                                                            <tr height="15">
                                                                <td></td>
                                                            </tr>
                                                            <tr>
                                                                <td valign="top">
                                                                    <table cellspacing="0" cellpadding="0" border="0" width="100%">
                                                                        <tr>
                                                                            <td >
                                                                                <a href="<?php echo PATH . $deals->store_url_title.'/deals/' . $deals->deal_key . '/' . $deals->url_title . '.html'; ?>" title="SHOP NOW">
                                                                                    <img src="<?php echo PATH; ?>themes/<?php echo THEME_NAME; ?>/images/new/email_shop_now.png" alt="Shop now" />
                                                                                </a>
                                                                            </td>
                                                                            <td valign="middle" align="right" style="font:normal 11px arial;color:#144F5D;">
                                                                                OFF
                                                                                <b style="font:bold 16px arial;padding:0 0 0 3px;"><?php echo round($deals->deal_percentage); ?>%</b>
                                                                            </td>
                                                                        </tr>
                                                                    </table>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                    <?php if (($i != 1) && ($i != 2) && $i <= 4) { ?> 
                                                    <td width="27"></td>
                                                    <?php } ?>
                                                    <?php } }  $i++; } ?>
                                                   
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                    <tr height="10">
                                        <td></td>
                                    </tr>
                                    <?php } ?>
                                      <?php if(count($this->all_auction_list_by_city) > 1) { ?>
                                    <tr>
                                        <td bgcolor="#333" style="border:1px solid #d2d2d2;padding:9px;font:normal 20px arial;color:#fff;">
                                            AUCTION
                                        </td>
                                    </tr>
                                    <tr height="10">
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td valign="top">
                                            <table cellspacing="0" cellpadding="0" border="0" width="100%">
                                                <tr height="251">
                                                <?php
                                                $i = 1;
                                                foreach ($this->all_auction_list_by_city as $auction) {
                                                $symbol = CURRENCY_SYMBOL;
                                                ?>
                                                <?php if ($i == 1) { ?>
                                                    <td valign="middle" width="330" style="border:1px dotted #c6c6c6;">
                                                        <table cellspacing="0" cellpadding="0" border="0" width="100%" >
                                                            <tr height="130" >
                                                                <td valign="middle" bgcolor="#ffffff">
                                                                    <?php  if(file_exists(DOCROOT.'images/auction/1000_800/'.$auction->deal_key.'_1'.'.png')){ ?>
                                                        <a href="<?php echo PATH.$auction->store_url_title.'/auction/'.$auction->deal_key.'/'.$auction->url_title.'.html';?>" title="<?php echo $auction->deal_title; ?>">
                                                        <img src="<?php echo PATH.'resize.php';?>?src=<?php echo PATH .'images/auction/1000_800/'.$auction->deal_key.'_1'.'.png'?>&w=200&h=248" alt="<?php echo $auction->deal_title; ?>" title="<?php echo $auction->deal_title; ?>" border="0" /></a>
                                                        <?php } else { ?>
                                                        <a href="<?php echo PATH.$auction->store_url_title.'/auction/'.$auction->deal_key.'/'.$auction->url_title.'.html';?>" title="<?php echo $auction->deal_title; ?>"><img width="200px" height="248px;" src="<?php echo PATH; ?>themes/<?php echo THEME_NAME; ?>/images/no-image/deal_list_no_image.png"   alt="<?php echo $auction->deal_title; ?>" title="<?php echo $auction->deal_title; ?>" border="0" /></a>
                                                        <?php }?>
                                                                </td>
                                                                <td valign="middle">
                                                                    <table cellspacing="0" cellpadding="0" border="0" width="100%" >
                                                                        <tr>
                                                                            <td align="center" style="font:bold 16px arial;color:#1e2023;">
                                                                               <a href="<?php echo PATH.$auction->store_url_title.'/auction/'.$auction->deal_key.'/'.$auction->url_title.'.html';?>" title="<?php echo ucfirst(substr($auction->deal_title, 0, 20)) ; ?>" style="color:#1e2023;text-decoration: none;"><?php echo ucfirst(substr($auction->deal_title, 0, 20)) ; ?></a>
                                                                            </td>
                                                                        </tr>

                                                                        <tr height="10"><td></td></tr>
                                                                        <tr>
                                                                            <td align="center">
                                                                                <a href="<?php echo PATH.$auction->store_url_title.'/auction/'.$auction->deal_key.'/'.$auction->url_title.'.html';?>" title="SHOP NOW">
                                                                                    <img src="<?php echo PATH; ?>themes/<?php echo THEME_NAME; ?>/images/new/email_shop_now.png" alt="Shop now" />
                                                                                </a>
                                                                            </td>
                                                                        </tr>
                                                                    </table>
                                                                </td>
                                                                <td width="5"></td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                     <?php }  $i++; } ?>
                                                    <td width="16"></td>
                                                       <?php
                                                $i = 1;
                                                foreach ($this->all_auction_list_by_city as $auction) {
                                                $symbol = CURRENCY_SYMBOL;
                                                ?>
                                                <?php if ($i == 2) { ?>
                                                    <td valign="middle" width="330" style="border:1px dotted #c6c6c6;">
                                                        <table cellspacing="0" cellpadding="0" border="0" width="100%" >
                                                            <tr height="130" >
                                                                <td align="center" valign="middle" bgcolor="#ffffff" >
                                                                    
                                                                    <?php  if(file_exists(DOCROOT.'images/auction/1000_800/'.$auction->deal_key.'_1'.'.png')){ ?>
                                                        <a href="<?php echo PATH.$auction->store_url_title.'/auction/'.$auction->deal_key.'/'.$auction->url_title.'.html';?>" title="<?php echo $auction->deal_title; ?>">
                                                        <img src="<?php echo PATH.'resize.php';?>?src=<?php echo PATH .'images/auction/1000_800/'.$auction->deal_key.'_1'.'.png'?>&w=200&h=248" alt="<?php echo $auction->deal_title; ?>" title="<?php echo $auction->deal_title; ?>" border="0" /></a>
                                                        <?php } else { ?>
                                                        <a href="<?php echo PATH.$auction->store_url_title.'/auction/'.$auction->deal_key.'/'.$auction->url_title.'.html';?>" title="<?php echo $auction->deal_title; ?>"><img width="200px" height="248px;" src="<?php echo PATH; ?>themes/<?php echo THEME_NAME; ?>/images/no-image/deal_list_no_image.png"   alt="<?php echo $auction->deal_title; ?>" title="<?php echo $auction->deal_title; ?>" border="0" /></a>
                                                        <?php }?>
                                                        
                                                                </td>
                                                                <td valign="middle">
                                                                    <table cellspacing="0" cellpadding="0" border="0" width="100%" >
                                                                        <tr>
                                                                            <td align="center" style="font:bold 16px arial;color:#1e2023;">
                                                                                <a href="<?php echo PATH.$auction->store_url_title.'/auction/'.$auction->deal_key.'/'.$auction->url_title.'.html';?>" title="<?php echo ucfirst(substr($auction->deal_title, 0, 20)) ; ?>" style="color:#1e2023;text-decoration: none;"><?php echo ucfirst(substr($auction->deal_title, 0, 20)) ; ?></a>
                                                                            </td>
                                                                        </tr>

                                                                        <tr height="10"><td></td></tr>
                                                                        <tr>
                                                                            <td align="center">
                                                                                <a href="<?php echo PATH.$auction->store_url_title.'/auction/'.$auction->deal_key.'/'.$auction->url_title.'.html';?>" title="SHOP NOW">
                                                                                    <img src="<?php echo PATH; ?>themes/<?php echo THEME_NAME; ?>/images/new/email_shop_now.png" alt="Shop now" />
                                                                                </a>
                                                                            </td>
                                                                        </tr>
                                                                    </table>
                                                                </td>
                                                                <td width="5"></td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                    <?php }  $i++; } ?>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                    <tr height="15"><td></td></tr>
                                    <tr>
                                        <td valign="top">
                                            <table cellspacing="0" cellpadding="0" border="0" width="100%" bgcolor="#f9f9f9" style="border:1px solid #d2d2d2; padding:15px;">
                                                <tr height="280">
                                                <?php
                                                $i = 1;
                                                foreach ($this->all_auction_list_by_city as $auction) {
                                                $symbol = CURRENCY_SYMBOL;
                                                ?>
                                                <?php if (($i != 1) && ($i != 2) && $i <= 5) { ?> 
                                                    <td valign="middle" width="216" style="border:1px solid #d2d2d2;">
                                                        <table cellspacing="0" cellpadding="0" border="0" width="100%" >
                                                            <tr height="200" >
                                                                <td align="center" valign="middle" bgcolor="#ffffff">
                                                                      <?php  if(file_exists(DOCROOT.'images/auction/1000_800/'.$auction->deal_key.'_1'.'.png')){ ?>
                                                        <a href="<?php echo PATH.$auction->store_url_title.'/auction/'.$auction->deal_key.'/'.$auction->url_title.'.html';?>" title="<?php echo $auction->deal_title; ?>">
                                                        <img src="<?php echo PATH.'resize.php';?>?src=<?php echo PATH .'images/auction/1000_800/'.$auction->deal_key.'_1'.'.png'?>&w=175&h=200" alt="<?php echo $auction->deal_title; ?>" title="<?php echo $auction->deal_title; ?>" border="0" /></a>
                                                        <?php } else { ?>
                                                        <a href="<?php echo PATH.$auction->store_url_title.'/auction/'.$auction->deal_key.'/'.$auction->url_title.'.html';?>" title="<?php echo $auction->deal_title; ?>"><img width="175px" height="200px;" src="<?php echo PATH; ?>themes/<?php echo THEME_NAME; ?>/images/no-image/deal_list_no_image.png"   alt="<?php echo $auction->deal_title; ?>" title="<?php echo $auction->deal_title; ?>" border="0" /></a>
                                                        <?php }?>
                                                                </td>
                                                            </tr>
                                                            <tr height="5"><td></td></tr>
                                                            <tr>
                                                                <td valign="middle">
                                                                    <table cellspacing="0" cellpadding="0" border="0" width="100%" >
                                                                        <tr>
                                                                            <td align="center" style="font:bold 16px arial;color:#1e2023;">
                                                                                 <a href="<?php echo PATH.$auction->store_url_title.'/auction/'.$auction->deal_key.'/'.$auction->url_title.'.html';?>" title="<?php echo ucfirst(substr($auction->deal_title, 0, 20)) ; ?>" style="color:#1e2023;text-decoration: none;"><?php echo ucfirst(substr($auction->deal_title, 0, 20)) ; ?></a>
                                                                            </td>
                                                                        </tr>
                                                                        <tr height="10"><td></td></tr>
                                                                        <tr>
                                                                            <td align="center">
                                                                                <a href="<?php echo PATH.$auction->store_url_title.'/auction/'.$auction->deal_key.'/'.$auction->url_title.'.html';?>" title="SHOP NOW">
                                                                                    <img src="<?php echo PATH; ?>themes/<?php echo THEME_NAME; ?>/images/new/email_shop_now.png" alt="Shop now" />
                                                                                </a>
                                                                            </td>
                                                                        </tr>
                                                                    </table>
                                                                </td>
                                                            </tr>
                                                            <tr height="15"><td></td></tr>
                                                        </table>
                                                    </td>
                                                    <?php if (($i != 1) && ($i != 2) && $i <= 4) { ?> 
                                                    <td width="13"></td>
                                                    <?php } ?>
                                                    <?php }   $i++; } ?>
                                                    
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr height="15"><td></td></tr>
                        <?php } ?>
                        <tr>
                            <td bgcolor="#eaeaeb" align="center" style="font:normal 13px/19px arial;color:#666666;padding:15px;">
                                  <p  style="width:660px; margin:0px; padding: 21px 0 0 0px; font: normal 12px/21px arial; color:#333; text-align:center;"><?php echo $this->Lang['YOU_ARE_RECEIVING']; ?> <a style="font:normal 12px arial; color:#144F5D" title="<?php echo $this->email; ?>"><?php echo $this->email; ?></a>.
                                </p>
                                <p style=" font:  normal 13px arial; color: #0066cc; text-align: center; padding:0; margin:0; margin-bottom:10px;">
                                    <a style=" color: #144F5D;" href="<?php echo PATH; ?>users/email-subscribtions.html" title="<?php echo $this->Lang['UNSUBSC']; ?>"> <?php echo $this->Lang['UNSUBSC']; ?> </a> &nbsp;|
                                    <a  style=" color: #144F5D;"href="<?php echo PATH; ?>privacy-policy.php" title="<?php echo $this->Lang['PRIV_POLI']; ?>"><?php echo $this->Lang['PRIV_POLI']; ?></a></p>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </body>
</html>
