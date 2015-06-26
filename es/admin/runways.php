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
    <title>Administración - Pistas de aterrizaje</title>
</head>
<body>
<div class="container-fluid">
    <div class="row">
    <!-- NAV -->
    <?php include 'nav.php'; ?>
    <!-- /NAV -->
        <h1 class="text-center">Listado de pistas de aterrizaje</h1>
        <br>
<?php
include "../docs/connect.php";
$query = "SELECT runways.id, airports.name, runways.length FROM runways INNER JOIN airports on runways.idairport = airports.id ORDER BY runways.id";
$resultado = mysql_query($query, $link);
$total = mysql_num_rows($resultado);
if($total>0)
{
?>
<script>
        
</script>
	<a href='exportrunways.php' target="_blank" class="text-info"><span class='glyphicon glyphicon-file' aria-hidden='true'></span> Generar PDF</a>
        <table class="table table-striped">
            <thead><tr><td>ID</td><td>Aeropuerto</td><td>Longitud</td><td><a href='addrunway.php' class="text-success"><span class='glyphicon glyphicon-plus' aria-hidden='true'></span> Agregar pista</a></td></tr></thead><tbody>          
<?php
    while($row = mysql_fetch_array($resultado))
	{
        echo "<tr><td>".$row['id']."</td>";
        echo "<td>".$row['name']."</td>";
        echo "<td>".$row['length']."</td>";
        echo "<td><a href='editrunway.php?runway=".$row['id']."'><span class='glyphicon glyphicon-cog' aria-hidden='true'></span>  Editar</a> <a href='droprunway.php?runway=".$row['id']."' class='text-danger'><span class='glyphicon glyphicon-remove' aria-hidden='true'></span>  Borrar</a></td></tr> \n";
    }
} 
else
{
    echo "<p class='text-danger text-center'>Error: la base de datos esta vacia <a href='addrunway.php' class='text-success'>Agregar pista</a></p>";
}
?>
        </tbody></table>
        </div>    
</div>
</body>
</html>