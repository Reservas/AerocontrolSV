<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">
    <link href="../docs/css/bootstrap.css" rel="stylesheet">
    <link href="../docs/css/font-awesome.css" rel="stylesheet">
    <link href="../docs/css/ionicons.css" rel="stylesheet">
    <link href="../docs/css/style.css" rel="stylesheet">
    <script src="../docs/js/bootstrap.js" type="text/javascript"></script>
    <script src="../docs/js/ie-10-view-port.js" type="text/javascript"></script>
    <script src="../docs/js/jquery-1.11.1.js" type="text/javascript"></script>
    <script src="../docs/js/jquery.easing.min.js" type="text/javascript"></script>
    <title>Administrator - Edit aircraft</title>
</head>
<body>
<div class="container-fluid">
    <div class="row">
    <!-- NAV -->
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
    <?php include 'nav.php'; ?>

    <!-- /NAV -->
        <h1 class="text-center">Editing data of an aircraft</h1>
<?php
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
        echo "<p class='text-success text-center'><strong>The data of the aircraft &quot;".$name."&quot; were saved</strong></p>";
        echo "<p class='text-success text-center'><a href='aircrafts.php'>List of aircrafts</a></p>";
    }
    else
    {
        echo "<p class='text-danger text-center'><strong>Error: The data were not stored</strong></p>";
        echo "<p class='text-success text-center'><a href='aircrafts.php'>List of aircrafts</a></p>";
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
            <a href="editaircraft.php"> <img src="../../base_de_datos/Ingles.jpg" class="redondo" width=60 height=30/></a>
<a href="../../es/admin/editaircraft.php"> <img src="../../base_de_datos/descarga" class="redondo"  width="60" height="30"/> </a>
            <h3>Help</h3>
            <p>You can edit everything about airplanes</p>

        </div>
        <div class="col-md-8">
        <form method="post" action="editaircraft.php">
            <div class="form-group">
            <label for="idcity">ID of the aircraft (Can`t be edit)</label>
            <input type="text" class="form-control" id="id" name="id" value="<?=$row["id"]?>"  readonly>
            </div>
            <div class="form-group">
           <label for="name">Name of the aircraft</label>
			<input type="text" maxlength="50" class="form-control" id="name" name="name" value="<?=$row["name"]?>" placeholder="Name of the aircraft" required onkeypress="return validar(event)">
            </div>
            <div class="form-group">
           <label for="airline">Airline (actual <?= $row["airline"]?>)</label>
             <select class="form-control" name="airline" id="airline" required>
               <option value="">Choose the airline</option>
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
            </div>
			<div class="form-group">
				<label for="seats">Numbers of seats</label>
				<input type="number"  min="1" step="1" class="form-control" id="seats" name="seats"  value="<?=$row["seats"]?>" placeholder="Numbers of seats" required onkeypress='return numeros(event)'>
            </div>
			<div class="form-group">
				<label for="type">Aircrafts type</label>
				<input type="text" maxlength="50" class="form-control" id="type" name="type"  value="<?=$row["type"]?>" placeholder="Aircrafts type" required onkeypress="return validar(event)">
            </div>
            <input type="submit" name="enviar" value="Send">
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

