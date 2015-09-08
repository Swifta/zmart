<?php defined('SYSPATH') OR die('No direct access allowed.');
/**
 * @package  KohanaGeoip
 *
 * Settings related to the Kohana MAXMIND GeoIP module.
 */

// database file to user, path relative to the modules/kogeoip/libraries
$config['dbfile'] =  str_replace("config","", dirname(__FILE__)) . 'database/GeoLiteCity.dat';
$config['useshm'] =  FALSE;
$config['internalcache'] = FALSE;

