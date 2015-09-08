<?php defined('SYSPATH') OR die('No direct access allowed.');

$config['stores.html'] = "/stores/store_list";
$config['stores/page/(.*)'] = "/stores/store_list";
$config['stores_details.html'] = "/stores/store_detail";
$config['stores/(.*)/(.*).html'] ="/stores/store_detail/$1/$2";
$config['stores/search.html'] ="/stores/search_list";
$config['stores/search.html/page/(.*)'] ="/stores/search_list/$1";
$config['store-rating.html']="/stores/store_rating";

