<?php
session_start();
require_once '../../connect.php';
$query = mysql_query("SELECT * FROM airlines WHERE id = '".$_SESSION['airline']."'");
$row = mysql_fetch_array($query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">
    <link href="../../docs/css/bootstrap.css" rel="stylesheet">
    <link href="../../docs/css/font-awesome.css" rel="stylesheet">
    <link href="../../docs/css/ionicons.css" rel="stylesheet">
    <title>Administración - <?=$row['name']?></title>
</head>
<body>
<div class="container-fluid">
    <div class="row">
    <!-- NAV -->
    <?php include 'nav.php'; ?>
    <!-- /NAV -->
        <div class="container">
            <div class="jumbotron well">
              <h1>Bienvenido!</h1>
              <p>Acaba de iniciar sesion dentro como empleado</p>
            </div>
            <div class="col-md-12">
                <h2 class="text-center">Vuelos (<?=$row['name']?>)</h2>
                <div class="container vuelos"></div>
				<h2 class="text-center">Mantenimientos</h2>
            </div>
        </div>
    </div>
	<div class="row">
        
        <div class="col-md-4">
            <div class="alert alert-info">  
                <h3>Aviones</h3>
                    <a href="../../admin/aircrafts.php" class="btn btn-primary">Ver lista</a>   <a href="../../admin/addaircraft.php" class="btn btn-success">Nuevo</a>
                </div>
        </div>
        <div class="col-md-4">
            <div class="alert alert-info">  
                <h3>Vuelos</h3>
                    <a href="../../admin/flights.php" class="btn btn-primary">Ver lista</a>   <a href="../../admin/addflight.php" class="btn btn-success">Nuevo</a>
                </div>
        </div>
    </div>    	
</div>
    
    <!-- JAVASCRIPT FILES PLACED AT THE BOTTOM TO REDUCE THE LOADING TIME  -->
    <!-- CORE JQUERY  SCRIPTS -->
    <script src="../../docs/js/jquery-1.11.1.js"></script>
    <!-- BOOTSTRAP SCRIPTS  -->
    <script src="../../docs/js/bootstrap.js"></script>
    <!-- SCROLLING SCRIPTS PLUGIN  -->
    <script src="../../docs/js/jquery.easing.min.js"></script>
    <!-- CUSTOM SCRIPTS   -->
    <script src="../../docs/js/custom.js"></script>
    <script>
    $( document ).ready(function() {
        function loadVuelos() {
        $.ajax({
              method: "POST",
              url: "../algorit.php",
              data: {},
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