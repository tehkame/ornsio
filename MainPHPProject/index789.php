
<!DOCTYPE html>
<html>
<head>
    <title>Leaflet.heat demo</title>
    <link rel="stylesheet" href="http://cdn.leafletjs.com/leaflet/v0.7.7/leaflet.css" />
    <script src="http://cdn.leafletjs.com/leaflet/v0.7.7/leaflet.js"></script>
    <script src="leaflet-panel-layers.js"></script>
    <style>
        #map { width: 800px; height: 600px; }
        body { font: 16px/1.4 "Helvetica Neue", Arial, sans-serif; }
        .ghbtns { position: relative; top: 4px; margin-left: 5px; }
        a { color: #0077ff; }
    </style>
</head>
<body>

<p>
    A 10,000-point demo of <a href="https://github.com/Leaflet/Leaflet.heat">Leaflet.heat</a>, a tiny and fast Leaflet heatmap plugin.
    <iframe class="ghbtns" src="http://ghbtns.com/github-btn.html?user=Leaflet&amp;repo=Leaflet.heat&amp;type=watch&amp;count=true"
  allowtransparency="true" frameborder="0" scrolling="0" width="90" height="20"></iframe>
</p>

<div id="map"></div>

<!-- <script src="../node_modules/simpleheat/simpleheat.js"></script>
<script src="../src/HeatLayer.js"></script> -->

<script src="leaflet-heat.js"></script>

<script src="realworld-10000.js"></script>
<script>

var map = L.map('map').setView([-37.87, 175.475], 12);

var tiles = L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png', {
    attribution: '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors',
}).addTo(map);

var heatmap = L.layerGroup();

      //  var baseLayers = [{group: "Base Maps",layers: [{name: "Open Cycle Map",layer: L.tileLayer('http://{s}.tile.opencyclemap.org/cycle/{z}/{x}/{y}.png')},];

     var overLayers = [
            {
            group: "POI Layers",
            layers: [
                {
                    active: true,
                    name: 'Heatmap',
                    layer: heatmap,
                },
            ]
        }

    ];

var panelLayers = new L.Control.PanelLayers("", overLayers);

 map.addControl(panelLayers);

//addressPoints = addressPoints.map(function (p) { return [p[0], p[1]]; });

var heat = L.heatLayer(addressPoints).addTo(heatmap);

</script>
</body>
</html>