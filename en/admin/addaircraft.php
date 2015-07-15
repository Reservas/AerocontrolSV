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
    <title>Administrator - Add aircraft</title>
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
        <h1 class="text-center">Add aircraft</h1>
<?php
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
        echo "<p class='text-success text-center'><strong>The data were stored</strong></p>";
        echo "<p class='text-success text-center'><a href='aircrafts.php'>List of aircraft</a></p>";
    }
    else
    {
        echo "<p class='text-danger text-center'><strong>Error: the data were not saved</strong></p>";
        echo "<p class='text-success text-center'><a href='aircrafts.php'>List of aircraft</a></p>";
    }
}
?>
        <div class="col-md-4 well">
            <a href="addaircraft.php"> <img src="../../base_de_datos/Ingles.jpg" class="redondo" width=60 height=30/></a>
            <a href="../../es/admin/addaircraft.php"> <img src="../../base_de_datos/descarga" class="redondo"  width="60" height="30"/> </a> 

            <h3>Help</h3>
            <p> You nedd de name of the <strong>aircraft</strong> </p>
        </div>
        <div class="col-md-8">

        <form method="post" action="addaircraft.php">
            <div class="form-group">
				<label for="name">Name of the aircraft</label>
				<input type="text" maxlength="50" class="form-control" id="name" name="name" placeholder="Name of the aircraft" required onkeypress="return validar(event)">
            </div>
            <label for="airline">Airline</label>
			 <div class="form-group">
            <select class="form-control" name="airline" id="airline" required>
                <option value="">Choose the airline</option>
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
			</div>
			<div class="form-group">
				<label for="seats">Number of seats
</label>
				<input type="number"  min="1" step="1" class="form-control" id="seats" name="seats" placeholder="Number of seats
" required onkeypress='return numeros(event)'>
            </div>
			<div class="form-group">
				<label for="type">Aircraft Type</label>
				<input type="text" maxlength="50" class="form-control" id="type" name="type" placeholder="Aircraft Type" required onkeypress="return validar(event)">
            </div>
            <input type="submit" name="enviar" value="Send">
        </form>
        </div>
    </div>    
</div>
</body>
</html>