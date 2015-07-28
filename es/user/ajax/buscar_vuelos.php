<?php
if(isset($_GET["depcity"]) AND isset($_GET["arrcity"]) AND isset($_GET["isOnlyDep"]) AND isset($_GET["airline"]))
{
	include "../files/conexion.php";
	
	if($_GET["isOnlyDep"]=='true'){
		//ida y vuelta
		$stmt = $mysqli->prepare("SELECT flights.id,flights.departure_time,flights.cost,flights.seats,flights.description,cities.city,flights.arrival_time,flights.arrival_runway,aircraft.name,airlines.name FROM `flights` INNER JOIN cities ON flights.arrival_city=cities.id INNER JOIN aircraft ON flights.aircraft=aircraft.id INNER JOIN airlines ON flights.airline=airlines.id WHERE flights.departure_city = ? AND flights.arrival_city = ? AND airlines.id = ? AND flights.departure_time > (NOW() + INTERVAL 1 DAY) AND flights.seats > 0 ORDER BY flights.arrival_time ASC");
		$stmt->bind_param('iii',$_GET['depcity'],$_GET['arrcity'],$_GET["airline"]);
		$stmt->execute();
		$result = $stmt->get_result();
		$row_cnt = $result->num_rows;
		if($row_cnt>0){
			//numero de registros por página
			$rowsPerPage = 2;

			//por defecto mostramos la página 1
			$pageNum = 1;

			// si $_GET['page'] esta definido, usamos este número de página
			if(isset($_GET['pageDep'])) {
				$pageNum = $_GET['pageDep'];
			}
			if(isset($_GET['pageDepa'])) {
				$pageNumd = $_GET['pageDepa'];
			}
			
			//contando el desplazamiento
			$offset = ($pageNum - 1) * $rowsPerPage;
			$total_paginas = ceil($row_cnt / $rowsPerPage);
			
			//realizamos la consulta paginada
			$stmt = $mysqli->prepare("SELECT flights.id,flights.departure_time,flights.cost,flights.seats,flights.description,cities.city,flights.arrival_time,flights.arrival_runway,aircraft.name,airlines.name FROM `flights` INNER JOIN cities ON flights.arrival_city=cities.id INNER JOIN aircraft ON flights.aircraft=aircraft.id INNER JOIN airlines ON flights.airline=airlines.id WHERE flights.departure_city = ? AND flights.arrival_city = ? AND airlines.id = ? AND flights.departure_time > (NOW() + INTERVAL 1 DAY) AND flights.seats > 0 ORDER BY flights.arrival_time ASC LIMIT $offset, $rowsPerPage");
			$stmt->bind_param('iii',$_GET['depcity'],$_GET['arrcity'],$_GET["airline"]);
			$stmt->execute();
			$result = $stmt->get_result();
			echo "<center><h1>Vuelos de Ida Disponibles </h1></center>";
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
                            <p><a id='".$row['id']."' class='btn btn-primary btn-lg comprar'>Comprar</a></p>
                        </div></div>";	
				

			}
			if ($total_paginas > 1) {
				echo '<div class="pagination">';
				echo '<ul>';
					if ($pageNum != 1)
							echo "<li><a href='#' onclick='buscarVuelos(".($pageNum-1).",".$pageNumd.");return false;' class='paginate' >Anterior</a></li>";
						for ($i=1;$i<=$total_paginas;$i++) {
							if ($pageNum == $i)
									//si muestro el índice de la página actual, no coloco enlace
									echo "<li class='active'><a>".$i."</a></li>";
							else
									//si el índice no corresponde con la página mostrada actualmente,
									//coloco el enlace para ir a esa página
									echo "<li><a href='#' onclick='buscarVuelos(".$i.",".$pageNumd.");return false;' class='paginate' >".$i."</a></li>";
					}
					if ($pageNum != $total_paginas)
							echo "<li><a href='#' onclick='buscarVuelos(".($pageNum+1).",".$pageNumd.");return false;' class='paginate' >Siguiente</a></li>";
			   echo '</ul>';
			   echo '</div>';
			}
			$stmt = $mysqli->prepare("SELECT flights.id,flights.departure_time,flights.cost,flights.seats,flights.description,cities.city,flights.arrival_time,flights.arrival_runway,aircraft.name,airlines.name FROM `flights` INNER JOIN cities ON flights.arrival_city=cities.id INNER JOIN aircraft ON flights.aircraft=aircraft.id INNER JOIN airlines ON flights.airline=airlines.id WHERE flights.departure_city = ? AND flights.arrival_city = ? AND airlines.id = ? AND flights.departure_time > (NOW() + INTERVAL 1 DAY) AND flights.seats > 0 ORDER BY flights.arrival_time ASC");
			$stmt->bind_param('iii',$_GET['arrcity'],$_GET['depcity'],$_GET["airline"]);
			$stmt->execute();
			$result = $stmt->get_result();
			$row_cnt = $result->num_rows;
			if($row_cnt>0){
				//numero de registros por página
				$rowsPerPage = 2;

				//por defecto mostramos la página 1
				$pageNumd = 1;

				// si $_GET['page'] esta definido, usamos este número de página
				if(isset($_GET['pageDep'])) {
					$pageNum = $_GET['pageDep'];
				}
				if(isset($_GET['pageDepa'])) {
					$pageNumd = $_GET['pageDepa'];
				}
				
				//contando el desplazamiento
				$offset = ($pageNumd - 1) * $rowsPerPage;
				$total_paginas = ceil($row_cnt / $rowsPerPage);
				
				//realizamos la consulta paginada
				$stmt = $mysqli->prepare("SELECT flights.id,flights.departure_time,flights.cost,flights.seats,flights.description,cities.city,flights.arrival_time,flights.arrival_runway,aircraft.name,airlines.name FROM `flights` INNER JOIN cities ON flights.arrival_city=cities.id INNER JOIN aircraft ON flights.aircraft=aircraft.id INNER JOIN airlines ON flights.airline=airlines.id WHERE flights.departure_city = ? AND flights.arrival_city = ? AND airlines.id = ? AND flights.departure_time > (NOW() + INTERVAL 1 DAY) AND flights.seats > 0 ORDER BY flights.arrival_time ASC LIMIT $offset, $rowsPerPage");
				$stmt->bind_param('iii',$_GET['arrcity'],$_GET['depcity'],$_GET["airline"]);
				$stmt->execute();
				$result = $stmt->get_result();
				echo "<center><h1>Vuelos de Vuelta Disponibles </h1></center>";
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
								<p><a id='".$row['id']."' class='btn btn-primary btn-lg comprar'>Comprar</a></p>
							</div></div>";	

				}
				if ($total_paginas > 1) {
				echo '<div class="pagination">';
				echo '<ul>';
					if ($pageNumd != 1)
							echo "<li><a href='#' onclick='buscarVuelos(".$pageNum.",".($pageNumd-1).");return false;' class='paginate' >Anterior</a></li>";
						for ($i=1;$i<=$total_paginas;$i++) {
							if ($pageNumd == $i)
									//si muestro el índice de la página actual, no coloco enlace
									echo "<li class='active'><a>".$i."</a></li>";
							else
									//si el índice no corresponde con la página mostrada actualmente,
									//coloco el enlace para ir a esa página
									echo "<li><a href='#' onclick='buscarVuelos(".$pageNum.",".$i.");return false;' class='paginate' >".$i."</a></li>";
					}
					if ($pageNumd != $total_paginas)
							echo "<li><a href='#' onclick='buscarVuelos(".$pageNum.",".($pageNumd+1).");return false;' class='paginate' >Siguiente</a></li>";
			   echo '</ul>';
			   echo '</div>';
			}	
			}else{
			
				echo "<center><h1>No se encontraron vuelos de vuelta disponibles </h1></center>";
			}
		}else{
		
			echo "<center><h1>No se encontraron vuelos de ida disponibles </h1></center>";
		}
	}else{
		//Solo ida
		$stmt = $mysqli->prepare("SELECT flights.id,flights.departure_time,flights.cost,flights.seats,flights.description,cities.city,flights.arrival_time,flights.arrival_runway,aircraft.name,airlines.name FROM `flights` INNER JOIN cities ON flights.arrival_city=cities.id INNER JOIN aircraft ON flights.aircraft=aircraft.id INNER JOIN airlines ON flights.airline=airlines.id WHERE flights.departure_city = ? AND flights.arrival_city = ? AND airlines.id = ? AND flights.departure_time > (NOW() + INTERVAL 1 DAY) AND flights.seats > 0 ORDER BY flights.arrival_time ASC");
		$stmt->bind_param('iii',$_GET['depcity'],$_GET['arrcity'],$_GET['airline']);
		$stmt->execute();
		$result = $stmt->get_result();
		$row_cnt = $result->num_rows;
		if($row_cnt>0){
			//numero de registros por página
			$rowsPerPage = 2;

			//por defecto mostramos la página 1
			$pageNum = 1;

			// si $_GET['page'] esta definido, usamos este número de página
			if(isset($_GET['pageDep'])) {
				$pageNum = $_GET['pageDep'];
			}
			if(isset($_GET['pageDepa'])) {
				$pageNumd = $_GET['pageDepa'];
			}
			
			//contando el desplazamiento
			$offset = ($pageNum - 1) * $rowsPerPage;
			$total_paginas = ceil($row_cnt / $rowsPerPage);
			
			//realizamos la consulta paginada
			$stmt = $mysqli->prepare("SELECT flights.id,flights.departure_time,flights.cost,flights.seats,flights.description,cities.city,flights.arrival_time,flights.arrival_runway,aircraft.name,airlines.name FROM `flights` INNER JOIN cities ON flights.arrival_city=cities.id INNER JOIN aircraft ON flights.aircraft=aircraft.id INNER JOIN airlines ON flights.airline=airlines.id WHERE flights.departure_city = ? AND flights.arrival_city = ? AND airlines.id = ? AND flights.departure_time > (NOW() + INTERVAL 1 DAY) AND flights.seats > 0 ORDER BY flights.arrival_time ASC LIMIT $offset, $rowsPerPage");
			$stmt->bind_param('iii',$_GET['depcity'],$_GET['arrcity'],$_GET["airline"]);
			$stmt->execute();
			$result = $stmt->get_result();
			echo "<center><h1>Vuelos Disponibles</h1></center>";
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
                            <p><a id='".$row['id']."' class='btn btn-primary btn-lg comprar'>Comprar</a></p>
                        </div></div>";	
				

			}
			if ($total_paginas > 1) {
				echo '<div class="pagination">';
				echo '<ul>';
					if ($pageNum != 1)
							echo "<li><a href='#' onclick='buscarVuelos(".($pageNum-1).",".$pageNumd.");return false;' class='paginate' >Anterior</a></li>";
						for ($i=1;$i<=$total_paginas;$i++) {
							if ($pageNum == $i)
									//si muestro el índice de la página actual, no coloco enlace
									echo "<li class='active'><a>".$i."</a></li>";
							else
									//si el índice no corresponde con la página mostrada actualmente,
									//coloco el enlace para ir a esa página
									echo "<li><a href='#' onclick='buscarVuelos(".$i.",".$pageNumd.");return false;' class='paginate' >".$i."</a></li>";
					}
					if ($pageNum != $total_paginas)
							echo "<li><a href='#' onclick='buscarVuelos(".($pageNum+1).",".$pageNumd.");return false;' class='paginate' >Siguiente</a></li>";
			   echo '</ul>';
			   echo '</div>';
			}
		}else{
		
			echo "<center><h1>No se encontraron vuelos de ida disponibles </h1></center>";
		}
		
	}
	
}