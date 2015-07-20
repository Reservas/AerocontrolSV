<?php
        $clase = "";
        include "../files/conexion.php";
        $stmt = $mysqli->prepare("SELECT flights.id,cities.city,flights.arrival_time,flights.arrival_runway,aircraft.name,airlines.name FROM `flights` INNER JOIN cities ON flights.arrival_city=cities.id INNER JOIN aircraft ON flights.aircraft=aircraft.id INNER JOIN airlines ON flights.airline=airlines.id ORDER BY `flights`.`arrival_time` DESC");
        //$stmt->bind_param('s',$_GET['id']);
        $stmt->execute(); 
        $stmt->store_result();
        $stmt->bind_result($id,$arrival_city,$arrival_time,$arrival_runway,$aircraft,$airline);
        //$resta = date_diff(date_create($arrival_time),$actual);
            echo "<table class='table table-striped table-hover '>
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Ciudad de destino</th>
                      <th>Estatus</th>
                      <th>Hora de aterrizaje</th>
                       <th>Tiempo estimado</th>
                      <th>Pista</th>
                      <th>Avión</th>
                      <th>Aerolínea</th>
                    </tr>
                  </thead><tbody>";
            while ($stmt->fetch()) {
                $date = new DateTime($arrival_time);
                $now = new DateTime();
                $resta = $date->diff($now)->format("%h horas, %i minutos y %s segundos");
                $restaDos = $date->diff($now)->format("%h");
                
                    if($date >= $now) {
                        $estado = "Disponible";
                        $clase = "success";
                    }else {
                        $resta = "En espera";
                        $estado = "Aterrizó";
                        $clase = "danger";
                    }
                    if($restaDos <= 24) {
                    echo "<tr class='$clase'>
                          <td>$id</td>
                          <td>$arrival_city</td>
                          <td>$estado</td>
                          <td>$arrival_time</td>
                          <td>$resta</td>
                          <td>$arrival_runway</td>
                          <td>$aircraft</td>
                          <td>$airline</td>
                        </tr>";
                    }
                }
                echo "<tbody>";
?>