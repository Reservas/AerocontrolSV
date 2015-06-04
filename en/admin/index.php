<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">
    <link href="../docs/css/bootstrap.css" rel="stylesheet">
    <link href="../docs/css/font-awesome.css" rel="stylesheet">
    <link href="../docs/css/ionicons.css" rel="stylesheet">
    <title>Administración - AeroControl</title>
</head>
<body>
<div class="container-fluid">
    <div class="row">
    <!-- NAV -->
    <?php include 'nav.php'; ?>
    <!-- /NAV -->
        <h1 class="text-center">Administrator</h1>
        <div class="col-md-12">
            <h2 class="text-center">Flights in real time</h2>
            <div class="container vuelos"></div>
            <h2 class="text-center">Maintenance</h2>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <div class="alert alert-info">  
                <h3>Destination - Cities</h3>
                    <a href="cities.php" class="btn btn-primary">List</a>   <a href="addcity.php" class="btn btn-success">New</a>
                </div>
        </div>
        <div class="col-md-4">
            <div class="alert alert-info">  
                <h3>Airport</h3>
                    <a href="airports.php" class="btn btn-primary">List</a>   <a href="addairport.php" class="btn btn-success">New</a>
                </div>
        </div>
        <div class="col-md-4">
            <div class="alert alert-info">  
                <h3>Clients</h3>
                    <a href="costumers.php" class="btn btn-primary">List</a>   <a href="addcostumer.php" class="btn btn-success">New</a>
                </div>
        </div>
        <!-- NO ESTAN -->
        <div class="col-md-4">
            <div class="alert alert-info">  
                <h3>Airlines</h3>
                    <a href="airlines.php" class="btn btn-primary">List</a>   <a href="addairline.php" class="btn btn-success">New</a>
                </div>
        </div>
        <div class="col-md-4">
            <div class="alert alert-info">  
                <h3>Aircrafts</h3>
                    <a href="aircrafts.php" class="btn btn-primary">List</a>   <a href="addaircraft.php" class="btn btn-success">New</a>
                </div>
        </div>
        <div class="col-md-4">
            <div class="alert alert-danger">  
                <h3>Flights</h3>
                    <a href="Flights.php" class="btn btn-primary">List</a>   <a href="addflight.php" class="btn btn-success">New</a>
                </div>
        </div>
        <div class="col-md-4">
            <div class="alert alert-danger">  
                <h3>Personal</h3>
                    <a href="#" class="btn btn-primary">List</a>   <a href="#" class="btn btn-success">New</a>
                </div>
        </div>
        <div class="col-md-4">
            <div class="alert alert-info">  
                <h3>Runways</h3>
                    <a href="runways.php" class="btn btn-primary">List</a>   <a href="addrunway.php" class="btn btn-success">New</a>
                </div>
        </div>
    </div>    
</div>
    <!-- JAVASCRIPT FILES PLACED AT THE BOTTOM TO REDUCE THE LOADING TIME  -->
    <!-- CORE JQUERY  SCRIPTS -->
    <script src="../docs/js/jquery-1.11.1.js"></script>
    <!-- BOOTSTRAP SCRIPTS  -->
    <script src="../docs/js/bootstrap.js"></script>
    <!-- SCROLLING SCRIPTS PLUGIN  -->
    <script src="../docs/js/jquery.easing.min.js"></script>
    <!-- CUSTOM SCRIPTS   -->
    <script src="../docs/js/custom.js"></script>
    <script>
    $( document ).ready(function() {
        $( "#airlbtn" ).click(function() {
            var clickselect = $("#airlines").val();
            window.location.href = "loginairl.php?airline=" + clickselect;
        });   
    function loadVuelos() {
    $.ajax({
          method: "POST",
          url: "../user/ajax/algorit.php",
          data: { },
          //dataType: 'json',
          beforeSend: function() {
            
          },
          success: function(data) {
            $(".vuelos").html(data);
          }
      });
    }
    loadVuelos();
     window.setInterval(function(){
        loadVuelos();
    }, 1000);
});
    </script>
    </body>
</html>