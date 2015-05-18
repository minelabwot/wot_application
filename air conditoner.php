<!Doctype Html>
<html>
<head>
        <title>Light Control</title>
		<meta http-equiv="Content-Type" content="text/html;charset=UTF-8"/>
        <link rel="stylesheet" type="text/css" href="http://1.lixiaopengtest.sinaapp.com/css/button2.css">
        <script id="allmobilize" charset="utf-8" src="http://a.yunshipei.com/353f49a64bc882918ddef00b32872e96 /allmobilize.min.js"></script><meta http-equiv="Cache-Control" content="no-siteapp" /><link rel="alternate" media="handheld" href="#" />
<style>
body{
    background-color:#000;
	}
h1{
 text-align:center;
 color:white;
}
p{
     font-size:100px;
	 text-align:center;
	 color:white;
	 }
}
.color{
     height:600px;
}

.pdtop{
      position:absolute;
	  top:200px;
	  left:100px;
}
.pddown{
      position:absolute;
	  top:400px;
	  left:100px;
}
.pdmiddle{
      position:absolute;
	  top:280px;
	  left:50px;
	  font-size:50px;
	  color:white;
}
.rtop{
      position:absolute;
	  top:200px;
	  right:100px;
}
.rdown{
      position:absolute;
	  top:400px;
	  right:100px;
}
.rmiddle{
      position:absolute;
	  top:280px;
	  right:100px;
	  font-size:50px;
	  color:white;
}
#b{
        text-align:center;
        font-size:30px;
    }


</style>


</head>

<body id="color">
<div>
<h1>空调</h1>
<iframe id="id_iframe" name="id_iframe" style="display:none;"></iframe>   
<form id="formid1"   target="id_iframe">
<input type="image" src="imagessrc/mute.png" alt="Submit"/>
</form>

<input class="pdtop" type="image"  src="imagessrc/cir_top1.png" onclick="add()"/>
<p class="pdmiddle">Temperature</p>
<input class="pddown" type="image"  src="imagessrc/cir_bottom1.png"onclick="decrease()"/>

<div>
<p><span id="dl"></span>°C</p>
</div>

<input class="rtop" type="image"  src="imagessrc/cir_top1.png" onclick="cold()"/>
<p class="rmiddle">Mode</p>
<input class="rdown" type="image"  src="imagessrc/cir_bottom1.png"onclick="warm()"/>
</div>
 <div id="b">
     <a href="http://1.lixiaopengtest.sinaapp.com/oauth2_openid.php/?openid=" class="button green">返回</a>
</div>
  
<script>
var b=25;
document.getElementById("dl").innerHTML=b;
function add()
{
b++;
document.getElementById("dl").innerHTML=b;
}
function decrease()
{
b--;
document.getElementById("dl").innerHTML=b;
}
function cold()
{
document.getElementById("color").style.background="blue";
}
function warm()
{
document.getElementById("color").style.background="red";
}
</script>
</body>
</html>