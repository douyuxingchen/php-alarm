<?php
namespace Douyuxingchen\PhpAlarm\RemoteRequest;

class RemoteRequestHandler
{
    /**
     * Method
     */
    const GET       =    'GET';
    const POST      =    'POST';
    const PUT       =    'PUT';
    const DELETE    =    'DELETE';
    const PATCH     =    'PATCH';

    public static function main($method = 'post', $url = '', $data = [], $header = [])
    {
        $func = strtolower($method . 'url');
        return self::$func($url, $data, $header);
    }

    /**
     * 拼接 url
     * @param string $host
     * @param string $path
     * @param array  $params
     * @return string
     */
    public static function spliceUrl(string $host, string $path, array $params = [])
    {
        $url = trim($host, '/') . '/' . trim($path, '/');
        if ($params) {
            return $url . '?' . http_build_query($params);
        }
        return $url;
    }


    /**
     * 拼接app 路由地址
     * @param string $route
     * @param array  $params
     * @return string
     */
    public static function appSpliceUrl(string $route, array $params = [])
    {
        return $route . '?' . http_build_query($params);
    }
    /**
     * 拼接app 路由地址
     * @param string $route
     * @param array  $params
     * @return string
     */
    public static function appSpliceUrldecode(string $route, array $params = [])
    {
        return $route . '?' . urldecode(http_build_query($params));
    }


    public static function geturl($url, $data = [], $header = [])
    {
        if (!empty($data)) {
            $url = $url . '?' . http_build_query($data);
        }
        $headerArray = ["Content-type:application/json;", "Accept:application/json"];
        $headerArray = array_merge($headerArray, $header);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headerArray);
        $output = curl_exec($ch);
        curl_close($ch);

        $output = json_decode($output, true);
        return $output;
    }


    public static function posturl($url, $data = [], $header = [])
    {
        $data = json_encode($data);
        $headerArray = array("Content-type:application/json;charset='utf-8'", "Accept:application/json");
        $headerArray = array_merge($headerArray, $header);

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headerArray);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($curl);
        curl_close($curl);
        $result =  json_decode($output, true);
        if(isset($result['code']) && $result['code'] == 0){
            return $result;
        }else{
            $msg = isset($result['msg']) ? $result['msg'] : '调用报错'.$output;
            throw new \Exception($msg);
        }
    }

    public static function puturl($url, $data)
    {
        $data = json_encode($data);
        $ch = curl_init(); //初始化CURL句柄
        curl_setopt($ch, CURLOPT_URL, $url); //设置请求的URL
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-type:application/json'));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); //设为TRUE把curl_exec()结果转化为字串，而不是直接输出
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT"); //设置请求方式
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);//设置提交的字符串
        $output = curl_exec($ch);
        curl_close($ch);
        return json_decode($output, true);
    }

    private static function delurl($url, $data, $header = [], $timeout = 0)
    {
        $data = json_encode($data);
        $ch   = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-type:application/json'));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_TIMEOUT, $timeout);
        $output = curl_exec($ch);
        curl_close($ch);
        $output = json_decode($output, true);
        return $output;
    }

    public static function patchurl($url, $data)
    {
        $data = json_encode($data);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-type:application/json'));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PATCH");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);     //20170611修改接口，用/id的方式传递，直接写在url中了
        $output = curl_exec($ch);
        curl_close($ch);
        $output = json_decode($output);
        return $output;
    }
}
