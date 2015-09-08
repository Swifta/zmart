<?php defined('SYSPATH') OR die('No direct access allowed.');

/** API DEVELOPEMENT **/

/* Start - changes completed */ 

$config['api/module-settings.html'] = "api/module_settings";

$config['api/users/login.html'] = "/api/login";
$config['api/users/registration.html'] = "/api/registration";
$config['api/users/change_password.html'] = "/api/change_password";
$config['api/users/profile/(.*)/(.*).html'] = "/api/user_profile_data/$1/$2";
$config['api/users/edit-profile.html'] = "/api/edit_profile";
$config['api/users/forgot-password.html'] = "/api/forgot_password";
$config['api/users/shipping/(.*).html'] = "/api/user_shipping_data/$1";
$config['api/users/edit-shipping-address.html'] = "/api/edit_shipping";

$config['api/city-list/(.*).html'] = "api/city_list/$1";
$config['api/country-list/(.*).html'] = "api/country_list/$1";

$config['api/today-deals/(.*)/(.*).html'] = "api/today_deals/$1/$2";
$config['api/deals-category-listing/(.*)/(.*)/(.*)/(.*).html'] = "api/deals_category_listing/$1/$2/$3/$4";
$config['api/deal-details/(.*)/(.*)/(.*).html'] = "api/deal_details/$1/$2/$3";
$config['api/similar-deals-by-deal/(.*)/(.*)/(.*)/(.*).html'] = "api/similar_deals_by_deals/$1/$2/$3/$4";
$config['api/search-listing/(.*)/(.*)/(.*)/(.*).html'] = "api/search_listing/$1/$2/$3/$4";

$config['api/products-listing/(.*)/(.*).html'] = "api/product_listing/$1/$2";
$config['api/products-category-listing/(.*)/(.*)/(.*)/(.*).html'] = "api/products_category_listing/$1/$2/$3/$4";
$config['api/similar-product-by-products/(.*)/(.*)/(.*)/(.*).html'] = "api/similar_product_by_products/$1/$2/$3/$4";
$config['api/product-details/(.*)/(.*)/(.*).html'] = "api/product_details/$1/$2/$3";

$config['api/auctions-listing/(.*)/(.*).html'] = "api/auction_listing/$1/$2";
$config['api/auctions-category-listing/(.*)/(.*)/(.*)/(.*).html'] = "api/auction_category_listing/$1/$2/$3/$4";
$config['api/similar-auctions/(.*)/(.*)/(.*)/(.*).html'] = "api/similar_auctions/$1/$2/$3/$4";
$config['api/auction-details/(.*)/(.*)/(.*).html'] = "api/auction_details/$1/$2/$3";
$config['api/success-bidding.html'] = "api/success_bidding";
$config['api/winner-list/(.*)/(.*).html'] = "api/winner_list/$1/$2";

$config['api/store-list/(.*)/(.*).html'] = "api/store_list/$1/$2";
$config['api/store-detail/(.*)/(.*).html'] = "api/store_detail/$1/$2";
$config['api/similar-deals-and-stores/(.*)/(.*).html'] = "api/similar_deals_by_store/$1/$2";
$config['api/similar-product-stores/(.*)/(.*).html'] = "api/similar_product_by_store/$1/$2";

$config['api/deals-coupons-listing/(.*)/(.*).html'] = "api/deals_coupons_listing/$1/$2";
$config['api/product-coupons-listing/(.*)/(.*).html'] = "api/product_coupons_listing/$1/$2";
$config['api/auction-coupons-listing/(.*)/(.*).html'] = "api/auction_coupons_listing/$1/$2";

$config['api/geo-deals/(.*)/(.*)/(.*).html'] = "api/geo_deals/$1/$2/$3";
$config['api/geo-products/(.*)/(.*)/(.*).html'] = "api/geo_products/$1/$2/$3";
$config['api/geo-auctions/(.*)/(.*)/(.*).html'] = "api/geo_auctions/$1/$2/$3";

$config['api/deals/(.*)/(.*).html'] = "api/hot_deals_listing/$1/$2";
$config['api/deals/(.*)/(.*)/(.*).html'] = "api/hot_deals_listing/$1/$2/$3";

$config['api/products/(.*)/(.*).html'] = "api/hot_product_listing/$1/$2";
$config['api/products/(.*)/(.*)/(.*).html'] = "api/hot_product_listing/$1/$2/$3";

$config['api/auctions/(.*)/(.*).html'] = "api/hot_auction_listing/$1/$2";
$config['api/auctions/(.*)/(.*)/(.*).html'] = "api/hot_auction_listing/$1/$2/$3";

$config['api/category-list/(.*)/(.*)/(.*).html'] = "api/category_list/$1/$2/$3";
$config['api/sub-category-list/(.*)/(.*)/(.*)/(.*).html'] = "api/sub_category_list/$1/$2/$3/$4";
$config['api/second-sub-category-list/(.*)/(.*)/(.*)/(.*)/(.*).html'] = "api/second_sub_category_list/$1/$2/$3/$4/$5";
$config['api/third-sub-category-list/(.*)/(.*)/(.*)/(.*)/(.*).html'] = "api/third_sub_category_list/$1/$2/$3/$4/$5";
$config['api/comparison-product-details/(.*)/(.*)/(.*)/(.*)/(.*).html'] = "api/comparison_product_details/$1/$2/$3/$4/$5";

$config['api/filter-products/(.*)/(.*)/(.*)/(.*)/(.*)/(.*)/(.*).html'] = "api/filter_products/$1/$2/$3/$4/$5/$6/$7";
$config['api/get-size-list/(.*).html'] = "api/all_size_list/$1";
$config['api/get-color-list/(.*).html'] = "api/all_color_list/$1";

$config['api/all-deals-listing.html'] = "api/deals_listing";
$config['api/all-deals-listing/(.*).html'] = "api/deals_listing/$1";
$config['api/all-products-listing.html'] = "api/product_listing";
$config['api/all-products-listing/(.*).html'] = "api/product_listing/$1";
$config['api/all-auctions-listing.html'] = "api/auction_listing";
$config['api/all-auctions-listing/(.*).html'] = "api/auction_listing/$1";

/* End - changes completed */ 

$config['api/product-payment/creditcard.html'] = "api/product_dodirectpayment";
$config['api/product-payment/authorize.html'] = "api/product_authorize";
$config['api/product-payment/cash-delivery.html'] = "api/cash_delivery";

$config['api/deal-payment/creditcard.html'] = "api/dodirectpayment";
$config['api/deal-payment-friend/creditcard.html'] = "api/dodirectpayment";
$config['api/deal-payment-authorize/creditcard.html'] = "api/authorize_dodirectpayment";
$config['api/deal-payment-authorize-friend/creditcard.html'] = "api/authorize_dodirectpayment";

$config['api/similar-product-by-deal/(.*)/(.*).html'] = "api/similar_product_by_deal/$1/$2";
$config['api/similar-deals-by-product/(.*)/(.*).html'] = "api/similar_deals_by_product/$1/$2";
$config['api/deals-listing/(.*).html'] = "api/deals_listing/$1";
$config['api/star-rating.html'] = "api/star_rating";



/** END API DEVELOPEMENT **/
