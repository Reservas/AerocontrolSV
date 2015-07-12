<?php 
             session_start();
            if(isset($_POST['comprar'])){
                include "../files/conexion.php";
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
					
                    header('Location: ../compras.php?s=1');
                }else {
                    header('Location: ../purchase.php?e=1');
                }
                
            }
        ?>