<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">
    <link href="../../docs/css/bootstrap.css" rel="stylesheet">
    <link href="../../docs/css/font-awesome.css" rel="stylesheet">
    <link href="../../docs/css/ionicons.css" rel="stylesheet">
    <title>Administrator - AeroControl</title>
</head>
<body>
<div class="container-fluid">
    <div class="row">
    <!-- NAV -->
    <?php include 'nav.php'; ?>
    <!-- /NAV -->
        <div class="container">
            <div class="jumbotron well">
              <h1>Bienvenid@!</h1>
              <p>Acaba de iniciar sesion dentro como empleado</p>
            </div>
            <div class="col-md-12">
                <h2 class="text-center">Flights in real time</h2>
                <div class="container vuelos"></div>
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
              url: "../../user/ajax/algorit.php",
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