<?php

include('_global.php');


$sqlSelect = "SELECT * FROM testresult";
$rid =[];
$longitude=[];
$latitude=[];
$sqlTable = mysql_query($sqlSelect, $conn) or die("Couldn't perform query $sqlSelect (".__LINE__."): " . mysql_error() . '.');
while($sqlRecord = mysql_fetch_assoc($sqlTable)) {
    array_push($longitude,$sqlRecord['longitude']);
    array_push($latitude,$sqlRecord['latitude']);
    array_push($rid,$sqlRecord['rid']);
}
$length = count($longitude);
/*
for ($x = 0; $x <= $length; $x++) {
    echo json_encode(["latitude" => $longitude[$x],"longitude" => $latitude[$x],"rid" =>$rid[$x]]);
}
*/
    echo json_encode(["latitude" =>$longitude,"longitude" => $latitude,"rid" =>$rid]);
    //georss format
    /*
    echo  htmlspecialchars('<?xml version="1.0" encoding="UTF-8"?> <kml xmlns="http://www.opengis.net/kml/2.2"> <Placemark>');
    echo htmlspecialchars("<name>Simple placemark</name>");
    echo htmlspecialchars("<Point>");
    echo htmlspecialchars("<coordinates>");
    
    echo "20.4589815, -158.6262926, 0";
    
    echo htmlspecialchars("</coordinates>");
    echo htmlspecialchars("</Point>");
    echo htmlspecialchars("</Placemark> </kml>");
    */

   /* foreach ($longitude as $value) {
        echo json_encode(["longitude" => $value]);
    }
    foreach ($latitude as $value) {
        echo json_encode(["latitude" => $value]);
    }*/


?>