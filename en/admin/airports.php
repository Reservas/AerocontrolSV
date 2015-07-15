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
    <title>Administrator - Airport</title>
</head>
<body>
<div class="container-fluid">
    <div class="row">
    <!-- NAV -->
    <?php include 'nav.php'; ?>
    <!-- /NAV -->
        <h1 class="text-center">List of airports </h1>
        <br>
<?php
include "../docs/connect.php";
$query = "SELECT airports.id, airports.name, airports.location, cities.city, cities.state FROM airports INNER JOIN cities ON airports.location = cities.id ORDER BY id";
$resultado = mysql_query($query, $link);
$total = mysql_num_rows($resultado);
if($total>0)
{
?>
		<a href="airports.php"> <img src="../../base_de_datos/Ingles.jpg" class="redondo" width=60 height=30/></a>
<a href="../../es/admin/airports.php"> <img src="../../base_de_datos/descarga" class="redondo"  width="60" height="30"/> </a>
        <a href='exportairports.php' target="_blank" class="text-info"><span class='glyphicon glyphicon-file' aria-hidden='true'></span> Generate PDF</a>
        <table class="table table-striped">
            <thead><tr><td>ID</td><td>Name of the airport</td><td>Location (City)</td><td><a href='addairport.php' class="text-success"><span class='glyphicon glyphicon-plus' aria-hidden='true'></span> Add Airport</a></td></tr></thead><tbody>          
<?php
    while($row = mysql_fetch_array($resultado))
	{
        echo "<tr><td>".$row['id']."</td>";
        echo "<td>".$row['name']."</td>";
        echo "<td>".$row['city']." - ".$row['state']."</td>";
        echo "<td><a href='editairport.php?air=".$row['id']."'><span class='glyphicon glyphicon-cog' aria-hidden='true'></span>  Edit</a>   <a href='dropairport.php?air=".$row['id']."' class='text-danger'><span class='glyphicon glyphicon-remove' aria-hidden='true'></span>  Delete</a></td></tr>";
    }
} 
else
{
    echo "<p class='text-danger text-center'>Error: The database is empty <a href='addairport.php' class='text-success'>Add airport</a></p>";
}
?>
        </tbody></table>
        </div>    
</div>
</body>
</html>