<?php



$notes = $_POST["notes"];
$pointid = $_POST["pointid"];
$name = $_POST["name"];

require_once("Connection/MySqlConnection.php");
require_once("Formatting/MakeTable.php");

$conn = new MySqlConnection();

if ($name=="")
{
    $name="Anonymous";
}

$conn->InsertRow("comments","note, pointid, name", '\''.$notes.'\', \''.$pointid.'\', \''.$name.'\'');

$conn->Close();

header("Location: pointview.php?id=$pointid");