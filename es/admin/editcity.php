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
    <title>Administraci&oacute;n - Agregar ciudad</title>
</head>
<body>
<div class="container-fluid">
    <div class="row">
    <!-- NAV -->
    <?php include 'nav.php'; ?>
                                    <a href="../../en/admin/editcity.php">English/</a><a href="../../es/admin/editcity.php">Espa&ntilde;ol</a>
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
            <p>Aqu&iacute; podr&aacute;s editar todo lo referente a las ciudades</p>
        </div>
        <div class="col-md-8">
        <form method="post" action="editcity.php">
            <div class="form-group">
            <label for="idcity">ID de la ciudad (No se puede editar)</label>
            <input type="text" class="form-control" id="idcity" name="idcity" value="<?=$row["id"]?>"  readonly>
            </div>
            <div class="form-group">
            <label for="city">Nombre de la ciudad</label>
            <input type="text" class="form-control" id="city" name="city" value="<?=$row["city"]?>"  required onkeypress="return validar(event)">
            </div>
            <div class="form-group">
            <label for="state">Nombre del estado</label>
            <input type="text" class="form-control" id="state" name="state"  value="<?=$row["state"]?>" required onkeypress="return validar(event)">
            </div>
            <div class="form-group">
            <label for="zip">C&oacute;digo ZIP</label>
            <input type="number" class="form-control" id="zip" name="zip"  value="<?=$row["zip"]?>"  required min="0" max="999" onkeypress='return numeros(event)'>
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