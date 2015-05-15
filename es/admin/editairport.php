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
    <title>Administración - Editar aeropuerto</title>
</head>
<body>
<div class="container-fluid">
    <div class="row">
    <!-- NAV -->
    <?php include 'nav.php'; ?>
    <!-- /NAV -->
        <h1 class="text-center">Editando datos de un aeropuerto</h1>
<?php
if(isset($_POST["idcity"]) AND isset($_POST["airname"]) AND isset($_POST["location"]))
{
    $idair = $_POST["idcity"];
    $name = $_POST["airname"];
    $location = $_POST["location"];
    include "../docs/connect.php";
    $query = mysql_query("UPDATE airports SET name = '$name', location = '$location' WHERE id = $idair");
    if($query)
    {
        echo "<p class='text-success text-center'><strong>Los datos del aeropuerto &quot;".$name."&quot; fueron guardados</strong></p>";
        echo "<p class='text-success text-center'><a href='airports.php'>Lista de aeropuertos</a></p>";
    }
    else
    {
        echo "<p class='text-danger text-center'><strong>Error: los datos no fueron guardados</strong></p>";
        echo "<p class='text-success text-center'><a href='airports.php'>Lista de aeropuertos</a></p>";
    }
}
else
{
    if(isset($_GET["air"]))
    {
        include "../docs/connect.php";
        $idr = $_GET["air"];
        $query = "SELECT airports.id, name, location, cities.id AS 'loccityid', cities.city, cities.state, cities.zip FROM airports INNER JOIN cities ON airports.location = cities.id WHERE airports.id = '$idr' ORDER BY airports.id";
        $resultado = mysql_query($query, $link);
        $total = mysql_num_rows($resultado);
        if($total == 1)
        {
            while($row = mysql_fetch_array($resultado))
            {
?>
        <div class="col-md-4 well">
            <h3>Ayuda</h3>
            <p>Aquí podrás editar todo lo referente a los aeropuertos</p>
            <p>A sdglbsfg fgr rgiuf <strong>texto negrita</strong> uwehiw  goegpe fgubgr gwurgif sdqjerpqn asflbdfkjbsdkgj sglbd flsdf sdfbjsdkfb sdkfb</p>
        </div>
        <div class="col-md-8">
        <form method="post" action="editairport.php">
            <div class="form-group">
            <label for="idcity">ID del aeropuerto (No se puede editar)</label>
            <input type="text" class="form-control" id="idcity" name="idcity" value="<?=$row["id"]?>"  readonly>
            </div>
            <div class="form-group">
            <label for="airname">Nombre del aeropuerto</label>
            <input type="text" class="form-control" id="airname" name="airname" value="<?=$row["name"]?>"  required>
            </div>
            <div class="form-group">
            <label for="state">Nombre del estado (actual <?= $row["zip"]." - ".$row["city"]." - ".$row["state"]?>)</label>
            <select class="form-control" name="location" id="location">
                <option value="">Escoja la ciudad donde se ubica</option>
                <?php
                include "../docs/connect.php";
                $query = "SELECT * FROM cities ORDER BY id";
                $resultado = mysql_query($query, $link);
                $total = mysql_num_rows($resultado);
                if($total>0)
                {
                    while($rowx = mysql_fetch_array($resultado))
                    {
                        if($row['loccityid'] == $rowx['id'])
                        {
                        echo "<option value='".$rowx['id']."' selected='selected'>".$rowx['zip']." - ".$rowx['city']." - ".$rowx['state']."</option>";
                        }
                        else
                        {
                            echo "<option value='".$rowx['id']."' >".$rowx['zip']." - ".$rowx['city']." - ".$rowx['state']."</option>";
                        }
                    }                    
                }
                ?>
            </select>
            </div>
            <input type="submit" name="enviar" value="Enviar">
        </form>
        </div>        
<?php
            }
        }
        else
        {
            echo "<p class='text-danger text-center'><strong>Error: el aeropuerto no existe. <a href='airports.php'>Lista de aeropuertos</a></strong></p>"; 
        }
    }
    else
    {
        echo "<p class='text-danger text-center'><strong>Error: no hay id de aeropuerto. <a href='airports.php'>Lista de aeropuertos</a></strong></p>"; 
    }
}
?>
    </div>    
</div>
</body>
</html>