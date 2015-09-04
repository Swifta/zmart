<?php defined('SYSPATH') OR die('No direct access allowed.');

/** WEBSITE COMMON PAGE **/

$config['/'] = '/welcome/path_url';
$config['_default'] = '/welcome';
$config['/page/(.*)'] = '/welcome/index/-1/$1';
$config['changecity/(.*)/(.*).html'] = "/welcome/changecity/$1/$2";
$config['/deals/rss/(.*)/(.*)'] = "/welcome/rss/$1/$2";
$config['rss'] = "/welcome/rss_all";
$config['theme/(.*).html'] = "/welcome/set_session_theme/$1";
$config['/theme/(.*)'] = "/welcome/theme_change/$1";
$config['subscribe.html'] = "welcome/subscriber";
$config['referral/(.*)'] ="/welcome/referral_signup/$1";
$config['cron_rundeals.html'] = "/welcome/run_cron_job";
$config['send_newsletter.html'] = "/welcome/send_news_letter";
$config['emailsubscribe.html'] = "/welcome/email_subscribe";
$config['(.*)/delete-(.*)-comments/(.*).html'] = "/welcome/delete_users_comments/$1";
$config['shop-all-category.html'] = '/welcome/show_all_category';

/** CMS PAGE **/

$config['about-us.html'] = "/welcome/about_us";
$config['contactus.html'] = "/welcome/contact_us";
$config['(.*).php'] = "welcome/cms/$1";
$config['merchant/(.*)/(.*)/(.*).html'] = "welcome/merchant_cms/$1/$2/$3";
$config['(.*)/merchant-cms/(.*)/(.*).html'] = "welcome/merchant_cms/$1/$2/$3";

/** FAQ PAGE **/

$config['faq.html'] = "/welcome/faq";
$config['faq.html/page/(.*)'] = "/welcome/faq/$1";

/** NEAR ME MAP PAGE **/

$config['near-map.html'] = "/welcome/near_map";
$config['nearmap.html'] = "/welcome/near_map";



