<?php defined('SYSPATH') OR die('No direct access allowed.');


// test-store Start
$config['test-store'] ="fashion3/stores_home_page/test-store";
$config['test-store/products.html'] = "/fashion3/product_list/test-store";
$config['test-store/today-deals.html'] = "/fashion3/deal_list/test-store";
$config['test-store/auction.html'] = "/fashion3/auction_list/test-store";
$config['test-store/products/c/(.*)/(.*).html'] = "/fashion3/product_list/test-store/$1/$2";
$config['test-store/deal/c/(.*)/(.*).html'] = "/fashion3/deal_list/test-store/$1/$2";
$config['test-store/auction/c/(.*)/(.*).html'] = "/fashion3/auction_list/test-store/$1/$2";
// test-store End
