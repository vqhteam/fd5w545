<?php
namespace Vqh\Socialvideos;
class CURL
{
    private static $default_useragent='Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/110.0.0.0 Safari/537.36';
    public static function GET($url,$headers=[],$curlopt=[])
    {
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $useragentset=false;
        foreach ($headers as $header)
        {
            if (preg_match('/user-agent/i',$header))
            {
                $useragentset=true;
                break;
            }
        }
        if (!$useragentset)
        {
            $headers[]='user-agent: '.self::$default_useragent;
        }
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        foreach ($curlopt as $key=>$value)
        {
            curl_setopt($curl, $key, $value);
        }
        $resp = curl_exec($curl);
        $error=false;
        if (curl_errno($curl))
        {
            $error=curl_error($curl);
        }
        $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        $endURL =curl_getinfo($curl, CURLINFO_EFFECTIVE_URL);
        curl_close($curl);
        return (object)[
            'data'=>$resp,
            'code'=>$httpcode,
            'error'=>$error,
            'endURL'=>$endURL
        ];
    }
    public static function POST($url,$data,$headers=['content-type:application/json'],$curlopt=[])
    {
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $useragentset=false;
        foreach ($headers as $header)
        {
            if (preg_match('/user-agent/i',$header))
            {
                $useragentset=true;
                break;
            }
        }
        if (!$useragentset)
        {
            $headers[]='user-agent: '.self::$default_useragent;
        }
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        foreach ($curlopt as $key=>$value)
        {
            curl_setopt($curl, $key, $value);
        }
        $resp = curl_exec($curl);
        $error=false;
        if (curl_errno($curl))
        {
            $error=curl_error($curl);
        }
        $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        $endURL =curl_getinfo($curl, CURLINFO_EFFECTIVE_URL);
        curl_close($curl);
        return (object)[
            'data'=>$resp,
            'code'=>$httpcode,
            'error'=>$error,
            'endURL'=>$endURL
        ];
    }
}