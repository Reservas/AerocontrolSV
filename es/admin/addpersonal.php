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
    <title>Administraci&oacute;n - Agregar personal</title>
</head>
<body>
<div class="container-fluid">
    <div class="row">
    <!-- NAV -->
    <?php include 'nav.php'; ?>

        <h1 class="text-center">Agregar Personal</h1>
<!--               <thead><tr><td>ID</td><td>Nombre del personal</td><td>Dirección</td><td>Ubicación (ZIP - Ciudad - Estado)</td><td>Correo</td><td>Nacimiento (AAAA-MM-DD)</td><td>Teléfono</td><td>Usuario</td><td>Estado</td></tr></thead><tbody>   -->
<?php
if(isset($_POST["name"]) AND isset($_POST["address"]) AND isset($_POST["location"])AND isset($_POST["mail"]) AND isset($_POST["birthdate"]) AND isset($_POST["phone"]) AND isset($_POST["user"]) AND isset($_POST["password"]) AND isset($_POST["password2"]))
{
    if($_POST["password"] == $_POST["password2"])
    {
        $name = $_POST["name"];
        $address = $_POST["address"];
        $location = $_POST["location"];
        $mail = $_POST["mail"];
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
        $query = mysql_query("INSERT INTO costumers (id, name, address, city, state, zip, mail, birthdate, phone, user, password, status) VALUES ('','$name','$address', '$ciudad', '$estado', '$zip', '$mail', '$birthdate', '$phone', '$user', '$pass', '1')");
        if($query)
        {
            echo "<p class='text-success text-center'><strong>Los datos fueron guardados</strong></p>";
            echo "<p class='text-success text-center'><a href='costumers.php'>Lista de personals</a></p>";
        }
        else
        {
            echo "<p class='text-danger text-center'><strong>Error: los datos no fueron guardados</strong></p>";
            echo "<p class='text-success text-center'><a href='costumers.php'>Lista de personals</a></p>";
        }
    }
    else
    {
        echo "<p class='text-danger'><strong>Las contrase&ntilde;as no coinciden</strong></p>";
    }
}
?>
        <div class="col-md-4 well">
                                    <a href="/AerocontrolSV/en/admin/addpersonal.php"> <img src="../../base_de_datos/Ingles.jpg" class="redondo" width=60 height=30/></a>
            <a href="../../es/admin/addpersonal.php"> <img src="../../base_de_datos/descarga" class="redondo"  width="60" height="30"/> </a> 
            <h3>Ayuda</h3>
            <p>Por favor escribe el <strong>nombre</strong> del cluente que deseas agregas, luego escribimos la <strong>direccón</strong> en donde resides, luego la <strong>Ciudad en donde se encuentra</strong> después escribimos la <strong>fecha de nacimiento </strong> ahora seguimos con el <strong>número de tel&eacute;fono</strong> para terminar con el <strong>usuario</strong> y terminamos con la <strong>contrase&ntilde;a</strong> y la volvemos a repetir.</p>
        </div>
        <div class="col-md-8">
        <form method="post" action="addcostumer.php">
            <div class="form-group">
            <label for="name">Nombre del personal</label>
            <input type="text" class="form-control" id="name" name="name" placeholder="Nombre del personal" required>
            </div>
            <div class="form-group">
            <label for="address">Direcci&oacute;n</label>
            <input type="text" class="form-control" id="address" name="address" placeholder="Dirección" required>
            </div>
            <div class="form-group">
            <label for="location">Ubicaci&oacute;n</label>
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
            <label for="birthdate">Correo</label>
            <input type="text" class="form-control" id="mail" name="mail" placeholder="correo eléctronico" required>
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
            <label for="password">Contrase&ntilde;a</label>
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