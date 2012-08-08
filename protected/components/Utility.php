<?php

class Utility
{
    public function fetchUrlContent($url, $fakeBot = false)
    {
        $crl = curl_init();
        $timeout = 5;
        $logEnabled = true;
        $logExt = ".log";
        $beginTime = time();

        // set user agent
        if ($fakeBot)
            $useragent = 'Googlebot/2.1 (http://www.googlebot.com/bot.html)';
        else
            $useragent = "Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.1) Gecko/20061204 Firefox/2.0.0.1";

        curl_setopt($crl, CURLOPT_USERAGENT, $useragent);
        curl_setopt($crl, CURLOPT_URL, $url);
        curl_setopt($crl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($crl, CURLOPT_FOLLOWLOCATION, true);

        if (Yii::app()->params['useProxy'])
            curl_setopt($crl, CURLOPT_PROXY, "http://10.1.9.20:8080");

        curl_setopt($crl, CURLOPT_CONNECTTIMEOUT, $timeout);
        $ret = curl_exec($crl);
        $response = curl_getinfo($crl);
        curl_close($crl);
        if ($response['http_code'] == 301 || $response['http_code'] == 302)
        {
            if (preg_match_all("/<a href=\"(.*)\">(.*)<\/a>/siU", $ret, $matches))
            {
//                print_r($matches);
                $ret = Utility::fetchUrlContent(trim($matches[1][0]));
            }
        }

        if($logEnabled)
        {
            $fh = fopen("logs/log_" . Yii::app()->params['log'] . $logExt, 'a+') or die("can't open file");
            fwrite($fh, $url . " | " . date("F j, Y, g:i a") . " | " . (time() - $beginTime) . "\n");
            fclose($fh);
        }

        return $ret;
    }
    
    public function fetchFile($url, $cat, $name)
    {
        $i = 0;
        $validExts = array('jpeg','jpg','png','gif');

        $rem = substr(strrchr($url,'?'),0);
        $url = str_replace($rem, "", $url);
        $ext = strtolower(substr(strrchr($url,'.'),1));
        
        if(!in_array($ext, $validExts))
            return false;
        
        $name = $cat . "/" . preg_replace('/[^A-Za-z0-9-]/s', '', $name);

        do{

            if($i == 0)
                $fileName = 'images/products/' . str_replace(" ", "-", $name) . ".$ext";
            else
                $fileName = 'images/products/' . str_replace(" ", "-", $name) . "-" . $i . ".$ext";
            $i++;

        }while(file_exists($fileName));

        $fp = fopen($fileName, 'w');
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_FILE, $fp);

        $data = curl_exec($ch);

        curl_close($ch);
        fclose($fp);

        return $fileName;
    }

    function sanitize($data)
    {
        if (is_array($data))
        {
            $cleanedArray = array();
            foreach ($data as $key => $value)
            {
                if ($key != 'url')
                    $cleanedArray[$key] = Utility::sanitize($value);
                else
                    $cleanedArray[$key] = $value;
            }
            return $cleanedArray;
        }
        else
        {
            $str = mb_convert_case($data, MB_CASE_TITLE, "UTF-8");
            $str = preg_replace("/\s+/", " ", $str);
//            $str = htmlspecialchars($str);
            $str = trim(mysql_escape_string($str));

            // Fix the case of Special Chars &Nbsp; etc.
            if (preg_match_all("/&[.0-9a-z_-]+;/i", $str, $matches))
            {
                array_unique($matches);
                foreach ($matches as $match)
                {
                    if (is_array($match))
                    {
                        foreach ($match as $ch)
                            $str = str_replace($ch, strtolower($ch), $str);
                    }
                    else
                        $str = str_replace($match, strtolower($match), $str);
                }
            }
            $str = trim(strip_tags($str));
            return $str;
        }
    }

    public static function getUnique($string)
    {
        if(strlen($string) > 0)
        {
            $array = explode(",", $string);
            foreach($array as $a)
            {
                $str = trim($a);
                if($str != '')
                    $finalArray[] = $str;
            }
            $finalArray = array_unique($finalArray);
            return(implode(",", $finalArray));
        }
        else
            return $string;
    }

    public static function getRandomString($length)
    {
        $timeStamp = time();
        $code = md5(mt_rand(1000, 1000000) + $timeStamp);

        return substr($code, 0, $length);
    }

    public static function absoluteLink($link, $remParam = '')
    {
        $params = array();

        foreach($_GET as $key => $value)
            if($remParam != $key)
                $params[] = "$key=$value";

        $paramsString = implode("&", $params);

        return $link . "?" . $paramsString;
    }
}