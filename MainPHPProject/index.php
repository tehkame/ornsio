
    <?php
    //sdfsdf
    include("header.php");
    
    include("Formatting/Map.php");

    include("body.php");

    require_once("Connection/MySqlConnection.php");
    require_once("Formatting/MakeTable.php");
    require_once("Formatting/Panel.php");

    $conn = new MySqlConnection();


    //$toilets = $conn->SelectTable("points","type=1");
    //$fountains = $conn->SelectTable("points","type=2");
    //$hazards = $conn->SelectTable("points","type=3");
    //$comments = $conn->SelectTable("points","type=4");
    //$questions = $conn->SelectTable("points","type=5");

    //$carpark = $conn->SelectTable("points","type=6");
    //$animal = $conn->SelectTable("points","type=7");
    //$playground = $conn->SelectTable("points","type=8");
    //$art = $conn->SelectTable("points","type=9");
    $allpoints = $conn->SelectPoints();

    $heat = $conn->Query("SELECT points.*, COUNT(comments.id) AS INTENSITY FROM points left join comments on comments.pointid = points.id WHERE comments.id IS NOT NULL GROUP BY points.id");


    $aData = array();
    $count = 0;
    while($row = $heat->fetch_assoc())
    {
        $aData[$count] = array(floatval($row['lat']), floatval($row['lng']), floatval($row['INTENSITY']));
        $count = $count + 1;
    }
    //var_dump($aData);


    $myMap = new Map();

    $myMap->InsertMap("mapid",-42.881381,147.329513,$aData );

    //$myMap->AddHeat(addressPoints);


     while($row = $allpoints->fetch_assoc())
     {
         $myMap->AddPoint($row);
     }


   //while($row = $toilets->fetch_assoc())
   // {
   //     $myMap->AddToilet($row["lat"], $row["lng"],$row["name"],$row["id"]);
   // }

   //while($row = $fountains->fetch_assoc())
   //{
   //    $myMap->AddFountain($row["lat"], $row["lng"],$row["name"],$row["id"]);
   //}

   //while($row = $hazards->fetch_assoc())
   //{
   //    $myMap->AddHazard($row["lat"], $row["lng"],$row["name"],$row["id"]);
   //}

   //while($row = $comments->fetch_assoc())
   //{
   //    $myMap->AddComment($row["lat"], $row["lng"],$row["name"],$row["id"]);
   //}

   //while($row = $questions->fetch_assoc())
   //{
   //    $myMap->AddQuestion($row["lat"], $row["lng"],$row["name"],$row["id"]);
   //}

   //while($row = $carpark->fetch_assoc())
   //{
   //    $myMap->AddCarparks($row["lat"], $row["lng"],$row["name"],$row["id"]);
   //}

   //while($row = $animal->fetch_assoc())
   //{
   //    $myMap->AddAnimals($row["lat"], $row["lng"],$row["name"],$row["id"]);
   //}

   //while($row = $playground->fetch_assoc())
   //{
   //    $myMap->AddPlayground($row["lat"], $row["lng"],$row["name"],$row["id"]);
   //}

   //while($row = $art->fetch_assoc())
   //{
   //    $myMap->AddArt($row["lat"], $row["lng"],$row["name"],$row["id"]);
   //}


   $myMap->AddEnd();



    $conn->Close();
    ?>

<script>
    function closetPanel(type,y,x,id,name) {

        if (type == 1) {
            L.marker([x, y], { icon: toilet_icon }).addTo(toilets).on('click', L.bind(showPoint, null,  id, name,'toilets.png'));
        }

        if (type == 2) {
            L.marker([x, y], { icon: fountain_icon }).addTo(fountains).on('click', L.bind(showPoint, null, id, name, 'fountain.png'));
        }

        if (type == 3)
        {
            L.marker([x, y], { icon: hazard_icon }).addTo(hazards).on('click', L.bind(showPoint, null, id, name, 'hazard.png'));    
        }

        if (type == 4) {
            L.marker([x, y], { icon: comment_icon }).addTo(comments).on('click', L.bind(showPoint, null, id, name, 'comment.png'));
        }

        if (type == 5) {
            L.marker([x, y], { icon: question_icon }).addTo(questions).on('click', L.bind(showPoint, null, id, name, 'question.png'));
           
        }

        if (type == 6) {
            L.marker([x, y], { icon: parking_icon }).addTo(carparks).on('click', L.bind(showPoint, null, id, name, 'parking.png'));
        }

        if (type == 7) {
            L.marker([x, y], { icon: animal_icon }).addTo(animals).on('click', L.bind(showPoint, null, id, name, 'animal.png'));
        }

        if (type == 8) {
            L.marker([x, y], { icon: playground_icon }).addTo(playground).on('click', L.bind(showPoint, null, id, name, 'playground.png'));
        }

        if (type == 9) {
            L.marker([x, y], { icon: art_icon }).addTo(art).on('click', L.bind(showPoint, null, id, name, 'art.png'));
        }


        var p = document.getElementById('addmarker');
        p.close();

    }
</script>


<script>
    var wpanel = jsPanel.create({ paneltype: 'modal', id: 'welcomepanel', headerTitle: 'Welcome!', contentOverflow: 'hidden', content: '<iframe name="panelFrame" src="welcome.php" style="overflow:hidden;height:100%;width:100%" height="100%" width="100%"></iframe>', animateIn: 'jsPanelFadeIn', headerControls: 'none'});
    wpanel.resize('600 450');
    wpanel.reposition('center');
</script>