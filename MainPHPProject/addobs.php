<html>
<head>
    <style>
        .hide { position:absolute; top:-1px; left:-1px; width:1px; height:1px; }
    </style>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous" />
    <link rel="stylesheet" href="bootstrap-theme.min.css" />
    <?php
    $lat = $_GET["lat"];
    $long = $_GET["lng"];
    include_once("Connection/MySqlConnection.php");
    $conn = new MySqlConnection();
    $opts = $conn->SelectTable("pointtypes","1");
    ?>
</head>

<body>

    <div class="container-fluid">
        <div class="row">
            <div class="col">

                <iframe name="hiddenFrame2" class="hide"></iframe>
            <form action="addobservation.php" method="post">

                <div class="row">


                    <div class="col-5" style="margin:5px;background:Gainsboro;">
                        <?php

                        $o = mysqli_fetch_assoc($opts);
                        echo"<div class=\"row\"><div class=\"col-9\"><input type='radio' name='type' value=\"".$o["id"]."\" id=\"".$o["id"]."\" checked>  ".$o["alias"]."<label for=\"".$o["id"]."\"></label></input></div><div class=\"col-3\"><img src=\"img/".$o["icon"]."\" height=\"37\" width=\"32\" /></div></div>";

                    while($o = mysqli_fetch_assoc($opts))
                    {
                        echo"<div class=\"row\"><div class=\"col-9\"><input type='radio' name='type' value=\"".$o["id"]."\" id=\"".$o["id"]."\">  ".$o["alias"]."<label for=\"".$o["id"]."\"></label></input></div><div class=\"col-3\"><img src=\"img/".$o["icon"]."\" height=\"37\" width=\"32\" /></div></div>";
                    }
                        ?>

                    </div>

                    <div class="col-6">
                        <br />
                        Name:
                        <textarea class="form-control" rows="1" id="name" name="name"></textarea>
                    <br />
                        Title:
                        <textarea class="form-control" rows="1" id="title" name="title"></textarea>
                        <br />
                        Description:
                        <textarea class="form-control" rows="3" id="description" name="description"></textarea>
                        <br />
                    <br />
                        <input type="hidden" id="hlat" name="hlat" value="<?php echo $lat ?>" />
                        <input type="hidden" id="hlong" name="hlong" value="<?php echo $long ?>" />
                        <input type="submit" value="Submit" />
                    </div>

                </div>




            </form>

        </div>
            </div>
        </div>


                    




</body>
</html>
