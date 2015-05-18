<?php

$openid = $_GET["openid"];
$deviceid = $_GET["deviceID"];
$DID=$_GET["DID"];
$url='http://121.42.31.195:9071/WIFPa/ResourceData.xml/'.$deviceid.'?ResourceID='.$DID;
//$url='http://121.42.31.195:9071/WIFPa/ResourceData.xml/00010000607383f6?ResourceID=0';
$rawData=https_request($url);
$postObj = simplexml_load_string($rawData, 'SimpleXMLElement', LIBXML_NOCDATA);
$tmp=$postObj->resvalue;
//echo $tmp;
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
?>

 <!DOCTYPE html
PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
<title>光照</title>
<script src="http://libs.useso.com/js/jquery/1.4.2/jquery.min.js" type="text/javascript"></script>
<script src="js/mobilyblocks.js" type="text/javascript"></script>
    <link rel="stylesheet" type="text/css" href="css/base.css" media="screen">
	<link rel="stylesheet" type="text/css" href="css/button.css" media="screen">
    <link rel="stylesheet" href="http://www.yyyweb.com/demo/common/init.css">		
     <style  type="text/css">  
      body {
    font-family: 'museoslab500';
    text-transform: uppercase;
    background: #333;
    font-size: 75%;
    text-align: center;
    -webkit-user-select: none;
         -o-user-select: none;
            user-select: none;
}
.info {
    margin-top:50px;
}

.info a {
    text-decoration:none;    
    color:#fff;    
    font-size:15px
}

.button {
    min-height: 1.5em;
    display: inline-block;
    padding: 12px 36px;
    margin: 40px 5px 5px 0px;
    cursor: pointer;
    opacity: 0.9;
    
    color: #FFF;
    font-size: 1em;
    letter-spacing: 1px;
    text-shadow: rgba(0,0,0,0.9) 0px 1px 2px;
    
    background: #434343;
    border: 1px solid #242424;
   
    -webkit-border-radius: 4px;
     -khtml-border-radius: 4px;
       -moz-border-radius: 4px;
         -o-border-radius: 4px;
            border-radius: 4px;
    -webkit-box-shadow: rgba(255,255,255,0.25) 0px 1px 0px, inset rgba(255,255,255,0.25) 0px 1px 0px, inset rgba(0,0,0,0.25) 0px 0px 0px, inset rgba(255,255,255,0.03) 0px 20px 0px, inset rgba(0,0,0,0.15) 0px -20px 20px, inset rgba(255,255,255,0.05) 0px 20px 20px;
     -khtml-box-shadow: rgba(255,255,255,0.25) 0px 1px 0px, inset rgba(255,255,255,0.25) 0px 1px 0px, inset rgba(0,0,0,0.25) 0px 0px 0px, inset rgba(255,255,255,0.03) 0px 20px 0px, inset rgba(0,0,0,0.15) 0px -20px 20px, inset rgba(255,255,255,0.05) 0px 20px 20px;
       -moz-box-shadow: rgba(255,255,255,0.25) 0px 1px 0px, inset rgba(255,255,255,0.25) 0px 1px 0px, inset rgba(0,0,0,0.25) 0px 0px 0px, inset rgba(255,255,255,0.03) 0px 20px 0px, inset rgba(0,0,0,0.15) 0px -20px 20px, inset rgba(255,255,255,0.05) 0px 20px 20px;
         -o-box-shadow: rgba(255,255,255,0.25) 0px 1px 0px, inset rgba(255,255,255,0.25) 0px 1px 0px, inset rgba(0,0,0,0.25) 0px 0px 0px, inset rgba(255,255,255,0.03) 0px 20px 0px, inset rgba(0,0,0,0.15) 0px -20px 20px, inset rgba(255,255,255,0.05) 0px 20px 20px;
            box-shadow: rgba(255,255,255,0.25) 0px 1px 0px, inset rgba(255,255,255,0.25) 0px 1px 0px, inset rgba(0,0,0,0.25) 0px 0px 0px, inset rgba(255,255,255,0.03) 0px 20px 0px, inset rgba(0,0,0,0.15) 0px -20px 20px, inset rgba(255,255,255,0.05) 0px 20px 20px;
    -webkit-transition: all 0.1s linear;
     -khtml-transition: all 0.1s linear;
       -moz-transition: all 0.1s linear;
         -o-transition: all 0.1s linear;
            transition: all 0.1s linear;
}
.button:hover {
    -webkit-box-shadow: rgba(0,0,0,0.5) 0px 2px 5px, inset rgba(255,255,255,0.25) 0px 1px 0px, inset rgba(0,0,0,0.25) 0px 0px 0px, inset rgba(255,255,255,0.03) 0px 20px 0px, inset rgba(0,0,0,0.15) 0px -20px 20px, inset rgba(255,255,255,0.05) 0px 20px 20px;
     -khtml-box-shadow: rgba(0,0,0,0.5) 0px 2px 5px, inset rgba(255,255,255,0.25) 0px 1px 0px, inset rgba(0,0,0,0.25) 0px 0px 0px, inset rgba(255,255,255,0.03) 0px 20px 0px, inset rgba(0,0,0,0.15) 0px -20px 20px, inset rgba(255,255,255,0.05) 0px 20px 20px;
       -moz-box-shadow: rgba(0,0,0,0.5) 0px 2px 5px, inset rgba(255,255,255,0.25) 0px 1px 0px, inset rgba(0,0,0,0.25) 0px 0px 0px, inset rgba(255,255,255,0.03) 0px 20px 0px, inset rgba(0,0,0,0.15) 0px -20px 20px, inset rgba(255,255,255,0.05) 0px 20px 20px;
         -o-box-shadow: rgba(0,0,0,0.5) 0px 2px 5px, inset rgba(255,255,255,0.25) 0px 1px 0px, inset rgba(0,0,0,0.25) 0px 0px 0px, inset rgba(255,255,255,0.03) 0px 20px 0px, inset rgba(0,0,0,0.15) 0px -20px 20px, inset rgba(255,255,255,0.05) 0px 20px 20px;
            box-shadow: rgba(0,0,0,0.5) 0px 2px 5px, inset rgba(255,255,255,0.25) 0px 1px 0px, inset rgba(0,0,0,0.25) 0px 0px 0px, inset rgba(255,255,255,0.03) 0px 20px 0px, inset rgba(0,0,0,0.15) 0px -20px 20px, inset rgba(255,255,255,0.05) 0px 20px 20px;
}
.button:active {
    -webkit-box-shadow: rgba(255,255,255,0.25) 0px 1px 0px,inset rgba(255,255,255,0) 0px 1px 0px, inset rgba(0,0,0,0.5) 0px 0px 5px, inset rgba(255,255,255,0.03) 0px 20px 0px, inset rgba(0,0,0,0.15) 0px -20px 20px, inset rgba(255,255,255,0.05) 0px 20px 20px;
     -khtml-box-shadow: rgba(255,255,255,0.25) 0px 1px 0px,inset rgba(255,255,255,0) 0px 1px 0px, inset rgba(0,0,0,0.5) 0px 0px 5px, inset rgba(255,255,255,0.03) 0px 20px 0px, inset rgba(0,0,0,0.15) 0px -20px 20px, inset rgba(255,255,255,0.05) 0px 20px 20px;
       -moz-box-shadow: rgba(255,255,255,0.25) 0px 1px 0px, inset rgba(255,255,255,0) 0px 1px 0px, inset rgba(0,0,0,0.5) 0px 0px 5px, inset rgba(255,255,255,0.03) 0px 20px 0px, inset rgba(0,0,0,0.15) 0px -20px 20px, inset rgba(255,255,255,0.05) 0px 20px 20px;
         -o-box-shadow: rgba(255,255,255,0.25) 0px 1px 0px, inset rgba(255,255,255,0) 0px 1px 0px, inset rgba(0,0,0,0.5) 0px 0px 5px, inset rgba(255,255,255,0.03) 0px 20px 0px, inset rgba(0,0,0,0.15) 0px -20px 20px, inset rgba(255,255,255,0.05) 0px 20px 20px;
            box-shadow: rgba(255,255,255,0.25) 0px 1px 0px, inset rgba(255,255,255,0) 0px 1px 0px, inset rgba(0,0,0,0.5) 0px 0px 5px, inset rgba(255,255,255,0.03) 0px 20px 0px, inset rgba(0,0,0,0.15) 0px -20px 20px, inset rgba(255,255,255,0.05) 0px 20px 20px;
}
.shine {
    display: block;
    position: relative;
    background: -moz-linear-gradient(left, rgba(255,255,255,0) 0%, rgba(255,255,255,1) 50%, rgba(255,255,255,0) 100%);
    background: -webkit-gradient(linear, left top, right top, color-stop(0%,rgba(255,255,255,0)), color-stop(50%,rgba(255,255,255,1)), color-stop(100%,rgba(255,255,255,0)));
    background: -webkit-linear-gradient(left, rgba(255,255,255,0) 0%,rgba(255,255,255,1) 50%,rgba(255,255,255,0) 100%);
    background: -o-linear-gradient(left, rgba(255,255,255,0) 0%,rgba(255,255,255,1) 50%,rgba(255,255,255,0) 100%);
    background: -ms-linear-gradient(left, rgba(255,255,255,0) 0%,rgba(255,255,255,1) 50%,rgba(255,255,255,0) 100%);
    filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#00ffffff', endColorstr='#00ffffff',GradientType=1 );
    background: linear-gradient(left, rgba(255,255,255,0) 0%,rgba(255,255,255,1) 50%,rgba(255,255,255,0) 100%);
    padding: 0px 12px;
    top: -12px;
    left: -24px;
    height: 1px;
    -webkit-box-shadow: rgba(255,255,255,0.2) 0px 1px 5px;
     -khtml-box-shadow: rgba(255,255,255,0.2) 0px 1px 5px;
       -moz-box-shadow: rgba(255,255,255,0.2) 0px 1px 5px;
         -o-box-shadow: rgba(255,255,255,0.2) 0px 1px 5px;
            box-shadow: rgba(255,255,255,0.2) 0px 1px 5px;
    -webkit-transition: all 0.3s ease-in-out;
     -khtml-transition: all 0.3s ease-in-out;
       -moz-transition: all 0.3s ease-in-out;
         -o-transition: all 0.3s ease-in-out;
            transition: all 0.3s ease-in-out;
}
.button:hover .shine {left: 24px;}
.button:active .shine {opacity: 0;}

.button.gray {background: #555;}
.button.blue {background: #3a617e;}
     
    .nature {
display:block;
width:250px;
height:80px;
text-align:center;
line-height:80px;
color:#F60;
text-shadow:1px 1px 1px rgba(0,0,0,0.3);
cursor:pointer;
position:relative;
margin:0 auto;
background:  -webkit-linear-gradient(#F7F7F7, #DBDBDB); /* 标准的语法 */
box-shadow:2px 3px 8px #999;
     font-size:18px;
    z-index:1;
   
}
    
a {
color:#0000FF; text-decoration:none;
}
    </style>
 
</head>
<body style="margin-top:25px">
 <div class="button blue"  onclick="location.reload();" ><div class="shine"></div>刷新</div> <br/><br/> <br/>
    </body>


    <body>
    
    <div  class="nature" id="t0">
       <span id="t1"></span>
    </div>
    <div  class="nature" id="d0">
        当前的光照为：<span id="d1"></span>勒克斯
    </div>
        <script  type="text/javascript">
        function showTime()
{
 
  var d = new Date()
  document.getElementById('t1').innerHTML=d;
  setTimeout(showTime,1000);
 
}
      window.onload=showTime();      
               </script> 
   <script  type="text/javascript">
      function wendu(){
       sessionStorage.temp="<?php echo $tmp;?>";
      document.getElementById("d1").innerHTML=sessionStorage.temp;     
      }//光照获取函数
          window.onload=wendu();
        </script>      
     <div class="nature"> <a href="http://1.lixiaopengtest.sinaapp.com/oauth2_openid.php">返回我的设备</a></div> 
</body>
      
</html>

