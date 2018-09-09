<?php

/**
 * Outputs a simple table to the document
 *
 * @param mixed $d the associative array to display as a table
 *
 * @version 1.0
 * @author Julian.Kruup
 */
function ReverseAddress($d)
{

    while($row = $d->fetch_assoc())
    {
        $lat = $row["lat"];
        $lng = $row["lng"];
        $url = "https://maps.googleapis.com/maps/api/geocode/json?latlng=".$lat.",".$lng."&key=AIzaSyAH-qYUzOVBk5mySDnW1WiT7qDnh9TfSwI";
        //  Initiate curl
        $ch = curl_init();
        // Disable SSL verification
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        // Will return the response, if false it print the response
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        // Set the url
        curl_setopt($ch, CURLOPT_URL,$url);
        // Execute
        $result=curl_exec($ch);
        // Closing
        curl_close($ch);

        // Will dump a beauty json :3
        $obj = json_decode($result, true);
        //var_dump($obj);

        echo $obj['results'][0]['formatted_address'];
    }


}

