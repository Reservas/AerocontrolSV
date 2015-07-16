<?php
session_start();
require "docs/connect.php";
$noexist = false;
if(isset($_POST['user'],$_POST['pass'],$_POST['airline']))
{
    try
    {
        $md5 = md5($_POST['pass']);
        $db = new PDO("mysql:host=". $hostname . ";dbname=$database", $username, $password);
        $stmt = $db->prepare("SELECT `user-airline`.*, `airlines`.`name` AS airname 
                                FROM  `user-airline`
								INNER JOIN `airlines`
								on `user-airline`.`airline` = `airlines`.`id`
                                WHERE  `user-airline`.`user` =   :user 
                                AND  `user-airline`.`airline` =   :airline 
                                AND  `user-airline`.`password` =   :pass 
                                LIMIT 0 , 30");
        $stmt->bindParam(':user',$_POST['user'], PDO::PARAM_STR);
        $stmt->bindParam(':pass',$md5 , PDO::PARAM_STR);
        $stmt->bindParam(':airline',$_POST['airline'], PDO::PARAM_STR);
        $stmt->execute();
        $noexist = true;
            if($result = $stmt->fetchAll()) {
                foreach($result as $row){
                    if ($row['status'] == 1) 
                    {
                        switch($row['type'] ){
                            case 1:
                                header("location:airline/admin/");
                                $_SESSION['usuario'] = $row['user'];
                                $_SESSION['airline'] = $row['airline'];
								$_SESSION['airname'] = $row['airname'];
                                $_SESSION['tipo'] = $row['type'];
                            exit();
                            case 2:
                                header("location:airline/employee/");
                                $_SESSION['usuario'] = $row['user'];
                                $_SESSION['airline'] = $row['airline'];
								$_SESSION['airname'] = $row['airname'];
                                $_SESSION['tipo'] = $row['type'];
                            exit();
                        }
                    }
                    else
                    {
                       header("location: ./loginairl.php?airline=".$_POST['airline']);
                       exit();
                    }
                }
            }else{
	           header("location: ./loginairl.php?airline=".$_POST['airline']);
	           exit();
            }
        
        $db = null; 
    }
    catch(PDOException $e){
        echo $e->getMessage();
    }
}else{
	echo "no entra";
}

?>
