<!DOCTYPE html>
<html lang="es">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">
    <link href="../docs/css/bootstrap.css" rel="stylesheet">
    <link href="../docs/css/font-awesome.css" rel="stylesheet">
    <link href="../docs/css/ionicons.css" rel="stylesheet">
    <link href="../docs/css/style.css" rel="stylesheet">
	<link href="../docs/css/jquery-ui.min.css" rel="stylesheet">
	<link href="../docs/css/jquery-ui-timepicker-addon.css" rel="stylesheet">
    <script src="../docs/js/ie-10-view-port.js" type="text/javascript"></script>
    <script src="../docs/js/jquery-1.11.1.js" type="text/javascript"></script>
	<script src="../docs/js/bootstrap.js" type="text/javascript"></script>
	<script src="../docs/js/jquery-ui.min.js" type="text/javascript"></script>
	<script src="../docs/js/jquery-ui-timepicker-addon.js" type="text/javascript"></script>
	<script type="text/javascript">
function findAircraftsByAirline(airline){
			$.ajax({
					type : "GET",
					dataType : 'html',
					async : true,
					data : {
						airline : airline
					},
					url : "aircrafts_by_airline.php",
					success : function(response) {
						$('.aircrafts').html(response);
					},
					error : function(e, error) {
						alert(error);
					}
				});
		}function findSeatsByAircraft(seats){
			$.ajax({
					type : "GET",
					dataType : 'html',
					async : true,
					data : {
						seats : seats
					},
					url : "seats_by_aircrafts.php",
					success : function(response) {
						$('.seats').val(response);
					},
					error : function(e, error) {
						alert(e);
					}
				});
	</script>
    <title>Administraci&oacute;n - Agregar vuelos</title>
</head>
<body>
<div class="container-fluid">
    <div class="row">
        <!--NAV-->
        <script>
function validar(e) { // 1
    tecla = (document.all) ? e.keyCode : e.which; // 2
    if (tecla==8) return true; // 3
    patron =/[A-Za-z\s]/; // 4
    te = String.fromCharCode(tecla); // 5
    return patron.test(te); // 6
}
        function numeros(e){
    key = e.keyCode || e.which;
    tecla = String.fromCharCode(key).toLowerCase();
    letras = " 0123456789";
    especiales = [8];
 
    tecla_especial = false
    for(var i in especiales){
 if(key == especiales[i]){
     tecla_especial = true;
     break;
        } 
    }
 
    if(letras.indexOf(tecla)==-1 && !tecla_especial)
        return false;
}
            
        </script>
    <!-- NAV -->
    <?php include 'nav.php'; ?>
    <!-- /NAV -->
        <h1 class="text-center">Agregar vuelo</h1>
<?php
session_start();
if(isset($_POST["airline"]) AND isset($_POST["aircraft"]) AND isset($_POST["arrival_city"]) AND isset($_POST["arrival_runway"]) AND isset($_POST["arrival_time"]) AND isset($_POST["cost"]) AND isset($_POST["departure_city"]) AND isset($_POST["departure_runway"]) AND isset($_POST["departure_time"]) AND isset($_POST["description"]) AND isset($_POST["seats"]))
{   
    $airline = $_POST["airline"];
	$aircraft = $_POST["aircraft"];
	$arrival_city = $_POST["arrival_city"];
	$arrival_runway = $_POST["arrival_runway"];
	$arrival_time = $_POST["arrival_time"];
	$cost = $_POST["cost"];
	$departure_city = $_POST["departure_city"];
	$departure_runway = $_POST["departure_runway"];
	$departure_time = $_POST["departure_time"];
	$description = $_POST["description"];
	$seats = $_POST["seats"];
    
    if($arrival_city == $departure_city){
        echo "<script>alert('La ciudad de partida, no puede ser la misma que la de llegada'); window.history.goback();</script>";
    }elseif($arrival_time > $daten){
     echo "<script>alert('Seleccionar fechas anteriores a la de hoy, no está permitido'); window.history.goback();</script>";
     }elseif($departure_time > $daten){
        echo "<script>alert('Seleccionar fechas anteriores a la de hoy, no está permitido'); window.history.goback();</script>";
     }else{
    
        include "../docs/connect.php";
        $query = mysql_query("INSERT INTO flights(id, airline, departure_time, departure_city, arrival_time, arrival_city, aircraft, departure_runway, arrival_runway, cost, seats, description) VALUES ('','$airline','$departure_time','$departure_city','$arrival_time','$arrival_city','$aircraft','$departure_runway','$arrival_runway','$cost','$seats','$description')");
        if($query)
        {
            echo "<p class='text-success text-center'><strong>Los datos fueron guardados</strong></p>";
            echo "<p class='text-success text-center'><a href='flights.php'>Lista de vuelos</a></p>";
            echo $departure_time;
        }
        else
        {
            echo "<p class='text-danger text-center'><strong>Error: los datos no fueron guardados</strong></p>";
            echo "<p class='text-success text-center'><a href='flights.php'>Lista de vuelos</a></p>";
        }
    }
}
?>
        <div class="col-md-4 well">
            <a href="../../en/admin/addflight.php"> <img src="../../base_de_datos/Ingles.jpg" class="redondo" width=60 height=30/></a>
<a href="addflight.php"> <img src="../../base_de_datos/descarga" class="redondo"  width="60" height="30"/> </a>
            <h3>Ayuda</h3>
            <p>Se necesita insertar el <strong>vuelo</strong> </p>
        </div>
       
        <div class="col-md-8">
        <form method="post" action="addflight.php">
            <div class="form-group">
				<label for="airline">Aerol&iacute;nea</label>
				<?php
				if(isset($_SESSION['airline'])){
					echo "<input type='text' class='form-control' id='airlinedes' name='airlinedes' value='".$_SESSION['airname']."' readonly>";
					echo "<input type='hidden' id='airline' name='airline' value='".$_SESSION['airline']."'>";
					echo "<script type='text/javascript'>
							$(function () {
								findAircraftsByAirline(".$_SESSION['airline'].");
							});
						</script>";
				}else{
				
			  ?>
				<select class="form-control" name="airline" id="airline" onchange="findAircraftsByAirline(this.value);" required>
					<option value="">Escoja la aerol&iacute;nea</option>
					<?php
						include "../docs/connect.php";
						$query = "SELECT id, name FROM airlines ORDER BY id";
						$resultado = mysql_query($query, $link);
						$total = mysql_num_rows($resultado);
						if($total>0)
						{
							while($row = mysql_fetch_array($resultado))
							{
								echo "<option value='".$row['id']."'>".$row['name']."</option>";
							}                    
						}
					?>
				</select>
				<?php
				}
			?>
			</div>
			<div class="form-group">
				<label for="airline">Avi&oacute;n</label>	
				<select class="form-control aircrafts" name="aircraft" id="aircraft" required onchange="findSeatsByAircraft(this.value);">
				</select>
			</div>
			<div class="form-group">
				<label for="arrival_city">Ciudad destino</label>	
				<select class="form-control" name="arrival_city" id="arrival_city" required>
					<option value="">Escoja la ciudad - Estado</option>
					<?php
						include "../docs/connect.php";
						$query = "SELECT id, city, state FROM cities ORDER BY id";
						$resultado = mysql_query($query, $link);
						$total = mysql_num_rows($resultado);
						if($total>0)
						{
							while($row = mysql_fetch_array($resultado))
							{
								echo "<option value='".$row['id']."'>".$row['city']." - ".$row['state']."</option>";
							}                    
						}
					?>
				</select>
			</div>
			<div class="form-group">
				<label for="arrival_runway">Pista destino</label>	
				<select class="form-control" name="arrival_runway" id="arrival_runway" required>
					<option value="">Escoja la pista</option>
					<?php
						include "../docs/connect.php";
						$query = "SELECT id FROM runways ORDER BY id";
						$resultado = mysql_query($query, $link);
						$total = mysql_num_rows($resultado);
						if($total>0)
						{
							while($row = mysql_fetch_array($resultado))
							{
								echo "<option value='".$row['id']."'>".$row['id']."</option>";
							}                    
						}
					?>
				</select>
			</div>
			<div class="form-group">
				<label for="arrival_time">Fecha llegada</label>
						<input type='text' class="form-control" name="arrival_time" id="arrival_time" required>
						<script type="text/javascript">
							$(function () {
								$('#arrival_time').datetimepicker({dateFormat: 'yy-mm-dd', timeFormat: 'HH:mm:ss'});
							});
						</script>
            </div>
			<div class="form-group">
				<label for="cost">Costo</label>
				<input type="number"  class="form-control" id="cost" name="cost" placeholder="Costo del vuelo" required>
            </div>
			<div class="form-group">
				<label for="departure_city">Ciudad de salida</label>	
				<select class="form-control" name="departure_city" id="departure_city" required>
					<option value="">Escoja la ciudad - Estado</option>
					<?php
						include "../docs/connect.php";
						$query = "SELECT id, city, state FROM cities ORDER BY id";
						$resultado = mysql_query($query, $link);
						$total = mysql_num_rows($resultado);
						if($total>0)
						{
							while($row = mysql_fetch_array($resultado))
							{
								echo "<option value='".$row['id']."'>".$row['city']." - ".$row['state']."</option>";
							}                    
						}
					?>
				</select>
			</div>
			<div class="form-group">
				<label for="departure_runway">Pista de salida</label>	
				<select class="form-control" name="departure_runway" id="departure_runway" required>
					<option value="">Escoja la pista</option>
					<?php
						include "../docs/connect.php";
						$query = "SELECT id FROM runways ORDER BY id";
						$resultado = mysql_query($query, $link);
						$total = mysql_num_rows($resultado);
						if($total>0)
						{
							while($row = mysql_fetch_array($resultado))
							{
								echo "<option value='".$row['id']."'>".$row['id']."</option>";
							}                    
						}
					?>
				</select>
			</div>
			<div class="form-group">
				<label for="departure_time">Fecha de salida</label>
						<input type='text' class="form-control" name="departure_time" id="departure_time" required>
						<script type="text/javascript">
							$(function () {
								$('#departure_time').datetimepicker({dateFormat: 'yy-mm-dd', timeFormat: 'HH:mm:ss'});
							});
						</script>
            </div>
			<div class="form-group">
				<label for="seats">N&uacute;mero de asientos</label>
				<input type="number"  min="1" step="1" class="form-control" id="seats"  name="seats" placeholder="Asientos del avion" required onkeypress="return numeros(event)" ReadOnly>
            </div>
			<div class="form-group">
				<label for="type">Descripci&oacute;n</label>
				<input type="text" maxlength="500" class="form-control" id="description" name="description" placeholder="Descripcion del vuelo" required>
            </div>
            <input type="submit" name="enviar" value="Enviar">
        </form>
        </div>
    </div>    
</div>
</body>
</html>