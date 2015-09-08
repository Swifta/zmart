<?php defined('SYSPATH') OR die('No direct access allowed.'); ?>
<?php /* Pagination */ ?>
<script type="text/javascript">
    $(document).ready(function () {
        $('a.cart_button').live("click", function(e){
            var offset  = 0;
            offset = document.getElementById('offset').value;
            var record = document.getElementById('record').value;
            var record1 = document.getElementById('record1').value;
	    
            var url = '<?php echo PATH; ?>'+'stores/store_list_1?offset='+offset+'&record='+record;
            $.post(url,function(check){ 

                if(check){ 
				  
                    $('#stores').append(check);
                    $('#loading').show();
                    offset = parseInt(offset)+8;

                    $("#offset").val(offset);

                    if(offset >= record1 ) {

                        $('#loading').hide();

                    }
                    $('.wloader_img').hide();

                }
            });     
        
        });
    });

</script>

    <div class="contianer_outer1">
        <div class="contianer_inner">
            <div class="contianer">
                <div class="bread_crumb">
                    <ul>
                        <li><p><a href="<?php echo PATH; ?>" title="<?php echo $this->Lang['HOME']; ?>"><?php echo $this->Lang['HOME']; ?></a></p></li>

                        <li><p><?php if (isset($this->store_search)) { ?> <a href="<?php echo PATH; ?>stores.html" title="<?php echo $this->Lang['STORES']; ?>"><?php echo $this->Lang['STORES']; ?></a></p> <?php } else { ?><?php echo $this->Lang['STORES']; ?> <?php } ?></p> </li>
                        <?php if (isset($this->store_search)) { ?>
                            <li><p><?php echo ucfirst($this->store_search); ?></p></li>
                        <?php } ?>

                    </ul>
                </div>
			<?php if (count($this->store_details) > 0) { ?>
                <!--content start-->
                <div class="content_abouts">                    
                    <h2 class="inner_commen_title"><?php echo $this->Lang['STORES']; ?></h2>                    
                    <div class="pro_top" style="border:none;">
                        <!--div class="common_ner_commont1">
                        <div class="common_ner_commont">
                        <h2><?php echo $this->Lang['STORES']; ?> </h2>
                        </div>
                        </div-->
                        <div class="content_store_list">
                            <div id="stores">
                                <?php echo new View("themes/" . THEME_NAME . "/all_store_listing"); ?>
                            </div>

                            <?php if (($this->uri->last_segment() == "stores.html") && ($this->store_details_count > 1)) { ?>
                                <div id="loading">
                                    <?php if (($this->pagination) != "") { ?> 
                                        <div class="feature_viewmore">
                                            <div class="fea_view_more">
                                                    <a class="view_more view_more1 view_more_but cart_button">
                                                        <span class="view_more_icon">&nbsp;</span><?php echo $this->Lang['SEE_MORE']; ?><span class="view_more_icon">&nbsp;</span>
                                                    </a> 
                                            </div>
                                        </div>
                                    <?php } ?>
                                </div>
                            <?php } ?> 

                        </div>
                    </div>  
                </div>
                <!--end-->
   
<?php } else { ?>
    <?php echo new View("themes/" . THEME_NAME . "/subscribe"); ?>
<?php } ?>

            </div>
        </div>
    </div>

    <!--scroll filter start-->
    <input type="hidden" name="offset" id="offset" value="8">
    <input type="hidden" name="record" id="record" value="8">
    <input type="hidden" name="record" id="record1" value="<?php echo $this->store_details_count; ?>">

    <!--scroll filter end-->
