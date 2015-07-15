<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">
    <link href="../docs/css/bootstrap.css" rel="stylesheet">
    <link href="../docs/css/font-awesome.css" rel="stylesheet">
    <link href="../docs/css/ionicons.css" rel="stylesheet">
    <link href="../docs/css/style.css" rel="stylesheet">
    <title>Administraci&oacute;n - AeroControl</title>
</head>
<body>
<div class="container-fluid">
    <div class="row">
    <!-- NAV -->
    <?php include 'nav.php'; ?>
            <a href="../../en/admin/index.php"> <img src="../../base_de_datos/Ingles.jpg" class="redondo" width=60 height=30/></a>
            <a href="index.php"> <img src="../../base_de_datos/descarga" class="redondo"  width="60" height="30"/> </a> 
         
        <!-- /NAV -->
        <h1 class="text-center">Administraci&oacute;n</h1>
        <div class="col-md-12">
            <h2 class="text-center">Vuelos en tiempo real</h2>
            <div class="container vuelos"></div>
            <h2 class="text-center">Mantenimientos</h2>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <div class="alert alert-info">  
                <h3>Destinos - Ciudades</h3>
                    <a href="cities.php" class="btn btn-primary">Ver lista</a>   <a href="addcity.php" class="btn btn-success">Nuevo</a>
                </div>
        </div>
        <div class="col-md-4">
            <div class="alert alert-info">  
                <h3>Aeropuertos</h3>
                    <a href="airports.php" class="btn btn-primary">Ver lista</a>   <a href="addairport.php" class="btn btn-success">Nuevo</a>
                </div>
        </div>
        <div class="col-md-4">
            <div class="alert alert-info">  
                <h3>Clientes</h3>
                    <a href="costumers.php" class="btn btn-primary">Ver lista</a>   <a href="addcostumer.php" class="btn btn-success">Nuevo</a>
                </div>
        </div>
        <!-- NO ESTAN -->
        <div class="col-md-4">
            <div class="alert alert-info">  
                <h3>Aerol&iacute;neas</h3>
                    <a href="airlines.php" class="btn btn-primary">Ver lista</a>   <a href="addairline.php" class="btn btn-success">Nuevo</a>
                </div>
        </div>
        <div class="col-md-4">
            <div class="alert alert-info">  
                <h3>Aviones</h3>
                    <a href="aircrafts.php" class="btn btn-primary">Ver lista</a>   <a href="addaircraft.php" class="btn btn-success">Nuevo</a>
                </div>
        </div>
        <div class="col-md-4">
            <div class="alert alert-info">  
                <h3>Vuelos</h3>
                    <a href="flights.php" class="btn btn-primary">Ver lista</a>   <a href="addflight.php" class="btn btn-success">Nuevo</a>
                </div>
        </div>
        <div class="col-md-4">
            <div class="alert alert-info">  
                <h3>Personal</h3>
                    <a href="personal.php" class="btn btn-primary">Ver lista</a>   <a href="addpersonal.php" class="btn btn-success">Nuevo</a>
                </div>
        </div>
        <div class="col-md-4">
            <div class="alert alert-info">  
                <h3>Pistas de aterrizaje</h3>
                    <a href="runways.php" class="btn btn-primary">Ver lista</a>   <a href="addrunway.php" class="btn btn-success">Nuevo</a>
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