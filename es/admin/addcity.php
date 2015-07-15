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
<script>
    function validar(e) { // 1
    tecla = (document.all) ? e.keyCode : e.which; // 2
    if (tecla==8) return true; // 3
    patron =/[A-Za-z\s]/; // 4
    te = String.fromCharCode(tecla); // 5
    return patron.test(te); // 6
}
function numeros(e){
    key = e.keyCode || e.which;
    tecla = String.fromCharCode(key).toLowerCase();
    letras = " 0123456789";
    especiales = [8];
 
    tecla_especial = false
    for(var i in especiales){
 if(key == especiales[i]){
     tecla_especial = true;
     break;
        } 
    }
 
    if(letras.indexOf(tecla)==-1 && !tecla_especial)
        return false;
}
</script>
    <?php include 'nav.php'; ?>
    <!-- /NAV -->
                        <a href="../../en/admin/addcity.php">English/</a><a href="../../es/admin/addcity.php">Español</a>
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
            <input type="text" class="form-control" id="city" name="city" placeholder="Nombre de la ciudad" required onkeypress="return validar(event)">
            </div>
            <div class="form-group">
            <label for="state">Nombre del estado</label>
            <input type="text" class="form-control" id="state" name="state" placeholder="Nombre del estado" required onkeypress="return validar(event)">
            </div>
            <div class="form-group">
            <label for="zip">Código ZIP</label>
            <input type="number" class="form-control" id="zip" name="zip" placeholder="Código ZIP" required min="0" onkeypress='return numeros(event)'>
            </div>
            <input type="submit" name="enviar" value="Enviar">
        </form>
        </div>
    </div>    
</div>
</body>
</html>