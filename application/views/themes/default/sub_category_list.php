<?php defined('SYSPATH') OR die('No direct access allowed.'); ?>
<?php if($this->view_type ==1) {    ?>
	 <script >
		 $('.submit-link1').click(function(e){ 
								   
			   var cat = $(this).attr('id').replace('samples-','').split('-');
			   $('input[name="c"]').val((cat[0]));
			   $('input[name="m_c"]').val((cat[1]));
			   $('input[name="c_t"]').val('<?php echo("sub"); ?>');
			   
			   e.preventDefault();
				$(this).closest('form').submit();
                                               
		});

			 $('.submit-link1').mouseover(function(e){
				 
			   var cat = $(this).attr('id').replace('samples-','').split('-');
			   var a = cat[0];
			   var b = cat[1];
			   $('input[name="c"]').val((a));
			   $('input[name="m_c"]').val((b));
			   
			//	var getUID =  $(this).attr('id').replace('sample-','');
				var id_val = $('#samples-'+a+'-'+b).attr('data-subcat');
				if(id_val==0)
				{
					$('#sec_sub_category_'+a).css('display','none');
					$('#samples-'+a+'-'+b).css('background','none');
				}
				else{
					var url = Path+"welcome/show_category/?cate_id="+(a)+'&t=2';
					$.post(url,function(check){
						if(a!=""){ 
							$('#sec_categeory1-'+a).html(check);
							$('#sec_categeory1-'+a).show();
						}		
					});
				}
                                               
			});
		
	</script>                              
												
			<?php foreach($this->categeory_list as $cate){  $type = "";
					/*   COUNT OF SUBCATEGORY   */
					$check_sub_cat = common::get_subcat_count($cate->category_id,$this->type,'sub',$cate->category_url);

				$subcate_count = common::get_subcat_count1($cate->category_id,$cate->type);
				$subcat_style = ($subcate_count==0)?"background:none":"";
				$encode_catid = $cate->category_id;

			 ?>
											
			  <li> <a style="cursor:pointer;<?php echo $subcat_style;?>" data-subcat="<?php echo $subcate_count; ?>"  class="submit-link1 cate_subarr" id="samples-<?php echo ($cate->category_id)."-".($cate->main_category_id); ?>"title="<?php echo ucfirst($cate->category_name); ?>"><?php echo $cate->category_name.' ('.$check_sub_cat.')';?></a>

					<div class="cate_supmenu1" id="sec_sub_category_<?php echo $encode_catid; ?>">						
						<ul id="sec_categeory1-<?php echo $encode_catid; ?>">
							<!--<a style="cursor:pointer;" ><div id="sec_categeory1-<?php echo $encode_catid; ?>"></div></a>-->
						</ul>
					</div>
					
			  </li>
												
			<?php }  ?>		
		
<?php } else if($this->view_type == 2 ) { ?>

		 <script >
		 $('.submit-link2').click(function(e){ 
								   
			   var cat = $(this).attr('id').replace('samples1-','').split('-');
			   $('input[name="c"]').val((cat[0]));
			   $('input[name="m_c"]').val((cat[1]));
			   $('input[name="c_t"]').val('<?php echo ("sec"); ?>');
			   
			   e.preventDefault();
				$(this).closest('form').submit();
                                               
		});

			 $('.submit-link2').mouseover(function(e){
				 
			   var cat = $(this).attr('id').replace('samples1-','').split('-');
			   var a = cat[0];
			   var b = cat[1];
			   $('input[name="c"]').val((a));
			   $('input[name="m_c"]').val((b));
			   
			//	var getUID =  $(this).attr('id').replace('sample-','');
				var id_val = $('#samples1-'+a+'-'+b).attr('data-subcat');
				if(id_val==0)
				{
					$('#third_sub_category_'+a).css('display','none');
					$('#samples1-'+a+'-'+b).css('background','none');
				}
				else{
					var url = Path+"welcome/show_category/?cate_id="+(a)+'&t=3';
					$.post(url,function(check){
						if(a!=""){
							$('#third_categeory1-'+a).html(check);
							$('#third_categeory1-'+a).show();
						}		
					});
				}
                                               
			});
		
	</script>                              
												
			<?php foreach($this->categeory_list as $cate){  $type = "";
					/*   COUNT OF SUBCATEGORY   */
					$check_sub_cat = common::get_subcat_count($cate->category_id,$this->type,'sec',$cate->category_url);

				$subcate_count = common::get_subcat_count1($cate->category_id,$cate->type);
				$subcat_style = ($subcate_count==0)?"background:none":"";
				$encode_catid = $cate->category_id;

			 ?>
											
			  <li> <a style="cursor:pointer;<?php echo $subcat_style;?>" data-subcat="<?php echo $subcate_count; ?>"  class="submit-link2 cate_subarr" id="samples1-<?php echo ($cate->category_id)."-".($cate->main_category_id); ?>"title="<?php echo ucfirst($cate->category_name); ?>"><?php echo $cate->category_name.' ('.$check_sub_cat.')';?></a>

					<div class="cate_supmenu2" id="third_sub_category_<?php echo $encode_catid; ?>">						
						<ul id="third_categeory1-<?php echo $encode_catid; ?>">							
						</ul>
					</div>
					
			  </li>
												
			<?php }  ?>		
		
 					
                                 


<?php } else if($this->view_type == 3 ) { ?>

			 <script >
		 $('.submit-link3').click(function(e){ 
								   
			   var cat = $(this).attr('id').replace('samples2-','').split('-');
			   $('input[name="c"]').val((cat[0]));
			   $('input[name="m_c"]').val((cat[1]));
			   $('input[name="c_t"]').val('<?php echo ("third"); ?>');
			   
			   e.preventDefault();
				$(this).closest('form').submit();
                                               
		});

		
	</script>                              
												
			<?php foreach($this->categeory_list as $cate){  $type = "";
					/*   COUNT OF SUBCATEGORY   */
					$check_sub_cat = common::get_subcat_count($cate->category_id,$this->type,'third',$cate->category_url);

				/*$subcate_count = common::get_subcat_count1($cate->category_id,$cate->type);
				$subcat_style = ($subcate_count==0)?"background:none":""; */
				$encode_catid = $cate->category_id;

			 ?>
											
			  <li> <a style="cursor:pointer;"  class="submit-link3" id="samples2-<?php echo ($cate->category_id)."-".($cate->main_category_id); ?>"title="<?php echo ucfirst($cate->category_name); ?>"><?php echo $cate->category_name.' ('.$check_sub_cat.')';?></a>
					
			  </li>
												
			<?php }  ?>		
		
 					
                                 


<?php } ?>				
                                 
