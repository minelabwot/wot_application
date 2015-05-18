<?php
$MWID=$_GET['MWID'];
$RESID=$_GET['RESID'];
//$postStr = $GLOBALS["HTTP_RAW_POST_DATA"];
//if (!empty($postStr)){
// $postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
//           $deviceid= $postObj->MWID;
//            $DID= $postObj->RESID;
//            $data=$postObj->data;
            
//        }
//$deviceid=$_POST[MWID];
//$DID=$_POST[RESID];
$data = $GLOBALS[HTTP_RAW_POST_DATA];//得到post过来的二进制原始数据  
if(empty($data)){   
 $data=file_get_contents("php://input");  
} 
//$deviceid=12;
//$DID=123;
//$data=0;
updateSql($MWID,$RESID,$data);
function updateSql($deviceid,$DID,$data){
     $mysql_host = SAE_MYSQL_HOST_M;
     $mysql_host_s = SAE_MYSQL_HOST_S;
     $mysql_port = SAE_MYSQL_PORT;
     $mysql_user = SAE_MYSQL_USER;
     $mysql_password = SAE_MYSQL_PASS;
     $mysql_database = SAE_MYSQL_DB;
   

	$mysql_table = "image";
    
    
	$con = @mysql_connect($mysql_host.':'.$mysql_port, $mysql_user, $mysql_password, true);
	if (!$con){
		die('Could not connect: ' . mysql_error());
	}
	mysql_query("SET NAMES 'UTF8'");
	mysql_select_db($mysql_database, $con);
    //$deviceNum=count($deviceList);
    //for($x=0;$x<$deviceNum;$x++){
        $mysql_state = "SELECT * FROM `".$mysql_table."` WHERE `MWID` LIKE  '".$deviceid."'AND `RESID` LIKE '".$DID[$x]."'LIMIT 0 , 1";
        $result = mysql_query($mysql_state);
        
        if(mysql_num_rows($result) ===0){
           
            $mysql_state= "INSERT INTO  `".$mysql_table."` (`MWID`,`RESID`,`IMAGE`) VALUES ('".$deviceid."','".$DID."','".$data."')";
            $result = mysql_query($mysql_state);
         }  
    else{
        $mysql_state = "UPDATE image SET IMAGE = '".$data."' WHERE MWID ='"."$deviceid' AND RESID='".$DID."'";
        $result = mysql_query($mysql_state);
    }
    //}
    mysql_close($con);
}
?>