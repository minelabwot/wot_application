<?php
/*
本文件位置

URL
http://open.plus.yixin.im/connect/oauth2/authorize?appid=cc03ac4b168f46fb944cd7321878b45e&redirect_uri=http://lixiaopengtest.sinaapp.com/yixin_oauth2_openid.php&response_type=code&scope=snsapi_base&state=1#yixin_redirect


*/
$code = $_GET["code"];
if (isset($_GET['name'])) {
    
    //$deviceid="00010000607383f6";
    //$DID="1";
     $deviceid="00010000607383f6";
    $DID=$_GET['DID'];
    $name=$_GET['name'];
    changeName($deviceid,$DID,$name);   
}
$deviceid="00010000607383f6"; //暂时用来替代某种对应关系（网关id和微信侧设备id的对应）；
//$userinfo = getUserInfo($code);
$openid = getUserId($code);
$deviceInfo=getDeviceInfo($deviceid);
$deviceList=$deviceInfo[0];
$deviceType=$deviceInfo[0];
$DID=$deviceInfo[1];          //网关下的某个设备
$deviceUrl=getDeviceUrl($deviceType); 
//echo $deviceType[0];
//echo count($deviceList);
//updateSql($deviceid,$DID,$deviceList);
$deviceName=getDeviceName($deviceType);
//echo $deviceName[1];
//changeName();


function getUserId($code)
{
	$appid = "cc03ac4b168f46fb944cd7321878b45e";
	$appsecret = "62c985b65546431cb8d4df1b4440004d";

    //oauth2的方式获得openid
	$access_token_url = "https://api.yixin.im/sns/oauth2/access_token?appid=$appid&secret=$appsecret&code=$code&grant_type=authorization_code";
	$access_token_json = https_request($access_token_url);
	$access_token_array = json_decode($access_token_json, true);
	$openid = $access_token_array['openid'];

    return $openid;
    
    //非oauth2的方式获得全局access token
    //$new_access_token_url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=$appid&secret=$appsecret";
    //$new_access_token_json = https_request($new_access_token_url);
    //$new_access_token_array = json_decode($new_access_token_json, true);
    //$new_access_token = $new_access_token_array['access_token'];
    
    //全局access token获得用户基本信息
    //$userinfo_url = "https://api.weixin.qq.com/cgi-bin/user/info?access_token=$new_access_token&openid=$openid";
    //$userinfo_json = https_request($userinfo_url);
    //$userinfo_array = json_decode($userinfo_json, true);
    //return $userinfo_array;
}
function getDeviceId($openid)
{
    $appid = "cc03ac4b168f46fb944cd7321878b45e";
	$appsecret = "62c985b65546431cb8d4df1b4440004d";
    
    //非oauth2的方式获得全局access token
    $new_access_token_url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=$appid&secret=$appsecret";
    $new_access_token_json = https_request($new_access_token_url);
    $new_access_token_array = json_decode($new_access_token_json, true);
    $new_access_token = $new_access_token_array['access_token'];
    
    $deviceIdUrl="https://api.weixin.qq.com/device/get_bind_device?access_token=$new_access_token&openid=$openid";
    $deviceIdUrl_json=https_request($deviceIdUrl);
    $deviceId_array = json_decode($deviceIdUrl_json, true);
    $deviceId = $deviceId_array['device_list'][0]['device_id'];
    return $deviceId;
}

function getDeviceInfo($MWID)
{
    //MWID="1234567890abcd01";
    $deviceListUrl="http://www.cloudsensing.cn:9071/WIFPa/GatewayGWDevicelist.xml/"."$MWID"."?lang=zh";
    $deviceListXml=https_request($deviceListUrl);
    $postObj = simplexml_load_string($deviceListXml, 'SimpleXMLElement', LIBXML_NOCDATA);
    $deviceList=array();
    $deviceType=array();
    $deviceNum=array();
    foreach($postObj->children() as $child)
    {
        //$deviceList[]=$child->DevInfo->Name;
        $deviceType[]=$child->Resources->Resource->Type;
        $deviceNum[]=$child->Resources->Resource[ResID];
    }
    $result=array();
    //$result[]=$deviceList;
    $result[]=$deviceType;
    $result[]=$deviceNum;
    
    return $result;
}
function getDeviceUrl($deviceType)
{
    $urlmapping=array("light"=>"http://1.lixiaopengtest.sinaapp.com/light.php","camera"=>"http://1.lixiaopengtest.sinaapp.com/camera.php","temp"=>"http://1.lixiaopengtest.sinaapp.com/temp.php","monitor"=>"http://1.lixiaopengtest.sinaapp.com/cctv.php","TV"=>"http://1.lixiaopengtest.sinaapp.com/TV.php");
    $deviceUrl=array();
    $arrLength=count($deviceType);
    for($x=0;$x<$arrLength;$x++)
    {
        $index=$deviceType[$x];
        $deviceUrl[]=$urlmapping["$index"];    // notice the "" in []
        
    }
    return $deviceUrl;
}

function getDeviceName($deviceType)
{
    $urlmapping=array("type"=>"光照","camera"=>"相机","light"=>"光照","temp"=>"温度","monitor"=>"摄像头","TV"=>"电视机");
    $deviceName=array();
    $arrLength=count($deviceType);
    for($x=0;$x<$arrLength;$x++)
    {
        $index=$deviceType[$x];
        
        $deviceName[]=$urlmapping["$index"];    // notice the "" in []
        
    }
    
    return $deviceName;
}

function https_request($url)  //method=get
{
	$curl = curl_init();
	curl_setopt($curl, CURLOPT_URL, $url);
	curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
	curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
	$data = curl_exec($curl);
	if (curl_errno($curl)) {return 'ERROR '.curl_error($curl);}
	curl_close($curl);
	return $data;
}
function updateSql($deviceid,$DID,$deviceList){
     $mysql_host = SAE_MYSQL_HOST_M;
     $mysql_host_s = SAE_MYSQL_HOST_S;
     $mysql_port = SAE_MYSQL_PORT;
     $mysql_user = SAE_MYSQL_USER;
     $mysql_password = SAE_MYSQL_PASS;
     $mysql_database = SAE_MYSQL_DB;
   

	$mysql_table = "deviceName";
    
    
	$con = @mysql_connect($mysql_host.':'.$mysql_port, $mysql_user, $mysql_password, true);
	if (!$con){
		die('Could not connect: ' . mysql_error());
	}
	mysql_query("SET NAMES 'UTF8'");
	mysql_select_db($mysql_database, $con);
    $deviceNum=count($deviceList);
    for($x=0;$x<$deviceNum;$x++){
        //$mysql_state = "SELECT * FROM `".$mysql_table."` WHERE `deviceid` LIKE  '".$deviceid."'AND `DID` LIKE '".$DID[$x]."'LIMIT 0 , 1";
        // $result = mysql_query($mysql_state);
        
        // if(mysql_num_rows($result) ===0){
           
            $mysql_state= "INSERT INTO  `".$mysql_table."` (`deviceid`,`DID`,`Name`) VALUES ('".$deviceid."','".$DID[$x]."','".$deviceList[$x]."')";
            $result = mysql_query($mysql_state);
        // }        
     }
     mysql_close($con);

}
function readSql($deviceid,$DID){
     $mysql_host = SAE_MYSQL_HOST_M;
     $mysql_host_s = SAE_MYSQL_HOST_S;
     $mysql_port = SAE_MYSQL_PORT;
     $mysql_user = SAE_MYSQL_USER;
     $mysql_password = SAE_MYSQL_PASS;
     $mysql_database = SAE_MYSQL_DB;
  

	$mysql_table = "deviceName";
    //$mysql_state = "UPDATE deviceName SET Name = '".$name."' WHERE deviceid ='"."$deviceid' AND DID='".$DID."'";
    // $mysql_state = "SELECT * FROM `".$mysql_table."` WHERE `deviceid` LIKE  '".$deviceid."'AND `DID` LIKE '".$DID[$x]."'";
	$con = @mysql_connect($mysql_host.':'.$mysql_port, $mysql_user, $mysql_password, true);
	if (!$con){
		die('Could not connect: ' . mysql_error());
	}
	mysql_query("SET NAMES 'UTF8'");
	mysql_select_db($mysql_database, $con);
    //$result = mysql_query($mysql_state);
    //echo $result;
    $deviceName=array();
    $deviceNum=count($DID);
    //echo $deviceNum;
    for($x=0;$x<$deviceNum;$x++){
        //if(mysql_num_rows($result)>0)
        //echo mysql_num_rows($result);
        // while($row = mysql_fetch_array($result);
        $tmp=$DID[$x];
        $mysql_state = "SELECT * FROM `".$mysql_table."` WHERE `deviceid` LIKE  '".$deviceid."'AND `DID` LIKE '".$x."'";
        $result = mysql_query($mysql_state);
        $row = mysql_fetch_array($result);
        $deviceName[] = $row['Name']; 
        //echo $row['Name'];
        
    }
    
	mysql_close($con);
	return $deviceName;

}

function changeName($deviceid,$DID,$name){
    $mysql_host = SAE_MYSQL_HOST_M;
     $mysql_host_s = SAE_MYSQL_HOST_S;
     $mysql_port = SAE_MYSQL_PORT;
     $mysql_user = SAE_MYSQL_USER;
     $mysql_password = SAE_MYSQL_PASS;
     $mysql_database = SAE_MYSQL_DB;
    //$name="default";
    // $deviceid="00010000607383f6"; 
    //$DID="0";

	$mysql_table = "deviceName";
    $mysql_state = "UPDATE deviceName SET Name = '".$name."' WHERE deviceid ='"."$deviceid' AND DID='".$DID."'";
    
	$con = @mysql_connect($mysql_host.':'.$mysql_port, $mysql_user, $mysql_password, true);
	if (!$con){
		die('Could not connect: ' . mysql_error());
	}
	mysql_query("SET NAMES 'UTF8'");
	mysql_select_db($mysql_database, $con);
    mysql_query($mysql_state);
    mysql_close($con); 
    }

?>
 <!DOCTYPE html
PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
<title>设备列表</title>
 <link href="css/default.css" rel="stylesheet" type="text/css" />
<script src="http://libs.useso.com/js/jquery/1.4.2/jquery.min.js" type="text/javascript"></script>
<script src="js/mobilyblocks.js" type="text/javascript"></script>
<!--<link rel="stylesheet" type="text/css" href="css/base.css" media="screen">-->
	<link rel="stylesheet" type="text/css" href="css/button.css" media="screen">
    <link rel="stylesheet" href="http://www.yyyweb.com/demo/common/init.css">	
<script>
$(document).ready(function(){

  $("#bu1").click(function(){
     $("#iv1").toggle();
  });
  
});
</script>
 <style type="text/css">
     #shezhi{
         text-align: center;
     }
     #t1{
         
position:relative;
right:-16px
}
     .button2{
         position:absolute;
         top:0px;
         right:0px;
         z-index:1
     }
 
 input,textarea{
         padding:4px;
         border:solid 1px #E5E5E5;
         outline:0;
         font:normal 13px/100% Verdana, Tahoma, sans-serif;
         width:150px;
         background:#FFFFFF;
         box-shadow:rgba(0,0,0,0.1) 0px 0px 8px;
         -moz-box-shadow:rgba(0,0,0,0.1) 0px 0px 8px;
         -webkit-box-shadow:rgba(0,0,0,0.1) 0px 0px 8px;
     }
     input:hover,textarea:hover,input:focus,textarea:focus{border-color:#C9C9C9;}
     .submit input{
         width:auto;
         padding:9px 15px;
         background:#617798;
         border:0;
         font-size:14px;
         color:#FFFFFF;
     }
             
    </style>
 <script  type="text/javascript">
$(function(){
	$('.nature').mobilyblocks({
		trigger: 'hover', //触发的方式
		direction: 'counter', //动画方向
		duration:500,  //动画持续时间
		zIndex:50,  //z-inde值
		widthMultiplier:1.15  //宽度的倍数
	});
});
</script>
   <!--<script type="text/javascript">
        document.body.addEventListener('touchstart', function () { }); 
       
   var XMLHttpRequest;
         function createXMLHttpRequest() { //建立XMLHttpRequest对象
                        var ajax = null;
			 try {
				 ajax=new XMLHttpRequest();
			 } catch (e) {
				 try {
				 ajax=new ActiveXObject("Msxml2.XMLHTTP");
				 } catch (e) {
					 ajax=new ActiveXObject("Microsoft.XMLHTTP");
				 }
			 }
			 return ajax;
        }
		
        function namechange(){
			sessionStorage.openid="<?php echo $openid;?>";
			 sessionStorage.deviceid="<?php echo $deviceid;?>";
            
			 var open=sessionStorage.openid;
 			 var device=sessionStorage.deviceid; 
            var DID=document.getElementById("num").value
            var nkname=document.getElementById("t1").value;
            XMLHttpRequest = createXMLHttpRequest(); //获得XMLHttpRequest对象
            XMLHttpRequest.onreadystatechange=stateChanged;  //ajax返回后的回调函数
            XMLHttpRequest.open("GET","http://1.lixiaopengtest.sinaapp.com/oauth2_openid.php/?deviceid="+device+"&DID="+DID+"&name="+nkname, false); //get方式发送  建议第二个参数为true 异步方式！ 
            XMLHttpRequest.send(null); 
        } 
  //回调函数    
        function stateChanged() { 
			 if (XMLHttpRequest.readyState === 4 || XMLHttpRequest.status === 200) {	  
	            var display = XMLHttpRequest.responseText; //服务端返回值
                 alert(display);
        	} 
        }
  
</script>
	 <script language=Javascript> 
 
function showTime()
{
 
  var d = new Date()
  document.getElementById('time').innerHTML=d;
  setTimeout(showTime,1000);
 
}
</script>-->
    </head>
    <body style="margin-top:1px" background="http://cdn.duitang.com/uploads/blog/201312/01/20131201163425_PnGrr.thumb.600_0.jpeg">
    	<div class="button blue"  onclick="location.reload();" ><div class="shine"></div>刷新</div>
	<!--<div class="button blue" id="bu1"><div class="shine"></div>设置</div>--><br/>
	</body>
<body onload="showTime()">
      
        <!--<div id=shezhi>
           
	<div id="iv1" style="display:none" border="1">
        <div class="lab1"><h3>1、设备昵称修改</h3></div>
        <form color="#00FF00">
             设备序列号：<input id="num" type="text" list="dev_list" name="devicename">
            <datalist id="dev_list">
                <option id="devi1"></option>
                
            </datalist>
            <br/>
              昵称：<input type="text" id="t1" /><br/>
	<input type="button" value="提交" onclick="namechange()"/>
        </form>
	</div>
    </div>-->
 
<div id="content">
  <div class="nature">
    <h1>设备菜单</h1>
    <ul id="myul" class="reset">
     </ul>
  </div>
</div>
    <!-- <script  type="text/javascript">
      function addop(){
       sessionStorage.count="<?php echo count($deviceList);?>";
    var n=sessionStorage.count;
   sessionStorage.open="<?php echo $openid;?>";
var open=sessionStorage.open;
    sessionStorage.deviceid="<?php echo $deviceid;?>";
    var device=sessionStorage.deviceid;
          var datalist= document.getElementById("dev_list");
         var u=new Array()
   u[0]="<?php echo $DID[0];?>";
    u[1]="<?php echo $DID[1];?>"; 
    u[2]="<?php echo $DID[2];?>";
     u[3]="<?php echo $DID[3];?>";
     u[4]="<?php echo $DID[4];?>";
     u[5]="<?php echo $DID[5];?>";
     u[6]="<?php echo $DID[6];?>";
     u[7]="<?php echo $DID[7];?>";
     u[8]="<?php echo $DID[8];?>";
          u[9]="<?php echo $DID[9];?>";
   for(var i=1;i<n;i++){
        var option = document.createElement('option');
         option.id = "ops_"+i;
         option.innerHTML = u[i];
        datalist.appendChild(option);
    }
}
    window.onload=addop();
</script>  --> 
<script  type="text/javascript">
function addli()
{
    sessionStorage.count="<?php echo count($deviceList);?>";
    var n=sessionStorage.count;
   sessionStorage.open="<?php echo $openid;?>";
var open=sessionStorage.open;
    sessionStorage.deviceid="<?php echo $deviceid;?>";
    var device=sessionStorage.deviceid;
    var ul = document.getElementById("myul");
   var r=new Array()
   r[0]="<?php echo $deviceName[0];?>";
    r[1]="<?php echo $deviceName[1];?>"; 
     r[2]="<?php echo $deviceName[2];?>";
     r[3]="<?php echo $deviceName[3];?>";
     r[4]="<?php echo $deviceName[4];?>";
     r[5]="<?php echo $deviceName[5];?>";
     r[6]="<?php echo $deviceName[6];?>";
     r[7]="<?php echo $deviceName[7];?>";
     r[8]="<?php echo $deviceName[8];?>";
    
    var d=new Array()
    d[0]="<?php echo $deviceUrl[0];?>";
     d[1]="<?php echo $deviceUrl[1];?>";
     d[2]="<?php echo $deviceUrl[2];?>";
     d[3]="<?php echo $deviceUrl[3];?>";
     d[4]="<?php echo $deviceUrl[4];?>";
     d[5]="<?php echo $deviceUrl[5];?>";
     d[6]="<?php echo $deviceUrl[6];?>";
     d[7]="<?php echo $deviceUrl[7];?>";
     d[8]="<?php echo $deviceUrl[8];?>";
     var u=new Array()
   u[0]="<?php echo $DID[0];?>";
    u[1]="<?php echo $DID[1];?>"; 
    u[2]="<?php echo $DID[2];?>";
     u[3]="<?php echo $DID[3];?>";
     u[4]="<?php echo $DID[4];?>";
     u[5]="<?php echo $DID[5];?>";
     u[6]="<?php echo $DID[6];?>";
     u[7]="<?php echo $DID[7];?>";
     u[8]="<?php echo $DID[8];?>";
     
        for(var i=1;i<n;i++){
         var li = document.createElement('li');
          
          var a = document.createElement('a');
             a.setAttribute('href',d[i]+"/?openid="+open+"&deviceID="+device+"&DID="+u[i]);
         a.id = "ids_"+i;
            a.innerHTML = r[i];
        li.appendChild(a);
        ul.appendChild(li);

    }
}
    window.onload=addli();
</script>
</body>
</html>
