<?php
namespace edege;
class WebScraper
{
    public static function go($url)
    {
        set_time_limit(0);
        $ch = curl_init();
        $timeout = "5";
        curl_setopt($ch,CURLOPT_URL,$url);
        curl_setopt($ch,CURLOPT_HEADER,false);
        curl_setopt($ch,CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
        curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,$timeout);
        curl_setopt($ch,CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch,CURLOPT_REFERER,"http://www.google.com.tr");
        //curl_setopt($ch,CURLOPT_USERAGENT,$_SERVER["HTTP_USERAGENT"]);
        $data = curl_exec($ch);
        curl_close($ch);
        return $data;

    }
    // One search ex: search("<title>","</title>,$data);
    public static function search($first,$last,$data){
        $a = explode($first,$data);
        $a = explode($last,$a[1]);
        $a = $a[0];
        return $a;
    }
    // ex: bulksearch("<li><a>","</a></li>,$data);
    public static function bulksearch($first,$last,$data){
        $count = substr_count($data,$first);
        $results = array();

        foreach ($count as $item){
            $a = explode($first,$data);
            $a = explode($last,$a[$item]);
            $a = $a[0];
            $results[] = $a;
        }
        return $results;
    }

}