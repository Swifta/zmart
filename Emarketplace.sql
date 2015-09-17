-- phpMyAdmin SQL Dump
-- version 3.5.7
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Aug 31, 2015 at 05:40 PM
-- Server version: 5.1.73
-- PHP Version: 5.3.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `Emarketplace`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_moderator_privileges_map`
--

CREATE TABLE IF NOT EXISTS `admin_moderator_privileges_map` (
  `privileges_id` int(11) NOT NULL AUTO_INCREMENT,
  `moderator_id` int(11) NOT NULL,
  `privileges_dashboard` int(1) NOT NULL DEFAULT '1',
  `privileges_deals` int(1) NOT NULL,
  `privileges_deals_add` int(1) NOT NULL,
  `privileges_deals_edit` int(1) NOT NULL,
  `privileges_deals_block` int(1) NOT NULL,
  `privileges_products` int(1) NOT NULL,
  `privileges_products_add` int(1) NOT NULL,
  `privileges_products_edit` int(1) NOT NULL,
  `privileges_products_block` int(1) NOT NULL,
  `privileges_auctions` int(1) NOT NULL,
  `privileges_auctions_add` int(1) NOT NULL,
  `privileges_auctions_edit` int(1) NOT NULL,
  `privileges_auctions_block` int(1) NOT NULL,
  `privileges_customer` int(1) NOT NULL,
  `privileges_customer_add` int(1) NOT NULL,
  `privileges_customer_edit` int(1) NOT NULL,
  `privileges_customer_block` int(1) NOT NULL,
  `privileges_merchant` int(1) NOT NULL,
  `privileges_merchant_add` int(1) NOT NULL,
  `privileges_merchant_edit` int(1) NOT NULL,
  `privileges_merchant_block` int(1) NOT NULL,
  `privileges_transactions` int(1) NOT NULL,
  `privileges_blogs` int(1) NOT NULL,
  `privileges_blogs_add` int(1) NOT NULL,
  `privileges_blogs_edit` int(1) NOT NULL,
  `privileges_blogs_block` int(1) NOT NULL,
  `privileges_cms` int(1) NOT NULL,
  `privileges_cms_add` int(1) NOT NULL,
  `privileges_cms_edit` int(1) NOT NULL,
  `privileges_cms_block` int(1) NOT NULL,
  `privileges_attributs` int(1) NOT NULL,
  `privileges_attributs_add` int(1) NOT NULL,
  `privileges_attributs_edit` int(1) NOT NULL,
  `privileges_attributs_block` int(1) NOT NULL,
  `privileges_categories` int(1) NOT NULL,
  `privileges_categories_add` int(1) NOT NULL,
  `privileges_categories_edit` int(1) NOT NULL,
  `privileges_categories_block` int(1) NOT NULL,
  `privileges_country` int(1) NOT NULL,
  `privileges_country_add` int(1) NOT NULL,
  `privileges_country_edit` int(1) NOT NULL,
  `privileges_country_block` int(1) NOT NULL,
  `privileges_city` int(1) NOT NULL,
  `privileges_city_add` int(1) NOT NULL,
  `privileges_city_edit` int(1) NOT NULL,
  `privileges_city_block` int(1) NOT NULL,
  `privileges_fundrequest` int(1) NOT NULL,
  `privileges_fundrequest_edit` int(1) NOT NULL,
  `privileges_daily_newsletter` int(1) NOT NULL,
  `privileges_storecredit` int(1) NOT NULL,
  `privileges_customercare` int(1) NOT NULL,
  `privileges_customercare_add` int(1) NOT NULL,
  `privileges_customercare_edit` int(1) NOT NULL,
  `privileges_customercare_block` int(1) NOT NULL,
  `privileges_banner` int(1) NOT NULL,
  `privileges_banner_add` int(1) NOT NULL,
  `privileges_banner_edit` int(1) NOT NULL,
  `privileges_banner_block` int(1) NOT NULL,
  `privileges_specification` int(1) NOT NULL,
  `privileges_specification_add` int(1) NOT NULL,
  `privileges_specification_edit` int(1) NOT NULL,
  `privileges_specification_block` int(1) NOT NULL,
  `privileges_sector` int(1) NOT NULL,
  `privileges_sector_add` int(1) NOT NULL,
  `privileges_sector_edit` int(1) NOT NULL,
  `privileges_sector_block` int(1) NOT NULL,
  `privileges_ads` int(1) NOT NULL,
  `privileges_ads_add` int(1) NOT NULL,
  `privileges_ads_edit` int(1) NOT NULL,
  `privileges_ads_block` int(1) NOT NULL,
  `privileges_faq` int(1) NOT NULL,
  `privileges_faq_add` int(1) NOT NULL,
  `privileges_faq_edit` int(1) NOT NULL,
  `privileges_faq_block` int(1) NOT NULL,
  `privileges_newsletter` int(1) NOT NULL,
  `privileges_newsletter_add` int(1) NOT NULL,
  `privileges_newsletter_edit` int(1) NOT NULL,
  `privileges_newsletter_block` int(1) NOT NULL,
  PRIMARY KEY (`privileges_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `admin_moderator_privileges_map`
--

INSERT INTO `admin_moderator_privileges_map` (`privileges_id`, `moderator_id`, `privileges_dashboard`, `privileges_deals`, `privileges_deals_add`, `privileges_deals_edit`, `privileges_deals_block`, `privileges_products`, `privileges_products_add`, `privileges_products_edit`, `privileges_products_block`, `privileges_auctions`, `privileges_auctions_add`, `privileges_auctions_edit`, `privileges_auctions_block`, `privileges_customer`, `privileges_customer_add`, `privileges_customer_edit`, `privileges_customer_block`, `privileges_merchant`, `privileges_merchant_add`, `privileges_merchant_edit`, `privileges_merchant_block`, `privileges_transactions`, `privileges_blogs`, `privileges_blogs_add`, `privileges_blogs_edit`, `privileges_blogs_block`, `privileges_cms`, `privileges_cms_add`, `privileges_cms_edit`, `privileges_cms_block`, `privileges_attributs`, `privileges_attributs_add`, `privileges_attributs_edit`, `privileges_attributs_block`, `privileges_categories`, `privileges_categories_add`, `privileges_categories_edit`, `privileges_categories_block`, `privileges_country`, `privileges_country_add`, `privileges_country_edit`, `privileges_country_block`, `privileges_city`, `privileges_city_add`, `privileges_city_edit`, `privileges_city_block`, `privileges_fundrequest`, `privileges_fundrequest_edit`, `privileges_daily_newsletter`, `privileges_storecredit`, `privileges_customercare`, `privileges_customercare_add`, `privileges_customercare_edit`, `privileges_customercare_block`, `privileges_banner`, `privileges_banner_add`, `privileges_banner_edit`, `privileges_banner_block`, `privileges_specification`, `privileges_specification_add`, `privileges_specification_edit`, `privileges_specification_block`, `privileges_sector`, `privileges_sector_add`, `privileges_sector_edit`, `privileges_sector_block`, `privileges_ads`, `privileges_ads_add`, `privileges_ads_edit`, `privileges_ads_block`, `privileges_faq`, `privileges_faq_add`, `privileges_faq_edit`, `privileges_faq_block`, `privileges_newsletter`, `privileges_newsletter_add`, `privileges_newsletter_edit`, `privileges_newsletter_block`) VALUES
(2, 24, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 0, 0, 0, 1, 0, 0, 0, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 0, 0, 0, 0, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `ads`
--

CREATE TABLE IF NOT EXISTS `ads` (
  `ads_id` int(5) NOT NULL AUTO_INCREMENT,
  `ads_title` varchar(100) NOT NULL,
  `ads_code` text NOT NULL,
  `ads_position` varchar(10) NOT NULL,
  `page_position` varchar(10) NOT NULL,
  `redirect_url` text NOT NULL,
  `status` int(1) DEFAULT '1',
  PRIMARY KEY (`ads_id`),
  KEY `add_id` (`ads_id`),
  KEY `add_id_2` (`ads_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=30 ;

--
-- Dumping data for table `ads`
--

INSERT INTO `ads` (`ads_id`, `ads_title`, `ads_code`, `ads_position`, `page_position`, `redirect_url`, `status`) VALUES
(1, 'Home', '', 'hs1', '1', 'https://www.google.co.in/', 1),
(2, 'Home', '', 'hs2', '1', 'https://www.google.co.in/', 1),
(3, 'deal', '', 'hr', '2', 'https://www.google.co.in/', 1),
(4, 'Auction', '', 'hr', '4', 'https://www.google.co.in/', 1),
(5, 'Home', '', 'ls', '1', 'https://www.google.co.in/', 1),
(6, 'product', '', 'ls', '3', 'https://www.google.co.in/', 1),
(7, 'deal', '', 'ls', '2', 'https://www.google.co.in/', 1),
(8, 'Auction', '', 'ls', '4', 'https://www.google.co.in/', 1),
(10, 'Auction', '', 'bf', '4', 'https://www.google.co.in/', 1),
(11, 'product', '', 'bf', '3', 'https://www.google.co.in/', 0),
(12, 'deal', '', 'bf', '2', 'https://www.google.co.in/', 0),
(13, 'test1', '', 'hr2', '1', 'http://www.ggg.com', 1),
(14, 'test2', '', 'hr1', '1', 'http://www.ggg.com', 1),
(17, 'Home Position', '', 'hs3', '1', 'https://www.google.co.in/', 1),
(15, 'Home Position', '', 'hs4', '1', 'https://www.google.co.in/', 1),
(16, 'Home Position', '', 'hs5', '1', 'https://www.google.co.in/', 1),
(18, 'Home Position', '', 'hc1', '1', 'https://www.google.co.in/', 1),
(19, 'Home Position', '', 'hc2', '1', 'https://www.google.co.in/', 1),
(20, 'Home Position', '', 'hb1', '1', 'https://www.google.co.in/', 1),
(21, 'Home Position', '', 'hb2', '1', 'https://www.google.co.in/', 1),
(22, 'Product Page', '', 'rs1', '3', 'https://www.google.co.in/', 1),
(23, 'Product Page', '', 'rs2', '3', 'https://www.google.co.in/', 1),
(24, 'Deal page', '', 'rs1', '2', 'https://www.google.co.in/', 1),
(25, 'Deal page', '', 'rs2', '2', 'https://www.google.co.in/', 1),
(26, 'Auction Page', '', 'rs1', '4', 'https://www.google.co.in/', 1),
(27, 'Auction Page', '', 'rs2', '4', 'https://www.google.co.in/', 1),
(28, 'Header position', '', 'hs6', '1', 'https://www.google.co.in/', 1),
(29, 'Home Position', '', 'hs7', '1', 'https://www.google.co.in/', 1);

-- --------------------------------------------------------

--
-- Table structure for table `attribute`
--

CREATE TABLE IF NOT EXISTS `attribute` (
  `attribute_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) CHARACTER SET utf8 NOT NULL,
  `attribute_group` int(11) NOT NULL,
  `sort_order` int(11) NOT NULL,
  PRIMARY KEY (`attribute_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `attribute_group`
--

CREATE TABLE IF NOT EXISTS `attribute_group` (
  `attribute_group_id` int(11) NOT NULL AUTO_INCREMENT,
  `groupname` varchar(100) CHARACTER SET utf8 NOT NULL,
  `sort_order` int(2) NOT NULL,
  PRIMARY KEY (`attribute_group_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `auction`
--

CREATE TABLE IF NOT EXISTS `auction` (
  `deal_id` int(11) NOT NULL AUTO_INCREMENT,
  `deal_title` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `url_title` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `deal_key` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `deal_description` text COLLATE utf8_unicode_ci NOT NULL,
  `fineprints` text COLLATE utf8_unicode_ci NOT NULL,
  `highlights` text COLLATE utf8_unicode_ci NOT NULL,
  `terms_conditions` text COLLATE utf8_unicode_ci NOT NULL,
  `meta_description` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `meta_keywords` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `category_id` int(11) NOT NULL,
  `sub_category_id` int(11) NOT NULL,
  `sec_category_id` int(11) NOT NULL,
  `third_category_id` int(11) NOT NULL,
  `deal_type` int(1) NOT NULL COMMENT '1-deals, 2-products, 3 - Auction',
  `merchant_id` int(11) NOT NULL,
  `shop_id` int(11) NOT NULL,
  `product_value` double NOT NULL,
  `deal_value` double NOT NULL,
  `deal_price` double NOT NULL,
  `deal_savings` double NOT NULL,
  `user_limit_quantity` int(5) NOT NULL,
  `bid_increment` double NOT NULL,
  `bid_count` int(11) NOT NULL,
  `shipping_fee` double NOT NULL,
  `shipping_info` text COLLATE utf8_unicode_ci NOT NULL,
  `startdate` int(10) NOT NULL,
  `enddate` int(10) NOT NULL,
  `created_date` int(10) NOT NULL,
  `created_by` int(11) NOT NULL,
  `deal_status` int(1) NOT NULL DEFAULT '1' COMMENT '1-active,0-deactive',
  `winner` int(11) NOT NULL,
  `auction_status` int(11) NOT NULL,
  `commission_status` int(1) NOT NULL DEFAULT '1',
  `view_count` int(11) NOT NULL,
  `deal_feature` int(1) NOT NULL,
  PRIMARY KEY (`deal_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Dumping data for table `auction`
--

INSERT INTO `auction` (`deal_id`, `deal_title`, `url_title`, `deal_key`, `deal_description`, `fineprints`, `highlights`, `terms_conditions`, `meta_description`, `meta_keywords`, `category_id`, `sub_category_id`, `sec_category_id`, `third_category_id`, `deal_type`, `merchant_id`, `shop_id`, `product_value`, `deal_value`, `deal_price`, `deal_savings`, `user_limit_quantity`, `bid_increment`, `bid_count`, `shipping_fee`, `shipping_info`, `startdate`, `enddate`, `created_date`, `created_by`, `deal_status`, `winner`, `auction_status`, `commission_status`, `view_count`, `deal_feature`) VALUES
(1, 'LG Wonder Door Refrigerator', 'LG-Wonder-Door-Refrigerator', 'B9SjLNw2', '<strong style="margin: 0px; padding: 0px; color: rgb(102, 102, 102); font-family: Arial, Helvetica, sans-serif; font-size: 12px; background-color: rgb(255, 255, 255); "><p style="margin: 1em 0em; padding: 0px 5px 0px 10px; color: rgb(0, 0, 0); width: 718px; position: relative; "><strong style="margin: 0px; padding: 0px; ">LG GR-M267QGL Side by Side Refrigerator</strong><br style="margin: 0px; padding: 0px; "><br style="margin: 0px; padding: 0px; ">782 Litres, Wonder Door, Home Bar, Digital Sensors, Horizontal Handle , Gallon Storage , Express Freezing.<br style="margin: 0px; padding: 0px; ">With State - of - the - art Wonder Door you''ll discover a whole new world of storage space and easy access to your favourite beverage &amp; food items . Available in the chic silver finished exteriors with floral pattern , it''s a perfect expression of exquisite art and futuristic technology.<br style="margin: 0px; padding: 0px; "><br style="margin: 0px; padding: 0px; "><strong style="margin: 0px; padding: 0px; ">Key Features</strong><br style="margin: 0px; padding: 0px; "><strong style="margin: 0px; padding: 0px; ">Wonder Door</strong>: Experience the new LG Side-by-Side Refrigerator with Wonder Door. India’s first Wonder Door is here to offer you a more convenient life. Touch it once to open the doorway to delicacies in your refrigerator. Get access to frequently used food, drinks and snacks stored in this special section. By preventing cooling loss caused by the constant closing and opening of the main doors in those scorching hot summer days, it saves energy and gives you 2.5 times more storage space. What’s more, the minimal seamless design enhances the refrigerator’s beauty and style.<br style="margin: 0px; padding: 0px; ">The revolutionary Wonder Door from LG provides access to your favourite food, drinks and snacks. It not only prevents cooling loss caused by the constant closing and opening of the main doors, but also saves energy and gives you 2.5 times more storage space. Delight yourself with this wonder.<br style="margin: 0px; padding: 0px; "><br style="margin: 0px; padding: 0px; "><strong style="margin: 0px; padding: 0px; ">Gallon Storage</strong>: Inverter Linear Compressor: At the heart of the refrigerator is a quiet and efficient compressor. It keeps noise to a minimum and helps the environment by using less energy. And comes with a 10 year warranty.<br style="margin: 0px; padding: 0px; "><br style="margin: 0px; padding: 0px; "><strong style="margin: 0px; padding: 0px; ">Express Freezing</strong>: Start the Express Freezer with a mere touch of a button. This intellegent section knows exactly when to stop. Just feed in the time and it will turn off automatically when the fixed time passes.<br style="margin: 0px; padding: 0px; "><br style="margin: 0px; padding: 0px; "><strong style="margin: 0px; padding: 0px; ">Refreshmnet Corner / Home Bar</strong>: LG DIOS comes with home bar that provides easy access to frequently needed refreshments, without any need to open the refrigerator door. It comes with serve table and light for convenience. The door opens with a smooth action on the touch of your hand or elbow. It’s easier for customers to open it even with hands pre occupied.<br style="margin: 0px; padding: 0px; "><br style="margin: 0px; padding: 0px; "><strong style="margin: 0px; padding: 0px; ">Exterior LCD Display</strong><br style="margin: 0px; padding: 0px; "><br style="margin: 0px; padding: 0px; "><strong style="margin: 0px; padding: 0px; ">9 Digital Sensors</strong><br style="margin: 0px; padding: 0px; "><br style="margin: 0px; padding: 0px; "><strong style="margin: 0px; padding: 0px; ">Technical Specifications:</strong><br style="margin: 0px; padding: 0px; "><br style="margin: 0px; padding: 0px; "><strong style="margin: 0px; padding: 0px; ">HIGHLIGHTS</strong><br style="margin: 0px; padding: 0px; ">Types: Premium<br style="margin: 0px; padding: 0px; ">Capacity (Litre): 782<br style="margin: 0px; padding: 0px; ">Inverter Linear Compressor: Yes<br style="margin: 0px; padding: 0px; ">Exterior Finish: Trimless Glass Finish<br style="margin: 0px; padding: 0px; ">Home Bar: Yes<br style="margin: 0px; padding: 0px; ">Exterior Display: LCD<br style="margin: 0px; padding: 0px; "><br style="margin: 0px; padding: 0px; "><strong style="margin: 0px; padding: 0px; ">GENERAL SPECIFICATIONS</strong><br style="margin: 0px; padding: 0px; ">Moist Balance Crisper: Yes<br style="margin: 0px; padding: 0px; ">Gallon Storage: Yes<br style="margin: 0px; padding: 0px; ">Open Door Alarm: Yes<br style="margin: 0px; padding: 0px; ">Digital Sensors: 9<br style="margin: 0px; padding: 0px; ">Child Lock: Yes<br style="margin: 0px; padding: 0px; ">Express Freezing: Yes<br style="margin: 0px; padding: 0px; "><br style="margin: 0px; padding: 0px; "><strong style="margin: 0px; padding: 0px; ">TEMPERED GLASS SHELVES</strong><br style="margin: 0px; padding: 0px; ">Fixed: 2<br style="margin: 0px; padding: 0px; ">Folding: 1<br style="margin: 0px; padding: 0px; "><br style="margin: 0px; padding: 0px; "><strong style="margin: 0px; padding: 0px; ">VEGETABLE BOX FEATURES</strong><br style="margin: 0px; padding: 0px; ">Drawers (Plastic): 3<br style="margin: 0px; padding: 0px; ">Interior Lamp: 1<br style="margin: 0px; padding: 0px; ">Door Bins: 4<br style="margin: 0px; padding: 0px; ">Bottle Guide: 1<br style="margin: 0px; padding: 0px; ">Moist Balance Crisper: Yes(2)<br style="margin: 0px; padding: 0px; "><br style="margin: 0px; padding: 0px; "><strong style="margin: 0px; padding: 0px; ">FREEZER SPECIFICATIONS</strong><br style="margin: 0px; padding: 0px; ">Icemaker Type: In Door Manual Freezer<br style="margin: 0px; padding: 0px; ">Freezer Shelves -Tempered glass: 4<br style="margin: 0px; padding: 0px; ">Drawers: 2<br style="margin: 0px; padding: 0px; ">Door Bins: 6<br style="margin: 0px; padding: 0px; "><br style="margin: 0px; padding: 0px; "><strong style="margin: 0px; padding: 0px; ">DIMENSIONS</strong><br style="margin: 0px; padding: 0px; ">Height (mm): 1785<br style="margin: 0px; padding: 0px; ">Width (mm): 912<br style="margin: 0px; padding: 0px; ">Depth (mm): 848</p></strong>', '', '', '', '', '', 1, 69, 82, 0, 0, 15, 1, 9000, 7000, 7000, 2000, 1, 100, 0, 10, '5 to 7 days', 1440423840, 1446143400, 1440423958, 14, 1, 0, 0, 1, 1, 0),
(2, 'Moto G(3rd gen)', 'Moto-G3rd-gen', 'UD1YZOGD', '<ul class="pros" style="margin: 10px 10px 5px 0px; padding: 0px; border: 0px; outline: 0px; font-family: ''Segoe UI'', Arial, Helvetica, ''Lucida Grande'', sans-serif; vertical-align: baseline; list-style: none; float: left; width: 278px; overflow: hidden; background-color: rgb(245, 252, 246); "><li style="margin: 0px; padding: 3px 0px 4px 20px; border: 0px; outline: 0px; font-style: inherit; font-family: inherit; vertical-align: baseline; line-height: 1.3em; position: relative; "><br class="Apple-interchange-newline">Dual Sim, 4G, 3G, Wi-Fi</li><li style="margin: 0px; padding: 3px 0px 4px 20px; border: 0px; outline: 0px; font-style: inherit; font-family: inherit; vertical-align: baseline; line-height: 1.3em; position: relative; "><i class="i-tick-check" style="background-image: url(http://data3.smartprix.com/img/sprite/icons-sba3cdc370c.png); position: absolute; display: block; overflow: hidden; font-size: 0px !important; height: 10px; width: 12px; top: 6px; left: 0px; background-position: 0px -1369px; background-repeat: no-repeat no-repeat; "></i>Quad Core, 1.4 GHz Processor</li><li style="margin: 0px; padding: 3px 0px 4px 20px; border: 0px; outline: 0px; font-style: inherit; font-family: inherit; vertical-align: baseline; line-height: 1.3em; position: relative; "><i class="i-tick-check" style="background-image: url(http://data3.smartprix.com/img/sprite/icons-sba3cdc370c.png); position: absolute; display: block; overflow: hidden; font-size: 0px !important; height: 10px; width: 12px; top: 6px; left: 0px; background-position: 0px -1369px; background-repeat: no-repeat no-repeat; "></i>2 GB RAM, 16 GB inbuilt</li><li style="margin: 0px; padding: 3px 0px 4px 20px; border: 0px; outline: 0px; font-style: inherit; font-family: inherit; vertical-align: baseline; line-height: 1.3em; position: relative; "><i class="i-tick-check" style="background-image: url(http://data3.smartprix.com/img/sprite/icons-sba3cdc370c.png); position: absolute; display: block; overflow: hidden; font-size: 0px !important; height: 10px; width: 12px; top: 6px; left: 0px; background-position: 0px -1369px; background-repeat: no-repeat no-repeat; "></i>2470 mAH Battery</li></ul><ul class="cons" style="margin: 10px 10px 5px 0px; padding: 0px; border: 0px; outline: 0px; font-family: ''Segoe UI'', Arial, Helvetica, ''Lucida Grande'', sans-serif; vertical-align: baseline; list-style: none; float: left; width: 278px; overflow: hidden; background-color: rgb(245, 252, 246); "><li style="margin: 0px; padding: 3px 0px 4px 20px; border: 0px; outline: 0px; font-style: inherit; font-family: inherit; vertical-align: baseline; line-height: 1.3em; position: relative; "><i class="i-tick-check" style="background-image: url(http://data3.smartprix.com/img/sprite/icons-sba3cdc370c.png); position: absolute; display: block; overflow: hidden; font-size: 0px !important; height: 10px; width: 12px; top: 6px; left: 0px; background-position: 0px -1369px; background-repeat: no-repeat no-repeat; "></i>5 inches, 720 x 1280 px display</li><li style="margin: 0px; padding: 3px 0px 4px 20px; border: 0px; outline: 0px; font-style: inherit; font-family: inherit; vertical-align: baseline; line-height: 1.3em; position: relative; "><i class="i-tick-check" style="background-image: url(http://data3.smartprix.com/img/sprite/icons-sba3cdc370c.png); position: absolute; display: block; overflow: hidden; font-size: 0px !important; height: 10px; width: 12px; top: 6px; left: 0px; background-position: 0px -1369px; background-repeat: no-repeat no-repeat; "></i>13 MP Camera with flash</li><li style="margin: 0px; padding: 3px 0px 4px 20px; border: 0px; outline: 0px; font-style: inherit; font-family: inherit; vertical-align: baseline; line-height: 1.3em; position: relative; "><i class="i-tick-check" style="background-image: url(http://data3.smartprix.com/img/sprite/icons-sba3cdc370c.png); position: absolute; display: block; overflow: hidden; font-size: 0px !important; height: 10px; width: 12px; top: 6px; left: 0px; background-position: 0px -1369px; background-repeat: no-repeat no-repeat; "></i>Memory Card Supported, upto 32 GB</li><li style="margin: 0px; padding: 3px 0px 4px 20px; border: 0px; outline: 0px; font-style: inherit; font-family: inherit; vertical-align: baseline; line-height: 1.3em; position: relative; "><i class="i-tick-check" style="background-image: url(http://data3.smartprix.com/img/sprite/icons-sba3cdc370c.png); position: absolute; display: block; overflow: hidden; font-size: 0px !important; height: 10px; width: 12px; top: 6px; left: 0px; background-position: 0px -1369px; background-repeat: no-repeat no-repeat; "></i>Android, v5.1.1</li></ul>', '', '', '', '', '', 1, 68, 79, 0, 0, 15, 1, 9000, 7000, 7000, 2000, 1, 100, 0, 25, '5 to 7 days', 1440423960, 1446057000, 1440424108, 14, 1, 0, 0, 1, 1, 0),
(3, '2014 spring and autumn Fashion single shoes Women Shoes Beaded fashion leisure casual shoes', '2014-spring-and-autumn-Fashion-single-shoes-Women-Shoes-Beaded-fashion-leisure-casual-shoes', 'eg4dTTwo', '<p style="margin: 0px; padding: 0px; ">Features:</p><p style="margin: 0px; padding: 0px; ">  Condition:  100% Original Authentic Brand New.<br>  Brand name: LAIKAJINDUN<br>  Type : LK-5202<br>  Color: Red, yellow</p><p style="margin: 0px; padding: 0px; ">Fabric:</p><p style="margin: 0px; padding: 0px; ">  Imported leather, Rubber outsole<br>  Feet wide：7cm/36 size ±0.5cm      <br>  With High: 3cm</p>', '', '', '', '', '', 3, 58, 65, 0, 0, 15, 1, 999, 499, 499, 500, 1, 10, 0, 10, 'free shipping', 1440424260, 1446143400, 1440424446, 14, 1, 0, 0, 1, 3, 0),
(4, 'Lenovo Essential G500s Laptop', 'Lenovo-Essential-G500s-Laptop', 'szQ3qNUp', '<div class="compare-product" style="margin: 5px; padding: 5px 0px 5px 5px; font-family: Arial, Helvetica, sans-serif; font-size: 14px; background-color: rgb(246, 246, 246); border: 1px solid rgb(224, 224, 224); float: left; width: 700px; height: auto; text-align: left; color: rgb(102, 102, 102); "><h2 style="margin-top: 20px; margin-right: 10px; margin-bottom: 0px !important; margin-left: 0px !important; padding: 0px; width: 400px; border-top-style: none !important; border-right-style: none !important; border-bottom-style: solid; border-left-style: none !important; border-bottom-width: 1px; border-bottom-color: rgb(102, 102, 102); font-size: 14px; height: auto; float: left; ">Find Lenovo Essential G500s Laptop Latest price, buy Lenovo Essential G500s Laptop computers, Auction.</h2><br style="margin: 0px; padding: 0px; ">JeetLe is a reverse auction and ecommerce website, where you can buy and bid on products. Here you will get all sorts of answers as to Lenovo Essential G500s Laptop Latest price, why should I buy Lenovo Essential G500s Laptop computers &amp; what are the unique specifications of Lenovo Essential G500s Laptop which make it distinct from other products?</div><div class="compare-product" style="margin: 5px; padding: 5px 0px 0px 5px; font-family: Arial, Helvetica, sans-serif; font-size: 14px; background-color: rgb(246, 246, 246); border: 1px solid rgb(224, 224, 224); float: left; width: 700px; height: 20px; text-align: left; color: rgb(102, 102, 102); ">Specification for Lenovo Essential G500s Laptop</div><table width="709" border="0" cellspacing="0" cellpadding="0" style="margin: 0px; padding: 10px 1px 15px 10px; border-collapse: inherit; color: rgb(102, 102, 102); font-family: Arial, Helvetica, sans-serif; font-size: 12px; background-color: rgb(255, 255, 255); "><tbody style="margin: 0px; padding: 0px; "><tr style="margin: 0px; padding: 0px; "><td colspan="3" class="attr-name" style="margin: 0px; padding: 5px; border-bottom-width: 1px; border-bottom-style: solid; border-bottom-color: rgb(224, 224, 224); color: rgb(41, 41, 41); font-size: 13px; height: 20px; text-align: left; background-color: rgb(246, 246, 246); font-weight: bold; ">General</td></tr><tr style="margin: 0px; padding: 0px; "><td width="180" class="compare-spec-1" style="margin: 0px; padding: 0px 0px 0px 5px; border-bottom-width: 1px; border-bottom-style: solid; border-bottom-color: rgb(201, 201, 201); color: rgb(1, 137, 214); font-size: 16px; text-align: left; line-height: 25px; vertical-align: top; ">Series</td><td width="500" class="product-spec-2" style="margin: 0px; padding: 0px 5px; border-bottom-width: 1px; border-bottom-style: solid; border-bottom-color: rgb(201, 201, 201); color: rgb(77, 77, 77); font-size: 16px; text-align: left; line-height: 25px; vertical-align: top; ">G</td></tr><tr style="margin: 0px; padding: 0px; "><td width="180" class="compare-spec-1" style="margin: 0px; padding: 0px 0px 0px 5px; border-bottom-width: 1px; border-bottom-style: solid; border-bottom-color: rgb(201, 201, 201); color: rgb(1, 137, 214); font-size: 16px; text-align: left; line-height: 25px; vertical-align: top; ">Part Number</td><td width="500" class="product-spec-2" style="margin: 0px; padding: 0px 5px; border-bottom-width: 1px; border-bottom-style: solid; border-bottom-color: rgb(201, 201, 201); color: rgb(77, 77, 77); font-size: 16px; text-align: left; line-height: 25px; vertical-align: top; ">G500S/59-383016</td></tr><tr style="margin: 0px; padding: 0px; "><td width="180" class="compare-spec-1" style="margin: 0px; padding: 0px 0px 0px 5px; border-bottom-width: 1px; border-bottom-style: solid; border-bottom-color: rgb(201, 201, 201); color: rgb(1, 137, 214); font-size: 16px; text-align: left; line-height: 25px; vertical-align: top; ">Lifestyle</td><td width="500" class="product-spec-2" style="margin: 0px; padding: 0px 5px; border-bottom-width: 1px; border-bottom-style: solid; border-bottom-color: rgb(201, 201, 201); color: rgb(77, 77, 77); font-size: 16px; text-align: left; line-height: 25px; vertical-align: top; ">Entertainment</td></tr><tr style="margin: 0px; padding: 0px; "><td colspan="3" class="attr-name" style="margin: 0px; padding: 5px; border-bottom-width: 1px; border-bottom-style: solid; border-bottom-color: rgb(224, 224, 224); color: rgb(41, 41, 41); font-size: 13px; height: 20px; text-align: left; background-color: rgb(246, 246, 246); font-weight: bold; ">Processor</td></tr><tr style="margin: 0px; padding: 0px; "><td width="180" class="compare-spec-1" style="margin: 0px; padding: 0px 0px 0px 5px; border-bottom-width: 1px; border-bottom-style: solid; border-bottom-color: rgb(201, 201, 201); color: rgb(1, 137, 214); font-size: 16px; text-align: left; line-height: 25px; vertical-align: top; ">Processor</td><td width="500" class="product-spec-2" style="margin: 0px; padding: 0px 5px; border-bottom-width: 1px; border-bottom-style: solid; border-bottom-color: rgb(201, 201, 201); color: rgb(77, 77, 77); font-size: 16px; text-align: left; line-height: 25px; vertical-align: top; ">Core i3 (3rd Gen)</td></tr><tr style="margin: 0px; padding: 0px; "><td width="180" class="compare-spec-1" style="margin: 0px; padding: 0px 0px 0px 5px; border-bottom-width: 1px; border-bottom-style: solid; border-bottom-color: rgb(201, 201, 201); color: rgb(1, 137, 214); font-size: 16px; text-align: left; line-height: 25px; vertical-align: top; ">Variant</td><td width="500" class="product-spec-2" style="margin: 0px; padding: 0px 5px; border-bottom-width: 1px; border-bottom-style: solid; border-bottom-color: rgb(201, 201, 201); color: rgb(77, 77, 77); font-size: 16px; text-align: left; line-height: 25px; vertical-align: top; ">3110M</td></tr><tr style="margin: 0px; padding: 0px; "><td width="180" class="compare-spec-1" style="margin: 0px; padding: 0px 0px 0px 5px; border-bottom-width: 1px; border-bottom-style: solid; border-bottom-color: rgb(201, 201, 201); color: rgb(1, 137, 214); font-size: 16px; text-align: left; line-height: 25px; vertical-align: top; ">Chipset</td><td width="500" class="product-spec-2" style="margin: 0px; padding: 0px 5px; border-bottom-width: 1px; border-bottom-style: solid; border-bottom-color: rgb(201, 201, 201); color: rgb(77, 77, 77); font-size: 16px; text-align: left; line-height: 25px; vertical-align: top; ">Mobile QM77 Express</td></tr><tr style="margin: 0px; padding: 0px; "><td width="180" class="compare-spec-1" style="margin: 0px; padding: 0px 0px 0px 5px; border-bottom-width: 1px; border-bottom-style: solid; border-bottom-color: rgb(201, 201, 201); color: rgb(1, 137, 214); font-size: 16px; text-align: left; line-height: 25px; vertical-align: top; ">Brand</td><td width="500" class="product-spec-2" style="margin: 0px; padding: 0px 5px; border-bottom-width: 1px; border-bottom-style: solid; border-bottom-color: rgb(201, 201, 201); color: rgb(77, 77, 77); font-size: 16px; text-align: left; line-height: 25px; vertical-align: top; ">Intel</td></tr><tr style="margin: 0px; padding: 0px; "><td width="180" class="compare-spec-1" style="margin: 0px; padding: 0px 0px 0px 5px; border-bottom-width: 1px; border-bottom-style: solid; border-bottom-color: rgb(201, 201, 201); color: rgb(1, 137, 214); font-size: 16px; text-align: left; line-height: 25px; vertical-align: top; ">Clock Speed</td><td width="500" class="product-spec-2" style="margin: 0px; padding: 0px 5px; border-bottom-width: 1px; border-bottom-style: solid; border-bottom-color: rgb(201, 201, 201); color: rgb(77, 77, 77); font-size: 16px; text-align: left; line-height: 25px; vertical-align: top; ">2.4 GHz</td></tr><tr style="margin: 0px; padding: 0px; "><td width="180" class="compare-spec-1" style="margin: 0px; padding: 0px 0px 0px 5px; border-bottom-width: 1px; border-bottom-style: solid; border-bottom-color: rgb(201, 201, 201); color: rgb(1, 137, 214); font-size: 16px; text-align: left; line-height: 25px; vertical-align: top; ">Cache</td><td width="500" class="product-spec-2" style="margin: 0px; padding: 0px 5px; border-bottom-width: 1px; border-bottom-style: solid; border-bottom-color: rgb(201, 201, 201); color: rgb(77, 77, 77); font-size: 16px; text-align: left; line-height: 25px; vertical-align: top; ">3 MB</td></tr><tr style="margin: 0px; padding: 0px; "><td colspan="3" class="attr-name" style="margin: 0px; padding: 5px; border-bottom-width: 1px; border-bottom-style: solid; border-bottom-color: rgb(224, 224, 224); color: rgb(41, 41, 41); font-size: 13px; height: 20px; text-align: left; background-color: rgb(246, 246, 246); font-weight: bold; ">Memory</td></tr><tr style="margin: 0px; padding: 0px; "><td width="180" class="compare-spec-1" style="margin: 0px; padding: 0px 0px 0px 5px; border-bottom-width: 1px; border-bottom-style: solid; border-bottom-color: rgb(201, 201, 201); color: rgb(1, 137, 214); font-size: 16px; text-align: left; line-height: 25px; vertical-align: top; ">Expandable Memory</td><td width="500" class="product-spec-2" style="margin: 0px; padding: 0px 5px; border-bottom-width: 1px; border-bottom-style: solid; border-bottom-color: rgb(201, 201, 201); color: rgb(77, 77, 77); font-size: 16px; text-align: left; line-height: 25px; vertical-align: top; ">Upto 8 GB</td></tr><tr style="margin: 0px; padding: 0px; "><td width="180" class="compare-spec-1" style="margin: 0px; padding: 0px 0px 0px 5px; border-bottom-width: 1px; border-bottom-style: solid; border-bottom-color: rgb(201, 201, 201); color: rgb(1, 137, 214); font-size: 16px; text-align: left; line-height: 25px; vertical-align: top; ">Memory Slots</td><td width="500" class="product-spec-2" style="margin: 0px; padding: 0px 5px; border-bottom-width: 1px; border-bottom-style: solid; border-bottom-color: rgb(201, 201, 201); color: rgb(77, 77, 77); font-size: 16px; text-align: left; line-height: 25px; vertical-align: top; ">2 (Unused Slot - 0)</td></tr><tr style="margin: 0px; padding: 0px; "><td width="180" class="compare-spec-1" style="margin: 0px; padding: 0px 0px 0px 5px; border-bottom-width: 1px; border-bottom-style: solid; border-bottom-color: rgb(201, 201, 201); color: rgb(1, 137, 214); font-size: 16px; text-align: left; line-height: 25px; vertical-align: top; ">System Memory</td><td width="500" class="product-spec-2" style="margin: 0px; padding: 0px 5px; border-bottom-width: 1px; border-bottom-style: solid; border-bottom-color: rgb(201, 201, 201); color: rgb(77, 77, 77); font-size: 16px; text-align: left; line-height: 25px; vertical-align: top; ">4 GB DDR3</td></tr><tr style="margin: 0px; padding: 0px; "><td colspan="3" class="attr-name" style="margin: 0px; padding: 5px; border-bottom-width: 1px; border-bottom-style: solid; border-bottom-color: rgb(224, 224, 224); color: rgb(41, 41, 41); font-size: 13px; height: 20px; text-align: left; background-color: rgb(246, 246, 246); font-weight: bold; ">Storage</td></tr><tr style="margin: 0px; padding: 0px; "><td width="180" class="compare-spec-1" style="margin: 0px; padding: 0px 0px 0px 5px; border-bottom-width: 1px; border-bottom-style: solid; border-bottom-color: rgb(201, 201, 201); color: rgb(1, 137, 214); font-size: 16px; text-align: left; line-height: 25px; vertical-align: top; ">RPM</td><td width="500" class="product-spec-2" style="margin: 0px; padding: 0px 5px; border-bottom-width: 1px; border-bottom-style: solid; border-bottom-color: rgb(201, 201, 201); color: rgb(77, 77, 77); font-size: 16px; text-align: left; line-height: 25px; vertical-align: top; ">5400</td></tr><tr style="margin: 0px; padding: 0px; "><td width="180" class="compare-spec-1" style="margin: 0px; padding: 0px 0px 0px 5px; border-bottom-width: 1px; border-bottom-style: solid; border-bottom-color: rgb(201, 201, 201); color: rgb(1, 137, 214); font-size: 16px; text-align: left; line-height: 25px; vertical-align: top; ">HDD Capacity</td><td width="500" class="product-spec-2" style="margin: 0px; padding: 0px 5px; border-bottom-width: 1px; border-bottom-style: solid; border-bottom-color: rgb(201, 201, 201); color: rgb(77, 77, 77); font-size: 16px; text-align: left; line-height: 25px; vertical-align: top; ">500 GB</td></tr><tr style="margin: 0px; padding: 0px; "><td colspan="3" class="attr-name" style="margin: 0px; padding: 5px; border-bottom-width: 1px; border-bottom-style: solid; border-bottom-color: rgb(224, 224, 224); color: rgb(41, 41, 41); font-size: 13px; height: 20px; text-align: left; background-color: rgb(246, 246, 246); font-weight: bold; ">Optical Disk Drive</td></tr><tr style="margin: 0px; padding: 0px; "><td width="180" class="compare-spec-1" style="margin: 0px; padding: 0px 0px 0px 5px; border-bottom-width: 1px; border-bottom-style: solid; border-bottom-color: rgb(201, 201, 201); color: rgb(1, 137, 214); font-size: 16px; text-align: left; line-height: 25px; vertical-align: top; ">Optical Drive</td><td width="500" class="product-spec-2" style="margin: 0px; padding: 0px 5px; border-bottom-width: 1px; border-bottom-style: solid; border-bottom-color: rgb(201, 201, 201); color: rgb(77, 77, 77); font-size: 16px; text-align: left; line-height: 25px; vertical-align: top; ">DVD RW Drive</td></tr><tr style="margin: 0px; padding: 0px; "><td colspan="3" class="attr-name" style="margin: 0px; padding: 5px; border-bottom-width: 1px; border-bottom-style: solid; border-bottom-color: rgb(224, 224, 224); color: rgb(41, 41, 41); font-size: 13px; height: 20px; text-align: left; background-color: rgb(246, 246, 246); font-weight: bold; ">Platform</td></tr><tr style="margin: 0px; padding: 0px; "><td width="180" class="compare-spec-1" style="margin: 0px; padding: 0px 0px 0px 5px; border-bottom-width: 1px; border-bottom-style: solid; border-bottom-color: rgb(201, 201, 201); color: rgb(1, 137, 214); font-size: 16px; text-align: left; line-height: 25px; vertical-align: top; ">Operating System</td><td width="500" class="product-spec-2" style="margin: 0px; padding: 0px 5px; border-bottom-width: 1px; border-bottom-style: solid; border-bottom-color: rgb(201, 201, 201); color: rgb(77, 77, 77); font-size: 16px; text-align: left; line-height: 25px; vertical-align: top; ">Windows 8</td></tr><tr style="margin: 0px; padding: 0px; "><td width="180" class="compare-spec-1" style="margin: 0px; padding: 0px 0px 0px 5px; border-bottom-width: 1px; border-bottom-style: solid; border-bottom-color: rgb(201, 201, 201); color: rgb(1, 137, 214); font-size: 16px; text-align: left; line-height: 25px; vertical-align: top; ">System Architecture</td><td width="500" class="product-spec-2" style="margin: 0px; padding: 0px 5px; border-bottom-width: 1px; border-bottom-style: solid; border-bottom-color: rgb(201, 201, 201); color: rgb(77, 77, 77); font-size: 16px; text-align: left; line-height: 25px; vertical-align: top; ">64 bit</td></tr><tr style="margin: 0px; padding: 0px; "><td colspan="3" class="attr-name" style="margin: 0px; padding: 5px; border-bottom-width: 1px; border-bottom-style: solid; border-bottom-color: rgb(224, 224, 224); color: rgb(41, 41, 41); font-size: 13px; height: 20px; text-align: left; background-color: rgb(246, 246, 246); font-weight: bold; ">Display</td></tr><tr style="margin: 0px; padding: 0px; "><td width="180" class="compare-spec-1" style="margin: 0px; padding: 0px 0px 0px 5px; border-bottom-width: 1px; border-bottom-style: solid; border-bottom-color: rgb(201, 201, 201); color: rgb(1, 137, 214); font-size: 16px; text-align: left; line-height: 25px; vertical-align: top; ">Screen Size</td><td width="500" class="product-spec-2" style="margin: 0px; padding: 0px 5px; border-bottom-width: 1px; border-bottom-style: solid; border-bottom-color: rgb(201, 201, 201); color: rgb(77, 77, 77); font-size: 16px; text-align: left; line-height: 25px; vertical-align: top; ">15.6 inch</td></tr><tr style="margin: 0px; padding: 0px; "><td width="180" class="compare-spec-1" style="margin: 0px; padding: 0px 0px 0px 5px; border-bottom-width: 1px; border-bottom-style: solid; border-bottom-color: rgb(201, 201, 201); color: rgb(1, 137, 214); font-size: 16px; text-align: left; line-height: 25px; vertical-align: top; ">Resolution</td><td width="500" class="product-spec-2" style="margin: 0px; padding: 0px 5px; border-bottom-width: 1px; border-bottom-style: solid; border-bottom-color: rgb(201, 201, 201); color: rgb(77, 77, 77); font-size: 16px; text-align: left; line-height: 25px; vertical-align: top; ">1366 x 768 Pixel</td></tr><tr style="margin: 0px; padding: 0px; "><td width="180" class="compare-spec-1" style="margin: 0px; padding: 0px 0px 0px 5px; border-bottom-width: 1px; border-bottom-style: solid; border-bottom-color: rgb(201, 201, 201); color: rgb(1, 137, 214); font-size: 16px; text-align: left; line-height: 25px; vertical-align: top; ">Screen Type</td><td width="500" class="product-spec-2" style="margin: 0px; padding: 0px 5px; border-bottom-width: 1px; border-bottom-style: solid; border-bottom-color: rgb(201, 201, 201); color: rgb(77, 77, 77); font-size: 16px; text-align: left; line-height: 25px; vertical-align: top; ">LED Display</td></tr><tr style="margin: 0px; padding: 0px; "><td colspan="3" class="attr-name" style="margin: 0px; padding: 5px; border-bottom-width: 1px; border-bottom-style: solid; border-bottom-color: rgb(224, 224, 224); color: rgb(41, 41, 41); font-size: 13px; height: 20px; text-align: left; background-color: rgb(246, 246, 246); font-weight: bold; ">Graphics</td></tr><tr style="margin: 0px; padding: 0px; "><td width="180" class="compare-spec-1" style="margin: 0px; padding: 0px 0px 0px 5px; border-bottom-width: 1px; border-bottom-style: solid; border-bottom-color: rgb(201, 201, 201); color: rgb(1, 137, 214); font-size: 16px; text-align: left; line-height: 25px; vertical-align: top; ">Graphic Processor</td><td width="500" class="product-spec-2" style="margin: 0px; padding: 0px 5px; border-bottom-width: 1px; border-bottom-style: solid; border-bottom-color: rgb(201, 201, 201); color: rgb(77, 77, 77); font-size: 16px; text-align: left; line-height: 25px; vertical-align: top; ">DDR3</td></tr><tr style="margin: 0px; padding: 0px; "><td colspan="3" class="attr-name" style="margin: 0px; padding: 5px; border-bottom-width: 1px; border-bottom-style: solid; border-bottom-color: rgb(224, 224, 224); color: rgb(41, 41, 41); font-size: 13px; height: 20px; text-align: left; background-color: rgb(246, 246, 246); font-weight: bold; ">Input</td></tr><tr style="margin: 0px; padding: 0px; "><td width="180" class="compare-spec-1" style="margin: 0px; padding: 0px 0px 0px 5px; border-bottom-width: 1px; border-bottom-style: solid; border-bottom-color: rgb(201, 201, 201); color: rgb(1, 137, 214); font-size: 16px; text-align: left; line-height: 25px; vertical-align: top; ">Web Camera</td><td width="500" class="product-spec-2" style="margin: 0px; padding: 0px 5px; border-bottom-width: 1px; border-bottom-style: solid; border-bottom-color: rgb(201, 201, 201); color: rgb(77, 77, 77); font-size: 16px; text-align: left; line-height: 25px; vertical-align: top; ">1.0 Megapixel 720p HD Webcam</td></tr><tr style="margin: 0px; padding: 0px; "><td width="180" class="compare-spec-1" style="margin: 0px; padding: 0px 0px 0px 5px; border-bottom-width: 1px; border-bottom-style: solid; border-bottom-color: rgb(201, 201, 201); color: rgb(1, 137, 214); font-size: 16px; text-align: left; line-height: 25px; vertical-align: top; ">Pointer Device</td><td width="500" class="product-spec-2" style="margin: 0px; padding: 0px 5px; border-bottom-width: 1px; border-bottom-style: solid; border-bottom-color: rgb(201, 201, 201); color: rgb(77, 77, 77); font-size: 16px; text-align: left; line-height: 25px; vertical-align: top; ">Touchpad</td></tr><tr style="margin: 0px; padding: 0px; "><td width="180" class="compare-spec-1" style="margin: 0px; padding: 0px 0px 0px 5px; border-bottom-width: 1px; border-bottom-style: solid; border-bottom-color: rgb(201, 201, 201); color: rgb(1, 137, 214); font-size: 16px; text-align: left; line-height: 25px; vertical-align: top; ">Keyboard</td><td width="500" class="product-spec-2" style="margin: 0px; padding: 0px 5px; border-bottom-width: 1px; border-bottom-style: solid; border-bottom-color: rgb(201, 201, 201); color: rgb(77, 77, 77); font-size: 16px; text-align: left; line-height: 25px; vertical-align: top; ">AccuType Keyboard</td></tr><tr style="margin: 0px; padding: 0px; "><td colspan="3" class="attr-name" style="margin: 0px; padding: 5px; border-bottom-width: 1px; border-bottom-style: solid; border-bottom-color: rgb(224, 224, 224); color: rgb(41, 41, 41); font-size: 13px; height: 20px; text-align: left; background-color: rgb(246, 246, 246); font-weight: bold; ">Audio</td></tr><tr style="margin: 0px; padding: 0px; "><td width="180" class="compare-spec-1" style="margin: 0px; padding: 0px 0px 0px 5px; border-bottom-width: 1px; border-bottom-style: solid; border-bottom-color: rgb(201, 201, 201); color: rgb(1, 137, 214); font-size: 16px; text-align: left; line-height: 25px; vertical-align: top; ">Speakers</td><td width="500" class="product-spec-2" style="margin: 0px; padding: 0px 5px; border-bottom-width: 1px; border-bottom-style: solid; border-bottom-color: rgb(201, 201, 201); color: rgb(77, 77, 77); font-size: 16px; text-align: left; line-height: 25px; vertical-align: top; ">Stereo Speakers with Dolby Advanced Audio</td></tr><tr style="margin: 0px; padding: 0px; "><td colspan="3" class="attr-name" style="margin: 0px; padding: 5px; border-bottom-width: 1px; border-bottom-style: solid; border-bottom-color: rgb(224, 224, 224); color: rgb(41, 41, 41); font-size: 13px; height: 20px; text-align: left; background-color: rgb(246, 246, 246); font-weight: bold; ">Communication</td></tr><tr style="margin: 0px; padding: 0px; "><td width="180" class="compare-spec-1" style="margin: 0px; padding: 0px 0px 0px 5px; border-bottom-width: 1px; border-bottom-style: solid; border-bottom-color: rgb(201, 201, 201); color: rgb(1, 137, 214); font-size: 16px; text-align: left; line-height: 25px; vertical-align: top; ">Ethernet</td><td width="500" class="product-spec-2" style="margin: 0px; padding: 0px 5px; border-bottom-width: 1px; border-bottom-style: solid; border-bottom-color: rgb(201, 201, 201); color: rgb(77, 77, 77); font-size: 16px; text-align: left; line-height: 25px; vertical-align: top; ">10/100 Mbps LAN</td></tr><tr style="margin: 0px; padding: 0px; "><td width="180" class="compare-spec-1" style="margin: 0px; padding: 0px 0px 0px 5px; border-bottom-width: 1px; border-bottom-style: solid; border-bottom-color: rgb(201, 201, 201); color: rgb(1, 137, 214); font-size: 16px; text-align: left; line-height: 25px; vertical-align: top; ">Bluetooth</td><td width="500" class="product-spec-2" style="margin: 0px; padding: 0px 5px; border-bottom-width: 1px; border-bottom-style: solid; border-bottom-color: rgb(201, 201, 201); color: rgb(77, 77, 77); font-size: 16px; text-align: left; line-height: 25px; vertical-align: top; ">Yes</td></tr><tr style="margin: 0px; padding: 0px; "><td colspan="3" class="attr-name" style="margin: 0px; padding: 5px; border-bottom-width: 1px; border-bottom-style: solid; border-bottom-color: rgb(224, 224, 224); color: rgb(41, 41, 41); font-size: 13px; height: 20px; text-align: left; background-color: rgb(246, 246, 246); font-weight: bold; ">Power</td></tr><tr style="margin: 0px; padding: 0px; "><td width="180" class="compare-spec-1" style="margin: 0px; padding: 0px 0px 0px 5px; border-bottom-width: 1px; border-bottom-style: solid; border-bottom-color: rgb(201, 201, 201); color: rgb(1, 137, 214); font-size: 16px; text-align: left; line-height: 25px; vertical-align: top; ">Battery Backup</td><td width="500" class="product-spec-2" style="margin: 0px; padding: 0px 5px; border-bottom-width: 1px; border-bottom-style: solid; border-bottom-color: rgb(201, 201, 201); color: rgb(77, 77, 77); font-size: 16px; text-align: left; line-height: 25px; vertical-align: top; ">Upto 4 hours</td></tr><tr style="margin: 0px; padding: 0px; "><td width="180" class="compare-spec-1" style="margin: 0px; padding: 0px 0px 0px 5px; border-bottom-width: 1px; border-bottom-style: solid; border-bottom-color: rgb(201, 201, 201); color: rgb(1, 137, 214); font-size: 16px; text-align: left; line-height: 25px; vertical-align: top; ">Power Supply</td><td width="500" class="product-spec-2" style="margin: 0px; padding: 0px 5px; border-bottom-width: 1px; border-bottom-style: solid; border-bottom-color: rgb(201, 201, 201); color: rgb(77, 77, 77); font-size: 16px; text-align: left; line-height: 25px; vertical-align: top; ">65 W AC Adapter</td></tr><tr style="margin: 0px; padding: 0px; "><td width="180" class="compare-spec-1" style="margin: 0px; padding: 0px 0px 0px 5px; border-bottom-width: 1px; border-bottom-style: solid; border-bottom-color: rgb(201, 201, 201); color: rgb(1, 137, 214); font-size: 16px; text-align: left; line-height: 25px; vertical-align: top; ">Battery Cell</td><td width="500" class="product-spec-2" style="margin: 0px; padding: 0px 5px; border-bottom-width: 1px; border-bottom-style: solid; border-bottom-color: rgb(201, 201, 201); color: rgb(77, 77, 77); font-size: 16px; text-align: left; line-height: 25px; vertical-align: top; ">4 cell</td></tr><tr style="margin: 0px; padding: 0px; "><td colspan="3" class="attr-name" style="margin: 0px; padding: 5px; border-bottom-width: 1px; border-bottom-style: solid; border-bottom-color: rgb(224, 224, 224); color: rgb(41, 41, 41); font-size: 13px; height: 20px; text-align: left; background-color: rgb(246, 246, 246); font-weight: bold; ">Ports/Slots</td></tr><tr style="margin: 0px; padding: 0px; "><td width="180" class="compare-spec-1" style="margin: 0px; padding: 0px 0px 0px 5px; border-bottom-width: 1px; border-bottom-style: solid; border-bottom-color: rgb(201, 201, 201); color: rgb(1, 137, 214); font-size: 16px; text-align: left; line-height: 25px; vertical-align: top; ">USB Port</td><td width="500" class="product-spec-2" style="margin: 0px; padding: 0px 5px; border-bottom-width: 1px; border-bottom-style: solid; border-bottom-color: rgb(201, 201, 201); color: rgb(77, 77, 77); font-size: 16px; text-align: left; line-height: 25px; vertical-align: top; ">1 x USB 2.0, 2 x USB 3.0</td></tr><tr style="margin: 0px; padding: 0px; "><td width="180" class="compare-spec-1" style="margin: 0px; padding: 0px 0px 0px 5px; border-bottom-width: 1px; border-bottom-style: solid; border-bottom-color: rgb(201, 201, 201); color: rgb(1, 137, 214); font-size: 16px; text-align: left; line-height: 25px; vertical-align: top; ">Mic In</td><td width="500" class="product-spec-2" style="margin: 0px; padding: 0px 5px; border-bottom-width: 1px; border-bottom-style: solid; border-bottom-color: rgb(201, 201, 201); color: rgb(77, 77, 77); font-size: 16px; text-align: left; line-height: 25px; vertical-align: top; ">Yes</td></tr><tr style="margin: 0px; padding: 0px; "><td width="180" class="compare-spec-1" style="margin: 0px; padding: 0px 0px 0px 5px; border-bottom-width: 1px; border-bottom-style: solid; border-bottom-color: rgb(201, 201, 201); color: rgb(1, 137, 214); font-size: 16px; text-align: left; line-height: 25px; vertical-align: top; ">RJ45 LAN</td><td width="500" class="product-spec-2" style="margin: 0px; padding: 0px 5px; border-bottom-width: 1px; border-bottom-style: solid; border-bottom-color: rgb(201, 201, 201); color: rgb(77, 77, 77); font-size: 16px; text-align: left; line-height: 25px; vertical-align: top; ">Yes</td></tr><tr style="margin: 0px; padding: 0px; "><td width="180" class="compare-spec-1" style="margin: 0px; padding: 0px 0px 0px 5px; border-bottom-width: 1px; border-bottom-style: solid; border-bottom-color: rgb(201, 201, 201); color: rgb(1, 137, 214); font-size: 16px; text-align: left; line-height: 25px; vertical-align: top; ">HDMI Port</td><td width="500" class="product-spec-2" style="margin: 0px; padding: 0px 5px; border-bottom-width: 1px; border-bottom-style: solid; border-bottom-color: rgb(201, 201, 201); color: rgb(77, 77, 77); font-size: 16px; text-align: left; line-height: 25px; vertical-align: top; ">Yes</td></tr><tr style="margin: 0px; padding: 0px; "><td width="180" class="compare-spec-1" style="margin: 0px; padding: 0px 0px 0px 5px; border-bottom-width: 1px; border-bottom-style: solid; border-bottom-color: rgb(201, 201, 201); color: rgb(1, 137, 214); font-size: 16px; text-align: left; line-height: 25px; vertical-align: top; ">VGA Port</td><td width="500" class="product-spec-2" style="margin: 0px; padding: 0px 5px; border-bottom-width: 1px; border-bottom-style: solid; border-bottom-color: rgb(201, 201, 201); color: rgb(77, 77, 77); font-size: 16px; text-align: left; line-height: 25px; vertical-align: top; ">Yes</td></tr><tr style="margin: 0px; padding: 0px; "><td width="180" class="compare-spec-1" style="margin: 0px; padding: 0px 0px 0px 5px; border-bottom-width: 1px; border-bottom-style: solid; border-bottom-color: rgb(201, 201, 201); color: rgb(1, 137, 214); font-size: 16px; text-align: left; line-height: 25px; vertical-align: top; ">Multi Card Slot</td><td width="500" class="product-spec-2" style="margin: 0px; padding: 0px 5px; border-bottom-width: 1px; border-bottom-style: solid; border-bottom-color: rgb(201, 201, 201); color: rgb(77, 77, 77); font-size: 16px; text-align: left; line-height: 25px; vertical-align: top; ">Yes</td></tr><tr style="margin: 0px; padding: 0px; "><td colspan="3" class="attr-name" style="margin: 0px; padding: 5px; border-bottom-width: 1px; border-bottom-style: solid; border-bottom-color: rgb(224, 224, 224); color: rgb(41, 41, 41); font-size: 13px; height: 20px; text-align: left; background-color: rgb(246, 246, 246); font-weight: bold; ">Machine Dimensions</td></tr><tr style="margin: 0px; padding: 0px; "><td width="180" class="compare-spec-1" style="margin: 0px; padding: 0px 0px 0px 5px; border-bottom-width: 1px; border-bottom-style: solid; border-bottom-color: rgb(201, 201, 201); color: rgb(1, 137, 214); font-size: 16px; text-align: left; line-height: 25px; vertical-align: top; ">Weight</td><td width="500" class="product-spec-2" style="margin: 0px; padding: 0px 5px; border-bottom-width: 1px; border-bottom-style: solid; border-bottom-color: rgb(201, 201, 201); color: rgb(77, 77, 77); font-size: 16px; text-align: left; line-height: 25px; vertical-align: top; ">2.5 kg</td></tr><tr style="margin: 0px; padding: 0px; "><td width="180" class="compare-spec-1" style="margin: 0px; padding: 0px 0px 0px 5px; border-bottom-width: 1px; border-bottom-style: solid; border-bottom-color: rgb(201, 201, 201); color: rgb(1, 137, 214); font-size: 16px; text-align: left; line-height: 25px; vertical-align: top; ">Dimension</td><td width="500" class="product-spec-2" style="margin: 0px; padding: 0px 5px; border-bottom-width: 1px; border-bottom-style: solid; border-bottom-color: rgb(201, 201, 201); color: rgb(77, 77, 77); font-size: 16px; text-align: left; line-height: 25px; vertical-align: top; ">380 x 260 x 25.8 mm</td></tr><tr style="margin: 0px; padding: 0px; "><td width="180" class="compare-spec-1" style="margin: 0px; padding: 0px 0px 0px 5px; border-bottom-width: 1px; border-bottom-style: solid; border-bottom-color: rgb(201, 201, 201); color: rgb(1, 137, 214); font-size: 16px; text-align: left; line-height: 25px; vertical-align: top; ">Color</td><td width="500" class="product-spec-2" style="margin: 0px; padding: 0px 5px; border-bottom-width: 1px; border-bottom-style: solid; border-bottom-color: rgb(201, 201, 201); color: rgb(77, 77, 77); font-size: 16px; text-align: left; line-height: 25px; vertical-align: top; ">Black</td></tr><tr style="margin: 0px; padding: 0px; "><td colspan="3" class="attr-name" style="margin: 0px; padding: 5px; border-bottom-width: 1px; border-bottom-style: solid; border-bottom-color: rgb(224, 224, 224); color: rgb(41, 41, 41); font-size: 13px; height: 20px; text-align: left; background-color: rgb(246, 246, 246); font-weight: bold; ">IN THE BOX</td></tr><tr style="margin: 0px; padding: 0px; "><td width="180" class="compare-spec-1" style="margin: 0px; padding: 0px 0px 0px 5px; border-bottom-width: 1px; border-bottom-style: solid; border-bottom-color: rgb(201, 201, 201); color: rgb(1, 137, 214); font-size: 16px; text-align: left; line-height: 25px; vertical-align: top; ">Sales Package</td><td width="500" class="product-spec-2" style="margin: 0px; padding: 0px 5px; border-bottom-width: 1px; border-bottom-style: solid; border-bottom-color: rgb(201, 201, 201); color: rgb(77, 77, 77); font-size: 16px; text-align: left; line-height: 25px; vertical-align: top; ">Laptop, Battery, AC Adapter, User Guide and Manuals</td></tr></tbody></table>', '', '', '', '', '', 1, 70, 88, 0, 0, 15, 1, 5666, 2999, 2999, 2667, 1, 100, 0, 110, '7 TO 10 DAYS', 1440424500, 1446143400, 1440424558, 14, 1, 0, 0, 1, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `banner_image`
--

CREATE TABLE IF NOT EXISTS `banner_image` (
  `banner_id` int(11) NOT NULL AUTO_INCREMENT,
  `image_title` varchar(256) NOT NULL,
  `redirect_url` text NOT NULL,
  `position` int(3) NOT NULL,
  `product` int(5) NOT NULL,
  `deal` int(5) NOT NULL,
  `auction` int(5) NOT NULL,
  `status` int(1) NOT NULL DEFAULT '1' COMMENT '1-Active,0-Deactive',
  PRIMARY KEY (`banner_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=27 ;

--
-- Dumping data for table `banner_image`
--

INSERT INTO `banner_image` (`banner_id`, `image_title`, `redirect_url`, `position`, `product`, `deal`, `auction`, `status`) VALUES
(25, 'next Generation Storage', 'http://demo.uniecommerce.com/', 0, 1, 1, 1, 1),
(26, 'Dress Sale for Men And Women', 'http://demo.uniecommerce.com/', 0, 1, 1, 1, 1),
(4, 'computers', 'http://demo.uniecommerce.com/', 0, 1, 1, 1, 1),
(5, 'Dell XPS 12 Ultrabook', 'http://demo.uniecommerce.com/', 0, 1, 1, 1, 1),
(20, 'Get New Phone With The Best Quality', 'http://demo.uniecommerce.com/', 0, 1, 1, 1, 1),
(21, 'HP Printer and Scanner ', 'http://demo.uniecommerce.com/', 0, 1, 1, 1, 1),
(22, 'For Employee Benefits', 'http://demo.uniecommerce.com/', 0, 1, 0, 0, 1),
(23, 'For Job Seekers', 'http://demo.uniecommerce.com/', 0, 1, 0, 0, 1),
(24, 'books', 'http://demo.uniecommerce.com/', 0, 1, 1, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `bidding`
--

CREATE TABLE IF NOT EXISTS `bidding` (
  `bid_id` int(11) NOT NULL AUTO_INCREMENT,
  `auction_id` int(11) NOT NULL,
  `auction_title` varchar(264) NOT NULL,
  `user_id` int(11) NOT NULL,
  `bid_amount` double NOT NULL,
  `shipping_amount` int(11) NOT NULL,
  `bidding_time` int(11) NOT NULL,
  `end_time` int(11) NOT NULL,
  `winning_status` int(1) NOT NULL DEFAULT '0' COMMENT '0-Not win,1-Win,2-Action bought',
  `mail_alert` int(1) NOT NULL COMMENT '1-winng,2-1st-alert,3-2nd-alert',
  PRIMARY KEY (`bid_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `blog`
--

CREATE TABLE IF NOT EXISTS `blog` (
  `blog_id` int(11) NOT NULL AUTO_INCREMENT,
  `blog_title` varchar(256) NOT NULL,
  `url_title` varchar(500) NOT NULL,
  `user_id` int(11) NOT NULL,
  `blog_description` longtext NOT NULL,
  `category_id` int(11) NOT NULL,
  `meta_title` varchar(256) NOT NULL,
  `meta_description` varchar(500) NOT NULL,
  `meta_keywords` varchar(256) NOT NULL,
  `tags` varchar(256) NOT NULL,
  `allow_comments` int(1) NOT NULL DEFAULT '1' COMMENT '1=>yes, 0=>no',
  `comments_count` int(11) NOT NULL,
  `blog_views` int(11) NOT NULL,
  `blog_date` int(11) NOT NULL,
  `publish_status` int(1) NOT NULL DEFAULT '1' COMMENT '1=> published, 2=>draft',
  `blog_status` int(1) NOT NULL DEFAULT '1' COMMENT '1=>active, 0=>deactive',
  PRIMARY KEY (`blog_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `blog`
--

INSERT INTO `blog` (`blog_id`, `blog_title`, `url_title`, `user_id`, `blog_description`, `category_id`, `meta_title`, `meta_description`, `meta_keywords`, `tags`, `allow_comments`, `comments_count`, `blog_views`, `blog_date`, `publish_status`, `blog_status`) VALUES
(1, 'NCR based Unicommerce launches Uniware, a SAAS based order management system for ecommerce companies', 'NCR-based-Unicommerce-launches-Uniware-a-SAAS-based-order-management-system-for-ecommerce-companies', 0, '  Real-time Management of order fulfillment processes has always been one of the key challenges for etailers in India. Handling procurement, goods receipt, quality assurance, pick and pack, invoicing, shipping, comprehensive return/replacements handling and inventory play critical role in making a successful ecommerce venture.', 1, 'NCR based Unicommerce launches Uniware, a SAAS based order management system for ecommerce companies', 'NCR based Unicommerce launches Uniware, a SAAS based order management system for ecommerce companies', 'NCR based Unicommerce launches Uniware, a SAAS based order management system for ecommerce companies', '3', 1, 0, 0, 1351515029, 1, 1),
(2, 'Unicommerce services provide to etailers in managing test', 'Unicommerce-services-provide-to-etailers-in-managing-test', 0, '     Inventory serialization (Bar-coding) – In Uniware we provide support for assigning unique serial number to every unit even of the same product. This enables us to capture various details like vendor, purchase date, product expiry, sent-to customer and unit specific information like IMEI (mobiles) which we believe is essential to control several common issues like wrong product shipments, ensuring inventory FIFO, pilferage, inventory ageing and timely returns to vendor. This feature has helped us deliver flawless inventory management and eliminate some of the problems completely. We have shipped more than a million shipments across all clients and yet to see our first incorrect shipment.', 4, 'advantages Unicommerce ', 'advantages Unicommercesdfsa', 'advantages Unicommerce ', '6', 1, 5, 0, 1351515133, 1, 1),
(3, 'Should You Show Cart Total In Checkout?', 'Should-You-Show-Cart-Total-In-Checkout', 0, ' I recently listened in on a web clinic from Marketing Experiments titled Optimizing Shopping Carts for the Holidays. One of the case studies presented was particularly intriguing. If you read the title of this post you guessed the subject of the test — showing cart totals in checkout. Cart totals in checkout – best practice? Back in 2007, Elastic Path conducted an audit of the Internet Retailer Top 100 for our Ecommerce Checkout Report. At that time, only 14% of checkouts displayed cart review boxes in checkout. Conversion rates were 60% higher for the sites that didn’t show cart totals.', 4, 'Should You Show ', 'Should You Show ', 'Should You Show ', '3', 1, 2, 0, 1357359276, 1, 1),
(4, 'Email  And Social Habits Of Holiday Shoppers [Research]', 'Email-And-Social-Habits-Of-Holiday-Shoppers-Research', 0, '                  &lt;ul&gt;&lt;li style=&quot;text-align: justify;&quot;&gt;&lt;span style=&quot;color: rgb(51, 102, 255); font-size: 10pt; &quot;&gt;Email marketing software provider Yesmail Interactive conducted an interesting study, combining dafdsfsdfasdf&lt;/span&gt;&lt;/li&gt;&lt;li style=&quot;text-align: justify;&quot;&gt;&lt;span style=&quot;color: rgb(51, 102, 255); font-size: 10pt; &quot;&gt;a consumer survey on general and holiday shopping habits with analysis of the digital marketing campaigns (email and social) of 20 of &lt;/span&gt;&lt;/li&gt;&lt;li style=&quot;text-align: justify;&quot;&gt;&lt;span style=&quot;color: rgb(51, 102, 255); font-size: 10pt; &quot;&gt;the top ecommerce brands in the US. Over 500 consumers were surveyed for Consumer Online Behavior Report: Developing Informed Digital Marketing Strategies for &lt;/span&gt;&lt;/li&gt;&lt;li style=&quot;text-align: justify;&quot;&gt;&lt;span style=&quot;color: rgb(51, 102, 255); font-size: 10pt; &quot;&gt;Holiday Success about general shopping habits and holiday-specific ones. Ecommerce brands studied include traditional retail like Amazon, Apple, Best Buy, &lt;/span&gt;&lt;/li&gt;&lt;li style=&quot;text-align: justify;&quot;&gt;&lt;span style=&quot;color: rgb(51, 102, 255); font-size: 10pt; &quot;&gt;Crate and Barrel, Dell, JC Penney, Macy’s, Nordstrom, &lt;/span&gt;&lt;/li&gt;&lt;/ul&gt; ', 1, 'advantages Unicommerce ', 'advantages Unicommerce ', 'advantages Unicommerce', '6', 0, 2, 0, 1357359381, 1, 1),
(13, 'This is blog post for VIVAshop', 'This-is-blog-post-for-VIVAshop', 0, ' &lt;font face=&quot;Arial, Verdana&quot; size=&quot;2&quot;&gt;Lorem ipsum dolor sit amet, consectetur adipiscing lit. Aliquam iaculis egestas laoreet. ...&lt;/font&gt;', 4, '', '', '', '', 1, 0, 0, 1438609377, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `blog_comments`
--

CREATE TABLE IF NOT EXISTS `blog_comments` (
  `comments_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `website` varchar(50) NOT NULL,
  `comments` varchar(250) NOT NULL,
  `blogg_id` int(11) NOT NULL,
  `approve_status` int(1) NOT NULL DEFAULT '0' COMMENT '1=>approved,0=>disapproved',
  `comments_date` int(11) NOT NULL,
  `notify_comments` int(1) NOT NULL DEFAULT '0' COMMENT '1=>yes,0=>no',
  `comments_status` int(1) NOT NULL DEFAULT '1' COMMENT '1=>active,0=>deactive',
  PRIMARY KEY (`comments_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=25 ;

-- --------------------------------------------------------

--
-- Table structure for table `blog_settings`
--

CREATE TABLE IF NOT EXISTS `blog_settings` (
  `blog_settings_id` int(11) NOT NULL AUTO_INCREMENT,
  `allow_comment_posting` int(1) NOT NULL DEFAULT '1' COMMENT '1=>yes, 2=>no',
  `require_adminapproval_comments` int(1) NOT NULL DEFAULT '1' COMMENT '1=>yes, 2=>no',
  `posts_per_page` int(5) NOT NULL DEFAULT '4',
  PRIMARY KEY (`blog_settings_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `blog_settings`
--

INSERT INTO `blog_settings` (`blog_settings_id`, `allow_comment_posting`, `require_adminapproval_comments`, `posts_per_page`) VALUES
(1, 2, 1, 3);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE IF NOT EXISTS `category` (
  `category_id` int(3) NOT NULL AUTO_INCREMENT,
  `main_category_id` int(11) NOT NULL,
  `sub_category_id` int(11) NOT NULL,
  `category_name` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `category_url` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `category_mapping` text COLLATE utf8_unicode_ci NOT NULL,
  `category_status` int(1) NOT NULL DEFAULT '1',
  `deal` int(1) NOT NULL,
  `product` int(1) NOT NULL,
  `auction` int(1) NOT NULL,
  `type` int(1) NOT NULL COMMENT '1 - main , 2- 2layer , 3 - 3layer , 4 - 4layer',
  `order_by` int(1) NOT NULL,
  PRIMARY KEY (`category_id`),
  FULLTEXT KEY `subtypename` (`category_name`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=226 ;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `main_category_id`, `sub_category_id`, `category_name`, `category_url`, `category_mapping`, `category_status`, `deal`, `product`, `auction`, `type`, `order_by`) VALUES
(1, 0, 0, 'Electronics', 'Electronics', '', 1, 1, 1, 1, 1, 1),
(2, 0, 0, 'Men', 'Men', '', 1, 1, 1, 1, 1, 3),
(3, 0, 0, 'Women', 'Women', '', 1, 1, 1, 1, 1, 4),
(4, 0, 0, 'Baby & Kids', 'Baby-Kids', '', 1, 1, 1, 1, 1, 5),
(5, 0, 0, 'Books & Media', 'Books-Media', '', 1, 1, 1, 0, 1, 0),
(6, 0, 0, 'Home & Kitchen', 'Home-Kitchen', '', 1, 1, 1, 1, 1, 6),
(7, 0, 0, 'Sports & Fitness', 'Sports-Fitness', '', 1, 1, 1, 1, 1, 7),
(8, 0, 0, 'Personal Care & Health', 'Personal-Care-Health', '', 1, 1, 1, 0, 1, 0),
(9, 0, 0, 'Gifts & Flowers', 'Gifts-Flowers', '', 1, 1, 1, 0, 1, 2),
(10, 4, 4, 'Boys Clothing', 'Boys_Clothing', '', 1, 0, 0, 0, 2, 0),
(11, 4, 4, 'Girls Clothing', 'Girls_Clothing', '', 1, 0, 0, 0, 2, 0),
(12, 4, 4, 'Infants Clothing', 'Infants_Clothing', '', 1, 0, 0, 0, 2, 0),
(13, 4, 4, 'Boys Footwear', 'Boys_Footwear', '', 1, 0, 0, 0, 2, 0),
(14, 4, 4, 'Girls Footwear', 'Girls_Footwear', '', 1, 0, 0, 0, 2, 0),
(15, 4, 4, 'Toys & Games', 'Toys_Games', '', 1, 0, 0, 0, 2, 0),
(16, 4, 10, 'T-Shirts', 'T-Shirts', '', 1, 0, 0, 0, 3, 0),
(17, 4, 10, 'Shirts', 'Shirts', '', 1, 0, 0, 0, 3, 0),
(18, 4, 10, 'Jeans', 'Jeans', '', 1, 0, 0, 0, 3, 0),
(19, 4, 13, 'Flip Flops', 'Flip_Flops', '', 1, 0, 0, 0, 3, 0),
(20, 4, 13, 'Sandals ', 'Sandals', '', 1, 0, 0, 0, 3, 0),
(21, 4, 13, 'Casual Shoes', 'Casual_Shoes', '', 1, 0, 0, 0, 3, 0),
(22, 4, 11, 'Tees & Tops', 'Tees_Tops', '', 1, 0, 0, 0, 3, 0),
(23, 4, 11, 'Dresses & Skirts', 'Dresses_Skirts', '', 1, 0, 0, 0, 3, 0),
(24, 4, 11, 'Shorts & Capries', 'Shorts_Capries', '', 1, 0, 0, 0, 3, 0),
(25, 4, 12, 'Baby Boys Clothing', 'Baby_Boys_Clothing', '', 1, 0, 0, 0, 3, 0),
(26, 4, 12, 'Baby Girls Clothing', 'Baby_Girls_Clothing', '', 1, 0, 0, 0, 3, 0),
(27, 4, 14, 'Girls Sandals', 'Girls_Sandals', '', 1, 0, 0, 0, 3, 0),
(28, 4, 14, 'Girls Casual Shoes', 'Girls_Casual_Shoes', '', 1, 0, 0, 0, 3, 0),
(29, 4, 14, 'Clogs', 'Clogs', '', 1, 0, 0, 0, 3, 0),
(30, 4, 15, 'Baby Toys', 'Baby_Toys', '', 1, 0, 0, 0, 3, 0),
(31, 4, 15, 'Board Games', 'Board_Games', '', 1, 0, 0, 0, 3, 0),
(32, 4, 15, 'Card Games', 'Card_Games', '', 1, 0, 0, 0, 3, 0),
(33, 4, 15, 'Cars Trains & Bikes', 'Cars_Trains_Bikes', '', 1, 0, 0, 0, 3, 0),
(34, 5, 5, 'Books', 'Books', '', 1, 0, 0, 0, 2, 0),
(35, 5, 5, 'eBooks', 'eBooks', '', 1, 0, 0, 0, 2, 0),
(36, 5, 5, 'Music', 'Music', '', 1, 0, 0, 0, 2, 0),
(37, 5, 5, 'Movies & TV Shows', 'Movies_TV_Shows', '', 1, 0, 0, 0, 2, 0),
(38, 5, 37, 'Pre-Orders', 'Pre-Orders', '', 1, 0, 0, 0, 3, 0),
(39, 5, 37, 'New Releases', 'New_Releases', '', 1, 0, 0, 0, 3, 0),
(40, 5, 37, 'Blu-Rays and 3D', 'Blu-Rays_and_3D', '', 1, 0, 0, 0, 3, 0),
(41, 5, 37, 'DVDs', 'DVDs', '', 1, 0, 0, 0, 3, 0),
(42, 5, 37, 'Health & Wellness', 'Health_Wellness', '', 1, 0, 0, 0, 3, 0),
(43, 5, 35, 'Literature & Fiction', 'Literature_Fiction', '', 1, 0, 0, 0, 3, 0),
(44, 5, 35, 'Science & Technology', 'Science_Technology', '', 1, 0, 0, 0, 3, 0),
(45, 5, 35, 'Biographies & Autobiography', 'Biographies_Autobiography', '', 1, 0, 0, 0, 3, 0),
(46, 5, 34, 'Business Investing & Mgmt', 'Business_Investing_Mgmt', '', 1, 0, 0, 0, 3, 0),
(47, 5, 34, 'Academic & Professional', 'Academic_Professional', '', 1, 0, 0, 0, 3, 0),
(48, 5, 34, 'Entrance Exam', 'Entrance_Exam', '', 1, 0, 0, 0, 3, 0),
(49, 5, 34, 'Literature & Books Fiction', 'Literature_Books_Fiction', '', 1, 0, 0, 0, 3, 0),
(50, 5, 34, 'New Releases Books', 'New_Releases_Books', '', 1, 0, 0, 0, 3, 0),
(51, 5, 36, 'Pre-Orders Music', 'Pre-Orders_Music', '', 1, 0, 0, 0, 3, 0),
(52, 5, 36, 'New Releases Music', 'New_Releases_Music', '', 1, 0, 0, 0, 3, 0),
(53, 5, 36, 'Devotional & Spiritual', 'Devotional_Spiritual', '', 1, 0, 0, 0, 3, 0),
(54, 3, 3, 'Clothing', 'Clothing', '', 1, 0, 0, 0, 2, 0),
(55, 3, 3, 'Footwear', 'Footwear', '', 1, 0, 0, 0, 2, 0),
(56, 3, 3, 'Watches', 'Watches', '', 1, 0, 0, 0, 2, 0),
(57, 3, 3, 'Bags  Belts and wallets', 'Bags_Belts_and_wallets', '', 1, 0, 0, 0, 2, 0),
(58, 3, 3, 'Beauty and Wellness', 'Beauty_and_Wellness', '', 1, 0, 0, 0, 2, 0),
(59, 3, 57, 'Handbags', 'Handbags', '', 1, 0, 0, 0, 3, 0),
(60, 3, 57, 'Totes', 'Totes', '', 1, 0, 0, 0, 3, 0),
(61, 3, 57, 'Backpacks', 'Backpacks', '', 1, 0, 0, 0, 3, 0),
(62, 3, 57, 'Sling Bags', 'Sling_Bags', '', 1, 0, 0, 0, 3, 0),
(63, 3, 58, 'Skin Care', 'Skin_Care', '', 1, 0, 0, 0, 3, 0),
(64, 3, 58, 'Make Up', 'Make_Up', '', 1, 0, 0, 0, 3, 0),
(65, 3, 58, 'Hair Care', 'Hair_Care', '', 1, 0, 0, 0, 3, 0),
(66, 3, 58, 'Bath & Spa', 'Bath_Spa', '', 1, 0, 0, 0, 3, 0),
(67, 3, 58, 'Oral Care', 'Oral_Care', '', 1, 0, 0, 0, 3, 0),
(68, 1, 1, 'Mobiles', 'Mobiles', '', 1, 0, 0, 0, 2, 0),
(69, 1, 1, 'Tablets', 'Tablets', '', 1, 0, 0, 0, 2, 0),
(70, 1, 1, 'Computer Accessories', 'Computer_Accessories', '', 1, 0, 0, 0, 2, 0),
(71, 1, 1, 'Mobiles Accessories', 'Mobiles_Accessories', '', 1, 0, 0, 0, 2, 0),
(72, 1, 1, 'Laptops', 'Laptops', '', 1, 0, 0, 0, 2, 0),
(73, 1, 1, 'Cameras', 'Cameras', '', 1, 0, 0, 0, 2, 0),
(74, 1, 73, 'Nikon', 'Nikon', '', 1, 0, 0, 0, 3, 0),
(75, 1, 73, 'Canon', 'Canon', '', 1, 0, 0, 0, 3, 0),
(76, 1, 73, 'Sony', 'Sony', '', 1, 0, 0, 0, 3, 0),
(77, 1, 73, 'Samsung', 'Samsung', '', 1, 0, 0, 0, 3, 0),
(78, 1, 68, 'Samsung Mobiles', 'Samsung_Mobiles', '', 1, 0, 0, 0, 3, 0),
(79, 1, 68, 'Nokia', 'Nokia', '', 1, 0, 0, 0, 3, 0),
(80, 1, 68, 'XOLO', 'XOLO', '', 1, 0, 0, 0, 3, 0),
(81, 1, 68, 'Sony Mobiles', 'Sony_Mobiles', '', 1, 0, 0, 0, 3, 0),
(82, 1, 69, 'iPad', 'iPad', '', 1, 0, 0, 0, 3, 0),
(83, 1, 69, 'Tablets with Call Facility', 'Tablets_with_Call_Facility', '', 1, 0, 0, 0, 3, 0),
(84, 1, 69, 'Tablets without Call Facility', 'Tablets_without_Call_Facility', '', 1, 0, 0, 0, 3, 0),
(85, 1, 71, 'Cases & Covers', 'Cases_Covers', '', 1, 0, 0, 0, 3, 0),
(86, 1, 71, 'Headphones', 'Headphones', '', 1, 0, 0, 0, 3, 0),
(87, 1, 71, 'Bluetooth Headsets', 'Bluetooth_Headsets', '', 1, 0, 0, 0, 3, 0),
(88, 1, 70, 'Laptop Accessories', 'Laptop_Accessories', '', 1, 0, 0, 0, 3, 0),
(89, 1, 70, 'Storage', 'Storage', '', 1, 0, 0, 0, 3, 0),
(90, 1, 70, 'Networking Components', 'Networking_Components', '', 1, 0, 0, 0, 3, 0),
(91, 1, 70, 'Computer Components', 'Computer_Components', '', 1, 0, 0, 0, 3, 0),
(92, 1, 70, 'Computer Peripherals', 'Computer_Peripherals', '', 1, 0, 0, 0, 3, 0),
(93, 1, 72, 'Apple', 'Apple', '', 1, 0, 0, 0, 3, 0),
(94, 1, 72, 'Dell', 'Dell', '', 1, 0, 0, 0, 3, 0),
(95, 1, 72, 'HP', 'HP', '', 1, 0, 0, 0, 3, 0),
(96, 1, 72, 'Lenovo', 'Lenovo', '', 1, 0, 0, 0, 3, 0),
(97, 6, 6, 'Home Furnishing', 'Home_Furnishing', '', 1, 0, 0, 0, 2, 0),
(98, 6, 6, 'Kitchen', 'Kitchen', '', 1, 0, 0, 0, 2, 0),
(99, 6, 6, 'Bath', 'Bath', '', 1, 0, 0, 0, 2, 0),
(101, 6, 6, 'Kitchen Appliances', 'Kitchen_Appliances', '', 1, 0, 0, 0, 2, 0),
(102, 6, 99, 'Bath Towels', 'Bath_Towels', '', 1, 0, 0, 0, 3, 0),
(103, 6, 99, 'Mats', 'Mats', '', 1, 0, 0, 0, 3, 0),
(109, 6, 101, 'Electric Cookers', 'Electric_Cookers', '', 1, 0, 0, 0, 3, 0),
(104, 6, 97, 'Vacuum Cleaners', 'Vacuum_Cleaners', '', 1, 0, 0, 0, 3, 0),
(105, 6, 97, 'Emergency Lights', 'Emergency_Lights', '', 1, 0, 0, 0, 3, 0),
(106, 6, 97, 'Water Purifiers', 'Water_Purifiers', '', 1, 0, 0, 0, 3, 0),
(107, 6, 101, 'Sandwich and Rotimakers', 'Sandwich_and_Rotimakers', '', 1, 0, 0, 0, 3, 0),
(108, 6, 101, 'Mixer Juicer Grinders', 'Mixer_Juicer_Grinders', '', 1, 0, 0, 0, 3, 0),
(110, 6, 98, 'Table Covers', 'Table_Covers', '', 1, 0, 0, 0, 3, 0),
(111, 6, 98, 'Table Placemats', 'Table_Placemats', '', 1, 0, 0, 0, 3, 0),
(112, 2, 2, 'Men Clothing', 'Men_Clothing', '', 1, 0, 0, 0, 2, 0),
(113, 2, 2, 'Men Footwear', 'Men_Footwear', '', 1, 0, 0, 0, 2, 0),
(114, 2, 2, 'Men Watches', 'Men_Watches', '', 1, 0, 0, 0, 2, 0),
(115, 2, 2, 'Mens Accessories', 'Mens_Accessories', '', 1, 0, 0, 0, 2, 0),
(116, 2, 2, 'Men Bags Belts and wallets', 'Men_Bags_Belts_and_wallets', '', 1, 0, 0, 0, 2, 0),
(117, 2, 116, 'Men Backpacks', 'Men_Backpacks', '', 1, 0, 0, 0, 3, 0),
(118, 2, 116, 'Laptop Bags', 'Laptop_Bags', '', 1, 0, 0, 0, 3, 0),
(119, 2, 116, 'Messenger Bags', 'Messenger_Bags', '', 1, 0, 0, 0, 3, 0),
(120, 2, 116, 'Gym Bags', 'Gym_Bags', '', 1, 0, 0, 0, 3, 0),
(121, 2, 112, 'Casual & Party Wear Shirts', 'Casual_Party_Wear_Shirts', '', 1, 0, 0, 0, 3, 0),
(122, 2, 112, 'Men Jeans', 'Men_Jeans', '', 1, 0, 0, 0, 3, 0),
(123, 2, 112, 'Formal Shirts', 'Formal_Shirts', '', 1, 0, 0, 0, 3, 0),
(124, 2, 112, 'Sports & Active Wear', 'Sports_Active_Wear', '', 1, 0, 0, 0, 3, 0),
(125, 2, 112, 'Inner Wear & Sleep Wear', 'Inner_Wear_Sleep_Wear', '', 1, 0, 0, 0, 3, 0),
(126, 2, 113, 'Sports Shoes', 'Sports_Shoes', '', 1, 0, 0, 0, 3, 0),
(127, 2, 113, 'Men Casual Shoes', 'Men_Casual_Shoes', '', 1, 0, 0, 0, 3, 0),
(128, 2, 113, 'Formal Shoes', 'Formal_Shoes', '', 1, 0, 0, 0, 3, 0),
(129, 2, 113, 'Sandals & Floaters', 'Sandals_Floaters', '', 1, 0, 0, 0, 3, 0),
(130, 2, 114, 'Watches Fashion Sale', 'Watches_Fashion_Sale', '', 1, 0, 0, 0, 3, 0),
(131, 2, 114, 'Titan', 'Titan', '', 1, 0, 0, 0, 3, 0),
(132, 2, 114, 'Fastrack', 'Fastrack', '', 1, 0, 0, 0, 3, 0),
(133, 2, 115, 'Chains', 'Chains', '', 1, 0, 0, 0, 3, 0),
(134, 2, 115, 'Bracelets', 'Bracelets', '', 1, 0, 0, 0, 3, 0),
(135, 2, 115, 'Wrist Bands', 'Wrist_Bands', '', 1, 0, 0, 0, 3, 0),
(136, 2, 115, 'Cufflinks', 'Cufflinks', '', 1, 0, 0, 0, 3, 0),
(153, 8, 8, 'Beauty & Personal Care', 'Beauty_Personal_Care', '', 1, 0, 0, 0, 2, 0),
(138, 7, 7, 'Team Sports', 'Team_Sports', '', 1, 0, 0, 0, 2, 0),
(139, 7, 7, 'Outdoor Adventure', 'Outdoor_Adventure', '', 1, 0, 0, 0, 2, 0),
(140, 7, 7, 'Indoor Games', 'Indoor_Games', '', 1, 0, 0, 0, 2, 0),
(141, 7, 7, 'Other Sports', 'Other_Sports', '', 1, 0, 0, 0, 2, 0),
(142, 7, 141, 'Boxing', 'Boxing', '', 1, 0, 0, 0, 3, 0),
(143, 7, 141, 'Golf', 'Golf', '', 1, 0, 0, 0, 3, 0),
(144, 7, 141, 'Swimming', 'Swimming', '', 1, 0, 0, 0, 3, 0),
(145, 7, 140, 'Chess', 'Chess', '', 1, 0, 0, 0, 3, 0),
(146, 7, 140, 'Darts', 'Darts', '', 1, 0, 0, 0, 3, 0),
(147, 7, 139, 'Camping & Hiking', 'Camping_Hiking', '', 1, 0, 0, 0, 3, 0),
(148, 7, 139, 'Cycling', 'Cycling', '', 1, 0, 0, 0, 3, 0),
(149, 7, 139, 'Running', 'Running', '', 1, 0, 0, 0, 3, 0),
(150, 7, 138, 'Basketball', 'Basketball', '', 1, 0, 0, 0, 3, 0),
(151, 7, 138, 'Cricket', 'Cricket', '', 1, 0, 0, 0, 3, 0),
(152, 7, 138, 'Other Ball Sports', 'Other_Ball_Sports', '', 1, 0, 0, 0, 3, 0),
(154, 8, 8, 'Perfume Shop', 'Perfume_Shop', '', 1, 0, 0, 0, 2, 0),
(155, 8, 8, 'Health & Fitness', 'Health_Fitness', '', 1, 0, 0, 0, 2, 0),
(156, 8, 153, 'Mens Grooming', 'Mens_Grooming', '', 1, 0, 0, 0, 3, 0),
(157, 8, 153, 'Make Up & Cosmetics', 'Make_Up_Cosmetics', '', 1, 0, 0, 0, 3, 0),
(158, 8, 153, 'Grooming Accessories', 'Grooming_Accessories', '', 1, 0, 0, 0, 3, 0),
(159, 8, 153, 'Hand and Foot', 'Hand_and_Foot', '', 1, 0, 0, 0, 3, 0),
(160, 8, 155, 'Health Monitors', 'Health_Monitors', '', 1, 0, 0, 0, 3, 0),
(161, 8, 155, 'Medicines & Supplements', 'Medicines_Supplements', '', 1, 0, 0, 0, 3, 0),
(162, 8, 155, 'Homeopathic Treatment', 'Homeopathic_Treatment', '', 1, 0, 0, 0, 3, 0),
(163, 9, 9, 'Gifts', 'Gifts', '', 1, 0, 0, 0, 2, 0),
(164, 9, 9, 'Flowers', 'Flowers', '', 1, 0, 0, 0, 2, 0),
(165, 9, 163, 'Cakes', 'Cakes', '', 1, 0, 0, 0, 3, 0),
(166, 9, 163, 'Gift Hamper', 'Gift_Hamper', '', 1, 0, 0, 0, 3, 0),
(167, 9, 163, 'Assorted Gifts', 'Assorted_Gifts', '', 1, 0, 0, 0, 3, 0),
(168, 9, 163, 'Gifts for Him', 'Gifts_for_Him', '', 1, 0, 0, 0, 3, 0),
(169, 9, 163, 'Gifts for Her', 'Gifts_for_Her', '', 1, 0, 0, 0, 3, 0),
(170, 9, 163, 'Birthday Gifts', 'Birthday_Gifts', '', 1, 0, 0, 0, 3, 0),
(171, 9, 163, 'Anniversary Gifts', 'Anniversary_Gifts', '', 1, 0, 0, 0, 3, 0),
(172, 9, 163, 'Wedding Gifts', 'Wedding_Gifts', '', 1, 0, 0, 0, 3, 0),
(173, 9, 163, 'Valentines day gifts', 'Valentines_day_gifts', '', 1, 0, 0, 0, 3, 0),
(174, 9, 164, 'Occasion', 'Occasion', '', 1, 0, 0, 0, 3, 0),
(175, 9, 164, 'Specials', 'Specials', '', 1, 0, 0, 0, 3, 0),
(176, 9, 164, 'Combos', 'Combos', '', 1, 0, 0, 0, 3, 0),
(177, 9, 164, 'Designer Arrangements', 'Designer_Arrangements', '', 1, 0, 0, 0, 3, 0),
(178, 9, 164, 'Remote Delivery', 'Remote_Delivery', '', 1, 0, 0, 0, 3, 0),
(179, 3, 54, 'Shirts Tops & Tunics', 'Shirts_Tops_Tunics', '', 1, 0, 0, 0, 3, 0),
(180, 3, 54, 'Ethnic Wear', 'Ethnic_Wear', '', 1, 0, 0, 0, 3, 0),
(181, 3, 54, 'Women T-Shirts', 'Women_T-Shirts', '', 1, 0, 0, 0, 3, 0),
(182, 3, 54, 'Jeans & Shorts', 'Jeans_Shorts', '', 1, 0, 0, 0, 3, 0),
(183, 8, 159, 'Japanese Restaurant', 'Japanese_Restaurant', '', 1, 0, 0, 0, 4, 0),
(184, 8, 155, 'Yogo', 'Yogo', '', 1, 0, 0, 0, 3, 0),
(188, 1, 1, 'Watch', 'Watch', '', 1, 0, 0, 0, 2, 0),
(186, 3, 55, 'FlipFlop', 'FlipFlop', '', 1, 0, 0, 0, 3, 0),
(187, 3, 55, 'Heels', 'Heels', '', 1, 0, 0, 0, 3, 0),
(189, 1, 188, 'Smart Watches', 'Smart_Watches', '', 1, 0, 0, 0, 3, 0),
(190, 1, 188, 'Wrist Watch', 'Wrist_Watch', '', 1, 0, 0, 0, 3, 0),
(191, 3, 3, 'Women Jewellery', 'Women_Jewellery', '', 1, 0, 0, 0, 2, 0),
(192, 3, 191, ' Bangles', 'Bangles', '', 1, 0, 0, 0, 3, 0),
(193, 3, 191, 'Rings', 'Rings', '', 1, 0, 0, 0, 3, 0),
(194, 3, 191, 'Earrings', 'Earrings', '', 1, 0, 0, 0, 3, 0),
(195, 0, 0, 'Neww11', 'Neww11', '', 0, 1, 1, 1, 1, 0),
(196, 195, 195, 'New2', 'New2', '', 1, 0, 0, 0, 2, 0),
(197, 195, 195, 'new3', 'new3', '', 1, 0, 0, 0, 2, 0),
(198, 195, 196, 'newwss', 'newwss', '', 1, 0, 0, 0, 3, 0),
(199, 195, 196, 'newwww', 'newwww', '', 1, 0, 0, 0, 3, 0),
(200, 195, 198, 'dfgdf', 'dfgdf', '', 1, 0, 0, 0, 4, 0),
(202, 0, 0, 'Kiddooos', 'Kiddooos', '', 1, 1, 1, 1, 1, 0),
(203, 202, 202, 'Kiddo1', 'Kiddo1', '', 1, 0, 0, 0, 2, 0),
(204, 202, 202, 'Kiddo2', 'Kiddo2', '', 1, 0, 0, 0, 2, 0),
(205, 202, 203, 'Kiddoo3', 'Kiddoo3', '', 1, 0, 0, 0, 3, 0),
(206, 202, 204, 'Kiddo4', 'Kiddo4', '', 1, 0, 0, 0, 3, 0),
(207, 202, 205, 'Kiddor', 'Kiddor', '', 1, 0, 0, 0, 4, 0),
(208, 0, 0, 'Health & Beauty', 'Health-Beauty', '', 1, 1, 1, 1, 1, 0),
(209, 208, 208, 'Fragances', 'Fragances', '', 1, 0, 0, 0, 2, 0),
(210, 208, 208, 'Skin Care', 'Skin-Care', '', 1, 0, 0, 0, 2, 0),
(211, 208, 208, 'Make-Up', 'Make-Up', '', 1, 0, 0, 0, 2, 0),
(212, 208, 208, 'Hair and Hair Care', 'Hair-and-Hair-Care', '', 1, 0, 0, 0, 2, 0),
(213, 208, 208, 'Health & Wellbeing', 'Health-Wellbeing', '', 1, 0, 0, 0, 2, 0),
(214, 208, 212, 'Extensions and Wigs', 'Extensions-and-Wigs', '', 1, 0, 0, 0, 3, 0),
(215, 208, 212, 'Hair Care', 'Hair-Care', '', 1, 0, 0, 0, 3, 0),
(216, 208, 212, 'Hair Tools', 'Hair-Tools', '', 1, 0, 0, 0, 3, 0),
(217, 208, 211, 'Eye', 'Eye', '', 1, 0, 0, 0, 3, 0),
(218, 208, 211, 'Lips', 'Lips', '', 1, 0, 0, 0, 3, 0),
(219, 208, 211, 'Face', 'Face', '', 1, 0, 0, 0, 3, 0),
(220, 208, 211, 'Tools', 'Tools', '', 1, 0, 0, 0, 3, 0),
(221, 208, 210, 'Women Body', 'Women-Body', '', 1, 0, 0, 0, 3, 0),
(222, 208, 210, 'Women Face', 'Women-Face', '', 1, 0, 0, 0, 3, 0),
(223, 208, 210, 'Natural Products', 'Natural-Products', '', 1, 0, 0, 0, 3, 0),
(224, 0, 0, 'Agriculture', 'Agriculture', '', 1, 1, 1, 1, 1, 0),
(225, 0, 0, 'Testing', 'Testing', '', 1, 1, 1, 1, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `city`
--

CREATE TABLE IF NOT EXISTS `city` (
  `city_id` int(5) NOT NULL AUTO_INCREMENT,
  `country_id` int(3) NOT NULL,
  `city_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `city_url` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `city_latitude` varchar(15) CHARACTER SET latin1 NOT NULL,
  `city_longitude` varchar(15) CHARACTER SET latin1 NOT NULL,
  `default` int(1) NOT NULL DEFAULT '0',
  `city_status` int(1) NOT NULL DEFAULT '1' COMMENT '1-active, 0-deactive',
  PRIMARY KEY (`city_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=16 ;

--
-- Dumping data for table `city`
--

INSERT INTO `city` (`city_id`, `country_id`, `city_name`, `city_url`, `city_latitude`, `city_longitude`, `default`, `city_status`) VALUES
(1, 3, 'califorina', 'califorina', '36.66842', '-120.14648', 0, 1),
(13, 25, 'Lagos', 'Lagos', '6.5243793', '3.3792057000000', 0, 1),
(14, 25, 'Ikeja', 'Ikeja', '6.601838', '3.3514863000000', 0, 1),
(15, 25, 'Lekki', 'Lekki', '6.4589849', '3.6015207000000', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `cms`
--

CREATE TABLE IF NOT EXISTS `cms` (
  `cms_id` int(11) NOT NULL AUTO_INCREMENT,
  `cms_title` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `cms_url` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `cms_desc` longtext COLLATE utf8_unicode_ci NOT NULL,
  `type` int(1) NOT NULL DEFAULT '0',
  `cms_status` int(1) NOT NULL DEFAULT '1' COMMENT '1-active, 0-deactive',
  PRIMARY KEY (`cms_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=33 ;

-- --------------------------------------------------------

--
-- Table structure for table `color`
--

CREATE TABLE IF NOT EXISTS `color` (
  `color_id` int(11) NOT NULL AUTO_INCREMENT,
  `deal_id` int(11) NOT NULL,
  `color_name` varchar(128) NOT NULL,
  `color_code_name` varchar(64) NOT NULL,
  `color_code_id` int(11) NOT NULL,
  `color_status` int(1) NOT NULL,
  PRIMARY KEY (`color_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `color`
--

INSERT INTO `color` (`color_id`, `deal_id`, `color_name`, `color_code_name`, `color_code_id`, `color_status`) VALUES
(2, 5, '4C4F56', 'Abbey', 22, 0),
(3, 5, '0076A3', 'Allports', 35, 0),
(4, 5, '00FF00', 'Green', 2, 0),
(5, 6, '7CB0A1', 'Acapulco', 29, 0),
(6, 6, '326749', 'Killarney', 52, 0);

-- --------------------------------------------------------

--
-- Table structure for table `color_code`
--

CREATE TABLE IF NOT EXISTS `color_code` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `color_code` varchar(64) NOT NULL,
  `color_name` varchar(128) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=55 ;

--
-- Dumping data for table `color_code`
--

INSERT INTO `color_code` (`id`, `color_code`, `color_name`) VALUES
(1, '194CA4', 'Fun Blue'),
(2, '00FF00', 'Green'),
(3, 'FFFF00', 'Yellow'),
(4, '0000FF', 'Blue'),
(5, '90B6F9', 'Malibu'),
(7, '044022', 'Zuccini'),
(15, '10264C', 'Blue Zodiac'),
(17, '7DA1DE', 'Chetwode Blue'),
(18, 'F07C60', 'Burnt Sienna'),
(19, 'ED61D5', 'Lavender Magenta'),
(22, '4C4F56', 'Abbey'),
(29, '7CB0A1', 'Acapulco'),
(31, 'AF8F2C', 'Alpine'),
(32, '3B7A57', 'Amazon'),
(33, '1B1404', 'Acadia'),
(35, '0076A3', 'Allports'),
(51, '333333', 'Mine Shaft'),
(52, '326749', 'Killarney'),
(53, 'DF93BF', 'Shocking'),
(54, 'E32636', 'Alizarin Crimson');

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE IF NOT EXISTS `contact` (
  `contact_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(256) NOT NULL,
  `email` varchar(256) NOT NULL,
  `phone_number` varchar(20) NOT NULL,
  `message` mediumtext NOT NULL,
  `status` int(1) NOT NULL DEFAULT '1' COMMENT '1-Active , 0- InActive',
  PRIMARY KEY (`contact_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `country`
--

CREATE TABLE IF NOT EXISTS `country` (
  `country_id` int(3) NOT NULL AUTO_INCREMENT,
  `country_url` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `country_name` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `country_code` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `country_status` int(1) NOT NULL DEFAULT '1' COMMENT '1-active,0-deactive',
  `currency_symbol` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `currency_code` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`country_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=26 ;

--
-- Dumping data for table `country`
--

INSERT INTO `country` (`country_id`, `country_url`, `country_name`, `country_code`, `country_status`, `currency_symbol`, `currency_code`) VALUES
(3, 'us', 'US', 'US', 1, '$', 'USD'),
(25, 'Nigeria', 'Nigeria', 'NG', 1, 'N', 'NGN');

-- --------------------------------------------------------

--
-- Table structure for table `deals`
--

CREATE TABLE IF NOT EXISTS `deals` (
  `deal_id` int(11) NOT NULL AUTO_INCREMENT,
  `deal_title` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `url_title` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `deal_key` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `deal_description` text COLLATE utf8_unicode_ci NOT NULL,
  `fineprints` text COLLATE utf8_unicode_ci NOT NULL,
  `highlights` text COLLATE utf8_unicode_ci NOT NULL,
  `terms_conditions` text COLLATE utf8_unicode_ci NOT NULL,
  `meta_description` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `meta_keywords` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `category_id` int(11) NOT NULL,
  `sub_category_id` int(11) NOT NULL,
  `sec_category_id` int(11) NOT NULL,
  `third_category_id` int(11) NOT NULL,
  `deal_type` int(1) NOT NULL COMMENT '1-deals, 2-products, 3 - Auction',
  `merchant_id` int(11) NOT NULL,
  `shop_id` int(11) NOT NULL,
  `deal_value` double NOT NULL,
  `deal_price` double NOT NULL,
  `deal_savings` double NOT NULL,
  `deal_percentage` float NOT NULL,
  `purchase_count` int(11) NOT NULL,
  `minimum_deals_limit` int(11) NOT NULL,
  `maximum_deals_limit` int(11) NOT NULL,
  `user_limit_quantity` int(5) NOT NULL,
  `bid_increment` double NOT NULL,
  `startdate` int(10) NOT NULL,
  `enddate` int(10) NOT NULL,
  `expirydate` int(10) NOT NULL,
  `created_date` int(10) NOT NULL,
  `created_by` int(11) NOT NULL,
  `deal_status` int(1) NOT NULL DEFAULT '1' COMMENT '1-active,0-deactive',
  `commission_status` int(1) NOT NULL DEFAULT '1',
  `view_count` int(11) NOT NULL,
  `deal_feature` int(1) NOT NULL,
  PRIMARY KEY (`deal_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Dumping data for table `deals`
--

INSERT INTO `deals` (`deal_id`, `deal_title`, `url_title`, `deal_key`, `deal_description`, `fineprints`, `highlights`, `terms_conditions`, `meta_description`, `meta_keywords`, `category_id`, `sub_category_id`, `sec_category_id`, `third_category_id`, `deal_type`, `merchant_id`, `shop_id`, `deal_value`, `deal_price`, `deal_savings`, `deal_percentage`, `purchase_count`, `minimum_deals_limit`, `maximum_deals_limit`, `user_limit_quantity`, `bid_increment`, `startdate`, `enddate`, `expirydate`, `created_date`, `created_by`, `deal_status`, `commission_status`, `view_count`, `deal_feature`) VALUES
(1, 'Refine Medical Spa - Near North Side', 'Refine-Medical-Spa-Near-North-Side', 'f949nfo1', '<h4 style="box-sizing: border-box; line-height: 1.2; font-weight: 400; font-family: OpenSansLight; margin: 0px 0px 10px; font-size: 24px; color: rgb(51, 51, 51); background-color: rgb(255, 255, 255); ">Refine Medical Spa</h4><p style="box-sizing: border-box; margin: 0px 0px 20px; color: rgb(51, 51, 51); font-family: OpenSansRegular, ''Helvetica Neue'', Helvetica, Arial, FreeSans, sans-serif; line-height: 19px; background-color: rgb(255, 255, 255); "></p><p style="box-sizing: border-box; margin: 0px 0px 20px; color: rgb(51, 51, 51); font-family: OpenSansRegular, ''Helvetica Neue'', Helvetica, Arial, FreeSans, sans-serif; line-height: 19px; background-color: rgb(255, 255, 255); ">Under the expert guidance of the staff at Refine Medical Spa treats patients the "Vulich way:" individual treatments based on each client''s needs, and personal follow-ups. To combat the signs of aging, the staff offers ranging from physician-supervised weight-loss programs to radio-frequency photofacials and chemical peels. The natural peel—the Green Peel—uses plant ingredients to help take years off of the face by removing the uppermost layer of skin and covering it with ivy. Dr. Vulich can also imbue faces with the youth of yesteryear with injectables and dermal fillers. For physiques in need of attention, the staff hones in on excess curves with Zerona and Venus Freeze body sculpting, and creates smoother expanses with laser hair removal.</p><p style="box-sizing: border-box; margin: 0px 0px 20px; color: rgb(51, 51, 51); font-family: OpenSansRegular, ''Helvetica Neue'', Helvetica, Arial, FreeSans, sans-serif; line-height: 19px; background-color: rgb(255, 255, 255); "></p><div class="nutshell highlights " style="box-sizing: border-box; padding: 0px; "><h3 style="box-sizing: border-box; line-height: 21px; font-weight: 400; font-family: OpenSansLight, ''Helvetica Neue'', Arial, Helvetica, FreeSans, sans-serif; margin: 0px 0px 10px; font-size: 24px; ">In a Nutshell</h3><p style="box-sizing: border-box; margin: 0px 0px 20px; ">Specialists help reduce the appearance of wrinkles and acne with a chemical peel; facials help cleanse and exfoliate skin</p></div><div class="fine-print " style="box-sizing: border-box; padding: 0px; "><h3 style="box-sizing: border-box; line-height: 21px; font-weight: 400; font-family: OpenSansLight, ''Helvetica Neue'', Arial, Helvetica, FreeSans, sans-serif; margin: 0px 0px 10px; font-size: 24px; ">The Fine Print</h3><p style="box-sizing: border-box; margin: 0px 0px 20px; ">Expires 180 days after purchase. Limit 1 per person, may buy 1 additional as gifts. Valid only for option purchased. Appointment required. 24hr cancellation notice required. Merchant is solely responsible to purchasers for the care and quality of the advertised goods and services.That apply to all deals.</p></div>', '', '', '', '', '', 3, 58, 65, 0, 0, 15, 1, 150, 200, 50, 25, 0, 2, 10, 5, 0, 1440422940, 1451500200, 1451500200, 1440423608, 14, 1, 1, 2, 0),
(2, 'Rejuvenate your mind, body and soul with an invigorating 40 minute sugar scrub and a cleansing Moroccan bath for AED 74 at Batavia Beauty Centre. Option with Mani-Pedi available for AED 109!', 'Rejuvenate-your-mind-body-and-soul-with-an-invigorating-40-minute-sugar-scrub-and-a-cleansing-Moroccan-bath-for-AED-74-at-Batavia-Beauty-Centre.-Option-with-Mani-Pedi-available-for-AED-109', 'GQHuXBm8', '<ul><div itemprop="itemCondition" style="margin: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: baseline; "><ul style="margin: 0px; padding: 0px 0px 0px 15px; border: 0px; outline: 0px; vertical-align: baseline; position: relative; "><h2 class="h2-style" style="margin: 0px 0px 10px; padding: 0px; border: 0px; outline: 0px; font-size: 18px; vertical-align: baseline; color: rgb(51, 51, 51); ">Conditions</h2><p style="margin: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: baseline; "></p><div itemprop="itemCondition" style="margin: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: baseline; "><ul style="margin: 0px; padding: 0px 0px 0px 15px; border: 0px; outline: 0px; vertical-align: baseline; position: relative; "><li style="margin: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: baseline; ">Valid for 60 days from date of purchase</li></ul><ul style="margin: 0px; padding: 0px 0px 0px 15px; border: 0px; outline: 0px; vertical-align: baseline; position: relative; "><li style="margin: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: baseline; background-color: rgb(255, 255, 255); color: rgb(51, 51, 51); font-family: Arial, Helvetica, sans-serif; line-height: 16px; ">Open daily from 10:00am to 10:00pm</li><li style="margin: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: baseline; background-color: rgb(255, 255, 255); color: rgb(51, 51, 51); font-family: Arial, Helvetica, sans-serif; line-height: 16px; ">Deal is valid at the Jumeirah location only</li><li style="margin: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: baseline; background-color: rgb(255, 255, 255); color: rgb(51, 51, 51); font-family: Arial, Helvetica, sans-serif; line-height: 16px; ">Prior reservation required at least 24 hours in advance. Please call 04 – 3791293 for appointments</li><li style="margin: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: baseline; background-color: rgb(255, 255, 255); color: rgb(51, 51, 51); font-family: Arial, Helvetica, sans-serif; line-height: 16px; ">For cancellations, please inform atleast 24 hours in advance</li><li style="margin: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: baseline; background-color: rgb(255, 255, 255); color: rgb(51, 51, 51); font-family: Arial, Helvetica, sans-serif; line-height: 16px; ">All services must be completed in one appointment</li><li style="margin: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: baseline; background-color: rgb(255, 255, 255); color: rgb(51, 51, 51); font-family: Arial, Helvetica, sans-serif; line-height: 16px; ">Offer does not include polish removal</li><li style="margin: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: baseline; background-color: rgb(255, 255, 255); color: rgb(51, 51, 51); font-family: Arial, Helvetica, sans-serif; line-height: 16px; ">You can either bring your own loofah or purchase one at the salon</li><li style="margin: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: baseline; background-color: rgb(255, 255, 255); color: rgb(51, 51, 51); font-family: Arial, Helvetica, sans-serif; line-height: 16px; ">Valid for women only</li><li style="margin: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: baseline; background-color: rgb(255, 255, 255); color: rgb(51, 51, 51); font-family: Arial, Helvetica, sans-serif; line-height: 16px; ">Please present a copy of your printed Cobone voucher upon arrival</li><li style="margin: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: baseline; background-color: rgb(255, 255, 255); color: rgb(51, 51, 51); font-family: Arial, Helvetica, sans-serif; line-height: 16px; ">Subject to availability</li><li></li></ul></div></ul></div></ul>', '', '', '', '', '', 8, 153, 159, 0, 0, 15, 1, 399, 499, 100, 20.0401, 0, 5, 10, 8, 0, 1440423120, 1451500200, 1451500200, 1440423281, 14, 1, 1, 2, 0),
(3, 'Mi Pearls Sparkling Ruby Gold Chain', 'Mi-Pearls-Sparkling-Ruby-Gold-Chain', 'ODfAdso9', '<span style="color: rgb(46, 46, 46); font-family: tahoma; line-height: 20px; background-color: rgb(255, 255, 255); ">Mi Pearls is part of the Sri Jagdamba Pearls Group a leader pioneer in the pearl industry.Right from the time of the Nizams of Hyderabad who were famous for their patronage of pearls, there is only one name synonymous with the best pearls that one could find Sri Jagdamba Pearls.</span>', '', '', '', '', '', 3, 58, 64, 0, 0, 15, 1, 550, 750, 200, 26.6667, 0, 2, 20, 8, 0, 1440423300, 1446143400, 1446229800, 1440423444, 14, 1, 1, 1, 0),
(4, 'Fine Skin Dermatology and Medical Spa', 'Fine-Skin-Dermatology-and-Medical-Spa', 'NHIoAwb4', '<h4 style="margin: 0px 0px 10px; padding: 0px; border: 0px; outline: 0px; font-weight: 400; font-size: 24px; font-family: OpenSansLight; vertical-align: baseline; box-sizing: border-box; line-height: 1.2; color: rgb(51, 51, 51); background-color: rgb(255, 255, 255); ">Fine Skin Dermatology and Medical Spa</h4><p style="margin: 0px 0px 20px; padding: 0px; border: 0px; outline: 0px; font-size: 12px; font-family: OpenSansRegular, ''Helvetica Neue'', Helvetica, Arial, FreeSans, sans-serif; vertical-align: baseline; line-height: 19px; color: rgb(51, 51, 51); box-sizing: border-box; background-color: rgb(255, 255, 255); "></p><p style="margin: 0px 0px 20px; padding: 0px; border: 0px; outline: 0px; font-size: 12px; font-family: OpenSansRegular, ''Helvetica Neue'', Helvetica, Arial, FreeSans, sans-serif; vertical-align: baseline; line-height: 19px; color: rgb(51, 51, 51); box-sizing: border-box; background-color: rgb(255, 255, 255); ">Fine Skin Dermatology and Medical Spa directo  keeps a close eye on her staff of board-certified dermatologists, aestheticians, and physicians'' assistants as they work to foster skin rejuvenation. Like schoolchildren solving a word problem about peaches, techs trained in IPL hair removal deftly subtract fuzz, and visages in need of a pick-me-up can turn to a range of dermal fillers and UV-light treatments. Throughout their myriad treatments, skin specialists employ skin-preserving product lines such as NeoStrata, Pevonia, Kinerase, and Obagi.</p><p style="margin: 0px 0px 20px; padding: 0px; border: 0px; outline: 0px; font-size: 12px; font-family: OpenSansRegular, ''Helvetica Neue'', Helvetica, Arial, FreeSans, sans-serif; vertical-align: baseline; line-height: 19px; color: rgb(51, 51, 51); box-sizing: border-box; background-color: rgb(255, 255, 255); "></p><div class="nutshell highlights " style="margin: 0px; padding: 0px; border: 0px; outline: 0px; font-size: 12px; font-family: arial; vertical-align: baseline; color: rgb(102, 102, 102); line-height: 18px; background-color: rgb(255, 255, 255); box-sizing: border-box; "><h3 style="margin: 0px 0px 10px; padding: 0px; border: 0px; outline: 0px; font-weight: 400; font-style: inherit; font-size: 24px; font-family: OpenSansLight, ''Helvetica Neue'', Arial, Helvetica, FreeSans, sans-serif; vertical-align: baseline; box-sizing: border-box; line-height: 21px; ">In a Nutshell</h3><p style="margin: 0px 0px 20px; padding: 0px; border: 0px; outline: 0px; vertical-align: baseline; box-sizing: border-box; ">Highly trained staffers brighten and smooth complexions with exfoliating microdermabrasion followed up by a 20% salicylic-acid peel</p></div><div class="fine-print " style="margin: 0px; padding: 0px; border: 0px; outline: 0px; font-size: 12px; font-family: arial; vertical-align: baseline; color: rgb(102, 102, 102); line-height: 18px; background-color: rgb(255, 255, 255); box-sizing: border-box; "><h3 style="margin: 0px 0px 10px; padding: 0px; border: 0px; outline: 0px; font-weight: 400; font-style: inherit; font-size: 24px; font-family: OpenSansLight, ''Helvetica Neue'', Arial, Helvetica, FreeSans, sans-serif; vertical-align: baseline; box-sizing: border-box; line-height: 21px; ">The Fine Print</h3><p style="margin: 0px 0px 20px; padding: 0px; border: 0px; outline: 0px; vertical-align: baseline; box-sizing: border-box; ">Expires 150 days after purchase. Limit 1 per person, may buy 1 additional as a gift. Limit 1 per visit. Valid only for option purchased. Appointment required; subject to availability. 24-hr cancellation notice or $50 fee may apply. Services must be used by the same person. May redeem across visits. Valid with Kelly or Stacy only. Merchant is solely responsible to purchasers for the care and quality of the advertised goods and services.That apply to all deals.</p></div>', '', '', '', '', '', 3, 58, 63, 0, 0, 15, 1, 99, 110, 11, 10, 0, 2, 25, 5, 0, 1440423480, 1446057000, 1446229800, 1440423548, 14, 1, 1, 3, 0);

-- --------------------------------------------------------

--
-- Table structure for table `discussion`
--

CREATE TABLE IF NOT EXISTS `discussion` (
  `discussion_id` int(11) NOT NULL AUTO_INCREMENT,
  `deal_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `store_id` int(11) NOT NULL,
  `comments` text COLLATE utf8_unicode_ci NOT NULL,
  `created_date` int(10) NOT NULL,
  `discussion_status` int(1) NOT NULL DEFAULT '1',
  `delete_status` int(2) NOT NULL DEFAULT '1' COMMENT '1-Active,0-Inactive',
  `type` int(1) NOT NULL COMMENT '1-deal,2-product,3-auction',
  PRIMARY KEY (`discussion_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `discussion_likes`
--

CREATE TABLE IF NOT EXISTS `discussion_likes` (
  `likes_id` int(11) NOT NULL AUTO_INCREMENT,
  `discussion_id` int(11) NOT NULL,
  `deal_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `store_id` int(11) NOT NULL,
  `type` int(1) NOT NULL COMMENT '1-deal,2-product,3-auction',
  PRIMARY KEY (`likes_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `discussion_unlike`
--

CREATE TABLE IF NOT EXISTS `discussion_unlike` (
  `unlike_id` int(11) NOT NULL AUTO_INCREMENT,
  `discussion_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `deal_id` int(11) NOT NULL,
  `store_id` int(11) NOT NULL,
  `type` int(1) NOT NULL COMMENT '1-deal,2-product,3-auction',
  PRIMARY KEY (`unlike_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `duration`
--

CREATE TABLE IF NOT EXISTS `duration` (
  `duration_id` int(11) NOT NULL AUTO_INCREMENT,
  `duration_period` int(11) NOT NULL,
  `duration_merchantid` int(11) NOT NULL,
  `duration_status` int(1) NOT NULL COMMENT '0-block,1-unblock',
  PRIMARY KEY (`duration_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=20 ;

--
-- Dumping data for table `duration`
--

INSERT INTO `duration` (`duration_id`, `duration_period`, `duration_merchantid`, `duration_status`) VALUES
(16, 2, 15, 1),
(17, 4, 15, 1),
(18, 6, 15, 1),
(19, 8, 17, 1);

-- --------------------------------------------------------

--
-- Table structure for table `email`
--

CREATE TABLE IF NOT EXISTS `email` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `receivers_id` varchar(256) NOT NULL,
  `sender_id` int(11) NOT NULL,
  `email_subject` varchar(256) NOT NULL,
  `email_message` text NOT NULL,
  `email_template` int(1) NOT NULL,
  `type` int(1) NOT NULL,
  `send_time` int(25) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `email_settings`
--

CREATE TABLE IF NOT EXISTS `email_settings` (
  `settings_id` int(11) NOT NULL AUTO_INCREMENT,
  `sendgrid_host` varchar(150) NOT NULL,
  `sendgrid_port` int(10) NOT NULL,
  `sendgrid_username` varchar(256) NOT NULL,
  `sendgrid_password` varchar(50) NOT NULL,
  `smtp_host` varchar(150) NOT NULL,
  `smtp_port` int(10) NOT NULL,
  `smtp_username` varchar(256) NOT NULL,
  `smtp_password` varchar(50) NOT NULL,
  `api_key` varchar(256) NOT NULL,
  `list_id` varchar(256) NOT NULL,
  `replay_to_mail` varchar(150) NOT NULL,
  `from_name` varchar(250) NOT NULL,
  `status` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`settings_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `email_settings`
--

INSERT INTO `email_settings` (`settings_id`, `sendgrid_host`, `sendgrid_port`, `sendgrid_username`, `sendgrid_password`, `smtp_host`, `smtp_port`, `smtp_username`, `smtp_password`, `api_key`, `list_id`, `replay_to_mail`, `from_name`, `status`) VALUES
(1, 'smtp.sendgrid.net', 587, 'requin', 'S123123278755r', 'smtp.gmail.com', 465, 'vinodbabu.k@ndot.in', '89vinoNDOT', 'd3b197b0bcbafbf04f9d4710a885a4af-us6', 'd6e121b6da', 'contact-sales@ndot.in', 'uniecommerce', 1);

-- --------------------------------------------------------

--
-- Table structure for table `email_subscribe`
--

CREATE TABLE IF NOT EXISTS `email_subscribe` (
  `subscribe_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `email_id` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `country_id` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `city_id` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `category_id` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `suscribe_city_status` int(1) NOT NULL DEFAULT '1' COMMENT '1-Subscribe,0-Unsbscribe',
  `suscribe_status` int(1) NOT NULL DEFAULT '1' COMMENT '1-subscribe,0-unsubscribe',
  `is_deleted` int(1) NOT NULL,
  `store_id` int(11) NOT NULL,
  PRIMARY KEY (`subscribe_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=7 ;

--
-- Dumping data for table `email_subscribe`
--

INSERT INTO `email_subscribe` (`subscribe_id`, `user_id`, `email_id`, `country_id`, `city_id`, `category_id`, `suscribe_city_status`, `suscribe_status`, `is_deleted`, `store_id`) VALUES
(1, 19, 'vani.g@ndot.in', '25', '13', '5', 1, 1, 0, 0),
(2, 20, 'esakkidoss89@gmail.com', '25', '14', '6', 1, 1, 0, 0),
(3, 21, 'kalaiselvi.m@ndot.in', '25', '14', '208', 1, 1, 0, 0),
(4, 22, 'munisamy@ndot.in', '3', '1', '8', 1, 1, 0, 0),
(5, 23, 'aaaa@aaa.aa', '25', '14', '0', 1, 1, 0, 0),
(6, 24, 'adminmoderator@gmail.com', '25', '14', '0', 1, 1, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `faq`
--

CREATE TABLE IF NOT EXISTS `faq` (
  `faq_id` int(2) NOT NULL AUTO_INCREMENT,
  `question` varchar(164) NOT NULL,
  `answer` text NOT NULL,
  `faq_status` int(11) NOT NULL DEFAULT '1' COMMENT '1-active,0-inactive',
  PRIMARY KEY (`faq_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `faq`
--

INSERT INTO `faq` (`faq_id`, `question`, `answer`, `faq_status`) VALUES
(5, 'How much does it cost to create check-in deals?', 'Check-in Deals are currently free to create. In the future, the product, product availability, and pricing are all subject to change.', 1),
(6, 'I found a deal I like - how do I buy it?', 'It''s simple. Just click the green "Get It" button for the deal you wish to purchase. You’ll then be directed to a third-party site to complete your purchase.', 1),
(7, 'Wait, why did I leave Metromix when I clicked “Get It”?', 'We aggregate deals from across the web to help you find the best and most exciting offers. When you click the “Get It” button from a deal that originated somewhere other than Metromix, you’ll be taken to that provider’s website to complete your purchase.', 1),
(8, 'What if I have an issue with the deal I purchased?', 'Any purchases you choose to make are from the deal sites themselves. If you have a question or concern, each site has a customer service phone number or email address so you can quickly address any issues. Please be sure to read and follow the terms and conditions of each site and offer.', 1),
(9, 'What is the new Deals section on Metromix?', 'Not only is Metromix your trusted resource for places to go and things to do, now, with Metromix Deals, you can also find extraordinary deals and specials available in your city.', 1),
(10, 'How can I feature my business on Metromix Deals?', 'To be considered for a listing on Metromix Deals, please complete our Deal Inquiry Form.', 1),
(11, 'How long does my Deal last?', 'Your Deal will remain available for consumers to purchase indefinitely unless you indicate a maximum number available or remove your Deal via biz.yelp.com.', 1),
(12, 'How are refunds handled?', 'If Yelp issues a refund to a customer, you owe Yelp your 70% share of the customer''s payment. Yelp will deduct this amount from future payments owed to you. In general, we believe that Yelp Deals should always be a great experience for the customer. So when a customer is unhappy or believes that a Deal was difficult to redeem at your business, we will refund their payment right away.', 1),
(13, 'I created my Deal, now what?', 'Watch this video to learn more about how your deal will appear on the Yelp web site and in mobile apps. Also learn how to redeem customer deals, and how to get paid.', 1),
(14, 'How do I track who purchased my Deal?', 'Once your Deal is created there will be a dedicated area within the "Yelp Deals" section where you will find a list of purchasers, as well as their unique redemption codes. When someone redeems their Deal you can electronically check them off by hitting "redeem" next to their name.', 1);

-- --------------------------------------------------------

--
-- Table structure for table `free_gift`
--

CREATE TABLE IF NOT EXISTS `free_gift` (
  `gift_id` int(11) NOT NULL AUTO_INCREMENT,
  `gift_name` varchar(256) NOT NULL,
  `gift_key` varchar(16) NOT NULL,
  `gift_description` text NOT NULL,
  `category_id` int(11) NOT NULL,
  `quantity` int(8) NOT NULL,
  `purchased_quantity` int(8) NOT NULL,
  `gift_type` int(1) NOT NULL,
  `gift_Amount` double NOT NULL,
  `merchant_id` int(11) NOT NULL,
  `time` int(11) NOT NULL,
  `gift_status` int(1) NOT NULL DEFAULT '1' COMMENT '1-active 2-inactive',
  PRIMARY KEY (`gift_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `free_gift`
--

INSERT INTO `free_gift` (`gift_id`, `gift_name`, `gift_key`, `gift_description`, `category_id`, `quantity`, `purchased_quantity`, `gift_type`, `gift_Amount`, `merchant_id`, `time`, `gift_status`) VALUES
(1, 'Diwali Offer', 'ufsX2N2b', 'Diwali Offer Diwali Offer Diwali Offer Diwali Offer Diwali Offer Diwali Offer Diwali Offer Diwali Offer Diwali Offer Diwali Offer Diwali Offer Diwali Offer Diwali Offer Diwali Offer Diwali Offer Diwali Offer Diwali Offer Diwali Offer Diwali Offer Diwali Offer Diwali Offer Diwali Offer Diwali Offer Diwali Offer Diwali Offer Diwali Offer Diwali Offer Diwali Offer Diwali Offer Diwali Offer Diwali Offer Diwali Offer Diwali Offer Diwali Offer Diwali Offer Diwali Offer Diwali Offer Diwali Offer Diwali Offer Diwali Offer Diwali Offer Diwali Offer Diwali Offer Diwali Offer Diwali Offer Diwali Offer Diwali Offer Diwali Offer Diwali Offer Diwali Offer Diwali Offer Diwali Offer Diwali Offer Diwali Offer Diwali Offer Diwali Offer Diwali Offer Diwali Offerimg.imageResizerActiveClass{cursor:nw-resize !important;outline:1px dashed black !important;}            img.imageResizerChangedClass{z-index:300 !important;max-width:none !important;max-height:none !important;}            img.imageResizerBoxClass{margin:auto; z-index:99999 !important; position:fixed; top:0; left:0; right:0; bottom:0; border:1px solid white; outline:1px solid black;}        ', 224, 100, 5, 0, 0, 15, 1440506231, 1);

-- --------------------------------------------------------

--
-- Table structure for table `image_resize`
--

CREATE TABLE IF NOT EXISTS `image_resize` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `list_width` int(5) NOT NULL,
  `list_height` int(5) NOT NULL,
  `detail_width` int(5) NOT NULL,
  `detail_height` int(5) NOT NULL,
  `thumb_width` int(5) NOT NULL,
  `thumb_height` int(5) NOT NULL,
  `type` int(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `image_resize`
--

INSERT INTO `image_resize` (`id`, `list_width`, `list_height`, `detail_width`, `detail_height`, `thumb_width`, `thumb_height`, `type`) VALUES
(1, 290, 41, 15, 15, 215, 165, 1),
(2, 216, 251, 393, 400, 82, 61, 2),
(3, 171, 132, 393, 400, 82, 61, 3),
(4, 200, 108, 393, 400, 82, 61, 4),
(5, 210, 75, 244, 150, 100, 100, 5),
(6, 50, 50, 170, 165, 648, 335, 6),
(7, 100, 128, 0, 0, 0, 0, 7);

-- --------------------------------------------------------

--
-- Table structure for table `merchant_attribute`
--

CREATE TABLE IF NOT EXISTS `merchant_attribute` (
  `merchant_attribute_id` int(11) NOT NULL AUTO_INCREMENT,
  `merchant_id` int(11) NOT NULL,
  `storeid` int(11) NOT NULL,
  `bg_color` varchar(8) NOT NULL,
  `font_color` varchar(8) NOT NULL,
  `font_size` int(3) NOT NULL,
  `banner_1_link` varchar(512) NOT NULL,
  `banner_2_link` varchar(512) NOT NULL,
  `banner_3_link` varchar(512) NOT NULL,
  `ads_1_link` varchar(512) NOT NULL,
  `ads_2_link` varchar(512) NOT NULL,
  `ads_3_link` varchar(512) NOT NULL,
  PRIMARY KEY (`merchant_attribute_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `merchant_attribute`
--

INSERT INTO `merchant_attribute` (`merchant_attribute_id`, `merchant_id`, `storeid`, `bg_color`, `font_color`, `font_size`, `banner_1_link`, `banner_2_link`, `banner_3_link`, `ads_1_link`, `ads_2_link`, `ads_3_link`) VALUES
(1, 15, 1, '#45818e', '#000000', 12, 'http://www.google.com', 'http://www.google.com', 'http://www.google.com', 'http://www.google.com', 'http://www.google.com', 'http://www.google.com'),
(2, 17, 2, '#ffffff', '#ff0000', 12, 'http://emarket.know3.com/', 'http://emarket.know3.com/', 'http://emarket.know3.com/', 'http://emarket.know3.com/', 'http://emarket.know3.com/', 'http://emarket.know3.com/');

-- --------------------------------------------------------

--
-- Table structure for table `moderator_privileges_map`
--

CREATE TABLE IF NOT EXISTS `moderator_privileges_map` (
  `privileges_id` int(11) NOT NULL AUTO_INCREMENT,
  `moderator_id` int(11) NOT NULL,
  `privileges_dashboard` int(1) NOT NULL DEFAULT '1',
  `privileges_deals` int(1) NOT NULL,
  `privileges_deals_add` int(1) NOT NULL,
  `privileges_deals_edit` int(1) NOT NULL,
  `privileges_deals_block` int(1) NOT NULL,
  `privileges_products` int(1) NOT NULL,
  `privileges_products_add` int(1) NOT NULL,
  `privileges_products_edit` int(1) NOT NULL,
  `privileges_products_block` int(1) NOT NULL,
  `privileges_auctions` int(1) NOT NULL,
  `privileges_auctions_add` int(1) NOT NULL,
  `privileges_auctions_edit` int(1) NOT NULL,
  `privileges_auctions_block` int(1) NOT NULL,
  `privileges_transactions` int(1) NOT NULL,
  `privileges_fundrequest` int(1) NOT NULL,
  `privileges_fundrequest_edit` int(1) NOT NULL,
  `privileges_shop` int(1) NOT NULL,
  `privileges_shop_add` int(1) NOT NULL,
  `privileges_shop_edit` int(1) NOT NULL,
  `privileges_shop_block` int(1) NOT NULL,
  `privileges_shipping` int(1) NOT NULL,
  `privileges_shipping_edit` int(1) NOT NULL,
  `privileges_tac` int(1) NOT NULL,
  `privileges_tac_edit` int(1) NOT NULL,
  `privileges_return_policy` int(1) NOT NULL,
  `privileges_return_policy_edit` int(1) NOT NULL,
  `privileges_about_us` int(1) NOT NULL,
  `privileges_about_us_edit` int(1) NOT NULL,
  `privileges_personalized_store` int(1) NOT NULL,
  `privileges_personalized_store_edit` int(1) NOT NULL,
  `privileges_newsletter` int(1) NOT NULL,
  `privileges_newsletter_add` int(1) NOT NULL,
  `privileges_attributs` int(1) NOT NULL,
  `privileges_attributs_add` int(1) NOT NULL,
  `privileges_attributs_edit` int(1) NOT NULL,
  `privileges_categories` int(1) NOT NULL,
  `privileges_categories_add` int(1) NOT NULL,
  `privileges_categories_edit` int(1) NOT NULL,
  `privileges_specification` int(1) NOT NULL,
  `privileges_specification_add` int(1) NOT NULL,
  `privileges_specification_edit` int(1) NOT NULL,
  `privileges_gift` int(1) NOT NULL,
  `privileges_gift_add` int(1) NOT NULL,
  `privileges_gift_edit` int(1) NOT NULL,
  `privileges_gift_block` int(1) NOT NULL,
  PRIMARY KEY (`privileges_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

-- --------------------------------------------------------

--
-- Table structure for table `module_settings`
--

CREATE TABLE IF NOT EXISTS `module_settings` (
  `module_id` int(11) NOT NULL AUTO_INCREMENT,
  `is_deal` int(1) NOT NULL,
  `is_product` int(1) NOT NULL,
  `is_auction` int(1) NOT NULL,
  `is_blog` int(1) NOT NULL,
  `is_paypal` int(1) NOT NULL DEFAULT '1',
  `is_credit_card` int(1) NOT NULL DEFAULT '1',
  `is_authorize` int(1) NOT NULL DEFAULT '1',
  `is_cash_on_delivery` int(1) NOT NULL,
  `is_shipping` int(1) NOT NULL COMMENT '1- Free Shipping ,  2- Flat Shipping, 3- Per Product Shipping , 4- Per Item Shipping',
  `is_map` int(1) NOT NULL,
  `is_store_list` int(1) NOT NULL,
  `is_past_deal` int(1) NOT NULL,
  `is_faq` int(1) NOT NULL,
  `is_city` int(1) NOT NULL,
  `is_cms` int(1) NOT NULL COMMENT '1-header position,0-footer position',
  `is_newsletter` int(1) NOT NULL,
  `free_shipping` int(1) NOT NULL,
  `flat_shipping` int(1) NOT NULL,
  `per_product` int(1) NOT NULL,
  `per_quantity` int(1) NOT NULL,
  `aramex` int(1) NOT NULL,
  `is_pay_later` int(1) NOT NULL,
  PRIMARY KEY (`module_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `module_settings`
--

INSERT INTO `module_settings` (`module_id`, `is_deal`, `is_product`, `is_auction`, `is_blog`, `is_paypal`, `is_credit_card`, `is_authorize`, `is_cash_on_delivery`, `is_shipping`, `is_map`, `is_store_list`, `is_past_deal`, `is_faq`, `is_city`, `is_cms`, `is_newsletter`, `free_shipping`, `flat_shipping`, `per_product`, `per_quantity`, `aramex`, `is_pay_later`) VALUES
(1, 1, 1, 1, 1, 1, 1, 1, 0, 3, 1, 1, 1, 1, 0, 0, 4, 1, 1, 1, 1, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `newsletter`
--

CREATE TABLE IF NOT EXISTS `newsletter` (
  `newsletter_id` int(11) NOT NULL AUTO_INCREMENT,
  `newsletter_title` varchar(252) NOT NULL,
  `newsletter_url` varchar(252) NOT NULL,
  `newsletter_status` int(1) NOT NULL,
  PRIMARY KEY (`newsletter_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `newsletter`
--

INSERT INTO `newsletter` (`newsletter_id`, `newsletter_title`, `newsletter_url`, `newsletter_status`) VALUES
(4, 'Template 1 ', 'Template-1', 1),
(5, 'Template 2', 'Template-2', 1);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE IF NOT EXISTS `product` (
  `deal_id` int(11) NOT NULL AUTO_INCREMENT,
  `deal_title` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `url_title` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `deal_key` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `bulk_discount_buy` int(11) NOT NULL,
  `bulk_discount_get` int(11) NOT NULL,
  `deal_description` text COLLATE utf8_unicode_ci NOT NULL,
  `fineprints` text COLLATE utf8_unicode_ci NOT NULL,
  `highlights` text COLLATE utf8_unicode_ci NOT NULL,
  `color` int(1) NOT NULL DEFAULT '0' COMMENT '0 - No , 1 - Yes',
  `size` int(1) NOT NULL,
  `shipping_amount` double NOT NULL,
  `terms_conditions` text COLLATE utf8_unicode_ci NOT NULL,
  `meta_description` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `meta_keywords` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `category_id` int(11) NOT NULL,
  `sub_category_id` int(11) NOT NULL,
  `sec_category_id` int(11) NOT NULL,
  `third_category_id` int(11) NOT NULL,
  `deal_type` int(1) NOT NULL COMMENT '1-deals, 2-products, 3 - Auction',
  `merchant_id` int(11) NOT NULL,
  `shop_id` int(11) NOT NULL,
  `deal_value` double NOT NULL,
  `deal_price` double NOT NULL,
  `deal_savings` double NOT NULL,
  `deal_percentage` float NOT NULL,
  `weight` double NOT NULL,
  `height` double NOT NULL,
  `length` double NOT NULL,
  `width` double NOT NULL,
  `purchase_count` int(11) NOT NULL,
  `user_limit_quantity` int(5) NOT NULL,
  `created_date` int(10) NOT NULL,
  `created_by` int(11) NOT NULL,
  `deal_status` int(1) NOT NULL DEFAULT '1' COMMENT '1-active,0-deactive',
  `commission_status` int(1) NOT NULL DEFAULT '1',
  `delivery_period` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `view_count` int(11) NOT NULL,
  `attribute` int(1) NOT NULL COMMENT '1-Yes,0-No',
  `deal_feature` int(1) NOT NULL,
  `Including_tax` int(1) NOT NULL,
  `shipping` int(1) NOT NULL,
  `product_duration` varchar(512) COLLATE utf8_unicode_ci NOT NULL,
  `start_date` int(11) NOT NULL,
  `end_date` int(11) NOT NULL,
  `gift_offer` int(11) NOT NULL,
  `product_offer` int(1) NOT NULL COMMENT '1- bulk discount 2- Gift',
  PRIMARY KEY (`deal_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=34 ;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`deal_id`, `deal_title`, `url_title`, `deal_key`, `bulk_discount_buy`, `bulk_discount_get`, `deal_description`, `fineprints`, `highlights`, `color`, `size`, `shipping_amount`, `terms_conditions`, `meta_description`, `meta_keywords`, `category_id`, `sub_category_id`, `sec_category_id`, `third_category_id`, `deal_type`, `merchant_id`, `shop_id`, `deal_value`, `deal_price`, `deal_savings`, `deal_percentage`, `weight`, `height`, `length`, `width`, `purchase_count`, `user_limit_quantity`, `created_date`, `created_by`, `deal_status`, `commission_status`, `delivery_period`, `view_count`, `attribute`, `deal_feature`, `Including_tax`, `shipping`, `product_duration`, `start_date`, `end_date`, `gift_offer`, `product_offer`) VALUES
(1, 'Sony CyberShot W810 20.1MP Point & Shoot Digital Camera ', 'Sony-CyberShot-W810-20.1MP-Point-Shoot-Digital-Camera', 'LD9QBlw9', 0, 0, '<h3 style="margin: 0px; padding: 0px; border: 0px; font-family: arial, tahoma, verdana, sans-serif; font-size: 13px; line-height: 18px; vertical-align: baseline; color: rgb(102, 102, 102); text-align: left; word-spacing: 2px; background-color: rgb(255, 255, 255); "><div class="textheadings" style="border-bottom-width: 1px; border-bottom-style: dashed; border-bottom-color: rgb(202, 202, 202); padding: 6px 0px; margin-bottom: 10px; color: rgb(0, 0, 0); font-family: Tahoma; font-size: medium; font-weight: normal; line-height: normal; text-align: start; word-spacing: 0px; "><h2 style="font-size: 15px !important; color: rgb(21, 21, 21); padding: 6px 0px !important; line-height: 20px !important; margin: 0px; word-wrap: break-word; ">Product Summary of Sony CyberShot W810 20.1MP Point &amp; Shoot Digital Camera (Silver)</h2></div><ul class="key-features" style="list-style: none; padding: 0px; margin: 8px 8px 12px; color: rgb(55, 55, 55); font-size: 12px !important; overflow: hidden; font-family: Tahoma; font-weight: normal; line-height: normal; text-align: start; word-spacing: 0px; "><li style="background-image: url(http://i3.sdlcdn.com/img/snapdeal/pdp/productList_small.gif); padding: 0px 15px 0px 9px; float: left; width: 340px; margin: 2px 0px; line-height: 11pt; color: rgb(93, 93, 93); background-position: 0% 8px; background-repeat: no-repeat no-repeat; ">6X optical zoom</li><li style="background-image: url(http://i3.sdlcdn.com/img/snapdeal/pdp/productList_small.gif); padding: 0px 15px 0px 9px; float: left; width: 340px; margin: 2px 0px; line-height: 11pt; color: rgb(93, 93, 93); background-position: 0% 8px; background-repeat: no-repeat no-repeat; ">20.1 effective mega pixels</li><li style="background-image: url(http://i3.sdlcdn.com/img/snapdeal/pdp/productList_small.gif); padding: 0px 15px 0px 9px; float: left; width: 340px; margin: 2px 0px; line-height: 11pt; color: rgb(93, 93, 93); background-position: 0% 8px; background-repeat: no-repeat no-repeat; ">HD movie (720p)</li><li style="background-image: url(http://i3.sdlcdn.com/img/snapdeal/pdp/productList_small.gif); padding: 0px 15px 0px 9px; float: left; width: 340px; margin: 2px 0px; line-height: 11pt; color: rgb(93, 93, 93); background-position: 0% 8px; background-repeat: no-repeat no-repeat; ">2.7</li><li style="background-image: url(http://i3.sdlcdn.com/img/snapdeal/pdp/productList_small.gif); padding: 0px 15px 0px 9px; float: left; width: 340px; margin: 2px 0px; line-height: 11pt; color: rgb(93, 93, 93); background-position: 0% 8px; background-repeat: no-repeat no-repeat; ">intelligent auto</li><li style="background-image: url(http://i3.sdlcdn.com/img/snapdeal/pdp/productList_small.gif); padding: 0px 15px 0px 9px; float: left; width: 340px; margin: 2px 0px; line-height: 11pt; color: rgb(93, 93, 93); background-position: 0% 8px; background-repeat: no-repeat no-repeat; ">party mode</li><li style="background-image: url(http://i3.sdlcdn.com/img/snapdeal/pdp/productList_small.gif); padding: 0px 15px 0px 9px; float: left; width: 340px; margin: 2px 0px; line-height: 11pt; color: rgb(93, 93, 93); background-position: 0% 8px; background-repeat: no-repeat no-repeat; ">picture effect</li><li style="background-image: url(http://i3.sdlcdn.com/img/snapdeal/pdp/productList_small.gif); padding: 0px 15px 0px 9px; float: left; width: 340px; margin: 2px 0px; line-height: 11pt; color: rgb(93, 93, 93); background-position: 0% 8px; background-repeat: no-repeat no-repeat; ">beauti effect</li><li style="background-image: url(http://i3.sdlcdn.com/img/snapdeal/pdp/productList_small.gif); padding: 0px 15px 0px 9px; float: left; width: 340px; margin: 2px 0px; line-height: 11pt; color: rgb(93, 93, 93); background-position: 0% 8px; background-repeat: no-repeat no-repeat; ">sweep panorama</li><li style="background-image: url(http://i3.sdlcdn.com/img/snapdeal/pdp/productList_small.gif); padding: 0px 15px 0px 9px; float: left; width: 340px; margin: 2px 0px; line-height: 11pt; color: rgb(93, 93, 93); background-position: 0% 8px; background-repeat: no-repeat no-repeat; ">SUPC: <span id="hightLightSupc">SDL879998630</span></li></ul></h3>            img.imageResizerActiveClass{cursor:nw-resize !important;outline:1px dashed black !important;}            img.imageResizerChangedClass{z-index:300 !important;max-width:none !important;max-height:none !important;}            img.imageResizerBoxClass{margin:auto; z-index:99999 !important; position:fixed; top:0; left:0; right:0; bottom:0; border:1px solid white; outline:1px solid black;}        ', '', '', 0, 1, 0, '', '', '', 1, 73, 75, 0, 2, 15, 1, 1800, 2000, 200, 10, 0, 0, 0, 0, 6, 100, 1440422013, 15, 1, 1, '3 – 5', 2, 0, 0, 1, 1, '', 1440506220, 1440959400, 1, 2),
(2, 'Amkette Ergo Wireless Mouse', 'Amkette-Ergo-Wireless-Mouse', 'WlwfRSU4', 3, 2, '<div id="specifications" class="item_left_column"><h2> Amkette Ergo Wireless Mouse (Red)<label class="lang prod-desc-lang" style="cursor: inherit !important; "></label></h2></div><div class="details-content" style="font-family: Tahoma; "><p style="padding: 0px 8px; line-height: 20px !important; color: rgb(46, 46, 46) !important; font-family: tahoma !important; "></p><p style="padding: 0px 8px; line-height: 20px !important; color: rgb(46, 46, 46) !important; font-family: tahoma !important; ">Amkette'' Ergo Wireless Mouse gives you amazing wireless freedom. With an innovative design offering a super comfortable grip, it boasts of smart power saving technology. The high-precision sensors assure smooth and accurate movement and the 2.4 GHz advanced RF technology promises high performance every time. The wireless mouse has a high resolution of 1000 dpi and has multiple-surface tracking ability.</p><p style="padding: 0px 8px; line-height: 20px !important; color: rgb(46, 46, 46) !important; font-family: tahoma !important; "></p><div class="textheadings" style="border-bottom-width: 1px; border-bottom-style: dashed; border-bottom-color: rgb(202, 202, 202); padding: 6px 0px; margin-bottom: 10px; font-size: medium; "><h2 style="font-size: 15px !important; color: rgb(21, 21, 21); padding: 6px 0px !important; line-height: 20px !important; margin: 0px; word-wrap: break-word; ">Product Summary of Amkette Ergo Wireless Mouse (Red)</h2></div><ul class="key-features" style="list-style: none; padding: 0px; margin: 8px 8px 12px; color: rgb(55, 55, 55); font-size: 12px !important; overflow: hidden; "><li style="background-image: url(http://i3.sdlcdn.com/img/snapdeal/pdp/productList_small.gif); padding: 0px 15px 0px 9px; float: left; width: 340px; margin: 2px 0px; line-height: 11pt; color: rgb(93, 93, 93); background-position: 0% 8px; background-repeat: no-repeat no-repeat; ">Plug-n-forget Nano receiver</li><li style="background-image: url(http://i3.sdlcdn.com/img/snapdeal/pdp/productList_small.gif); padding: 0px 15px 0px 9px; float: left; width: 340px; margin: 2px 0px; line-height: 11pt; color: rgb(93, 93, 93); background-position: 0% 8px; background-repeat: no-repeat no-repeat; ">High 1000 dpi resolution</li><li style="background-image: url(http://i3.sdlcdn.com/img/snapdeal/pdp/productList_small.gif); padding: 0px 15px 0px 9px; float: left; width: 340px; margin: 2px 0px; line-height: 11pt; color: rgb(93, 93, 93); background-position: 0% 8px; background-repeat: no-repeat no-repeat; ">Ergonomic Design</li><li style="background-image: url(http://i3.sdlcdn.com/img/snapdeal/pdp/productList_small.gif); padding: 0px 15px 0px 9px; float: left; width: 340px; margin: 2px 0px; line-height: 11pt; color: rgb(93, 93, 93); background-position: 0% 8px; background-repeat: no-repeat no-repeat; ">Superior Grip</li><li style="background-image: url(http://i3.sdlcdn.com/img/snapdeal/pdp/productList_small.gif); padding: 0px 15px 0px 9px; float: left; width: 340px; margin: 2px 0px; line-height: 11pt; color: rgb(93, 93, 93); background-position: 0% 8px; background-repeat: no-repeat no-repeat; ">Multiple Surface Tracking</li><li style="background-image: url(http://i3.sdlcdn.com/img/snapdeal/pdp/productList_small.gif); padding: 0px 15px 0px 9px; float: left; width: 340px; margin: 2px 0px; line-height: 11pt; color: rgb(93, 93, 93); background-position: 0% 8px; background-repeat: no-repeat no-repeat; ">2.4 GHz Advanced Wireless</li><li style="background-image: url(http://i3.sdlcdn.com/img/snapdeal/pdp/productList_small.gif); padding: 0px 15px 0px 9px; float: left; width: 340px; margin: 2px 0px; line-height: 11pt; color: rgb(93, 93, 93); background-position: 0% 8px; background-repeat: no-repeat no-repeat; ">Smart Power Saving</li><li style="background-image: url(http://i3.sdlcdn.com/img/snapdeal/pdp/productList_small.gif); padding: 0px 15px 0px 9px; float: left; width: 340px; margin: 2px 0px; line-height: 11pt; color: rgb(93, 93, 93); background-position: 0% 8px; background-repeat: no-repeat no-repeat; ">10 meters of wireless freedom</li><li style="background-image: url(http://i3.sdlcdn.com/img/snapdeal/pdp/productList_small.gif); padding: 0px 15px 0px 9px; float: left; width: 340px; margin: 2px 0px; line-height: 11pt; color: rgb(93, 93, 93); background-position: 0% 8px; background-repeat: no-repeat no-repeat; ">SUPC: <span id="hightLightSupc">SDL291139028</span></li></ul><p></p></div><table class="fk-specs-type2" style="font-family: inherit; font-size: 10pt; font-style: inherit; font-variant: inherit; line-height: inherit; color: rgb(132, 132, 132); margin: 0px 0px 30px; padding: 0px; border: 0px; vertical-align: baseline; border-collapse: collapse; border-spacing: 0px; width: 729px; " cellspacing="0"><tbody style="margin: 0px; padding: 0px; border: 0px; font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; line-height: inherit; vertical-align: baseline; "><tr style="margin: 0px; padding: 0px; border: 0px; font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; line-height: inherit; vertical-align: baseline; "><th class="group-head" colspan="2" style="margin: 0px; padding: 5px; border: 1px solid rgb(249, 249, 249); font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; line-height: inherit; vertical-align: top; background-color: rgb(249, 249, 249); "><br></th></tr><tr class="" style="margin: 0px; padding: 0px; border: 0px; font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; line-height: inherit; vertical-align: baseline; "><td class="specs-key" style="margin: 0px; padding: 5px; border-top-width: 1px; border-right-width: 1px; border-bottom-width: 1px; border-style: dotted solid dotted none; border-top-color: rgb(201, 201, 201); border-right-color: rgb(201, 201, 201); border-bottom-color: rgb(201, 201, 201); font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; line-height: inherit; vertical-align: top; width: 172px; "><br></td><td class="specs-value fk-data" style="margin: 0px; padding: 5px; border-top-width: 1px; border-right-width: 0px; border-bottom-width: 1px; border-top-style: dotted; border-bottom-style: dotted; border-left-style: none; border-top-color: rgb(201, 201, 201); border-bottom-color: rgb(201, 201, 201); font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; line-height: inherit; vertical-align: top; "><br></td></tr><tr class="" style="margin: 0px; padding: 0px; border: 0px; font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; line-height: inherit; vertical-align: baseline; "><td class="specs-key" style="margin: 0px; padding: 5px; border-top-width: 1px; border-right-width: 1px; border-bottom-width: 1px; border-style: dotted solid dotted none; border-top-color: rgb(201, 201, 201); border-right-color: rgb(201, 201, 201); border-bottom-color: rgb(201, 201, 201); font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; line-height: inherit; vertical-align: top; width: 172px; "><br></td><td class="specs-value fk-data" style="margin: 0px; padding: 5px; border-top-width: 1px; border-right-width: 0px; border-bottom-width: 1px; border-top-style: dotted; border-bottom-style: dotted; border-left-style: none; border-top-color: rgb(201, 201, 201); border-bottom-color: rgb(201, 201, 201); font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; line-height: inherit; vertical-align: top; "><br></td></tr></tbody></table>            img.imageResizerActiveClass{cursor:nw-resize !important;outline:1px dashed black !important;}            img.imageResizerChangedClass{z-index:300 !important;max-width:none !important;max-height:none !important;}            img.imageResizerBoxClass{margin:auto; z-index:99999 !important; position:fixed; top:0; left:0; right:0; bottom:0; border:1px solid white; outline:1px solid black;}        ', '', '', 0, 1, 0, '', '', '', 1, 72, 96, 0, 2, 15, 1, 160, 200, 40, 20, 0, 0, 0, 0, 12, 1000, 1440422154, 15, 1, 1, '1-2', 4, 0, 0, 1, 1, '', 1440558960, 1443551400, 0, 1),
(3, 'Amkette Ergo Wireless Keyboard', 'Amkette-Ergo-Wireless-Keyboard', 'sRbzBO1W', 0, 0, '<div id="specifications" class="item_left_column"><h2> Amkette Ergo Wireless Mouse (Red)<label class="lang prod-desc-lang" style="cursor: inherit !important; "></label></h2></div><div class="details-content" style="font-family: Tahoma; "><p style="padding: 0px 8px; line-height: 20px !important; color: rgb(46, 46, 46) !important; font-family: tahoma !important; "></p><p style="padding: 0px 8px; line-height: 20px !important; color: rgb(46, 46, 46) !important; font-family: tahoma !important; ">Amkette'' Ergo Wireless Mouse gives you amazing wireless freedom. With an innovative design offering a super comfortable grip, it boasts of smart power saving technology. The high-precision sensors assure smooth and accurate movement and the 2.4 GHz advanced RF technology promises high performance every time. The wireless mouse has a high resolution of 1000 dpi and has multiple-surface tracking ability.</p><p style="padding: 0px 8px; line-height: 20px !important; color: rgb(46, 46, 46) !important; font-family: tahoma !important; "></p><div class="textheadings" style="border-bottom-width: 1px; border-bottom-style: dashed; border-bottom-color: rgb(202, 202, 202); padding: 6px 0px; margin-bottom: 10px; font-size: medium; "><h2 style="font-size: 15px !important; color: rgb(21, 21, 21); padding: 6px 0px !important; line-height: 20px !important; margin: 0px; word-wrap: break-word; ">Product Summary of Amkette Ergo Wireless Mouse (Red)</h2></div><ul class="key-features" style="list-style: none; padding: 0px; margin: 8px 8px 12px; color: rgb(55, 55, 55); font-size: 12px !important; overflow: hidden; "><li style="background-image: url(http://i3.sdlcdn.com/img/snapdeal/pdp/productList_small.gif); padding: 0px 15px 0px 9px; float: left; width: 340px; margin: 2px 0px; line-height: 11pt; color: rgb(93, 93, 93); background-position: 0% 8px; background-repeat: no-repeat no-repeat; ">Plug-n-forget Nano receiver</li><li style="background-image: url(http://i3.sdlcdn.com/img/snapdeal/pdp/productList_small.gif); padding: 0px 15px 0px 9px; float: left; width: 340px; margin: 2px 0px; line-height: 11pt; color: rgb(93, 93, 93); background-position: 0% 8px; background-repeat: no-repeat no-repeat; ">High 1000 dpi resolution</li><li style="background-image: url(http://i3.sdlcdn.com/img/snapdeal/pdp/productList_small.gif); padding: 0px 15px 0px 9px; float: left; width: 340px; margin: 2px 0px; line-height: 11pt; color: rgb(93, 93, 93); background-position: 0% 8px; background-repeat: no-repeat no-repeat; ">Ergonomic Design</li><li style="background-image: url(http://i3.sdlcdn.com/img/snapdeal/pdp/productList_small.gif); padding: 0px 15px 0px 9px; float: left; width: 340px; margin: 2px 0px; line-height: 11pt; color: rgb(93, 93, 93); background-position: 0% 8px; background-repeat: no-repeat no-repeat; ">Superior Grip</li><li style="background-image: url(http://i3.sdlcdn.com/img/snapdeal/pdp/productList_small.gif); padding: 0px 15px 0px 9px; float: left; width: 340px; margin: 2px 0px; line-height: 11pt; color: rgb(93, 93, 93); background-position: 0% 8px; background-repeat: no-repeat no-repeat; ">Multiple Surface Tracking</li><li style="background-image: url(http://i3.sdlcdn.com/img/snapdeal/pdp/productList_small.gif); padding: 0px 15px 0px 9px; float: left; width: 340px; margin: 2px 0px; line-height: 11pt; color: rgb(93, 93, 93); background-position: 0% 8px; background-repeat: no-repeat no-repeat; ">2.4 GHz Advanced Wireless</li><li style="background-image: url(http://i3.sdlcdn.com/img/snapdeal/pdp/productList_small.gif); padding: 0px 15px 0px 9px; float: left; width: 340px; margin: 2px 0px; line-height: 11pt; color: rgb(93, 93, 93); background-position: 0% 8px; background-repeat: no-repeat no-repeat; ">Smart Power Saving</li><li style="background-image: url(http://i3.sdlcdn.com/img/snapdeal/pdp/productList_small.gif); padding: 0px 15px 0px 9px; float: left; width: 340px; margin: 2px 0px; line-height: 11pt; color: rgb(93, 93, 93); background-position: 0% 8px; background-repeat: no-repeat no-repeat; ">10 meters of wireless freedom</li><li style="background-image: url(http://i3.sdlcdn.com/img/snapdeal/pdp/productList_small.gif); padding: 0px 15px 0px 9px; float: left; width: 340px; margin: 2px 0px; line-height: 11pt; color: rgb(93, 93, 93); background-position: 0% 8px; background-repeat: no-repeat no-repeat; ">SUPC: <span id="hightLightSupc">SDL291139028</span></li></ul><p></p></div><table cellspacing="0" class="fk-specs-type2" style="font-family: inherit; font-size: 10pt; font-style: inherit; font-variant: inherit; line-height: inherit; color: rgb(132, 132, 132); margin: 0px 0px 30px; padding: 0px; border: 0px; vertical-align: baseline; border-collapse: collapse; border-spacing: 0px; width: 729px; "><tbody style="margin: 0px; padding: 0px; border: 0px; font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; line-height: inherit; vertical-align: baseline; "><tr style="margin: 0px; padding: 0px; border: 0px; font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; line-height: inherit; vertical-align: baseline; "><th class="group-head" colspan="2" style="margin: 0px; padding: 5px; border: 1px solid rgb(249, 249, 249); font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; line-height: inherit; vertical-align: top; background-color: rgb(249, 249, 249); "><br></th></tr><tr class="" style="margin: 0px; padding: 0px; border: 0px; font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; line-height: inherit; vertical-align: baseline; "><td class="specs-key" style="margin: 0px; padding: 5px; border-top-width: 1px; border-right-width: 1px; border-bottom-width: 1px; border-style: dotted solid dotted none; border-top-color: rgb(201, 201, 201); border-right-color: rgb(201, 201, 201); border-bottom-color: rgb(201, 201, 201); font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; line-height: inherit; vertical-align: top; width: 172px; "><br></td><td class="specs-value fk-data" style="margin: 0px; padding: 5px; border-top-width: 1px; border-right-width: 0px; border-bottom-width: 1px; border-top-style: dotted; border-bottom-style: dotted; border-left-style: none; border-top-color: rgb(201, 201, 201); border-bottom-color: rgb(201, 201, 201); font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; line-height: inherit; vertical-align: top; "><br></td></tr><tr class="" style="margin: 0px; padding: 0px; border: 0px; font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; line-height: inherit; vertical-align: baseline; "><td class="specs-key" style="margin: 0px; padding: 5px; border-top-width: 1px; border-right-width: 1px; border-bottom-width: 1px; border-style: dotted solid dotted none; border-top-color: rgb(201, 201, 201); border-right-color: rgb(201, 201, 201); border-bottom-color: rgb(201, 201, 201); font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; line-height: inherit; vertical-align: top; width: 172px; "><br></td><td class="specs-value fk-data" style="margin: 0px; padding: 5px; border-top-width: 1px; border-right-width: 0px; border-bottom-width: 1px; border-top-style: dotted; border-bottom-style: dotted; border-left-style: none; border-top-color: rgb(201, 201, 201); border-bottom-color: rgb(201, 201, 201); font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; line-height: inherit; vertical-align: top; "><br></td></tr></tbody></table>', '', '', 0, 1, 0, '', '', '', 1, 72, 96, 0, 2, 15, 1, 160, 200, 40, 20, 0, 0, 0, 0, 2, 1000, 1440422162, 14, 1, 1, '1-2', 1, 0, 0, 1, 1, '', 0, 0, 0, 0),
(4, 'Authentic Love EXP159', 'Authentic-Love-EXP159', '8nGYZZGv', 0, 0, '<h3><span style="margin: 0px; padding: 0px; border: 0px; outline: 0px; font-style: inherit; ">Flowers might arrive in bud/Semi bloom/fully bloom condition as per local availability at the time of delivery. We reserve the right to substitute the flowers (Including specified color), Basket, Vase &amp; other products with equal value or higher value due to temporary, regional availability issues.<br style="margin: 0px; padding: 0px; "></span><span class="textCont  padding5px clearBoth_class" style="margin: 0px; padding: 0px 0px 5px; border: 0px; outline: 0px; font-weight: inherit; font-style: inherit; clear: both; "><br style="margin: 0px; padding: 0px; ">100 roses make this simply elegant and rich bunch</span></h3>', '', '', 0, 1, 0, '', '', '', 9, 164, 176, 0, 2, 15, 1, 135, 150, 15, 10, 0, 0, 0, 0, 0, 100, 1440422390, 14, 1, 1, '3 – 5', 1, 0, 0, 1, 1, '', 0, 0, 0, 0),
(5, 'Finder Zone Men''s Solid Formal Shirt', 'Finder-Zone-Mens-Solid-Formal-Shirt', 'RqXcjw3W', 0, 0, '<h3 class="item_desc_title fk-uppercase" style="margin: 0px; padding: 7px 0px 10px; border-width: 2px 0px 0px; border-top-style: solid; border-top-color: rgb(51, 51, 51); vertical-align: baseline; "><font size="4">Specifications Of Finder Zone Men''s Solid Formal Shirt</font></h3><table class="fk-specs-type2" cellspacing="0" style="font-size: 12.727272033691406px; font-family: arial, tahoma, verdana, sans-serif; line-height: 15.363636016845703px; margin: 0px 0px 30px; padding: 0px; border: 0px; vertical-align: baseline; border-collapse: collapse; border-spacing: 0px; width: 729.0908813476563px; color: rgb(132, 132, 132); background-color: rgb(255, 255, 255); "><tbody style="margin: 0px; padding: 0px; border: 0px; font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; line-height: inherit; vertical-align: baseline; "><tr style="margin: 0px; padding: 0px; border: 0px; font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; line-height: inherit; vertical-align: baseline; "><th class="group-head" colspan="2" style="margin: 0px; padding: 5px; border: 1px solid rgb(242, 242, 242); font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; line-height: inherit; vertical-align: top; text-transform: uppercase; background-color: rgb(242, 242, 242); ">GENERAL DETAILS</th></tr><tr class="" style="margin: 0px; padding: 0px; border: 0px; font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; line-height: inherit; vertical-align: baseline; "><td class="specs-key" style="margin: 0px; padding: 5px; border-top-width: 1px; border-right-width: 1px; border-bottom-width: 1px; border-style: dotted solid dotted none; border-top-color: rgb(201, 201, 201); border-right-color: rgb(201, 201, 201); border-bottom-color: rgb(201, 201, 201); font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; line-height: inherit; vertical-align: top; width: 171.81817626953125px; ">Pattern</td><td class="specs-value fk-data" style="margin: 0px; padding: 5px; border-top-width: 1px; border-right-width: 0px; border-bottom-width: 1px; border-top-style: dotted; border-bottom-style: dotted; border-left-style: none; border-top-color: rgb(201, 201, 201); border-bottom-color: rgb(201, 201, 201); font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; line-height: inherit; vertical-align: top; ">Solid</td></tr><tr class="" style="margin: 0px; padding: 0px; border: 0px; font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; line-height: inherit; vertical-align: baseline; "><td class="specs-key" style="margin: 0px; padding: 5px; border-top-width: 1px; border-right-width: 1px; border-bottom-width: 1px; border-style: dotted solid dotted none; border-top-color: rgb(201, 201, 201); border-right-color: rgb(201, 201, 201); border-bottom-color: rgb(201, 201, 201); font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; line-height: inherit; vertical-align: top; width: 171.81817626953125px; ">Occasion</td><td class="specs-value fk-data" style="margin: 0px; padding: 5px; border-top-width: 1px; border-right-width: 0px; border-bottom-width: 1px; border-top-style: dotted; border-bottom-style: dotted; border-left-style: none; border-top-color: rgb(201, 201, 201); border-bottom-color: rgb(201, 201, 201); font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; line-height: inherit; vertical-align: top; ">Formal</td></tr><tr class="" style="margin: 0px; padding: 0px; border: 0px; font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; line-height: inherit; vertical-align: baseline; "><td class="specs-key" style="margin: 0px; padding: 5px; border-top-width: 1px; border-right-width: 1px; border-bottom-width: 1px; border-style: dotted solid dotted none; border-top-color: rgb(201, 201, 201); border-right-color: rgb(201, 201, 201); border-bottom-color: rgb(201, 201, 201); font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; line-height: inherit; vertical-align: top; width: 171.81817626953125px; ">Ideal For</td><td class="specs-value fk-data" style="margin: 0px; padding: 5px; border-top-width: 1px; border-right-width: 0px; border-bottom-width: 1px; border-top-style: dotted; border-bottom-style: dotted; border-left-style: none; border-top-color: rgb(201, 201, 201); border-bottom-color: rgb(201, 201, 201); font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; line-height: inherit; vertical-align: top; ">Men''s</td></tr></tbody></table><table class="fk-specs-type2" cellspacing="0" style="font-size: 12.727272033691406px; font-family: arial, tahoma, verdana, sans-serif; line-height: 15.363636016845703px; margin: 0px 0px 30px; padding: 0px; border: 0px; vertical-align: baseline; border-collapse: collapse; border-spacing: 0px; width: 729.0908813476563px; color: rgb(132, 132, 132); background-color: rgb(255, 255, 255); "><tbody style="margin: 0px; padding: 0px; border: 0px; font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; line-height: inherit; vertical-align: baseline; "><tr style="margin: 0px; padding: 0px; border: 0px; font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; line-height: inherit; vertical-align: baseline; "><th class="group-head" colspan="2" style="margin: 0px; padding: 5px; border: 1px solid rgb(242, 242, 242); font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; line-height: inherit; vertical-align: top; text-transform: uppercase; background-color: rgb(242, 242, 242); ">SHIRT DETAILS</th></tr><tr class="" style="margin: 0px; padding: 0px; border: 0px; font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; line-height: inherit; vertical-align: baseline; "><td class="specs-key" style="margin: 0px; padding: 5px; border-top-width: 1px; border-right-width: 1px; border-bottom-width: 1px; border-style: dotted solid dotted none; border-top-color: rgb(201, 201, 201); border-right-color: rgb(201, 201, 201); border-bottom-color: rgb(201, 201, 201); font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; line-height: inherit; vertical-align: top; width: 171.81817626953125px; ">Sleeve</td><td class="specs-value fk-data" style="margin: 0px; padding: 5px; border-top-width: 1px; border-right-width: 0px; border-bottom-width: 1px; border-top-style: dotted; border-bottom-style: dotted; border-left-style: none; border-top-color: rgb(201, 201, 201); border-bottom-color: rgb(201, 201, 201); font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; line-height: inherit; vertical-align: top; ">Full Sleeve</td></tr><tr class="" style="margin: 0px; padding: 0px; border: 0px; font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; line-height: inherit; vertical-align: baseline; "><td class="specs-key" style="margin: 0px; padding: 5px; border-top-width: 1px; border-right-width: 1px; border-bottom-width: 1px; border-style: dotted solid dotted none; border-top-color: rgb(201, 201, 201); border-right-color: rgb(201, 201, 201); border-bottom-color: rgb(201, 201, 201); font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; line-height: inherit; vertical-align: top; width: 171.81817626953125px; ">Number of Contents in Sales Package</td><td class="specs-value fk-data" style="margin: 0px; padding: 5px; border-top-width: 1px; border-right-width: 0px; border-bottom-width: 1px; border-top-style: dotted; border-bottom-style: dotted; border-left-style: none; border-top-color: rgb(201, 201, 201); border-bottom-color: rgb(201, 201, 201); font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; line-height: inherit; vertical-align: top; ">Pack of 1</td></tr><tr class="" style="margin: 0px; padding: 0px; border: 0px; font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; line-height: inherit; vertical-align: baseline; "><td class="specs-key" style="margin: 0px; padding: 5px; border-top-width: 1px; border-right-width: 1px; border-bottom-width: 1px; border-style: dotted solid dotted none; border-top-color: rgb(201, 201, 201); border-right-color: rgb(201, 201, 201); border-bottom-color: rgb(201, 201, 201); font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; line-height: inherit; vertical-align: top; width: 171.81817626953125px; ">Collar</td><td class="specs-value fk-data" style="margin: 0px; padding: 5px; border-top-width: 1px; border-right-width: 0px; border-bottom-width: 1px; border-top-style: dotted; border-bottom-style: dotted; border-left-style: none; border-top-color: rgb(201, 201, 201); border-bottom-color: rgb(201, 201, 201); font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; line-height: inherit; vertical-align: top; ">Point Collar</td></tr><tr class="" style="margin: 0px; padding: 0px; border: 0px; font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; line-height: inherit; vertical-align: baseline; "><td class="specs-key" style="margin: 0px; padding: 5px; border-top-width: 1px; border-right-width: 1px; border-bottom-width: 1px; border-style: dotted solid dotted none; border-top-color: rgb(201, 201, 201); border-right-color: rgb(201, 201, 201); border-bottom-color: rgb(201, 201, 201); font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; line-height: inherit; vertical-align: top; width: 171.81817626953125px; ">Fabric</td><td class="specs-value fk-data" style="margin: 0px; padding: 5px; border-top-width: 1px; border-right-width: 0px; border-bottom-width: 1px; border-top-style: dotted; border-bottom-style: dotted; border-left-style: none; border-top-color: rgb(201, 201, 201); border-bottom-color: rgb(201, 201, 201); font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; line-height: inherit; vertical-align: top; ">Poplin</td></tr><tr class="" style="margin: 0px; padding: 0px; border: 0px; font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; line-height: inherit; vertical-align: baseline; "><td class="specs-key" style="margin: 0px; padding: 5px; border-top-width: 1px; border-right-width: 1px; border-bottom-width: 1px; border-style: dotted solid dotted none; border-top-color: rgb(201, 201, 201); border-right-color: rgb(201, 201, 201); border-bottom-color: rgb(201, 201, 201); font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; line-height: inherit; vertical-align: top; width: 171.81817626953125px; ">Fit</td><td class="specs-value fk-data" style="margin: 0px; padding: 5px; border-top-width: 1px; border-right-width: 0px; border-bottom-width: 1px; border-top-style: dotted; border-bottom-style: dotted; border-left-style: none; border-top-color: rgb(201, 201, 201); border-bottom-color: rgb(201, 201, 201); font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; line-height: inherit; vertical-align: top; ">Regular</td></tr></tbody></table><table class="fk-specs-type2" cellspacing="0" style="font-size: 12.727272033691406px; font-family: arial, tahoma, verdana, sans-serif; line-height: 15.363636016845703px; margin: 0px 0px 30px; padding: 0px; border: 0px; vertical-align: baseline; border-collapse: collapse; border-spacing: 0px; width: 729.0908813476563px; color: rgb(132, 132, 132); background-color: rgb(255, 255, 255); "><tbody style="margin: 0px; padding: 0px; border: 0px; font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; line-height: inherit; vertical-align: baseline; "><tr style="margin: 0px; padding: 0px; border: 0px; font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; line-height: inherit; vertical-align: baseline; "><th class="group-head" colspan="2" style="margin: 0px; padding: 5px; border: 1px solid rgb(242, 242, 242); font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; line-height: inherit; vertical-align: top; text-transform: uppercase; background-color: rgb(242, 242, 242); ">ADDITIONAL DETAILS</th></tr><tr class="" style="margin: 0px; padding: 0px; border: 0px; font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; line-height: inherit; vertical-align: baseline; "><td class="specs-key" style="margin: 0px; padding: 5px; border-top-width: 1px; border-right-width: 1px; border-bottom-width: 1px; border-style: dotted solid dotted none; border-top-color: rgb(201, 201, 201); border-right-color: rgb(201, 201, 201); border-bottom-color: rgb(201, 201, 201); font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; line-height: inherit; vertical-align: top; width: 171.81817626953125px; ">Style Code</td><td class="specs-value fk-data" style="margin: 0px; padding: 5px; border-top-width: 1px; border-right-width: 0px; border-bottom-width: 1px; border-top-style: dotted; border-bottom-style: dotted; border-left-style: none; border-top-color: rgb(201, 201, 201); border-bottom-color: rgb(201, 201, 201); font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; line-height: inherit; vertical-align: top; ">1157</td></tr></tbody></table><table class="fk-specs-type2" cellspacing="0" style="font-size: 12.727272033691406px; font-family: arial, tahoma, verdana, sans-serif; line-height: 15.363636016845703px; margin: 0px 0px 30px; padding: 0px; border: 0px; vertical-align: baseline; border-collapse: collapse; border-spacing: 0px; width: 729.0908813476563px; color: rgb(132, 132, 132); background-color: rgb(255, 255, 255); "><tbody style="margin: 0px; padding: 0px; border: 0px; font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; line-height: inherit; vertical-align: baseline; "><tr style="margin: 0px; padding: 0px; border: 0px; font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; line-height: inherit; vertical-align: baseline; "><th class="group-head" colspan="2" style="margin: 0px; padding: 5px; border: 1px solid rgb(242, 242, 242); font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; line-height: inherit; vertical-align: top; text-transform: uppercase; background-color: rgb(242, 242, 242); ">IN THE BOX</th></tr><tr class="" style="margin: 0px; padding: 0px; border: 0px; font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; line-height: inherit; vertical-align: baseline; "><td class="specs-key" style="margin: 0px; padding: 5px; border-top-width: 1px; border-right-width: 1px; border-bottom-width: 1px; border-style: dotted solid dotted none; border-top-color: rgb(201, 201, 201); border-right-color: rgb(201, 201, 201); border-bottom-color: rgb(201, 201, 201); font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; line-height: inherit; vertical-align: top; width: 171.81817626953125px; "><br></td><td class="specs-value fk-data" style="margin: 0px; padding: 5px; border-top-width: 1px; border-right-width: 0px; border-bottom-width: 1px; border-top-style: dotted; border-bottom-style: dotted; border-left-style: none; border-top-color: rgb(201, 201, 201); border-bottom-color: rgb(201, 201, 201); font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; line-height: inherit; vertical-align: top; ">Shirt</td></tr></tbody></table><table class="fk-specs-type2" cellspacing="0" style="font-size: 12.727272033691406px; font-family: arial, tahoma, verdana, sans-serif; line-height: 15.363636016845703px; margin: 0px 0px 30px; padding: 0px; border: 0px; vertical-align: baseline; border-collapse: collapse; border-spacing: 0px; width: 729.0908813476563px; color: rgb(132, 132, 132); background-color: rgb(255, 255, 255); "><tbody style="margin: 0px; padding: 0px; border: 0px; font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; line-height: inherit; vertical-align: baseline; "><tr style="margin: 0px; padding: 0px; border: 0px; font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; line-height: inherit; vertical-align: baseline; "><th class="group-head" colspan="2" style="margin: 0px; padding: 5px; border: 1px solid rgb(242, 242, 242); font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; line-height: inherit; vertical-align: top; text-transform: uppercase; background-color: rgb(242, 242, 242); ">FABRIC CARE</th></tr><tr class="" style="margin: 0px; padding: 0px; border: 0px; font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; line-height: inherit; vertical-align: baseline; "><td colspan="2" class="specs-value fk-data" style="margin: 0px; padding: 5px; border-top-width: 1px; border-right-width: 0px; border-bottom-width: 1px; border-top-style: dotted; border-bottom-style: dotted; border-left-style: none; border-top-color: rgb(201, 201, 201); border-bottom-color: rgb(201, 201, 201); font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; line-height: inherit; vertical-align: top; ">Hand Wash, Normal Machine wash</td></tr></tbody></table>img.imageResizerActiveClass{cursor:nw-resize !important;outline:1px dashed black !important;} img.imageResizerChangedClass{z-index:300 !important;max-width:none !important;max-height:none !important;} img.imageResizerBoxClass{margin:auto; z-index:99999 !important; position:fixed; top:0; left:0; right:0; bottom:0; border:1px solid white; outline:1px solid black;}', '', '', 1, 1, 0, '', '', '', 2, 112, 121, 0, 2, 15, 1, 499, 599, 100, 16.6945, 0, 0, 0, 0, 0, 700, 1440422610, 14, 1, 1, '3 – 5', 0, 0, 0, 1, 1, '', 0, 0, 0, 0);
INSERT INTO `product` (`deal_id`, `deal_title`, `url_title`, `deal_key`, `bulk_discount_buy`, `bulk_discount_get`, `deal_description`, `fineprints`, `highlights`, `color`, `size`, `shipping_amount`, `terms_conditions`, `meta_description`, `meta_keywords`, `category_id`, `sub_category_id`, `sec_category_id`, `third_category_id`, `deal_type`, `merchant_id`, `shop_id`, `deal_value`, `deal_price`, `deal_savings`, `deal_percentage`, `weight`, `height`, `length`, `width`, `purchase_count`, `user_limit_quantity`, `created_date`, `created_by`, `deal_status`, `commission_status`, `delivery_period`, `view_count`, `attribute`, `deal_feature`, `Including_tax`, `shipping`, `product_duration`, `start_date`, `end_date`, `gift_offer`, `product_offer`) VALUES
(6, 'Rain & Rainbow 3/4 Sleeve Printed Women''s Kurti', 'Rain-Rainbow-34-Sleeve-Printed-Womens-Kurti', 'ql8KNwsF', 0, 0, '<h3 class="item_desc_title fk-uppercase" style="margin: 0px; padding: 5px 0px 10px; border-width: 2px 0px 0px; border-top-style: solid; border-top-color: rgb(51, 51, 51); vertical-align: baseline; "><font size="4">Specifications Of Rain &amp; Rainbow 3/4 Sleeve Printed Women''s Kurti</font></h3><h3 class="item_desc_title fk-uppercase" style="margin: 0px; padding: 5px 0px 10px; border-width: 2px 0px 0px; border-top-style: solid; border-top-color: rgb(51, 51, 51); vertical-align: baseline; "><table cellspacing="0" class="fk-specs-type2" style="margin: 0px 0px 30px; padding: 0px; border: 0px; font-family: arial, tahoma, verdana, sans-serif; font-size: 12.727272033691406px; font-weight: normal; line-height: 15.363636016845703px; vertical-align: baseline; border-collapse: collapse; border-spacing: 0px; width: 729.0908813476563px; color: rgb(132, 132, 132); background-color: rgb(255, 255, 255); "><tbody style="margin: 0px; padding: 0px; border: 0px; font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; line-height: inherit; vertical-align: baseline; "><tr style="margin: 0px; padding: 0px; border: 0px; font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; line-height: inherit; vertical-align: baseline; "><th class="group-head" colspan="2" style="margin: 0px; padding: 5px; border: 1px solid rgb(242, 242, 242); font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; line-height: inherit; vertical-align: top; text-transform: uppercase; background-color: rgb(242, 242, 242); ">KURTI DETAILS</th></tr><tr class="" style="margin: 0px; padding: 0px; border: 0px; font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; line-height: inherit; vertical-align: baseline; "><td class="specs-key" style="margin: 0px; padding: 5px; border-top-width: 1px; border-right-width: 1px; border-bottom-width: 1px; border-style: dotted solid dotted none; border-top-color: rgb(201, 201, 201); border-right-color: rgb(201, 201, 201); border-bottom-color: rgb(201, 201, 201); font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; line-height: inherit; vertical-align: top; width: 171.81817626953125px; ">Sleeve</td><td class="specs-value fk-data" style="margin: 0px; padding: 5px; border-top-width: 1px; border-right-width: 0px; border-bottom-width: 1px; border-top-style: dotted; border-bottom-style: dotted; border-left-style: none; border-top-color: rgb(201, 201, 201); border-bottom-color: rgb(201, 201, 201); font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; line-height: inherit; vertical-align: top; ">3/4 Sleeve</td></tr><tr class="" style="margin: 0px; padding: 0px; border: 0px; font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; line-height: inherit; vertical-align: baseline; "><td class="specs-key" style="margin: 0px; padding: 5px; border-top-width: 1px; border-right-width: 1px; border-bottom-width: 1px; border-style: dotted solid dotted none; border-top-color: rgb(201, 201, 201); border-right-color: rgb(201, 201, 201); border-bottom-color: rgb(201, 201, 201); font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; line-height: inherit; vertical-align: top; width: 171.81817626953125px; ">Fabric</td><td class="specs-value fk-data" style="margin: 0px; padding: 5px; border-top-width: 1px; border-right-width: 0px; border-bottom-width: 1px; border-top-style: dotted; border-bottom-style: dotted; border-left-style: none; border-top-color: rgb(201, 201, 201); border-bottom-color: rgb(201, 201, 201); font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; line-height: inherit; vertical-align: top; ">Cotton</td></tr><tr class="" style="margin: 0px; padding: 0px; border: 0px; font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; line-height: inherit; vertical-align: baseline; "><td class="specs-key" style="margin: 0px; padding: 5px; border-top-width: 1px; border-right-width: 1px; border-bottom-width: 1px; border-style: dotted solid dotted none; border-top-color: rgb(201, 201, 201); border-right-color: rgb(201, 201, 201); border-bottom-color: rgb(201, 201, 201); font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; line-height: inherit; vertical-align: top; width: 171.81817626953125px; ">Style</td><td class="specs-value fk-data" style="margin: 0px; padding: 5px; border-top-width: 1px; border-right-width: 0px; border-bottom-width: 1px; border-top-style: dotted; border-bottom-style: dotted; border-left-style: none; border-top-color: rgb(201, 201, 201); border-bottom-color: rgb(201, 201, 201); font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; line-height: inherit; vertical-align: top; ">Tucks Below Yoke, Yoke at Front</td></tr><tr class="" style="margin: 0px; padding: 0px; border: 0px; font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; line-height: inherit; vertical-align: baseline; "><td class="specs-key" style="margin: 0px; padding: 5px; border-top-width: 1px; border-right-width: 1px; border-bottom-width: 1px; border-style: dotted solid dotted none; border-top-color: rgb(201, 201, 201); border-right-color: rgb(201, 201, 201); border-bottom-color: rgb(201, 201, 201); font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; line-height: inherit; vertical-align: top; width: 171.81817626953125px; ">Neck</td><td class="specs-value fk-data" style="margin: 0px; padding: 5px; border-top-width: 1px; border-right-width: 0px; border-bottom-width: 1px; border-top-style: dotted; border-bottom-style: dotted; border-left-style: none; border-top-color: rgb(201, 201, 201); border-bottom-color: rgb(201, 201, 201); font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; line-height: inherit; vertical-align: top; ">Fashion Neck</td></tr></tbody></table><table cellspacing="0" class="fk-specs-type2" style="margin: 0px 0px 30px; padding: 0px; border: 0px; font-family: arial, tahoma, verdana, sans-serif; font-size: 12.727272033691406px; font-weight: normal; line-height: 15.363636016845703px; vertical-align: baseline; border-collapse: collapse; border-spacing: 0px; width: 729.0908813476563px; color: rgb(132, 132, 132); background-color: rgb(255, 255, 255); "><tbody style="margin: 0px; padding: 0px; border: 0px; font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; line-height: inherit; vertical-align: baseline; "><tr style="margin: 0px; padding: 0px; border: 0px; font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; line-height: inherit; vertical-align: baseline; "><th class="group-head" colspan="2" style="margin: 0px; padding: 5px; border: 1px solid rgb(242, 242, 242); font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; line-height: inherit; vertical-align: top; text-transform: uppercase; background-color: rgb(242, 242, 242); ">GENERAL DETAILS</th></tr><tr class="" style="margin: 0px; padding: 0px; border: 0px; font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; line-height: inherit; vertical-align: baseline; "><td class="specs-key" style="margin: 0px; padding: 5px; border-top-width: 1px; border-right-width: 1px; border-bottom-width: 1px; border-style: dotted solid dotted none; border-top-color: rgb(201, 201, 201); border-right-color: rgb(201, 201, 201); border-bottom-color: rgb(201, 201, 201); font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; line-height: inherit; vertical-align: top; width: 171.81817626953125px; ">Pattern</td><td class="specs-value fk-data" style="margin: 0px; padding: 5px; border-top-width: 1px; border-right-width: 0px; border-bottom-width: 1px; border-top-style: dotted; border-bottom-style: dotted; border-left-style: none; border-top-color: rgb(201, 201, 201); border-bottom-color: rgb(201, 201, 201); font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; line-height: inherit; vertical-align: top; ">Printed</td></tr><tr class="" style="margin: 0px; padding: 0px; border: 0px; font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; line-height: inherit; vertical-align: baseline; "><td class="specs-key" style="margin: 0px; padding: 5px; border-top-width: 1px; border-right-width: 1px; border-bottom-width: 1px; border-style: dotted solid dotted none; border-top-color: rgb(201, 201, 201); border-right-color: rgb(201, 201, 201); border-bottom-color: rgb(201, 201, 201); font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; line-height: inherit; vertical-align: top; width: 171.81817626953125px; ">Ideal For</td><td class="specs-value fk-data" style="margin: 0px; padding: 5px; border-top-width: 1px; border-right-width: 0px; border-bottom-width: 1px; border-top-style: dotted; border-bottom-style: dotted; border-left-style: none; border-top-color: rgb(201, 201, 201); border-bottom-color: rgb(201, 201, 201); font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; line-height: inherit; vertical-align: top; ">Women''s</td></tr></tbody></table><table cellspacing="0" class="fk-specs-type2" style="margin: 0px 0px 30px; padding: 0px; border: 0px; font-family: arial, tahoma, verdana, sans-serif; font-size: 12.727272033691406px; font-weight: normal; line-height: 15.363636016845703px; vertical-align: baseline; border-collapse: collapse; border-spacing: 0px; width: 729.0908813476563px; color: rgb(132, 132, 132); background-color: rgb(255, 255, 255); "><tbody style="margin: 0px; padding: 0px; border: 0px; font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; line-height: inherit; vertical-align: baseline; "><tr style="margin: 0px; padding: 0px; border: 0px; font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; line-height: inherit; vertical-align: baseline; "><th class="group-head" colspan="2" style="margin: 0px; padding: 5px; border: 1px solid rgb(242, 242, 242); font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; line-height: inherit; vertical-align: top; text-transform: uppercase; background-color: rgb(242, 242, 242); ">FABRIC CARE</th></tr><tr class="" style="margin: 0px; padding: 0px; border: 0px; font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; line-height: inherit; vertical-align: baseline; "><td colspan="2" class="specs-value fk-data" style="margin: 0px; padding: 5px; border-top-width: 1px; border-right-width: 0px; border-bottom-width: 1px; border-top-style: dotted; border-bottom-style: dotted; border-left-style: none; border-top-color: rgb(201, 201, 201); border-bottom-color: rgb(201, 201, 201); font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; line-height: inherit; vertical-align: top; ">Hand Wash in Cold Water, Use Mild Detergent, Warm Iron, Dry Clean First Two Wash</td></tr></tbody></table><table cellspacing="0" class="fk-specs-type2" style="font-family: arial, tahoma, verdana, sans-serif; font-size: 12.727272033691406px; font-weight: normal; line-height: 15.363636016845703px; margin: 0px 0px 30px; padding: 0px; border: 0px; vertical-align: baseline; border-collapse: collapse; border-spacing: 0px; width: 729.0908813476563px; color: rgb(132, 132, 132); background-color: rgb(255, 255, 255); "><tbody style="margin: 0px; padding: 0px; border: 0px; font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; line-height: inherit; vertical-align: baseline; "><tr style="margin: 0px; padding: 0px; border: 0px; font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; line-height: inherit; vertical-align: baseline; "><th class="group-head" colspan="2" style="margin: 0px; padding: 5px; border: 1px solid rgb(242, 242, 242); font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; line-height: inherit; vertical-align: top; text-transform: uppercase; background-color: rgb(242, 242, 242); "><br></th></tr><tr class="" style="margin: 0px; padding: 0px; border: 0px; font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; line-height: inherit; vertical-align: baseline; "><td class="specs-key" style="margin: 0px; padding: 5px; border-top-width: 1px; border-right-width: 1px; border-bottom-width: 1px; border-style: dotted solid dotted none; border-top-color: rgb(201, 201, 201); border-right-color: rgb(201, 201, 201); border-bottom-color: rgb(201, 201, 201); font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; line-height: inherit; vertical-align: top; width: 171.81817626953125px; "><br></td><td class="specs-value fk-data" style="margin: 0px; padding: 5px; border-top-width: 1px; border-right-width: 0px; border-bottom-width: 1px; border-top-style: dotted; border-bottom-style: dotted; border-left-style: none; border-top-color: rgb(201, 201, 201); border-bottom-color: rgb(201, 201, 201); font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; line-height: inherit; vertical-align: top; "><br></td></tr></tbody></table></h3>', '', '', 1, 1, 0, '', '', '', 3, 57, 61, 0, 2, 15, 1, 699, 899, 200, 22.2469, 0, 0, 0, 0, 0, 300, 1440422749, 14, 1, 1, '3 – 5', 0, 0, 0, 1, 1, '', 0, 0, 0, 0),
(7, 'Nikon D3300 (Body with AF-S 18-55 mm VR II Kit Lens) DSLR Camera', 'Nikon-D3300-Body-with-AF-S-18-55-mm-VR-II-Kit-Lens-DSLR-Camera', 'yLBpJA2y', 0, 0, '<table cellspacing="0" class="specTable" style="margin: 0px 0px 30px; padding: 0px; border: 0px; font-family: arial, tahoma, verdana, sans-serif; font-size: 12.727272033691406px; line-height: 15.363636016845703px; vertical-align: baseline; border-collapse: collapse; border-spacing: 0px; width: 730px; color: rgb(51, 51, 51); background-color: rgb(255, 255, 255);"><tbody style="margin: 0px; padding: 0px; border: 0px; font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: baseline;"><tr style="margin: 0px; padding: 0px; border: 0px; font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: baseline;"><th class="groupHead" colspan="2" style="margin: 0px; padding: 6px; border: 0px; font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; line-height: inherit; vertical-align: top; background-color: rgb(242, 242, 242); text-transform: uppercase;">SHUTTER SPEED</th></tr><tr style="margin: 0px; padding: 0px; border: 0px; font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: baseline;"><td class="specsKey" style="margin: 0px; padding: 6px; border-width: 0px 1px 1px 0px; border-right-style: solid; border-bottom-style: dotted; border-right-color: rgb(201, 201, 201); border-bottom-color: rgb(201, 201, 201); font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: top; width: 169.8295440673828px;">Shutter Release Modes</td><td class="specsValue" style="margin: 0px; padding: 6px; border-width: 0px 0px 1px 1px; border-bottom-style: dotted; border-left-style: solid; border-bottom-color: rgb(201, 201, 201); border-left-color: rgb(201, 201, 201); font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: top;">Single Frame, Continuous, Self-timer, Delayed Remote, Quick-response Remote, Quiet Shutter Release</td></tr><tr style="margin: 0px; padding: 0px; border: 0px; font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: baseline;"><td class="specsKey" style="margin: 0px; padding: 6px; border-width: 0px 1px 1px 0px; border-right-style: solid; border-bottom-style: dotted; border-right-color: rgb(201, 201, 201); border-bottom-color: rgb(201, 201, 201); font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: top; width: 169.8295440673828px;">Maximum Shutter Speed</td><td class="specsValue" style="margin: 0px; padding: 6px; border-width: 0px 0px 1px 1px; border-bottom-style: dotted; border-left-style: solid; border-bottom-color: rgb(201, 201, 201); border-left-color: rgb(201, 201, 201); font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: top;">1/4000 sec</td></tr><tr style="margin: 0px; padding: 0px; border: 0px; font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: baseline;"><td class="specsKey" style="margin: 0px; padding: 6px; border-width: 0px 1px 1px 0px; border-right-style: solid; border-bottom-style: dotted; border-right-color: rgb(201, 201, 201); border-bottom-color: rgb(201, 201, 201); font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: top; width: 169.8295440673828px;">Minimum Shutter Speed</td><td class="specsValue" style="margin: 0px; padding: 6px; border-width: 0px 0px 1px 1px; border-bottom-style: dotted; border-left-style: solid; border-bottom-color: rgb(201, 201, 201); border-left-color: rgb(201, 201, 201); font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: top;">30 sec</td></tr><tr style="margin: 0px; padding: 0px; border: 0px; font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: baseline;"><td class="specsKey" style="margin: 0px; padding: 6px; border-width: 0px 1px 1px 0px; border-right-style: solid; border-bottom-style: dotted; border-right-color: rgb(201, 201, 201); border-bottom-color: rgb(201, 201, 201); font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: top; width: 169.8295440673828px;">Shutter Flash Sync Speed</td><td class="specsValue" style="margin: 0px; padding: 6px; border-width: 0px 0px 1px 1px; border-bottom-style: dotted; border-left-style: solid; border-bottom-color: rgb(201, 201, 201); border-left-color: rgb(201, 201, 201); font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: top;">X=1/200 sec</td></tr></tbody></table><table cellspacing="0" class="specTable" style="margin: 0px 0px 30px; padding: 0px; border: 0px; font-family: arial, tahoma, verdana, sans-serif; font-size: 12.727272033691406px; line-height: 15.363636016845703px; vertical-align: baseline; border-collapse: collapse; border-spacing: 0px; width: 730px; color: rgb(51, 51, 51); background-color: rgb(255, 255, 255);"><tbody style="margin: 0px; padding: 0px; border: 0px; font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: baseline;"><tr style="margin: 0px; padding: 0px; border: 0px; font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: baseline;"><th class="groupHead" colspan="2" style="margin: 0px; padding: 6px; border: 0px; font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; line-height: inherit; vertical-align: top; background-color: rgb(242, 242, 242); text-transform: uppercase;">PIXELS</th></tr><tr style="margin: 0px; padding: 0px; border: 0px; font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: baseline;"><td class="specsKey" style="margin: 0px; padding: 6px; border-width: 0px 1px 1px 0px; border-right-style: solid; border-bottom-style: dotted; border-right-color: rgb(201, 201, 201); border-bottom-color: rgb(201, 201, 201); font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: top; width: 169.8295440673828px;">Total Pixel/Gross Pixel</td><td class="specsValue" style="margin: 0px; padding: 6px; border-width: 0px 0px 1px 1px; border-bottom-style: dotted; border-left-style: solid; border-bottom-color: rgb(201, 201, 201); border-left-color: rgb(201, 201, 201); font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: top;">24.78</td></tr><tr style="margin: 0px; padding: 0px; border: 0px; font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: baseline;"><td class="specsKey" style="margin: 0px; padding: 6px; border-width: 0px 1px 1px 0px; border-right-style: solid; border-bottom-style: dotted; border-right-color: rgb(201, 201, 201); border-bottom-color: rgb(201, 201, 201); font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: top; width: 169.8295440673828px;">Optical Sensor Resolution (in MegaPixel)</td><td class="specsValue" style="margin: 0px; padding: 6px; border-width: 0px 0px 1px 1px; border-bottom-style: dotted; border-left-style: solid; border-bottom-color: rgb(201, 201, 201); border-left-color: rgb(201, 201, 201); font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: top;">24.2 MP</td></tr><tr style="margin: 0px; padding: 0px; border: 0px; font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: baseline;"><td class="specsKey" style="margin: 0px; padding: 6px; border-width: 0px 1px 1px 0px; border-right-style: solid; border-bottom-style: dotted; border-right-color: rgb(201, 201, 201); border-bottom-color: rgb(201, 201, 201); font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: top; width: 169.8295440673828px;">Other Resolution</td><td class="specsValue" style="margin: 0px; padding: 6px; border-width: 0px 0px 1px 1px; border-bottom-style: dotted; border-left-style: solid; border-bottom-color: rgb(201, 201, 201); border-left-color: rgb(201, 201, 201); font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: top;">4496 x 3000 (M), 2992 x 2000 (S), 1920 x 1080, 1280 x 720, 640 x 424</td></tr></tbody></table><table cellspacing="0" class="specTable" style="margin: 0px 0px 30px; padding: 0px; border: 0px; font-family: arial, tahoma, verdana, sans-serif; font-size: 12.727272033691406px; line-height: 15.363636016845703px; vertical-align: baseline; border-collapse: collapse; border-spacing: 0px; width: 730px; color: rgb(51, 51, 51); background-color: rgb(255, 255, 255);"><tbody style="margin: 0px; padding: 0px; border: 0px; font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: baseline;"><tr style="margin: 0px; padding: 0px; border: 0px; font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: baseline;"><th class="groupHead" colspan="2" style="margin: 0px; padding: 6px; border: 0px; font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; line-height: inherit; vertical-align: top; background-color: rgb(242, 242, 242); text-transform: uppercase;">LENS</th></tr><tr style="margin: 0px; padding: 0px; border: 0px; font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: baseline;"><td class="specsKey" style="margin: 0px; padding: 6px; border-width: 0px 1px 1px 0px; border-right-style: solid; border-bottom-style: dotted; border-right-color: rgb(201, 201, 201); border-bottom-color: rgb(201, 201, 201); font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: top; width: 169.8295440673828px;">Lens Type</td><td class="specsValue" style="margin: 0px; padding: 6px; border-width: 0px 0px 1px 1px; border-bottom-style: dotted; border-left-style: solid; border-bottom-color: rgb(201, 201, 201); border-left-color: rgb(201, 201, 201); font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: top;">Nikon F Mount (with AF Contacts)</td></tr><tr style="margin: 0px; padding: 0px; border: 0px; font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: baseline;"><td class="specsKey" style="margin: 0px; padding: 6px; border-width: 0px 1px 1px 0px; border-right-style: solid; border-bottom-style: dotted; border-right-color: rgb(201, 201, 201); border-bottom-color: rgb(201, 201, 201); font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: top; width: 169.8295440673828px;">Focus Mode</td><td class="specsValue" style="margin: 0px; padding: 6px; border-width: 0px 0px 1px 1px; border-bottom-style: dotted; border-left-style: solid; border-bottom-color: rgb(201, 201, 201); border-left-color: rgb(201, 201, 201); font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: top;">Single-point AF, Dynamic-area AF, Auto-area AF, 3D-tracking (11 Points)</td></tr><tr style="margin: 0px; padding: 0px; border: 0px; font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: baseline;"><td class="specsKey" style="margin: 0px; padding: 6px; border-width: 0px 1px 1px 0px; border-right-style: solid; border-bottom-style: dotted; border-right-color: rgb(201, 201, 201); border-bottom-color: rgb(201, 201, 201); font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: top; width: 169.8295440673828px;">Auto Focus</td><td class="specsValue" style="margin: 0px; padding: 6px; border-width: 0px 0px 1px 1px; border-bottom-style: dotted; border-left-style: solid; border-bottom-color: rgb(201, 201, 201); border-left-color: rgb(201, 201, 201); font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: top;">Yes</td></tr><tr style="margin: 0px; padding: 0px; border: 0px; font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: baseline;"><td class="specsKey" style="margin: 0px; padding: 6px; border-width: 0px 1px 1px 0px; border-right-style: solid; border-bottom-style: dotted; border-right-color: rgb(201, 201, 201); border-bottom-color: rgb(201, 201, 201); font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: top; width: 169.8295440673828px;">other Lens Features</td><td class="specsValue" style="margin: 0px; padding: 6px; border-width: 0px 0px 1px 1px; border-bottom-style: dotted; border-left-style: solid; border-bottom-color: rgb(201, 201, 201); border-left-color: rgb(201, 201, 201); font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: top;"><div class="dummy-content" style="margin: 0px; padding: 0px; border: 0px; font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: baseline;">Quick Return Reflex Mirror, Lens Aperture: Instant Return, Electronically Controlled, Compatible Lenses: Autofocus is Available with AF-S and AF-I Lenses, Autofocus is not Available with Other Type G and D Lenses, AF Lenses (IX NIKKOR and Lenses for the F3AF are not Supported), and AI-P Lenses, Non-...<a style="margin: 0px; padding: 0px; border: 0px; font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: baseline; color: rgb(102, 102, 102); cursor: pointer;">View More</a></div></td></tr><tr style="margin: 0px; padding: 0px; border: 0px; font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: baseline;"><td class="specsKey" style="margin: 0px; padding: 6px; border-width: 0px 1px 1px 0px; border-right-style: solid; border-bottom-style: dotted; border-right-color: rgb(201, 201, 201); border-bottom-color: rgb(201, 201, 201); font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: top; width: 169.8295440673828px;">Focus Points</td><td class="specsValue" style="margin: 0px; padding: 6px; border-width: 0px 0px 1px 1px; border-bottom-style: dotted; border-left-style: solid; border-bottom-color: rgb(201, 201, 201); border-left-color: rgb(201, 201, 201); font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: top;">11 Focus Point</td></tr><tr style="margin: 0px; padding: 0px; border: 0px; font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: baseline;"><td class="specsKey" style="margin: 0px; padding: 6px; border-width: 0px 1px 1px 0px; border-right-style: solid; border-bottom-style: dotted; border-right-color: rgb(201, 201, 201); border-bottom-color: rgb(201, 201, 201); font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: top; width: 169.8295440673828px;">Manual Focus</td><td class="specsValue" style="margin: 0px; padding: 6px; border-width: 0px 0px 1px 1px; border-bottom-style: dotted; border-left-style: solid; border-bottom-color: rgb(201, 201, 201); border-left-color: rgb(201, 201, 201); font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: top;">Yes</td></tr><tr style="margin: 0px; padding: 0px; border: 0px; font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: baseline;"><td class="specsKey" style="margin: 0px; padding: 6px; border-width: 0px 1px 1px 0px; border-right-style: solid; border-bottom-style: dotted; border-right-color: rgb(201, 201, 201); border-bottom-color: rgb(201, 201, 201); font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: top; width: 169.8295440673828px;">Focal Length</td><td class="specsValue" style="margin: 0px; padding: 6px; border-width: 0px 0px 1px 1px; border-bottom-style: dotted; border-left-style: solid; border-bottom-color: rgb(201, 201, 201); border-left-color: rgb(201, 201, 201); font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: top;">18 - 55 mm</td></tr><tr style="margin: 0px; padding: 0px; border: 0px; font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: baseline;"><td class="specsKey" style="margin: 0px; padding: 6px; border-width: 0px 1px 1px 0px; border-right-style: solid; border-bottom-style: dotted; border-right-color: rgb(201, 201, 201); border-bottom-color: rgb(201, 201, 201); font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: top; width: 169.8295440673828px;">Focusing Screen</td><td class="specsValue" style="margin: 0px; padding: 6px; border-width: 0px 0px 1px 1px; border-bottom-style: dotted; border-left-style: solid; border-bottom-color: rgb(201, 201, 201); border-left-color: rgb(201, 201, 201); font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: top;">Type B BriteView Clear Matte Mark VII Focusing Screen</td></tr><tr style="margin: 0px; padding: 0px; border: 0px; font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: baseline;"><td class="specsKey" style="margin: 0px; padding: 6px; border-width: 0px 1px 1px 0px; border-right-style: solid; border-bottom-style: dotted; border-right-color: rgb(201, 201, 201); border-bottom-color: rgb(201, 201, 201); font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: top; width: 169.8295440673828px;">Other Focus Features</td><td class="specsValue" style="margin: 0px; padding: 6px; border-width: 0px 0px 1px 1px; border-bottom-style: dotted; border-left-style: solid; border-bottom-color: rgb(201, 201, 201); border-left-color: rgb(201, 201, 201); font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: top;">1.5x Lens Focal Length, Manual Focus (MF): Electronic Rangefinder, Focus Lock</td></tr><tr style="margin: 0px; padding: 0px; border: 0px; font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: baseline;"><td class="specsKey" style="margin: 0px; padding: 6px; border-width: 0px 1px 1px 0px; border-right-style: solid; border-bottom-style: dotted; border-right-color: rgb(201, 201, 201); border-bottom-color: rgb(201, 201, 201); font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: top; width: 169.8295440673828px;">Lens Servo</td><td class="specsValue" style="margin: 0px; padding: 6px; border-width: 0px 0px 1px 1px; border-bottom-style: dotted; border-left-style: solid; border-bottom-color: rgb(201, 201, 201); border-left-color: rgb(201, 201, 201); font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: top;">Autofocus (AF), Single-servo AF (AF-S), Continuous-servo AF (AF-C), Auto AF-S/AF-C Selection (AF-A); Predictive Focus Tracking Activated Automatically According to Subject Status</td></tr><tr style="margin: 0px; padding: 0px; border: 0px; font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: baseline;"><td class="specsKey" style="margin: 0px; padding: 6px; border-width: 0px 1px 1px 0px; border-right-style: solid; border-bottom-style: dotted; border-right-color: rgb(201, 201, 201); border-bottom-color: rgb(201, 201, 201); font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: top; width: 169.8295440673828px;">Focus Range</td><td class="specsValue" style="margin: 0px; padding: 6px; border-width: 0px 0px 1px 1px; border-bottom-style: dotted; border-left-style: solid; border-bottom-color: rgb(201, 201, 201); border-left-color: rgb(201, 201, 201); font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: top;">Detection Range: -1 - +19 EV (ISO 100, 20° C)<br><br></td></tr></tbody></table>', '', '', 0, 1, 0, '', '', '', 1, 73, 74, 0, 2, 15, 1, 29000, 29183, 183, 0.627077, 0, 0, 0, 0, 1, 1000, 1440424740, 14, 1, 1, '1–3', 2, 0, 0, 1, 1, '', 0, 0, 0, 0);
INSERT INTO `product` (`deal_id`, `deal_title`, `url_title`, `deal_key`, `bulk_discount_buy`, `bulk_discount_get`, `deal_description`, `fineprints`, `highlights`, `color`, `size`, `shipping_amount`, `terms_conditions`, `meta_description`, `meta_keywords`, `category_id`, `sub_category_id`, `sec_category_id`, `third_category_id`, `deal_type`, `merchant_id`, `shop_id`, `deal_value`, `deal_price`, `deal_savings`, `deal_percentage`, `weight`, `height`, `length`, `width`, `purchase_count`, `user_limit_quantity`, `created_date`, `created_by`, `deal_status`, `commission_status`, `delivery_period`, `view_count`, `attribute`, `deal_feature`, `Including_tax`, `shipping`, `product_duration`, `start_date`, `end_date`, `gift_offer`, `product_offer`) VALUES
(8, 'Motorola Moto 360 Smartwatch(Black)', 'Motorola-Moto-360-SmartwatchBlack', 'dwUzSne3', 0, 0, '<table cellspacing="0" class="specTable" style="margin: 0px 0px 30px; padding: 0px; border: 0px; font-family: arial, tahoma, verdana, sans-serif; font-size: 12.727272033691406px; line-height: 15.363636016845703px; vertical-align: baseline; border-collapse: collapse; border-spacing: 0px; width: 730px; color: rgb(51, 51, 51); background-color: rgb(255, 255, 255);"><tbody style="margin: 0px; padding: 0px; border: 0px; font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: baseline;"><tr style="margin: 0px; padding: 0px; border: 0px; font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: baseline;"><th class="groupHead" colspan="2" style="margin: 0px; padding: 6px; border: 0px; font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; line-height: inherit; vertical-align: top; background-color: rgb(242, 242, 242); text-transform: uppercase;">GENERAL</th></tr><tr style="margin: 0px; padding: 0px; border: 0px; font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: baseline;"><td class="specsKey" style="margin: 0px; padding: 6px; border-width: 0px 1px 1px 0px; border-right-style: solid; border-bottom-style: dotted; border-right-color: rgb(201, 201, 201); border-bottom-color: rgb(201, 201, 201); font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: top; width: 169.8295440673828px;">Brand</td><td class="specsValue" style="margin: 0px; padding: 6px; border-width: 0px 0px 1px 1px; border-bottom-style: dotted; border-left-style: solid; border-bottom-color: rgb(201, 201, 201); border-left-color: rgb(201, 201, 201); font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: top;">Motorola</td></tr><tr style="margin: 0px; padding: 0px; border: 0px; font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: baseline;"><td class="specsKey" style="margin: 0px; padding: 6px; border-width: 0px 1px 1px 0px; border-right-style: solid; border-bottom-style: dotted; border-right-color: rgb(201, 201, 201); border-bottom-color: rgb(201, 201, 201); font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: top; width: 169.8295440673828px;">Dial Shape</td><td class="specsValue" style="margin: 0px; padding: 6px; border-width: 0px 0px 1px 1px; border-bottom-style: dotted; border-left-style: solid; border-bottom-color: rgb(201, 201, 201); border-left-color: rgb(201, 201, 201); font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: top;">Round</td></tr><tr style="margin: 0px; padding: 0px; border: 0px; font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: baseline;"><td class="specsKey" style="margin: 0px; padding: 6px; border-width: 0px 1px 1px 0px; border-right-style: solid; border-bottom-style: dotted; border-right-color: rgb(201, 201, 201); border-bottom-color: rgb(201, 201, 201); font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: top; width: 169.8295440673828px;">Strap Color</td><td class="specsValue" style="margin: 0px; padding: 6px; border-width: 0px 0px 1px 1px; border-bottom-style: dotted; border-left-style: solid; border-bottom-color: rgb(201, 201, 201); border-left-color: rgb(201, 201, 201); font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: top;">Black</td></tr><tr style="margin: 0px; padding: 0px; border: 0px; font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: baseline;"><td class="specsKey" style="margin: 0px; padding: 6px; border-width: 0px 1px 1px 0px; border-right-style: solid; border-bottom-style: dotted; border-right-color: rgb(201, 201, 201); border-bottom-color: rgb(201, 201, 201); font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: top; width: 169.8295440673828px;">Model Number</td><td class="specsValue" style="margin: 0px; padding: 6px; border-width: 0px 0px 1px 1px; border-bottom-style: dotted; border-left-style: solid; border-bottom-color: rgb(201, 201, 201); border-left-color: rgb(201, 201, 201); font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: top;">Moto360</td></tr><tr style="margin: 0px; padding: 0px; border: 0px; font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: baseline;"><td class="specsKey" style="margin: 0px; padding: 6px; border-width: 0px 1px 1px 0px; border-right-style: solid; border-bottom-style: dotted; border-right-color: rgb(201, 201, 201); border-bottom-color: rgb(201, 201, 201); font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: top; width: 169.8295440673828px;">Sensor</td><td class="specsValue" style="margin: 0px; padding: 6px; border-width: 0px 0px 1px 1px; border-bottom-style: dotted; border-left-style: solid; border-bottom-color: rgb(201, 201, 201); border-left-color: rgb(201, 201, 201); font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: top;">Pedometer Optical Heart Rate Monitor (PPG)</td></tr><tr style="margin: 0px; padding: 0px; border: 0px; font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: baseline;"><td class="specsKey" style="margin: 0px; padding: 6px; border-width: 0px 1px 1px 0px; border-right-style: solid; border-bottom-style: dotted; border-right-color: rgb(201, 201, 201); border-bottom-color: rgb(201, 201, 201); font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: top; width: 169.8295440673828px;">Shade</td><td class="specsValue" style="margin: 0px; padding: 6px; border-width: 0px 0px 1px 1px; border-bottom-style: dotted; border-left-style: solid; border-bottom-color: rgb(201, 201, 201); border-left-color: rgb(201, 201, 201); font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: top;">Black Leather</td></tr><tr style="margin: 0px; padding: 0px; border: 0px; font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: baseline;"><td class="specsKey" style="margin: 0px; padding: 6px; border-width: 0px 1px 1px 0px; border-right-style: solid; border-bottom-style: dotted; border-right-color: rgb(201, 201, 201); border-bottom-color: rgb(201, 201, 201); font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: top; width: 169.8295440673828px;">Water Resistant</td><td class="specsValue" style="margin: 0px; padding: 6px; border-width: 0px 0px 1px 1px; border-bottom-style: dotted; border-left-style: solid; border-bottom-color: rgb(201, 201, 201); border-left-color: rgb(201, 201, 201); font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: top;">Yes</td></tr><tr style="margin: 0px; padding: 0px; border: 0px; font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: baseline;"><td class="specsKey" style="margin: 0px; padding: 6px; border-width: 0px 1px 1px 0px; border-right-style: solid; border-bottom-style: dotted; border-right-color: rgb(201, 201, 201); border-bottom-color: rgb(201, 201, 201); font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: top; width: 169.8295440673828px;">Model Name</td><td class="specsValue" style="margin: 0px; padding: 6px; border-width: 0px 0px 1px 1px; border-bottom-style: dotted; border-left-style: solid; border-bottom-color: rgb(201, 201, 201); border-left-color: rgb(201, 201, 201); font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: top;">Moto 360</td></tr><tr style="margin: 0px; padding: 0px; border: 0px; font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: baseline;"><td class="specsKey" style="margin: 0px; padding: 6px; border-width: 0px 1px 1px 0px; border-right-style: solid; border-bottom-style: dotted; border-right-color: rgb(201, 201, 201); border-bottom-color: rgb(201, 201, 201); font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: top; width: 169.8295440673828px;">Strap Material</td><td class="specsValue" style="margin: 0px; padding: 6px; border-width: 0px 0px 1px 1px; border-bottom-style: dotted; border-left-style: solid; border-bottom-color: rgb(201, 201, 201); border-left-color: rgb(201, 201, 201); font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: top;">Leather</td></tr></tbody></table><table cellspacing="0" class="specTable" style="margin: 0px 0px 30px; padding: 0px; border: 0px; font-family: arial, tahoma, verdana, sans-serif; font-size: 12.727272033691406px; line-height: 15.363636016845703px; vertical-align: baseline; border-collapse: collapse; border-spacing: 0px; width: 730px; color: rgb(51, 51, 51); background-color: rgb(255, 255, 255);"><tbody style="margin: 0px; padding: 0px; border: 0px; font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: baseline;"><tr style="margin: 0px; padding: 0px; border: 0px; font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: baseline;"><th class="groupHead" colspan="2" style="margin: 0px; padding: 6px; border: 0px; font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; line-height: inherit; vertical-align: top; background-color: rgb(242, 242, 242); text-transform: uppercase;">DISPLAY FEATURES</th></tr><tr style="margin: 0px; padding: 0px; border: 0px; font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: baseline;"><td class="specsKey" style="margin: 0px; padding: 6px; border-width: 0px 1px 1px 0px; border-right-style: solid; border-bottom-style: dotted; border-right-color: rgb(201, 201, 201); border-bottom-color: rgb(201, 201, 201); font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: top; width: 169.8295440673828px;">Display Size</td><td class="specsValue" style="margin: 0px; padding: 6px; border-width: 0px 0px 1px 1px; border-bottom-style: dotted; border-left-style: solid; border-bottom-color: rgb(201, 201, 201); border-left-color: rgb(201, 201, 201); font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: top;">1.56 inch</td></tr><tr style="margin: 0px; padding: 0px; border: 0px; font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: baseline;"><td class="specsKey" style="margin: 0px; padding: 6px; border-width: 0px 1px 1px 0px; border-right-style: solid; border-bottom-style: dotted; border-right-color: rgb(201, 201, 201); border-bottom-color: rgb(201, 201, 201); font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: top; width: 169.8295440673828px;">Other Display Features</td><td class="specsValue" style="margin: 0px; padding: 6px; border-width: 0px 0px 1px 1px; border-bottom-style: dotted; border-left-style: solid; border-bottom-color: rgb(201, 201, 201); border-left-color: rgb(201, 201, 201); font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: top;">Backlit LCD, Corning Gorilla Glass 3, Water Resistance: IP67 Certified, 205 ppi</td></tr><tr style="margin: 0px; padding: 0px; border: 0px; font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: baseline;"><td class="specsKey" style="margin: 0px; padding: 6px; border-width: 0px 1px 1px 0px; border-right-style: solid; border-bottom-style: dotted; border-right-color: rgb(201, 201, 201); border-bottom-color: rgb(201, 201, 201); font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: top; width: 169.8295440673828px;">Display Resolution</td><td class="specsValue" style="margin: 0px; padding: 6px; border-width: 0px 0px 1px 1px; border-bottom-style: dotted; border-left-style: solid; border-bottom-color: rgb(201, 201, 201); border-left-color: rgb(201, 201, 201); font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: top;">320 x 290 pixel<br><br></td></tr></tbody></table>', '', '', 0, 1, 0, '', '', '', 1, 188, 189, 0, 2, 15, 1, 13000, 13999, 999, 7.13622, 0, 0, 0, 0, 0, 1000, 1440424969, 14, 1, 1, '2-4', 2, 0, 0, 1, 1, 'a:1:{i:0;s:4:"17,4";}', 0, 0, 0, 0),
(9, 'Ginni Bloom Brown Assorted Artificial Flower with Pot(Pack of 1)', 'Ginni-Bloom-Brown-Assorted-Artificial-Flower-with-PotPack-of-1', 'WLv7v0vf', 0, 0, '<table cellspacing="0" class="specTable" style="margin: 0px 0px 30px; padding: 0px; border: 0px; font-family: arial, tahoma, verdana, sans-serif; font-size: 12.727272033691406px; line-height: 15.363636016845703px; vertical-align: baseline; border-collapse: collapse; border-spacing: 0px; width: 730px; color: rgb(51, 51, 51); background-color: rgb(255, 255, 255);"><tbody style="margin: 0px; padding: 0px; border: 0px; font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: baseline;"><tr style="margin: 0px; padding: 0px; border: 0px; font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: baseline;"><th class="groupHead" colspan="2" style="margin: 0px; padding: 6px; border: 0px; font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; line-height: inherit; vertical-align: top; background-color: rgb(242, 242, 242); text-transform: uppercase;">GENERAL</th></tr><tr style="margin: 0px; padding: 0px; border: 0px; font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: baseline;"><td class="specsKey" style="margin: 0px; padding: 6px; border-width: 0px 1px 1px 0px; border-right-style: solid; border-bottom-style: dotted; border-right-color: rgb(201, 201, 201); border-bottom-color: rgb(201, 201, 201); font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: top; width: 169.8295440673828px;">Brand</td><td class="specsValue" style="margin: 0px; padding: 6px; border-width: 0px 0px 1px 1px; border-bottom-style: dotted; border-left-style: solid; border-bottom-color: rgb(201, 201, 201); border-left-color: rgb(201, 201, 201); font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: top;">Ginni Bloom</td></tr><tr style="margin: 0px; padding: 0px; border: 0px; font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: baseline;"><td class="specsKey" style="margin: 0px; padding: 6px; border-width: 0px 1px 1px 0px; border-right-style: solid; border-bottom-style: dotted; border-right-color: rgb(201, 201, 201); border-bottom-color: rgb(201, 201, 201); font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: top; width: 169.8295440673828px;">Model Number</td><td class="specsValue" style="margin: 0px; padding: 6px; border-width: 0px 0px 1px 1px; border-bottom-style: dotted; border-left-style: solid; border-bottom-color: rgb(201, 201, 201); border-left-color: rgb(201, 201, 201); font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: top;">EA88</td></tr><tr style="margin: 0px; padding: 0px; border: 0px; font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: baseline;"><td class="specsKey" style="margin: 0px; padding: 6px; border-width: 0px 1px 1px 0px; border-right-style: solid; border-bottom-style: dotted; border-right-color: rgb(201, 201, 201); border-bottom-color: rgb(201, 201, 201); font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: top; width: 169.8295440673828px;">Fragrance</td><td class="specsValue" style="margin: 0px; padding: 6px; border-width: 0px 0px 1px 1px; border-bottom-style: dotted; border-left-style: solid; border-bottom-color: rgb(201, 201, 201); border-left-color: rgb(201, 201, 201); font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: top;">No</td></tr><tr style="margin: 0px; padding: 0px; border: 0px; font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: baseline;"><td class="specsKey" style="margin: 0px; padding: 6px; border-width: 0px 1px 1px 0px; border-right-style: solid; border-bottom-style: dotted; border-right-color: rgb(201, 201, 201); border-bottom-color: rgb(201, 201, 201); font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: top; width: 169.8295440673828px;">Type</td><td class="specsValue" style="margin: 0px; padding: 6px; border-width: 0px 0px 1px 1px; border-bottom-style: dotted; border-left-style: solid; border-bottom-color: rgb(201, 201, 201); border-left-color: rgb(201, 201, 201); font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: top;">Assorted</td></tr><tr style="margin: 0px; padding: 0px; border: 0px; font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: baseline;"><td class="specsKey" style="margin: 0px; padding: 6px; border-width: 0px 1px 1px 0px; border-right-style: solid; border-bottom-style: dotted; border-right-color: rgb(201, 201, 201); border-bottom-color: rgb(201, 201, 201); font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: top; width: 169.8295440673828px;">Color</td><td class="specsValue" style="margin: 0px; padding: 6px; border-width: 0px 0px 1px 1px; border-bottom-style: dotted; border-left-style: solid; border-bottom-color: rgb(201, 201, 201); border-left-color: rgb(201, 201, 201); font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: top;">Brown</td></tr></tbody></table><table cellspacing="0" class="specTable" style="margin: 0px 0px 30px; padding: 0px; border: 0px; font-family: arial, tahoma, verdana, sans-serif; font-size: 12.727272033691406px; line-height: 15.363636016845703px; vertical-align: baseline; border-collapse: collapse; border-spacing: 0px; width: 730px; color: rgb(51, 51, 51); background-color: rgb(255, 255, 255);"><tbody style="margin: 0px; padding: 0px; border: 0px; font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: baseline;"><tr style="margin: 0px; padding: 0px; border: 0px; font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: baseline;"><th class="groupHead" colspan="2" style="margin: 0px; padding: 6px; border: 0px; font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; line-height: inherit; vertical-align: top; background-color: rgb(242, 242, 242); text-transform: uppercase;">VASE FEATURES</th></tr><tr style="margin: 0px; padding: 0px; border: 0px; font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: baseline;"><td class="specsKey" style="margin: 0px; padding: 6px; border-width: 0px 1px 1px 0px; border-right-style: solid; border-bottom-style: dotted; border-right-color: rgb(201, 201, 201); border-bottom-color: rgb(201, 201, 201); font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: top; width: 169.8295440673828px;">Vase Included</td><td class="specsValue" style="margin: 0px; padding: 6px; border-width: 0px 0px 1px 1px; border-bottom-style: dotted; border-left-style: solid; border-bottom-color: rgb(201, 201, 201); border-left-color: rgb(201, 201, 201); font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: top;">Yes</td></tr></tbody></table><table cellspacing="0" class="specTable" style="margin: 0px 0px 30px; padding: 0px; border: 0px; font-family: arial, tahoma, verdana, sans-serif; font-size: 12.727272033691406px; line-height: 15.363636016845703px; vertical-align: baseline; border-collapse: collapse; border-spacing: 0px; width: 730px; color: rgb(51, 51, 51); background-color: rgb(255, 255, 255);"><tbody style="margin: 0px; padding: 0px; border: 0px; font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: baseline;"><tr style="margin: 0px; padding: 0px; border: 0px; font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: baseline;"><th class="groupHead" colspan="2" style="margin: 0px; padding: 6px; border: 0px; font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; line-height: inherit; vertical-align: top; background-color: rgb(242, 242, 242); text-transform: uppercase;">IN THE BOX</th></tr><tr style="margin: 0px; padding: 0px; border: 0px; font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: baseline;"><td class="specsKey" style="margin: 0px; padding: 6px; border-width: 0px 1px 1px 0px; border-right-style: solid; border-bottom-style: dotted; border-right-color: rgb(201, 201, 201); border-bottom-color: rgb(201, 201, 201); font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: top; width: 169.8295440673828px;">Sales Package</td><td class="specsValue" style="margin: 0px; padding: 6px; border-width: 0px 0px 1px 1px; border-bottom-style: dotted; border-left-style: solid; border-bottom-color: rgb(201, 201, 201); border-left-color: rgb(201, 201, 201); font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: top;">1 Arrangement of Pine Cones, Artificial Berries And Other Dries Well-Arranged Atop An Acrylic Vase.</td></tr><tr style="margin: 0px; padding: 0px; border: 0px; font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: baseline;"><td class="specsKey" style="margin: 0px; padding: 6px; border-width: 0px 1px 1px 0px; border-right-style: solid; border-bottom-style: dotted; border-right-color: rgb(201, 201, 201); border-bottom-color: rgb(201, 201, 201); font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: top; width: 169.8295440673828px;">Pack of</td><td class="specsValue" style="margin: 0px; padding: 6px; border-width: 0px 0px 1px 1px; border-bottom-style: dotted; border-left-style: solid; border-bottom-color: rgb(201, 201, 201); border-left-color: rgb(201, 201, 201); font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: top;">1</td></tr></tbody></table><table cellspacing="0" class="specTable" style="margin: 0px 0px 30px; padding: 0px; border: 0px; font-family: arial, tahoma, verdana, sans-serif; font-size: 12.727272033691406px; line-height: 15.363636016845703px; vertical-align: baseline; border-collapse: collapse; border-spacing: 0px; width: 730px; color: rgb(51, 51, 51); background-color: rgb(255, 255, 255);"><tbody style="margin: 0px; padding: 0px; border: 0px; font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: baseline;"><tr style="margin: 0px; padding: 0px; border: 0px; font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: baseline;"><th class="groupHead" colspan="2" style="margin: 0px; padding: 6px; border: 0px; font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; line-height: inherit; vertical-align: top; background-color: rgb(242, 242, 242); text-transform: uppercase;">ADDITIONAL FEATURES</th></tr><tr style="margin: 0px; padding: 0px; border: 0px; font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: baseline;"><td class="specsKey" style="margin: 0px; padding: 6px; border-width: 0px 1px 1px 0px; border-right-style: solid; border-bottom-style: dotted; border-right-color: rgb(201, 201, 201); border-bottom-color: rgb(201, 201, 201); font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: top; width: 169.8295440673828px;">Dust Resistant</td><td class="specsValue" style="margin: 0px; padding: 6px; border-width: 0px 0px 1px 1px; border-bottom-style: dotted; border-left-style: solid; border-bottom-color: rgb(201, 201, 201); border-left-color: rgb(201, 201, 201); font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: top;">No</td></tr><tr style="margin: 0px; padding: 0px; border: 0px; font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: baseline;"><td class="specsKey" style="margin: 0px; padding: 6px; border-width: 0px 1px 1px 0px; border-right-style: solid; border-bottom-style: dotted; border-right-color: rgb(201, 201, 201); border-bottom-color: rgb(201, 201, 201); font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: top; width: 169.8295440673828px;">Glitter Coated</td><td class="specsValue" style="margin: 0px; padding: 6px; border-width: 0px 0px 1px 1px; border-bottom-style: dotted; border-left-style: solid; border-bottom-color: rgb(201, 201, 201); border-left-color: rgb(201, 201, 201); font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: top;">No</td></tr></tbody></table>', '', '', 0, 1, 0, '', '', '', 9, 164, 177, 0, 2, 15, 1, 500, 599, 99, 16.5275, 0, 0, 0, 0, 2, 1000, 1440425241, 14, 1, 1, '2-4', 2, 0, 0, 1, 1, 'a:1:{i:0;s:4:"18,6";}', 0, 0, 0, 0),
(10, 'Ginni Bloom Multicolor Orchids Artificial Flower with Pot(17.5 inch, Pack of 1)', 'Ginni-Bloom-Multicolor-Orchids-Artificial-Flower-with-Pot17.5-inch-Pack-of-1', '5Ll7V3on', 0, 0, '<table cellspacing="0" class="specTable" style="margin: 0px 0px 30px; padding: 0px; border: 0px; font-family: arial, tahoma, verdana, sans-serif; font-size: 12.727272033691406px; line-height: 15.363636016845703px; vertical-align: baseline; border-collapse: collapse; border-spacing: 0px; width: 730px; color: rgb(51, 51, 51); background-color: rgb(255, 255, 255);"><tbody style="margin: 0px; padding: 0px; border: 0px; font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: baseline;"><tr style="margin: 0px; padding: 0px; border: 0px; font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: baseline;"><th class="groupHead" colspan="2" style="margin: 0px; padding: 6px; border: 0px; font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; line-height: inherit; vertical-align: top; background-color: rgb(242, 242, 242); text-transform: uppercase;">GENERAL</th></tr><tr style="margin: 0px; padding: 0px; border: 0px; font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: baseline;"><td class="specsKey" style="margin: 0px; padding: 6px; border-width: 0px 1px 1px 0px; border-right-style: solid; border-bottom-style: dotted; border-right-color: rgb(201, 201, 201); border-bottom-color: rgb(201, 201, 201); font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: top; width: 169.8295440673828px;">Brand</td><td class="specsValue" style="margin: 0px; padding: 6px; border-width: 0px 0px 1px 1px; border-bottom-style: dotted; border-left-style: solid; border-bottom-color: rgb(201, 201, 201); border-left-color: rgb(201, 201, 201); font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: top;">Ginni Bloom</td></tr><tr style="margin: 0px; padding: 0px; border: 0px; font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: baseline;"><td class="specsKey" style="margin: 0px; padding: 6px; border-width: 0px 1px 1px 0px; border-right-style: solid; border-bottom-style: dotted; border-right-color: rgb(201, 201, 201); border-bottom-color: rgb(201, 201, 201); font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: top; width: 169.8295440673828px;">Model Number</td><td class="specsValue" style="margin: 0px; padding: 6px; border-width: 0px 0px 1px 1px; border-bottom-style: dotted; border-left-style: solid; border-bottom-color: rgb(201, 201, 201); border-left-color: rgb(201, 201, 201); font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: top;">AF041ARR</td></tr><tr style="margin: 0px; padding: 0px; border: 0px; font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: baseline;"><td class="specsKey" style="margin: 0px; padding: 6px; border-width: 0px 1px 1px 0px; border-right-style: solid; border-bottom-style: dotted; border-right-color: rgb(201, 201, 201); border-bottom-color: rgb(201, 201, 201); font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: top; width: 169.8295440673828px;">Type</td><td class="specsValue" style="margin: 0px; padding: 6px; border-width: 0px 0px 1px 1px; border-bottom-style: dotted; border-left-style: solid; border-bottom-color: rgb(201, 201, 201); border-left-color: rgb(201, 201, 201); font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: top;">Orchids</td></tr><tr style="margin: 0px; padding: 0px; border: 0px; font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: baseline;"><td class="specsKey" style="margin: 0px; padding: 6px; border-width: 0px 1px 1px 0px; border-right-style: solid; border-bottom-style: dotted; border-right-color: rgb(201, 201, 201); border-bottom-color: rgb(201, 201, 201); font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: top; width: 169.8295440673828px;">Fragrance</td><td class="specsValue" style="margin: 0px; padding: 6px; border-width: 0px 0px 1px 1px; border-bottom-style: dotted; border-left-style: solid; border-bottom-color: rgb(201, 201, 201); border-left-color: rgb(201, 201, 201); font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: top;">No</td></tr><tr style="margin: 0px; padding: 0px; border: 0px; font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: baseline;"><td class="specsKey" style="margin: 0px; padding: 6px; border-width: 0px 1px 1px 0px; border-right-style: solid; border-bottom-style: dotted; border-right-color: rgb(201, 201, 201); border-bottom-color: rgb(201, 201, 201); font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: top; width: 169.8295440673828px;">Color</td><td class="specsValue" style="margin: 0px; padding: 6px; border-width: 0px 0px 1px 1px; border-bottom-style: dotted; border-left-style: solid; border-bottom-color: rgb(201, 201, 201); border-left-color: rgb(201, 201, 201); font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: top;">Multicolor</td></tr></tbody></table><table cellspacing="0" class="specTable" style="margin: 0px 0px 30px; padding: 0px; border: 0px; font-family: arial, tahoma, verdana, sans-serif; font-size: 12.727272033691406px; line-height: 15.363636016845703px; vertical-align: baseline; border-collapse: collapse; border-spacing: 0px; width: 730px; color: rgb(51, 51, 51); background-color: rgb(255, 255, 255);"><tbody style="margin: 0px; padding: 0px; border: 0px; font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: baseline;"><tr style="margin: 0px; padding: 0px; border: 0px; font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: baseline;"><th class="groupHead" colspan="2" style="margin: 0px; padding: 6px; border: 0px; font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; line-height: inherit; vertical-align: top; background-color: rgb(242, 242, 242); text-transform: uppercase;">VASE FEATURES</th></tr><tr style="margin: 0px; padding: 0px; border: 0px; font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: baseline;"><td class="specsKey" style="margin: 0px; padding: 6px; border-width: 0px 1px 1px 0px; border-right-style: solid; border-bottom-style: dotted; border-right-color: rgb(201, 201, 201); border-bottom-color: rgb(201, 201, 201); font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: top; width: 169.8295440673828px;">Vase Included</td><td class="specsValue" style="margin: 0px; padding: 6px; border-width: 0px 0px 1px 1px; border-bottom-style: dotted; border-left-style: solid; border-bottom-color: rgb(201, 201, 201); border-left-color: rgb(201, 201, 201); font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: top;">Yes</td></tr></tbody></table><table cellspacing="0" class="specTable" style="margin: 0px 0px 30px; padding: 0px; border: 0px; font-family: arial, tahoma, verdana, sans-serif; font-size: 12.727272033691406px; line-height: 15.363636016845703px; vertical-align: baseline; border-collapse: collapse; border-spacing: 0px; width: 730px; color: rgb(51, 51, 51); background-color: rgb(255, 255, 255);"><tbody style="margin: 0px; padding: 0px; border: 0px; font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: baseline;"><tr style="margin: 0px; padding: 0px; border: 0px; font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: baseline;"><th class="groupHead" colspan="2" style="margin: 0px; padding: 6px; border: 0px; font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; line-height: inherit; vertical-align: top; background-color: rgb(242, 242, 242); text-transform: uppercase;">IN THE BOX</th></tr><tr style="margin: 0px; padding: 0px; border: 0px; font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: baseline;"><td class="specsKey" style="margin: 0px; padding: 6px; border-width: 0px 1px 1px 0px; border-right-style: solid; border-bottom-style: dotted; border-right-color: rgb(201, 201, 201); border-bottom-color: rgb(201, 201, 201); font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: top; width: 169.8295440673828px;">Sales Package</td><td class="specsValue" style="margin: 0px; padding: 6px; border-width: 0px 0px 1px 1px; border-bottom-style: dotted; border-left-style: solid; border-bottom-color: rgb(201, 201, 201); border-left-color: rgb(201, 201, 201); font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: top;">One arrangement with vase</td></tr><tr style="margin: 0px; padding: 0px; border: 0px; font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: baseline;"><td class="specsKey" style="margin: 0px; padding: 6px; border-width: 0px 1px 1px 0px; border-right-style: solid; border-bottom-style: dotted; border-right-color: rgb(201, 201, 201); border-bottom-color: rgb(201, 201, 201); font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: top; width: 169.8295440673828px;">Pack of</td><td class="specsValue" style="margin: 0px; padding: 6px; border-width: 0px 0px 1px 1px; border-bottom-style: dotted; border-left-style: solid; border-bottom-color: rgb(201, 201, 201); border-left-color: rgb(201, 201, 201); font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: top;">1<br><br></td></tr></tbody></table>', '', '', 0, 1, 0, '', '', '', 9, 164, 177, 0, 2, 15, 1, 550, 600, 50, 8.33333, 0, 0, 0, 0, 0, 100, 1440425410, 14, 1, 1, '1–3', 2, 0, 0, 1, 1, 'a:1:{i:0;s:4:"16,2";}', 0, 0, 0, 0);
INSERT INTO `product` (`deal_id`, `deal_title`, `url_title`, `deal_key`, `bulk_discount_buy`, `bulk_discount_get`, `deal_description`, `fineprints`, `highlights`, `color`, `size`, `shipping_amount`, `terms_conditions`, `meta_description`, `meta_keywords`, `category_id`, `sub_category_id`, `sec_category_id`, `third_category_id`, `deal_type`, `merchant_id`, `shop_id`, `deal_value`, `deal_price`, `deal_savings`, `deal_percentage`, `weight`, `height`, `length`, `width`, `purchase_count`, `user_limit_quantity`, `created_date`, `created_by`, `deal_status`, `commission_status`, `delivery_period`, `view_count`, `attribute`, `deal_feature`, `Including_tax`, `shipping`, `product_duration`, `start_date`, `end_date`, `gift_offer`, `product_offer`) VALUES
(11, 'Amiya Garden White Gerbera Artificial Flower(19 inch, Pack of 1)', 'Amiya-Garden-White-Gerbera-Artificial-Flower19-inch-Pack-of-1', 'EPpdYwF4', 0, 0, '<table cellspacing="0" class="specTable" style="margin: 0px 0px 30px; padding: 0px; border: 0px; font-family: arial, tahoma, verdana, sans-serif; font-size: 12.727272033691406px; line-height: 15.363636016845703px; vertical-align: baseline; border-collapse: collapse; border-spacing: 0px; width: 730px; color: rgb(51, 51, 51); background-color: rgb(255, 255, 255);"><tbody style="margin: 0px; padding: 0px; border: 0px; font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: baseline;"><tr style="margin: 0px; padding: 0px; border: 0px; font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: baseline;"><th class="groupHead" colspan="2" style="margin: 0px; padding: 6px; border: 0px; font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; line-height: inherit; vertical-align: top; background-color: rgb(242, 242, 242); text-transform: uppercase;">GENERAL</th></tr><tr style="margin: 0px; padding: 0px; border: 0px; font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: baseline;"><td class="specsKey" style="margin: 0px; padding: 6px; border-width: 0px 1px 1px 0px; border-right-style: solid; border-bottom-style: dotted; border-right-color: rgb(201, 201, 201); border-bottom-color: rgb(201, 201, 201); font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: top; width: 169.8295440673828px;">Brand</td><td class="specsValue" style="margin: 0px; padding: 6px; border-width: 0px 0px 1px 1px; border-bottom-style: dotted; border-left-style: solid; border-bottom-color: rgb(201, 201, 201); border-left-color: rgb(201, 201, 201); font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: top;">Amiya Garden</td></tr><tr style="margin: 0px; padding: 0px; border: 0px; font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: baseline;"><td class="specsKey" style="margin: 0px; padding: 6px; border-width: 0px 1px 1px 0px; border-right-style: solid; border-bottom-style: dotted; border-right-color: rgb(201, 201, 201); border-bottom-color: rgb(201, 201, 201); font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: top; width: 169.8295440673828px;">Model Number</td><td class="specsValue" style="margin: 0px; padding: 6px; border-width: 0px 0px 1px 1px; border-bottom-style: dotted; border-left-style: solid; border-bottom-color: rgb(201, 201, 201); border-left-color: rgb(201, 201, 201); font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: top;">EXUP0405</td></tr><tr style="margin: 0px; padding: 0px; border: 0px; font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: baseline;"><td class="specsKey" style="margin: 0px; padding: 6px; border-width: 0px 1px 1px 0px; border-right-style: solid; border-bottom-style: dotted; border-right-color: rgb(201, 201, 201); border-bottom-color: rgb(201, 201, 201); font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: top; width: 169.8295440673828px;">Fragrance</td><td class="specsValue" style="margin: 0px; padding: 6px; border-width: 0px 0px 1px 1px; border-bottom-style: dotted; border-left-style: solid; border-bottom-color: rgb(201, 201, 201); border-left-color: rgb(201, 201, 201); font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: top;">No</td></tr><tr style="margin: 0px; padding: 0px; border: 0px; font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: baseline;"><td class="specsKey" style="margin: 0px; padding: 6px; border-width: 0px 1px 1px 0px; border-right-style: solid; border-bottom-style: dotted; border-right-color: rgb(201, 201, 201); border-bottom-color: rgb(201, 201, 201); font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: top; width: 169.8295440673828px;">Type</td><td class="specsValue" style="margin: 0px; padding: 6px; border-width: 0px 0px 1px 1px; border-bottom-style: dotted; border-left-style: solid; border-bottom-color: rgb(201, 201, 201); border-left-color: rgb(201, 201, 201); font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: top;">Gerbera</td></tr><tr style="margin: 0px; padding: 0px; border: 0px; font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: baseline;"><td class="specsKey" style="margin: 0px; padding: 6px; border-width: 0px 1px 1px 0px; border-right-style: solid; border-bottom-style: dotted; border-right-color: rgb(201, 201, 201); border-bottom-color: rgb(201, 201, 201); font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: top; width: 169.8295440673828px;">Color</td><td class="specsValue" style="margin: 0px; padding: 6px; border-width: 0px 0px 1px 1px; border-bottom-style: dotted; border-left-style: solid; border-bottom-color: rgb(201, 201, 201); border-left-color: rgb(201, 201, 201); font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: top;">White</td></tr></tbody></table><table cellspacing="0" class="specTable" style="margin: 0px 0px 30px; padding: 0px; border: 0px; font-family: arial, tahoma, verdana, sans-serif; font-size: 12.727272033691406px; line-height: 15.363636016845703px; vertical-align: baseline; border-collapse: collapse; border-spacing: 0px; width: 730px; color: rgb(51, 51, 51); background-color: rgb(255, 255, 255);"><tbody style="margin: 0px; padding: 0px; border: 0px; font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: baseline;"><tr style="margin: 0px; padding: 0px; border: 0px; font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: baseline;"><th class="groupHead" colspan="2" style="margin: 0px; padding: 6px; border: 0px; font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; line-height: inherit; vertical-align: top; background-color: rgb(242, 242, 242); text-transform: uppercase;">VASE FEATURES</th></tr><tr style="margin: 0px; padding: 0px; border: 0px; font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: baseline;"><td class="specsKey" style="margin: 0px; padding: 6px; border-width: 0px 1px 1px 0px; border-right-style: solid; border-bottom-style: dotted; border-right-color: rgb(201, 201, 201); border-bottom-color: rgb(201, 201, 201); font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: top; width: 169.8295440673828px;">Vase Included</td><td class="specsValue" style="margin: 0px; padding: 6px; border-width: 0px 0px 1px 1px; border-bottom-style: dotted; border-left-style: solid; border-bottom-color: rgb(201, 201, 201); border-left-color: rgb(201, 201, 201); font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: top;">No</td></tr></tbody></table><table cellspacing="0" class="specTable" style="margin: 0px 0px 30px; padding: 0px; border: 0px; font-family: arial, tahoma, verdana, sans-serif; font-size: 12.727272033691406px; line-height: 15.363636016845703px; vertical-align: baseline; border-collapse: collapse; border-spacing: 0px; width: 730px; color: rgb(51, 51, 51); background-color: rgb(255, 255, 255);"><tbody style="margin: 0px; padding: 0px; border: 0px; font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: baseline;"><tr style="margin: 0px; padding: 0px; border: 0px; font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: baseline;"><th class="groupHead" colspan="2" style="margin: 0px; padding: 6px; border: 0px; font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; line-height: inherit; vertical-align: top; background-color: rgb(242, 242, 242); text-transform: uppercase;">IN THE BOX</th></tr><tr style="margin: 0px; padding: 0px; border: 0px; font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: baseline;"><td class="specsKey" style="margin: 0px; padding: 6px; border-width: 0px 1px 1px 0px; border-right-style: solid; border-bottom-style: dotted; border-right-color: rgb(201, 201, 201); border-bottom-color: rgb(201, 201, 201); font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: top; width: 169.8295440673828px;">Sales Package</td><td class="specsValue" style="margin: 0px; padding: 6px; border-width: 0px 0px 1px 1px; border-bottom-style: dotted; border-left-style: solid; border-bottom-color: rgb(201, 201, 201); border-left-color: rgb(201, 201, 201); font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: top;">1 Gerbera Flower</td></tr><tr style="margin: 0px; padding: 0px; border: 0px; font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: baseline;"><td class="specsKey" style="margin: 0px; padding: 6px; border-width: 0px 1px 1px 0px; border-right-style: solid; border-bottom-style: dotted; border-right-color: rgb(201, 201, 201); border-bottom-color: rgb(201, 201, 201); font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: top; width: 169.8295440673828px;">Pack of</td><td class="specsValue" style="margin: 0px; padding: 6px; border-width: 0px 0px 1px 1px; border-bottom-style: dotted; border-left-style: solid; border-bottom-color: rgb(201, 201, 201); border-left-color: rgb(201, 201, 201); font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: top;">1</td></tr></tbody></table><table cellspacing="0" class="specTable" style="margin: 0px 0px 30px; padding: 0px; border: 0px; font-family: arial, tahoma, verdana, sans-serif; font-size: 12.727272033691406px; line-height: 15.363636016845703px; vertical-align: baseline; border-collapse: collapse; border-spacing: 0px; width: 730px; color: rgb(51, 51, 51); background-color: rgb(255, 255, 255);"><tbody style="margin: 0px; padding: 0px; border: 0px; font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: baseline;"><tr style="margin: 0px; padding: 0px; border: 0px; font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: baseline;"><th class="groupHead" colspan="2" style="margin: 0px; padding: 6px; border: 0px; font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; line-height: inherit; vertical-align: top; background-color: rgb(242, 242, 242); text-transform: uppercase;">DIMENSIONS</th></tr><tr style="margin: 0px; padding: 0px; border: 0px; font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: baseline;"><td class="specsKey" style="margin: 0px; padding: 6px; border-width: 0px 1px 1px 0px; border-right-style: solid; border-bottom-style: dotted; border-right-color: rgb(201, 201, 201); border-bottom-color: rgb(201, 201, 201); font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: top; width: 169.8295440673828px;">Total Length</td><td class="specsValue" style="margin: 0px; padding: 6px; border-width: 0px 0px 1px 1px; border-bottom-style: dotted; border-left-style: solid; border-bottom-color: rgb(201, 201, 201); border-left-color: rgb(201, 201, 201); font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: top;">19 inch</td></tr></tbody></table>', '', '', 0, 1, 0, '', '', '', 9, 164, 177, 0, 2, 15, 1, 750, 1000, 250, 25, 0, 0, 0, 0, 0, 1000, 1440425577, 14, 1, 1, '1–3', 3, 0, 0, 1, 1, 'a:1:{i:0;s:4:"18,6";}', 0, 0, 0, 0),
(12, 'Globalite Roadster Boots', 'Globalite-Roadster-Boots', 'NGJ6PyXS', 0, 0, '<table cellspacing="0" class="specTable" style="margin: 0px 0px 30px; padding: 0px; border: 0px; font-family: arial, tahoma, verdana, sans-serif; font-size: 12.727272033691406px; line-height: 15.363636016845703px; vertical-align: baseline; border-collapse: collapse; border-spacing: 0px; width: 730px; color: rgb(51, 51, 51); background-color: rgb(255, 255, 255);"><tbody style="margin: 0px; padding: 0px; border: 0px; font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: baseline;"><tr style="margin: 0px; padding: 0px; border: 0px; font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: baseline;"><th class="groupHead" colspan="2" style="margin: 0px; padding: 6px; border: 0px; font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; line-height: inherit; vertical-align: top; background-color: rgb(242, 242, 242); text-transform: uppercase;">GENERAL</th></tr><tr style="margin: 0px; padding: 0px; border: 0px; font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: baseline;"><td class="specsKey" style="margin: 0px; padding: 6px; border-width: 0px 1px 1px 0px; border-right-style: solid; border-bottom-style: dotted; border-right-color: rgb(201, 201, 201); border-bottom-color: rgb(201, 201, 201); font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: top; width: 169.8295440673828px;">Occasion</td><td class="specsValue" style="margin: 0px; padding: 6px; border-width: 0px 0px 1px 1px; border-bottom-style: dotted; border-left-style: solid; border-bottom-color: rgb(201, 201, 201); border-left-color: rgb(201, 201, 201); font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: top;">Casual</td></tr><tr style="margin: 0px; padding: 0px; border: 0px; font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: baseline;"><td class="specsKey" style="margin: 0px; padding: 6px; border-width: 0px 1px 1px 0px; border-right-style: solid; border-bottom-style: dotted; border-right-color: rgb(201, 201, 201); border-bottom-color: rgb(201, 201, 201); font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: top; width: 169.8295440673828px;">Ideal For</td><td class="specsValue" style="margin: 0px; padding: 6px; border-width: 0px 0px 1px 1px; border-bottom-style: dotted; border-left-style: solid; border-bottom-color: rgb(201, 201, 201); border-left-color: rgb(201, 201, 201); font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: top;">Men</td></tr></tbody></table><table cellspacing="0" class="specTable" style="margin: 0px 0px 30px; padding: 0px; border: 0px; font-family: arial, tahoma, verdana, sans-serif; font-size: 12.727272033691406px; line-height: 15.363636016845703px; vertical-align: baseline; border-collapse: collapse; border-spacing: 0px; width: 730px; color: rgb(51, 51, 51); background-color: rgb(255, 255, 255);"><tbody style="margin: 0px; padding: 0px; border: 0px; font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: baseline;"><tr style="margin: 0px; padding: 0px; border: 0px; font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: baseline;"><th class="groupHead" colspan="2" style="margin: 0px; padding: 6px; border: 0px; font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; line-height: inherit; vertical-align: top; background-color: rgb(242, 242, 242); text-transform: uppercase;">SHOE DETAILS</th></tr><tr style="margin: 0px; padding: 0px; border: 0px; font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: baseline;"><td class="specsKey" style="margin: 0px; padding: 6px; border-width: 0px 1px 1px 0px; border-right-style: solid; border-bottom-style: dotted; border-right-color: rgb(201, 201, 201); border-bottom-color: rgb(201, 201, 201); font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: top; width: 169.8295440673828px;">Tip Shape</td><td class="specsValue" style="margin: 0px; padding: 6px; border-width: 0px 0px 1px 1px; border-bottom-style: dotted; border-left-style: solid; border-bottom-color: rgb(201, 201, 201); border-left-color: rgb(201, 201, 201); font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: top;">Round</td></tr><tr style="margin: 0px; padding: 0px; border: 0px; font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: baseline;"><td class="specsKey" style="margin: 0px; padding: 6px; border-width: 0px 1px 1px 0px; border-right-style: solid; border-bottom-style: dotted; border-right-color: rgb(201, 201, 201); border-bottom-color: rgb(201, 201, 201); font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: top; width: 169.8295440673828px;">Boot Shaft Height</td><td class="specsValue" style="margin: 0px; padding: 6px; border-width: 0px 0px 1px 1px; border-bottom-style: dotted; border-left-style: solid; border-bottom-color: rgb(201, 201, 201); border-left-color: rgb(201, 201, 201); font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: top;">3.7</td></tr><tr style="margin: 0px; padding: 0px; border: 0px; font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: baseline;"><td class="specsKey" style="margin: 0px; padding: 6px; border-width: 0px 1px 1px 0px; border-right-style: solid; border-bottom-style: dotted; border-right-color: rgb(201, 201, 201); border-bottom-color: rgb(201, 201, 201); font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: top; width: 169.8295440673828px;">Closure</td><td class="specsValue" style="margin: 0px; padding: 6px; border-width: 0px 0px 1px 1px; border-bottom-style: dotted; border-left-style: solid; border-bottom-color: rgb(201, 201, 201); border-left-color: rgb(201, 201, 201); font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: top;">Laced</td></tr><tr style="margin: 0px; padding: 0px; border: 0px; font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: baseline;"><td class="specsKey" style="margin: 0px; padding: 6px; border-width: 0px 1px 1px 0px; border-right-style: solid; border-bottom-style: dotted; border-right-color: rgb(201, 201, 201); border-bottom-color: rgb(201, 201, 201); font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: top; width: 169.8295440673828px;">Sole Material</td><td class="specsValue" style="margin: 0px; padding: 6px; border-width: 0px 0px 1px 1px; border-bottom-style: dotted; border-left-style: solid; border-bottom-color: rgb(201, 201, 201); border-left-color: rgb(201, 201, 201); font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: top;">PU</td></tr><tr style="margin: 0px; padding: 0px; border: 0px; font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: baseline;"><td class="specsKey" style="margin: 0px; padding: 6px; border-width: 0px 1px 1px 0px; border-right-style: solid; border-bottom-style: dotted; border-right-color: rgb(201, 201, 201); border-bottom-color: rgb(201, 201, 201); font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: top; width: 169.8295440673828px;">Weight</td><td class="specsValue" style="margin: 0px; padding: 6px; border-width: 0px 0px 1px 1px; border-bottom-style: dotted; border-left-style: solid; border-bottom-color: rgb(201, 201, 201); border-left-color: rgb(201, 201, 201); font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: top;">294 (per single Shoe) - Weight of the product may vary depending on size.</td></tr><tr style="margin: 0px; padding: 0px; border: 0px; font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: baseline;"><td class="specsKey" style="margin: 0px; padding: 6px; border-width: 0px 1px 1px 0px; border-right-style: solid; border-bottom-style: dotted; border-right-color: rgb(201, 201, 201); border-bottom-color: rgb(201, 201, 201); font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: top; width: 169.8295440673828px;">Inner Material</td><td class="specsValue" style="margin: 0px; padding: 6px; border-width: 0px 0px 1px 1px; border-bottom-style: dotted; border-left-style: solid; border-bottom-color: rgb(201, 201, 201); border-left-color: rgb(201, 201, 201); font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: top;">Fabric</td></tr><tr style="margin: 0px; padding: 0px; border: 0px; font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: baseline;"><td class="specsKey" style="margin: 0px; padding: 6px; border-width: 0px 1px 1px 0px; border-right-style: solid; border-bottom-style: dotted; border-right-color: rgb(201, 201, 201); border-bottom-color: rgb(201, 201, 201); font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: top; width: 169.8295440673828px;">Style</td><td class="specsValue" style="margin: 0px; padding: 6px; border-width: 0px 0px 1px 1px; border-bottom-style: dotted; border-left-style: solid; border-bottom-color: rgb(201, 201, 201); border-left-color: rgb(201, 201, 201); font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: top;">Panel and Stitch Detail, Raised Ankle</td></tr><tr style="margin: 0px; padding: 0px; border: 0px; font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: baseline;"><td class="specsKey" style="margin: 0px; padding: 6px; border-width: 0px 1px 1px 0px; border-right-style: solid; border-bottom-style: dotted; border-right-color: rgb(201, 201, 201); border-bottom-color: rgb(201, 201, 201); font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: top; width: 169.8295440673828px;">Outer Material</td><td class="specsValue" style="margin: 0px; padding: 6px; border-width: 0px 0px 1px 1px; border-bottom-style: dotted; border-left-style: solid; border-bottom-color: rgb(201, 201, 201); border-left-color: rgb(201, 201, 201); font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: top;">Leather</td></tr><tr style="margin: 0px; padding: 0px; border: 0px; font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: baseline;"><td class="specsKey" style="margin: 0px; padding: 6px; border-width: 0px 1px 1px 0px; border-right-style: solid; border-bottom-style: dotted; border-right-color: rgb(201, 201, 201); border-bottom-color: rgb(201, 201, 201); font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: top; width: 169.8295440673828px;">Color</td><td class="specsValue" style="margin: 0px; padding: 6px; border-width: 0px 0px 1px 1px; border-bottom-style: dotted; border-left-style: solid; border-bottom-color: rgb(201, 201, 201); border-left-color: rgb(201, 201, 201); font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: top;">Beige<br><br></td></tr></tbody></table>', '', '', 0, 1, 0, '', '', '', 2, 113, 126, 0, 2, 15, 1, 1250, 1500, 250, 16.6667, 0, 0, 0, 0, 0, 1000, 1440425843, 14, 1, 1, '1–3', 1, 0, 0, 1, 1, 'a:1:{i:0;s:4:"16,2";}', 0, 0, 0, 0),
(13, 'The Indian Garage Co. Solid Men''s Straight Kurta', 'The-Indian-Garage-Co.-Solid-Mens-Straight-Kurta', 'lrZugI8c', 0, 0, '<table cellspacing="0" class="specTable" style="margin: 0px 0px 30px; padding: 0px; border: 0px; font-family: arial, tahoma, verdana, sans-serif; font-size: 12.727272033691406px; line-height: 15.363636016845703px; vertical-align: baseline; border-collapse: collapse; border-spacing: 0px; width: 730px; color: rgb(51, 51, 51); background-color: rgb(255, 255, 255);"><tbody style="margin: 0px; padding: 0px; border: 0px; font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: baseline;"><tr style="margin: 0px; padding: 0px; border: 0px; font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: baseline;"><th class="groupHead" colspan="2" style="margin: 0px; padding: 6px; border: 0px; font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; line-height: inherit; vertical-align: top; background-color: rgb(242, 242, 242); text-transform: uppercase;">KURTA DETAILS</th></tr><tr style="margin: 0px; padding: 0px; border: 0px; font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: baseline;"><td class="specsKey" style="margin: 0px; padding: 6px; border-width: 0px 1px 1px 0px; border-right-style: solid; border-bottom-style: dotted; border-right-color: rgb(201, 201, 201); border-bottom-color: rgb(201, 201, 201); font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: top; width: 169.8295440673828px;">Sleeve</td><td class="specsValue" style="margin: 0px; padding: 6px; border-width: 0px 0px 1px 1px; border-bottom-style: dotted; border-left-style: solid; border-bottom-color: rgb(201, 201, 201); border-left-color: rgb(201, 201, 201); font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: top;">Full</td></tr><tr style="margin: 0px; padding: 0px; border: 0px; font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: baseline;"><td class="specsKey" style="margin: 0px; padding: 6px; border-width: 0px 1px 1px 0px; border-right-style: solid; border-bottom-style: dotted; border-right-color: rgb(201, 201, 201); border-bottom-color: rgb(201, 201, 201); font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: top; width: 169.8295440673828px;">Number of Contents in Sales Package</td><td class="specsValue" style="margin: 0px; padding: 6px; border-width: 0px 0px 1px 1px; border-bottom-style: dotted; border-left-style: solid; border-bottom-color: rgb(201, 201, 201); border-left-color: rgb(201, 201, 201); font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: top;">Pack of 1</td></tr><tr style="margin: 0px; padding: 0px; border: 0px; font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: baseline;"><td class="specsKey" style="margin: 0px; padding: 6px; border-width: 0px 1px 1px 0px; border-right-style: solid; border-bottom-style: dotted; border-right-color: rgb(201, 201, 201); border-bottom-color: rgb(201, 201, 201); font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: top; width: 169.8295440673828px;">Fabric</td><td class="specsValue" style="margin: 0px; padding: 6px; border-width: 0px 0px 1px 1px; border-bottom-style: dotted; border-left-style: solid; border-bottom-color: rgb(201, 201, 201); border-left-color: rgb(201, 201, 201); font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: top;">100% Cotton</td></tr><tr style="margin: 0px; padding: 0px; border: 0px; font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: baseline;"><td class="specsKey" style="margin: 0px; padding: 6px; border-width: 0px 1px 1px 0px; border-right-style: solid; border-bottom-style: dotted; border-right-color: rgb(201, 201, 201); border-bottom-color: rgb(201, 201, 201); font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: top; width: 169.8295440673828px;">Type</td><td class="specsValue" style="margin: 0px; padding: 6px; border-width: 0px 0px 1px 1px; border-bottom-style: dotted; border-left-style: solid; border-bottom-color: rgb(201, 201, 201); border-left-color: rgb(201, 201, 201); font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: top;">Straight</td></tr><tr style="margin: 0px; padding: 0px; border: 0px; font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: baseline;"><td class="specsKey" style="margin: 0px; padding: 6px; border-width: 0px 1px 1px 0px; border-right-style: solid; border-bottom-style: dotted; border-right-color: rgb(201, 201, 201); border-bottom-color: rgb(201, 201, 201); font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: top; width: 169.8295440673828px;">Neck</td><td class="specsValue" style="margin: 0px; padding: 6px; border-width: 0px 0px 1px 1px; border-bottom-style: dotted; border-left-style: solid; border-bottom-color: rgb(201, 201, 201); border-left-color: rgb(201, 201, 201); font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: top;">Mandarin Neck</td></tr></tbody></table><table cellspacing="0" class="specTable" style="margin: 0px 0px 30px; padding: 0px; border: 0px; font-family: arial, tahoma, verdana, sans-serif; font-size: 12.727272033691406px; line-height: 15.363636016845703px; vertical-align: baseline; border-collapse: collapse; border-spacing: 0px; width: 730px; color: rgb(51, 51, 51); background-color: rgb(255, 255, 255);"><tbody style="margin: 0px; padding: 0px; border: 0px; font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: baseline;"><tr style="margin: 0px; padding: 0px; border: 0px; font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: baseline;"><th class="groupHead" colspan="2" style="margin: 0px; padding: 6px; border: 0px; font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; line-height: inherit; vertical-align: top; background-color: rgb(242, 242, 242); text-transform: uppercase;">GENERAL DETAILS</th></tr><tr style="margin: 0px; padding: 0px; border: 0px; font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: baseline;"><td class="specsKey" style="margin: 0px; padding: 6px; border-width: 0px 1px 1px 0px; border-right-style: solid; border-bottom-style: dotted; border-right-color: rgb(201, 201, 201); border-bottom-color: rgb(201, 201, 201); font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: top; width: 169.8295440673828px;">Pattern</td><td class="specsValue" style="margin: 0px; padding: 6px; border-width: 0px 0px 1px 1px; border-bottom-style: dotted; border-left-style: solid; border-bottom-color: rgb(201, 201, 201); border-left-color: rgb(201, 201, 201); font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: top;">Solid</td></tr><tr style="margin: 0px; padding: 0px; border: 0px; font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: baseline;"><td class="specsKey" style="margin: 0px; padding: 6px; border-width: 0px 1px 1px 0px; border-right-style: solid; border-bottom-style: dotted; border-right-color: rgb(201, 201, 201); border-bottom-color: rgb(201, 201, 201); font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: top; width: 169.8295440673828px;">Occasion</td><td class="specsValue" style="margin: 0px; padding: 6px; border-width: 0px 0px 1px 1px; border-bottom-style: dotted; border-left-style: solid; border-bottom-color: rgb(201, 201, 201); border-left-color: rgb(201, 201, 201); font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: top;">Casual</td></tr><tr style="margin: 0px; padding: 0px; border: 0px; font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: baseline;"><td class="specsKey" style="margin: 0px; padding: 6px; border-width: 0px 1px 1px 0px; border-right-style: solid; border-bottom-style: dotted; border-right-color: rgb(201, 201, 201); border-bottom-color: rgb(201, 201, 201); font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: top; width: 169.8295440673828px;">Ideal For</td><td class="specsValue" style="margin: 0px; padding: 6px; border-width: 0px 0px 1px 1px; border-bottom-style: dotted; border-left-style: solid; border-bottom-color: rgb(201, 201, 201); border-left-color: rgb(201, 201, 201); font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: top;">Men''s</td></tr></tbody></table><table cellspacing="0" class="specTable" style="margin: 0px 0px 30px; padding: 0px; border: 0px; font-family: arial, tahoma, verdana, sans-serif; font-size: 12.727272033691406px; line-height: 15.363636016845703px; vertical-align: baseline; border-collapse: collapse; border-spacing: 0px; width: 730px; color: rgb(51, 51, 51); background-color: rgb(255, 255, 255);"><tbody style="margin: 0px; padding: 0px; border: 0px; font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: baseline;"><tr style="margin: 0px; padding: 0px; border: 0px; font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: baseline;"><th class="groupHead" colspan="2" style="margin: 0px; padding: 6px; border: 0px; font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; line-height: inherit; vertical-align: top; background-color: rgb(242, 242, 242); text-transform: uppercase;">IN THE BOX</th></tr><tr style="margin: 0px; padding: 0px; border: 0px; font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: baseline;"><td class="specsKey" style="margin: 0px; padding: 6px; border-width: 0px 1px 1px 0px; border-right-style: solid; border-bottom-style: dotted; border-right-color: rgb(201, 201, 201); border-bottom-color: rgb(201, 201, 201); font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: top; width: 169.8295440673828px;"></td><td class="specsValue" style="margin: 0px; padding: 6px; border-width: 0px 0px 1px 1px; border-bottom-style: dotted; border-left-style: solid; border-bottom-color: rgb(201, 201, 201); border-left-color: rgb(201, 201, 201); font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: top;">1 Kurta</td></tr></tbody></table><table cellspacing="0" class="specTable" style="margin: 0px 0px 30px; padding: 0px; border: 0px; font-family: arial, tahoma, verdana, sans-serif; font-size: 12.727272033691406px; line-height: 15.363636016845703px; vertical-align: baseline; border-collapse: collapse; border-spacing: 0px; width: 730px; color: rgb(51, 51, 51); background-color: rgb(255, 255, 255);"><tbody style="margin: 0px; padding: 0px; border: 0px; font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: baseline;"><tr style="margin: 0px; padding: 0px; border: 0px; font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: baseline;"><th class="groupHead" colspan="2" style="margin: 0px; padding: 6px; border: 0px; font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; line-height: inherit; vertical-align: top; background-color: rgb(242, 242, 242); text-transform: uppercase;">ADDITIONAL DETAILS</th></tr><tr style="margin: 0px; padding: 0px; border: 0px; font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: baseline;"><td class="specsKey" style="margin: 0px; padding: 6px; border-width: 0px 1px 1px 0px; border-right-style: solid; border-bottom-style: dotted; border-right-color: rgb(201, 201, 201); border-bottom-color: rgb(201, 201, 201); font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: top; width: 169.8295440673828px;">Style Code</td><td class="specsValue" style="margin: 0px; padding: 6px; border-width: 0px 0px 1px 1px; border-bottom-style: dotted; border-left-style: solid; border-bottom-color: rgb(201, 201, 201); border-left-color: rgb(201, 201, 201); font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: top;">K69L29 OL_B<br><br></td></tr></tbody></table>', '', '', 0, 1, 0, '', '', '', 2, 112, 121, 0, 2, 15, 1, 1000, 1500, 500, 33.3333, 0, 0, 0, 0, 1, 1000, 1440426247, 14, 1, 1, '1–3', 3, 0, 0, 1, 1, 'a:1:{i:0;s:4:"17,4";}', 0, 0, 0, 0);
INSERT INTO `product` (`deal_id`, `deal_title`, `url_title`, `deal_key`, `bulk_discount_buy`, `bulk_discount_get`, `deal_description`, `fineprints`, `highlights`, `color`, `size`, `shipping_amount`, `terms_conditions`, `meta_description`, `meta_keywords`, `category_id`, `sub_category_id`, `sec_category_id`, `third_category_id`, `deal_type`, `merchant_id`, `shop_id`, `deal_value`, `deal_price`, `deal_savings`, `deal_percentage`, `weight`, `height`, `length`, `width`, `purchase_count`, `user_limit_quantity`, `created_date`, `created_by`, `deal_status`, `commission_status`, `delivery_period`, `view_count`, `attribute`, `deal_feature`, `Including_tax`, `shipping`, `product_duration`, `start_date`, `end_date`, `gift_offer`, `product_offer`) VALUES
(14, 'GRJ India Cotton Floral Double Bedsheet', 'GRJ-India-Cotton-Floral-Double-Bedsheet', 'c0LN7QtB', 0, 0, '<div class="keyFeatures specSection" ><h3 class="sectionTitle" >Give a floral or abstract twist to your bedroom decor by adding Magic collection from GRJ INDIA,this season. This set is not only vibrantly appealing, but is also soft to touch and easy to maintain, courtesy its cotton fabric. This collection is the best seller from the entire range of bed sheet from GRJ INDIA. </div></div><div class="ugcFeedbackTooltip-container" data-origin="pd" style="margin: 15px 0px 10px; padding: 0px 0px 5px; border: 0px; font: inherit; vertical-align: baseline; color: rgb(51, 51, 51); font-family: arial, tahoma, verdana, sans-serif; line-height: 16px; text-align: left; background-color: rgb(255, 255, 255); "><div class="rate" style="margin: 0px; padding: 0px; border: 0px; font-size: 13px; font: inherit; vertical-align: baseline; overflow: hidden; "><div class="quest" style="margin: 0px; padding: 0px; border: 0px; font-size: 13px; font: inherit; vertical-align: baseline; float: left; ">Was this product information helpful?</div><div data-item-id="ITMEAF75USPTZ6VG#yes" class="ans positive" style="margin: 0px 0px 0px 10px; padding: 0px; border: 0px; font-size: 13px; font: inherit; vertical-align: baseline; float: left; font-weight: bold; overflow: hidden; "><div class="icon" style="margin: 0px; padding: 0px; border: 0px; font-size: 13px; font: inherit; vertical-align: baseline; background-image: url(http://img5a.flixcart.com/www/prod/images/browse-decide-sprite-d94176bf.png); float: left; width: 13px; height: 14px; background-position: -35px -40px; background-repeat: no-repeat no-repeat; "></div><div class="label" style="margin: 0px; padding: 0px; border: 0px; font-size: 13px; font: inherit; vertical-align: baseline; float: left; ">Yes</div></div><div data-item-id="ITMEAF75USPTZ6VG#no" class="ans negative" style="margin: 0px 0px 0px 10px; padding: 0px; border: 0px; font-size: 13px; font: inherit; vertical-align: baseline; float: left; font-weight: bold; overflow: hidden; "><div class="icon" style="margin: 0px; padding: 0px; border: 0px; font-size: 13px; font: inherit; vertical-align: baseline; background-image: url(http://img5a.flixcart.com/www/prod/images/browse-decide-sprite-d94176bf.png); float: left; width: 13px; height: 14px; background-position: -35px -67px; background-repeat: no-repeat no-repeat; "></div><div class="label" style="margin: 0px; padding: 0px; border: 0px; font-size: 13px; font: inherit; vertical-align: baseline; float: left; ">No</div></div></div></div><div class="rpdSection" style="margin: 0px; padding: 0px; border: 0px; font: inherit; vertical-align: baseline; color: rgb(51, 51, 51); font-family: arial, tahoma, verdana, sans-serif; line-height: 16px; text-align: left; background-color: rgb(255, 255, 255); "></div><div id="reco-module-wrapper" data-paginated="true" data-oos="false" data-hcross="true" data-bundle="true" data-pid="BDSEAF75PYUMVVNJ" data-vcross="false" data-compacc="false" data-samevertical="false" data-samehorizontal="false" data-altsamehorizontal="false" data-session="true" data-recentpurchase="false" data-pageid="pp" style="margin: 0px; padding: 0px; border: 0px; font: inherit; vertical-align: baseline; color: rgb(51, 51, 51); font-family: arial, tahoma, verdana, sans-serif; line-height: 16px; text-align: left; background-color: rgb(255, 255, 255); "></div><div class="hcross-reco" style="margin: 0px; padding: 0px; border: 0px; font: inherit; vertical-align: baseline; position: relative; color: rgb(51, 51, 51); font-family: arial, tahoma, verdana, sans-serif; line-height: 16px; text-align: left; background-color: rgb(255, 255, 255); "></div><div class="productSpecs specSection" style="margin: 0px; padding: 0px 0px 14px; border: 0px; font: inherit; vertical-align: baseline; color: rgb(51, 51, 51); font-family: arial, tahoma, verdana, sans-serif; line-height: 16px; text-align: left; background-color: rgb(255, 255, 255); "><h3 class="sectionTitle" style="margin: 0px; padding: 7px 0px 10px; border-width: 2px 0px 0px; border-top-style: solid; border-top-color: rgb(51, 51, 51); font: inherit; vertical-align: baseline; font-family: Museo, Helvetica, arial, san-serif; ">Specifications of GRJ India Cotton Floral Double Bedsheet (1 Double Bed Sheet With 2 Pillow Covers, Multicolor)</h3><table cellspacing="0" class="specTable" style="margin: 0px 0px 30px; padding: 0px; border: 0px; font-size: 13px; font: inherit; vertical-align: baseline; border-collapse: collapse; border-spacing: 0px; width: 730px; "><tbody style="margin: 0px; padding: 0px; border: 0px; font-size: 13px; font: inherit; vertical-align: baseline; "><tr style="margin: 0px; padding: 0px; border: 0px; font-size: 13px; font: inherit; vertical-align: baseline; "><th class="groupHead" colspan="2" style="margin: 0px; padding: 6px; border: 0px; font: inherit; vertical-align: top; background-color: rgb(242, 242, 242); text-transform: uppercase; ">GENERAL</th></tr><tr style="margin: 0px; padding: 0px; border: 0px; font-size: 13px; font: inherit; vertical-align: baseline; "><td class="specsKey" style="margin: 0px; padding: 6px; border-width: 0px 1px 1px 0px; border-right-style: solid; border-bottom-style: dotted; border-right-color: rgb(201, 201, 201); border-bottom-color: rgb(201, 201, 201); font: inherit; vertical-align: top; width: 170px; ">Brand</td><td class="specsValue" style="margin: 0px; padding: 6px; border-width: 0px 0px 1px 1px; border-bottom-style: dotted; border-left-style: solid; border-bottom-color: rgb(201, 201, 201); border-left-color: rgb(201, 201, 201); font: inherit; vertical-align: top; ">GRJ India</td></tr><tr style="margin: 0px; padding: 0px; border: 0px; font-size: 13px; font: inherit; vertical-align: baseline; "><td class="specsKey" style="margin: 0px; padding: 6px; border-width: 0px 1px 1px 0px; border-right-style: solid; border-bottom-style: dotted; border-right-color: rgb(201, 201, 201); border-bottom-color: rgb(201, 201, 201); font: inherit; vertical-align: top; width: 170px; ">Machine Washable</td><td class="specsValue" style="margin: 0px; padding: 6px; border-width: 0px 0px 1px 1px; border-bottom-style: dotted; border-left-style: solid; border-bottom-color: rgb(201, 201, 201); border-left-color: rgb(201, 201, 201); font: inherit; vertical-align: top; ">Yes</td></tr><tr style="margin: 0px; padding: 0px; border: 0px; font-size: 13px; font: inherit; vertical-align: baseline; "><td class="specsKey" style="margin: 0px; padding: 6px; border-width: 0px 1px 1px 0px; border-right-style: solid; border-bottom-style: dotted; border-right-color: rgb(201, 201, 201); border-bottom-color: rgb(201, 201, 201); font: inherit; vertical-align: top; width: 170px; ">Type</td><td class="specsValue" style="margin: 0px; padding: 6px; border-width: 0px 0px 1px 1px; border-bottom-style: dotted; border-left-style: solid; border-bottom-color: rgb(201, 201, 201); border-left-color: rgb(201, 201, 201); font: inherit; vertical-align: top; ">Flat</td></tr><tr style="margin: 0px; padding: 0px; border: 0px; font-size: 13px; font: inherit; vertical-align: baseline; "><td class="specsKey" style="margin: 0px; padding: 6px; border-width: 0px 1px 1px 0px; border-right-style: solid; border-bottom-style: dotted; border-right-color: rgb(201, 201, 201); border-bottom-color: rgb(201, 201, 201); font: inherit; vertical-align: top; width: 170px; ">Material</td><td class="specsValue" style="margin: 0px; padding: 6px; border-width: 0px 0px 1px 1px; border-bottom-style: dotted; border-left-style: solid; border-bottom-color: rgb(201, 201, 201); border-left-color: rgb(201, 201, 201); font: inherit; vertical-align: top; ">Cotton</td></tr><tr style="margin: 0px; padding: 0px; border: 0px; font-size: 13px; font: inherit; vertical-align: baseline; "><td class="specsKey" style="margin: 0px; padding: 6px; border-width: 0px 1px 1px 0px; border-right-style: solid; border-bottom-style: dotted; border-right-color: rgb(201, 201, 201); border-bottom-color: rgb(201, 201, 201); font: inherit; vertical-align: top; width: 170px; ">Model Name</td><td class="specsValue" style="margin: 0px; padding: 6px; border-width: 0px 0px 1px 1px; border-bottom-style: dotted; border-left-style: solid; border-bottom-color: rgb(201, 201, 201); border-left-color: rgb(201, 201, 201); font: inherit; vertical-align: top; ">Double Bed Sheet</td></tr><tr style="margin: 0px; padding: 0px; border: 0px; font-size: 13px; font: inherit; vertical-align: baseline; "><td class="specsKey" style="margin: 0px; padding: 6px; border-width: 0px 1px 1px 0px; border-right-style: solid; border-bottom-style: dotted; border-right-color: rgb(201, 201, 201); border-bottom-color: rgb(201, 201, 201); font: inherit; vertical-align: top; width: 170px; ">Thread Count</td><td class="specsValue" style="margin: 0px; padding: 6px; border-width: 0px 0px 1px 1px; border-bottom-style: dotted; border-left-style: solid; border-bottom-color: rgb(201, 201, 201); border-left-color: rgb(201, 201, 201); font: inherit; vertical-align: top; ">120</td></tr><tr style="margin: 0px; padding: 0px; border: 0px; font-size: 13px; font: inherit; vertical-align: baseline; "><td class="specsKey" style="margin: 0px; padding: 6px; border-width: 0px 1px 1px 0px; border-right-style: solid; border-bottom-style: dotted; border-right-color: rgb(201, 201, 201); border-bottom-color: rgb(201, 201, 201); font: inherit; vertical-align: top; width: 170px; ">Ideal For</td><td class="specsValue" style="margin: 0px; padding: 6px; border-width: 0px 0px 1px 1px; border-bottom-style: dotted; border-left-style: solid; border-bottom-color: rgb(201, 201, 201); border-left-color: rgb(201, 201, 201); font: inherit; vertical-align: top; ">Men &amp; Women</td></tr><tr style="margin: 0px; padding: 0px; border: 0px; font-size: 13px; font: inherit; vertical-align: baseline; "><td class="specsKey" style="margin: 0px; padding: 6px; border-width: 0px 1px 1px 0px; border-right-style: solid; border-bottom-style: dotted; border-right-color: rgb(201, 201, 201); border-bottom-color: rgb(201, 201, 201); font: inherit; vertical-align: top; width: 170px; ">Model ID</td><td class="specsValue" style="margin: 0px; padding: 6px; border-width: 0px 0px 1px 1px; border-bottom-style: dotted; border-left-style: solid; border-bottom-color: rgb(201, 201, 201); border-left-color: rgb(201, 201, 201); font: inherit; vertical-align: top; ">GRJ-DB-869</td></tr><tr style="margin: 0px; padding: 0px; border: 0px; font-size: 13px; font: inherit; vertical-align: baseline; "><td class="specsKey" style="margin: 0px; padding: 6px; border-width: 0px 1px 1px 0px; border-right-style: solid; border-bottom-style: dotted; border-right-color: rgb(201, 201, 201); border-bottom-color: rgb(201, 201, 201); font: inherit; vertical-align: top; width: 170px; ">Color</td><td class="specsValue" style="margin: 0px; padding: 6px; border-width: 0px 0px 1px 1px; border-bottom-style: dotted; border-left-style: solid; border-bottom-color: rgb(201, 201, 201); border-left-color: rgb(201, 201, 201); font: inherit; vertical-align: top; ">Multicolor</td></tr><tr style="margin: 0px; padding: 0px; border: 0px; font-size: 13px; font: inherit; vertical-align: baseline; "><td class="specsKey" style="margin: 0px; padding: 6px; border-width: 0px 1px 1px 0px; border-right-style: solid; border-bottom-style: dotted; border-right-color: rgb(201, 201, 201); border-bottom-color: rgb(201, 201, 201); font: inherit; vertical-align: top; width: 170px; ">Size</td><td class="specsValue" style="margin: 0px; padding: 6px; border-width: 0px 0px 1px 1px; border-bottom-style: dotted; border-left-style: solid; border-bottom-color: rgb(201, 201, 201); border-left-color: rgb(201, 201, 201); font: inherit; vertical-align: top; ">Double</td></tr><tr style="margin: 0px; padding: 0px; border: 0px; font-size: 13px; font: inherit; vertical-align: baseline; "><td class="specsKey" style="margin: 0px; padding: 6px; border-width: 0px 1px 1px 0px; border-right-style: solid; border-bottom-style: dotted; border-right-color: rgb(201, 201, 201); border-bottom-color: rgb(201, 201, 201); font: inherit; vertical-align: top; width: 170px; ">Fabric Care</td><td class="specsValue" style="margin: 0px; padding: 6px; border-width: 0px 0px 1px 1px; border-bottom-style: dotted; border-left-style: solid; border-bottom-color: rgb(201, 201, 201); border-left-color: rgb(201, 201, 201); font: inherit; vertical-align: top; ">Normal Hand Wash OR Gentle Machine Cycle with Cold Water, Do not Bleach, Do not Tumble Dry, Dry in Shade, Keep Separate from Dark Colors</td></tr></tbody></table></div>', '', '', 0, 1, 0, '', '', '', 6, 97, 104, 0, 2, 15, 1, 1000, 1250, 250, 20, 0, 0, 0, 0, 0, 100, 1440426253, 14, 1, 1, '3 – 5', 2, 0, 0, 1, 1, '', 0, 0, 0, 0),
(15, 'hometown Iris Solid Wood Dining Set', 'hometown-Iris-Solid-Wood-Dining-Set', 'SFrwp5CQ', 0, 0, '<div class="noteSection" ><h3 class="sectionTitle" >Bring home this 6 Seater Dining set with bench in refined brown colour designed by HomeTown.The Set includes a rectangular table with 6 chairs offering a comfortable seating experience.(Disclaimer Size: In order to provide simple dimensions they are rounded of to closest number hence slight variations might occur. the highest, the longest and the widest part of the furniture are considered as the height width &amp; depth Respectively.)</div></div>', '', '', 0, 1, 0, '', '', '', 6, 98, 110, 0, 2, 15, 1, 3800, 3980, 180, 4.52261, 0, 0, 0, 0, 0, 100, 1440426363, 14, 1, 1, '1-3', 2, 0, 0, 1, 1, '', 0, 0, 0, 0),
(16, 'F Gear Axe 29 L Backpack(Black & Blue, Size - 460)', 'F-Gear-Axe-29-L-BackpackBlack-Blue-Size-460', 'AL6Aa9P3', 0, 0, '<table cellspacing="0" class="specTable" style="margin: 0px 0px 30px; padding: 0px; border: 0px; font-family: arial, tahoma, verdana, sans-serif; font-size: 12.727272033691406px; line-height: 15.363636016845703px; vertical-align: baseline; border-collapse: collapse; border-spacing: 0px; width: 730px; color: rgb(51, 51, 51); background-color: rgb(255, 255, 255);"><tbody style="margin: 0px; padding: 0px; border: 0px; font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: baseline;"><tr style="margin: 0px; padding: 0px; border: 0px; font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: baseline;"><th class="groupHead" colspan="2" style="margin: 0px; padding: 6px; border: 0px; font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; line-height: inherit; vertical-align: top; background-color: rgb(242, 242, 242); text-transform: uppercase;">GENERAL</th></tr><tr style="margin: 0px; padding: 0px; border: 0px; font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: baseline;"><td class="specsKey" style="margin: 0px; padding: 6px; border-width: 0px 1px 1px 0px; border-right-style: solid; border-bottom-style: dotted; border-right-color: rgb(201, 201, 201); border-bottom-color: rgb(201, 201, 201); font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: top; width: 169.8295440673828px;">Closure</td><td class="specsValue" style="margin: 0px; padding: 6px; border-width: 0px 0px 1px 1px; border-bottom-style: dotted; border-left-style: solid; border-bottom-color: rgb(201, 201, 201); border-left-color: rgb(201, 201, 201); font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: top;">Zipper</td></tr><tr style="margin: 0px; padding: 0px; border: 0px; font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: baseline;"><td class="specsKey" style="margin: 0px; padding: 6px; border-width: 0px 1px 1px 0px; border-right-style: solid; border-bottom-style: dotted; border-right-color: rgb(201, 201, 201); border-bottom-color: rgb(201, 201, 201); font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: top; width: 169.8295440673828px;">Type</td><td class="specsValue" style="margin: 0px; padding: 6px; border-width: 0px 0px 1px 1px; border-bottom-style: dotted; border-left-style: solid; border-bottom-color: rgb(201, 201, 201); border-left-color: rgb(201, 201, 201); font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: top;">Backpack</td></tr><tr style="margin: 0px; padding: 0px; border: 0px; font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: baseline;"><td class="specsKey" style="margin: 0px; padding: 6px; border-width: 0px 1px 1px 0px; border-right-style: solid; border-bottom-style: dotted; border-right-color: rgb(201, 201, 201); border-bottom-color: rgb(201, 201, 201); font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: top; width: 169.8295440673828px;">Trolley Support</td><td class="specsValue" style="margin: 0px; padding: 6px; border-width: 0px 0px 1px 1px; border-bottom-style: dotted; border-left-style: solid; border-bottom-color: rgb(201, 201, 201); border-left-color: rgb(201, 201, 201); font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: top;">No</td></tr><tr style="margin: 0px; padding: 0px; border: 0px; font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: baseline;"><td class="specsKey" style="margin: 0px; padding: 6px; border-width: 0px 1px 1px 0px; border-right-style: solid; border-bottom-style: dotted; border-right-color: rgb(201, 201, 201); border-bottom-color: rgb(201, 201, 201); font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: top; width: 169.8295440673828px;">Material</td><td class="specsValue" style="margin: 0px; padding: 6px; border-width: 0px 0px 1px 1px; border-bottom-style: dotted; border-left-style: solid; border-bottom-color: rgb(201, 201, 201); border-left-color: rgb(201, 201, 201); font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: top;">Polyester</td></tr><tr style="margin: 0px; padding: 0px; border: 0px; font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: baseline;"><td class="specsKey" style="margin: 0px; padding: 6px; border-width: 0px 1px 1px 0px; border-right-style: solid; border-bottom-style: dotted; border-right-color: rgb(201, 201, 201); border-bottom-color: rgb(201, 201, 201); font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: top; width: 169.8295440673828px;">Laptop Sleeve</td><td class="specsValue" style="margin: 0px; padding: 6px; border-width: 0px 0px 1px 1px; border-bottom-style: dotted; border-left-style: solid; border-bottom-color: rgb(201, 201, 201); border-left-color: rgb(201, 201, 201); font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: top;">No</td></tr><tr style="margin: 0px; padding: 0px; border: 0px; font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: baseline;"><td class="specsKey" style="margin: 0px; padding: 6px; border-width: 0px 1px 1px 0px; border-right-style: solid; border-bottom-style: dotted; border-right-color: rgb(201, 201, 201); border-bottom-color: rgb(201, 201, 201); font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: top; width: 169.8295440673828px;">Style Code</td><td class="specsValue" style="margin: 0px; padding: 6px; border-width: 0px 0px 1px 1px; border-bottom-style: dotted; border-left-style: solid; border-bottom-color: rgb(201, 201, 201); border-left-color: rgb(201, 201, 201); font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: top;">Axe Black Blue</td></tr><tr style="margin: 0px; padding: 0px; border: 0px; font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: baseline;"><td class="specsKey" style="margin: 0px; padding: 6px; border-width: 0px 1px 1px 0px; border-right-style: solid; border-bottom-style: dotted; border-right-color: rgb(201, 201, 201); border-bottom-color: rgb(201, 201, 201); font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: top; width: 169.8295440673828px;">Ideal For</td><td class="specsValue" style="margin: 0px; padding: 6px; border-width: 0px 0px 1px 1px; border-bottom-style: dotted; border-left-style: solid; border-bottom-color: rgb(201, 201, 201); border-left-color: rgb(201, 201, 201); font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: top;">Men, Women</td></tr><tr style="margin: 0px; padding: 0px; border: 0px; font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: baseline;"><td class="specsKey" style="margin: 0px; padding: 6px; border-width: 0px 1px 1px 0px; border-right-style: solid; border-bottom-style: dotted; border-right-color: rgb(201, 201, 201); border-bottom-color: rgb(201, 201, 201); font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: top; width: 169.8295440673828px;">Capacity</td><td class="specsValue" style="margin: 0px; padding: 6px; border-width: 0px 0px 1px 1px; border-bottom-style: dotted; border-left-style: solid; border-bottom-color: rgb(201, 201, 201); border-left-color: rgb(201, 201, 201); font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: top;">29 L</td></tr><tr style="margin: 0px; padding: 0px; border: 0px; font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: baseline;"><td class="specsKey" style="margin: 0px; padding: 6px; border-width: 0px 1px 1px 0px; border-right-style: solid; border-bottom-style: dotted; border-right-color: rgb(201, 201, 201); border-bottom-color: rgb(201, 201, 201); font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: top; width: 169.8295440673828px;">Occasion</td><td class="specsValue" style="margin: 0px; padding: 6px; border-width: 0px 0px 1px 1px; border-bottom-style: dotted; border-left-style: solid; border-bottom-color: rgb(201, 201, 201); border-left-color: rgb(201, 201, 201); font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: top;">Casual</td></tr><tr style="margin: 0px; padding: 0px; border: 0px; font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: baseline;"><td class="specsKey" style="margin: 0px; padding: 6px; border-width: 0px 1px 1px 0px; border-right-style: solid; border-bottom-style: dotted; border-right-color: rgb(201, 201, 201); border-bottom-color: rgb(201, 201, 201); font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: top; width: 169.8295440673828px;">Color Code</td><td class="specsValue" style="margin: 0px; padding: 6px; border-width: 0px 0px 1px 1px; border-bottom-style: dotted; border-left-style: solid; border-bottom-color: rgb(201, 201, 201); border-left-color: rgb(201, 201, 201); font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: top;">Black &amp; Blue</td></tr></tbody></table><table cellspacing="0" class="specTable" style="margin: 0px 0px 30px; padding: 0px; border: 0px; font-family: arial, tahoma, verdana, sans-serif; font-size: 12.727272033691406px; line-height: 15.363636016845703px; vertical-align: baseline; border-collapse: collapse; border-spacing: 0px; width: 730px; color: rgb(51, 51, 51); background-color: rgb(255, 255, 255);"><tbody style="margin: 0px; padding: 0px; border: 0px; font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: baseline;"><tr style="margin: 0px; padding: 0px; border: 0px; font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: baseline;"><th class="groupHead" colspan="2" style="margin: 0px; padding: 6px; border: 0px; font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; line-height: inherit; vertical-align: top; background-color: rgb(242, 242, 242); text-transform: uppercase;">DIMENSIONS</th></tr><tr style="margin: 0px; padding: 0px; border: 0px; font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: baseline;"><td class="specsKey" style="margin: 0px; padding: 6px; border-width: 0px 1px 1px 0px; border-right-style: solid; border-bottom-style: dotted; border-right-color: rgb(201, 201, 201); border-bottom-color: rgb(201, 201, 201); font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: top; width: 169.8295440673828px;">Weight</td><td class="specsValue" style="margin: 0px; padding: 6px; border-width: 0px 0px 1px 1px; border-bottom-style: dotted; border-left-style: solid; border-bottom-color: rgb(201, 201, 201); border-left-color: rgb(201, 201, 201); font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: top;">910 g</td></tr><tr style="margin: 0px; padding: 0px; border: 0px; font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: baseline;"><td class="specsKey" style="margin: 0px; padding: 6px; border-width: 0px 1px 1px 0px; border-right-style: solid; border-bottom-style: dotted; border-right-color: rgb(201, 201, 201); border-bottom-color: rgb(201, 201, 201); font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: top; width: 169.8295440673828px;">Height</td><td class="specsValue" style="margin: 0px; padding: 6px; border-width: 0px 0px 1px 1px; border-bottom-style: dotted; border-left-style: solid; border-bottom-color: rgb(201, 201, 201); border-left-color: rgb(201, 201, 201); font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: top;">460 mm</td></tr><tr style="margin: 0px; padding: 0px; border: 0px; font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: baseline;"><td class="specsKey" style="margin: 0px; padding: 6px; border-width: 0px 1px 1px 0px; border-right-style: solid; border-bottom-style: dotted; border-right-color: rgb(201, 201, 201); border-bottom-color: rgb(201, 201, 201); font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: top; width: 169.8295440673828px;">Width</td><td class="specsValue" style="margin: 0px; padding: 6px; border-width: 0px 0px 1px 1px; border-bottom-style: dotted; border-left-style: solid; border-bottom-color: rgb(201, 201, 201); border-left-color: rgb(201, 201, 201); font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: top;">320 mm</td></tr><tr style="margin: 0px; padding: 0px; border: 0px; font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: baseline;"><td class="specsKey" style="margin: 0px; padding: 6px; border-width: 0px 1px 1px 0px; border-right-style: solid; border-bottom-style: dotted; border-right-color: rgb(201, 201, 201); border-bottom-color: rgb(201, 201, 201); font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: top; width: 169.8295440673828px;">Depth</td><td class="specsValue" style="margin: 0px; padding: 6px; border-width: 0px 0px 1px 1px; border-bottom-style: dotted; border-left-style: solid; border-bottom-color: rgb(201, 201, 201); border-left-color: rgb(201, 201, 201); font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: top;">200 mm</td></tr></tbody></table><table cellspacing="0" class="specTable" style="margin: 0px 0px 30px; padding: 0px; border: 0px; font-family: arial, tahoma, verdana, sans-serif; font-size: 12.727272033691406px; line-height: 15.363636016845703px; vertical-align: baseline; border-collapse: collapse; border-spacing: 0px; width: 730px; color: rgb(51, 51, 51); background-color: rgb(255, 255, 255);"><tbody style="margin: 0px; padding: 0px; border: 0px; font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: baseline;"><tr style="margin: 0px; padding: 0px; border: 0px; font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: baseline;"><th class="groupHead" colspan="2" style="margin: 0px; padding: 6px; border: 0px; font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; line-height: inherit; vertical-align: top; background-color: rgb(242, 242, 242); text-transform: uppercase;">WARRANTY</th></tr><tr style="margin: 0px; padding: 0px; border: 0px; font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: baseline;"><td class="specsKey" style="margin: 0px; padding: 6px; border-width: 0px 1px 1px 0px; border-right-style: solid; border-bottom-style: dotted; border-right-color: rgb(201, 201, 201); border-bottom-color: rgb(201, 201, 201); font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: top; width: 169.8295440673828px;"></td><td class="specsValue" style="margin: 0px; padding: 6px; border-width: 0px 0px 1px 1px; border-bottom-style: dotted; border-left-style: solid; border-bottom-color: rgb(201, 201, 201); border-left-color: rgb(201, 201, 201); font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: top;">12 Months Warranty<br><br></td></tr></tbody></table>', '', '', 0, 1, 0, '', '', '', 2, 116, 117, 0, 2, 17, 2, 888, 1000, 112, 11.2, 0, 0, 0, 0, 1, 1000, 1440426755, 14, 1, 1, '1-3', 3, 0, 0, 1, 1, '', 0, 0, 0, 0),
(17, 'Zaveri Pearls Golden Boutique Necklace Alloy Jewel Set(Pink, White, Blue)', 'Zaveri-Pearls-Golden-Boutique-Necklace-Alloy-Jewel-SetPink-White-Blue', 'GRmcQ7wI', 0, 0, '<table cellspacing="0" class="specTable" style="margin: 0px 0px 30px; padding: 0px; border: 0px; font-family: arial, tahoma, verdana, sans-serif; font-size: 12.727272033691406px; line-height: 15.363636016845703px; vertical-align: baseline; border-collapse: collapse; border-spacing: 0px; width: 730px; color: rgb(51, 51, 51); background-color: rgb(255, 255, 255);"><tbody style="margin: 0px; padding: 0px; border: 0px; font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: baseline;"><tr style="margin: 0px; padding: 0px; border: 0px; font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: baseline;"><th class="groupHead" colspan="2" style="margin: 0px; padding: 6px; border: 0px; font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; line-height: inherit; vertical-align: top; background-color: rgb(242, 242, 242); text-transform: uppercase;">GENERAL</th></tr><tr style="margin: 0px; padding: 0px; border: 0px; font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: baseline;"><td class="specsKey" style="margin: 0px; padding: 6px; border-width: 0px 1px 1px 0px; border-right-style: solid; border-bottom-style: dotted; border-right-color: rgb(201, 201, 201); border-bottom-color: rgb(201, 201, 201); font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: top; width: 169.8295440673828px;">Base Material</td><td class="specsValue" style="margin: 0px; padding: 6px; border-width: 0px 0px 1px 1px; border-bottom-style: dotted; border-left-style: solid; border-bottom-color: rgb(201, 201, 201); border-left-color: rgb(201, 201, 201); font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: top;">Alloy</td></tr><tr style="margin: 0px; padding: 0px; border: 0px; font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: baseline;"><td class="specsKey" style="margin: 0px; padding: 6px; border-width: 0px 1px 1px 0px; border-right-style: solid; border-bottom-style: dotted; border-right-color: rgb(201, 201, 201); border-bottom-color: rgb(201, 201, 201); font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: top; width: 169.8295440673828px;">Brand</td><td class="specsValue" style="margin: 0px; padding: 6px; border-width: 0px 0px 1px 1px; border-bottom-style: dotted; border-left-style: solid; border-bottom-color: rgb(201, 201, 201); border-left-color: rgb(201, 201, 201); font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: top;">Zaveri Pearls</td></tr><tr style="margin: 0px; padding: 0px; border: 0px; font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: baseline;"><td class="specsKey" style="margin: 0px; padding: 6px; border-width: 0px 1px 1px 0px; border-right-style: solid; border-bottom-style: dotted; border-right-color: rgb(201, 201, 201); border-bottom-color: rgb(201, 201, 201); font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: top; width: 169.8295440673828px;">Model Number</td><td class="specsValue" style="margin: 0px; padding: 6px; border-width: 0px 0px 1px 1px; border-bottom-style: dotted; border-left-style: solid; border-bottom-color: rgb(201, 201, 201); border-left-color: rgb(201, 201, 201); font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: top;">ZPFK2044</td></tr><tr style="margin: 0px; padding: 0px; border: 0px; font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: baseline;"><td class="specsKey" style="margin: 0px; padding: 6px; border-width: 0px 1px 1px 0px; border-right-style: solid; border-bottom-style: dotted; border-right-color: rgb(201, 201, 201); border-bottom-color: rgb(201, 201, 201); font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: top; width: 169.8295440673828px;">Precious/Artificial Jewellery</td><td class="specsValue" style="margin: 0px; padding: 6px; border-width: 0px 0px 1px 1px; border-bottom-style: dotted; border-left-style: solid; border-bottom-color: rgb(201, 201, 201); border-left-color: rgb(201, 201, 201); font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: top;">Fashion Jewellery</td></tr><tr style="margin: 0px; padding: 0px; border: 0px; font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: baseline;"><td class="specsKey" style="margin: 0px; padding: 6px; border-width: 0px 1px 1px 0px; border-right-style: solid; border-bottom-style: dotted; border-right-color: rgb(201, 201, 201); border-bottom-color: rgb(201, 201, 201); font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: top; width: 169.8295440673828px;">Type</td><td class="specsValue" style="margin: 0px; padding: 6px; border-width: 0px 0px 1px 1px; border-bottom-style: dotted; border-left-style: solid; border-bottom-color: rgb(201, 201, 201); border-left-color: rgb(201, 201, 201); font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: top;">Earring &amp; Necklace Set</td></tr><tr style="margin: 0px; padding: 0px; border: 0px; font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: baseline;"><td class="specsKey" style="margin: 0px; padding: 6px; border-width: 0px 1px 1px 0px; border-right-style: solid; border-bottom-style: dotted; border-right-color: rgb(201, 201, 201); border-bottom-color: rgb(201, 201, 201); font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: top; width: 169.8295440673828px;">Model Name</td><td class="specsValue" style="margin: 0px; padding: 6px; border-width: 0px 0px 1px 1px; border-bottom-style: dotted; border-left-style: solid; border-bottom-color: rgb(201, 201, 201); border-left-color: rgb(201, 201, 201); font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: top;">Golden Boutique Necklace</td></tr><tr style="margin: 0px; padding: 0px; border: 0px; font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: baseline;"><td class="specsKey" style="margin: 0px; padding: 6px; border-width: 0px 1px 1px 0px; border-right-style: solid; border-bottom-style: dotted; border-right-color: rgb(201, 201, 201); border-bottom-color: rgb(201, 201, 201); font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: top; width: 169.8295440673828px;">Ideal For</td><td class="specsValue" style="margin: 0px; padding: 6px; border-width: 0px 0px 1px 1px; border-bottom-style: dotted; border-left-style: solid; border-bottom-color: rgb(201, 201, 201); border-left-color: rgb(201, 201, 201); font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: top;">Girls, Women</td></tr><tr style="margin: 0px; padding: 0px; border: 0px; font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: baseline;"><td class="specsKey" style="margin: 0px; padding: 6px; border-width: 0px 1px 1px 0px; border-right-style: solid; border-bottom-style: dotted; border-right-color: rgb(201, 201, 201); border-bottom-color: rgb(201, 201, 201); font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: top; width: 169.8295440673828px;">Occasion</td><td class="specsValue" style="margin: 0px; padding: 6px; border-width: 0px 0px 1px 1px; border-bottom-style: dotted; border-left-style: solid; border-bottom-color: rgb(201, 201, 201); border-left-color: rgb(201, 201, 201); font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: top;">Wedding &amp; Engagement</td></tr><tr style="margin: 0px; padding: 0px; border: 0px; font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: baseline;"><td class="specsKey" style="margin: 0px; padding: 6px; border-width: 0px 1px 1px 0px; border-right-style: solid; border-bottom-style: dotted; border-right-color: rgb(201, 201, 201); border-bottom-color: rgb(201, 201, 201); font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: top; width: 169.8295440673828px;">Color</td><td class="specsValue" style="margin: 0px; padding: 6px; border-width: 0px 0px 1px 1px; border-bottom-style: dotted; border-left-style: solid; border-bottom-color: rgb(201, 201, 201); border-left-color: rgb(201, 201, 201); font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; line-height: inherit; vertical-align: top;">Pink, White, Blue<br><br></td></tr></tbody></table>', '', '', 0, 1, 0, '', '', '', 3, 191, 192, 0, 2, 15, 1, 1500, 2000, 500, 25, 0, 0, 0, 0, 0, 100, 1440426934, 14, 1, 1, '1-3', 3, 0, 0, 1, 1, '', 0, 0, 0, 0),
(18, 'test fashion product', 'test-fashion-product', 'PIH3lOyb', 2, 1, '<font face="Arial, Verdana" size="2">test fashion product test fashion product test fashion product test fashion product test fashion product </font>', '', '', 0, 1, 0, '', 'test fashion product test fashion product test fashion product test fashion product test fashion product test fashion product test fashion product test fashion product test fashion product test fashion product test fashion product ', 'test fashion product test fashion product test fashion product test fashion product ', 4, 10, 18, 0, 2, 17, 2, 5, 10, 5, 50, 0, 0, 0, 0, 5, 100, 1440484612, 17, 1, 1, '1-2', 5, 0, 0, 1, 1, 'a:1:{i:0;s:4:"19,8";}', 0, 1444847400, 0, 1),
(19, 'test shirts', 'test-shirts', '1u3NSADy', 17, 18, 'asdsdas', '', '', 0, 1, 0, '', '', '', 5, 34, 47, 0, 2, 17, 2, 150, 160, 10, 6.25, 0, 0, 0, 0, 0, 1, 1440840414, 17, 1, 1, '1-2', 0, 0, 0, 1, 1, '', 1440786600, 1448562600, 0, 1),
(20, 'test add product', 'test-add-product', 'i90IFkVF', 0, 0, 'ttest add producttest add producttest add producttest add producttest add product', '', '', 0, 1, 0, '', '', '', 4, 10, 18, 0, 2, 15, 1, 10, 15, 5, 33.3333, 0, 0, 0, 0, 0, 1, 1440842965, 14, 1, 1, '1-5', 1, 0, 0, 1, 1, 'a:1:{i:0;s:4:"16,2";}', 0, 0, 0, 0),
(21, 'test add products ', 'test-add-products', '6ZTqQYhc', 0, 0, 'test add products <br>', '', '', 0, 1, 0, '', '', '', 4, 10, 18, 0, 2, 17, 2, 250, 502, 252, 50.1992, 0, 0, 0, 0, 0, 1, 1440843351, 14, 1, 1, '3-5', 1, 0, 0, 1, 1, 'a:1:{i:0;s:4:"19,8";}', 0, 0, 0, 0),
(22, 'test sports', 'test-sports', 'Z0XtdyNC', 0, 0, 'test sportstest sportstest sportstest sportstest sportstest sportstest sportstest sportstest sportstest sportstest sportstest sports', '', '', 0, 1, 0, '', '', '', 7, 140, 145, 0, 2, 17, 2, 2, 4, 2, 50, 0, 0, 0, 0, 0, 1, 1440843541, 14, 2, 1, '1-2', 0, 0, 0, 1, 1, 'a:1:{i:0;s:4:"19,8";}', 0, 0, 0, 0),
(23, 'test test sports', 'test-test-sports', 'yEd3F8e1', 0, 0, 'test sportstest sportstest sportstest sportstest sportstest sportstest sportstest sportstest sportstest sportstest sportstest sportstest sportstest sportstest sportstest sportstest sports', '', '', 0, 1, 0, '', '', '', 7, 140, 145, 0, 2, 15, 1, 5, 10, 5, 50, 0, 0, 0, 0, 0, 1, 1440843580, 14, 1, 1, '1-2', 1, 0, 0, 1, 1, 'a:1:{i:0;s:4:"16,2";}', 0, 0, 0, 0),
(24, 'tets sports ', 'tets-sports', 'SQfnks7g', 0, 0, 'tets sports tets sports tets sports tets sports tets sports tets sports tets sports tets sports tets sports tets sports tets sports tets sports tets sports tets sports <br>', '', '', 0, 1, 0, '', '', '', 7, 141, 143, 0, 2, 15, 1, 30, 55, 25, 45.4545, 0, 0, 0, 0, 0, 100, 1440843895, 14, 1, 1, '1-2', 2, 0, 0, 1, 1, 'a:2:{i:0;s:4:"16,2";i:1;s:4:"17,4";}', 0, 0, 0, 0),
(26, 'ggggggtylish Chiffon Floral Bowtie Tunic Tulle Mini Dress New', 'ggggggtylish-Chiffon-Floral-Bowtie-Tunic-Tulle-Mini-Dress-New', 'GCyuhL7m', 0, 0, '<font face="Arial, Verdana" size="2">url::redirect(PATH."admin/add-products.html");url::redirect(PATH."admin/add-products.html");url::redirect(PATH."admin/add-products.html");url::redirect(PATH."admin/add-products.html");url::redirect(PATH."admin/add-products.html");</font>', '', '', 0, 1, 0, '', '', '', 5, 34, 47, 0, 2, 17, 2, 450, 699, 249, 35.6223, 0, 0, 0, 0, 0, 100, 1440998989, 14, 1, 1, '3 – 5', 0, 0, 0, 1, 1, '', 0, 0, 0, 0),
(27, 'aaaaaaaaaaa', 'aaaaaaaaaaa', 'ohMoP0eV', 0, 0, 'asdfasfasdf', '', '', 0, 1, 0, '', '', '', 4, 13, 21, 0, 2, 17, 2, 150, 699, 549, 78.5408, 0, 0, 0, 0, 0, 100, 1440999228, 14, 1, 1, '3 – 5', 0, 0, 0, 1, 1, '', 0, 0, 0, 0),
(28, 'dddddddddddddddddd', 'dddddddddddddddddd', 'uSu7f9w4', 0, 0, '<span style="font-family: ''Times New Roman''; font-size: medium; ">cHJldmlldw==</span><span style="font-family: ''Times New Roman''; font-size: medium; ">cHJldmlldw==</span><span style="font-family: ''Times New Roman''; font-size: medium; ">cHJldmlldw==</span><span style="font-family: ''Times New Roman''; font-size: medium; ">cHJldmlldw==</span><span style="font-family: ''Times New Roman''; font-size: medium; ">cHJldmlldw==</span><span style="font-family: ''Times New Roman''; font-size: medium; ">cHJldmlldw==</span><span style="font-family: ''Times New Roman''; font-size: medium; ">cHJldmlldw==</span><span style="font-family: ''Times New Roman''; font-size: medium; ">cHJldmlldw==</span>', '', '', 0, 1, 0, '', '', '', 5, 34, 47, 0, 2, 17, 2, 450, 699, 249, 35.6223, 0, 0, 0, 0, 2, 100, 1440999286, 14, 1, 1, '3 – 5', 1, 0, 0, 1, 1, '', 0, 0, 0, 0),
(29, 'sdfsdfasdfasfdasdf', 'sdfsdfasdfasfdasdf', 'buva3VDG', 0, 0, '<span style="font-family: ''Times New Roman''; font-size: medium; ">cHJldmlldw==</span><span style="font-family: ''Times New Roman''; font-size: medium; ">cHJldmlldw==</span><span style="font-family: ''Times New Roman''; font-size: medium; ">cHJldmlldw==</span><span style="font-family: ''Times New Roman''; font-size: medium; ">cHJldmlldw==</span><span style="font-family: ''Times New Roman''; font-size: medium; ">cHJldmlldw==</span><span style="font-family: ''Times New Roman''; font-size: medium; ">cHJldmlldw==</span><span style="font-family: ''Times New Roman''; font-size: medium; ">cHJldmlldw==</span><span style="font-family: ''Times New Roman''; font-size: medium; ">cHJldmlldw==</span>', '', '', 0, 1, 0, '', '', '', 5, 34, 47, 0, 2, 17, 2, 100, 699, 599, 85.6938, 0, 0, 0, 0, 0, 100, 1440999341, 14, 1, 1, '3 – 5', 0, 0, 0, 1, 1, '', 0, 0, 0, 0);
INSERT INTO `product` (`deal_id`, `deal_title`, `url_title`, `deal_key`, `bulk_discount_buy`, `bulk_discount_get`, `deal_description`, `fineprints`, `highlights`, `color`, `size`, `shipping_amount`, `terms_conditions`, `meta_description`, `meta_keywords`, `category_id`, `sub_category_id`, `sec_category_id`, `third_category_id`, `deal_type`, `merchant_id`, `shop_id`, `deal_value`, `deal_price`, `deal_savings`, `deal_percentage`, `weight`, `height`, `length`, `width`, `purchase_count`, `user_limit_quantity`, `created_date`, `created_by`, `deal_status`, `commission_status`, `delivery_period`, `view_count`, `attribute`, `deal_feature`, `Including_tax`, `shipping`, `product_duration`, `start_date`, `end_date`, `gift_offer`, `product_offer`) VALUES
(30, 'testssssssssssssssssssss', 'testssssssssssssssssssss', 'Wc6aa2Rd', 3, 2, '<font face="Arial, Verdana"><span style="font-size: 13.3333330154419px;">url::redirect(PATH."merchant/add-products.html");url::redirect(PATH."merchant/add-products.html");url::redirect(PATH."merchant/add-products.html");</span></font>            img.imageResizerActiveClass{cursor:nw-resize !important;outline:1px dashed black !important;}            img.imageResizerChangedClass{z-index:300 !important;max-width:none !important;max-height:none !important;}            img.imageResizerBoxClass{margin:auto; z-index:99999 !important; position:fixed; top:0; left:0; right:0; bottom:0; border:1px solid white; outline:1px solid black;}                    img.imageResizerActiveClass{cursor:nw-resize !important;outline:1px dashed black !important;}            img.imageResizerChangedClass{z-index:300 !important;max-width:none !important;max-height:none !important;}            img.imageResizerBoxClass{margin:auto; z-index:99999 !important; position:fixed; top:0; left:0; right:0; bottom:0; border:1px solid white; outline:1px solid black;}                    img.imageResizerActiveClass{cursor:nw-resize !important;outline:1px dashed black !important;}            img.imageResizerChangedClass{z-index:300 !important;max-width:none !important;max-height:none !important;}            img.imageResizerBoxClass{margin:auto; z-index:99999 !important; position:fixed; top:0; left:0; right:0; bottom:0; border:1px solid white; outline:1px solid black;}                    img.imageResizerActiveClass{cursor:nw-resize !important;outline:1px dashed black !important;}            img.imageResizerChangedClass{z-index:300 !important;max-width:none !important;max-height:none !important;}            img.imageResizerBoxClass{margin:auto; z-index:99999 !important; position:fixed; top:0; left:0; right:0; bottom:0; border:1px solid white; outline:1px solid black;}        ', '', '', 0, 1, 0, '', '', '', 4, 13, 19, 0, 2, 15, 1, 100, 150, 50, 33.3333, 0, 0, 0, 0, 0, 100, 1440999631, 15, 1, 1, '1-5', 1, 0, 0, 1, 1, '', 1440999600, 1446229800, 1, 1),
(31, 'test', 'test', 'lB72XQpx', 0, 0, 'http://192.168.1.236:1031/http://192.168.1.236:1031/http://192.168.1.236:1031/img.imageResizerActiveClass{cursor:nw-resize !important;outline:1px dashed black !important;}            img.imageResizerChangedClass{z-index:300 !important;max-width:none !important;max-height:none !important;}            img.imageResizerBoxClass{margin:auto; z-index:99999 !important; position:fixed; top:0; left:0; right:0; bottom:0; border:1px solid white; outline:1px solid black;}        ', '', '', 0, 1, 0, '', '', '', 4, 10, 18, 0, 2, 15, 1, 90, 100, 10, 10, 0, 0, 0, 0, 0, 100, 1441000822, 15, 2, 1, '2-5', 0, 0, 0, 1, 1, '', 0, 0, 0, 0),
(32, 'tessssssssssss', 'tessssssssssss', 'dX5eHtZQ', 0, 0, '<div class="km" role="chatMessage" style="margin-left: 1em; color: rgb(34, 34, 34); font-family: arial, sans-serif; font-size: 12.727272033691406px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; orphans: 2; text-align: -webkit-auto; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-size-adjust: auto; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255); "><div class="kk" style="margin-bottom: 0.2em; "><span dir="ltr" id=":15g">Anata no onamaehanandesu<wbr>ka</span></div></div><div class="kq" role="chatMessage" style="margin-bottom: 0.2em; color: rgb(119, 119, 119); margin-left: 1em; font-family: arial, sans-serif; font-size: 12.727272033691406px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; orphans: 2; text-align: -webkit-auto; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-size-adjust: auto; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255); "><div class="km" role="chatMessage" style="margin-left: 1em; color: rgb(34, 34, 34); font-family: arial, sans-serif; font-size: 12.727272033691406px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; orphans: 2; text-align: -webkit-auto; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-size-adjust: auto; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255); "><div class="kk" style="margin-bottom: 0.2em; "><span dir="ltr" id=":15g">Anata no onamaehanandesu<wbr>ka</span></div></div><div class="kq" role="chatMessage" style="margin-bottom: 0.2em; color: rgb(119, 119, 119); margin-left: 1em; font-family: arial, sans-serif; font-size: 12.727272033691406px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; orphans: 2; text-align: -webkit-auto; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-size-adjust: auto; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255); "><div class="km" role="chatMessage" style="margin-left: 1em; color: rgb(34, 34, 34); font-family: arial, sans-serif; font-size: 12.727272033691406px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; orphans: 2; text-align: -webkit-auto; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-size-adjust: auto; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255); "><div class="kk" style="margin-bottom: 0.2em; "><span dir="ltr" id=":15g">Anata no onamaehanandesu<wbr>ka</span></div></div><div class="kq" role="chatMessage" style="margin-bottom: 0.2em; color: rgb(119, 119, 119); margin-left: 1em; font-family: arial, sans-serif; font-size: 12.727272033691406px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; orphans: 2; text-align: -webkit-auto; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-size-adjust: auto; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255); "><div class="km" role="chatMessage" style="margin-left: 1em; color: rgb(34, 34, 34); font-family: arial, sans-serif; font-size: 12.727272033691406px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; orphans: 2; text-align: -webkit-auto; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-size-adjust: auto; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255); "><div class="kk" style="margin-bottom: 0.2em; "><span dir="ltr" id=":15g">Anata no onamaehanandesu<wbr>ka</span></div></div><div class="kq" role="chatMessage" style="margin-bottom: 0.2em; color: rgb(119, 119, 119); margin-left: 1em; font-family: arial, sans-serif; font-size: 12.727272033691406px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; orphans: 2; text-align: -webkit-auto; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-size-adjust: auto; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255); "><div class="km" role="chatMessage" style="margin-left: 1em; color: rgb(34, 34, 34); font-family: arial, sans-serif; font-size: 12.727272033691406px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; orphans: 2; text-align: -webkit-auto; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-size-adjust: auto; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255); "><div class="kk" style="margin-bottom: 0.2em; "><span dir="ltr" id=":15g">Anata no onamaehanandesu<wbr>ka</span></div></div><div class="kq" role="chatMessage" style="margin-bottom: 0.2em; color: rgb(119, 119, 119); margin-left: 1em; font-family: arial, sans-serif; font-size: 12.727272033691406px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; orphans: 2; text-align: -webkit-auto; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-size-adjust: auto; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255); "><div class="km" role="chatMessage" style="margin-left: 1em; color: rgb(34, 34, 34); font-family: arial, sans-serif; font-size: 12.727272033691406px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; orphans: 2; text-align: -webkit-auto; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-size-adjust: auto; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255); "><div class="kk" style="margin-bottom: 0.2em; "><span dir="ltr" id=":15g">Anata no onamaehanandesu<wbr>ka</span></div></div><div class="kq" role="chatMessage" style="margin-bottom: 0.2em; color: rgb(119, 119, 119); margin-left: 1em; font-family: arial, sans-serif; font-size: 12.727272033691406px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; orphans: 2; text-align: -webkit-auto; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-size-adjust: auto; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255); "><div class="km" role="chatMessage" style="margin-left: 1em; color: rgb(34, 34, 34); font-family: arial, sans-serif; font-size: 12.727272033691406px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; orphans: 2; text-align: -webkit-auto; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-size-adjust: auto; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255); "><div class="kk" style="margin-bottom: 0.2em; "><span dir="ltr" id=":15g">Anata no onamaehanandesu<wbr>ka</span></div></div><div class="kq" role="chatMessage" style="margin-bottom: 0.2em; color: rgb(119, 119, 119); margin-left: 1em; font-family: arial, sans-serif; font-size: 12.727272033691406px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; orphans: 2; text-align: -webkit-auto; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-size-adjust: auto; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255); "><br class="Apple-interchange-newline"></div></div></div></div></div></div></div>            img.imageResizerActiveClass{cursor:nw-resize !important;outline:1px dashed black !important;}            img.imageResizerChangedClass{z-index:300 !important;max-width:none !important;max-height:none !important;}            img.imageResizerBoxClass{margin:auto; z-index:99999 !important; position:fixed; top:0; left:0; right:0; bottom:0; border:1px solid white; outline:1px solid black;}                    img.imageResizerActiveClass{cursor:nw-resize !important;outline:1px dashed black !important;}            img.imageResizerChangedClass{z-index:300 !important;max-width:none !important;max-height:none !important;}            img.imageResizerBoxClass{margin:auto; z-index:99999 !important; position:fixed; top:0; left:0; right:0; bottom:0; border:1px solid white; outline:1px solid black;}        ', '', '', 0, 1, 0, '', '', '', 3, 58, 66, 0, 2, 15, 1, 90, 100, 10, 10, 0, 0, 0, 0, 0, 100, 1441002655, 15, 1, 1, '2-5', 1, 0, 0, 1, 1, '', 0, 0, 0, 0),
(33, 'tesssssssssssssssssss', 'tesssssssssssssssssss', 'rZ6OhnTp', 0, 0, '<div class="km" role="chatMessage" style="margin-left: 1em; color: rgb(34, 34, 34); font-family: arial, sans-serif; font-size: 12.727272033691406px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; orphans: 2; text-align: -webkit-auto; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-size-adjust: auto; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255); "><div class="kk" style="margin-bottom: 0.2em; "><span dir="ltr" id=":15g">Anata no onamaehanandesu<wbr>ka</span></div></div><div class="kq" role="chatMessage" style="margin-bottom: 0.2em; color: rgb(119, 119, 119); margin-left: 1em; font-family: arial, sans-serif; font-size: 12.727272033691406px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; orphans: 2; text-align: -webkit-auto; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-size-adjust: auto; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255); "><div class="km" role="chatMessage" style="margin-left: 1em; color: rgb(34, 34, 34); font-family: arial, sans-serif; font-size: 12.727272033691406px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; orphans: 2; text-align: -webkit-auto; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-size-adjust: auto; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255); "><div class="kk" style="margin-bottom: 0.2em; "><span dir="ltr" id=":15g">Anata no onamaehanandesu<wbr>ka</span></div></div><div class="kq" role="chatMessage" style="margin-bottom: 0.2em; color: rgb(119, 119, 119); margin-left: 1em; font-family: arial, sans-serif; font-size: 12.727272033691406px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; orphans: 2; text-align: -webkit-auto; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-size-adjust: auto; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255); "><div class="km" role="chatMessage" style="margin-left: 1em; color: rgb(34, 34, 34); font-family: arial, sans-serif; font-size: 12.727272033691406px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; orphans: 2; text-align: -webkit-auto; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-size-adjust: auto; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255); "><div class="kk" style="margin-bottom: 0.2em; "><span dir="ltr" id=":15g">Anata no onamaehanandesu<wbr>ka</span></div></div><div class="kq" role="chatMessage" style="margin-bottom: 0.2em; color: rgb(119, 119, 119); margin-left: 1em; font-family: arial, sans-serif; font-size: 12.727272033691406px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; orphans: 2; text-align: -webkit-auto; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-size-adjust: auto; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255); "><div class="km" role="chatMessage" style="margin-left: 1em; color: rgb(34, 34, 34); font-family: arial, sans-serif; font-size: 12.727272033691406px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; orphans: 2; text-align: -webkit-auto; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-size-adjust: auto; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255); "><div class="kk" style="margin-bottom: 0.2em; "><span dir="ltr" id=":15g">Anata no onamaehanandesu<wbr>ka</span></div></div><div class="kq" role="chatMessage" style="margin-bottom: 0.2em; color: rgb(119, 119, 119); margin-left: 1em; font-family: arial, sans-serif; font-size: 12.727272033691406px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; orphans: 2; text-align: -webkit-auto; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-size-adjust: auto; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255); "><div class="km" role="chatMessage" style="margin-left: 1em; color: rgb(34, 34, 34); font-family: arial, sans-serif; font-size: 12.727272033691406px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; orphans: 2; text-align: -webkit-auto; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-size-adjust: auto; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255); "><div class="kk" style="margin-bottom: 0.2em; "><span dir="ltr" id=":15g">Anata no onamaehanandesu<wbr>ka</span></div></div><div class="kq" role="chatMessage" style="margin-bottom: 0.2em; color: rgb(119, 119, 119); margin-left: 1em; font-family: arial, sans-serif; font-size: 12.727272033691406px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; orphans: 2; text-align: -webkit-auto; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-size-adjust: auto; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255); "><div class="km" role="chatMessage" style="margin-left: 1em; color: rgb(34, 34, 34); font-family: arial, sans-serif; font-size: 12.727272033691406px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; orphans: 2; text-align: -webkit-auto; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-size-adjust: auto; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255); "><div class="kk" style="margin-bottom: 0.2em; "><span dir="ltr" id=":15g">Anata no onamaehanandesu<wbr>ka</span></div></div><div class="kq" role="chatMessage" style="margin-bottom: 0.2em; color: rgb(119, 119, 119); margin-left: 1em; font-family: arial, sans-serif; font-size: 12.727272033691406px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; orphans: 2; text-align: -webkit-auto; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-size-adjust: auto; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255); "><br class="Apple-interchange-newline"></div></div></div></div></div></div>            img.imageResizerActiveClass{cursor:nw-resize !important;outline:1px dashed black !important;}            img.imageResizerChangedClass{z-index:300 !important;max-width:none !important;max-height:none !important;}            img.imageResizerBoxClass{margin:auto; z-index:99999 !important; position:fixed; top:0; left:0; right:0; bottom:0; border:1px solid white; outline:1px solid black;}        ', '', '', 0, 1, 0, '', '', '', 7, 139, 148, 0, 2, 15, 1, 90, 100, 10, 10, 0, 0, 0, 0, 0, 100, 1441002693, 15, 1, 1, '2-5', 0, 0, 0, 1, 1, '', 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `product_attribute`
--

CREATE TABLE IF NOT EXISTS `product_attribute` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `attribute_id` int(11) NOT NULL,
  `text` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- Table structure for table `product_policy`
--

CREATE TABLE IF NOT EXISTS `product_policy` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `text` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=123 ;

--
-- Dumping data for table `product_policy`
--

INSERT INTO `product_policy` (`id`, `product_id`, `text`) VALUES
(78, 2, 'Occasion : Ergonomic'),
(77, 2, 'Brand : Amkette'),
(76, 2, 'Cash on Delivery'),
(54, 3, 'Occasion : Ergonomic'),
(53, 3, 'Connectivity : Wireless'),
(52, 3, 'Brand : Amkette'),
(51, 3, 'Cash on Delivery'),
(75, 2, '1 year manufacturer warranty'),
(56, 4, 'Since we deliver only Freshly baked cakes, they can be delivered only after noon time. '),
(55, 4, 'For Express Delivery products we are unable to commit a specific time of delivery due to seasonal rush. Please read our Disclaimer section for more details. Choose Midnight & Fixed Time delivery options to ensure time specific delivery'),
(50, 3, '1 year manufacturer warranty'),
(73, 1, 'Megapixel : 18.1 MP & Above'),
(59, 5, ''),
(60, 6, ''),
(61, 7, 'FREE SHIPPING ON ALL ORDERS OVER RM 50 GUARANTEED WARRANTY'),
(62, 8, '0'),
(63, 9, ''),
(64, 10, ''),
(65, 11, ''),
(66, 12, ''),
(67, 13, ''),
(68, 14, ''),
(69, 15, ''),
(82, 16, ''),
(71, 17, ''),
(84, 18, ''),
(74, 1, 'Battery : Alkaline'),
(79, 2, 'Connectivity : Wireless'),
(85, 19, ''),
(86, 20, ''),
(87, 21, ''),
(88, 22, ''),
(93, 23, ''),
(96, 24, ''),
(98, 25, 'Cash on Delivery'),
(108, 26, 'Cash on Delivery'),
(103, 27, 'FREE SHIPPING ON ALL ORDERS OVER RM 50 GUARANTEED WARRANTY'),
(105, 28, 'Cash on Delivery'),
(106, 29, 'Cash on Delivery'),
(119, 30, 'test'),
(116, 31, 'asdfa'),
(121, 32, 'asdfa'),
(122, 33, 'asdfa');

-- --------------------------------------------------------

--
-- Table structure for table `product_size`
--

CREATE TABLE IF NOT EXISTS `product_size` (
  `product_size_id` int(11) NOT NULL AUTO_INCREMENT,
  `deal_id` int(11) NOT NULL,
  `size_name` varchar(64) NOT NULL,
  `quantity` int(11) NOT NULL,
  `size_id` int(11) NOT NULL,
  PRIMARY KEY (`product_size_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=79 ;

--
-- Dumping data for table `product_size`
--

INSERT INTO `product_size` (`product_size_id`, `deal_id`, `size_name`, `quantity`, `size_id`) VALUES
(34, 1, 'None', 100, 1),
(35, 2, 'None', 1000, 1),
(12, 3, 'None', 1000, 1),
(13, 4, 'None', 100, 1),
(15, 5, 'XL', 100, 26),
(16, 5, 'm', 100, 20),
(17, 5, 's', 100, 19),
(18, 5, 'XXL', 200, 22),
(19, 5, 'XL', 200, 25),
(20, 6, 's', 100, 19),
(21, 6, 'm', 200, 20),
(22, 7, 'XL', 999, 25),
(23, 8, 's', 1000, 19),
(24, 9, 'm', 998, 20),
(25, 10, 'None', 100, 1),
(26, 11, 'None', 1000, 1),
(27, 12, 'None', 1000, 1),
(28, 13, 'None', 1000, 1),
(29, 14, 'None', 100, 1),
(30, 15, 'None', 100, 1),
(38, 16, 'None', 1000, 1),
(32, 17, 'm', 100, 20),
(40, 18, 'None', 100, 1),
(41, 19, 'None', 1, 1),
(42, 20, 'None', 1, 1),
(43, 21, 'None', 1, 1),
(44, 22, 'None', 1, 1),
(49, 23, 'None', 1, 1),
(52, 24, 'None', 100, 1),
(54, 25, 'm', 100, 20),
(64, 26, 'None', 100, 1),
(59, 27, 'None', 100, 1),
(61, 28, 'None', 100, 1),
(62, 29, 'None', 100, 1),
(75, 30, 'None', 100, 1),
(72, 31, 'None', 100, 1),
(77, 32, 'None', 100, 1),
(78, 33, 'None', 100, 1);

-- --------------------------------------------------------

--
-- Table structure for table `rating`
--

CREATE TABLE IF NOT EXISTS `rating` (
  `rate_id` int(11) NOT NULL AUTO_INCREMENT,
  `rating` double NOT NULL,
  `type_id` int(11) NOT NULL,
  `module_id` int(1) NOT NULL COMMENT '1-deal,2-product,3-auction',
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`rate_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `rating`
--

INSERT INTO `rating` (`rate_id`, `rating`, `type_id`, `module_id`, `user_id`) VALUES
(1, 5, 17, 2, 19),
(2, 5, 4, 1, 19),
(3, 5, 2, 2, 19),
(4, 4, 3, 3, 21),
(5, 5, 4, 3, 21);

-- --------------------------------------------------------

--
-- Table structure for table `request_fund`
--

CREATE TABLE IF NOT EXISTS `request_fund` (
  `request_id` int(11) NOT NULL AUTO_INCREMENT,
  `type` int(1) NOT NULL COMMENT '1-merchant request, 2-affiliate amount request',
  `user_id` int(11) NOT NULL,
  `payment_comments` text COLLATE utf8_unicode_ci NOT NULL,
  `amount` double NOT NULL,
  `date_time` int(10) NOT NULL,
  `request_status` int(1) NOT NULL DEFAULT '1' COMMENT '1-pending, 2-approved, 3-Rejected',
  `payment_status` int(1) NOT NULL DEFAULT '0' COMMENT '1-success, 2-Failure',
  `transaction_date` int(10) NOT NULL,
  `transaction_id` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `error_code` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `error_title` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `error_message` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`request_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `sector`
--

CREATE TABLE IF NOT EXISTS `sector` (
  `sector_id` int(11) NOT NULL AUTO_INCREMENT,
  `sector_name` varchar(64) NOT NULL,
  `categoryid` int(11) NOT NULL,
  `sector_status` int(1) NOT NULL DEFAULT '1',
  `main_sector_id` int(11) NOT NULL,
  `type` int(1) NOT NULL COMMENT '1- Sector 2- Subsector',
  PRIMARY KEY (`sector_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `sector`
--

INSERT INTO `sector` (`sector_id`, `sector_name`, `categoryid`, `sector_status`, `main_sector_id`, `type`) VALUES
(1, 'electronics', 0, 1, 0, 1),
(2, 'electronics3', 0, 1, 1, 2),
(3, 'fashion', 0, 1, 0, 1),
(4, 'fashion3', 0, 1, 3, 2);

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE IF NOT EXISTS `settings` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `site_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `meta_keywords` text COLLATE utf8_unicode_ci NOT NULL,
  `meta_description` text COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `theme` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `default_language` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'english',
  `contact_name` varchar(70) COLLATE utf8_unicode_ci NOT NULL,
  `contact_email` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `webmaster_email` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `noreply_email` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `phone1` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `phone2` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `facebook_page` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `twitter_page` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `linkedin_page` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `instagram_page` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `android_page` varchar(512) COLLATE utf8_unicode_ci NOT NULL,
  `iphone_page` varchar(512) COLLATE utf8_unicode_ci NOT NULL,
  `facebook_fanpage` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `youtube_url` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `analytics_code` text COLLATE utf8_unicode_ci NOT NULL,
  `facebook_app_id` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `facebook_secret_key` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `twitter_api_key` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `twitter_secret_key` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `gmap_api_key` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `instagram_user_name` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `instagram_user_id` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `paypal_payment_mode` int(1) NOT NULL COMMENT ' 0 - test account 1 - live account',
  `paypal_account_id` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `paypal_api_password` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `paypal_api_signature` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `authorizenet_transaction_key` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `authorizenet_api_id` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `min_fund_request` double NOT NULL,
  `max_fund_request` double NOT NULL,
  `deal_commission` int(2) NOT NULL,
  `currency_symbol` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `currency_code` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `country_code` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `referral_amount` float NOT NULL,
  `site_mode` int(1) NOT NULL DEFAULT '1',
  `status` int(1) NOT NULL DEFAULT '1',
  `latitude` varchar(12) COLLATE utf8_unicode_ci NOT NULL,
  `longitude` varchar(12) COLLATE utf8_unicode_ci NOT NULL,
  `email_type` int(1) NOT NULL DEFAULT '1' COMMENT '1-Sendgrid,2-Smtp,3-Mailchimp',
  `flat_shipping` int(5) NOT NULL,
  `tax_percentage` int(3) NOT NULL,
  `auction_extend_day` int(3) NOT NULL,
  `auction_alert_day` int(3) NOT NULL,
  `pay_later` text COLLATE utf8_unicode_ci NOT NULL,
  `monthly_storecredit` int(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `site_name`, `meta_keywords`, `meta_description`, `title`, `theme`, `default_language`, `contact_name`, `contact_email`, `webmaster_email`, `noreply_email`, `phone1`, `phone2`, `facebook_page`, `twitter_page`, `linkedin_page`, `instagram_page`, `android_page`, `iphone_page`, `facebook_fanpage`, `youtube_url`, `analytics_code`, `facebook_app_id`, `facebook_secret_key`, `twitter_api_key`, `twitter_secret_key`, `gmap_api_key`, `instagram_user_name`, `instagram_user_id`, `paypal_payment_mode`, `paypal_account_id`, `paypal_api_password`, `paypal_api_signature`, `authorizenet_transaction_key`, `authorizenet_api_id`, `min_fund_request`, `max_fund_request`, `deal_commission`, `currency_symbol`, `currency_code`, `country_code`, `referral_amount`, `site_mode`, `status`, `latitude`, `longitude`, `email_type`, `flat_shipping`, `tax_percentage`, `auction_extend_day`, `auction_alert_day`, `pay_later`, `monthly_storecredit`) VALUES
(1, 'E-Marketplace', 'deals, daily deals, group deals,', 'sell services using multiple ways like group deals, coupons, and social media.', 'E-Marketplace Best deals and Products ', 'default', 'english', 'Adebola', 'asanni@swifta.com', 'asanni@swifta.com', 'noreply@swifta.com', '+2348135285042', '+2348135285042', 'https://www.facebook.com/pages/Swifta-Systems-and-Services/697969463605870', 'http://twitter.com/SwiftaSystems', 'http://www.linkedin.com/company/269461', 'https://instagram.com/bellanaija', 'https://play.google.com/store/apps/details?id=com.uniecommerce.uninew.ecommerce', 'https://itunes.apple.com/us/app/uniecommercenew/id592052500?ls=1&mt=8', 'https://www.facebook.com/pages/Swifta-Systems-and-Services/697969463605870', 'http://www.youtube.com/watch?v=QhzrdsS5J9w', '<script type="text/javascript">\n  var _gaq = _gaq || [];\n  _gaq.push([''_setAccount'', ''UA-20025738-1'']);\n  _gaq.push([''_trackPageview'']);\n  (function() {\n    var ga = document.createElement(''script''); ga.type = ''text/javascript''; ga.async = true;\n    ga.src = (''https:'' == document.location.protocol ? ''https://ssl'' : ''http://www'') + ''.google-analytics.com/ga.js'';\n    var s = document.getElementsByTagName(''script'')[0]; s.parentNode.insertBefore(ga, s);\n  })();\n</script>           ', '395409947336882', '86b041ad5da9b5ec537a2cbd6ae9ee38', '291719054236926', 'b24927947a1adc1cff504bd4cbb16968', 'b24927947a1adc1cff504bd4cbb16968', 'bellanaija', '1fe23d57a0', 0, 'haripr_1357394973_biz_api1.gmail.com', '1357395004', 'AVn.D2cvC.MsQAvZRc6lx0CJVtKGAIuUArsExV4UM81uJVNdHaQrEddJ', '8J3z97W3zB85qtKe', '5rBy75ZQDAk9', 12, 150, 0, 'N', 'NGN', 'NG', 2000, 1, 1, '6.5243793', '3.3792057000', 2, 5, 0, 7, 2, 'Branch payment: Pay at any bank branch closest to you\n\nMobile payment: Log in to mobile app and select bill payment\n\nInternet banking: Pay from internet banking application; select bill payment', 1000);

-- --------------------------------------------------------

--
-- Table structure for table `shipping_info`
--

CREATE TABLE IF NOT EXISTS `shipping_info` (
  `shipping_id` int(11) NOT NULL AUTO_INCREMENT,
  `shipping_type` int(1) NOT NULL DEFAULT '1' COMMENT '1- product , 2 auction',
  `transaction_id` int(11) NOT NULL,
  `tracking` varchar(128) NOT NULL,
  `user_id` int(11) NOT NULL,
  `adderss1` varchar(256) NOT NULL,
  `address2` varchar(256) NOT NULL,
  `city` int(11) NOT NULL,
  `state` varchar(256) NOT NULL,
  `country` varchar(256) NOT NULL,
  `name` varchar(256) NOT NULL,
  `postal_code` int(10) NOT NULL,
  `phone` varchar(25) NOT NULL,
  `shipping_date` varchar(15) NOT NULL,
  `delivery_status` int(1) NOT NULL DEFAULT '0' COMMENT '0-Pending,1-order packed,2-Shipped to center,3-Out of delivery,4-Delivered,5-Failed',
  PRIMARY KEY (`shipping_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=21 ;

--
-- Dumping data for table `shipping_info`
--

INSERT INTO `shipping_info` (`shipping_id`, `shipping_type`, `transaction_id`, `tracking`, `user_id`, `adderss1`, `address2`, `city`, `state`, `country`, `name`, `postal_code`, `phone`, `shipping_date`, `delivery_status`) VALUES
(1, 1, 1, '', 20, '10 North street', 'Vadavalli', 14, 'TNM', 'Nigeria', 'Esakkidoss', 600001, '09876543210', '1440562218', 0),
(2, 1, 2, '', 20, '10 North street', 'Vadavalli', 14, 'TNM', 'Nigeria', 'Esakkidoss', 600001, '09876543210', '1440562225', 0),
(3, 1, 3, '', 20, '10 North street', 'Vadavalli', 14, 'TNM', 'Nigeria', 'Esakkidoss', 600001, '09876543210', '1440562231', 0),
(4, 1, 4, '', 20, '10 North street', 'Vadavalli', 14, 'TNM', 'Nigeria', 'Esakkidoss', 600001, '09876543210', '1440563645', 0),
(5, 1, 5, '', 20, '10 North street', 'Vadavalli', 14, 'TNM', 'Nigeria', 'Esakkidoss', 600001, '09876543210', '1440563650', 0),
(6, 1, 6, '', 20, '10 North street', 'Vadavalli', 14, 'TNM', 'Nigeria', 'Esakkidoss', 600001, '09876543210', '1440563655', 0),
(7, 1, 7, '', 20, '10 North street', 'Vadavalli', 14, 'TNM', 'Nigeria', 'Esakkidoss', 600001, '09876543210', '1440564101', 0),
(8, 1, 8, '', 20, '10 North street', 'Vadavalli', 14, 'TNM', 'Nigeria', 'Esakkidoss', 600001, '09876543210', '1440564112', 0),
(9, 1, 9, '', 20, '10 North street', 'Vadavalli', 14, 'TNM', 'Nigeria', 'Esakkidoss', 600001, '09876543210', '1440564606', 0),
(10, 1, 10, '', 20, '10 North street', 'Vadavalli', 14, 'TNM', 'Nigeria', 'Esakkidoss', 600001, '09876543210', '1440564613', 0),
(11, 1, 11, '', 20, '10 North street', 'Vadavalli', 14, 'TNM', 'Nigeria', 'Esakkidoss', 600001, '09876543210', '1440565012', 0),
(12, 1, 12, '', 20, '10 North street', 'Vadavalli', 14, 'TNM', 'Nigeria', 'Esakkidoss', 600001, '09876543210', '1440565018', 0),
(13, 1, 13, '', 2, 'Chennai', 'Chennai', 1, 'Tn', 'US', 'Kalaiselvi', 67567567, '56756756765', '1440679769', 0),
(14, 1, 14, '', 2, 'Chennai', 'Chennai', 1, 'Tn', 'US', 'Kalai', 56756756, '7567567567', '1440679947', 0),
(15, 1, 15, '', 20, '10 North street', 'Vadavalli', 14, 'TNM', 'Nigeria', 'Esakkidoss', 600001, '09876543210', '1440680049', 0),
(16, 1, 16, '', 19, 'Test address1', 'Test address2', 14, 'TNn', 'Nigeria', 'Vani', 641004, '919876543210', '1440760902', 0),
(17, 1, 17, '', 21, 'Ds', 'Dssdf', 14, 'Sdfds', 'Nigeria', 'Dsf', 23423, '234234234', '1440761079', 0),
(18, 1, 18, '', 20, '10 North street', 'Vadavalli', 1, 'TNM', 'Nigeria', 'Esakkidoss', 600001, '09876543210', '1440841473', 0),
(19, 1, 19, '', 19, 'Test address1', 'Test address2', 14, 'TNn', 'Nigeria', 'Vani', 641004, '919876543210', '1441003570', 0),
(20, 1, 20, '', 19, 'Test address1', 'Test address2', 14, 'TNn', 'Nigeria', 'Vani', 641004, '919876543210', '1441004626', 0);

-- --------------------------------------------------------

--
-- Table structure for table `shipping_module_settings`
--

CREATE TABLE IF NOT EXISTS `shipping_module_settings` (
  `ship_module_id` int(11) NOT NULL AUTO_INCREMENT,
  `ship_user_id` int(11) NOT NULL,
  `free` int(1) NOT NULL DEFAULT '1',
  `flat` int(1) NOT NULL DEFAULT '1',
  `per_product` int(1) NOT NULL DEFAULT '1',
  `per_quantity` int(1) NOT NULL DEFAULT '1',
  `aramex` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`ship_module_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=71 ;

--
-- Dumping data for table `shipping_module_settings`
--

INSERT INTO `shipping_module_settings` (`ship_module_id`, `ship_user_id`, `free`, `flat`, `per_product`, `per_quantity`, `aramex`) VALUES
(69, 15, 1, 1, 1, 1, 0),
(70, 17, 1, 1, 1, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `size`
--

CREATE TABLE IF NOT EXISTS `size` (
  `size_id` int(11) NOT NULL AUTO_INCREMENT,
  `size_name` varchar(256) NOT NULL,
  PRIMARY KEY (`size_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=27 ;

--
-- Dumping data for table `size`
--

INSERT INTO `size` (`size_id`, `size_name`) VALUES
(10, '77'),
(2, '8'),
(3, '9'),
(4, '10'),
(5, '11'),
(6, '32'),
(8, '46'),
(9, '36'),
(1, 'None'),
(20, 'm'),
(19, 's'),
(17, '50'),
(21, 'l'),
(22, 'XXL'),
(25, 'XL'),
(26, 'XL');

-- --------------------------------------------------------

--
-- Table structure for table `storecredit_shipping_info`
--

CREATE TABLE IF NOT EXISTS `storecredit_shipping_info` (
  `shipping_id` int(11) NOT NULL AUTO_INCREMENT,
  `shipping_type` int(1) NOT NULL DEFAULT '1' COMMENT '1- product , 2 auction',
  `transaction_id` int(11) NOT NULL,
  `tracking` varchar(128) NOT NULL,
  `user_id` int(11) NOT NULL,
  `adderss1` varchar(256) NOT NULL,
  `address2` varchar(256) NOT NULL,
  `city` int(11) NOT NULL,
  `state` varchar(256) NOT NULL,
  `country` varchar(256) NOT NULL,
  `name` varchar(256) NOT NULL,
  `postal_code` int(10) NOT NULL,
  `phone` varchar(25) NOT NULL,
  `shipping_date` varchar(15) NOT NULL,
  `delivery_status` int(1) NOT NULL DEFAULT '0' COMMENT '0-Pending,1-order packed,2-Shipped to center,3-Out of delivery,4-Delivered,5-Failed',
  PRIMARY KEY (`shipping_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=23 ;

--
-- Dumping data for table `storecredit_shipping_info`
--

INSERT INTO `storecredit_shipping_info` (`shipping_id`, `shipping_type`, `transaction_id`, `tracking`, `user_id`, `adderss1`, `address2`, `city`, `state`, `country`, `name`, `postal_code`, `phone`, `shipping_date`, `delivery_status`) VALUES
(21, 1, 21, '', 19, 'Test address1', 'Test address2', 14, 'TNn', '', 'Vani', 641004, '919876543210', '1440769983', 0),
(20, 1, 20, '', 19, 'Test address1', 'Test address2', 14, 'TNn', '', 'Vani', 641004, '919876543210', '1440765971', 0),
(22, 1, 22, '', 20, '10 North street', 'Vadavalli', 14, 'TNM', '', 'Esakkidoss', 600001, '09876543210', '1440840983', 0);

-- --------------------------------------------------------

--
-- Table structure for table `storecredit_transaction`
--

CREATE TABLE IF NOT EXISTS `storecredit_transaction` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `deal_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `auction_id` int(11) NOT NULL,
  `payer_id` varchar(25) NOT NULL,
  `payer_status` varchar(25) NOT NULL,
  `country_code` varchar(15) NOT NULL,
  `currency_code` varchar(10) NOT NULL,
  `transaction_date` int(10) NOT NULL,
  `correlation_id` varchar(50) NOT NULL,
  `acknowledgement` varchar(25) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `transaction_id` varchar(50) NOT NULL,
  `recipt_id` varchar(50) NOT NULL,
  `transaction_type` varchar(25) NOT NULL,
  `payment_type` varchar(25) NOT NULL,
  `order_date` int(10) NOT NULL,
  `amount` double NOT NULL,
  `referral_amount` double NOT NULL,
  `bid_amount` double NOT NULL,
  `shipping_amount` double NOT NULL,
  `shipping_methods` int(1) NOT NULL,
  `tax_amount` float NOT NULL,
  `payment_status` varchar(50) NOT NULL,
  `pending_reason` varchar(100) NOT NULL,
  `reason_code` varchar(50) NOT NULL,
  `paypal_email` varchar(256) NOT NULL,
  `quantity` int(5) NOT NULL,
  `type` int(1) NOT NULL COMMENT '1-CREDITCARD,2-PAYPAL, 3- REFER PAY, 4 - AUTHORIZE.NET , 5 - COD , 6 - Pay Later,7-Interswitch',
  `captured` int(1) NOT NULL COMMENT '0-NO,1-YES',
  `captured_transaction_id` varchar(50) NOT NULL,
  `captured_date` int(10) NOT NULL,
  `captured_correlation_id` varchar(50) NOT NULL,
  `captured_ack` varchar(50) NOT NULL,
  `captured_payment_type` varchar(100) NOT NULL,
  `captured_payment_status` varchar(100) NOT NULL,
  `captured_pending_reason` text NOT NULL,
  `friend_gift_status` int(1) NOT NULL DEFAULT '0',
  `deal_merchant_commission` int(11) NOT NULL,
  `coupon_mail_sent` int(1) NOT NULL DEFAULT '0',
  `product_size` int(11) NOT NULL,
  `product_color` int(11) NOT NULL,
  `aramex_currencycode` varchar(3) NOT NULL,
  `aramex_value` double NOT NULL,
  `ip` varchar(16) NOT NULL,
  `ip_country_code` varchar(3) NOT NULL,
  `ip_country_name` varchar(32) NOT NULL,
  `ip_city_name` varchar(32) NOT NULL,
  `bulk_discount` int(11) NOT NULL,
  `bulk_buy` int(11) NOT NULL,
  `total_discount` int(11) NOT NULL,
  `gift_id` int(11) NOT NULL,
  `store_credit_id` int(11) NOT NULL,
  `store_credit_period` int(11) NOT NULL,
  `prime_customer` int(1) NOT NULL COMMENT '1- prime_customer 0- not a prime customer',
  `file_name` text NOT NULL,
  `main_storecreditid` int(11) NOT NULL,
  `storecredit_amount` double NOT NULL,
  `storecredit_transaction_date` int(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=23 ;

--
-- Dumping data for table `storecredit_transaction`
--

INSERT INTO `storecredit_transaction` (`id`, `user_id`, `deal_id`, `product_id`, `auction_id`, `payer_id`, `payer_status`, `country_code`, `currency_code`, `transaction_date`, `correlation_id`, `acknowledgement`, `firstname`, `lastname`, `transaction_id`, `recipt_id`, `transaction_type`, `payment_type`, `order_date`, `amount`, `referral_amount`, `bid_amount`, `shipping_amount`, `shipping_methods`, `tax_amount`, `payment_status`, `pending_reason`, `reason_code`, `paypal_email`, `quantity`, `type`, `captured`, `captured_transaction_id`, `captured_date`, `captured_correlation_id`, `captured_ack`, `captured_payment_type`, `captured_payment_status`, `captured_pending_reason`, `friend_gift_status`, `deal_merchant_commission`, `coupon_mail_sent`, `product_size`, `product_color`, `aramex_currencycode`, `aramex_value`, `ip`, `ip_country_code`, `ip_country_name`, `ip_city_name`, `bulk_discount`, `bulk_buy`, `total_discount`, `gift_id`, `store_credit_id`, `store_credit_period`, `prime_customer`, `file_name`, `main_storecreditid`, `storecredit_amount`, `storecredit_transaction_date`) VALUES
(21, 19, 0, 13, 0, '', '', 'NG', 'NGN', 1440769983, '', '', 'vani', 'vani', 'pV1EBL2kXxs9O7Xw', '', 'Storecredit', '', 1440769983, 1000, 0, 0, 0, 1, 0, 'Completed', 'None', '', '', 1, 1, 0, '', 0, '', '', '', '', '', 0, 2, 0, 0, 0, '0', 0, '192.168.1.54', 'Oth', 'Other', 'Other', 0, 0, 0, 0, 17, 4, 1, '', 15, 1000, 1441000541),
(20, 19, 0, 18, 0, '', '', 'NG', 'NGN', 1440765971, '', '', 'vani', 'vani', '5rWTwhea3gbgZjkH', '', 'Storecredit', '', 1440765971, 5, 0, 0, 0, 1, 0, 'Pending', 'None', '', '', 1, 1, 0, '', 0, '', '', '', '', '', 0, 1, 0, 0, 0, '0', 0, '192.168.1.54', 'Oth', 'Other', 'Other', 0, 0, 0, 0, 19, 8, 1, '', 20, 2.5, 1440769616),
(22, 20, 0, 18, 0, '', '', 'NG', 'NGN', 1440840983, '', '', 'Esakkidoss', 'Esakkidoss', 'KTm71RMWTtBluyHX', '', 'Storecredit', '', 1440840983, 5, 0, 0, 0, 1, 0, 'Pending', 'None', '', '', 1, 1, 0, '', 0, '', '', '', '', '', 0, 1, 0, 0, 0, '0', 0, '192.168.1.30', 'Oth', 'Other', 'Other', 0, 0, 0, 0, 19, 8, 1, '', 31, 0.625, 1440840983);

-- --------------------------------------------------------

--
-- Table structure for table `storecredit_transaction_mapping`
--

CREATE TABLE IF NOT EXISTS `storecredit_transaction_mapping` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `deal_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `auction_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `transaction_id` varchar(50) NOT NULL,
  `coupon_code` varchar(11) NOT NULL,
  `transaction_date` int(10) NOT NULL,
  `coupon_code_status` int(1) NOT NULL DEFAULT '1',
  `friend_name` varchar(64) NOT NULL,
  `friend_email` varchar(64) NOT NULL,
  `product_size` int(11) NOT NULL,
  `product_color` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=23 ;

--
-- Dumping data for table `storecredit_transaction_mapping`
--

INSERT INTO `storecredit_transaction_mapping` (`id`, `deal_id`, `product_id`, `auction_id`, `user_id`, `transaction_id`, `coupon_code`, `transaction_date`, `coupon_code_status`, `friend_name`, `friend_email`, `product_size`, `product_color`) VALUES
(21, 0, 13, 0, 19, '21', 'vS41wmcK', 1440769983, 1, 'xxxyyy', 'xxxyyy@zzz.com', 0, 0),
(20, 0, 18, 0, 19, '20', 'wA2okwY9', 1440765971, 1, 'xxxyyy', 'xxxyyy@zzz.com', 0, 0),
(22, 0, 18, 0, 20, '22', 'ZWiNri2K', 1440840983, 1, 'xxxyyy', 'xxxyyy@zzz.com', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `stores`
--

CREATE TABLE IF NOT EXISTS `stores` (
  `store_id` int(11) NOT NULL AUTO_INCREMENT,
  `store_name` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `store_url_title` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `store_key` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `address1` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `address2` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `city_id` int(5) NOT NULL,
  `country_id` int(5) NOT NULL,
  `phone_number` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `zipcode` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `website` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `meta_keywords` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `meta_description` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `terms_conditions` text COLLATE utf8_unicode_ci NOT NULL,
  `terms_conditions_status` int(1) NOT NULL,
  `return_policy` text COLLATE utf8_unicode_ci NOT NULL,
  `return_policy_status` int(1) NOT NULL,
  `about_us` text COLLATE utf8_unicode_ci NOT NULL,
  `about_us_status` int(1) NOT NULL,
  `latitude` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `longitude` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `store_type` int(1) NOT NULL COMMENT '1-Main, 2 - Branch',
  `merchant_id` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_date` int(10) NOT NULL,
  `store_status` int(1) NOT NULL DEFAULT '1',
  `warranty` text COLLATE utf8_unicode_ci NOT NULL,
  `warranty_status` int(1) NOT NULL,
  `store_admin_id` int(11) NOT NULL,
  `store_sector_id` int(11) NOT NULL,
  `store_subsector_id` int(11) NOT NULL,
  PRIMARY KEY (`store_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Dumping data for table `stores`
--

INSERT INTO `stores` (`store_id`, `store_name`, `store_url_title`, `store_key`, `address1`, `address2`, `city_id`, `country_id`, `phone_number`, `zipcode`, `website`, `meta_keywords`, `meta_description`, `terms_conditions`, `terms_conditions_status`, `return_policy`, `return_policy_status`, `about_us`, `about_us_status`, `latitude`, `longitude`, `store_type`, `merchant_id`, `created_by`, `created_date`, `store_status`, `warranty`, `warranty_status`, `store_admin_id`, `store_sector_id`, `store_subsector_id`) VALUES
(1, 'ABC Pvt Ltd', 'ABC-Pvt-Ltd', 'i6ZGrjvv', '10 North street', 'vadavalli', 13, 25, '09876543210', '78945', 'http://google.com', '', '', '', 0, '', 0, 'For 30 years, we''ve helped millions of women look as great as they feel. Our chic prints, artisan jackets, and wrinkle-free Travelers collection have built quite a following at our boutiques—but we hear it''s our combination of great style, one-of-a-kind details, and warm, personal service that has captured the hearts of women nationwide.', 0, '8.713912600000002', '77.75665230000004', 1, 15, 14, 1440421593, 1, '', 0, 16, 1, 2),
(2, 'test store', 'test-store', 'mRGur54X', 'test', 'etst', 14, 25, '9876543210', '641004', 'http://www.google.com', '', '', '', 0, '', 0, 'test about us ', 0, '2.1088986592431382', '17.75390625', 1, 17, 14, 1440422010, 1, '', 0, 18, 3, 4);

-- --------------------------------------------------------

--
-- Table structure for table `store_credit_save`
--

CREATE TABLE IF NOT EXISTS `store_credit_save` (
  `storecredit_id` int(11) NOT NULL AUTO_INCREMENT,
  `productid` int(11) NOT NULL,
  `product_value` int(11) NOT NULL,
  `product_quantity` int(11) NOT NULL,
  `sizeid` int(11) NOT NULL,
  `colorid` int(11) NOT NULL,
  `durationid` int(11) NOT NULL,
  `duration_period` int(11) NOT NULL,
  `shipping_method` int(11) NOT NULL,
  `shipping_amount` int(11) NOT NULL,
  `merchantid` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `credit_status` int(1) NOT NULL,
  `installments_paid` int(11) NOT NULL,
  `document_no` varchar(100) NOT NULL,
  PRIMARY KEY (`storecredit_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=38 ;

--
-- Dumping data for table `store_credit_save`
--

INSERT INTO `store_credit_save` (`storecredit_id`, `productid`, `product_value`, `product_quantity`, `sizeid`, `colorid`, `durationid`, `duration_period`, `shipping_method`, `shipping_amount`, `merchantid`, `userid`, `credit_status`, `installments_paid`, `document_no`) VALUES
(19, 18, 5, 1, 0, 0, 19, 8, 1, 0, 17, 19, 2, 0, '19'),
(18, 18, 5, 1, 0, 0, 19, 8, 1, 0, 17, 19, 2, 0, '19'),
(15, 13, 1000, 1, 0, 0, 17, 4, 1, 0, 15, 19, 4, 4, '19'),
(16, 18, 5, 1, 0, 0, 19, 8, 1, 0, 17, 19, 2, 0, '19'),
(20, 18, 5, 1, 0, 0, 19, 8, 1, 0, 17, 19, 4, 3, '19'),
(30, 18, 5, 1, 0, 0, 19, 8, 1, 0, 17, 19, 2, 0, '19'),
(31, 18, 5, 1, 0, 0, 19, 8, 1, 0, 17, 20, 4, 1, '20'),
(32, 11, 750, 1, 0, 0, 18, 6, 1, 0, 15, 20, 1, 0, '20'),
(33, 9, 500, 1, 20, 0, 18, 6, 1, 0, 15, 20, 1, 0, '20'),
(34, 24, 30, 1, 0, 0, 16, 2, 1, 0, 15, 19, 1, 0, '19'),
(35, 18, 5, 1, 0, 0, 19, 8, 1, 0, 17, 19, 1, 0, '19'),
(36, 24, 30, 1, 0, 0, 17, 4, 1, 0, 15, 19, 1, 0, '19'),
(37, 23, 5, 1, 0, 0, 16, 2, 1, 0, 15, 19, 1, 0, '19');

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

CREATE TABLE IF NOT EXISTS `tags` (
  `id` int(15) NOT NULL AUTO_INCREMENT,
  `tags_name` varchar(300) NOT NULL,
  `module_type` int(11) NOT NULL,
  `tags_count` varchar(300) NOT NULL DEFAULT '0',
  `tags_status` int(1) NOT NULL DEFAULT '1' COMMENT '1=>active, 0=>deactive',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

CREATE TABLE IF NOT EXISTS `transaction` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `deal_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `auction_id` int(11) NOT NULL,
  `payer_id` varchar(25) NOT NULL,
  `payer_status` varchar(25) NOT NULL,
  `country_code` varchar(15) NOT NULL,
  `currency_code` varchar(10) NOT NULL,
  `transaction_date` int(10) NOT NULL,
  `correlation_id` varchar(50) NOT NULL,
  `acknowledgement` varchar(25) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `transaction_id` varchar(50) NOT NULL,
  `recipt_id` varchar(50) NOT NULL,
  `transaction_type` varchar(25) NOT NULL,
  `payment_type` varchar(25) NOT NULL,
  `order_date` int(10) NOT NULL,
  `amount` double NOT NULL,
  `referral_amount` double NOT NULL,
  `bid_amount` double NOT NULL,
  `shipping_amount` double NOT NULL,
  `shipping_methods` int(1) NOT NULL,
  `tax_amount` float NOT NULL,
  `payment_status` varchar(50) NOT NULL,
  `pending_reason` varchar(100) NOT NULL,
  `reason_code` varchar(50) NOT NULL,
  `paypal_email` varchar(256) NOT NULL,
  `quantity` int(5) NOT NULL,
  `type` int(1) NOT NULL COMMENT '1-CREDITCARD,2-PAYPAL, 3- REFER PAY, 4 - AUTHORIZE.NET , 5 - COD , 6 - Pay Later,7-Interswitch',
  `captured` int(1) NOT NULL COMMENT '0-NO,1-YES',
  `captured_transaction_id` varchar(50) NOT NULL,
  `captured_date` int(10) NOT NULL,
  `captured_correlation_id` varchar(50) NOT NULL,
  `captured_ack` varchar(50) NOT NULL,
  `captured_payment_type` varchar(100) NOT NULL,
  `captured_payment_status` varchar(100) NOT NULL,
  `captured_pending_reason` text NOT NULL,
  `friend_gift_status` int(1) NOT NULL DEFAULT '0',
  `deal_merchant_commission` int(11) NOT NULL,
  `coupon_mail_sent` int(1) NOT NULL DEFAULT '0',
  `product_size` int(11) NOT NULL,
  `product_color` int(11) NOT NULL,
  `aramex_currencycode` varchar(3) NOT NULL,
  `aramex_value` double NOT NULL,
  `ip` varchar(16) NOT NULL,
  `ip_country_code` varchar(3) NOT NULL,
  `ip_country_name` varchar(32) NOT NULL,
  `ip_city_name` varchar(32) NOT NULL,
  `bulk_discount` int(11) NOT NULL,
  `bulk_buy` int(11) NOT NULL,
  `total_discount` int(11) NOT NULL,
  `gift_id` int(11) NOT NULL,
  `store_credit_id` int(11) NOT NULL,
  `store_credit_period` int(11) NOT NULL,
  `prime_customer` int(1) NOT NULL COMMENT '1- prime_customer 0- not a prime customer',
  `file_name` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=21 ;

--
-- Dumping data for table `transaction`
--

INSERT INTO `transaction` (`id`, `user_id`, `deal_id`, `product_id`, `auction_id`, `payer_id`, `payer_status`, `country_code`, `currency_code`, `transaction_date`, `correlation_id`, `acknowledgement`, `firstname`, `lastname`, `transaction_id`, `recipt_id`, `transaction_type`, `payment_type`, `order_date`, `amount`, `referral_amount`, `bid_amount`, `shipping_amount`, `shipping_methods`, `tax_amount`, `payment_status`, `pending_reason`, `reason_code`, `paypal_email`, `quantity`, `type`, `captured`, `captured_transaction_id`, `captured_date`, `captured_correlation_id`, `captured_ack`, `captured_payment_type`, `captured_payment_status`, `captured_pending_reason`, `friend_gift_status`, `deal_merchant_commission`, `coupon_mail_sent`, `product_size`, `product_color`, `aramex_currencycode`, `aramex_value`, `ip`, `ip_country_code`, `ip_country_name`, `ip_city_name`, `bulk_discount`, `bulk_buy`, `total_discount`, `gift_id`, `store_credit_id`, `store_credit_period`, `prime_customer`, `file_name`) VALUES
(1, 20, 0, 1, 0, '5GJMJR9RXF2A2', 'verified', 'NG', 'NGN', 1440562217, '6647a75c5bff5', 'Success', 'Esakkidoss', 'Esakkidoss', '03922400VL713013B', '', 'expresscheckout', 'Sale', 1440562218, 1800, 0, 0, 0, 1, 0, 'Completed', 'None', 'None', 'hariprasath.s@ndot.in', 1, 2, 0, '', 0, '', '', '', '', '', 0, 2, 0, 0, 0, '0', 0, '192.168.1.236', 'Oth', 'Other', 'Other', 0, 0, 0, 0, 0, 0, 1, ''),
(2, 20, 0, 2, 0, '5GJMJR9RXF2A2', 'verified', 'NG', 'NGN', 1440562217, '6647a75c5bff5', 'Success', 'Esakkidoss', 'Esakkidoss', '03922400VL713013B', '', 'expresscheckout', 'Sale', 1440562225, 160, 0, 0, 0, 1, 0, 'Completed', 'None', 'None', 'hariprasath.s@ndot.in', 1, 2, 0, '', 0, '', '', '', '', '', 0, 2, 0, 0, 0, '0', 0, '192.168.1.236', 'Oth', 'Other', 'Other', 0, 0, 0, 0, 0, 0, 1, ''),
(3, 20, 0, 3, 0, '5GJMJR9RXF2A2', 'verified', 'NG', 'NGN', 1440562217, '6647a75c5bff5', 'Success', 'Esakkidoss', 'Esakkidoss', '03922400VL713013B', '', 'expresscheckout', 'Sale', 1440562231, 160, 0, 0, 0, 1, 0, 'Completed', 'None', 'None', 'hariprasath.s@ndot.in', 1, 2, 0, '', 0, '', '', '', '', '', 0, 2, 0, 0, 0, '0', 0, '192.168.1.236', 'Oth', 'Other', 'Other', 0, 0, 0, 0, 0, 0, 1, ''),
(4, 20, 0, 3, 0, '5GJMJR9RXF2A2', 'verified', 'NG', 'NGN', 1440563643, '28dcbf68623', 'Success', 'Esakkidoss', 'Esakkidoss', '16198988H89090107', '', 'expresscheckout', 'Sale', 1440563645, 160, 0, 0, 0, 1, 0, 'Completed', 'None', 'None', 'hariprasath.s@ndot.in', 1, 2, 0, '', 0, '', '', '', '', '', 0, 2, 0, 0, 0, '0', 0, '192.168.1.236', 'Oth', 'Other', 'Other', 0, 0, 0, 0, 0, 0, 1, ''),
(5, 20, 0, 2, 0, '5GJMJR9RXF2A2', 'verified', 'NG', 'NGN', 1440563643, '28dcbf68623', 'Success', 'Esakkidoss', 'Esakkidoss', '16198988H89090107', '', 'expresscheckout', 'Sale', 1440563650, 160, 0, 0, 0, 1, 0, 'Completed', 'None', 'None', 'hariprasath.s@ndot.in', 1, 2, 0, '', 0, '', '', '', '', '', 0, 2, 0, 0, 0, '0', 0, '192.168.1.236', 'Oth', 'Other', 'Other', 0, 0, 0, 0, 0, 0, 1, ''),
(6, 20, 0, 1, 0, '5GJMJR9RXF2A2', 'verified', 'NG', 'NGN', 1440563643, '28dcbf68623', 'Success', 'Esakkidoss', 'Esakkidoss', '16198988H89090107', '', 'expresscheckout', 'Sale', 1440563655, 1800, 0, 0, 0, 1, 0, 'Completed', 'None', 'None', 'hariprasath.s@ndot.in', 1, 2, 0, '', 0, '', '', '', '', '', 0, 2, 0, 0, 0, '0', 0, '192.168.1.236', 'Oth', 'Other', 'Other', 0, 0, 0, 1, 0, 0, 1, ''),
(7, 20, 0, 1, 0, '5GJMJR9RXF2A2', 'verified', 'NG', 'NGN', 1440564099, '8917fbdf8911e', 'Success', 'Esakkidoss', 'Esakkidoss', '6YS66625M92851024', '', 'expresscheckout', 'Sale', 1440564101, 1800, 0, 0, 0, 1, 0, 'Completed', 'None', 'None', 'hariprasath.s@ndot.in', 1, 2, 0, '', 0, '', '', '', '', '', 0, 2, 0, 0, 0, '0', 0, '192.168.1.236', 'Oth', 'Other', 'Other', 0, 0, 0, 1, 0, 0, 1, ''),
(8, 20, 0, 2, 0, '5GJMJR9RXF2A2', 'verified', 'NG', 'NGN', 1440564099, '8917fbdf8911e', 'Success', 'Esakkidoss', 'Esakkidoss', '6YS66625M92851024', '', 'expresscheckout', 'Sale', 1440564112, 480, 0, 0, 0, 1, 0, 'Completed', 'None', 'None', 'hariprasath.s@ndot.in', 3, 2, 0, '', 0, '', '', '', '', '', 0, 2, 0, 0, 0, '0', 0, '192.168.1.236', 'Oth', 'Other', 'Other', 2, 3, 2, 0, 0, 0, 1, ''),
(9, 20, 0, 2, 0, '5GJMJR9RXF2A2', 'verified', 'NG', 'NGN', 1440564604, 'bbff9950f1338', 'Success', 'Esakkidoss', 'Esakkidoss', '0M023477D75350710', '', 'expresscheckout', 'Sale', 1440564606, 160, 0, 0, 0, 1, 0, 'Completed', 'None', 'None', 'hariprasath.s@ndot.in', 1, 2, 0, '', 0, '', '', '', '', '', 0, 2, 0, 0, 0, '0', 0, '192.168.1.236', 'Oth', 'Other', 'Other', 0, 0, 0, 0, 0, 0, 1, ''),
(10, 20, 0, 1, 0, '5GJMJR9RXF2A2', 'verified', 'NG', 'NGN', 1440564604, 'bbff9950f1338', 'Success', 'Esakkidoss', 'Esakkidoss', '0M023477D75350710', '', 'expresscheckout', 'Sale', 1440564613, 1800, 0, 0, 0, 1, 0, 'Completed', 'None', 'None', 'hariprasath.s@ndot.in', 1, 2, 0, '', 0, '', '', '', '', '', 0, 2, 0, 0, 0, '0', 0, '192.168.1.236', 'Oth', 'Other', 'Other', 0, 0, 0, 1, 0, 0, 1, ''),
(11, 20, 0, 1, 0, '5GJMJR9RXF2A2', 'verified', 'NG', 'NGN', 1440565011, '2844e5bc3e8f', 'Success', 'Esakkidoss', 'Esakkidoss', '8S422210AW6323004', '', 'expresscheckout', 'Sale', 1440565012, 1800, 0, 0, 0, 1, 0, 'Completed', 'None', 'None', 'hariprasath.s@ndot.in', 1, 2, 0, '', 0, '', '', '', '', '', 0, 2, 0, 0, 0, '0', 0, '192.168.1.236', 'Oth', 'Other', 'Other', 0, 0, 0, 1, 0, 0, 1, ''),
(12, 20, 0, 2, 0, '5GJMJR9RXF2A2', 'verified', 'NG', 'NGN', 1440565011, '2844e5bc3e8f', 'Success', 'Esakkidoss', 'Esakkidoss', '8S422210AW6323004', '', 'expresscheckout', 'Sale', 1440565018, 160, 0, 0, 0, 1, 0, 'Completed', 'None', 'None', 'hariprasath.s@ndot.in', 1, 2, 0, '', 0, '', '', '', '', '', 0, 2, 0, 0, 0, '0', 0, '192.168.1.236', 'Oth', 'Other', 'Other', 0, 0, 0, 0, 0, 0, 1, ''),
(13, 2, 0, 18, 0, 'C3BN4ABNQMQPA', 'verified', 'NG', 'NGN', 1440679768, '24b515d8082', 'Success', 'kalai', 'kalai', '0B3646570N0608645', '', 'expresscheckout', 'Sale', 1440679769, 5, 0, 0, 0, 1, 0, 'Completed', 'None', 'None', 'muruga_1343237880_per@gmail.com', 1, 2, 0, '', 0, '', '', '', '', '', 0, 1, 0, 0, 0, '0', 0, '192.168.1.87', 'Oth', 'Other', 'Other', 0, 0, 0, 0, 0, 0, 0, ''),
(14, 2, 0, 2, 0, '', '', 'NG', 'NGN', 1440679947, '', '', 'kalai', 'kalai', 'sWiD3x7oPgrVe6Ew', '', 'Pay Later', '', 1440679947, 160, 0, 0, 0, 1, 0, 'Pending', 'Pay Later', '', '', 1, 6, 0, '', 0, '', '', '', '', '', 0, 2, 0, 0, 0, '0', 0, '192.168.1.87', 'Oth', 'Other', 'Other', 0, 0, 1, 0, 0, 0, 0, ''),
(15, 20, 0, 1, 0, '', '', 'NG', 'NGN', 1440680049, '', '', 'Esakkidoss', 'Esakkidoss', 'q6a0nH8YAf7YLx5R', '', 'Pay Later', '', 1440680049, 1800, 0, 0, 0, 1, 0, 'Pending', 'Pay Later', '', '', 1, 6, 0, '', 0, '', '', '', '', '', 0, 2, 0, 0, 0, '0', 0, '192.168.1.236', 'Oth', 'Other', 'Other', 0, 0, 0, 1, 0, 0, 1, 'MTU=_1.0x0 (1).jpg'),
(16, 19, 0, 7, 0, '', '', 'NG', 'NGN', 1440760902, '', '', 'vani', 'vani', 'LH5kVFRR0HbVy9XC', '', 'Pay Later', '', 1440760902, 29000, 0, 0, 0, 1, 0, 'Pending', 'Pay Later', '', '', 1, 6, 0, '', 0, '', '', '', '', '', 0, 2, 0, 25, 0, '0', 0, '192.168.1.54', 'Oth', 'Other', 'Other', 0, 0, 0, 0, 0, 0, 1, ''),
(17, 21, 0, 16, 0, '', '', 'NG', 'NGN', 1440761079, '', '', 'kalai', 'kalai', 'NZG4K0LrxlVhvgTD', '', 'Pay Later', '', 1440761079, 888, 0, 0, 0, 1, 0, 'Pending', 'Pay Later', '', '', 1, 6, 0, '', 0, '', '', '', '', '', 0, 1, 0, 0, 0, '0', 0, '192.168.1.54', 'Oth', 'Other', 'Other', 0, 0, 0, 0, 0, 0, 0, ''),
(18, 20, 0, 2, 0, '', '', 'NG', 'NGN', 1440841473, '', '', 'Esakkidoss', 'Esakkidoss', 'RnuCWJtPXaQSje6i', '', 'Pay Later', '', 1440841473, 160, 0, 0, 0, 1, 0, 'Pending', 'Pay Later', '', '', 1, 6, 0, '', 0, '', '', '', '', '', 0, 2, 0, 0, 0, '0', 0, '192.168.1.30', 'Oth', 'Other', 'Other', 0, 0, 0, 0, 0, 0, 1, ''),
(19, 19, 0, 28, 0, '', '', 'NG', 'NGN', 1441003570, '', '', 'vani', 'vani', 'azx3cdQdyLRz5ygX', '', 'Pay Later', '', 1441003570, 450, 0, 0, 0, 1, 0, 'Pending', 'Pay Later', '', '', 1, 6, 0, '', 0, '', '', '', '', '', 0, 1, 0, 0, 0, '0', 0, '192.168.1.54', 'Oth', 'Other', 'Other', 0, 0, 0, 0, 0, 0, 1, ''),
(20, 19, 0, 28, 0, '', '', 'NG', 'NGN', 1441004626, '', '', 'vani', 'vani', 'oDpCIBLevFn2A2PV', '', 'Pay Later', '', 1441004626, 450, 0, 0, 0, 1, 0, 'Pending', 'Pay Later', '', '', 1, 6, 0, '', 0, '', '', '', '', '', 0, 1, 0, 0, 0, '0', 0, '192.168.1.54', 'Oth', 'Other', 'Other', 0, 0, 0, 0, 0, 0, 1, '');

-- --------------------------------------------------------

--
-- Table structure for table `transaction_mapping`
--

CREATE TABLE IF NOT EXISTS `transaction_mapping` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `deal_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `auction_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `transaction_id` varchar(50) NOT NULL,
  `coupon_code` varchar(11) NOT NULL,
  `transaction_date` int(10) NOT NULL,
  `coupon_code_status` int(1) NOT NULL DEFAULT '1',
  `friend_name` varchar(64) NOT NULL,
  `friend_email` varchar(64) NOT NULL,
  `product_size` int(11) NOT NULL,
  `product_color` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=23 ;

--
-- Dumping data for table `transaction_mapping`
--

INSERT INTO `transaction_mapping` (`id`, `deal_id`, `product_id`, `auction_id`, `user_id`, `transaction_id`, `coupon_code`, `transaction_date`, `coupon_code_status`, `friend_name`, `friend_email`, `product_size`, `product_color`) VALUES
(1, 0, 1, 0, 20, '1', 'qr6SbihS', 1440562218, 1, 'xxxyyy', 'xxxyyy@zzz.com', 0, 0),
(2, 0, 2, 0, 20, '2', 'L2XjRJKw', 1440562225, 1, 'xxxyyy', 'xxxyyy@zzz.com', 0, 0),
(3, 0, 3, 0, 20, '3', 'gWzu4uaQ', 1440562231, 1, 'xxxyyy', 'xxxyyy@zzz.com', 0, 0),
(4, 0, 3, 0, 20, '4', '7yeqtyIX', 1440563645, 1, 'xxxyyy', 'xxxyyy@zzz.com', 0, 0),
(5, 0, 2, 0, 20, '5', 'hHe9pihh', 1440563650, 1, 'xxxyyy', 'xxxyyy@zzz.com', 0, 0),
(6, 0, 1, 0, 20, '6', 'Oec9XReN', 1440563655, 1, 'xxxyyy', 'xxxyyy@zzz.com', 0, 0),
(7, 0, 1, 0, 20, '7', 'WT0LmLm6', 1440564101, 1, 'xxxyyy', 'xxxyyy@zzz.com', 0, 0),
(8, 0, 2, 0, 20, '8', 'gorBo8t5', 1440564112, 1, 'xxxyyy', 'xxxyyy@zzz.com', 0, 0),
(9, 0, 2, 0, 20, '8', '0Tashdbz', 1440564112, 1, 'xxxyyy', 'xxxyyy@zzz.com', 0, 0),
(10, 0, 2, 0, 20, '8', '2cAFlwRD', 1440564112, 1, 'xxxyyy', 'xxxyyy@zzz.com', 0, 0),
(11, 0, 2, 0, 20, '9', 'VHiQ6u70', 1440564606, 1, 'xxxyyy', 'xxxyyy@zzz.com', 0, 0),
(12, 0, 1, 0, 20, '10', 'uejM8oGQ', 1440564613, 1, 'xxxyyy', 'xxxyyy@zzz.com', 0, 0),
(13, 0, 1, 0, 20, '11', '6BMhNbBf', 1440565012, 1, 'xxxyyy', 'xxxyyy@zzz.com', 0, 0),
(14, 0, 2, 0, 20, '12', 'VPi1hU0K', 1440565018, 1, 'xxxyyy', 'xxxyyy@zzz.com', 0, 0),
(15, 0, 18, 0, 2, '13', 'MOccm6VW', 1440679769, 1, 'xxxyyy', 'xxxyyy@zzz.com', 0, 0),
(16, 0, 2, 0, 2, '14', 'afdozy7W', 1440679947, 1, 'xxxyyy', 'xxxyyy@zzz.com', 0, 0),
(17, 0, 1, 0, 20, '15', 'NU0y3Q9w', 1440680049, 1, 'xxxyyy', 'xxxyyy@zzz.com', 0, 0),
(18, 0, 7, 0, 19, '16', 'l0dxSPL7', 1440760902, 1, 'xxxyyy', 'xxxyyy@zzz.com', 25, 0),
(19, 0, 16, 0, 21, '17', 'IlX0OpdO', 1440761079, 1, 'xxxyyy', 'xxxyyy@zzz.com', 0, 0),
(20, 0, 2, 0, 20, '18', 'rjm2NFhF', 1440841473, 1, 'xxxyyy', 'xxxyyy@zzz.com', 0, 0),
(21, 0, 28, 0, 19, '19', 'hHHzrui5', 1441003570, 1, 'xxxyyy', 'xxxyyy@zzz.com', 0, 0),
(22, 0, 28, 0, 19, '20', 'R1wov5a1', 1441004626, 1, 'xxxyyy', 'xxxyyy@zzz.com', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `lastname` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `gender` int(1) NOT NULL COMMENT '1-male,2-female',
  `age_range` int(1) NOT NULL COMMENT '1->17 and below,2->18-25,3->26-35,4->36-45,5->46-65,6->66 and above',
  `fb_user_id` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `fb_session_key` text COLLATE utf8_unicode_ci NOT NULL,
  `twitter_id` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `twitter_access_token` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `twitter_secret_token` int(100) NOT NULL,
  `address1` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `address2` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `city_id` int(5) NOT NULL DEFAULT '0',
  `country_id` int(5) NOT NULL,
  `phone_number` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `my_favouites` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `payment_account_id` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `user_referral_balance` double NOT NULL,
  `merchant_account_balance` double NOT NULL,
  `merchant_commission` double NOT NULL COMMENT 'merchant commission',
  `referral_id` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `referred_user_id` int(11) NOT NULL,
  `deal_bought_count` int(5) NOT NULL,
  `created_by` int(11) NOT NULL,
  `user_type` int(1) NOT NULL DEFAULT '4' COMMENT '1-Website-Admin, 2-CityAdmin, 3-Merchant, 4-users, 7- Customer care , 8-Merchant moderator , 9 - store admin',
  `user_status` int(1) NOT NULL DEFAULT '1' COMMENT '1-active,0-deactive',
  `login_type` int(1) NOT NULL DEFAULT '1' COMMENT '1-direct, 2-admin, 3-facebook, 4-twitter',
  `joined_date` int(10) NOT NULL,
  `last_login` int(10) NOT NULL,
  `facebook_update` int(1) NOT NULL DEFAULT '0' COMMENT '1-active 0-Dactive',
  `approve_status` int(1) NOT NULL DEFAULT '1' COMMENT '1-approve,0-disapprove',
  `wishlist` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `ship_name` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `ship_address1` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `ship_address2` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `ship_state` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `ship_country` int(11) NOT NULL,
  `ship_city` int(11) NOT NULL,
  `ship_mobileno` varchar(24) COLLATE utf8_unicode_ci NOT NULL,
  `ship_zipcode` bigint(11) NOT NULL,
  `AccountCountryCode` varchar(3) COLLATE utf8_unicode_ci NOT NULL,
  `AccountEntity` varchar(8) COLLATE utf8_unicode_ci NOT NULL,
  `AccountNumber` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `AccountPin` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `UserName` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `ShippingPassword` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `flat_amount` double NOT NULL,
  `unique_identifier` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `user_sector_id` int(11) NOT NULL,
  `user_auto_key` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `user_sub_sector_id` int(11) NOT NULL,
  `merchantid` int(11) NOT NULL,
  `monthly_installment_amt` decimal(10,3) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=25 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `firstname`, `lastname`, `email`, `password`, `gender`, `age_range`, `fb_user_id`, `fb_session_key`, `twitter_id`, `twitter_access_token`, `twitter_secret_token`, `address1`, `address2`, `city_id`, `country_id`, `phone_number`, `my_favouites`, `payment_account_id`, `user_referral_balance`, `merchant_account_balance`, `merchant_commission`, `referral_id`, `referred_user_id`, `deal_bought_count`, `created_by`, `user_type`, `user_status`, `login_type`, `joined_date`, `last_login`, `facebook_update`, `approve_status`, `wishlist`, `ship_name`, `ship_address1`, `ship_address2`, `ship_state`, `ship_country`, `ship_city`, `ship_mobileno`, `ship_zipcode`, `AccountCountryCode`, `AccountEntity`, `AccountNumber`, `AccountPin`, `UserName`, `ShippingPassword`, `flat_amount`, `unique_identifier`, `user_sector_id`, `user_auto_key`, `user_sub_sector_id`, `merchantid`, `monthly_installment_amt`) VALUES
(14, 'Adminn', '', 'admin@ndot.in', '21232f297a57a5a743894a0e4a801fc3', 0, 0, '0', '0', '', '', 0, '42 Boston Street', 'Boston', 1, 3, '+1 (323) 982-894', '', 'admin@ndot.in', 0, 184012, 0, '', 0, 0, 0, 1, 1, 0, 0, 0, 0, 0, '', '', '', '', '', 0, 0, '', 0, 'SA', 'JED', '6004985', '553654', 'eng_ibrahim@hk301.com', 'amih2363439', 0, '', 0, '', 0, 0, '0.000'),
(15, 'Esakkidoss', 'P', 'esakkidoss@ndot.in', '21232f297a57a5a743894a0e4a801fc3', 0, 0, '', '', '', '', 0, '10 North street', 'Vadavalli', 13, 25, '09876543210', '', 'esakkidoss@ndot.in', 0, 10231.2, 2, '', 0, 0, 14, 3, 1, 2, 1440421593, 0, 0, 1, '', '', '', '', '', 0, 0, '', 0, '', '', '', '', '', '', 0, '', 3, '', 4, 0, '0.000'),
(16, 'Githan', '', 'githan89@gmail.com', '21232f297a57a5a743894a0e4a801fc3', 0, 0, '', '', '', '', 0, '10 North street', 'vadavalli', 13, 25, '09876543210', '', '', 0, 0, 0, '', 15, 0, 15, 9, 1, 1, 0, 0, 0, 1, '', '', '', '', '', 0, 0, '', 0, '', '', '', '', '', '', 0, '', 2, '', 0, 0, '0.000'),
(17, 'vinod', 'k', 'vinodbabu.k@ndot.in', '9762738bdf0c20f9e96e1987fc276dfa', 0, 0, '', '', '', '', 0, 'mg colony', 'vadavalli', 14, 25, '9876543210', '', 'vinod_per@gmail.com', 0, 9.9, 1, '', 0, 0, 14, 3, 1, 2, 1440422010, 0, 0, 1, '', '', '', '', '', 0, 0, '', 0, '', '', '', '', '', '', 0, '', 3, '', 4, 0, '0.000'),
(18, 'test', '', 'test21689@gmail.com', '373f21c119cf02805e477262a27fb071', 0, 0, '', '', '', '', 0, 'test', 'etst', 14, 25, '9876543210', '', '', 0, 0, 0, '', 17, 0, 17, 9, 1, 1, 0, 0, 0, 1, '', '', '', '', '', 0, 0, '', 0, '', '', '', '', '', '', 0, '', 4, '', 0, 0, '0.000'),
(19, 'vani', '', 'vani.g@ndot.in', '48561778abeef237a1555492ad8f85f8', 2, 2, '', '', '', '', 0, '', '', 13, 25, '', '', '', 0, 0, 0, 'H2Vtu7YN', 0, 0, 0, 4, 1, 1, 1440423395, 1440423395, 0, 1, 'a:1:{i:0;s:2:"17";}', 'vani', 'test address1', 'test address2', 'TNn', 25, 14, '919876543210', 641004, '', '', '', '', '', '', 0, '12345', 0, '6eTr', 0, 0, '36.875'),
(20, 'Esakkidoss', '', 'esakkidoss89@gmail.com', '03ea35b8ddb76922d3f8e4ea9323ffb5', 1, 3, '', '', '', '', 0, '', '', 14, 25, '', '', '', 0, 0, 0, 'n2O8TuVE', 0, 0, 0, 4, 1, 1, 1440506939, 1440506939, 0, 1, '', 'Esakkidoss', '10 North street', 'Vadavalli', 'TNM', 25, 14, '09876543210', 600001, '', '', '', '', '', '', 0, '09876543210', 0, 'orf8', 0, 0, '208.958'),
(21, 'kalai', '', 'kalaiselvi.m@ndot.in', 'cd72192787202a3264f6c931994350ad', 2, 2, '', '', '', '', 0, '', '', 14, 25, '', '', '', 0, 0, 0, 'oktXUT46', 0, 0, 0, 4, 1, 1, 1440563847, 1440563847, 0, 1, '', '', '', '', '', 0, 0, '', 0, '', '', '', '', '', '', 0, '', 0, '', 0, 0, '0.000'),
(22, 'Munisamy', '', 'munisamy@ndot.in', '827ccb0eea8a706c4c34a16891f84e7b', 1, 3, '', '', '', '', 0, '', '', 1, 3, '', '', '', 0, 0, 0, 'X2k9shD5', 0, 0, 0, 4, 1, 1, 1440570478, 1440570478, 0, 1, '', '', '', '', '', 0, 0, '', 0, '', '', '', '', '', '', 0, '', 0, '', 0, 0, '0.000'),
(23, 'aaaa', 'aaa', 'aaaa@aaa.aa', '21232f297a57a5a743894a0e4a801fc3', 0, 0, '', '', '', '', 0, '10', '', 14, 25, '09876543210', '', '', 0, 0, 0, '8nuv2z21', 0, 0, 0, 7, 1, 2, 1440762087, 0, 0, 1, '', '', '', '', '', 0, 0, '', 0, '', '', '', '', '', '', 0, '', 0, '', 0, 0, '0.000'),
(24, 'Admin Moderatore', 'Admin', 'adminmoderator@gmail.com', '21232f297a57a5a743894a0e4a801fc3', 0, 0, '', '', '', '', 0, '10 North street', '', 14, 25, '09876543210', '', '', 0, 0, 0, 'Dy7YhQzj', 0, 0, 0, 2, 1, 2, 1440831927, 0, 0, 1, '', '', '', '', '', 0, 0, '', 0, '', '', '', '', '', '', 0, '', 0, '', 0, 0, '0.000');

-- --------------------------------------------------------

--
-- Table structure for table `view_count_location`
--

CREATE TABLE IF NOT EXISTS `view_count_location` (
  `view_id` int(11) NOT NULL AUTO_INCREMENT,
  `deal_key` varchar(32) NOT NULL,
  `product_key` varchar(32) NOT NULL,
  `auction_key` varchar(35) NOT NULL,
  `ip` varchar(32) NOT NULL,
  `city` varchar(64) NOT NULL,
  `country` varchar(64) NOT NULL,
  `date` int(20) NOT NULL,
  PRIMARY KEY (`view_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=61 ;

--
-- Dumping data for table `view_count_location`
--

INSERT INTO `view_count_location` (`view_id`, `deal_key`, `product_key`, `auction_key`, `ip`, `city`, `country`, `date`) VALUES
(1, 'eg4dTTwo', '', '', '192.168.1.236', '', '', 1440426078),
(2, '', 'dwUzSne3', '', '192.168.1.54', '', '', 1440481748),
(3, '', 'WLv7v0vf', '', '192.168.1.54', '', '', 1440481764),
(4, '', '5Ll7V3on', '', '192.168.1.54', '', '', 1440481768),
(5, '', 'PIH3lOyb', '', '192.168.1.54', '', '', 1440484623),
(6, 'NHIoAwb4', '', '', '192.168.1.143', '', '', 1440485654),
(7, '', 'AL6Aa9P3', '', '192.168.1.143', '', '', 1440485697),
(8, 'GQHuXBm8', '', '', '192.168.1.143', '', '', 1440486118),
(9, '', 'yLBpJA2y', '', '192.168.1.236', '', '', 1440506254),
(10, '', 'LD9QBlw9', '', '192.168.1.236', '', '', 1440506270),
(11, '', 'WlwfRSU4', '', '192.168.1.236', '', '', 1440559037),
(12, '', 'sRbzBO1W', '', '192.168.1.236', '', '', 1440559576),
(13, '', 'PIH3lOyb', '', '192.168.1.236', '', '', 1440565568),
(14, '', 'c0LN7QtB', '', '192.168.1.236', '', '', 1440565775),
(15, '', '8nGYZZGv', '', '192.168.1.236', '', '', 1440565785),
(16, '', 'dwUzSne3', '', '192.168.1.236', '', '', 1440565789),
(17, '', 'EPpdYwF4', '', '192.168.1.236', '', '', 1440565796),
(18, '', 'AL6Aa9P3', '', '192.168.1.236', '', '', 1440565818),
(19, '', 'SFrwp5CQ', '', '192.168.1.236', '', '', 1440565964),
(20, '', 'GRmcQ7wI', '', '192.168.1.236', '', '', 1440566119),
(21, '', 'lrZugI8c', '', '192.168.1.143', '', '', 1440570684),
(22, '', 'PIH3lOyb', '', '192.168.1.143', '', '', 1440570893),
(23, '', 'lrZugI8c', '', '192.168.1.54', '', '', 1440575209),
(24, 'f949nfo1', '', '', '192.168.1.143', '', '', 1440588795),
(25, '', '5Ll7V3on', '', '192.168.1.236', '', '', 1440669400),
(26, '', 'lrZugI8c', '', '192.168.1.236', '', '', 1440675972),
(27, '', 'SFrwp5CQ', '', '192.168.1.143', '', '', 1440678146),
(28, '', 'PIH3lOyb', '', '192.168.1.87', '', '', 1440679286),
(29, '', 'WlwfRSU4', '', '192.168.1.87', '', '', 1440679824),
(30, 'ODfAdso9', '', '', '192.168.1.54', '', '', 1440686676),
(31, 'NHIoAwb4', '', '', '192.168.1.54', '', '', 1440686690),
(32, '', 'c0LN7QtB', '', '192.168.1.54', '', '', 1440686839),
(33, '', 'NGJ6PyXS', '', '192.168.1.54', '', '', 1440686898),
(34, 'GQHuXBm8', '', '', '192.168.1.54', '', '', 1440759792),
(35, '', 'EPpdYwF4', '', '192.168.1.54', '', '', 1440759808),
(36, '', 'yLBpJA2y', '', '192.168.1.54', '', '', 1440759838),
(37, '', 'AL6Aa9P3', '', '192.168.1.54', '', '', 1440760996),
(38, '', 'GRmcQ7wI', '', '192.168.1.54', '', '', 1440826790),
(39, 'szQ3qNUp', '', '', '192.168.1.54', '', '', 1440829415),
(40, 'UD1YZOGD', '', '', '192.168.1.54', '', '', 1440829464),
(41, 'eg4dTTwo', '', '', '192.168.1.54', '', '', 1440829465),
(42, 'B9SjLNw2', '', '', '192.168.1.54', '', '', 1440829466),
(43, '', 'WlwfRSU4', '', '192.168.1.54', '', '', 1440832212),
(44, 'eg4dTTwo', '', '', '192.168.1.143', '', '', 1440833639),
(45, '', 'PIH3lOyb', '', '192.168.1.30', '', '', 1440840340),
(46, '', 'GRmcQ7wI', '', '192.168.1.30', '', '', 1440840569),
(47, '', 'LD9QBlw9', '', '192.168.1.30', '', '', 1440840579),
(48, 'f949nfo1', '', '', '192.168.1.30', '', '', 1440840649),
(49, '', 'EPpdYwF4', '', '192.168.1.30', '', '', 1440840655),
(50, 'NHIoAwb4', '', '', '192.168.1.30', '', '', 1440841172),
(51, '', 'WlwfRSU4', '', '192.168.1.30', '', '', 1440841278),
(52, '', 'WLv7v0vf', '', '192.168.1.30', '', '', 1440841361),
(53, '', 'SQfnks7g', '', '192.168.1.54', '', '', 1440998815),
(54, '', 'SQfnks7g', '', '192.168.1.236', '', '', 1441000233),
(55, '', 'Wc6aa2Rd', '', '192.168.1.236', '', '', 1441000243),
(56, '', 'uSu7f9w4', '', '192.168.1.54', '', '', 1441003535),
(57, '', 'yEd3F8e1', '', '192.168.1.54', '', '', 1441005259),
(58, '', '6ZTqQYhc', '', '192.168.1.54', '', '', 1441006074),
(59, '', 'dX5eHtZQ', '', '192.168.1.54', '', '', 1441006088),
(60, '', 'i90IFkVF', '', '192.168.1.54', '', '', 1441006490);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
