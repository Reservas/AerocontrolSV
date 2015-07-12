<?php
if(isset($_GET["depcity"]) AND isset($_GET["arrcity"]) AND isset($_GET["isOnlyDep"]))
{
	include "../files/conexion.php";
	
	if($_GET["isOnlyDep"]=='true'){
		//ida y vuelta
		$stmt = $mysqli->prepare("SELECT flights.id,flights.departure_time,flights.cost,flights.seats,flights.description,cities.city,flights.arrival_time,flights.arrival_runway,aircraft.name,airlines.name FROM `flights` INNER JOIN cities ON flights.arrival_city=cities.id INNER JOIN aircraft ON flights.aircraft=aircraft.id INNER JOIN airlines ON flights.airline=airlines.id WHERE flights.departure_city = ? AND flights.arrival_city = ? AND flights.departure_time > (NOW() + INTERVAL 1 DAY) AND flights.seats > 0 ORDER BY flights.arrival_time ASC");
		$stmt->bind_param('ii',$_GET['depcity'],$_GET['arrcity']);
		$stmt->execute();
		$result = $stmt->get_result();
		$row_cnt = $result->num_rows;
		if($row_cnt>0){
			echo "<center><h1>Vuelos de Ida Disponibles </h1></center>";
			while($row = mysqli_fetch_assoc($result))
			{
			
			echo "<div class='col-xs-6'><div class='jumbotron'>
                          <h1>".$row['city']."</h1>
                          <p>".$row['description']."</p>
                          <div style='margin-bottom:3%;'>
                            <a class='btn btn-info'><i class='fa fa-plane'></i>".$row['name']."</a>
                            <a class='btn btn-info'><i class='fa fa-clock-o'></i>".date("D M j y", strtotime($row['departure_time']))."</a>
                             <a class='btn btn-info'><i class='fa fa-users'></i> ".$row['seats']."</a>
                            <a class='btn btn-success'><i class='fa fa-usd'></i> ".$row['cost']."</a>
                          </div>  
                            <p><a id='".$row['id']."' class='btn btn-primary btn-lg comprar'>Comprar</a></p>
                        </div></div>";	
				

			}
			$stmt->bind_param('ii',$_GET['arrcity'],$_GET['depcity']);
			$stmt->execute();
			$result = $stmt->get_result();
			$row_cnt = $result->num_rows;
			if($row_cnt>0){
				echo "<center><h1>Vuelos de Vuelta Disponibles </h1></center>";
				while($row = mysqli_fetch_assoc($result))
				{
				
				echo "<div class='col-xs-6'><div class='jumbotron'>
							  <h1>".$row['city']."</h1>
							  <p>".$row['description']."</p>
							  <div style='margin-bottom:3%;'>
								<a class='btn btn-info'><i class='fa fa-plane'></i>".$row['name']."</a>
								<a class='btn btn-info'><i class='fa fa-clock-o'></i>".date("D M j y", strtotime($row['departure_time']))."</a>
								 <a class='btn btn-info'><i class='fa fa-users'></i> ".$row['seats']."</a>
								<a class='btn btn-success'><i class='fa fa-usd'></i> ".$row['cost']."</a>
							  </div>  
								<p><a id='".$row['id']."' class='btn btn-primary btn-lg comprar'>Comprar</a></p>
							</div></div>";	
					

				}
			}else{
			
				echo "<center><h1>No se encontraron vuelos de vuelta disponibles </h1></center>";
			}
		}else{
		
			echo "<center><h1>No se encontraron vuelos de ida disponibles </h1></center>";
		}
	}else{
		//Solo ida
		$stmt = $mysqli->prepare("SELECT flights.id,flights.departure_time,flights.cost,flights.seats,flights.description,cities.city,flights.arrival_time,flights.arrival_runway,aircraft.name,airlines.name FROM `flights` INNER JOIN cities ON flights.arrival_city=cities.id INNER JOIN aircraft ON flights.aircraft=aircraft.id INNER JOIN airlines ON flights.airline=airlines.id WHERE flights.departure_city = ? AND flights.arrival_city = ? AND flights.departure_time > (NOW() + INTERVAL 1 DAY) AND flights.seats > 0 ORDER BY flights.arrival_time ASC");
		$stmt->bind_param('ii',$_GET['depcity'],$_GET['arrcity']);
		$stmt->execute();
		$result = $stmt->get_result();
		$row_cnt = $result->num_rows;
		if($row_cnt>0){
			echo "<center><h1>Vuelos Disponibles</h1></center>";
			while($row = mysqli_fetch_assoc($result))
			{
			
			echo "<div class='col-xs-6'><div class='jumbotron'>
                          <h1>".$row['city']."</h1>
                          <p>".$row['description']."</p>
                          <div style='margin-bottom:3%;'>
                            <a class='btn btn-info'><i class='fa fa-plane'></i>".$row['name']."</a>
                            <a class='btn btn-info'><i class='fa fa-clock-o'></i>".date("D M j y", strtotime($row['departure_time']))."</a>
                             <a class='btn btn-info'><i class='fa fa-users'></i> ".$row['seats']."</a>
                            <a class='btn btn-success'><i class='fa fa-usd'></i> ".$row['cost']."</a>
                          </div>  
                            <p><a id='".$row['id']."' class='btn btn-primary btn-lg comprar'>Comprar</a></p>
                        </div></div>";	
				

			}
		}else{
		
			echo "<center><h1>No se encontraron vuelos de ida disponibles </h1></center>";
		}
		
	}
	
}