<?php

/**
 * Outputs a simple table to the document
 *
 * @param mixed $d the associative array to display as a table
 *
 * @version 1.0
 * @author Julian.Kruup
 */
function MakeTable($data,$headers=null,$id=null,$class='table')
{
    if (isset($id))
    {
        $idval = ' id="'.$id.'" ';
        $scope='';
    }
    else
    {
        $idval=' ';
        $scope = ' scope="col"';
    }
    echo '<table'.
    //isset($id) ? ' id="'.$id.'" ' : ' '
    $idval
    .'class="'.$class.'">';
    if (isset($headers))
    {
        echo '<thead><tr>';
        foreach ($headers as $header)
        {
            echo '<th'.$scope.'>'.$header.'</th>';
        }
        echo '</tr></thead>';
    }
    echo '<tbody>';
    while($row = $data->fetch_assoc())
    {
        echo "<tr>";
        foreach ($row as $field){echo "<td>".$field."</td>";}
        echo "</tr>";
    }
    echo '</tbody>';
    echo "</table>";
}

function MakeComments($data,$class='table')
{
    echo '<table '.

    'class="'.$class.'">';
    echo '<tbody>';
    while($row = $data->fetch_assoc())
    {
        echo "<tr>";
        echo "<td><b>".$row["name"]."</b><br>".$row["dt"]."</td>";
        echo "<td>".$row["note"]."</td>";
        echo "</tr>";
    }
    echo '</tbody>';
    echo "</table>";
}