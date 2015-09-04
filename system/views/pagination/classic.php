<?php defined('SYSPATH') OR die('No direct access allowed.');
/**
 * Classic pagination style
 * 
 * @preview  ‹ First  < 1 2 3 >  Last ›
 */
?>

<p class="pagination">

    <?php
	
	
			$url = PATH.substr($url,1);
	
			$previous_page = $current_page -1 ;
			if($previous_page > 0){
	?>
    	<a href="<?php echo str_replace('{page}', $previous_page, $url) ?>"><strong>Back</strong></a>&nbsp;&nbsp;
    
	<?php } ?>

	<?php if ($next_page): ?>
		<a href="<?php echo str_replace('{page}', $next_page, $url) ?>"><strong>More</strong></a>
	<?php endif ?>

</p>