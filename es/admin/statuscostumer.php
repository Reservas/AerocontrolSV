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
    <title>Administración - Cambiando estado de un cliente</title>
</head>
<body>
<div class="container-fluid">
    <div class="row">
    <!-- NAV -->
    <?php include 'nav.php'; ?>
    <!-- /NAV -->
        <h1 class="text-center">Cambiando estado de un cliente</h1>
<?php
    if(isset($_GET["costumer"]))
    {
        include "../docs/connect.php";
        $idr = $_GET["costumer"];
        $query = "SELECT id, name, status FROM costumers WHERE id = '$idr' ORDER BY id";
        $resultado = mysql_query($query, $link);
        $total = mysql_num_rows($resultado);
        if($total == 1)
        {
            while($row = mysql_fetch_array($resultado))
            {
                if($row["status"]==0)
                {
                    $query2 = "UPDATE costumers SET status = '1' WHERE id = $idr";
                    $resultado2 = mysql_query($query2, $link);
                    if($resultado2)
                    {
                        echo "<p class='text-success text-center'><strong>El estado del usuario &quot; ".$row['name']." &quot; se cambio a ACTIVO. <a href='costumers.php'>Lista de clientes</a></strong></p>";  
                    }
                    else
                    {
                        echo "<p class='text-danger text-center'><strong>Error. <a href='costumers.php'>Lista de clientes</a></strong></p>";  
                    }
                }
                elseif($row["status"]==1)
                {
                    $query2 = "UPDATE costumers SET status = '0' WHERE id = $idr";
                    $resultado2 = mysql_query($query2, $link);
                    if($resultado2)
                    {
                        echo "<p class='text-success text-center'><strong>El estado del usuario &quot; ".$row['name']." &quot; se cambio a INACTIVO. <a href='costumers.php'>Lista de clientes</a></strong></p>";  
                    }
                    else
                    {
                        echo "<p class='text-danger text-center'><strong>Error al borrar. <a href='costumers.php'>Lista de clientes</a></strong></p>";  
                    }
                }
            }
        }
        else
        {
            echo "<p class='text-danger text-center'><strong>Error. <a href='costumers.php'>Lista de clientes</a></strong></p>"; 
        }
    }
    else
    {
        echo "<p class='text-danger text-center'><strong>Error: no hay id de cliente. <a href='costumers.php'>Lista de clientes</a></strong></p>"; 
    }
?>
    </div>    
</div>
</body>
</html>