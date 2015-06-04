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
    <title>Administrator - Flights</title>
</head>
<body>
<div class="container-fluid">
    <div class="row">
    <!-- NAV -->
    <?php include 'nav.php'; ?>
    <!-- /NAV -->
        <h1 class="text-center">List of flights</h1>
        <br>
<?php
include "../docs/connect.php";
$query = "SELECT f.id, f.airline, a.name AS airlinename, f.departure_time, f.departure_city, c1.city AS depcity, f.arrival_time, f.arrival_city, c2.city AS arrcity, f.aircraft, ac.name AS aircname, f.departure_runway, f.arrival_runway, f.cost, f.seats, f.description FROM flights f INNER JOIN airlines a ON f.airline = a.id INNER JOIN cities c1 ON f.departure_city = c1.id INNER JOIN cities c2 ON f.arrival_city = c2.id INNER JOIN aircraft ac ON f.aircraft = ac.id ORDER BY f.id";
$resultado = mysql_query($query, $link);
$total = mysql_num_rows($resultado);
if($total>0)
{
?>
        <table class="table table-striped">
            <thead><tr><td>ID</td><td>Airline</td><td>Name of the aircraft</td><td>Departure city</td><td>city destination</td><td>Departurne track</td><td>track arribal</td><td>Cost</td><td>Departure time</td><td>Landing time</td><td>Seats</td><td><a href='addflight.php' class="text-success"><span class='glyphicon glyphicon-plus' aria-hidden='true'></span> Add flights</a></td></tr></thead><tbody>          
<?php
    while($row = mysql_fetch_array($resultado))
	{
        echo "<tr><td>".$row['id']."</td>";
        echo "<td>".$row['airlinename']."</td>";
        echo "<td>".$row['aircname']."</td>";
		echo "<td>".$row['depcity']."</td>";
		echo "<td>".$row['arrcity']."</td>";
		echo "<td>".$row['departure_runway']."</td>";
		echo "<td>".$row['arrival_runway']."</td>";
		echo "<td>".$row['cost']."</td>";
		echo "<td>".$row['departure_time']."</td>";
		echo "<td>".$row['arrival_time']."</td>";
		echo "<td>".$row['seats']."</td>";
        echo "<td><a href='editflight.php?flight=".$row['id']."'><span class='glyphicon glyphicon-cog' aria-hidden='true'></span>  Edit</a> <a href='dropflight.php?flight=".$row['id']."' class='text-danger'><span class='glyphicon glyphicon-remove' aria-hidden='true'></span>  Delete</a></td></tr> \n";
    }
} 
else
{
    echo "<p class='text-danger text-center'>Error: The data base is empty <a href='addflight.php' class='text-success'>Add flight</a></p>";
}
?>
        </tbody></table>
        </div>    
</div>
</body>
</html>