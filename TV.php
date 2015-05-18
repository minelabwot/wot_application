<?php
header("Access-Control-Allow-Origin:*");
$openid = $_GET["openid"];
$deviceid = $_GET["deviceID"];
?>


<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<HEAD><TITLE>Smart TV</TITLE>
		<META charset=utf-8>
		<META name=viewport content="width=device-width, user-scalable=no, initial-scale=1">
    <!--下面的JS函数为指令发送函数-->
		<script type="text/javascript">
   
             var XMLHttpRequest;
             sessionStorage.deviceid="<?php echo $deviceid;?>";
            
  	
 			 var device=sessionStorage.deviceid;
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
		
        function send1() {
			
			
           
            XMLHttpRequest = createXMLHttpRequest(); //获得XMLHttpRequest对象
            XMLHttpRequest.onreadystatechange=stateChanged;  //ajax返回后的回调函数
            XMLHttpRequest.open("GET", "http://lixiaopengtest.sinaapp.com/index.php/?MWID="+device+"&deviceType=tv&command=on", false); //get方式发送  建议第二个参数为true 异步方式！ 
            XMLHttpRequest.send(null); 
        } 
              function send2() {
			sessionStorage.openid="<?php echo $openid;?>";
			 sessionStorage.deviceid="<?php echo $deviceid;?>";
            sessionStorage.DID="<?php echo $DID;?>";
            sessionStorage.devicetype="<?php echo $devicetype;?>";
			 var open=sessionStorage.openid;
 			 var device=sessionStorage.deviceid;
            var DID=sessionStorage.DID;
             XMLHttpRequest = createXMLHttpRequest(); //获得XMLHttpRequest对象
            XMLHttpRequest.onreadystatechange=stateChanged;  //ajax返回后的回调函数
            XMLHttpRequest.open("GET", "http://lixiaopengtest.sinaapp.com/index.php/?MWID="+device+"&deviceType=tv&command=up", false); //get方式发送  建议第二个参数为true 异步方式！ 
            XMLHttpRequest.send(null); 
        } 
              function send3() {
			sessionStorage.openid="<?php echo $openid;?>";
			 sessionStorage.deviceid="<?php echo $deviceid;?>";
            sessionStorage.DID="<?php echo $DID;?>";
            sessionStorage.devicetype="<?php echo $devicetype;?>";
			 var open=sessionStorage.openid;
 			 var device=sessionStorage.deviceid;
            var DID=sessionStorage.DID;
             XMLHttpRequest = createXMLHttpRequest(); //获得XMLHttpRequest对象
            XMLHttpRequest.onreadystatechange=stateChanged;  //ajax返回后的回调函数
            XMLHttpRequest.open("GET", "http://lixiaopengtest.sinaapp.com/index.php/?MWID="+device+"&deviceType=tv&command=left", false); //get方式发送  建议第二个参数为true 异步方式！ 
            XMLHttpRequest.send(null); 
        } 
              function send4() {
			sessionStorage.openid="<?php echo $openid;?>";
			 sessionStorage.deviceid="<?php echo $deviceid;?>";
            sessionStorage.DID="<?php echo $DID;?>";
            sessionStorage.devicetype="<?php echo $devicetype;?>";
			 var open=sessionStorage.openid;
 			 var device=sessionStorage.deviceid;
            var DID=sessionStorage.DID;
             XMLHttpRequest = createXMLHttpRequest(); //获得XMLHttpRequest对象
            XMLHttpRequest.onreadystatechange=stateChanged;  //ajax返回后的回调函数
            XMLHttpRequest.open("GET", "http://lixiaopengtest.sinaapp.com/index.php/?MWID="+device+"&deviceType=tv&command=right", false); //get方式发送  建议第二个参数为true 异步方式！ 
            XMLHttpRequest.send(null); 
        } 
              function send5() {
			sessionStorage.openid="<?php echo $openid;?>";
			 sessionStorage.deviceid="<?php echo $deviceid;?>";
            sessionStorage.DID="<?php echo $DID;?>";
            sessionStorage.devicetype="<?php echo $devicetype;?>";
			 var open=sessionStorage.openid;
 			 var device=sessionStorage.deviceid;
            var DID=sessionStorage.DID;
             XMLHttpRequest = createXMLHttpRequest(); //获得XMLHttpRequest对象
            XMLHttpRequest.onreadystatechange=stateChanged;  //ajax返回后的回调函数
            XMLHttpRequest.open("GET", "http://lixiaopengtest.sinaapp.com/index.php/?MWID="+device+"&deviceType=tv&command=down", false); //get方式发送  建议第二个参数为true 异步方式！ 
            XMLHttpRequest.send(null); 
        } 
  //回调函数    
        function stateChanged() { 
			 if (XMLHttpRequest.readyState === 4 || XMLHttpRequest.status === 200) {	  
	            var display ="deviceID="+device; //服务端返回值
                location.search= "?"+display;
        	} 
        }
  
</script>

<style  type="text/css">
    body{
        background-color:#000;
    }
#big {
            margin: 0 auto;
			width:350px;
        }
form{margin-bottom: 0;}
</style>
    </HEAD>
    
<body>

  <iframe id="id_iframe" name="id_iframe" style="display:none;"></iframe>   
<form id="formid1"   target="id_iframe">
<input type="image" src="http://1.lixiaopengtest.sinaapp.com/imagessrc/stop.jpg" alt="Submit" onclick="send1()"/>
</form>

<div id="big">

<div style="text-align:center">
 
<form id="formid2" target="id_iframe" >
<input type="image" name="top" src="http://1.lixiaopengtest.sinaapp.com/imagessrc/top.jpg" alt="" onclick="send2()"/>
</form>
</div>

<div style="width:350px;">
<form id="formid3" target="id_iframe" style="float:left" >
<input type="image" name="left" src="http://1.lixiaopengtest.sinaapp.com/imagessrc/left.jpg" alt="Submit" onclick="send3()"/>
</form>
<form id="formid4" target="id_iframe" style="float:right;">
<input type="image" name="right" src="http://1.lixiaopengtest.sinaapp.com/imagessrc/right.jpg" alt="Submit" onclick="send4()"/>
</form>
</div>

<div style="text-align:center;clear:both;">
<form id="formid5" target="id_iframe">
<input type="image" name="bottom" src="http://1.lixiaopengtest.sinaapp.com/imagessrc/bottom.jpg" alt="Submit" onclick="send5()"/>
</form>
</div>

</div>
    <div> <a id="o" href="http://1.lixiaopengtest.sinaapp.com/oauth2_openid.php/?openid=123">Back To Device List</a></div>
<script type="text/javascript">
      sessionStorage.openid="<?php echo $openid;?>";  
             var open=sessionStorage.openid;
document.getElementById("o").href="http://1.lixiaopengtest.sinaapp.com/oauth2_openid.php/?openid="+open;
    </script>

    
</body>
<!--<style>
frame{
      frameborder:0;
	  scrolling:no;
	  }
</style>
</HEAD>

<frameset rows="10%,80%,10%">
	<frame frameborder="0" src="header.html" name="a"/>
    <frame frameborder="0" src="pindao.html" name="b"/>
	<frame frameborder="0" src="tail.html" name="c"/>
    <noframes>未显示框架 </noframes>
    </frameset>
<div> <a id="o" href="http://1.lixiaopengtest.sinaapp.com/oauth2_openid.php/?openid=123">Back To Device List</a></div>-->
<script type="text/javascript">
      sessionStorage.openid="<?php echo $openid;?>";  
             var open=sessionStorage.openid;
document.getElementById("o").href="http://1.lixiaopengtest.sinaapp.com/oauth2_openid.php/?openid="+open;
    </script>    
</html>