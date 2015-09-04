<?php defined('SYSPATH') OR die('No direct access allowed.'); ?>

<?php if($this->view_type ==1) {    ?>

<script type="text/javascript">
$('.product-sec-sample32').mouseover(function() {
				var getUID =  $(this).attr('id').replace('product-sec-sample32-','');
				var id_val = $('#product-sec-sample32-'+getUID).attr('data-subcat');
					if(id_val==0)
					{
						$('#product_sec_category_'+getUID).css('display','none');
						$('.product-sec-categeory32-'+getUID).css('background','none');
					}
					else{
						//var getUID =  $(this).attr('id').replace('sample32-','');
						var url = Path+"products/all_products/?cate_id="+(getUID)+'&t=2';
						$.post(url,function(check){
							if(getUID!=""){
								$('.product-sec-categeory32-'+getUID).html(check);
								$('.product-sec-categeory32-'+getUID).show();
							}
						});
					}

			});
</script>			
<?php foreach($this->categeory_list as $cate){
	$type = "products";
		/*   COUNT OF SUBCATEGORY   */
		$check_sub_cat = common::get_subcat_count($cate->category_id,3,"sub",$cate->category_url);
		$subcate_count = common::get_subcat_count1($cate->category_id,$cate->type);
		$subcat_style = ($subcate_count==0)?"background:none":"";
		$encode_catid = $cate->category_id;		
?>

<?php if($check_sub_cat != 0){ ?>
<li><a style="cursor:pointer;<?php echo $subcat_style;?>" data-subcat="<?php echo $subcate_count; ?>" id="product-sec-sample32-<?php echo $encode_catid; ?>" class="product-sec-sample32 cate_subarr" onclick="filtercategory('<?php echo $cate->category_url; ?>','<?php echo $type; ?>','<?php echo base64_encode("sub"); ?>');" title="<?php echo ucfirst($cate->category_name); ?>"><?php echo ucfirst($cate->category_name).' ('.$check_sub_cat.')';?></a>

	<div class="cate_supmenu1" id="product_sec_category_<?php echo $encode_catid; ?>">		
		<ul  class="product-sec-categeory32-<?php echo $encode_catid; ?>">							
		</ul>
	</div>
																								
 </li>
<?php } ?>
<?php } ?>

<?php } else if($this->view_type ==2) {    ?>

<script type="text/javascript">
$('.product-third-sample32').mouseover(function() {
				var getUID =  $(this).attr('id').replace('product-third-sample32-','');
				var id_val = $('#product-third-sample32-'+getUID).attr('data-subcat');
					if(id_val==0)
					{
						$('#product_third_category_'+getUID).css('display','none');
						$('.product-third-categeory32-'+getUID).css('background','none');
					}
					else{
						//var getUID =  $(this).attr('id').replace('sample32-','');
						var url = Path+"products/all_products/?cate_id="+(getUID)+'&t=3';
						$.post(url,function(check){
							if(getUID!=""){
								$('.product-third-categeory32-'+getUID).html(check);
								$('.product-third-categeory32-'+getUID).show();
							}
						});
					}

			});
</script>			
<?php foreach($this->categeory_list as $cate){
	$type = "products";
		/*   COUNT OF SUBCATEGORY   */
		$check_sub_cat = common::get_subcat_count($cate->category_id,3,"sec",$cate->category_url);
		$subcate_count = common::get_subcat_count1($cate->category_id,$cate->type);
		$subcat_style = ($subcate_count==0)?"background:none":"";
		$encode_catid = $cate->category_id;		
?>

<?php if($check_sub_cat != 0){ ?>
<li><a style="cursor:pointer;<?php echo $subcat_style;?>" data-subcat="<?php echo $subcate_count; ?>" id="product-third-sample32-<?php echo $encode_catid; ?>" class="product-third-sample32 cate_subarr" onclick="filtercategory('<?php echo $cate->category_url; ?>','<?php echo $type; ?>','<?php echo base64_encode("sec"); ?>');" title="<?php echo ucfirst($cate->category_name); ?>"><?php echo ucfirst($cate->category_name).' ('.$check_sub_cat.')';?></a>

	<div class="cate_supmenu2" id="product_third_category_<?php echo $encode_catid; ?>">
		<ul class="product-third-categeory32-<?php echo $encode_catid; ?>">
                </ul>
	</div>
																								
 </li>
<?php } ?>
<?php } ?>


<?php } else if($this->view_type ==3) {    ?>

<?php foreach($this->categeory_list as $cate){
	$type = "products";
		/*   COUNT OF SUBCATEGORY   */
		$check_sub_cat = common::get_subcat_count($cate->category_id,3,"third",$cate->category_url);
		//$subcate_count = common::get_subcat_count1($cate->category_id,$cate->type);
		//$subcat_style = ($subcate_count==0)?"background:none":"";
		$encode_catid = $cate->category_id;		
?>

<?php if($check_sub_cat != 0){ ?>
<li><a style="cursor:pointer;" onclick="filtercategory('<?php echo $cate->category_url; ?>','<?php echo $type; ?>','<?php echo base64_encode("third"); ?>');" title="<?php echo ucfirst($cate->category_name); ?>"><?php echo ucfirst($cate->category_name).' ('.$check_sub_cat.')';?></a>
																								
 </li>
<?php } ?>
<?php } ?>

<?php } ?>
