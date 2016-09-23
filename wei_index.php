<?php
/**
 * Created by PhpStorm.
 * User: jml
 * Date: 2016/9/23
 * Time: 14:44
 */

//// * 1.将timestamp，nonce,token按字段徐排序
//    $timestamp  =   $_GET['timestamp'];
//    $nonce      =   $_GET['nonce'];
//    $token      =   'weixin';
//    $signature  =   $_GET['signature'];
//
//    $arr        =   array($token,$timestamp,$nonce);
//    sort($arr, SORT_STRING);
//
//// * 2.将排序后的三个参数拼接成字符串后用sha1加密
//
//    $tmpStr     =   implode($arr);
//    $tmpStr     =   sha1($tmpStr);
//
//// * 3.将加密后的字符串与signature进行对比，判断该请求是否来自微信
//
//    if ($signature == $tmpStr){
//        echo $_GET['echostr'];
//        exit();
//    }

require_once 'checked_weixin.php';

    if(isset($_GET['signature'])){
        $timestamp  =   $_GET['timestamp'];
        $nonce      =   $_GET['nonce'];
        $signature  =   $_GET['signature'];
        $echostr    =   $_GET['echostr'];
        $wx = new weixin($timestamp, $nonce, $signature, $echostr);
        echo $wx->returnStr();
    }else{
        echo 'test';
    }



