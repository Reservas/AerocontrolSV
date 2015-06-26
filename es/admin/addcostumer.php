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
        </div>  <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                        <div class="panel panel-primary">
                          
                          <div class="panel-body">
                            <form name="register" action="register.php" method="post">
                              <div class="col-md-6"> 
                                <label>Usuario</label>
                                <input type="text" class="form-control input-sm" name="user" placeholder="Usuario" autocomplete="off" required > 
                                <label>Contraseña</label>
                                <input type="password" class="form-control input-sm" name="pass" placeholder="Contraseña" autocomplete="off" required maxlength="6" >  
                                <label>Repetir contraseña</label>
                                <input type="password" class="form-control input-sm" name="rpass" placeholder="Repetir contraseña" autocomplete="off" required maxlength="6">
                                <label>Fecha de nacimiento</label>
                                  <script>
                                  function compruebaFecha($date){
if ($date == "" || $date == "dd/mm/aaaa")
return false;
if (!ereg("^([[:digit:]]{2})/([[:digit:]]{2})/([[:digit:]]{4})$", $date, $vec))
return false;
else{
if ($vec[1] <= 31)
return false;
if ($vec[2] <= 12)
return false;
//if ($vec[3] <= date("Y") + 1)
//return false;
if ($date != date("d/m/Y",mktime(0,0,0, $vec[2], $vec[1], $vec[3])))
return false;
}
return true;
}
                                  </script>
                                <input type="date" class="form-control input-sm" name="nac" placeholder="Fecha de nacimiento" autocomplete="off" required onkeypress="compruebaFecha"> 
                                <label>Telefono</label>
                                  
                                <input type="text" class="form-control input-sm" name="phone" maxlength="8" placeholder="7*******" autocomplete="off" required onKeyPress="return soloNumeros(event)"required="" pattern="7[0-9]{7}"> 
                              </div>
                              <div class="col-md-6">
                                <label>Nombre</label>
                                <input type="text" class="form-control input-sm" name="name" placeholder="Nombre" autocomplete="off" required
                                onkeypress="return alpha(event)" > 
                                <label>Pais</label>
                                <!--<div class="panel-body">-->
                                  <select class="form-control input-sm" id="city" name="city">
                                    <option value="">Elige un pais</option>
                                    <?php
                                    include "../connect.php";
                                      $query = mysql_query("SELECT state FROM cities");
                                      while($row = mysql_fetch_row($query))
                                      {
                                          echo "<option value='".$row[0]."'>".$row[0]."</option>";
                                      }
                                    ?>
                                  </select>
                                <!--</div>-->
                                <!--<input type="text" class="form-control input-sm" name="city" placeholder="Pais" autocomplete="off" required 
                                onkeyup="this.value=this.value.replace(/[^a-zA-Z] /g,'');"> -->
                                <label>Estado</label>
                                <input type="text" class="form-control input-sm" name="state" placeholder="Estado" autocomplete="off" required 
                                onkeypress="return alpha(event)"> 
                                <label>Direccion</label>
                                <input type="text" class="form-control input-sm" name="address" placeholder="Direccion" autocomplete="off" required> 
                                <label>Correo</label>
                                <input type="text" class="form-control input-sm" name="mail" placeholder="Correo" autocomplete="off" required> 
                              </div>
                          </div> 
                          <div class="panel-footer">
                              <input type="submit" class="btn btn-success form-control btn-sm" value="Registro">
                            </form>
                          </div>
                        </div>
                    </div>
        </div>
    </div>    
</div>
</body>
</html>