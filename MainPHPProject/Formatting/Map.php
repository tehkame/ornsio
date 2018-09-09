<?php
//yjhguy
/**
 * Map short summary.
 *
 * Map description.
 *
 * @version 1.0
 * @author kruupy
 */
class Map
{
    private $PanelLayers;

    function __construct($panellayers=null)
    {
        $this->PanelLayers = $panellayers;
    }

    function microtime_float()
    {
        list($usec, $sec) = explode(" ", microtime());
        return ((float)$usec + (float)$sec);
    }

    public function InsertMap($divid, $lat, $long,$heatdata)
    {
        echo' <div id="mapid"></div>';
        echo '<script>'
        .'var mymap = L.map(\''.$divid.'\').setView(['.$lat.', '.$long.'], 13);'
	    .'var streets = L.tileLayer(\'https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}\', {'
		.'maxZoom: 18,'
		.'attribution: \'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, \' +'
		.'	\'<a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, \' +'
		.'	\'Imagery © <a href="https://www.mapbox.com/">Mapbox</a>\','
		.'id: \'mapbox.streets\''
	.'}).addTo(mymap);'


    .'var toilet_icon = L.icon({iconUrl: \'img/toilets.png\',iconSize:     [32, 37], iconAnchor:   [16,37], popupAnchor:  [0, 0] });'
    .'var hazard_icon = L.icon({iconUrl: \'img/hazard.png\',iconSize:     [32, 37], iconAnchor:   [16,37], popupAnchor:  [0, 0] });'
    .'var question_icon = L.icon({iconUrl: \'img/question.png\',iconSize:     [32, 37], iconAnchor:   [16,37], popupAnchor:  [0, 0] });'
    .'var comment_icon = L.icon({iconUrl: \'img/comment.png\',iconSize:     [32, 37], iconAnchor:   [16,37], popupAnchor:  [0, 0] });'
        .'var animal_icon = L.icon({iconUrl: \'img/animal.png\',iconSize:     [32, 37], iconAnchor:   [16,37], popupAnchor:  [0, 0] });'
        .'var art_icon = L.icon({iconUrl: \'img/art.png\',iconSize:     [32, 37], iconAnchor:   [16,37], popupAnchor:  [0, 0] });'
        .'var fountain_icon = L.icon({iconUrl: \'img/fountain.png\',iconSize:     [32, 37], iconAnchor:   [16,37], popupAnchor:  [0, 0] });'
        .'var playground_icon = L.icon({iconUrl: \'img/playground.png\',iconSize:     [32, 37], iconAnchor:   [16,37], popupAnchor:  [0, 0] });'
        .'var parking_icon = L.icon({iconUrl: \'img/parking.png\',iconSize:     [32, 37], iconAnchor:   [16,37], popupAnchor:  [0, 0] });'

        .'var toilets = L.layerGroup();'
        .'var fountains = L.layerGroup();'
        .'var hazards = L.layerGroup();'
        .'var questions = L.layerGroup();'
        .'var comments = L.layerGroup();'

       .'var carparks = L.layerGroup();'
       .'var animals = L.layerGroup();'
       .'var playground = L.layerGroup();'
       .'var art = L.layerGroup();'

        .'var heatmap = L.layerGroup();'

       // .'mymap.addLayer(toilets);'
       // .'mymap.addLayer(fountains);'
       // .'mymap.addLayer(hazards);'
       // .'mymap.addLayer(questions);'
       // .'mymap.addLayer(comments);'



        //.'var overlays = {"Toilets": toilets,"Fountains": fountains,"Hazards": hazards,"Questions": questions,"Comments": comments};'
        // .'var baseMaps = {"Streets": streets};'
        //.'var baseMaps = [{group: "Road Layers",layers: [{name: "Open Cycle Map",layer: streets)},]}];'

        .'var baseLayers = [{group: "Base Maps",layers: [{name: "Open Cycle Map",layer: L.tileLayer(\'http://{s}.tile.opencyclemap.org/cycle/{z}/{x}/{y}.png\')},
            {
            active: false,
            name: "Transports",
            layer: L.tileLayer(\'http://{s}.tile2.opencyclemap.org/transport/{z}/{x}/{y}.png\')
            },
            {
            active: true,
            name: "Satellite",
            layer: L.tileLayer(\'https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}\')
            },
        ]
       }
];'

     .'var overLayers = [{
            group: "POI Layers",
            layers: [
                {
                    active: true,
                    name: \'<center>Toilets</center>\',
                    icon: \'<i class="icon icon-toilet"></i>\',
                    layer: toilets
                },
                {
                    active: true,
                    name: \'<center>Fountains</center>\',
                    icon: \'<i class="icon icon-fountain"></i>\',
                    layer: fountains
                },
                {
                    active: true,
                    name: \'<center>Hazards</center>\',
                    icon: \'<i class="icon icon-hazard"></i>\',
                    layer: hazards
                },
                {
                    active: true,
                    name: \'<center>Questions</center>\',
                    icon: \'<i class="icon icon-question"></i>\',
                    layer: questions
                },
                {
                    active: true,
                    name: \'<center>Comments</center>\',
                    icon: \'<i class="icon icon-comment"></i>\',
                    layer: comments
                },
                {
                    active: true,
                    name: \'<center>Carparks</center>\',
                    icon: \'<i class="icon icon-parking"></i>\',
                    layer: carparks
                },
                   {
                    active: true,
                    name: \'Animal Exercise\',
                    icon: \'<i class="icon icon-animal"></i>\',
                    layer: animals
                },
                   {
                    active: true,
                    name: \'<center>Playground</center>\',
                    icon: \'<i class="icon icon-playground"></i>\',
                    layer: playground
                },
                {
                    active: false,
                    name: \'<center>Art</center>\',
                    icon: \'<i class="icon icon-art"></i>\',
                    layer: art
                },
                {
                    active: false,
                    name: \'<center>Heatmap</center>\',
                    icon: \'<i class="icon icon-heat"></i>\',
                    layer: heatmap
                },
            ],

        }];'


       //.'L.control.layers(baseMaps,overlays).addTo(mymap);'
       .'var panelLayers = new L.Control.PanelLayers(baseLayers, overLayers);'

        .'mymap.addControl(panelLayers);'

        //.'addressPoints = addressPoints.map(function (p) { return [p[0], p[1]]; });'

        .'var heat = L.heatLayer('.json_encode($heatdata).').addTo(heatmap);'


        //."function showPanel(id){{ jsPanel.create({headerTitle: 'test test',contentAjax: 'pointview.php?id='+id,paneltype: 'jsPanel-modal'});}};"
        ."function showPanel(id, name){{ var p = jsPanel.create({headerLogo: 'img/toilets.png', headerControls: 'closeonly', headerTitle: name, id: 'pointview'+id, contentOverflow: 'hidden',content: '<body><iframe name=\"panelFrame\" src=\"pointview.php?id='+id+'\" width=100% height=100% ></iframe></body>', paneltype: 'jsPanel-modal'}); p.resize('500 500'); p.reposition('center');}};"

        ."function showPoint(id, name, icon){{ var p = jsPanel.create({headerLogo: 'img/'+icon, headerControls: 'closeonly', headerTitle: name, id: 'pointview'+id, contentOverflow: 'hidden',content: '<body><iframe name=\"panelFrame\" src=\"pointview.php?id='+id+'\" width=100% height=100% ></iframe></body>', paneltype: 'jsPanel-modal'}); p.resize('500 500'); p.reposition('center');}};"

        .'var popup = L.popup();'

        //."function onMapClick(e){{ jsPanel.create({headerTitle: 'Add New Observation',contentOverflow: 'hidden',contentAjax: 'addobs.php?lat='+e.latlng.lat+'&lng='+e.latlng.lng,paneltype: 'jsPanel-modal', panelSize: '800 500'});}};"
        ."function onMapClick(e){{ var adda = jsPanel.create({headerControls: 'closeonly', id: 'addmarker', headerTitle: 'Add Marker', contentOverflow: 'hidden',content: '<body><iframe name=\"panelFrame\" src=\"addobs.php?lat='+e.latlng.lat+'&lng='+e.latlng.lng+'\" width=100% height=100% ></iframe></body>', paneltype: 'jsPanel-modal'}); adda.resize('520 450');}};"
        .'mymap.on(\'click\', onMapClick);'



        .'</script>';
    }

    public function AddPopup()
    {
        echo '<script>'
         .'L.marker([51.5, -0.09]).addTo(mymap)'
		.'.bindPopup("<b>Hello world!</b><br />I am a popup.").openPopup();'
        .'</script>';
    }

    public function AddCircle($x,$y)
    {
        echo '<script>'
        ."L.circle([$x, $y], 500, {"
		.'color: \'red\','
		.'fillColor: \'#f03\','
		.'fillOpacity: 0.5'
	.'}).addTo(mymap).bindPopup("I am a circle.");'
        .'</script>';
    }

      public function AddPolygon()
      {
          echo '<script>'
        .'L.polygon(['
		.'[51.509, -0.08],'
		.'[51.503, -0.06],'
		.'[51.51, -0.047]'
	.']).addTo(mymap).bindPopup("I am a polygon.");'
          .'</script>';
      }

      public function AddEnd()
      {
          echo '<script>'
         .' </script>';
      }


      public function AddLine()
      {
          echo '<script>'
          .'var polyline = new L.Polyline([ [-45, 45],[45, -45]], {color: \'green\',weight: 5, opacity: 0.5}).addTo(mymap);'
          .'mymap.fitBounds(polyline.getBounds());'
          .'</script>';
      }



      public function AddAntLine()
      {
          echo '<script>'
          .'var polyline = new L.Polyline.AntPath([ [-45, 45],[45, -45]], {color: \'green\',weight: 5, opacity: 0.5}).addTo(mymap);'
          .'mymap.fitBounds(polyline.getBounds());'
          .'</script>';
      }

      public function AddPoint($r)
      {
          echo "<script> L.marker([".$r["lat"].", ".$r["lng"]."], {icon: ".$r["member"]."_icon}).addTo(".$r["collection"].").on('click', L.bind(showPoint, null, ".$r["id"].", '".$r["name"]."', '".$r["icon"]."')); </script>";
      }

      public function AddToilet($x,$y,$comment,$id)
      {
          $name="(Toilet) ".$comment;
          echo '<script>'

          ."L.marker([$x, $y], {icon: toilet_icon}).addTo(toilets).on('click', L.bind(showPanel, null, $id, '$name'));"

          .'</script>';
      }

      public function AddFountain($x,$y,$comment,$id)
      {
          $name="(Fountain) ".$comment;
          echo '<script>'
          ."L.marker([$x, $y],{icon: fountain_icon}).addTo(fountains).on('click', L.bind(showPanel, null, $id, '$name'));"
          .'</script>';
      }

      public function AddQuestion($x,$y,$comment,$id)
      {
          $name="(Question) ".$comment;
          echo '<script>'
          ."L.marker([$x, $y], {icon: question_icon}).addTo(questions).on('click', L.bind(showPanel, null, $id, '$name'));"
          .'</script>';
      }

      public function AddComment($x,$y,$comment,$id)
      {
          $name="(Comment) ".$comment;
          echo '<script>'
          ."L.marker([$x, $y], {icon: comment_icon}).addTo(comments).on('click', L.bind(showPanel, null, $id, '$name'));"
          .'</script>';
      }

      public function AddHazard($x,$y,$comment,$id)
      {
          $name="(Hazard) ".$comment;
          echo '<script>'
          ."L.marker([$x, $y], {icon: hazard_icon}).addTo(hazards).on('click', L.bind(showPanel, null, $id, '$name'));"
          .'</script>';
      }

      public function AddCarparks($x,$y,$comment,$id)
      {
          $name="(Carpark) ".$comment;
          echo '<script>'
          ."L.marker([$x, $y], {icon: parking_icon}).addTo(carparks).on('click', L.bind(showPanel, null, $id, '$name'));"
          .'</script>';
      }

      public function AddAnimals($x,$y,$comment,$id)
      {
          $name="(Animal Exercise) ".$comment;
          echo '<script>'
          ."L.marker([$x, $y], {icon: animal_icon}).addTo(animals).on('click', L.bind(showPanel, null, $id, '$name'));"
          .'</script>';
      }

      public function AddPlayground($x,$y,$comment,$id)
      {
          $name="(Playground) ".$comment;
          echo '<script>'
          ."L.marker([$x, $y], {icon: playground_icon}).addTo(playground).on('click', L.bind(showPanel, null, $id, '$name'));"
          .'</script>';
      }

      public function AddArt($x,$y,$comment,$id)
      {
          $name="(Art) ".$comment;
          echo '<script>'
          ."L.marker([$x, $y], {icon: art_icon}).addTo(art).on('click', L.bind(showPanel, null, $id, '$name'));"
          .'</script>';
      }

      public function AddHeat($tdarray)
      {
          //echo 'var heat = L.heatLayer(addressPoints).addTo(heatmap);';
      }
}