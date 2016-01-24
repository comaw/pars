<?php
/**
 * powered by php-shaman
 * Curl.php 24.01.2016
 * www
 */

namespace console\models;


class Curl
{

    protected static $uagent = 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/41.0.2228.0 Safari/537.36';

    public static function setReferer($str = ''){
        $str = parse_url($str);
        return $str['scheme'].'://'.$str['host'].'/';
    }

    protected static function cookieFile($new = false){
        $dir = __DIR__.'/../runtime/coockie.txt';
        if(!is_file($dir) || $new){
            file_put_contents($dir, '');
        }
        return $dir;
    }

    public static function get($url, $post = ''){
        $curl = curl_init();
        if(!$curl){
            exit();
        }
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HEADER, false);
        curl_setopt($curl, CURLOPT_NOBODY, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($curl, CURLOPT_USERAGENT, self::$uagent);
        curl_setopt($curl, CURLOPT_REFERER, self::setReferer($url));
        curl_setopt($curl, CURLOPT_COOKIEFILE, self::cookieFile());
        curl_setopt($curl, CURLOPT_COOKIEJAR, self::cookieFile());
        curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 60);
        curl_setopt($curl, CURLOPT_TIMEOUT, 60);
        curl_setopt($curl, CURLOPT_MAXREDIRS, 5);
        if($post) {
            curl_setopt($curl, CURLOPT_POST, true);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $post);
        }
        $out = curl_exec($curl);
        curl_close($curl);
        return $out;
    }
}