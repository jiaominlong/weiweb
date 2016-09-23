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

class initWeichat{

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

class messageWeichat{
    public $postObj;
//    public $ToUserName;
//    public $FromUserName;
//    public $CreateTime;
//    public $MsgType;
//    public $Content;
//    public $MsgId;
//    public $Event;

    public function __construct($defaultXML){
        $this->postObj = simplexml_load_string($defaultXML);
    }
    // 判断事件
    public function judge_event(){
        if (strtolower($this->postObj->MsgType) == 'event'){
            //如果是关注 subscribe 事件
            if (strtolower($this->postObj->Event) == 'subscribe'){
               //回复用户消息
                $toUser     =   $this->postObj->FromUserName;
                $fromUser   =   $this->postObj->toUserName;
                $time       =   time();
                $Msgtype    =   'text';
                $Content    =   '欢迎关注常熟服装在线优惠买单';

                $tmplate = "<xml>
                                <ToUserName><![CDATA[%s]]></ToUserName>
                                <FromUserName><![CDATA[%s]]></FromUserName>
                                <CreateTime>12345678</CreateTime>
                                <MsgType><![CDATA[%s]]></MsgType>
                                <Content><![CDATA[%s]]></Content>
                            </xml>";

                $info   =   sprintf($tmplate,$toUser,$fromUser, $time, $Msgtype, $Content);
                echo $info;
            }
        }
    }
}

