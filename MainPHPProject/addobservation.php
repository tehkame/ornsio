<?php


$type = 69; // error number

$type = $_POST["type"];
$description = $_POST["description"];
$lat=$_POST["hlat"];
$long=$_POST["hlong"];
//$lat=70.5645;
//$long=-147.45645;
$name=$_POST["title"];
$ident=$_POST["description"];

$name2=$_POST["name"];

require_once("Connection/MySqlConnection.php");
require_once("Formatting/MakeTable.php");

$conn = new MySqlConnection();

if ($name2=="")
{
    $name2="Anonymous";
}

//$conn->InsertRow("points","type,lat,lng,name,description", "$type, $lat, $long, '$name', '$description'");

$id=$conn->InsertRespond("points","type,lat,lng,name,description", "$type, $lat, $long, '$name', '$description'");

$conn->InsertRow("comments","note, pointid, name", ' \''.$ident.'\', \''.$id.'\', \''.$name2.'\'' );

$conn->Close();

$changedname = urlencode($name2);
header("Location: closewindow.php?type=$type&id=$id&lat=$lat&lng=$long&name=$changedname");
