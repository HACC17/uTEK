<?php

include('_global.php');


$sqlSelect = "SELECT AVG(download_speed) AS avgds,AVG(upload_speed) AS avgus FROM testresult WHERE download_speed >0 AND upload_speed >0";
$avgds;
$avgus;
$sqlTable = mysql_query($sqlSelect, $conn) or die("Couldn't perform query $sqlSelect (".__LINE__."): " . mysql_error() . '.');
while($sqlRecord = mysql_fetch_assoc($sqlTable)) {
    $avgds = $sqlRecord['avgds'];
    $avgus = $sqlRecord['avgus'];
}
echo $avgds;
echo $avgus;
?>