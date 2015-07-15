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
    <title>Administrator - Add client</title>
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
    <a href="../../en/admin/addcostumer.php">English/</a><a href="../../es/admin/addcostumer.php">Español</a>
        <!-- /NAV -->
        <h1 class="text-center">Add Costumers</h1>
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
            echo "<p class='text-success text-center'><strong>The data were stored</strong></p>";
            echo "<p class='text-success text-center'><a href='costumers.php'>List of clients</a></p>";
        }
        else
        {
            echo "<p class='text-danger text-center'><strong>Error: The data were not saved</strong></p>";
            echo "<p class='text-success text-center'><a href='costumers.php'>List of clients</a></p>";
        }
    }
    else
    {
        echo "<p class='text-danger'><strong>The password are incorrect</strong></p>";
    }
}
?>
        <div class="col-md-4 well">
            <h3>Help</h3>
            <p>Please write the <strong>name</strong> of the client you want to add, ow write the  <strong>address</strong> were you lived,  <strong>city</strong> write you <strong>birthday </strong> put your <strong>phone number</strong>put the  <strong>username</strong>and finish write the <strong>password</strong> and repeat.</p>
        </div>
                            <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                        <div class="panel panel-primary">
                          <div class="panel-heading">
                            <h2 class="text-center" style="color:#fff;">Customer login
</h2>
                          </div>
                          <div class="panel-body">
                            <form action="register.php" method="post">
                              <div class="col-md-6"> 
                                <label>Username</label>
                                <input type="text" class="form-control input-sm" name="user" placeholder="Username" autocomplete="off" required> 
                                <label>Password</label>
                                <input type="password" class="form-control input-sm" name="pass" placeholder="Passwprd" autocomplete="off" required>  
                                <label>Repeat password</label>
                                <input type="password" class="form-control input-sm" name="rpass" placeholder="Repit password" autocomplete="off" required>
                                <label>Birthday</label>
                                <input type="text" class="form-control input-sm" name="nac" placeholder="Birthday" autocomplete="off" required onkeypress='return numeros(event)'> 
                                <label>Telephone</label>
                                <input type="text" class="form-control input-sm" name="phone" placeholder="Telephone" autocomplete="off" required onkeypress='return numeros(event)'> 
                              </div>
                              <div class="col-md-6">
                                <label>Name</label>
                                <input type="text" class="form-control input-sm" name="name" placeholder="Name" autocomplete="off" required onkeypress="return validar(event)"> 
                                <label>Country</label>
                                <input type="text" class="form-control input-sm" name="city" placeholder="Country" autocomplete="off" required onkeypress="return validar(event)"> 
                                <label>State</label>
                                <input type="text" class="form-control input-sm" name="state" placeholder="State" autocomplete="off" required onkeypress="return validar(event)"> 
                                <label>Address</label>
                                <input type="text" class="form-control input-sm" name="address" placeholder="Address" autocomplete="off" required> 
                                <label>E-mail</label>
                                <input type="text" class="form-control input-sm" name="mail" placeholder="E-mail" autocomplete="off" required> 
                              </div>
                          </div> 
                          <div class="panel-footer">
                              <input type="submit" class="btn btn-success form-control btn-sm" value="Register">
                            </form>
                          </div>
                        </div>
                    </div>
        </div>
    </div>    
</div>
</body>
</html>