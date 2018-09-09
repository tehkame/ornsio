
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd"> 
<html xmlns="http://www.w3.org/1999/xhtml"> 
<head> 
<title>Leaflet Panel Layers</title> 
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 

<link rel="stylesheet" href="leaflet-panel-layers.css" />
<link rel="stylesheet" href="style.css" />
    <?php 
    require_once("Connection/MySqlConnection.php"); 
    $conn = new MySqlConnection();
    
    ?>
</head>

<body>
<h3><a href="../"><big>◄</big> Leaflet Panel Layers</a></h3>
<h4> Groups Example: multiple groups of layers</h4>
<br />
<div id="map"></div>

<div id="copy"><a href="http://labs.easyblog.it/">Labs</a> &bull; <a rel="author" href="http://labs.easyblog.it/stefano-cudini/">Stefano Cudini</a></div>

<a href="https://github.com/stefanocudini/leaflet-panel-layers"><img id="ribbon" src="https://s3.amazonaws.com/github/ribbons/forkme_right_darkblue_121621.png" alt="Fork me on GitHub"></a>


    <link rel="stylesheet" href="http://cdn.leafletjs.com/leaflet-0.7.3/leaflet.css" />
<script src="http://cdn.leafletjs.com/leaflet-0.7.3/leaflet.js"></script>
<script src="leaflet-panel-layers.js"></script>
<!-- GEOJSON DATA -->
<script src="bar.js"></script>
<script src="drinking_water.js"></script>
<script>

var map = L.map('map', {
		zoom: 11,
		center: L.latLng([42.4918,12.4992]),		
		attributionControl: false,		
		maxBounds: L.latLngBounds([[42.41281,12.28821],[42.5589,12.63805]]).pad(0.5)
	}),
	osmLayer = new L.TileLayer('http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png');

map.addLayer(osmLayer);

var baseLayers = [
	{
		name: "Open Street Map",
		layer: osmLayer
	},
	{
		name: "Hiking",
		layer: L.tileLayer("http://toolserver.org/tiles/hikebike/{z}/{x}/{y}.png")
	},	
	{
		group: "Road Layers",
		layers: [
			{
				name: "Open Cycle Map",
				layer: L.tileLayer('http://{s}.tile.opencyclemap.org/cycle/{z}/{x}/{y}.png')
			},
			{
				name: "Transports",
				layer: L.tileLayer('http://{s}.tile2.opencyclemap.org/transport/{z}/{x}/{y}.png')
			}
		]
	}
    ];


    
    var cities = L.layerGroup([
                                <?php
            $toilets = $conn ->SelectTable("points","1");
            while($row = $toilets->fetch_assoc())
            {
                $lat = $row["lat"]; $lng = $row["lng"]; $name = $row["name"]; $id = $row["id"];
                $out = $out."L.marker([$lat, $lng]).bindPopup('".str_replace("'","\'",$name)."'),";
            }
            echo rtrim($out,",");
        ?>
        //L.marker([39.61, -105.02]).bindPopup('This is Littleton, CO.'),
        //L.marker([39.74, -104.99]).bindPopup('This is Denver, CO.'),
        //L.marker([39.73, -104.8]).bindPopup('This is Aurora, CO.'),
        //L.marker([39.77, -105.23]).bindPopup('This is Golden, CO.')
    ]);

    var overLayers = [
        {
            group: "Hiking Layers",
            layers: [
                {
                    name: "Terrain",
                    layer: L.tileLayer('http://toolserver.org/~cmarqu/hill/{z}/{x}/{y}.png')
                }
            ]
        },
        {
            group: "POI Layers",
            layers: [
                {
                    active: true,
                    name: "Bar",
                    icon: '<i class="icon icon-bar"></i>',
                    layer: cities
                },
                {
                    name: "Drinking Water",
                    icon: '<i class="icon icon-drinking_water"></i>',
                    layer: L.geoJson(Drinking_water)
                }
            ]
        }
    
];

var panelLayers = new L.Control.PanelLayers(baseLayers, overLayers);

    map.addControl(panelLayers);
    

</script>
<script type="text/javascript" src="/labs-common.js"></script>

</body>
</html>
