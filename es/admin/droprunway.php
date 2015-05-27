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
    <title>Administración - Borrando pista de aterrizaje</title>
</head>
<body>
<div class="container-fluid">
    <div class="row">
    <!-- NAV -->
    <?php include 'nav.php'; ?>
    <!-- /NAV -->
        <h1 class="text-center">Borrando pista de aterrizaje</h1>
<?php
    if(isset($_GET["runway"]))
    {
        include "../docs/connect.php";
        $idr = $_GET["runway"];
        $query = "SELECT id FROM runways WHERE id = '$idr'";
        $resultado = mysql_query($query, $link);
        $total = mysql_num_rows($resultado);
        if($total == 1)
        {
            $query2 = "DELETE FROM runways WHERE id = '$idr'";
            $resultado2 = mysql_query($query2, $link);
            if($resultado2)
            {
                echo "<p class='text-success text-center'><strong>La pista se borro. <a href='runways.php'>Lista de pistas de aterrizaje</a></strong></p>";  
            }
            else
            {
                echo "<p class='text-danger text-center'><strong>Error al borrar. <a href='runways.php'>Lista de pistas de aterrizaje</a></strong></p>";  
            }
        }
        else
        {
            echo "<p class='text-danger text-center'><strong>Error. <a href='runways.php'>Lista de pista de aterrizaje</a></strong></p>"; 
        }
    }
    else
    {
        echo "<p class='text-danger text-center'><strong>Error: no hay id de pista. <a href='runways.php'>Lista de pistas de aterrizaje</a></strong></p>"; 
    }
?>
    </div>    
</div>
</body>
</html>