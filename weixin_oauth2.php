<?php
/**
 * 微信活动页面  oauth2.0
 * @author 大灰狼wow
 * @link  116311316@qq.com
 * @version 1.0
 */

define("APPID", "wx250d00817156085c");
define("SECRET", "50c6b69c831f811d4d723990abec6173");
ini_set("display_errors", false);

//配置错误处理器
set_error_handler("customError", E_WARNING);

//第二步 通过code获取access_token
if (! empty($_REQUEST['code'])) {
    $code = $_REQUEST['code'];
    
    $url = "https://api.weixin.qq.com/sns/oauth2/access_token?appid=" . APPID . "&secret=" . SECRET . "&code=$code&grant_type=authorization_code";
    $con = file_get_contents($url);
    
    if (empty($con)) {
        setLog('啥都没获取到!');
    }
    
    $rs = json_decode($con, true);

    //第三步：刷新access_token（如果需要）
    //第四步 拉取用户信息
    

    $userURL = "https://api.weixin.qq.com/sns/userinfo?access_token=$rs[access_token]&openid=$rs[openid]";
    
    $user = file_get_contents($userURL);
    
    $u = json_decode($user, true);
    if (empty($u)) {
        setLog("无法获取用户信息");
    }

    //获取用户信息
    echo "hello" . $u['nickname'] . "你即将升职加薪，当上总经理，出任CEO，迎娶白富美，走上人生巅峰。想想还有点小激动呢";

}

function customError($no, $string)
{
    $string = $no . " " . $string;
    setLog($string);
}
function setLog($con)
{
    $time = date("m/d H:i:s", time());
    $con = "# [" . $time . "]" . $con . "\r\n";
    $file = getcwd() . "/log.txt";
    $handle = fopen($file, "a");
    fwrite($handle, $con);
    fclose($handle);
}