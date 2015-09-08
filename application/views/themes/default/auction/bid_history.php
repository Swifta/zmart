	<?php $i = 1;  foreach ($this->transaction_details as $tran) { ?>
		<li <?php if($i%2 ==0){ ?>class="bidslist_bg" <?php } ?>>
			<div class="bidder_name_date">
				<p><?php echo $tran->firstname; ?> <?php echo $tran->lastname; ?></p>
				<span><?php echo date("d-m-Y h:i:s A", $tran->transaction_date); ?></span>
			</div>
			<div class="bidder_amount">
				<p><?php echo CURRENCY_SYMBOL . " " . $tran->bid_amount; ?>
				</p>											
			</div>
		</li>
	<?php $i++; } ?>					
					
