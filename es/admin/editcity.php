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
        <h1 class="text-center">Editando datos de una ciudad</h1>
<?php
if(isset($_POST["city"]) AND isset($_POST["state"]) AND isset($_POST["zip"]))
{
    $idcity = $_POST["idcity"];
    $city = $_POST["city"];
    $state = $_POST["state"];
    $zip = $_POST["zip"];
    include "../docs/connect.php";
    $query = mysql_query("UPDATE cities SET city = '$city', state = '$state', zip = '$zip' WHERE id = $idcity");
    if($query)
    {
        echo "<p class='text-success text-center'><strong>Los datos de la ciudad &quot;".$city."&quot; fueron guardados</strong></p>";
        echo "<p class='text-success text-center'><a href='cities.php'>Lista de ciudades</a></p>";
    }
    else
    {
        echo "<p class='text-danger text-center'><strong>Error: los datos no fueron guardados</strong></p>";
        echo "<p class='text-success text-center'><a href='cities.php'>Lista de ciudades</a></p>";
    }
}
else
{
    if(isset($_GET["city"]))
    {
        include "../docs/connect.php";
        $idr = $_GET["city"];
        $query = "SELECT id, city, state, zip FROM cities WHERE id = '$idr' ORDER BY id";
        $resultado = mysql_query($query, $link);
        $total = mysql_num_rows($resultado);
        if($total == 1)
        {
            while($row = mysql_fetch_array($resultado))
            {
?>
        <div class="col-md-4 well">
            <h3>Ayuda</h3>
            <p>Aquí podrás editar todo lo referente a las ciudades</p>
            <p>A sdglbsfg fgr rgiuf <strong>texto negrita</strong> uwehiw  goegpe fgubgr gwurgif sdqjerpqn asflbdfkjbsdkgj sglbd flsdf sdfbjsdkfb sdkfb</p>
        </div>
        <div class="col-md-8">
        <form method="post" action="editcity.php">
            <div class="form-group">
            <label for="idcity">ID de la ciudad (No se puede editar)</label>
            <input type="text" class="form-control" id="idcity" name="idcity" value="<?=$row["id"]?>"  readonly>
            </div>
            <div class="form-group">
            <label for="city">Nombre de la ciudad</label>
            <input type="text" class="form-control" id="city" name="city" value="<?=$row["city"]?>"  required>
            </div>
            <div class="form-group">
            <label for="state">Nombre del estado</label>
            <input type="text" class="form-control" id="state" name="state"  value="<?=$row["state"]?>" required>
            </div>
            <div class="form-group">
            <label for="zip">Código ZIP</label>
            <input type="number" class="form-control" id="zip" name="zip"  value="<?=$row["zip"]?>"  required min="0" max="999">
            </div>
            <input type="submit" name="enviar" value="Enviar">
        </form>
        </div>        
<?php
            }
        }
        else
        {
            echo "<p class='text-danger text-center'><strong>Error: la ciudad no existe. <a href='cities.php'>Lista de ciudades</a></strong></p>"; 
        }
    }
    else
    {
        echo "<p class='text-danger text-center'><strong>Error: no hay id de ciudad. <a href='cities.php'>Lista de ciudades</a></strong></p>"; 
    }
}
?>
    </div>    
</div>
</body>
</html>