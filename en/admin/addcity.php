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
    <title>Administrator - Add city</title>
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
        <h1 class="text-center">Add city</h1>
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
        echo "<p class='text-success text-center'><strong>Data were stored</strong></p>";
        echo "<p class='text-success text-center'><a href='cities.php'>List of the cities</a></p>";
    }
    else
    {
        echo "<p class='text-danger text-center'><strong>Error: the data were not saved</strong></p>";
        echo "<p class='text-success text-center'><a href='cities.php'>List of the cities</a></p>";
    }
}
?>
        <div class="col-md-4 well">
            <h3>Help</h3>
            <p>Write the name of the <strong>City</strong> Later, the name of the <strong>Country(departament)</strong> and the <strong>ZIP code</strong> </p>
        </div>
        <div class="col-md-8">
        <form method="post" action="addcity.php">
            <div class="form-group">
            <label for="city">Name of the city</label>
            <input type="text" class="form-control" id="city" name="city" placeholder="Name of the city" required onkeypress="return validar(event)">
            </div>
            <div class="form-group">
            <label for="state">Name of the Country</label>
            <input type="text" class="form-control" id="state" name="state" placeholder="Name of the Country" required onkeypress="return validar(event)">
            </div>
            <div class="form-group">
            <label for="zip">ZIP code</label>
            <input type="number" class="form-control" id="zip" name="zip" placeholder="ZIP code" required min="0" onkeypress='return numeros(event)'>
            </div>
            <input type="submit" name="enviar" value="Save">
        </form>
        </div>
    </div>    
</div>
</body>
</html>