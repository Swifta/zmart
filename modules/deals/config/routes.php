<?php defined('SYSPATH') OR die('No direct access allowed.');

/** DEALS PAGE **/

$config['today-deals.html'] = "/deals/today_deals";
$config['today-deals/page/(.*)'] = "/deals/today_deals/$1";
$config['deals/(.*)/(.*).html'] ="/deals/details_deals/$1/$2";
$config['deals/(.*).html'] ="/users/user_deals/$1";
$config['deal/c/(.*)/(.*).html'] ="/deals/categoery_list/$1/$2";
$config['deal/c/(.*)/(.*).html/page/(.*)'] ="/deals/categoery_list/$1/$2/$3";
$config['deals/search.html'] ="/deals/search_list";
$config['deals/search.html/page/(.*)'] ="/deals/search_list/$1";
$config['deal-rating.html']="/deals/deal_rating";

/** PAYMENT PAGES **/

$config['deals_payment/p/(.*)/(.*).html'] ="/payment/payment_deals/$1/$2";
$config['deal/payment_details/(.*)/(.*).html'] ="/payment/payment_details/$1/$2";
$config['deal/payment_details_friend/(.*)/(.*).html'] ="/payment/payment_details_friend/$1/$2";

$config['(.*)/deals/(.*)/(.*).html'] ="/deals/details_deals/$1/$2/$3";

