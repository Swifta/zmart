<?php defined('SYSPATH') OR die('No direct access allowed.');


/** PRODUCTS PAGE **/

$config['products.html'] = "/products/all_products";
$config['products/page/(.*)'] = "/products/all_products/$1";
$config['product/(.*)/(.*).html'] ="/products/details_product/$1/$2";
$config['products/c/(.*)/(.*).html'] ="/products/categoery_list/$1/$2";
$config['products/c/(.*)/(.*).html/page/(.*)'] ="/products/categoery_list/$1/$2";
$config['products/search.html'] ="/products/search_list";
$config['products/search.html/page/(.*)'] ="/products/search_list/$1";
$config['product-rating.html']="/products/product_rating";
$config['product/addtocart/(.*)/(.*)'] ="/payment_product/cart_items/$1/$2";
$config['products/color_filter/(.*).html'] ="/products/color_list/$1";
$config['products/color_filter/(.*).html/page/(.*)'] ="/products/categoery_list/$1";

/** PRODUCTS COMPARE **/

$config["product-compare.html"] = "products/productcompare";

/** PAYMENT PAGES **/

$config['prodicts/cart.html'] ="/payment_product/cart_products_item";
$config['cart_checkout.html'] ="/payment_product/cart_checkout_item";
$config['cart.html'] ="/payment_product/cart_products_item";
$config['payment_product/cart_payment_paypal.html'] ="/payment_product/cart_payment_paypal";
$config['payment_product/pay_later_transaction.html'] ="/payment_product/pay_later_transaction";
$config['payment_product/problem_payment_paypal.html'] ="/payment_product/problem_payment_paypal";
$config['product/payment_details_friend.html'] ="/payment_product/cart_checkout_item";

/** WISHLIST PAGES **/

$config["wishlist.html"] = "/products/wishlist";
$config['wishlist.html/(.*)'] = "/products/wishlist/$1";
$config['delete-wishlist/(.*).html'] = "/products/remove_wishlist/$1";

$config['(.*)/product/(.*)/(.*).html'] ="/products/details_product/$1/$2/$3";
/* store credits product */
$config['storecredits-products.html'] = "/products/all_products_store_credits";
$config['storecredits-products/page/(.*)'] = "/products/all_products_store_credits/$1";
$config['storecredits-products/c/(.*)/(.*).html'] ="/products/storecredits_categoery_list/$1/$2";
$config['storecredits-products/c/(.*)/(.*).html/page/(.*)'] ="/products/storecredits_categoery_list/$1/$2";
