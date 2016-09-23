<?php
/**
 * Created by PhpStorm.
 * User: jml
 * Date: 2016/9/23
 * Time: 14:44
 */
require_once 'checked_weixin.php';

//    init
    if(isset($_GET['signature'])){
        $timestamp  =   $_GET['timestamp'];
        $nonce      =   $_GET['nonce'];
        $signature  =   $_GET['signature'];
        $echostr    =   $_GET['echostr'];
        $wx = new initWeichat($timestamp, $nonce, $signature, $echostr);
        echo $wx->returnStr();
        exit();
    }else{
        echo 'test';
    }

//message
   if($GLOBALS['HTTP_RAW_POST_DATA']){
       $message = new messageWeichat($GLOBALS['HTTP_RAW_POST_DATA']);
   }





