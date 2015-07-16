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
    <title>Administraci&oacute;n - Editar avion</title>
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
function letras(e){
    key = e.keyCode || e.which;
    tecla = String.fromCharCode(key).toLowerCase();
    letras = "abcdefghijklmnñopqrstuvwxyz";
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
                               <a href="../../en/admin/edithaircraft.php">English/</a><a href="../../es/admin/edithaircraft.php">Espa&ntilde;ol</a>
    <!-- /NAV -->
        <h1 class="text-center">Editando datos de un avi&oacute;n</h1>
<?php
session_start();
if(isset($_POST["id"]) AND isset($_POST["name"]) AND isset($_POST["airline"]) AND isset($_POST["seats"]) AND isset($_POST["type"]))
{
    $id = $_POST["id"];
    $name = $_POST["name"];
    $airline = $_POST["airline"];
	$seats = $_POST["seats"];
	$type = $_POST["type"];
    include "../docs/connect.php";
    $query = mysql_query("UPDATE aircraft SET name = '$name', airline = '$airline', seats = '$seats', type = '$type' WHERE id = $id");
    if($query)
    {
        echo "<p class='text-success text-center'><strong>Los datos del avion &quot;".$name."&quot; fueron guardados</strong></p>";
        echo "<p class='text-success text-center'><a href='aircrafts.php'>Lista de aviones</a></p>";
    }
    else
    {
        echo "<p class='text-danger text-center'><strong>Error: los datos no fueron guardados</strong></p>";
        echo "<p class='text-success text-center'><a href='aircrafts.php'>Lista de aviones</a></p>";
    }
}
else
{
    if(isset($_GET["aircraft"]))
    {
        include "../docs/connect.php";
        $idr = $_GET["aircraft"];
        $query = "SELECT aircraft.id, aircraft.name, aircraft.seats, aircraft.type, airlines.id AS airid, airlines.name AS airline FROM aircraft  INNER JOIN airlines ON aircraft.airline = airlines.id WHERE aircraft.id = '$idr'";
        $resultado = mysql_query($query, $link);
        $total = mysql_num_rows($resultado);
        if($total == 1)
        {
            while($row = mysql_fetch_array($resultado))
            {
?>
        <div class="col-md-4 well">
            <h3>Ayuda</h3>
            <p>Aqu&iacute; podr&aacute;s editar todo lo referente a los aviones</p>

        </div>
        <div class="col-md-8">
        <form method="post" action="editaircraft.php">
            <div class="form-group">
            <label for="idcity">ID del avi&oacute;n (No se puede editar)</label>
            <input type="text" class="form-control" id="id" name="id" value="<?=$row["id"]?>"  readonly >
            </div>
            <div class="form-group">
           <label for="name">Nombre del avi&oacute;n</label>
			<input type="text" maxlength="50" class="form-control" id="name" name="name" value="<?=$row["name"]?>" placeholder="Nombre del avion" required >
            </div>
            <div class="form-group">
			<?php
				if(isset($_SESSION['airline'])){
					echo " <label for='airline'>Aerolinea</label>";
					echo "<input type='text' class='form-control' id='airlinedes' name='airlinedes' value='".$_SESSION['airname']."' readonly>";
					echo "<input type='hidden' id='airline' name='airline' value='".$_SESSION['airline']."'>";
				}else{
				
			  ?>
            
           <label for="airline">Aerol&iacute;nea (actual <?= $row["airline"]?>)</label>
             <select class="form-control" name="airline" id="airline" required>
               <option value="">Escoja la aerol&iacute;nea</option>
                <?php
                include "../docs/connect.php";
                 $query = "SELECT id, name FROM airlines ORDER BY id";
                $resultado = mysql_query($query, $link);
                $total = mysql_num_rows($resultado);
                if($total>0)
                {
                    while($rowx = mysql_fetch_array($resultado))
                    {
                        if($row['airid'] == $rowx['id'])
                        {
                        echo "<option value='".$rowx['id']."' selected='selected'>".$rowx['name']."</option>";
                        }
                        else
                        {
                            echo "<option value='".$rowx['id']."'>".$rowx['name']."</option>";
                        }
                    }                    
                }
                ?>
            </select>
			<?php
				}
			?>
            </div>
			<div class="form-group">
				<label for="seats">N&uacute;mero de asientos</label>
				<input type="number"  min="1" step="1" class="form-control" id="seats" name="seats"  value="<?=$row["seats"]?>" placeholder="Asientos del avion" required onkeypress=" return numeros(event)">
            </div>
			<div class="form-group">
				<label for="type">Tipo de avi&oacute;sssn</label>
                <select maxlength="50" class="form-control" id="type" name="type" placeholder="Tipo de avi&oacute;n" required>
                    <option  value="<?=$row["type"]?>">Comercial</option>
                    <option  value="<?=$row["type"]?>">Pasajeros</option>
                </select>

            </div>
            <input type="submit" name="enviar" value="Enviar">
        </form>
        </div>        
<?php
            }
        }
        else
        {
            echo "<p class='text-danger text-center'><strong>Error: el avion  no existe. <a href='aircrafts.php'>Lista de aviones</a></strong></p>"; 
        }
    }
    else
    {
        echo "<p class='text-danger text-center'><strong>Error: no hay id de avion. <a href='aircrafts.php'>Lista de aviones</a></strong></p>"; 
    }
}
?>
    </div>    
</div>
</body>
</html>

