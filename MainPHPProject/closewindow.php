<html>
<body>
    <?php
$id = $_GET["id"];
$lat = $_GET["lat"];
$lng = $_GET["lng"];
$type = $_GET["type"];
$name = urldecode($_GET["name"]);
$name2 = str_replace("'","",$name);

    echo '<script>';
    echo "parent.closetPanel($type,$lng,$lat,$id,'$name')";
    echo '</script>';

    ?>

</body>
</html>

