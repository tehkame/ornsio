<?php

$id = $_GET["id"];

require_once("Connection/MySqlConnection.php");
require_once("Formatting/MakeTable.php");

$pointconn = new MySqlConnection();

$comms = $pointconn->SelectOptions("comments","*","pointid=$id ORDER BY created DESC");
//echo "SELECT * FROM points WHERE id=$id";
$point = $pointconn->SelectTable("points","id=$id");

MakeTable($comms);

$pointconn->Close()