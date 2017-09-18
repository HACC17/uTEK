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
    zoom: 8,  // Sets zoom level based on level of detail (LOD)
    center: [-158.6261371, 20.4563893]  // Sets center point of view using longitude,latitude
  });
  var mp =new Multipoint({});
  mp.points = [[-157.92505,21.64797]];
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

  <?php
  include('_global.php');


    $sqlSelect = "SELECT * FROM testresult";
    $rid =[];
    $longitude=[];
    $latitude=[];
    $sqlTable = mysql_query($sqlSelect, $conn) or die("Couldn't perform query $sqlSelect (".__LINE__."): " . mysql_error() . '.');
    while($sqlRecord = mysql_fetch_assoc($sqlTable)) {
        array_push($longitude,$sqlRecord['latitude']);
        array_push($latitude,$sqlRecord['longitude']);
        array_push($rid,$sqlRecord['rid']);
    }
    $arrlength = count($rid);
    for ($i = 0; $i<$arrlength; $i++) {
        //echo $i;
        //output as js 
        echo "marker[";
        echo $i;
        echo "] = new SimpleMarkerSymbol({color: [100, 255, 255], outline: {color: [0, 0, 0],width: 0.5}});";
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
        echo "],symbol: markerSymbol,
                //attributes: lineAtt,
                popupTemplate: {}";
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