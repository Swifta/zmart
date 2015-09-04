<?php defined('SYSPATH') OR die('No direct access allowed.'); ?>
<div class="contianer_outer1">
    <div class="contianer_inner">
        <div class="contianer">
            <div class="bread_crumb">
                <ul>
                    <li><p><a href="<?php echo PATH; ?>" title="<?php echo $this->Lang['HOME']; ?>"><?php echo $this->Lang['HOME']; ?></a></p></li>
                    <li><p><?php echo $this->Lang['PRODUCT_COMPARE']; ?></p></li>
                </ul>
            </div>
            <!--content start-->
            <div class="content">
                <div class="blog_left_inner_common_bor">
                    <div class="blog_left_inner_common_bor">                        
                        <div class="about_cont_hunder">
                            <?php if ($this->tot_compate > 0) { ?>
                                <div class="product_compare_block">
                                    <table border="0" cellpadding="3" cellspacing="0" class="compare_table">
                                        <thead>
                                            <tr>
                                                <td colspan="5" class="compare_title"><?php echo $this->Lang['PRODUCT_DET']; ?></td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr class="compare_image_row">
                                                <td>                                                    
                                                    <p class="c_row_title"><?php echo $this->Lang['TITLE']; ?></p>
                                                </td>
                                                <?php foreach ($this->product_compare as $c) {  ?>
                                                    <td class="name" valign="top;">  
                                                        <div class="produt_compare_title clearfix">
                                                            <a class="compare_deal_title" title="<?php echo $c['deal_title']; ?>" href="<?php echo PATH .$c['store_url_title']. '/product/' . $c['deal_key'] . '/' . $c['url_title']; ?>.html"><?php echo $c['deal_title']; ?></a>                                                        
                                                            <a class="close_compare_deal" href="<?php echo PATH; ?>products/remove_compare/?product_id=<?php echo $c['deal_id']; ?>" title="<?php echo $this->Lang['RMV'] ?>" >&nbsp;</a>
                                                        </div>
                                                        <div class="product_compare_image_sec">
                                                            <div class="compare_image">
                                                            <?php if (file_exists(DOCROOT . 'images/products/1000_800/' . $c['deal_key'] . '_1.png')) { ?>
                                                                <img src="<?php echo PATH . 'resize.php'; ?>?src=<?php echo PATH . '/images/products/1000_800/' . $c['deal_key'] . '_1.png' ?>&w=<?php echo PRODUCT_LIST_WIDTH; ?>&h=<?php echo PRODUCT_LIST_HEIGHT; ?>"  alt="<?php echo $c['deal_title']; ?>">
                                                            <?php } else { ?>
                                                                <img src="<?php echo PATH.'resize.php';?>?src=<?php echo PATH; ?>themes/<?php echo THEME_NAME; ?>/images/noimage_products_list.png&w=<?php echo PRODUCT_LIST_WIDTH; ?>&h=<?php echo PRODUCT_LIST_HEIGHT; ?>" alt="<?php echo $c['deal_title']; ?>" title="<?php echo $c['deal_title']; ?>" />
                                                            <?php } ?>
                                                            </div>                                                        
                                                            <a class="buy_it compare_view_it" href="<?php echo PATH . $c['store_url_title']. '/product/' . $c['deal_key'] . '/' . $c['url_title'] . '.html'; ?>" title="<?php echo $this->Lang['VIEW_PRODUCT']; ?>"><?php echo $this->Lang['VIEW_PRODUCT']; ?></a>
                                                        </div>
                                                    </td>
                                                    <?php  }  ?>
                                            </tr>
                                            <?php /* <tr>
                                                <td valign="top" ><p class="c_row_title"><?php echo $this->Lang['IMAGE']; ?></p></td>
                                                <?php foreach ($this->product_compare as $c) { ?>
                                                    <td>
                                                        <?php if (file_exists(DOCROOT . 'images/products/100_100/' . $c['deal_key'] . '_1.png')) { ?>
                                                            <img src="<?php echo PATH . 'resize.php'; ?>?src=<?php echo PATH . '/images/products/100_100/' . $c['deal_key'] . '_1.png' ?>&w=<?php echo PRODUCT_THUMB_WIDTH; ?>&h=<?php echo PRODUCT_THUMB_HEIGHT; ?>"  alt="<?php echo $c['deal_title']; ?>">
                                                        <?php } else { ?>
                                                            <img src="<?php echo PATH . 'resize.php'; ?>?src=<?php echo PATH . 'themes/' . THEME_NAME . '/images/noimage_products_list.png' ?>&w=<?php echo PRODUCT_THUMB_WIDTH; ?>&h=<?php echo PRODUCT_THUMB_HEIGHT; ?>" alt="<?php echo $c['deal_title']; ?>" >
                                                        <?php } ?>
                                                    </td>
                                                <?php } ?>
                                            </tr> */ ?>
                                            <tr>

                                                <td ><p class="c_row_title"><?php echo $this->Lang['PRI']; ?></p></td>
                                                <?php foreach ($this->product_compare as $c) {
                                                    ?>
                                                    <td>  <?php echo CURRENCY_SYMBOL . $c['deal_value']; ?> </td> 
                                                <?php } ?>
                                            </tr>
                                            <tr>
                                                <td ><p class="c_row_title"><?php echo $this->Lang['SAVE']; ?></p></td>
                                                <?php foreach ($this->product_compare as $c) { ?>
                                                    <td ><?php echo round($c['deal_percentage']); ?> % </td>
                                                <?php } ?>
                                            </tr>

                                            <tr>
                                                <td ><p class="c_row_title"><?php echo $this->Lang['COLORS']; ?></p></td>

                                                <?php
                                                foreach ($this->product_compare as $clr) {
                                                    echo "<td>";
                                                    if (!empty($this->product_colors[$clr['deal_id']])) {
                                                        foreach ($this->product_colors[$clr['deal_id']] as $C) {
                                                            ?>
                                                    <span class="choose_color_div" style="padding: 0px 2px;margin:0px 3px 3px 0px;width: 19px;height: 20px;float: left;background:#<?php echo ucfirst($C['color_name']); ?>;" title="<?php  echo $C['color_code_name']; ?>"></span> 
                                                    <?php
                                                }   } else {
                                                echo ' - ';
                                            }
                                        } echo "</td>";
                                        ?>
                                        </tr>

                                        <tr>
                                        <td ><p class="c_row_title"><?php echo $this->Lang['SIZES']; ?></p></td>
                                            <?php foreach ($this->product_compare as $clr) { ?>
                                                <td>
                                                    <?php
                                                    if (!empty($this->product_sizes[$clr['deal_id']])) {
                                                        $tot_size = count($this->product_sizes[$clr['deal_id']]);
                                                        $i = 1;
                                                        $this->products = new Products_Model();
                                                        $this->product_size_sel = $this->products->get_product_one_size($clr['deal_id']);
                                                        foreach ($this->product_size_sel as $C) {
                                                            $comma = ($tot_size == $i) ? "" : ",";    ?>
                                                            <span><?php echo ucfirst($C->size_name) . $comma; ?></span> 
                                                            <?php
                                                            $i++;
                                                        }
                                                    } else {
                                                        echo ' - ';
                                                    }
                                                }
                                                ?>

                                            </td>
                                        </tr>
                                        <tr>
                                            <td ><p class="c_row_title"><?php echo $this->Lang['AVIL']; ?></p></td>
    <?php foreach ($this->product_compare as $c) { ?>
                                           <td ><?php echo ($c['purchase_count'] < $c['user_limit_quantity']) ? $this->Lang['IN_STOCK1'] : $this->Lang['STCK_NT_AVIL']; ?></td>

                                            <?php } ?>
                                        </tr>
                                        <tr>

                                            <td ><p class="c_row_title"><?php echo $this->Lang['RATING']; ?></p></td>
                                                <?php
                                                foreach ($this->product_compare as $c) {
                                                    ?>
                                                <td><img src="<?php echo PATH . 'themes/' . THEME_NAME . '/images/stars-' . $c['rating']; ?>.png" alt="<?php echo $this->Lang['BASED_ON'] . " " . $c['rating_count'] . " " . $this->Lang['REVIWS']; ?>">
        <?php /* echo $this->Lang['BASED_ON'] . " " . $c['rating_count'] . " " . $this->Lang['REVIWS']; */ ?></td>
        <?php
    }
    ?>
                                        </tr>
                                        <tr>
                                            <td ><p class="c_row_title"><?php echo $this->Lang['SUMMARY']; ?></p></td>


                                                <?php
                                                foreach ($this->product_compare as $c) {
                                                    ?>
                                                <td class="description"> <?php $desc = strip_tags($c['deal_description']);
                                        echo strlen($desc) > 250 ? substr($desc, 0, 248) . '...' : $desc;
                                        ?></td>
        <?php
    }
    ?>
                                        </tr>
                                 
                                        

                                        </tbody>

                                        <?php foreach ($this->attribute_groups as $attribute_group) { ?>
                                            <thead>
                                                <tr class="compare_features_title">
                                                    <td class="compare-attribute" colspan="<?php echo count($this->product_compare) + 1; ?>"><?php echo ucfirst($attribute_group['name']); ?></td>
                                                </tr>
                                            </thead>
                                                    <?php foreach ($attribute_group['attribute'] as $key => $attribute) { ?>
                                                <tbody>
                                                    <tr>
                                                        <td ><p class="c_row_title"><?php echo $attribute['name']; ?></p></td>
                                                        <?php foreach ($this->product_compare as $c) { ?>
                                                            <?php if (isset($this->product_compare[$c['deal_id']]['attribute'][$key])) { ?>
                                                                <td><?php echo $this->product_compare[$c['deal_id']]['attribute'][$key]; ?></td>
                                                    <?php } else { ?>
                                                                <td> - </td>
                                                    <?php } ?>
            <?php } ?>
                                                    </tr>
                                                </tbody>
        <?php } ?> 	
                                                <?php } ?>
                                        

                                    </table>
                                </div>
<?php } else { ?>
                            <div class="show_wishlist_title">
                                <h2><?php echo $this->Lang['PRODUCT_DET']; ?></h2>
                            </div>
                                <div class="wishlist_empty">
                                    <p><?php echo $this->Lang['PLZ_AD_PRO']; ?></p>
                                    <img alt="logo" src="<?php echo PATH; ?>themes/<?php echo THEME_NAME; ?>/images/new/compare_empty.png"/>
                                </div>

<?php } ?>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

