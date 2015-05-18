<?php
function post($MWID,$devicetype,$command){                                           //后续加上参数：设备和指令，组成content
$url="http://www.cloudsensing.cn:9071/WIFPa/extension";
    //  $MWID="000100006d735650";
    $MWID="00010000607383f6";
    // $MWID="000100004cf20fdb";  
    //$content="0#1";
$time=date("H:i:s",time());
    
//$time=date("Y-m-d H:i:s",time());
//$date=date("Y-m-d",time());
//$t="$dateT$time";

    $content=$devicetype."#".$command;
    //$content="camera#on";
$data="  <Extension>
           <Target>$MWID</Target>
           <Type>command</Type>
           <Content>$content</Content>
           <Time>$time</Time>
         </Extension>";


$ch = curl_init();
$header[] = "Content-type: text/xml";//定义content-type为xml
curl_setopt($ch, CURLOPT_URL, $url); //定义表单提交地址
curl_setopt($ch, CURLOPT_POST, 1);   //定义提交类型 1：POST ；0：GET
curl_setopt($ch, CURLOPT_HEADER, 1); //定义是否显示状态头 1：显示 ； 0：不显示
curl_setopt($ch, CURLOPT_HTTPHEADER, $header);//定义请求类型
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 0);//定义是否直接输出返回流
curl_setopt($ch, CURLOPT_POSTFIELDS, $data); //定义提交的数据，这里是XML文件
$output=curl_exec($ch);
curl_close($ch);//关闭
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
?>