<?php

$id = $_GET["id"];

require_once("Connection/MySqlConnection.php");
require_once("Formatting/MakeTable.php");

$pointconn = new MySqlConnection();

$comms = $pointconn->SelectTable("comments","pointid=$id");
//echo "SELECT * FROM points WHERE id=$id";
$point = $pointconn->SelectTable("points","id=$id");



MakeTable($comms);

$pointconn->Close();