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
    <title>Administraci&oacute;n - Compras</title>
</head>
<body>
<div class="container-fluid">
    <div class="row">
    <!-- NAV -->
    <?php include 'nav.php'; ?>
               <a href="/en/admin/flights.php"> <img src="../../base_de_datos/Ingles.jpg" class="redondo" width=60 height=30/></a>
            <a href="../../es/admin/flights.php"> <img src="../../base_de_datos/descarga" class="redondo"  width="60" height="30"/> </a>
    <!-- /NAV -->
        <h1 class="text-center">Listado de compras</h1>
        <br>
<?php
session_start();
include "../docs/connect.php";
$query = "SELECT `bookings`.`id`, `costumers`. `name`,`bookings`.`flight`, `bookings`.`seats`, `is_cancelled`, `justification` FROM `bookings` INNER JOIN `costumers` ON `bookings`.`costumer` = `costumers`. `id` INNER JOIN `flights` ON `bookings`.`flight` = `flights`. `id` INNER JOIN `airlines` ON `flights`. `airline` = `airlines`. `id` ";
if(isset($_SESSION['airline'])){
	$query = $query.'WHERE `airlines`. `id` = '.$_SESSION['airline'].' ';
}
$query = $query.'ORDER BY `costumers`. `id`, `bookings`.`id`';
$resultado = mysql_query($query, $link);
$total = mysql_num_rows($resultado);
if($total>0)
{
?>
		<a href='exportpurchases.php' target="_blank" class="text-info"><span class='glyphicon glyphicon-file' aria-hidden='true'></span> Generar PDF</a>
        <table class="table table-striped">
            <thead><tr><td>ID</td><td>Cliente</td><td>Vuelo</td><td>Asientos</td><td>Estado</td><td>Justificacion</td></tr></thead><tbody>          
<?php
    while($row = mysql_fetch_array($resultado))
	{
        echo "<tr><td>".$row['id']."</td>";
        echo "<td>".$row['name']."</td>";
        echo "<td>".$row['flight']."</td>";
		echo "<td>".$row['seats']."</td>";
		if($row['is_cancelled'] == 0){
			echo "<td>Abierto</td>";
		}else{
			echo "<td>Cancelado</td>";
		}
		echo "<td>".$row['justification']."</td>";
    }
} 
else
{
    echo "<p class='text-danger text-center'>Error: la base de datos esta vacia</p>";
}
?>
        </tbody></table>
        </div>    
</div>
</body>
</html>