<?php

$openid = $_GET["openid"];
$deviceid = $_GET["deviceID"];

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<HEAD><TITLE>智能照相机</TITLE>
		<META charset=utf-8>
		<META name=viewport content="width=device-width, user-scalable=no, initial-scale=1">
    <script src="http://libs.useso.com/js/jquery/1.4.2/jquery.min.js"></script>
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
  
       
 <script>
function send(){
    
     
			 sessionStorage.deviceid="<?php echo $deviceid;?>";
     
			 
 			 var device=sessionStorage.deviceid; 
       
    $.get("http://lixiaopengtest.sinaapp.com/index.php/?MWID="+device+"&deviceType=camera&command=on")
          //document.getElementById("d1").innerHTML=data;
        
        //alert("\n状态：" + status);

});

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
    <h class="kaitou">欢迎使用照相机</h><br/><br/>
<body background="http://www.w3school.com.cn/i/eg_background.jpg">
 <iframe id="id_iframe" name="id_iframe" style="display:none;"></iframe>
<form id="formid1" >
<input type="image" src="http://www.jitu5.com/uploads/allimg/140610/260398-140610163P966.jpg"  style="width:100px; height:100px" alt="" onclick="send()"/>
</form>
    
    <br/><br/>

    <div class="nature"> <a href="http://1.lixiaopengtest.sinaapp.com/oauth2_openid.php">返回</a></div>
   
</body>
</html>