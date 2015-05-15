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
    <title>Administración - Agregar ciudad</title>
</head>
<body>
<div class="container-fluid">
    <div class="row">
    <!-- NAV -->
    <?php include 'nav.php'; ?>
    <!-- /NAV -->
        <h1 class="text-center">Agregar ciudad</h1>
<?php
if(isset($_POST["city"]) AND isset($_POST["state"]) AND isset($_POST["zip"]))
{
    $city = $_POST["city"];
    $state = $_POST["state"];
    $zip = $_POST["zip"];
    include "../docs/connect.php";
    $query = mysql_query("INSERT INTO cities (id, city, state, zip) VALUES ('','$city','$state','$zip')");
    if($query)
    {
        echo "<p class='text-success text-center'><strong>Los datos fueron guardados</strong></p>";
        echo "<p class='text-success text-center'><a href='cities.php'>Lista de ciudades</a></p>";
    }
    else
    {
        echo "<p class='text-danger text-center'><strong>Error: los datos no fueron guardados</strong></p>";
        echo "<p class='text-success text-center'><a href='cities.php'>Lista de ciudades</a></p>";
    }
}
?>
        <div class="col-md-4 well">
            <h3>Ayuda</h3>
            <p>Escribe el nombre de la <strong>Ciudad</strong> luego ingresamos el nombre del <strong>Estado(departament)</strong> que se encuentra y el <strong>Código ZIP</strong> </p>
        </div>
        <div class="col-md-8">
        <form method="post" action="addcity.php">
            <div class="form-group">
            <label for="city">Nombre de la ciudad</label>
            <input type="text" class="form-control" id="city" name="city" placeholder="Nombre de la ciudad" required>
            </div>
            <div class="form-group">
            <label for="state">Nombre del estado</label>
            <input type="text" class="form-control" id="state" name="state" placeholder="Nombre del estado" required>
            </div>
            <div class="form-group">
            <label for="zip">Código ZIP</label>
            <input type="number" class="form-control" id="zip" name="zip" placeholder="Código ZIP" required min="0">
            </div>
            <input type="submit" name="enviar" value="Enviar">
        </form>
        </div>
    </div>    
</div>
</body>
</html>