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
        ?>
              <div class="panel panel-primary">
                <a href="../../en/user/compras.php"> <img src="../../base_de_datos/Ingles.jpg" class="redondo" width=60 height=30/></a>
                <a href="compras.php"> <img src="../../base_de_datos/descarga" class="redondo"  width="60" height="30"/> </a> 
        
            <?php
                 
                 if(isset($_GET['s'])) {
                    echo "<div class='alert alert-dismissible alert-success'>
  <button type='button' class='close' data-dismiss='alert'>×</button>
  <strong>Muy bien!</strong> La conpra fue realizada satisfactoriamente</a>.
</div>";
                 }
				 if(isset($_GET['c'])) {
                    echo "<div class='alert alert-dismissible alert-success'>
  <button type='button' class='close' data-dismiss='alert'>×</button>
  <strong>Muy bien!</strong> La cancelacion fue realizada satisfactoriamente</a>.
</div>";
                 }
				 if(isset($_GET['e'])) {
                   echo "<div class='alert alert-dismissible alert-danger'>
  <button type='button' class='close' data-dismiss='alert'>×</button>
  <strong>ERROR!</strong> <a href='#' class='alert-link'>Ocurrio un error al cancelar.
</div>";
                }
                 include "files/conexion.php";
                $stmt = $mysqli->prepare("SELECT bookings.id as bookid,flights.id,bookings.seats,flights.departure_time,flights.cost,flights.seats,flights.description,cities.city,flights.arrival_time,flights.arrival_runway,aircraft.name,airlines.name FROM `bookings` INNER JOIN flights ON bookings.flight=flights.id INNER JOIN costumers ON costumers.id=bookings.costumer INNER JOIN cities ON flights.arrival_city=cities.id INNER JOIN aircraft ON flights.aircraft=aircraft.id INNER JOIN airlines ON flights.airline=airlines.id WHERE costumers.id = ? AND bookings.is_cancelled = 0 ORDER BY `flights`.`arrival_time` ASC");
        $stmt->bind_param('i',$_SESSION['id']);
        $stmt->execute(); 
        $stmt->store_result();
		$rows = $stmt->num_rows;
		if($rows > 0){
			
			//numero de registros por página
			$rowsPerPage = 4;

			//por defecto mostramos la página 1
			$pageNum = 1;

			// si $_GET['page'] esta definido, usamos este número de página
			if(isset($_GET['page'])) {
				$pageNum = $_GET['page'];
			}
			
			//contando el desplazamiento
			$offset = ($pageNum - 1) * $rowsPerPage;
			$total_paginas = ceil($rows / $rowsPerPage);
			
			//realizamos la consulta paginada
			$stmt = $mysqli->prepare("SELECT bookings.id as bookid,flights.id,bookings.seats,flights.departure_time,flights.cost,flights.seats,flights.description,cities.city,flights.arrival_time,flights.arrival_runway,aircraft.name,airlines.name FROM `bookings` INNER JOIN flights ON bookings.flight=flights.id INNER JOIN costumers ON costumers.id=bookings.costumer INNER JOIN cities ON flights.arrival_city=cities.id INNER JOIN aircraft ON flights.aircraft=aircraft.id INNER JOIN airlines ON flights.airline=airlines.id WHERE costumers.id = ? AND bookings.is_cancelled = 0 ORDER BY `flights`.`arrival_time` ASC LIMIT $offset, $rowsPerPage");
			$stmt->bind_param('i',$_SESSION['id']);
			$stmt->execute(); 
			$stmt->store_result();
			$stmt->bind_result($bookid,$id,$seat,$departure_time,$cost,$seats,$description,$arrival_city,$arrival_time,$arrival_runway,$aircraft,$airline);
			$resta = 0;
			echo "<div class='col-xs-12'>
				<center><h1>Tus vuelos</h1></center>
				<div class='container'>";
			 while ($stmt->fetch()) {
				 
				  $date = new DateTime($arrival_time);
					$now = new DateTime();
					$newFormatDep =  date(" M -j -Y", strtotime($departure_time));
					$resta = $date->diff($now)->format("%h horas, %i minutos y %s segundos");
					$restaDos = $date->diff($now)->format("%h");
						if($restaDos <= 24) {
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
								<input type='button' value='Cancelar Vuelo' class='btn btn-danger' onclick='cancelarVuelo($bookid);'>
							  
								
							</div></div>";
						}
			 }
			 
			 if ($total_paginas > 1) {
				echo '<div class="pagination">';
				echo '<ul>';
					if ($pageNum != 1)
							echo "<li><a href='compras.php?page=".($pageNum-1)."' class='paginate' >Anterior</a></li>";
						for ($i=1;$i<=$total_paginas;$i++) {
							if ($pageNum == $i)
									//si muestro el índice de la página actual, no coloco enlace
									echo "<li class='active'><a>".$i."</a></li>";
							else
									//si el índice no corresponde con la página mostrada actualmente,
									//coloco el enlace para ir a esa página
									echo "<li><a href='compras.php?page=".$i."' class='paginate' data='".$i."'>".$i."</a></li>";
					}
					if ($pageNum != $total_paginas)
							echo "<li><a href='compras.php?page=".($pageNum+1)."' class='paginate' data='".($pageNum+1)."'>Siguiente</a></li>";
			   echo '</ul>';
			   echo '</div>';
			}
		}
         echo "</div></div>";
        ?>
        
            
    <script>
		function cancelarVuelo(id){
			$.ajax({
				type : "GET",
				dataType : 'html',
				async : true,
				data : {
					bookid : id
				},
				url : "ajax/loadmodal_cancelar.php",
				success : function(response) {
					$("#myModal").html(response);
					$('#myModal').modal('show');
				},
					error : function(e, error) {
						alert(error);
				}
			});
			 
		}
        $( document ).ready(function() {
            $(".3").addClass("active"); 
        });
    </script>
	<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	</div>
	</div>
    </body>
    </div>
</html>
<?php
             }
?>