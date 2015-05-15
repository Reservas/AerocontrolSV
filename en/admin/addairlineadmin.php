
<?php
if(isset($_GET["air"]))
    {
        include "../docs/connect.php";
        $idr = $_GET["air"];
        $query = "SELECT * FROM airlines WHERE id = '$idr' ORDER BY id";
        $resultado = mysql_query($query, $link);
        $total = mysql_num_rows($resultado);
        if($total == 1)
        {
        echo ".....";
        
        }
        else
        {
        echo "...";
        }
        
    }
    else
    {
    echo "........";
    }
?>