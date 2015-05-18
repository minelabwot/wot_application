<?php
include "get.php";   //暂时没有
include "post.php";
if (isset($_GET['command'])) {
    $command=$_GET['command'];
    // $userid=$_GET['openid'];
    $MWID=$_GET['MWID'];
    $deviceid=$_GET['deviceid'];
    //echo "ok";
    //post();
    post($MWID,$deviceid,$command);
}
?>