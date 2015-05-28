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
    <title>Administrator - Clients</title>
</head>
<body>
<div class="container-fluid">
    <div class="row">
    <!-- NAV -->
    <?php include 'nav.php'; ?>
    <!-- /NAV -->
        <h1 class="text-center">List of clients</h1>
        <br>
<?php
include "../docs/connect.php";
$query = "SELECT id, name, address, city, state, birthdate, phone, user, password, status FROM costumers ORDER BY id";
$resultado = mysql_query($query, $link);
$total = mysql_num_rows($resultado);
if($total>0)
{
?>
        <table class="table table-striped">
            <thead><tr><td>ID</td><td>Name of the clients</td><td>Address</td><td>Location (ZIP - city - Estate)</td><td>Birthday (YYY-MM-DD)</td><td>Phone</td><td>Username</td><td>Estate</td><td><a href='addcostumer.php' class="text-success"><span class='glyphicon glyphicon-plus' aria-hidden='true'></span> Add client</a></td></tr></thead><tbody>          
<?php
    while($row = mysql_fetch_array($resultado))
	{
        $texto = "";
        $texto2 = "";
        switch($row["status"])
        {
            case 0;
            $texto = "<th class='text-danger'>Inactive</th>";
            $texto2 = "<a  href='statuscostumer.php?costumer=".$row['id']."' class='text-success'>Reactive</a>";
            break;
            case 1;
            $texto = "<th class='text-success'>Actiue</th>";
            $texto2 = "<a  href='statuscostumer.php?costumer=".$row['id']."' class='text-danger'>Desactive</a>";
            break;
        }
        echo "<tr><td>".$row['id']."</td>";
        echo "<td>".$row['name']."</td>";
        echo "<td>".$row['address']."</td>";
        echo "<td>".$row['birthdate']."</td>";
        echo "<td>".$row['phone']."</td>";
        echo "<td>".$row['user']."</td>";
        echo $texto;
        echo "<td><a href='editairport.php?air=".$row['id']."'><span class='glyphicon glyphicon-cog' aria-hidden='true'></span>  Edit</a>   ".$texto2."</td></tr>";
    }
} 
else
{
    echo "<p class='text-danger text-center'>Error: The data base is empty <a href='addcostumer.php' class='text-success'>Add client</a></p>";
}
?>
        </tbody></table>
        </div>    
</div>
</body>
</html>