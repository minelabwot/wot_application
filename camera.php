<?php

$openid = $_GET["openid"];
$deviceid = $_GET["deviceID"];

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<HEAD><TITLE>Smart Camera</TITLE>
		<META charset=utf-8>
		<META name=viewport content="width=device-width, user-scalable=no, initial-scale=1">
    <style  type="text/css">  
    *{padding:0; margin:0; border:0; font-family:"微软雅黑";}
    .nature {
display:block;
width:80px;
height:80px;
text-align:center;
line-height:80px;
color:#FF0;
text-shadow:1px 1px 1px rgba(0,0,0,0.3);
cursor:pointer;
position:relative;
-moz-border-radius:50%;
-ms-border-radius:50%;
-webkit-border-radius:50%;
border-radius:50%;
margin:0 auto;
background:  -webkit-linear-gradient(#F90, #F93); /* 标准的语法 */
box-shadow:2px 3px 8px #999;
     font-size:18px;
    z-index:1;
   
}
    
a {
color:#0000FF; text-decoration:none;
}
	</style>
    
    
    <!--下面js函数为前端向服务端发送指令的代码）-->
    
    <script  type="text/javascript">
       
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
		
        function send() {
			sessionStorage.openid="<?php echo $openid;?>";
			 sessionStorage.deviceid="<?php echo $deviceid;?>";
            sessionStorage.devicetype="<?php echo $devicetype;?>";
			 var open=sessionStorage.openid;
 			 var device=sessionStorage.deviceid;  
                    XMLHttpRequest = createXMLHttpRequest(); //获得XMLHttpRequest对象
            XMLHttpRequest.onreadystatechange=stateChanged;  //ajax返回后的回调函数
            XMLHttpRequest.open("POST", "http://lixiaopengtest.sinaapp.com/index.php/?MWID="+device+"&deviceType=camera&command=on", false); //get方式发送  建议第二个参数为true 异步方式！ 
            XMLHttpRequest.setRequestHeader("Content-Type","text/plain;charset=UTE-8");
            XMLHttpRequest.send("deviceID="+sessionStorage.deviceid); 
        } 
         
     //回调函数    
        function stateChanged() { 
			 if (XMLHttpRequest.readyState === 4 || XMLHttpRequest.status === 200) {	  
	            var display = XMLHttpRequest.responseText; //服务端返回值
    	    
        	} 
        }


</script>
<style  type="text/css">
<!-- 
body{ text-align:center;margin:120px} 
--> 
    .kaitou{
        font-size:25px;
        margin:120px auto 0;
</style>
</HEAD>
    <h class="kaitou">Welcome To Use Camera</h><br/><br/>
<body background="http://1.lixiaopengtest.sinaapp.com/css/eg_background.jpg">
 <iframe id="id_iframe" name="id_iframe" style="display:none;"></iframe>
<form id="formid1" >
<input type="image" src="http://www.jitu5.com/uploads/allimg/140610/260398-140610163P966.jpg"  style="width:100px; height:100px" alt="" onclick="send()"/>
</form>
    
    <br/><br/>

    <div class="nature"> <a href="http://1.lixiaopengtest.sinaapp.com/oauth2_openid.php/?openid="+open>Back</a></div>
   
</body>
</html>