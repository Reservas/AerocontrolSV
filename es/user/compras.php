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
            include "files/menu.php";
                 if(isset($_GET['s'])) {
                    echo "<div class='alert alert-dismissible alert-success'>
  <button type='button' class='close' data-dismiss='alert'>×</button>
  <strong>Muy bien!</strong> La conpra fue realizada satisfactoriamente</a>.
</div>";
                 }
                 include "files/conexion.php";
                $stmt = $mysqli->prepare("SELECT flights.id,bookings.seats,flights.departure_time,flights.cost,flights.seats,flights.description,cities.city,flights.arrival_time,flights.arrival_runway,aircraft.name,airlines.name FROM `bookings` INNER JOIN flights ON bookings.flight=flights.id INNER JOIN costumers ON costumers.id=bookings.costumer INNER JOIN cities ON flights.arrival_city=cities.id INNER JOIN aircraft ON flights.aircraft=aircraft.id INNER JOIN airlines ON flights.airline=airlines.id WHERE costumers.id = ? ORDER BY `flights`.`arrival_time` ASC");
        $stmt->bind_param('i',$_SESSION['id']);
        $stmt->execute(); 
        $stmt->store_result();
        $stmt->bind_result($id,$seat,$departure_time,$cost,$seats,$description,$arrival_city,$arrival_time,$arrival_runway,$aircraft,$airline);
                $resta = 0;
        echo "<div class='col-xs-12'>
            <center><h1>Tus vuelos</h1></center>
            <div class='container'>";
         while ($stmt->fetch()) {
             
              $date = new DateTime($arrival_time);
                $now = new DateTime();
                $newFormatDep =  date("D M j y", strtotime($departure_time));
                $resta = $date->diff($now)->format("%h horas, %i minutos y %s segundos");
                $restaDos = $date->diff($now)->format("%h");
                    if($restaDos <= 24) {
                    //echo "<tr class=''>
                      //    <td>$id</td>
                     //     <td>$arrival_city</td>
                     //     <td>$arrival_time</td>
                     //     <td>$resta</td>
                     //     <td>$arrival_runway</td>
                     //     <td>$aircraft</td>
                     //     <td>$airline</td>
                    //    </tr>";
                        $total = $cost * $seat;
                        echo "<div class='col-xs-6'><div class='jumbotron'>
                          <h1>$arrival_city</h1>
                          <p>$description</p>
                          <div style='margin-bottom:3%;'>
                            <a class='btn btn-info'><i class='fa fa-plane'></i> $airline</a>
                            <a class='btn btn-info'><i class='fa fa-clock-o'></i> $newFormatDep</a>
                             <a class='btn btn-info'><i class='fa fa-users'></i> $seat</a>
                            <a class='btn btn-success'><i class='fa fa-usd'></i> $total</a>
                          </div>  
                            
                        </div></div>";
                    }
         }
                 echo "</div></div>";
        ?>
        
            
    <script>
        $( document ).ready(function() {
            $(".3").addClass("active"); 
        });
    </script>
    </body>
</html>
<?php
             }
?>