<?php
    session_start();
        $clase = "";
        include "../files/conexion.php";
		if(isset($_SESSION['airline'])){
			$airline = $_SESSION['airline'];
			$stmt = $mysqli->prepare("SELECT flights.id,c1.city as arrival_city, c2.city as departure_city, flights.arrival_time,flights.arrival_runway,aircraft.name,airlines.name FROM `flights` INNER JOIN cities c1 ON flights.arrival_city=c1.id INNER JOIN cities c2 ON flights.departure_city=c2.id INNER JOIN aircraft ON flights.aircraft=aircraft.id INNER JOIN airlines ON flights.airline=airlines.id WHERE airlines.id = ? ORDER BY `flights`.`arrival_time` DESC");	
			$stmt->bind_param('i',$airline);
		}else{
			$stmt = $mysqli->prepare("SELECT flights.id,c1.city as arrival_city, c2.city as departure_city, flights.arrival_time,flights.arrival_runway,aircraft.name,airlines.name FROM `flights` INNER JOIN cities c1 ON flights.arrival_city=c1.id INNER JOIN cities c2 ON flights.departure_city=c2.id INNER JOIN aircraft ON flights.aircraft=aircraft.id INNER JOIN airlines ON flights.airline=airlines.id ORDER BY `flights`.`arrival_time` DESC");
		}
        $stmt->execute(); 
        $stmt->store_result();
        $stmt->bind_result($id,$arrival_city,$departure_city,$arrival_time,$arrival_runway,$aircraft,$airline);
        //$resta = date_diff(date_create($arrival_time),$actual);
            echo "<table class='table table-striped table-hover '>
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Destination city</th>
					  <th>Departure city</th>
                      <th>Estatus</th>
                      <th>Landing time</th>
                       <th>Estimated time</th>
                      <th>Runway</th>
                      <th>Aircraft</th>
                      <th>Airline</th>
                    </tr>
                  </thead><tbody>";
            while ($stmt->fetch()) {
                $date = new DateTime($arrival_time);
                $now = new DateTime();
                $resta = $date->diff($now)->format("%h hous, %i minutes y %s seconds");
                $restaDos = $date->diff($now)->format("%h");
                
                    if($date >= $now) {
                        $estado = "In the air";
                        $clase = "success";
                    }else {
                        $resta = "On hold";
                        $estado = "Landed";
                        $clase = "danger";
                    }
                    if($restaDos <= 24) {
                    echo "<tr class='$clase'>
                          <td>$id</td>
                          <td>$arrival_city</td>
						  <td>$departure_city</td>
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