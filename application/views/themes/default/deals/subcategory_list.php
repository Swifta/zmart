<?php defined('SYSPATH') OR die('No direct access allowed.'); ?>

<?php if($this->view_type ==1) {    ?>

<script type="text/javascript">
$('.deal-sec-sample32').mouseover(function() {
	var getUID =  $(this).attr('id').replace('deal-sec-sample32-','');
	var id_val = $('#deal-sec-sample32-'+getUID).attr('data-subcat');
		if(id_val==0)
		{
			$('#deal_sec_category_'+getUID).css('display','none');
			$('.deal-sec-categeory32-'+getUID).css('background','none');
		}
		else{
			//var getUID =  $(this).attr('id').replace('sample32-','');
			var url = Path+"deals/today_deals/?cate_id="+(getUID)+'&t=2';
			$.post(url,function(check){
				if(getUID!=""){
					$('.deal-sec-categeory32-'+getUID).html(check);
					$('.deal-sec-categeory32-'+getUID).show();
				}
			});
		}

});
</script>			
<?php foreach($this->categeory_list as $cate){
	$type = "deal";
		/*   COUNT OF SUBCATEGORY   */
		$check_sub_cat = common::get_subcat_count($cate->category_id,2,"sub",$cate->category_url);
		$subcate_count = common::get_subcat_count1($cate->category_id,$cate->type);
		$subcat_style = ($subcate_count==0)?"background:none":"";
		$encode_catid = $cate->category_id;		
?>
<?php if($check_sub_cat != 0) { ?>

<li><a style="cursor:pointer;<?php echo $subcat_style;?>" data-subcat="<?php echo $subcate_count; ?>" id="deal-sec-sample32-<?php echo $encode_catid; ?>" class="deal-sec-sample32 cate_subarr" onclick="filtercategory('<?php echo $cate->category_url; ?>','<?php echo $type; ?>','<?php echo base64_encode("sub"); ?>');" title="<?php echo ucfirst($cate->category_name); ?>"><?php echo ucfirst($cate->category_name).' ('.$check_sub_cat.')';?></a>

	<div class="cate_supmenu1" id="deal_sec_category_<?php echo $encode_catid; ?>">
		<ul class="deal-sec-categeory32-<?php echo $encode_catid; ?>">
		</ul>
	</div>
																								
 </li>
<?php } ?>
<?php } ?>

<?php } else if($this->view_type ==2) {    ?>

<script type="text/javascript">
$('.deal-third-sample32').mouseover(function() {
	var getUID =  $(this).attr('id').replace('deal-third-sample32-','');
	var id_val = $('#deal-third-sample32-'+getUID).attr('data-subcat');
		if(id_val==0)
		{
			$('#deal_third_category_'+getUID).css('display','none');
			$('.deal-third-categeory32-'+getUID).css('background','none');
		}
		else{
			//var getUID =  $(this).attr('id').replace('sample32-','');
			var url = Path+"deals/today_deals/?cate_id="+(getUID)+'&t=3';
			$.post(url,function(check){
				if(getUID!=""){
					$('.deal-third-categeory32-'+getUID).html(check);
					$('.deal-third-categeory32-'+getUID).show();
				}
			});
		}

});
</script>			
<?php foreach($this->categeory_list as $cate){
	$type = "deal";
		/*   COUNT OF SUBCATEGORY   */
		$check_sub_cat = common::get_subcat_count($cate->category_id,2,"sec",$cate->category_url);
		$subcate_count = common::get_subcat_count1($cate->category_id,$cate->type);
		$subcat_style = ($subcate_count==0)?"background:none":"";
		$encode_catid = $cate->category_id;		
?>

<?php if($check_sub_cat != 0) { ?>
<li><a style="cursor:pointer;<?php echo $subcat_style;?>" data-subcat="<?php echo $subcate_count; ?>" id="deal-third-sample32-<?php echo $encode_catid; ?>" class="deal-third-sample32 cate_subarr" onclick="filtercategory('<?php echo $cate->category_url; ?>','<?php echo $type; ?>','<?php echo base64_encode("sec"); ?>');" title="<?php echo ucfirst($cate->category_name); ?>"><?php echo ucfirst($cate->category_name).' ('.$check_sub_cat.')';?></a>

	<div class="cate_supmenu2" id="deal_third_category_<?php echo $encode_catid; ?>">		
		 <ul class="deal-third-categeory32-<?php echo $encode_catid; ?>">
		</ul>
	</div>
																								
 </li>
<?php } ?>
<?php } ?>


<?php } else if($this->view_type ==3) {    ?>

<?php foreach($this->categeory_list as $cate){
	$type = "deal";
		/*   COUNT OF SUBCATEGORY   */
		$check_sub_cat = common::get_subcat_count($cate->category_id,2,"third",$cate->category_url);
		//$subcate_count = common::get_subcat_count1($cate->category_id,$cate->type);
		//$subcat_style = ($subcate_count==0)?"background:none":"";
		$encode_catid = $cate->category_id;		
?>

<?php if($check_sub_cat != 0) { ?>
<li><a style="cursor:pointer;" onclick="filtercategory('<?php echo $cate->category_url; ?>','<?php echo $type; ?>','<?php echo base64_encode("third"); ?>');" title="<?php echo ucfirst($cate->category_name); ?>"><?php echo ucfirst($cate->category_name).' ('.$check_sub_cat.')';?></a>
																								
 </li>
<?php } ?>
<?php } ?>

<?php } ?>

                 
