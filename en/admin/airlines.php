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
    <title>Administrator - Airlines</title>
</head>
<body>
<div class="container-fluid">
    <div class="row">
    <!-- NAV -->
    <?php include 'nav.php'; ?>
    <!-- /NAV -->
        <h1 class="text-center">List of airlines</h1>
        <br>
<?php
include "../docs/connect.php";
$query = "SELECT id, name, description, logo FROM airlines ORDER BY id";
$resultado = mysql_query($query, $link);
$total = mysql_num_rows($resultado);
if($total>0)
{
?>
		<a href="airlines.php"> <img src="../../base_de_datos/Ingles.jpg" class="redondo" width=60 height=30/></a>
<a href="../../es/admin/airlines.php"> <img src="../../base_de_datos/descarga" class="redondo"  width="60" height="30"/> </a>
        <a href='exportairlines.php' target="_blank" class="text-info"><span class='glyphicon glyphicon-file' aria-hidden='true'></span> Generate PDF</a>
        <table class="table table-striped">
            <thead><tr><td>ID</td><td>Logo</td><td>Name of the airline</td><td>Description</td><td><a href='addairline.php' class="text-success"><span class='glyphicon glyphicon-plus' aria-hidden='true'></span> Add airline</a></td></tr></thead><tbody>          
<?php
    while($row = mysql_fetch_array($resultado))
	{
        echo "<tr><td>".$row['id']."</td>";
        echo "<td><img src='../airline/docs/img/logo/".$row['logo']."' class='img-responsive' width='40'></td>";
        echo "<td>".$row['name']."</td>";
        echo "<td>".$row['description']."</td>";
        echo "<td><a href='editairline.php?air=".$row['id']."'><span class='glyphicon glyphicon-cog' aria-hidden='true'></span>  Edit</a>   <a href='addairlineadmin.php?air=".$row['id']."' class='text-warning'><span class='glyphicon glyphicon-user' aria-hidden='true'></span>  Add administrator</a>   <a href='dropairline.php?air=".$row['id']."' class='text-danger'><span class='glyphicon glyphicon-remove' aria-hidden='true'></span>  Delete</a></td></tr> \n";
    }
} 
else
{
    echo "<p class='text-danger text-center'>Error:The data base is  empty<a href='addairline.php' class='text-success'>Add airline</a></p>";
}
?>
        </tbody></table>
        </div>    
</div>
</body>
</html>