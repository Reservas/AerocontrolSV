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
    <title>Administración - Add airport</title>
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
        <h1 class="text-center">Add airport</h1>
<?php
if(isset($_POST["name"]) AND isset($_POST["location"]))
{
    $name = $_POST["name"];
    $location = $_POST["location"];
    include "../docs/connect.php";
    $query = mysql_query("INSERT INTO airports (id, name, location) VALUES ('','$name','$location')");
    if($query)
    {
        echo "<p class='text-success text-center'><strong>Data were stored</strong></p>";
        echo "<p class='text-success text-center'><a href='airports.php'>List of the airport</a></p>";
    }
    else
    {
        echo "<p class='text-danger text-center'><strong>Error: the data were not saved</strong></p>";
        echo "<p class='text-success text-center'><a href='airports.php'>List of the airport</a></p>";
    }
}
?>
        <div class="col-md-4 well">
            <h3>Help</h3>
            <p>Add the name of the <strong>airport</strong> the location to</p>
        </div>
        <div class="col-md-8">
        <form method="post" action="addairport.php">
            <div class="form-group">
            <label for="name">Name of the airport</label>
            <input type="text" class="form-control" id="name" name="name" placeholder="Name of the airport" required onkeypress="return validar(event)">
            </div>
            <label for="location">Location</label>
            <select class="form-control" name="location" id="location">
                <option value="">Location</option>
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
            <input type="submit" name="enviar" value="Save">
        </form>
        </div>
    </div>    
</div>
</body>
</html>