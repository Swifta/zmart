<?php defined('SYSPATH') OR die('No direct access allowed.');

/** AUCTION  **/

$config['auction.html'] = "/auction/today_auction";
$config['auction/page/(.*)'] = "/auction/today_auction/$1";
$config['auction/(.*)/(.*).html'] ="/auction/details_auction/$1/$2";
$config['auction-c/(.*)/(.*).html'] ="/auction/categoery_list/$1/$2";
$config['auction-c/(.*)/(.*).html/page/(.*)'] ="/auction/categoery_list/$1/$2/$3";
$config['auction/winner.html'] = "/auction/winner";
$config['auction/winner.html/page/(.*)'] = "/auction/winner/$1";
$config['auction-rating.html']="/auction/auction_rating";
$config['auction/biding_close/(.*)']="/auction_paypal/biding_close/$1";
$config['auction/search.html'] ="/auction/search_list";
$config['auction/search.html/page/(.*)'] ="/auction/search_list/$1";

/** CRON JOB AUCTION CLOSE EVERY TIME **/

$config['auction/auction_close.html'] = "/welcome/auction_winner";
$config['auction/auction_alert.html'] = "/welcome/auction_alert";
$config['auction/auction_close_mail.html'] = "/welcome/auction_close_mail";
$config['auction/auction_mail.html'] = "/welcome/auction_mail";

$config['(.*)/auction/(.*)/(.*).html'] ="/auction/details_auction/$1/$2/$3";


