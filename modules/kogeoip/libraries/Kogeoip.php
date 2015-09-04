<?php defined('SYSPATH') OR die('No direct access allowed.');
/**
 * Provides access to MaxMind's GeoIP.
 *
 * @package    KohanaGeoip
 * @author     Doru Moisa
 */

include("maxmind/geoipregionvars.php");
include("maxmind/geoip.inc");
include("maxmind/geoipcity.inc");


class Kogeoip_Core {

    // Configuration
    static protected $config = array(
        'dbfile' => 'database/GeoLiteCity.dat',
        'useshm' => FALSE,
        'internalcache' => FALSE
    );
    
    static private $gi = null;
    static private $initialised = false;
    static private $_cache = array();
    
    static function init(){
        if(self::$initialised) return;
        
        $config = Kohana::config('kogeoip');
        is_array($config) AND self::$config = array_merge(self::$config, $config);
        
        if(!self::$config['useshm']) {
            self::$gi = geoip_open(self::$config['dbfile'],GEOIP_STANDARD);
        }
        else {
            geoip_load_shared_mem( self::$config['dbfile']);
            self::$gi = geoip_open(self::$config['dbfile'], GEOIP_SHARED_MEMORY);
        }
        Event::add('system.shutdown', array(__CLASS__,"terminate"));
    }
    
    static function getCity($ipaddress) {
        return self::getProperty('city',$ipaddress);
    }
    
    static function getRecord($ipaddress) {
        self::init();
        global $GEOIP_REGION_NAME;
        
        if(!self::$config['internalcache']) {
            $rec = geoip_record_by_addr(self::$gi,$ipaddress);
            if($rec) $rec->region = $GEOIP_REGION_NAME[$rec->country_code][$rec->region];
            return $rec;
        }
        if(!isset(self::$_cache[$ipaddress])){
            self::$_cache[$ipaddress] = geoip_record_by_addr(self::$gi,$ipaddress);
            if(self::$_cache[$ipaddress])
                self::$_cache[$ipaddress]->region =
                $GEOIP_REGION_NAME[self::$_cache[$ipaddress]->country_code][self::$_cache[$ipaddress]->region];
        }

        return self::$_cache[$ipaddress];
    }
    
    static function getCoord($ipaddress, $mode = 'geo-dms'){
        $rec = self::getRecord($ipaddress);
        
        if(!$rec) return null;
        
        $modes = array('geo-dms', 'geo-dec', 'geo');
        if(!in_array($mode, $modes)) $mode = 'geo-dms';

        // standard geo
        if($mode == 'geo') return round($rec->latitude,3).'; '.round($rec->longitude, 3);

        $lat = round(str_replace("-","", $rec->latitude, $nr),3); // negative means South
        $lat_dir = 'N';
        if($nr) $lat_dir= 'S';
        
        $long = round(str_replace("-","", $rec->longitude, $nr),3); // negative means West
        $long_dir = 'E';
        if($nr) $long_dir = 'W';
        
        // decimal
        if($mode == 'geo-dec') return $lat.'&deg;'.$lat_dir.' '.$long.'&deg;'.$long_dir;
        
        // degree-minute-second
        $d = floor($lat);
        $m = sprintf("%02d", round(($lat-$d)*60));
        $lat = $d.'&deg;'.$m.'&prime;'.$lat_dir;

        $d = floor($long);
        $m = sprintf("%02d", round(($long-$d)*60));
        $long = $d.'&deg;'.$m.'&prime;'.$long_dir;

        return $lat.' '.$long;
    }

    static function getProperty($property, $ipaddress){
        $record = self::getRecord($ipaddress);
        if(!$record) return null;
        return isset($record->$property) ? $record->$property : null;
    }

    static function cityInfo($ipaddress, $mode = 'geo-dms') {
        if(!self::getRecord($ipaddress)) return null;
        return self::getCity($ipaddress) .
        ' ('.self::getCoord($ipaddress, $mode).')';
    }

    static function terminate(){
        geoip_close(self::$gi);
    }
    
}