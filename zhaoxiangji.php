<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head><meta http-equiv="Content-Type" content="text/html" charset="utf-8">
<title>ajaxdemo</title>
<script type="text/javascript" charset="utf-8" src="js/jquery-1.7.1.min.js"></script>
<script type="text/javascript" charset="utf-8">
function onLoad(){
$.ajax({
url: '/images/img1.png',
type:'get',
datatype:'text',
error:function(){
alert("Error");
},
success:function(str,info){
document.getElementById('imgid').src='data:image/png;base64,' + encode64(img);
}
});
}
</script>
</head>
<body onload="onLoad()">
<img id='imgid' src="" />
</body>
</html>