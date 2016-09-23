<?php
/**
 * Created by PhpStorm.
 * User: jml
 * Date: 2016/9/23
 * Time: 19:27
 * 1.将timestamp，nonce,token按字段徐排序
 * 2.将排序后的三个参数拼接成字符串后用sha1加密
 * 3.将加密后的字符串与signature进行对比，判断该请求是否来自微信
 */

define('TOKEN','weixin');

class weixin{

    public $timestamp;
    public $nonce;
    public $signature;
    public $echostr;

    public function __construct($timestamp, $nonce, $signature, $echostr){
        $this->timestamp    =   $timestamp;
        $this->nonce        =   $nonce;
        $this->signature    =   $signature;
        $this->echostr      =   $echostr;

    }

    private function checkaccess(){
        $arr = array(TOKEN, $this->timestamp, $this->nonce);
        sort($arr, SORT_STRING);
        $tmpStr = sha1(implode($arr));
        if ($tmpStr == $this->signature){
            return true;
        }else{
            return $tmpStr;
        }
    }

    public function returnStr(){
        if ($this->checkaccess()){
            return $this->echostr;
        }else{
            return false;
        }
    }

}