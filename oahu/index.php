<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="initial-scale=1, maximum-scale=1, user-scalable=no">
<title>Get started with MapView - Create a 2D map</title>
<style>
  html, body, #viewDiv {
    padding: 0;
    margin: 0;
    height: 100%;
    width: 100%;
  }
</style>
<link rel="stylesheet" href="https://js.arcgis.com/4.4/esri/css/main.css">
<script src="https://js.arcgis.com/4.4/"></script>
<script>
require([
  "esri/Map",
  "esri/views/MapView",
  "esri/Graphic",
  "esri/geometry/Multipoint",
  "esri/geometry/Point",
  "esri/symbols/SimpleMarkerSymbol",
  "dojo/domReady!"
], function(Map, MapView,Graphic,Multipoint,Point,SimpleMarkerSymbol){
  var map = new Map({
    basemap: "streets"
  });
  var view = new MapView({
    container: "viewDiv",  // Reference to the scene div created in step 5
    map: map,  // Reference to the map object created before the scene
    zoom: 11,  // Sets zoom level based on level of detail (LOD)
    //oahu 21.4840151,-158.1056578,11
    center: [-158.1056578, 21.4840151]  // Sets center point of view using longitude,latitude
  });
  var mp =new Multipoint({});
  var markerSymbol = new SimpleMarkerSymbol({
        color: [255, 255, 255],
        outline: { // autocasts as new SimpleLineSymbol()
          color: [0, 0, 0],
          width: 0.5
        }
  });
  var marker=[];
  var point=[];
  var pointGraphic =[];
  var lineAtt = [];

  <?php
  include('../_global.php');


    $sqlSelect = "SELECT * FROM testresult";
    $rid =[];
    $longitude=[];
    $latitude=[];
    $ds =[];
    $us =[];
    $ISP =[];
    
    $sqlTable = mysql_query($sqlSelect, $conn) or die("Couldn't perform query $sqlSelect (".__LINE__."): " . mysql_error() . '.');
    while($sqlRecord = mysql_fetch_assoc($sqlTable)) {
        array_push($longitude,$sqlRecord['latitude']);
        array_push($latitude,$sqlRecord['longitude']);
        array_push($rid,$sqlRecord['rid']);
        array_push($ds,$sqlRecord['download_speed']);
        array_push($us,$sqlRecord['upload_speed']);
        array_push($ISP,$sqlRecord['ISP']);
    }
    $arrlength = count($rid);
    for ($i = 0; $i<$arrlength; $i++) {
        //echo $i;
        //output as js 
        echo "marker[";
        echo $i;
        if($ds[$i]>1 && $us[$i]>1){
            echo '] = new SimpleMarkerSymbol({color: [255, 255, 0],size: "13px", outline: {color: [255, 0, 255],width: 0.5}});';
        }
        else{
            echo '] = new SimpleMarkerSymbol({color: [0, 0, 0],size: "15px", outline: {color: [255, 255, 255],width: 0.5}});';
        }
        echo "//
        ";
        echo "lineAtt = {rid: ";
        echo $rid[$i];
        echo ',downloadSpeed:';
        echo $ds[$i];
        echo ',';
        echo 'uploadSpeed:';
        echo $us[$i];
        echo ',Provider: "';
        echo $ISP[$i];
        echo '"';
        echo '};';
        echo "//
        ";
        echo "point[";
        echo $i;
        echo "] = new Point({longitude: ";
        echo $longitude[$i];
        echo ",latitude: ";
        echo $latitude[$i];
        echo ",});";
        echo "//
        ";
        echo "pointGraphic[";
        echo $i;
        echo "] = new Graphic({geometry: point[";
        echo $i;
        echo "],symbol: marker[";
        echo $i;
        echo "],attributes: lineAtt,
                popupTemplate: {";
        echo 'title: "{rid}", content: [{type: "fields", fieldInfos: [{fieldName: "rid"},{fieldName: "Provider"}, {fieldName: "downloadSpeed"}, {fieldName: "uploadSpeed"}]}]';        
        echo "}";
        echo "});";
        echo "//
        ";
    }
    /*
 for(i = 0; i < length; i++)
 //for (i in getpoints) 
 {
    point[i] = new Point({
        longitude: longitude[i],
        latitude: latitude[i],
    });
    
    //console.log(getpoints[i].longitude +" abc");
    /*var lineAtt = {
        Name: "Keystone Pipeline",
        Owner: "TransCanada",
        Length: "3,456 km"
    };
  
    pointGraphic[i] = new Graphic({
        geometry: point[i],
        symbol: markerSymbol,
        //attributes: lineAtt,
        popupTemplate: {
        }
    });
 }';*/
 ?>
  view.graphics.addMany(pointGraphic);
});
</script>
</head>
<body>
  <div id="viewDiv"></div>
</body>
</html>
