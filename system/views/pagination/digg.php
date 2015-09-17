<?php defined('SYSPATH') OR die('No direct access allowed.');
/**
 * Digg pagination style
 * 
 * @preview  « Previous  1 2 … 5 6 7 8 9 10 11 12 13 14 … 25 26  Next »
 *
 **/
?>

<?php 

	$previous_page = $current_page - 1;
	$url =  PATH.substr($url, 1);
 ?>
<div class="pagination">
	<ul>

	<?php if ($previous_page): ?>
		<li><a href="<?php echo str_replace('{page}', $previous_page, $url) ?>">&laquo;&nbsp;Previous</a></li>
	<?php endif ?>


	<?php if ($total_pages < 13): /* « Previous  1 2 3 4 5 6 7 8 9 10 11 12  Next » */ ?>

		<?php for ($i = 1; $i <= $total_pages; $i++): ?>
			<?php if ($i == $current_page): ?>
				<li><p><?php echo $i ?></p></li>
			<?php else: ?>
				<li><a href="<?php echo str_replace('{page}', $i, $url) ?>"><?php echo $i ?></a></li>
			<?php endif ?>
		<?php endfor ?>

	<?php elseif ($current_page < 9): /* « Previous  1 2 3 4 5 6 7 8 9 10 … 25 26  Next » */ ?>

		<?php for ($i = 1; $i <= 10; $i++): ?>
			<?php if ($i == $current_page): ?>
				<li><p><?php echo $i ?></p></li>
			<?php else: ?>
				<li><a href="<?php echo str_replace('{page}', $i, $url) ?>"><?php echo $i ?></a></li>
			<?php endif ?>
		<?php endfor ?>

		<li><span>&hellip;</span></li>
		<li><a href="<?php echo str_replace('{page}', $total_pages - 1, $url) ?>"><?php echo $total_pages - 1 ?></a></li>
		<li><a href="<?php echo str_replace('{page}', $total_pages, $url) ?>"><?php echo $total_pages ?></a></li>

	<?php elseif ($current_page > $total_pages - 8): /* « Previous  1 2 … 17 18 19 20 21 22 23 24 25 26  Next » */ ?>

		<li><a href="<?php echo str_replace('{page}', 1, $url) ?>">1</a></li>
		<li><a href="<?php echo str_replace('{page}', 2, $url) ?>">2</a></li>
		<li><span>&hellip;</span></li>

		<?php for ($i = $total_pages - 9; $i <= $total_pages; $i++): ?>
			<?php if ($i == $current_page): ?>
				<li><p><?php echo $i ?></p></li>
			<?php else: ?>
				<li><a href="<?php echo str_replace('{page}', $i, $url) ?>"><?php echo $i ?></a></li>
			<?php endif ?>
		<?php endfor ?>

	<?php else: /* « Previous  1 2 … 5 6 7 8 9 10 11 12 13 14 … 25 26  Next » */ ?>

		<li><a href="<?php echo str_replace('{page}', 1, $url) ?>">1</a></li>
		<li><a href="<?php echo str_replace('{page}', 2, $url) ?>">2</a></li>
		<li><span>&hellip;</span></li>
		<?php for ($i = $current_page - 3; $i <= $current_page + 3; $i++): ?>
			<?php if ($i == $current_page): ?>
				<li><p><?php echo $i ?></p></li>
			<?php else: ?>
				<li><a href="<?php echo str_replace('{page}', $i, $url) ?>"><?php echo $i ?></a></li>
			<?php endif ?>
		<?php endfor ?>

		<li><span>&hellip;</span></li>
		<li><a href="<?php echo str_replace('{page}', $total_pages - 1, $url) ?>"><?php echo $total_pages - 1 ?></a></li>
		<li><a href="<?php echo str_replace('{page}', $total_pages, $url) ?>"><?php echo $total_pages ?></a></li>

	<?php endif ?>


	<?php if ($next_page): ?>
		<li><a href="<?php echo str_replace('{page}', $next_page, $url) ?>">Next&nbsp;&raquo;</a></li>
	<?php endif ?>
	 </ul>
</div>
