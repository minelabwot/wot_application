<?php
$MWID="1234567890abcd01";
//$deviceListUrl="http://www.cloudsensing.cn:9071/WIFPa/MWAttribute/"."$MWID".".xml";
$deviceListUrl="http://www.cloudsensing.cn:9071/WIFPa/GatewayGWDevicelist.xml/"."$MWID"."?lang=zh";
$deviceListXml=https_request($deviceListUrl);
//echo $deviceListXml;
$postObj = simplexml_load_string($deviceListXml, 'SimpleXMLElement', LIBXML_NOCDATA);
//echo $postObj->AttrEditions->Attribute->DevicesList->Device->DevInfo->Type;
//$tmp=$postObj->AttrEditions->Attribute->DevicesList;
foreach($postObj->children() as $child)
{
    //echo $child->DevInfo->Name;
    echo $child['DID'];
    echo " ";
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