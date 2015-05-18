<?php
$deviceid=$_GET[MWID];
$DID=$_GET[DID];
//$deviceid="MWID";
//$DID="DID";
$data=readSql($deviceid,$DID);
//echo base64_encode($data);
echo $data;
//echo "ok";

function readSql($deviceid,$DID){
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
    
    
    $mysql_state = "SELECT * FROM `".$mysql_table."` WHERE `MWID` LIKE  '".$deviceid."'AND `RESID` LIKE '".$DID."'";
    $result = mysql_query($mysql_state);
    $row = mysql_fetch_array($result);
    $data = $row['IMAGE'];    
        
    mysql_close($con);
    return $data;
	

}
?>