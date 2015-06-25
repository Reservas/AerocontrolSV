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
    <title>Administración - Agregar aeropuerto</title>
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
                </script>
    <?php include 'nav.php'; ?>
    <!-- /NAV -->
        <h1 class="text-center">Agregar aeropuerto</h1>
<?php
if(isset($_POST["name"]) AND isset($_POST["location"]))
{
    $name = $_POST["name"];
    $location = $_POST["location"];
    include "../docs/connect.php";
    $query = mysql_query("INSERT INTO airports (id, name, location) VALUES ('','$name','$location')");
    if($query)
    {
        echo "<p class='text-success text-center'><strong>Los datos fueron guardados</strong></p>";
        echo "<p class='text-success text-center'><a href='airports.php'>Lista de aeropuertos</a></p>";
    }
    else
    {
        echo "<p class='text-danger text-center'><strong>Error: los datos no fueron guardados</strong></p>";
        echo "<p class='text-success text-center'><a href='airports.php'>Lista de aeropuertos</a></p>";
    }
}
?>
        <div class="col-md-4 well">
            <h3>Ayuda</h3>
            <p>Sólo se necesita insertar el nombre del <strong>Aeropuerto</strong> la ubicaciòn de dicho aeropuerto</p>
        </div>
        <div class="col-md-8">
        <form method="post" action="addairport.php">
            <div class="form-group">
            <label for="name">Nombre del aeropuerto</label>
            <input type="text" class="form-control" id="name" name="name" placeholder="Nombre del aeropuerto" required onkeypress="return validar(event)">
            </div>
            <label for="location">Ubicación</label>
            <select class="form-control" name="location" id="location">
                <option value="">Escoja la ciudad don de se ubica</option>
                <?php
                include "../docs/connect.php";
                $query = "SELECT * FROM cities ORDER BY id";
                $resultado = mysql_query($query, $link);
                $total = mysql_num_rows($resultado);
                if($total>0)
                {
                    while($row = mysql_fetch_array($resultado))
                    {
                        echo "<option value='".$row['id']."'>".$row['zip']." - ".$row['city']." - ".$row['state']."</option>";
                    }                    
                }
                ?>
            </select>
            <input type="submit" name="enviar" value="Enviar">
        </form>
        </div>
    </div>    
</div>
</body>
</html>