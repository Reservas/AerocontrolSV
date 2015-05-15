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
    <title>Administración - Agregar cliente</title>
</head>
<body>
<div class="container-fluid">
    <div class="row">
    <!-- NAV -->
    <?php include 'nav.php'; ?>
    <!-- /NAV -->
        <h1 class="text-center">Agregar cliente</h1>
<?php
if(isset($_POST["name"]) AND isset($_POST["address"]) AND isset($_POST["location"]) AND isset($_POST["birthdate"]) AND isset($_POST["phone"]) AND isset($_POST["user"]) AND isset($_POST["password"]) AND isset($_POST["password2"]))
{
    if($_POST["password"] == $_POST["password2"])
    {
        $name = $_POST["name"];
        $address = $_POST["address"];
        $location = $_POST["location"];
        $birthdate = $_POST["birthdate"];
        $phone = $_POST["phone"];
        $user = $_POST["user"];
        $pass = $_POST["password"];
        $pass = $_POST["password2"];
        //ciudad, estado y zip
        $porcion = explode("-", $location);
        $zip = $porcion[0];
        $ciudad = $porcion[1];
        $estado = $porcion[2];
        //ciudad, estado y zip
        include "../docs/connect.php";
        $query = mysql_query("INSERT INTO costumers (id, name, address, city, state, zip, birthdate, phone, user, password, status) VALUES ('','$name','$address', '$ciudad', '$estado', '$zip', '$birthdate', '$phone', '$user', '$pass', '1')");
        if($query)
        {
            echo "<p class='text-success text-center'><strong>Los datos fueron guardados</strong></p>";
            echo "<p class='text-success text-center'><a href='costumers.php'>Lista de clientes</a></p>";
        }
        else
        {
            echo "<p class='text-danger text-center'><strong>Error: los datos no fueron guardados</strong></p>";
            echo "<p class='text-success text-center'><a href='costumers.php'>Lista de clientes</a></p>";
        }
    }
    else
    {
        echo "<p class='text-danger'><strong>Las contraseñas no coinciden</strong></p>";
    }
}
?>
        <div class="col-md-4 well">
            <h3>Ayuda</h3>
            <p>Por favor escribe el <strong>nombre</strong> del cluente que deseas agregas, luego escribimos la <strong>direccón</strong> en donde resides, luego la <strong>Ciudad en donde se encuentra</strong> después escribimos la <strong>fecha de nacimiento </strong> ahora seguimos con el <strong>número de teléfonoi</strong> para terminar con el <strong>usuario</strong> y terminamos con la <strong>contraseña</strong> y la volvemos a repetir.</p>
        </div>
        <div class="col-md-8">
        <form method="post" action="addcostumer.php">
            <div class="form-group">
            <label for="name">Nombre del cliente</label>
            <input type="text" class="form-control" id="name" name="name" placeholder="Nombre de la cliente" required>
            </div>
            <div class="form-group">
            <label for="address">Dirección</label>
            <input type="text" class="form-control" id="address" name="address" placeholder="Dirección" required>
            </div>
            <div class="form-group">
            <label for="location">Ubicación</label>
            <select class="form-control" name="location" id="location">
                <option value="">Escoja la ciudad donde se ubica</option>
                <?php
                include "../docs/connect.php";
                $query = "SELECT * FROM cities ORDER BY id";
                $resultado = mysql_query($query, $link);
                $total = mysql_num_rows($resultado);
                if($total>0)
                {
                    while($row = mysql_fetch_array($resultado))
                    {
                        echo "<option value='".$row['zip']."-".$row['city']."-".$row['state']."'>".$row['zip']." - ".$row['city']." - ".$row['state']."</option>";
                    }                    
                }
                ?>
            </select>
            </div>
            <div class="form-group">
            <label for="birthdate">Nacimiento</label>
            <input type="text" class="form-control" id="birthdate" name="birthdate" placeholder="AAAA/MM/DD" required>
            </div>
            <div class="form-group">
            <label for="phone">Telefono</label>
            <input type="text" class="form-control" id="phone" name="phone" placeholder="####-####" required>
            </div>
            <div class="form-group">
            <label for="user">Nombre de usuario</label>
            <input type="text" class="form-control" id="user" name="user" placeholder="Nombre de usuario" required>
            </div>
            <div class="form-group">
            <label for="password">Contraseña</label>
            <input type="password" class="form-control" id="password" name="password" placeholder="Contraseña" required>
            </div>
            <div class="form-group">
            <label for="password2">Confirme</label>
            <input type="password" class="form-control" id="password2" name="password2" placeholder="Confirme" required>
            </div>
            <input type="submit" name="enviar" value="Enviar">
        </form>
        </div>
    </div>    
</div>
</body>
</html>