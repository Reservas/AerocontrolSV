<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">
    <link href="../docs/css/bootstrap.css" rel="stylesheet">
    <link href="../docs/css/font-awesome.css" rel="stylesheet">
    <link href="../docs/css/ionicons.css" rel="stylesheet">
    <script src="../docs/js/bootstrap.js" type="text/javascript"></script>
    <script src="../docs/js/ie-10-view-port.js" type="text/javascript"></script>
    <script src="../docs/js/jquery-1.11.1.js" type="text/javascript"></script>
    <script src="../docs/js/jquery.easing.min.js" type="text/javascript"></script>
    <title>Administración - Agregar avion</title>
</head>
<body>
<div class="container-fluid">
    <div class="row">
    <!-- NAV -->
<script>
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
        <?php include 'nav.php'; ?>
    <!-- /NAV -->
        <h1 class="text-center">Agregar avion</h1>
<?php
session_start();
if(isset($_POST["name"]) AND isset($_POST["airline"]) AND isset($_POST["seats"]) AND isset($_POST["type"]))
{
    $name = $_POST["name"];
    $airline = $_POST["airline"];
	$seats = $_POST["seats"];
	$type = $_POST["type"];
    include "../docs/connect.php";
    $query = mysql_query("INSERT INTO aircraft (id, name, airline, seats, type) VALUES ('','$name','$airline','$seats', '$type')");
    if($query)
    {
        echo "<p class='text-success text-center'><strong>Los datos fueron guardados</strong></p>";
        echo "<p class='text-success text-center'><a href='aircrafts.php'>Lista de aviones</a></p>";
    }
    else
    {
        echo "<p class='text-danger text-center'><strong>Error: los datos no fueron guardados</strong></p>";
        echo "<p class='text-success text-center'><a href='aircrafts.php'>Lista de aviones</a></p>";
    }
}
?>
        <div class="col-md-4 well">
                                                <a href="../../en/admin/addaircraft.php">English/</a><a href="../../es/admin/addaircraft.php">Español</a>
            <h3>Ayuda</h3>
            <p>Se necesita insertar el nombre del <strong>Avion</strong> </p>
        </div>
        <div class="col-md-8">
        <form method="post" action="addaircraft.php">
            <div class="form-group">
				<label for="name">Nombre del avion</label>
				<input type="text" maxlength="50" class="form-control" id="name" name="name" placeholder="Nombre del avion" required>
            </div>
            
            <label for="airline">Aerolinea</label>
			 <div class="form-group">
			  <?php
				if(isset($_SESSION['airline'])){
					echo "<input type='text' class='form-control' id='airlinedes' name='airlinedes' value='".$_SESSION['airname']."' readonly>";
					echo "<input type='hidden' id='airline' name='airline' value='".$_SESSION['airline']."'>";
				}else{
				
			  ?>
            <select class="form-control" name="airline" id="airline" required>
                <option value="">Escoja la aerolinea</option>
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
				<label for="seats">Numero de asientos</label>
				<input type="number"  min="1" step="1" class="form-control" id="seats" name="seats" placeholder="Asientos del avion" required onkeypress='return numeros(event)'>
            </div>
			<div class="form-group">
				<label for="type">Tipo de avion</label>
				<input type="text" maxlength="50" class="form-control" id="type" name="type" placeholder="Tipo de avion" required>
            </div>
            <input type="submit" name="enviar" value="Enviar">
        </form>
        </div>
    </div>    
</div>
</body>
</html>