<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">
    <link href="../docs/css/bootstrap.css" rel="stylesheet">
    <link href="../docs/css/font-awesome.css" rel="stylesheet">
    <link href="../docs/css/ionicons.css" rel="stylesheet">
    <script src="../docs/js/bootstrap.js" type="text/javascript"></script>
	<link href="../docs/css/jquery-ui.min.css" rel="stylesheet">
	<link href="../docs/css/jquery-ui-timepicker-addon.css" rel="stylesheet">
    <script src="../docs/js/ie-10-view-port.js" type="text/javascript"></script>
    <script src="../docs/js/jquery-1.11.1.js" type="text/javascript"></script>
    <script src="../docs/js/jquery.easing.min.js" type="text/javascript"></script>
	<script src="../docs/js/jquery-ui.min.js" type="text/javascript"></script>
	<script src="../docs/js/jquery-ui-timepicker-addon.js" type="text/javascript"></script>
	<script type="text/javascript">
		function findAircraftsByAirlineEdit(airline, aircraft){
			$.ajax({
					type : "GET",
					dataType : 'html',
					async : true,
					data : {
						airline : airline,
						aircraft : aircraft
					},
					url : "aircrafts_by_airline.php",
					success : function(response) {
						$('.aircrafts').html(response);
					},
					error : function(e, error) {
						alert(error);
					}
				});
		}
	</script>
    <title>Administración - Editar vuelo</title>
</head>
<body>
<div class="container-fluid">
    <div class="row">
    <!-- NAV -->
    <?php include 'nav.php'; ?>
    <!-- /NAV -->
        <h1 class="text-center">Editando datos de un vuelo</h1>
<?php
if(isset($_POST["id"]) AND isset($_POST["airline"]) AND isset($_POST["aircraft"]) AND isset($_POST["arrival_city"]) AND isset($_POST["arrival_runway"]) AND isset($_POST["arrival_time"]) AND isset($_POST["cost"]) AND isset($_POST["departure_city"]) AND isset($_POST["departure_runway"]) AND isset($_POST["departure_time"]) AND isset($_POST["description"]) AND isset($_POST["seats"]))
{
    $id = $_POST["id"];
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
    include "../docs/connect.php";
    $query = mysql_query("UPDATE flights SET airline='$airline',departure_time='$departure_time',departure_city='$departure_city',arrival_time='$arrival_time',arrival_city='$arrival_city',aircraft='$aircraft',departure_runway='$departure_runway',arrival_runway='$arrival_runway',cost='$cost',seats='$seats',description='$description' WHERE id = $id");
    if($query)
    {
        echo "<p class='text-success text-center'><strong>Los datos del vuelo &quot;".$id."&quot; fueron guardados</strong></p>";
        echo "<p class='text-success text-center'><a href='flights.php'>Lista de vuelos</a></p>";
    }
    else
    {
        echo "<p class='text-danger text-center'><strong>Error: los datos no fueron guardados</strong></p>";
        echo "<p class='text-success text-center'><a href='flights.php'>Lista de vuelos</a></p>";
    }
}
else
{
    if(isset($_GET["flight"]))
    {
        include "../docs/connect.php";
        $idr = $_GET["flight"];
        $query = "SELECT f.id, f.airline, a.name AS airlinename, f.departure_time, f.departure_city, c1.city AS depcity, f.arrival_time, f.arrival_city, c2.city AS arrcity, f.aircraft, ac.name AS aircname, f.departure_runway, f.arrival_runway, f.cost, f.seats, f.description FROM flights f INNER JOIN airlines a ON f.airline = a.id INNER JOIN cities c1 ON f.departure_city = c1.id INNER JOIN cities c2 ON f.arrival_city = c2.id INNER JOIN aircraft ac ON f.aircraft = ac.id WHERE f.id = $idr";
        $resultado = mysql_query($query, $link);
        $total = mysql_num_rows($resultado);
        if($total == 1)
        {
            while($row = mysql_fetch_array($resultado))
            {
?>
        <div class="col-md-4 well">
            <h3>Ayuda</h3>
            <p>Aquí podrás editar todo lo referente al vuelo</p>
            <p>A sdglbsfg fgr rgiuf <strong>texto negrita</strong> uwehiw  goegpe fgubgr gwurgif sdqjerpqn asflbdfkjbsdkgj sglbd flsdf sdfbjsdkfb sdkfb</p>
        </div>
        <div class="col-md-8">
        <form method="post" action="editflight.php">
            <div class="form-group">
            <label for="id">ID del vuelo (No se puede editar)</label>
            <input type="text" class="form-control" id="id" name="id" value="<?=$row["id"]?>"  readonly>
            </div>
           <div class="form-group">
				<label for="airline">Aerolinea (actual <?= $row["airlinename"]?>)</label>	
				<select class="form-control" name="airline" id="airline" onchange="findAircraftsByAirlineEdit(this.value);" required>
					<option value="">Escoja la aerolinea </option>
					<?php
						include "../docs/connect.php";
						$query = "SELECT id, name FROM airlines ORDER BY id";
						$resultado = mysql_query($query, $link);
						$total = mysql_num_rows($resultado);
						if($total>0)
						{
							while($rowx1 = mysql_fetch_array($resultado))
							{
								 if($row['airline'] == $rowx1['id'])
								{ 
									echo "<option value='".$rowx1['id']."' selected='selected'>".$rowx1['name']."</option>";
								}else{
									echo "<option value='".$rowx1['id']."'>".$rowx1['name']."</option>";
								}
							}                    
						}
					?>
				</select>
			</div>
			<div class="form-group">
				<label for="airline">Avion (actual <?= $row["aircname"]?>)</label>	
				<select class="form-control aircrafts" name="aircraft" id="aircraft" required>
				</select>
				<script type="text/javascript">
							$(function () {
								findAircraftsByAirlineEdit('<?= $row["airline"]?>', '<?= $row["aircraft"]?>');
							});
						</script>
			</div>
			<div class="form-group">
				<label for="arrival_city">Ciudad destino (actual <?= $row["arrcity"]?>)</label>	
				<select class="form-control" name="arrival_city" id="arrival_city" required>
					<option value="">Escoja la ciudad - Estado</option>
					<?php
						include "../docs/connect.php";
						$query = "SELECT id, city, state FROM cities ORDER BY id";
						$resultado = mysql_query($query, $link);
						$total = mysql_num_rows($resultado);
						if($total>0)
						{
							while($rowx2 = mysql_fetch_array($resultado))
							{
								if($row['arrival_city'] == $rowx2['id'])
								{ 
									echo "<option value='".$rowx2['id']."' selected='selected'>".$rowx2['city']." - ".$rowx2['state']."</option>";
								}else{
									echo "<option value='".$rowx2['id']."'>".$rowx2['city']." - ".$rowx2['state']."</option>";
								}
							}                    
						}
					?>
				</select>
			</div>
			<div class="form-group">
				<label for="arrival_runway">Pista destino (actual <?= $row["arrival_runway"]?>)</label>	
				<select class="form-control" name="arrival_runway" id="arrival_runway" required>
					<option value="">Escoja la pista</option>
					<?php
						include "../docs/connect.php";
						$query = "SELECT id FROM runways ORDER BY id";
						$resultado = mysql_query($query, $link);
						$total = mysql_num_rows($resultado);
						if($total>0)
						{
							while($rowx3 = mysql_fetch_array($resultado))
							{
								if($row['arrival_runway'] == $rowx3['id'])
								{ 
									echo "<option value='".$rowx3['id']."' selected='selected'>".$rowx3['id']."</option>";
								}else{
									echo "<option value='".$rowx3['id']."'>".$rowx3['id']."</option>";
								}
							}                    
						}
					?>
				</select>
			</div>
			<div class="form-group">
				<label for="arrival_time">Fecha llegada</label>
						<input type='text' class="form-control" name="arrival_time" id="arrival_time" value="<?=$row["arrival_time"]?>" required>
						<script type="text/javascript">
							$(function () {
								$('#arrival_time').datetimepicker({dateFormat: 'yy-mm-dd', timeFormat: 'HH:mm:ss'});
							});
						</script>
            </div>
			<div class="form-group">
				<label for="cost">Costo</label>
				<input type="number"  class="form-control" id="cost" name="cost" placeholder="Costo del vuelo" value="<?=$row["cost"]?>" required>
            </div>
			<div class="form-group">
				<label for="departure_city">Ciudad de salida (actual <?= $row["depcity"]?>)</label>	
				<select class="form-control" name="departure_city" id="departure_city" required>
					<option value="">Escoja la ciudad - Estado</option>
					<?php
						include "../docs/connect.php";
						$query = "SELECT id, city, state FROM cities ORDER BY id";
						$resultado = mysql_query($query, $link);
						$total = mysql_num_rows($resultado);
						if($total>0)
						{
							while($rowx4 = mysql_fetch_array($resultado))
							{
								if($row['departure_city'] == $rowx4['id'])
								{ 
									echo "<option value='".$rowx4['id']."' selected='selected'>".$rowx4['city']." - ".$rowx4['state']."</option>";
								}else{
									echo "<option value='".$rowx4['id']."'>".$rowx4['city']." - ".$rowx4['state']."</option>";
								}
							}                    
						}
					?>
				</select>
			</div>
			<div class="form-group">
				<label for="departure_runway">Pista de salida (actual <?= $row["departure_runway"]?>)</label>	
				<select class="form-control" name="departure_runway" id="departure_runway" required>
					<option value="">Escoja la pista</option>
					<?php
						include "../docs/connect.php";
						$query = "SELECT id FROM runways ORDER BY id";
						$resultado = mysql_query($query, $link);
						$total = mysql_num_rows($resultado);
						if($total>0)
						{
							while($rowx5 = mysql_fetch_array($resultado))
							{
								if($row['departure_runway'] == $rowx5['id'])
								{ 
									echo "<option value='".$rowx5['id']."' selected='selected'>".$rowx5['id']."</option>";
								}else{
									echo "<option value='".$rowx5['id']."'>".$rowx5['id']."</option>";
								}
							}                    
						}
					?>
				</select>
			</div>
			<div class="form-group">
				<label for="departure_time">Fecha de salida</label>
						<input type='text' class="form-control" name="departure_time" id="departure_time" value="<?=$row["departure_time"]?>" required>
						<script type="text/javascript">
							$(function () {
								$('#departure_time').datetimepicker({dateFormat: 'yy-mm-dd', timeFormat: 'HH:mm:ss'});
							});
						</script>
            </div>
			<div class="form-group">
				<label for="seats">Numero de asientos</label>
				<input type="number"  min="1" step="1" class="form-control" id="seats" name="seats" placeholder="Asientos del avion" value="<?=$row["seats"]?>" required>
            </div>
			<div class="form-group">
				<label for="type">Descripcion</label>
				<input type="text" maxlength="500" class="form-control" id="description" name="description" placeholder="Descripcion del vuelo" value="<?=$row["description"]?>" required>
            </div>
            <input type="submit" name="enviar" value="Enviar">
        </form>
        </div>        
<?php
            }
        }
        else
        {
            echo "<p class='text-danger text-center'><strong>Error: el vuelo no existe. <a href='runways.php'>Lista de vuelos</a></strong></p>"; 
        }
    }
    else
    {
        echo "<p class='text-danger text-center'><strong>Error: no hay id de vuelo. <a href='runways.php'>Lista de vuelos</a></strong></p>"; 
    }
}
?>
    </div>    
</div>
</body>
</html>
