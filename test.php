<?php

     $mysql_host = SAE_MYSQL_HOST_M;
     $mysql_host_s = SAE_MYSQL_HOST_S;
     $mysql_port = SAE_MYSQL_PORT;
     $mysql_user = SAE_MYSQL_USER;
     $mysql_password = SAE_MYSQL_PASS;
     $mysql_database = SAE_MYSQL_DB;
     $keyword=dev0; 
    
	$mysql_table = "deviceStatus";
//    $mysql_state = "SELECT * FROM ".$mysql_table." WHERE `device` = '".$keyword."'";
    $mysql_state="UPDATE deviceStatus SET status = '1' WHERE device ='"."$keyword'";
	$con = @mysql_connect($mysql_host.':'.$mysql_port, $mysql_user, $mysql_password, true);
	if (!$con){
		die('Could not connect: ' . mysql_error());
	}
	mysql_query("SET NAMES 'UTF8'");
	mysql_select_db($mysql_database, $con);
    mysql_query($mysql_state);
//    $deviceStatus = ""; 
//    while($row = mysql_fetch_array($result))
//    {
//        $deviceStatus = $row['status']; 
//        break;
//    }
    mysql_close($con);
//    echo $deviceStatus;
	echo "ok";
   
?>