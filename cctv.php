<?php

$openid = $_GET["openid"];
$deviceid = $_GET["deviceID"];
$DID=$_GET["DID"];
?>

<!DOCTYPE html>
<html>
<head>
    <title>摄像头</title>
<meta charset="utf-8">
    <meta http-equiv="refresh" content="8"> <!--刷新时间为8秒-->  
<script src="http://libs.useso.com/js/jquery/1.4.2/jquery.min.js"></script>
  <style  type="text/css">
<!-- 
body{ text-align:center;margin:auto;} 
--> 
 
</style>
 <style  type="text/css">  
    *{padding:10px; margin:0; border:0; font-family:"微软雅黑";}
    .nature {
display:block;
width:120px;
height:120px;
text-align:center;
line-height:120px;
color:#FF0;
text-shadow:10px 10px 10px rgba(0,0,0,0.3);
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
     a{font-size:40px;}
    #img1 
{
border:red solid thin;
outline:double;
}
     #picc{
         width=205px;
         height=500px;
     }
    </style>
    <script>
$(document).ready(function getimg(){
       sessionStorage.openid="<?php echo $openid;?>";
			 sessionStorage.deviceid="<?php echo $deviceid;?>";
        sessionStorage.DID="<?php echo $DID;?>";
			 var open=sessionStorage.openid;
 			 var device=sessionStorage.deviceid; 
        var DID=sessionStorage.DID;
    $.get("http://1.lixiaopengtest.sinaapp.com/getImage.php?MWID="+device+"&DID="+DID,function(data){
        
        //向服务端获取图片base64码
        $("#img1").attr("src","data:image/jpeg;base64,"+data);
        //使用base64码的形式显示图片
   });
});
        //window.setInterval("getimg()",3000);
</script>
    <script language=Javascript> 
 
function showTime()
{
 
  var d = new Date()
  document.getElementById('time').innerHTML=d;
    //显示当前时间
  setTimeout(showTime,1000);
 
}
</script>
</head>
<body onload="showTime()"background="http://1.lixiaopengtest.sinaapp.com/css/eg_background.jpg" >
    <div id="time" style="font-size:45px;"></div>
    <!--<button onclick="location.reload();"><img src="http://img.taopic.com/uploads/allimg/130523/235056-13052300551916.jpg" style="width:100px; height:100px"></button> <br/>-->

    
      
            <div style="border:1px #000000  solid;" id="picc">
               
                    <div style="text-align:center;background-color:#CCCCCC;font-weight:bold;font-size:50px;">摄像头</div> 
                    <div id="pic1" >
                        <img id="img1" src="" style="width:900px; height:1000px"/>    
                    </div>
    </div>   

    <div class="nature"> <a href="http://1.lixiaopengtest.sinaapp.com/oauth2_openid.php//?openid="+open>返回</a></div>  
</body>
</html>
