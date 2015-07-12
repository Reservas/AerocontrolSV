<?php 
include "../files/conexion.php";
        $stmt = $mysqli->prepare("SELECT flights.id,flights.departure_time,flights.cost,flights.seats,flights.description,cities.city,flights.arrival_time,flights.arrival_runway,aircraft.name,airlines.name FROM `flights` INNER JOIN cities ON flights.arrival_city=cities.id INNER JOIN aircraft ON flights.aircraft=aircraft.id INNER JOIN airlines ON flights.airline=airlines.id ORDER BY `flights`.`arrival_time` ASC");
        //$stmt->bind_param('s',$_GET['id']);
        $stmt->execute(); 
        $stmt->store_result();
        $stmt->bind_result($id,$departure_time,$cost,$seats,$description,$arrival_city,$arrival_time,$arrival_runway,$aircraft,$airline);
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
                        echo "<div class='col-xs-6'><div class='jumbotron'>
                          <h1>$arrival_city</h1>
                          <p>$description</p>
                          <div style='margin-bottom:3%;'>
                            <a class='btn btn-info'><i class='fa fa-plane'></i> $airline</a>
                            <a class='btn btn-info'><i class='fa fa-clock-o'></i> $newFormatDep</a>
                             <a class='btn btn-info'><i class='fa fa-users'></i> $seats</a>
                            <a class='btn btn-success'><i class='fa fa-usd'></i> $cost</a>
                          </div>  
                            <p><a id='$id' class='btn btn-primary btn-lg comprar'>Bu    y ticket</a></p>
                        </div></div>";
                    }
                }
?>