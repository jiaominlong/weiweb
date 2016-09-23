<?php
/**
 * Created by PhpStorm.
 * User: jml
 * Date: 2016/9/23
 * Time: 19:27
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
        $tmpStr = implode(sort($arr, SORT_STRING));
        $tmpStr = sha1($tmpStr);
        if ($tmpStr == $this->signature){
            return true;
        }else{
            return $tmpStr;
        }
    }

    public function returnStr(){
        if ($this->checkaccess()){
            echo $this->checkaccess()."==".$this->signature;
//            echo $this->echostr;
        }else{
            echo '对比错误！';
        }
    }

}