<!Doctype Html>
<html>
<head>
        <title>TV Remote Control</title>
		<meta http-equiv="Content-Type" content="text/html;charset=UTF-8"/>
       <link rel="stylesheet" type="text/css" href="http://1.lixiaopengtest.sinaapp.com/css/button2.css">
<style>
body{
    background-color:#000;
	text-align:center;
	}
#b
    {
        font-size:30px;
    }

</style>
<script type="text/javascript">
var a=1;
function lightcontrol()
{
a++;
if(a%2==0)
{
    document.getElementById('myimage').src="imagessrc/on.jpg";
}
else
{
    document.getElementById('myimage').src="imagessrc/off.jpg";
}
}
</script>  
</head>
<body> 
    <br/><br/><br/>
    <img id="myimage" src="imagessrc/off.jpg" onclick="lightcontrol()"/>
    <br/><br/><br/>
    <div id="b">
     <a href="http://1.lixiaopengtest.sinaapp.com/oauth2_openid.php/?openid=" class="button gray">返回</a>
    </div>
</body>
</html>
    