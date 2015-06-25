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
    <title>Administrator -Edit the runways</title>
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
        <h1 class="text-center"><Editing data of a runway/h1>
<?php
if(isset($_POST["id"]) AND isset($_POST["idairport"]) AND isset($_POST["lenght"]))
{
    $id = $_POST["id"];
    $idairport = $_POST["idairport"];
	$lenght = $_POST["lenght"];
    include "../docs/connect.php";
    $query = mysql_query("UPDATE runways SET idairport = '$idairport', length = '$lenght' WHERE id = $id");
    if($query)
    {
        echo "<p class='text-success text-center'><strong>The data of de runway &quot;".$id."&quot; were stored</strong></p>";
        echo "<p class='text-success text-center'><a href='runways.php'>List of runways</a></p>";
    }
    else
    {
        echo "<p class='text-danger text-center'><strong>Error: The data were not saved</strong></p>";
        echo "<p class='text-success text-center'><a href='runways.php'>List of runways</a></p>";
    }
}
else
{
    if(isset($_GET["runway"]))
    {
        include "../docs/connect.php";
        $idr = $_GET["runway"];
        $query = "SELECT runways.id, airports.id AS airid, airports.name, runways.length FROM runways INNER JOIN airports on runways.idairport = airports.id WHERE runways.id = $idr";
        $resultado = mysql_query($query, $link);
        $total = mysql_num_rows($resultado);
        if($total == 1)
        {
            while($row = mysql_fetch_array($resultado))
            {
?>
        <div class="col-md-4 well">
            <h3>Help</h3>
            <p>You can edit everything about the runways</p>
        </div>
        <div class="col-md-8">
        <form method="post" action="editrunway.php">
            <div class="form-group">
            <label for="id">ID of the runways (You can`t edit)</label>
            <input type="text" class="form-control" id="id" name="id" value="<?=$row["id"]?>"  readonly>
            </div>
           <label for="idairport">Aircraft (actual <?= $row["name"]?>)</label>
             <select class="form-control" name="idairport" id="idairport" required >
               <option value="">Choose the airport</option>
                <?php
                include "../docs/connect.php";
                $query = "SELECT id, name FROM airports ORDER BY id";
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
				<label for="lenght">length</label>
				<input type="number"  min="1" step="1" class="form-control" id="lenght" name="lenght" value="<?=$row["length"]?>" placeholder="length of the runway" required onkeypress='return numeros(event)'>
            </div>
            <input type="submit" name="enviar" value="Send" >
        </form>
        </div>        
<?php
            }
        }
        else
        {
            echo "<p class='text-danger text-center'><strong>Error:The runway doesn`t exist <a href='runways.php'>List of runways</a></strong></p>"; 
        }
    }
    else
    {
        echo "<p class='text-danger text-center'><strong>Error: Put the id of the runway <a href='runways.php'>Lista de pistas</a></strong></p>"; 
    }
}
?>
    </div>    
</div>
</body>
</html>

