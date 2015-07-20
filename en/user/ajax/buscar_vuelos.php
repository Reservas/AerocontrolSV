<?php
if(isset($_GET["depcity"]) AND isset($_GET["arrcity"]) AND isset($_GET["isOnlyDep"]) AND isset($_GET["airline"]))
{
	include "../files/conexion.php";
	
	if($_GET["isOnlyDep"]=='true'){
		//ida y vuelta
		$stmt = $mysqli->prepare("SELECT flights.id,flights.departure_time,flights.cost,flights.seats,flights.description,cities.city,flights.arrival_time,flights.arrival_runway,aircraft.name,airlines.name FROM `flights` INNER JOIN cities ON flights.arrival_city=cities.id INNER JOIN aircraft ON flights.aircraft=aircraft.id INNER JOIN airlines ON flights.airline=airlines.id WHERE flights.departure_city = ? AND flights.arrival_city = ? AND airlines.id = ? AND flights.departure_time > (NOW() + INTERVAL 1 DAY) AND fl...(line truncated)...
		$stmt->bind_param('iii',$_GET['depcity'],$_GET['arrcity'],$_GET["airline"]);
		$stmt->execute();
		$result = $stmt->get_result();
		$row_cnt = $result->num_rows;
		if($row_cnt>0){
			echo "<h1>Outbound flights available.</h1>";
			while($row = mysqli_fetch_assoc($result))
			{
			
			echo "<div class='col-xs-12'><div class='jumbotron'>
                          <h1>".$row['city']."</h1>
                          <p>".$row['description']."</p>
                          <div style='margin-bottom:3%;'>
                            <a class='btn btn-info'><i class='fa fa-plane'></i>".$row['name']."</a>
                            <a class='btn btn-info'><i class='fa fa-clock-o'></i>".date("D M j y", strtotime($row['departure_time']))."</a>
                             <a class='btn btn-info'><i class='fa fa-users'></i> ".$row['seats']."</a>
                            <a class='btn btn-success'><i class='fa fa-usd'></i> ".$row['cost']."</a>
                          </div>  
                            <p><a id='".$row['id']."' class='btn btn-primary btn-lg comprar'>Buy flights</a></p>
                        </div></div>";	
				

			}
	        $stmt->bind_param('iii',$_GET['arrcity'],$_GET['depcity'],$_GET["airline"]);
            $stmt->execute();
			$result = $stmt->get_result();
			$row_cnt = $result->num_rows;
			if($row_cnt>0){
				echo "<h1>Return flights Available. </h1>";
				while($row = mysqli_fetch_assoc($result))
				{
				
				echo "<div class='col-xs-12'><div class='jumbotron'>
							  <h1>".$row['city']."</h1>
							  <p>".$row['description']."</p>
							  <div style='margin-bottom:3%;'>
								<a class='btn btn-info'><i class='fa fa-plane'></i>".$row['name']."</a>
								<a class='btn btn-info'><i class='fa fa-clock-o'></i>".date("D M j y", strtotime($row['departure_time']))."</a>
								 <a class='btn btn-info'><i class='fa fa-users'></i> ".$row['seats']."</a>
								<a class='btn btn-success'><i class='fa fa-usd'></i> ".$row['cost']."</a>
							  </div>  
								<p><a id='".$row['id']."' class='btn btn-primary btn-lg comprar'>Buy flights</a></p>
							</div></div>";	
					

				}
			}else{
			
				echo "<h1>There are no available flights back. </h1>";
			}
		}else{
		
			echo "<h1>There are no available flights </h1>";
		}
	}else{
		//Solo ida
        $stmt = $mysqli->prepare("SELECT flights.id,flights.departure_time,flights.cost,flights.seats,flights.description,cities.city,flights.arrival_time,flights.arrival_runway,aircraft.name,airlines.name FROM `flights` INNER JOIN cities ON flights.arrival_city=cities.id INNER JOIN aircraft ON flights.aircraft=aircraft.id INNER JOIN airlines ON flights.airline=airlines.id WHERE flights.departure_city = ? AND flights.arrival_city = ? AND airlines.id = ? AND flights.departure_time > (NOW() + INTERVAL 1 DAY) AND fl...(line truncated)...
		$stmt->bind_param('iii',$_GET['depcity'],$_GET['arrcity'],$_GET['airline']);
		$stmt->execute();
		$result = $stmt->get_result();
		$row_cnt = $result->num_rows;
		if($row_cnt>0){
			echo "<h1>Flights available.</h1>";
			while($row = mysqli_fetch_assoc($result))
			{
			
			echo "<div class='col-xs-12'><div class='jumbotron'>
                          <h1>".$row['city']."</h1>
                          <p>".$row['description']."</p>
                          <div style='margin-bottom:3%;'>
                            <a class='btn btn-info'><i class='fa fa-plane'></i>".$row['name']."</a>
                            <a class='btn btn-info'><i class='fa fa-clock-o'></i>".date("D M j y", strtotime($row['departure_time']))."</a>
                             <a class='btn btn-info'><i class='fa fa-users'></i> ".$row['seats']."</a>
                            <a class='btn btn-success'><i class='fa fa-usd'></i> ".$row['cost']."</a>
                          </div>  
                            <p><a id='".$row['id']."' class='btn btn-primary btn-lg comprar'>Buy flights</a></p>
                        </div></div>";	
				

			}
		}else{
		
			echo "<h1>There are no available flights.</h1>";
		}
		
	}
	
}