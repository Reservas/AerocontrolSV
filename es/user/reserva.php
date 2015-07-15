<html>
    <head>
        <?php
            session_start();
             if(isset($_SESSION['id'])){
            include "files/head.php";
        ?>
    </head>
    <body>
        <?php 
            include "files/nav.php";
            if(isset($_POST['comprar'])){
                include "files/conexion.php";
                $stmt = $mysqli->prepare("SELECT flights.id,flights.departure_time,flights.cost,flights.seats,flights.description,cities.city,flights.arrival_time,flights.arrival_runway,aircraft.name,airlines.name FROM `flights` INNER JOIN cities ON flights.arrival_city=cities.id INNER JOIN aircraft ON flights.aircraft=aircraft.id INNER JOIN airlines ON flights.airline=airlines.id WHERE flights.id = ? ORDER BY `flights`.`arrival_time`");
        $stmt->bind_param('i',$_POST['comprar']);
        $stmt->execute(); 
        $stmt->store_result();
        $stmt->bind_result($id,$departure_time,$cost,$seats,$description,$arrival_city,$arrival_time,$arrival_runway,$aircraft,$airline);
                $resta = 0;
         while ($stmt->fetch()) {
             $resta = $seats - $_POST['number'];
             
         }
                
                if($resta >= 0) {
                
                $stmt = $mysqli->prepare("INSERT INTO `bookings` (`costumer`, `flight`,`seats`) VALUES ( ?, ?,?);");
                $stmt->bind_param('iii',$_SESSION['id'],$_POST['comprar'],$_POST['number']);
                $stmt->execute(); 
                $stmt = $mysqli->prepare("UPDATE `aerocontrol`.`flights` SET `seats` = ? WHERE `flights`.`id` = ?;");
                $stmt->bind_param('ii',$resta,$_POST['comprar']);
                $stmt->execute();
                    header('Location: compras.php?s=1');
                }else {
                    echo "<div class='alert alert-dismissible alert-danger'>
  <button type='button' class='close' data-dismiss='alert'>×</button>
  <strong>ERROR!</strong> <a href='#' class='alert-link'>intente con un numero menor.
</div>";
                }
                
            }
        ?>
                                            <a href="../../en/user/reserva.php">English/</a><a href="../../es/user/reserva.php">Español</a>
        
        <div class="col-xs-12">
            <center><h1>Vuelos Disponibles</h1></center>
            <div class="container reservas"></div>
        </div>
        
    
<!-- Modal -->
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
          
        </div>
        <script>
        function justNumbers(e)
        {
        var keynum = window.event ? window.event.keyCode : e.which;
        if ((keynum == 8) || (keynum == 46))
        return true;
         
        return /\d/.test(String.fromCharCode(keynum));
        </script>
        <script>
        $( document ).ready(function() {
            $(".2").addClass("active"); 
        });
    </script>
    </body>
</html>
<?php
             }
?>