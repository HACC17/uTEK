<?php

include('_global.php');

$rid=$_REQUEST['rid'];

$sqlSelect = "SELECT * FROM testresult WHERE rid=$rid";

$sqlTable = mysql_query($sqlSelect, $conn) or die("Couldn't perform query $sqlSelect (".__LINE__."): " . mysql_error() . '.');
while($sqlRecord = mysql_fetch_assoc($sqlTable)) {
  echo json_encode(["date"=> $sqlRecord['date'], 
                    "download_speed"=>$sqlRecord['download_speed'],
                    "upload_speed" => $sqlRecord['upload_speed'],
                    "date" => $sqlRecord['date'],
                    "ISP" => $sqlRecord['ISP'],
                    "ipAddress" => $sqlRecord['ipaddress'],
                    "latency" => $sqlRecord['latency'],
                    "device" => $sqlRecord['device'],
                    "connection_type" => $sqlRecord['connection_type'],
                    "application_used" => $sqlRecord['application_used'],
                    "URCT" => $sqlRecord['URCT'],
                    "no_internet" => $sqlRecord['no_internet'],
                    "comments" => $sqlRecord['comments'],
                    "rid" => $sqlRecord['rid']]);  
}

?>