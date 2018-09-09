<html>
<head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous" />
    <link rel="stylesheet" href="bootstrap-theme.min.css" />

    <?php
    $id = $_GET["id"];

    require_once("Connection/MySqlConnection.php");
    require_once("Formatting/MakeTable.php");
    require_once("Formatting/ReverseAddress.php");

    $pointconn = new MySqlConnection();

    $comms = $pointconn->SelectOptions("comments","DATE_FORMAT(created,'%d/%m/%Y') as dt, note, name","pointid=$id ORDER BY created DESC");
    //echo "SELECT * FROM points WHERE id=$id";
    $point = $pointconn->SelectTable("points","id=$id");

    ?>

    <style>
        .hide { position:absolute; top:-1px; left:-1px; width:1px; height:1px; }
    </style>

   

</head>
<body>
    <br />


    <div class="container-fluid">

        <div class="row">


            <div class="col">

                <div class="panel panel-primary">
                    <div class="panel-heading">Marker Details</div>
                    <div class="panel-body">
                        <?php 
                        ReverseAddress($point);
                        ?>
                    </div>
                </div>
                <br />

            </div>


            <div class="col">


                <?php
                mysqli_data_seek($point, 0);
                $prow = mysqli_fetch_assoc($point);

                                    $lat = $prow["lat"];
                                    $lng = $prow["lng"];

                                    if (isset($prow["imageurl"]))
                                    {
                                        echo "<img src=\"".$prow["imageurl"]."\" width=200 height=200/>";
                                    }
                                    else
                                    {
                                        echo "<img src=\"https://maps.googleapis.com/maps/api/streetview?size=200x200&location=$lat,$lng&fov=90&heading=235&pitch=10&key=AIzaSyAH-qYUzOVBk5mySDnW1WiT7qDnh9TfSwI\" />";
                                    }

                ?>

            </div>


        </div>
        <div class="row">
            <div class="panel-body">
                <br />
                <?php 
                MakeComments($comms);
                ?>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="panel panel-primary">
                    <div class="panel-heading" style="">Add Comment</div>
                    <div class="panel-body">
                        <form action="addcomment.php" id="tform" method="post">
                            Name:
                            <textarea class="form-control" rows="1" id="name" name="name"></textarea>
                            <br />
                            Comment:
                            <textarea class="form-control" rows="5" id="notes" name="notes"></textarea>
                                <input type="hidden" id="pointid" name="pointid" value="<?php echo $id ?>" />
                            <button type="submit" class="btn btn-primary" style="margin:5px;">Submit</button>
                    </form>
                    </div>
                    </div>
                </div>
            </div>
    </div>




    <script>

        //$(document).ready(function () {

        //    //$.getJSON("https://maps.googleapis.com/maps/api/geocode/json?latlng=40.714224,-73.961452&key=AIzaSyAH-qYUzOVBk5mySDnW1WiT7qDnh9TfSwI", function (result) {
        //    //    $.each(result, function (i, field) {
        //    //        //alert("Hello\nHow are you?");
        //    //        //$("#geo").append(field + " ");
        //    //        //$("#geo").append(field + " ");
        //    //        alert(field);
        //    //    });
        //    //});
        //    //$.ajax({
        //    //    dataType: 'https://maps.googleapis.com/maps/api/geocode/json?latlng=40.714224,-73.961452&key=AIzaSyAH-qYUzOVBk5mySDnW1WiT7qDnh9TfSwI',
        //    //    url: url,
        //    //    data: data,
        //    //    success: function (result) { })
        //    //});
        //    $.getJSON('https://maps.googleapis.com/maps/api/geocode/json?latlng=40.714224,-73.961452&key=AIzaSyAH-qYUzOVBk5mySDnW1WiT7qDnh9TfSwI', function (data) {
        //        alert(data);

        //        var items = data.items.map(function (item) {
        //            return item.key + ': ' + item.value;
        //        });

        //});

        ////var g = $.getJSON("https://maps.googleapis.com/maps/api/geocode/json?latlng=40.714224,-73.961452&key=AIzaSyAH-qYUzOVBk5mySDnW1WiT7qDnh9TfSwI");

    </script>



    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

</body>
</html>

