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
    <title>Administrator - City</title>
</head>
<body>
<div class="container-fluid">
    <div class="row">
    <!-- NAV -->
    <?php include 'nav.php'; ?>
    <!-- /NAV -->
        <h1 class="text-center">List city </h1>
        <br>
<?php
include "../docs/connect.php";
$query = "SELECT id, city, state, zip FROM cities ORDER BY id";
$resultado = mysql_query($query, $link);
$total = mysql_num_rows($resultado);
if($total>0)
{
?>
        <table class="table table-striped">
            <thead><tr><td>ID</td><td>Name of the city</td><td>Estate</td><td>ZIP cpde</td><td><a href='addcity.php' class="text-success"><span class='glyphicon glyphicon-plus' aria-hidden='true'></span> Add city</a></td></tr></thead><tbody>          
<?php
    while($row = mysql_fetch_array($resultado))
	{
        echo "<tr><td>".$row['id']."</td>";
        echo "<td>".$row['city']."</td>";
        echo "<td>".$row['state']."</td>";
        echo "<td>".$row['zip']."</td>";
        echo "<td><a href='editcity.php?city=".$row['id']."'><span class='glyphicon glyphicon-cog' aria-hidden='true'></span>  Edit</a>   <a href='dropcity.php?city=".$row['id']."' class='text-danger'><span class='glyphicon glyphicon-remove' aria-hidden='true'></span>  Delete</a></td></tr>";
    }
} 
else
{
    echo "<p class='text-danger text-center'>Error: The data base is empty <a href='addcity.php' class='text-success'>Add city</a></p>";
}
?>
        </tbody></table>
        </div>    
</div>
</body>
</html>