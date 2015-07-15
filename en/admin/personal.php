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
    <title>Administración - Personal </title>
</head>
<body>
<div class="container-fluid">
    <div class="row">
    <!-- NAV -->
    <?php include 'nav.php'; ?>
                    <a href="../../en/admin/personal.php">English/</a><a href="../../es/admin/personal.php">Español</a>
    <!-- /NAV -->
        <h1 class="text-center">Listado del personal</h1>
        <br>
<?php
include "../docs/connect.php";
$query = "SELECT id, name, address, city, state, mail, birthdate, phone, user, password, status FROM costumers ORDER BY id";
$resultado = mysql_query($query, $link);
$total = mysql_num_rows($resultado);
if($total>0)
{
?>
        <table class="table table-striped">
            <thead><tr><td>ID</td><td>Nombre del personal</td><td>Dirección</td><td>Ubicación (ZIP - Ciudad - Estado)</td><td>Correo</td><td>Nacimiento (AAAA-MM-DD)</td><td>Teléfono</td><td>Usuario</td><td>Estado</td></tr></thead><tbody>          
<?php
    while($row = mysql_fetch_array($resultado))
	{
        $texto = "";
        $texto2 = "";
        switch($row["status"])
        {
            case 0;
            $texto = "<th class='text-danger'>Inactivo</th>";
            $texto2 = "<a  href='statuscostumer.php?costumer=".$row['id']."' class='text-success'>Reactivar</a>";
            break;
            case 1;
            $texto = "<th class='text-success'>Activo</th>";
            $texto2 = "<a  href='statuscostumer.php?costumer=".$row['id']."' class='text-danger'>Desactivar</a>";
            break;
        }
        echo "<tr><td>".$row['id']."</td>";
        echo "<td>".$row['name']."</td>";
        echo "<td>".$row['address']."</td>";
        echo "<td>".$row['city']."</td>";
        echo "<td>".$row['mail']."</td>";
        echo "<td>".$row['birthdate']."</td>";
        echo "<td>".$row['phone']."</td>";
        echo "<td>".$row['user']."</td>";
        echo $texto;
        echo "<td><a href='editairport.php?air=".$row['id']."'><span class='glyphicon glyphicon-cog' aria-hidden='true'></span>  Editar</a>   ".$texto2."</td></tr>";
    }
} 
else
{
    echo "<p class='text-danger text-center'>Error: la base de datos esta vacia <a href='addcostumer.php' class='text-success'>Agregar cliente</a></p>";
}
?>
        </tbody></table>
        </div>    
</div>
</body>
</html>