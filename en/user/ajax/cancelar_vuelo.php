<?php 
     
            if(isset($_POST['bookid']) AND isset($_POST['justification'])){
               	include "../files/conexion.php";
                $stmt = $mysqli->prepare("UPDATE `aerocontrol`.`bookings` SET `is_cancelled`= 1, `justification`= ? WHERE `bookings`.`id` = ?");
                $stmt->bind_param('si',$_POST['justification'],$_POST['bookid']);
                $stmt->execute();
				header('Location: ../compras.php?c=1');
			}else {
				header('Location: ../compras.php?e=1');
			}
        ?>